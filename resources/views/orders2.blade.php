@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div class="rounded">
                    <div class="table-responsive table-borderless">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Items</th>
                                    <th>status</th>
                                    <th>Total</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @php $count = 0; @endphp
                                @foreach ($orderItems as $orderItem)
                                    @php
                                        $count += 1;
                                        $order = $orderItem['order'];
                                        $products = $orderItem['products'];
                                    @endphp
                                    <tr class="cell-1">
                                        <td>{{ $count }}</td>
                                        <td>
                                            @foreach ($products as $product)
                                                <div class="row row-main">
                                                    <div class="col-md-3">
                                                        <img src="{{ $product['image'] }}" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row d-flex">
                                                            <p class="product-name">{{ $product['name'] }}</p>
                                                        </div>
                                                        <div class="row d-flex">
                                                            <p class="product-description text-muted">
                                                                {{ $product['description'] }}
                                                            </p>
                                                        </div>
                                                        <div class="row d-flex">
                                                            <p class="product-description text-muted">
                                                                {{ $orderItem['quantity'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $product['price'] * $orderItem['quantity'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td><span class="badge badge-success">Fulfilled</span></td>
                                        <td>RM {{ $order['billing_total'] }}</td>
                                        <td>{{ $order['created_at'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
