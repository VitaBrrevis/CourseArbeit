@extends('site.layout')

@section('title', 'Products')

@section('content')
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <h4>Categories</h4>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item category-item">
                        <a href="/category/{{ $category->slug }}" class="text-decoration-none">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-9">
            <h4>Products</h4>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card product-card">
                            <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="text-decoration-none">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}$</p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">Add to cart</button>
                                        @auth
                                            <button class="btn btn-outline-secondary add-to-wishlist" data-product-id="{{ $product->id }}">Wishlist</button>
                                        @endauth
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();

                var productId = $(this).data('product-id');
                var quantity = 1;

                $.ajax({
                    url: '/cart/add/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity,
                    },
                    success: function(response) {
                        $('.cart-count').text(response.cart_count);
                        $('#addToCartModal').modal('show');
                    },
                    error: function() {
                        alert('Error occurred. Try again later');
                    }
                });
            });

            $('.add-to-wishlist').on('click', function(e) {
                e.preventDefault();

                var productId = $(this).data('product-id');

                $.ajax({
                    url: '/wishlist/add/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('Added to wishlist');
                    },
                    error: function() {
                        alert('Error occurred. Try again later');
                    }
                });
            });
        });
    </script>
@endpush