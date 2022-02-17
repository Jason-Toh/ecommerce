@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="product-main-image mb-3">
                <img src="{{ displayImage($product->image) }}" class="img-fluid active">
            </div>
            <div class="product-gallery">
                <img src="{{ displayImage($product->image) }}" class="img-fluid">
                @if ($product->images)
                    @foreach (json_decode($product->images, true) as $image)
                        <img src="{{ displayImage($image) }}" class="img-fluid">
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-5 offset-md-1">
            <h2>{{ $product->name }}</h2>
            <span class="badge badge-success stock-badge">In Stock</span>
            <h3>{{ presentPrice($product->price) }}</h3>
            <p>{!! $product->description !!}</p>
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

@push('scripts')
    <script text="text/javascript">
        $('.plus').click(function() {
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) + 1;

            inputElem.val(quantity);
        })

        $('.minus').click(function() {
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) - 1;

            quantity = quantity < 1 ? 1 : quantity
            inputElem.val(quantity);
        })

        const currentImage = document.querySelector('.product-main-image img');
        const images = document.querySelectorAll('.product-gallery img');

        images.forEach((e) => e.addEventListener('click', function() {
            currentImage.classList.remove('active');

            // Executes after the transition has ended
            currentImage.addEventListener('transitionend', () => {
                currentImage.src = this.src;
                currentImage.classList.add('active');
            })

            // highlights the current selected product in the product gallery
            images.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }));
    </script>
@endpush
