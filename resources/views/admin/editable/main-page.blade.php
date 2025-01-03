<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .category-item {
            margin-bottom: 10px;
        }
        .product-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="/" class="text-white h3">Store</a>
        </div>
        <div>
            <a href="/profile" class="text-white me-3">Account</a>
            <a href="/cart" class="text-white">
                <i class="fas fa-shopping-cart"></i>Cart
            </a>
        </div>
    </div>
</header>

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

<div class="container mt-4">
    <div class="row">
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
                            <a href="/product/{{ $product->slug }}" class="text-decoration-none">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}$</p>
                                    <a href="#" class="btn btn-primary">Add to cart</a>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 @Brrevq all rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
