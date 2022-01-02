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
                @foreach($products as $id => $product)
                    @php $total += $product['price'] * $product['quantity'] @endphp
                    <tr>
                        <td>
                            <img src="{{ $product['image'] }}" class="img-fluid rounded"/>
                        </td>
                        <td>{{ $product['item']['name'] }}</td>
                        <td>
                            RM 
                            <span class="unit-price" id="{{ $id }}">
                                {{ number_format($product['price'],2) }}
                            </span>
                        </td>
                        <td>
                            <div class="quantity-btn">
                                <span class="minus">-</span>
                                <input type="number" 
                                    value="{{ $product['quantity'] }}" 
                                    class="quantity update-cart"
                                    data-id="{{ $id }}"
                                    id="{{ $id }}">
                                <span class="plus">+</span>
                            </div>
                        </td>
                        <td>
                            <div class="total-price" id="{{ $id }}">
                                RM {{ number_format($product['price'] * $product['quantity'],2) }}
                            </div>   
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
                    <td colspan="6" class="text-right">
                        <h3><strong>Total: RM{{ number_format($total,2) }}</strong></h3>
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

        function updateTotalPrice(productId){
            let unitPrice = parseFloat($(`#${productId}.unit-price`).text().trim());
            let quantity = parseInt($(`#${productId}.quantity`).val());
            let totalPrice = unitPrice * quantity;
            let result = totalPrice ? totalPrice : 0
            $(`#${productId}.total-price`).text(`RM ${result.toFixed(2)}`);
        }

        // Defaults the value to 0 if empty input
        $(`.quantity`).blur(function(){
            if($(this).val().trim().length === 0){
                $(this).val(1);
            }
        })
        
        $('.update-cart').keyup(function(e){
            let productId = $(this).attr('id');
            updateTotalPrice(productId);

            // $.ajax({
            //     url: "{{ route('update.cart') }}",
            //     type: 'post',
            //     data: {
            //         _token: "{{ csrf_token() }}", //needed for 419 unknown status
            //         id: productId,
            //         quantity: quantity
            //     },
            //     success: function(response) {
            //         window.location.reload();
            //     }
            // });
        })

        $('.minus').click(function(){
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) - 1;

            quantity = quantity < 1 ? 1 : quantity
            inputElem.val(quantity);
            let productId = inputElem.attr('id');
            updateTotalPrice(productId);
        })

        $('.plus').click(function(){
            let inputElem = $(this).parent().find('input');
            let quantity = parseInt(inputElem.val()) + 1;

            inputElem.val(quantity);

            let productId = inputElem.attr('id');
            updateTotalPrice(productId);
        })
    </script>
@endpush