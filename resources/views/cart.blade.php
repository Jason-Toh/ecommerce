@extends('layouts.app')

@section('content')
    @if (sizeof($cart->products()->get()) != 0)
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
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image }}" class="img-fluid cart-image" />
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            RM
                            <span class="cart-unit-price" id="{{ $product->id }}">
                                {{ presentPrice($product->price) }}
                            </span>
                        </td>
                        <td>
                            <span class="minus">-</span>
                            <input type="text" value="{{ $product->pivot->quantity }}"
                                class="quantity-textbox cart-update-quantity custom-num-only" data-id="{{ $product->id }}"
                                id="{{ $product->id }}">
                            <span class="plus">+</span>
                        </td>
                        <td>
                            RM
                            <span class="cart-unit-total-price" id="{{ $product->id }}">
                                {{ presentPrice($product->price * $product->pivot->quantity) }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('remove.from.cart', $product->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        <h3>
                            Subtotal: RM
                            <span class="cart-total-price">
                                {{ presentPrice($cart->subtotal) }}
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

        $('.plus').click(function() {
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) + 1;

            inputElem.val(quantity);

            let productId = inputElem.attr('id');
            updateTotalPrice(productId);
        })

        $('.minus').click(function() {
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) - 1;

            quantity = quantity < 1 ? 1 : quantity
            inputElem.val(quantity);
            let productId = inputElem.attr('id');
            updateTotalPrice(productId);
        })

        $('.cart-checkout-btn').click(function(e) {
            $('.quantity-textbox').each(function() {

                // https://stackoverflow.com/questions/19866509/jquery-get-an-element-by-its-data-id/19866970
                let productId = $(this).data('id');
                let quantity = parseInt($(this).val());

                let url = "{{ route('update.cart', ':productId') }}";
                url = url.replace(":productId", productId);

                console.log(url);

                // Save all changes to the cart
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}", //needed for 419 unknown status
                        product_id: productId,
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
