@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Checkout</h1>
    <form role="form" method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <h3 class="text-muted">Billing Details</h3>
                <div class="md-form">
                    <label for="name"><i class="fa fa-user"></i> Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="md-form">
                    <label for="email"><i class="fa fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="md-form">
                    <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" class="form-control" name="city" id="city" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="post_code"><i class="fa fa-map-pin"></i> Post Code</label>
                            <input type="text" class="form-control num-only" name="post_code" id="post_code" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="country"><i class="fa fa-globe"></i> Country</label>
                            <input type="text" class="form-control" name="country" id="country" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="phone_number"><i class="fa fa-phone"></i> Phone Number</label>
                            <input type="text" class="form-control num-only" name="phone_number" id="phone_number" required>
                        </div>
                    </div>
                </div>
                <hr>
                <!--
                        <h3 class="text-muted">Payment Details</h3>
                        <div class="md-form">
                            <label for="cardholder"><i class="fa fa-user"></i> Cardholder Name</label>
                            <input type="text" class="form-control" name="cardholder" id="cardholder" required>
                        </div>
                        <div class="card-number">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <label for="cardnumber-1"><i class="fa fa-credit-card"></i> Card Number</label>
                                        <input type="number" class="form-control text-center" name="cardnumber-1" id="cardnumber-1" placeholder="0000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="number" class="form-control text-center" name="cardnumber-2" id="cardnumber-2" placeholder="0000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="number" class="form-control text-center" name="cardnumber-3" id="cardnumber-3" placeholder="0000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="number" class="form-control text-center" name="cardnumber-4" id="cardnumber-4" placeholder="0000" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                {{-- <div class="md-form"> --}}
                                    <label for="expiry_month"><i class="fa fa-calendar"></i> Expiry month</label>
                                    {{-- <input type="text" class="form-control" name="expiry_month" id="expiry_month" required> --}}
                                    @php $months = range(1, 12); @endphp
                                    <select name="expiry_month" id="expiry_month">
                                        <option>Select Month</option>
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-3">
                                {{-- <div class="md-form"> --}}
                                    <label for="expiry_year"><i class="fa fa-calendar"></i> Expiry Year</label>
                                    {{-- <input type="text" class="form-control" name="expiry_year" id="expiry_year" required> --}}
                                    @php $years = range(1950, strftime("%Y", time())); @endphp
                                    <select name="expiry_year" id="expiry_year">
                                        <option>Select Year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                    <label for="cvv">CVV</label>
                                    <input type="number" class="form-control" name="cvv" id="cvv" required>
                                </div>
                            </div>
                        </div>
                    -->
            </div>
            <div class="col-md-5">
                <h3>
                    <span class="text-muted">Your Cart</span>
                    <span class="badge badge-secondary badge-pill">
                        @if (session()->has('cart'))
                            {{ sizeof(session()->get('cart')) }}
                        @endif
                    </span>
                </h3>
                <ul class="list-group checkout checkout-image">
                    @foreach ($products as $id => $product)
                        <li class="list-group-item checkout-table-row">
                            <div class="checkout-image">
                                <img src="{{ $product['image'] }}" class="img-fluid rounded" />
                            </div>

                            <div>
                                <div class="mb-3">{{ $product['item']['name'] }}</div>
                                RM <span>{{ number_format($product['price'], 2, '.', '') }}</span>
                            </div>
                            <div class="checkout-quantity">{{ $product['quantity'] }}</div>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <strong>
                    Total: RM
                    <span class="checkout-total-price">
                        {{ number_format((float) $total, 2, '.', '') }}
                    </span>
                </strong>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.num-only').on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    </script>
@endpush
