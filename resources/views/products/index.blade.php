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
                    <form action="{{ route('products.filter') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <strong>Price Range: </strong>
                            <span id="lower-price">{{ presentPrice($minPrice) }}</span>
                            <input type="hidden" name="minPrice" value="{{ $minPrice }}" class="min-price">
                            -
                            <span id="upper-price">{{ presentPrice($maxPrice) }}</span>
                            <input type="hidden" name="maxPrice" value="{{ $maxPrice }}" class="max-price">
                        </div>
                        <div id="price-slider" class="mb-3 slider-success"></div>
                        <button type="submit" class="btn btn-success btn-block">
                            Filter
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <hr>
            <div class="row">
                <div class="col-md-9">
                    @if (!empty($categoryName))
                        <h2>{{ $categoryName }}</h2>
                    @else
                        <h4>Search results for "{{ $searchQuery }}"</h4>
                    @endif
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

                            <img src="{{ displayImage($product->image) }}" class="img-fluid product-image card-img-top">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{!! $product->description !!}</p>
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
        var slider = document.getElementById('price-slider');
        var min_price = parseInt($('#lower-price').text().trim().replace(/[^\d.]/g, ''));
        var max_price = parseInt($('#upper-price').text().trim().replace(/[^\d.]/g, ''));
        noUiSlider.create(slider, {
            start: [min_price, max_price],
            connect: true,
            behaviour: 'drag',
            tooltips: [
                wNumb({
                    decimals: 0
                }),
                wNumb({
                    decimals: 0
                })
            ],
            range: {
                'min': 1,
                'max': 1000
            }
        });

        var nodes = [
            document.getElementById('lower-price'),
            document.getElementById('upper-price')
        ];

        slider.noUiSlider.on('update', function(values, handle) {
            var value = values[handle];
            nodes[handle].innerHTML = 'RM' + Math.round(value);
            $('.min-price').val(Math.round(values[0]));
            $('.max-price').val(Math.round(values[1]));
        });
    </script>
@endpush
