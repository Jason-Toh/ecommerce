@extends('layouts.app')

@section('content')
    @foreach($orderItems as $orderItem)
        <?php
            $order = $orderItem['order'];
            $products = $orderItem['products'];
        ?>
        @foreach($products as $product)
            {{$product['name']}}
        @endforeach
    @endforeach
@endsection