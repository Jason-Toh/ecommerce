@extends('layouts.app')
   
{{-- https://speckyboy.com/free-shopping-cart-css-javascript/ --}}
{{-- https://bbbootstrap.com/snippets/shopping-cart-checkout-payment-options-86973257 --}}
{{-- https://www.w3schools.com/howto/howto_css_checkout_form.asp --}}
@section('content')
    <h1 class="mb-4">Checkout</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form class="card-body" role="form" method="POST" action="">
                    @csrf
                    <h3>Billing Details</h3>
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
                                <input type="text" class="form-control" name="post_code" id="post_code" required>
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
                                <label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection