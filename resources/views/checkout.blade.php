@extends('layouts.app')
   
{{-- https://speckyboy.com/free-shopping-cart-css-javascript/ --}}
{{-- https://bbbootstrap.com/snippets/shopping-cart-checkout-payment-options-86973257 --}}
{{-- https://www.w3schools.com/howto/howto_css_checkout_form.asp --}}
@section('content')
    <h1 class="checkout-heading stylish-heading">
        Checkout
    </h1>
    <div class="checkout-section">
        <div>
            <form role="form" method="POST" action="">
                @csrf
                <h3>Billing Details</h3>
                <div class="form-group">
                    <label for="name"><i class="fa fa-user"></i> Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fa fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>
                <div class="half-form">
                    <div class="form-group">
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" class="form-control" name="city" id="city" required>
                    </div>
                    <div class="form-group">
                        <label for="post_code"><i class="fa fa-map-pin"></i> Post Code</label>
                        <input type="text" class="form-control" name="post_code" id="post_code" required>
                    </div>
                </div>
                <div class="half-form">
                    <div class="form-group">
                        <label for="country"><i class="fa fa-globe"></i> Country</label>
                        <input type="text" class="form-control" name="country" id="country" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="checkout-table-container">
            <h3>Your Order</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="hidden"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection