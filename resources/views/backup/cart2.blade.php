@extends('layouts.app')

@section('content')
    @if (!empty($products))
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="hidden"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($products as $id => $product)
                    @php $total += $product['price'] * $product['quantity'] @endphp
                    <tr>
                        <td>
                            <img src="{{ $product['image'] }}" class="img-fluid cart-image" />
                        </td>
                        <td>{{ $product['item']['name'] }}</td>
                        <td>
                            RM
                            <span class="cart-unit-price" id="{{ $id }}">
                                {{ number_format($product['price'], 2, '.', '') }}
                            </span>
                        </td>
                        <td>
                            <span class="minus">-</span>
                            <input type="text" value="{{ $product['quantity'] }}"
                                class="quantity-textbox cart-update-quantity custom-num-only" data-id="{{ $id }}"
                                id="{{ $id }}">
                            <span class="plus">+</span>
                        </td>
                        <td>
                            RM
                            <span class="cart-unit-total-price" id="{{ $id }}">
                                {{ number_format($product['price'] * $product['quantity'], 2, '.', '') }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('remove.from.cart', $id) }}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        <h3>
                            Total: RM
                            <span class="cart-total-price">
                                {{ number_format($total, 2, '.', '') }}
                            </span>
                        </h3>
                    </td>
                    <td colspan="6" class="text-right cart-checkout-btn">
                        <button type="button" class="btn btn-success">
                            Checkout
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>No items in cart</h2>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">
        var total = parseFloat($('.cart-total-price').text().trim());

        function updateTotalPrice(productId) {
            let unitPrice = parseFloat($(`#${productId}.cart-unit-price`).text().trim());
            let quantity = parseInt($(`#${productId}.quantity-textbox`).val());
            let totalPrice = unitPrice * quantity;
            let result = totalPrice ? totalPrice : unitPrice
            $(`#${productId}.cart-unit-total-price`).text(`${result.toFixed(2)}`);

            // Sum up the total price
            total = 0;
            $('.cart-unit-total-price').each(function() {
                total += parseFloat($(this).text().trim());
            })
            $('.cart-total-price').text(`${total.toFixed(2)}`);
        }

        $('.cart-update-quantity').on('input', function(e) {
            let productId = $(this).attr('id');
            updateTotalPrice(productId);
        })

        $('.cart-checkout-btn').click(function(e) {
            $('.quantity-textbox').each(function() {

                // https://stackoverflow.com/questions/19866509/jquery-get-an-element-by-its-data-id/19866970
                let productId = $(this).data('id');
                let quantity = parseInt($(this).val());

                // Save all changes to the cart
                $.ajax({
                    url: "{{ route('update.cart') }}",
                    type: 'patch',
                    data: {
                        _token: "{{ csrf_token() }}", //needed for 419 unknown status
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Redirect to checkout page on success
                        window.location.href = "{{ route('checkout') }}"
                    }
                })
            })
        })
    </script>
@endpush
