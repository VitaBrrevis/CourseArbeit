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
            <h4>Filters</h4>
            <form method="GET" action="{{ route('categories.show', ['category' => $category->id]) }}">
                <div class="mb-3">
                    <label for="searchName" class="form-label">Search by name</label>
                    <input type="text" id="searchName" name="name" class="form-control" placeholder="Enter the name">
                </div>
                <div class="mb-3">
                    <label for="searchSku" class="form-label">Search by article</label>
                    <input type="text" id="searchSku" name="article" class="form-control" placeholder="Enter the article">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category_id" class="form-select">
                        <option value="">All categories</option>
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="priceRange" class="form-label">Price range</label>
                    <input type="number" name="min_price" class="form-control mb-2" placeholder="Min">
                    <input type="number" name="max_price" class="form-control" placeholder="Max">
                </div>
                <div class="mb-3">
                    <label for="sortBy" class="form-label">Sort by</label>
                    <select id="sortBy" name="sort" class="form-select">
                        <option value="price_asc">Price: ascending</option>
                        <option value="price_desc">Price: descending</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Apply</button>
            </form>
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
