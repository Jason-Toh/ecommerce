@extends('layouts.app')

@section('dashboard')
    {{-- <div class="dashboard-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-content">
                        <h1>Ecommerce Website</h1>
                        <p>Made in Laravel</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <section class="slider-section">
        <div id="customCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php
                    $i = 0;
                @endphp
                @foreach ($sliderImages as $image)
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box">
                                        <h1>Welcome to our shop</h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe
                                            dolorem
                                            deserunt quo quidem ad optio.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="{{ displayImage($image) }}" alt="" class="d-block img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
                <div class="carousel-btn-box">
                    <a class="carousel-control-prev" href="#customCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <h2 class="dashboard-title">Laravel Ecommerce</h2>
    <p class="dashboard-description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam accusamus eos
        quibusdam, esse voluptates voluptatibus id corporis facere neque amet alias molestias itaque ex porro
        architecto blanditiis distinctio maxime laboriosam.
    </p>
    <h2 class="dashboard-title">Featured Products</h2>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-3">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="card product-card">
                        <img src="{{ displayImage($product->image) }}" class="img-fluid product-image card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->name }}
                                <span class="float-right">{{ presentPrice($product->price) }}</span>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="card-link btn btn-primary product-details-button" style="left: 35%; top:30%">
                                    View Details
                                </a>
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="dashboard-show-more">
        <a href="{{ route('products.index') }}">
            <button class="btn dashboard-btn-black">Show more</button>
        </a>
    </div>
    <hr>
@endsection
