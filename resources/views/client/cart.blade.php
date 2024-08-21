@extends('layouts.app')
@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150" id="cart-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cart) > 0)
                                    @foreach ($cart as $item)
                                        @php
                                            $subtotal = $item->quantity * $item->price;
                                        @endphp
                                        <tr class="table-body-row" id="cart-item-{{ $item->id }}">
                                            <td class="product-remove "><a class="product-remove-item"
                                                    data-item-id={{ $item->id }} href=""
                                                    id="removeItem-{{ $item->id }}"><i
                                                        class="far fa-window-close"></i></a>
                                            </td>
                                            <td class="product-image"><img src="{{ Storage::url($item->product->image) }}"
                                                    alt=""></td>
                                            <td class="product-name">{{ $item->product->name }}</td>
                                            <td class="product-price ">${{ $item->product->price }}</td>
                                            <td class="product-quantity"><input type="number" class="product-quantity-item"
                                                    data-item-price={{ $item->product->price }}
                                                    data-item-id={{ $item->id }} value="{{ $item->quantity }}"
                                                    name="" placeholder="1"></td>
                                            <td class="product-total" id="product-total-{{ $item->id }}">
                                                {{ $item->product->price * $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">The Cart is Empty!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                    <div id="removeMessage"></div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td id="data-total-item"></td>
                                </tr>
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                var totalDataItem = $('#data-total-item');

                                var totalSum =
                                    {{ $cart->sum(function ($item) {
                                        return $item->quantity * $item->price;
                                    }) }}
                                totalDataItem.text('$' + totalSum);
                                function updateCartTable() {
                                    $.ajax({
                                        url: "{{ route('cart.update') }}",
                                        method: 'GET',
                                        success: function(response) {
                                            if (response.status === 'success') {
                                                $('#cart-container').html(response.html); // Replace cart table with new data
                                            } else {
                                                alert('Failed to update cart.');
                                            }
                                        },
                                        error: function(xhr) {
                                            alert('An error occurred while updating the cart.');
                                        }
                                    });
                                }
                                $('.product-quantity-item').on('input', function(e) {
                                    e.preventDefault();
                                    var quantity = $(this).val();
                                    var itemId = $(this).data('item-id');
                                    var itemPrice = $(this).data('item-price');
                                    var productTotal = $('#product-total-' + itemId);
                                    $.ajax({
                                        url: "{{ route('updateCart') }}",
                                        method: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            item_id: itemId,
                                            quantity: quantity
                                        },
                                        success: function(response) {
                                            // Show the "Added" message for the corresponding product
                                            productTotal.text(quantity * itemPrice)
                                            totalDataItem.text('$' + response.totalSum);

                                        },
                                        error: function(xhr) {
                                            // Handle errors here
                                            alert(
                                                'An error occurred while updating the cart!!');
                                        }

                                    });
                                });
                                $('.product-remove-item').click(function(e) {
                                    e.preventDefault();
                                    var messageDiv = $('#removeMessage');
                                    var itemId = $(this).data('item-id');
                                    $.ajax({
                                        url: "{{ route('removeItem') }}",
                                        method: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            item_id: itemId,
                                        },
                                        success: function(response) {
                                            if (response.status === 'success') {
                                                // alert('done');
                                                updateCartTable(); // Refresh the entire cart table after deletion
                                            } else {
                                                alert(response.message);
                                            }
                                            // messageDiv.text(response.message);
                                            // messageDiv.show();
                                        },
                                        error: function(xhr) {
                                            // Handle errors here
                                            alert(
                                                'An error occurred while Deleting the item!!');
                                        }

                                    });
                                });

                               
                            });
                        </script>
                        <div class="cart-buttons">

                            <a href="{{ route('downloadPdf') }}" class="boxed-btn black">Print The Bill</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
