@extends('layouts.app')

@section('content')
    @if (sizeof($orders) != 0)
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Order Number</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @php $count = 0; @endphp
                    @foreach ($orders as $order)
                        @php
                            $count += 1;
                        @endphp
                        <tr>
                            <td>
                                <div>
                                    # {{ $count }}
                                </div>
                                <div class="text-muted">
                                    {{ date('F j, Y, g:i a', strtotime($order->created_at)) }}
                                </div>
                            </td>
                            <td>
                                @foreach ($order->products()->get() as $product)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ displayImage($product->image) }}"
                                                class="img-fluid order-product-image">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row d-flex">
                                                <p class="order-product-name">{{ $product->name }}</p>
                                            </div>
                                            <div class="row d-flex">
                                                <p class="order-product-description text-muted">
                                                    {!! $product->description !!}
                                                </p>
                                            </div>
                                            <div class="row d-flex">
                                                <div class="col-md-6">
                                                    <p class="order-product-price">
                                                        Price: {{ presentPrice($product->price) }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="order-product-quantity">
                                                        Qty: {{ $product->pivot->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td><span class="badge badge-success">Fulfilled</span></td>
                            <td>{{ presentPrice($order->billing_total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>You have not made a purchase</h2>
            </div>
        </div>
    @endif
@endsection
