@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card">

                    <img src="{{ asset($product->image) }}" class="img-fluid product-image card-img-top">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>RM </strong>{{ $product->price }}</p>
                        <a href="{{ route('products.details', $product->slug) }}" class="card-link btn btn-primary">
                            Details
                        </a>
                        {{-- <a href="{{ route('add.to.cart', $product->id) }}" class="card-link btn btn-primary">
                            Add to Cart
                        </a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
