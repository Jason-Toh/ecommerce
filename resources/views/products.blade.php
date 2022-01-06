@extends('layouts.app')
   
@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card h-100" style="width: 18rem">
                    <img class="card-img-top" src="{{ asset($product->image) }}" alt="">
                    
                    <div class="card-body d-flex flex-column">
                        {{-- TODO: Fix image positioning --}}
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>RM </strong>{{$product->price}}</p>
                        <a href="{{ route('add.to.cart', $product->id)}}" class="card-link btn btn-primary">
                            Add to Cart
                        </a>

                        {{-- <a role="button" class="btn btn-primary" href="{{ route('add.to.cart', $product->id)}}">
                            Add to Cart
                        </a> --}}
                        {{-- Quantity button --}}
                        {{-- <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus" id="{{ $product->id }}">
                            <input type="number" id={{ $product->id }} min="0" name="quantity" value="0" class="input-text qty text" >
                            <input type="button" value="+" class="plus" id="{{ $product->id }}">
                        </div> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection