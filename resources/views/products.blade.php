@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <h4>Category</h4>
                <ul>
                    @foreach ($categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3 d-flex align-items-stretch">
                        <div class="card product-card">

                            <img src="{{ asset($product->image) }}" class="img-fluid product-image card-img-top">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>RM </strong>{{ $product->price }}</p>
                                <a href="{{ route('products.details', $product->slug) }}"
                                    class="card-link btn btn-primary product-details-button">
                                    View Details
                                </a>
                                {{-- <a href="{{ route('add.to.cart', $product->id) }}" class="card-link btn btn-primary">
                            Add to Cart
                        </a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
