@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card h-100" style="width: 18rem">
                    <img class="img-fluid product-image" src="{{ asset($product->image) }}">

                    <div class="card-body d-flex flex-column">
                        {{-- TODO: Fix image positioning --}}
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>RM </strong>{{ $product->price }}</p>
                        <a href="{{ route('add.to.cart', $product->id) }}" class="card-link btn btn-primary">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
