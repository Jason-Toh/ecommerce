@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li><i class="fa fa-chevron-right"></i></li>
                <li>Products</li>
                @if (request()->has('category'))
                    <li><i class="fa fa-chevron-right"></i></li>
                    <li>{{ ucfirst(request()->category) }}</li>
                @endif
            </ul>
            @include('partials.search')
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <div>
                    <h4>Category</h4>
                    <ul>
                        @foreach ($categories as $category)
                            <li class="{{ request()->category == $category->slug ? 'sidebar-active' : '' }}">
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                    class="sidebar-link">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('products.index') }}" class="sidebar-link">Featured</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4>Sort by Price</h4>
                    <ul>
                        <li class="{{ request()->sort == 'low_high' ? 'sidebar-active' : '' }}">
                            <a
                                href="{{ route('products.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low
                                to High</a>
                        </li>
                        <li class="{{ request()->sort == 'high_low' ? 'sidebar-active' : '' }}">
                            <a
                                href="{{ route('products.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High
                                to Low</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4>Filter By Price</h4>
                    {{-- <p class="alert alert-danger">This needs to be done later</p> --}}
                    {{-- <input type="range" class="product-price-slider" min=0 max=1000 value=0> --}}
                    {{-- <div id="price-slider"></div> --}}
                    {{-- <div class="price-filter">
                        <input type="text" class="custom-num-only" placeholder="RM MIN">
                        <input type="text" class="custom-num-only" placeholder="RM MAX">
                    </div> --}}
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
                    {{ $products->appends(request()->input())->links() }}
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
                                <p class="card-text">{{ presentPrice($product->price) }}</p>
                                <a href="{{ route('products.show', $product->slug) }}"
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
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // var slider = document.getElementById('price-slider');
        // noUiSlider.create(slider, {
        //     start: [1, 1000],
        //     connect: true,
        //     range: {
        //         'min': 1,
        //         'max': 1000
        //     },
        //     pips: {
        //         mode: 'steps',
        //         stepped: true,
        //         density: 4
        //     }
        // })
    </script>
@endpush
