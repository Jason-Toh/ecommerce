@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div>
                <img src="{{ asset($product->image) }}" class="img-fluid detail-image">
            </div>
        </div>
        <div class="col-md-5 offset-md-1">
            <h2>{{ $product->name }}</h2>
            <span class="badge badge-success detail-stock-badge">In Stock</span>
            <h3>{{ presentPrice($product->price) }}</h3>
            <p>{{ $product->description }}</p>
            <form role="form" method="POST" action="{{ route('cart.store') }}">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                <div class="row">
                    <div class="col-md-6">
                        <span class="minus">-</span>
                        <input type="text" value="1" class="quantity-textbox custom-num-only" name="quantity">
                        <span class="plus">+</span>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
