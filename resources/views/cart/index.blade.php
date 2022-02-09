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
                            <span class="cart-unit-total-price" id="{{ $product->id }}">
                                {{ presentPrice($product->price * $product->pivot->quantity) }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-5 ml-auto">
                <div class="cart-total-section">
                    <h2 class="text-center">Cart Total</h2>
                    <ul>
                        <li>
                            Subtotal
                            <span class="float-right cart-subtotal-price">
                                {{ presentPrice($cart->subtotal) }}
                            </span>
                        </li>
                        <li>
                            Tax (10%)
                            <span class="float-right cart-tax-value">
                                {{ presentPrice($cart->tax_value) }}
                            </span>
                        </li>
                        <li>
                            Total
                            <span class="float-right cart-total-price">
                                {{ presentPrice($cart->total) }}
                            </span>
                        </li>
                    </ul>
                    <div class="cart-checkout-btn">
                        <button type="button" class="btn btn-success float-right">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
            let unitPrice = parseFloat($(`#${productId}.cart-unit-price`).text().trim().replace(/[^\d.]/g, ''));
            let quantity = parseInt($(`#${productId}.quantity-textbox`).val());
            let totalPrice = unitPrice * quantity;
            let result = totalPrice ? totalPrice : unitPrice
            $(`#${productId}.cart-unit-total-price`).text(`RM ${result.toFixed(2)}`);

            // Sum up the total price
            subtotal = 0;
            $('.cart-unit-total-price').each(function() {
                subtotal += parseFloat($(this).text().trim().replace(/[^\d.]/g, ''));
            })

            tax_value = (subtotal / 100) * 10
            total = subtotal + tax_value

            $('.cart-subtotal-price').text(`RM ${subtotal.toFixed(2)}`);
            $('.cart-tax-value').text(`RM ${tax_value.toFixed(2)}`);
            $('.cart-total-price').text(`RM ${total.toFixed(2)}`);
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

                let url = "{{ route('cart.update', ':productId') }}";
                url = url.replace(":productId", productId);

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
                        window.location.href = "{{ route('checkout.index') }}"
                    }
                })
            })
        })
    </script>
@endpush
