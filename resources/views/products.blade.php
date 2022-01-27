@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <div>
                    <h4>Category</h4>
                    <ul>
                        @foreach ($categories as $category)
                            <li class="{{ request()->category == $category->slug ? 'sidebar-active' : '' }}">
                                <a href="{{ route('products', ['category' => $category->slug]) }}"
                                    class="sidebar-link">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('products') }}" class="sidebar-link">Featured</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4>Sort by Price</h4>
                    <ul>
                        <li class="{{ request()->sort == 'low_high' ? 'sidebar-active' : '' }}">
                            <a href="{{ route('products', ['category' => request()->category, 'sort' => 'low_high']) }}">Low
                                to High</a>
                        </li>
                        <li class="{{ request()->sort == 'high_low' ? 'sidebar-active' : '' }}">
                            <a href="{{ route('products', ['category' => request()->category, 'sort' => 'high_low']) }}">High
                                to Low</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <h2>{{ $categoryName }}</h2>
                </div>
                <div class="col-md-3">
                    {{ $products->links() }}
                </div>
            </div>
            <hr>
            <div class="row">
                @forelse ($products as $product)
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
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4">
                        <h3>No Items available</h3>
                    </div>
                @endforelse
            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
