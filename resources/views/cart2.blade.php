@extends('layouts.app')
  
@section('content')
    @if(session()->has('cart'))
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Cart List</h1>
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            
                            <strong>{{ $product['item']['name'] }}</strong>
                            <span class="label label-sucess">RM {{ $product['price'] }}</span>
                            
                            <span class="badge badge-dark float-right">Quantity: {{ $product['quantity'] }}</span>
                            
                            {{-- mr-2: add a margin spacing of size 2 to the right --}}
                            <div class="btn-group float-right mr-2">
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <ul class="dropdown-menu">
                                        <li><a href="">Reduce by 1</a></li>
                                        <li><a href="">Reduce All</a></li>
                                    </ul>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <strong>Total Price: RM {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>No items in cart</h2>
            </div>
        </div>
    @endif
@endsection