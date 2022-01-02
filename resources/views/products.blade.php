@extends('layouts.app')
   
@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card h-100" style="width: 18rem">
                    <img class="card-img-top" src="{{ asset($product->image) }}" alt="">
                    
                    <div class="card-body d-flex flex-column">
                        {{-- TODO: Fix image positioning --}}
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>RM </strong>{{$product->price}}</p>
                        <a href="{{ route('add.to.cart', $product->id)}}" class="card-link btn btn-primary">
                            Add to Cart
                        </a>

                        {{-- <a role="button" class="btn btn-primary" href="{{ route('add.to.cart', $product->id)}}">
                            Add to Cart
                        </a> --}}
                        {{-- Quantity button --}}
                        {{-- <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus" id="{{ $product->id }}">
                            <input type="number" id={{ $product->id }} min="0" name="quantity" value="0" class="input-text qty text" >
                            <input type="button" value="+" class="plus" id="{{ $product->id }}">
                        </div> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.minus').click(function(e){
        /*
            The event.preventDefault() method stops the default action of an element from happening.

            For example:

            Prevent a submit button from submitting a form
            Prevent a link from following the URL 

            TODO: Handle user input in text area
            users can enter negative values without the plus and minus button
        */

        e.preventDefault();
        // https://stackoverflow.com/questions/30074107/passing-a-php-variable-to-javascript-in-a-blade-template
        var products = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};
        for(const product of products){
            if (product['id'] == this['id']){
                // https://stackoverflow.com/questions/1944302/jquery-select-an-elements-class-and-id-at-the-same-time
                // https://stackoverflow.com/questions/3304014/how-to-interpolate-variables-in-strings-in-javascript-without-concatenation
                var quantityElement = $(`#${product['id']}.input-text`);
                break;
            }
        }
        var oldValue = parseInt(quantityElement.val());
        var newValue = oldValue - 1;
        if (newValue > -1){
            quantityElement.val(newValue);
        }
    })

    $('.plus').click(function(e){
        e.preventDefault();
        var products = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};
        for(const product of products){
            if (product['id'] == this['id']){
                var quantityElement = $(`#${product['id']}.input-text`);
                break;
            }
        }
        var oldValue = parseInt(quantityElement.val());
        var newValue = oldValue + 1;
        quantityElement.val(newValue);
    })
</script>
@endsection