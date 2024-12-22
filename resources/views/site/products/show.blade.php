@extends('site.layout')

@section('title', $product->name)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <img src="{{ $product->images->first()?->url }}" alt="{{ $product->name }}" class="img-fluid" />
            </div>
            <h3>{{ $product->name }}</h3>
            <p class="text-muted">{{ $product->article }}</p>
            <p>{{ $product->description }}</p>
            <h4>{{ $product->price }}$</h4>
            <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">Add to cart</button>
        </div>

        <div class="col-md-8">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Main information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Gallery</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="attributes-tab" data-bs-toggle="tab" href="#attributes" role="tab" aria-controls="attributes" aria-selected="false">Attributes</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="productTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <h5>Description</h5>
                    <p>{{ $product->description }}</p>
                    <h5>Price</h5>
                    <p>{{ $product->price }}$</p>
                    <h5>Article</h5>
                    <p>{{ $product->article }}</p>
                </div>

                <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ $image->url }}" alt="{{ $product->name }} - Фото" class="img-fluid" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
                    <h5>Product attributes</h5>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->attributes as $attribute)
                            <tr>
                                <td><strong>{{ $attribute->name }}</strong></td>
                                <td>{{ $attribute->value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <h5>Reviews</h5>
                    <p>Reviews will be here soon</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endpush

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
                        alert('Item added to wishlist');
                    },
                    error: function() {
                        alert('Error occurred. Try again later');
                    }
                });
            });
        });
    </script>
@endpush