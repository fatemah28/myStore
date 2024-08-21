@extends('layouts.BillTemplate')
@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemsForAuthUser as $item)
                                    <tr class="table-body-row">
                                        <td class="product-name">{{ $item->product->name }}</td>
                                        <td class="product-price ">${{ $item->product->price }}</td>
                                        <td class="product-quantity">
                                                 {{ $item->quantity }}</td>
                                        <td class="product-total" id="product-total-{{ $item->id }}">
                                            {{ $item->product->price * $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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
                                    <td id="data-total-item">{{ $itemsForAuthUser->sum(function ($item) {
                                        return $item->quantity * $item->price;
                                    }) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
