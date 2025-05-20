@extends('layouts.app')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)
                                <li data-filter=".{{ $category->name }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row product-lists">
                @foreach ($products as $product)
                    {{-- @dd($product->category->name) --}}
                    <div class="col-lg-4 col-md-6 text-center {{ $product->category->name }}">
                        <div class="single-product-item" >
                            <div class="product-image" >
                               <img src="{{ Storage::url($product->image) }}" alt="">
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-price"><span>Per Kg</span> {{ $product->price }}$ </p>
                            <a href="" data-product-id="{{ $product->id }}" class="addToCart cart-btn"><i
                                    class="fas fa-shopping-cart"></i> Add to Cart</a>
                            <div id="addedMessage_{{ $product->id }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {

                    @auth
                    var userId = {{ auth()->user()->id }};
                @else
                    var userId = null;
                @endauth
                $('.addToCart').click(function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');
                    var messageDiv = $('#addedMessage_' + productId);
                    if (userId) {
                        // alert(userId);
                        $.ajax({
                            url: "{{ route('addToCart') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                product_id: productId,
                                user_id: userId,
                                quantity: 1
                            },
                            success: function(response) {
                                // Show the "Added" message for the corresponding product
                                messageDiv.text(response.message);
                                messageDiv.show();

                                // Hide the message after 30 seconds
                                setTimeout(function() {
                                    messageDiv.hide();
                                }, 3000);
                            },
                            error: function(xhr) {
                                // Handle errors here
                                alert(
                                    'An error occurred while adding the product to the cart!!');
                            }

                        });
                    } else {
                        alert('please login to add items to the cart!')
                    }
                });
                });
            </script>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class=" d-flex justify-content-center">
                        {{-- <div class="pagination-wrap d-flex justify-content-center"> --}}
                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection
