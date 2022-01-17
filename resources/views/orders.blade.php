@extends('layouts.app')

@section('content')
    <div class="table-responsive table-borderless">
        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    {{-- <th>Created at</th> --}}
                </tr>
            </thead>
            <tbody class="table-body">
                @php $count = 0; @endphp
                @foreach ($orders as $order)
                    @php
                        $count += 1;
                    @endphp
                    <tr class="cell-1">
                        <td>
                            <div>
                                # {{ $count }}
                            </div>
                            <div class="text-muted">
                                {{ date('F j, Y, g:i a', strtotime($order['created_at'])) }}
                            </div>
                        </td>
                        <td>
                            @foreach ($order->products()->get() as $product)
                                <div class="row row-main">
                                    <div class="col-md-3">
                                        <img src="{{ $product['image'] }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row d-flex">
                                            <p class="product-name">{{ $product['name'] }}</p>
                                        </div>
                                        <div class="row d-flex">
                                            <p class="product-description text-muted">
                                                {{ $product['description'] }}
                                            </p>
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col-md-6">
                                                <p class="product-description">
                                                    Price: {{ $product['price'] }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="product-description">
                                                    Qty: {{ $product->pivot->quantity }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                        <td><span class="badge badge-success">Fulfilled</span></td>
                        <td>RM {{ $order['billing_total'] }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
