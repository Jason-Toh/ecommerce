@extends('layouts.app')

@section('content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">No.</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Items</th>
                <th scope="col" class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            @foreach($orderItems as $orderItem)
                <tr>
                    <?php
                        $count += 1;
                        $order = $orderItem['order'];
                        $products = $orderItem['products'];
                    ?>
                    <td class="text-center">{{ $count }}</td>
                    <td class="text-center">{{ $order['created_at'] }}</td>
                    <td>
                        @foreach($products as $product)
                            <img src="{{ $product['image'] }}" class="img-fluid rounded"/>
                            <div>
                                <div>
                                    {{ $product['name'] }}
                                </div>
                                <div>
                                    {{ $product['description'] }}
                                </div>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection