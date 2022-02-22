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
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe
                                        dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe
                                        dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Welcome to our shop
                                    </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe
                                        dolorem deserunt quo quidem ad optio.
                                    </p>
                                    <a href="">
                                        Read More
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel_btn_box">
                <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
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
        {{-- <div class="dashboard-product-slider"> --}}
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
        {{-- </div> --}}
    </div>
    <!-- end products row -->
    <div class="dashboard-show-more">
        <a href="{{ route('products.index') }}">
            <button class="btn dashboard-btn-black">Show more</button>
        </a>
    </div>
    <hr>
@endsection
