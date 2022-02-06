@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <div class="row">
        <div class="col-md-5 offset-md-1">
            <hr>
            <h1 class="checkout-title">Checkout</h1>
            <hr>
            <h3 class="checkout-subtitle">Billing details</h3>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><i class="fa fa-user"></i> Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fa fa-envelope"></i> Email Address</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                        readonly required>
                </div>
                <div class="form-group">
                    <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="post_code"><i class="fa fa-map-pin"></i> Post Code</label>
                            <input type="text" name="post_code" id="post_code" class="form-control custom-num-only"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country"><i class="fa fa-globe"></i> Country</label>
                            <input type="text" name="country" id="country" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number"><i class="fa fa-phone"></i> Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control custom-num-only"
                                required>
                        </div>
                    </div>
                </div>
                {{-- <h3 class="text-muted">Payment Details</h3>
                <div class="form-group">
                    <label for="cardholder"><i class="fa fa-user"></i> Cardholder Name</label>
                    <input type="text" class="form-control" name="cardholder" id="cardholder" required>
                </div>
                <div class="form-group">
                    <label for="cardnumber"><i class="fa fa-credit-card"></i> Card Number</label>
                    <input type="text" class="form-control custom-num-only" name="cardnumber" id="cardnumber" required>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="expiry_month"><i class="fa fa-calendar"></i> Expiry month</label>
                        @php $months = range(1, 12); @endphp
                        <select name="expiry_month" id="expiry_month">
                            <option>Select Month</option>
                            @foreach ($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="expiry_year"><i class="fa fa-calendar"></i> Expiry Year</label>
                        @php $years = range(1950, strftime("%Y", time())); @endphp
                        <select name="expiry_year" id="expiry_year">
                            <option>Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cvc">CVC</label>
                            <input type="text" class="form-control custom-num-only" name="cvc" id="cvc" required>
                        </div>
                    </div>
                </div> --}}
                <button type="submit" class="btn btn-success btn-block">
                    Complete Order
                </button>
            </form>
        </div>
        <div class="col-md-5 offset-md-1">
            <hr>
            <h3>Your Order</h3>
            <hr>
            <table class="table table-responsive">
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image }}" class="img-fluid cart-image" />
                            </td>
                            <td>
                                <div class="checkout-container">
                                    Name:<span class="checkout-name">
                                        {{ $product->name }}
                                    </span><br>
                                    Unit Price:<span class="checkout-price">
                                        {{ presentPrice($product->price) }}
                                    </span><br>
                                    Item Subtotal:<span class="checkout-price">
                                        {{ presentPrice($product->price * $product->pivot->quantity) }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="checkout-quantity">{{ $product->pivot->quantity }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="checkout-section">
                <div class="checkout-section-left">
                    Subtotal
                    <br>
                    @if (session()->has('coupon'))
                        Discount ({{ $discountPercent ? $discountPercent . '%' : presentPrice($discountValue) }})
                        <form action="{{ route('coupons.destroy') }}" method="post" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Remove
                            </button>
                        </form>
                        <br>
                        <hr>
                        New Subtotal
                        <br>
                    @endif
                    Tax (10%)
                    <br>
                    Total
                    <br>
                </div>
                <div class="checkout-section-right">
                    {{ presentPrice($cart->subtotal) }}
                    <br>
                    @if (session()->has('coupon'))
                        - {{ presentPrice($discountValue) }}
                        <br>
                        <hr>
                        {{ presentPrice($newSubtotal) }}
                        <br>
                    @endif
                    {{ presentPrice($newTax) }}
                    <br>
                    {{ presentPrice($newTotal) }}
                    <br>
                </div>
            </div>
            <hr>
            <div>
                @if (!session()->has('coupon'))
                    <form action="{{ route('coupons.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="coupon_code">Have coupon?</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="coupon_code" placeholder="Coupon code">
                                <span class="input-group-append">
                                    <button class="btn btn-primary">Apply</button>
                                </span>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection
