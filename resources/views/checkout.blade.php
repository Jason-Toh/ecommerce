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
                            <input type="text" name="post_code" id="post_code" class="form-control num-only" required>
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
                            <input type="text" name="phone_number" id="phone_number" class="form-control num-only" required>
                        </div>
                    </div>
                </div>
                {{-- <h2 style="margin-top:1em; margin-bottom:1em;">Payment details</h2>
                <div class="form-group">
                    <label for="name_on_card">Name on card</label>
                    <input type="text" name="name_on_card" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="credit_card">Credit Card</label>
                    <input type="text" name="credit_card" class="form-control" required>
                </div> --}}
                <button type="submit" class="btn btn-success btn-block">Complete Order</button>
            </form>
        </div>
        <div class="col-md-5 offset-md-1">
            <hr>
            <h3>Your Order</h3>
            <hr>
            <table class="table table-borderless table-responsive">
                <tbody>
                    @foreach ($products as $id => $product)
                        <tr>
                            <td>
                                <div style="background-image: url({{ $product['image'] }})"
                                    class="img-fluid rounded checkout-image">
                                </div>
                            </td>
                            <td>
                                <div class="text-decoration-none">
                                    <h3 class="checkout-name">{{ $product['item']['name'] }}</h3>
                                    <h3 class="checkout-price">RM {{ $product['price'] }}</h3>
                                </div>
                            </td>
                            <td>
                                <span class="checkout-quantity">{{ $product['quantity'] }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.num-only').on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    </script>
@endpush
