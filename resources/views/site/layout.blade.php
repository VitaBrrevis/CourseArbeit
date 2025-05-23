<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Интернет-магазин')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .container {
            flex: 1;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="/" class="text-white h3">Store</a>
            <div style="padding-left: 20px" class="dropdown me-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="pagesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Pages
                </button>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    @foreach(\App\Models\Page::query()->get() as $page)
                        <li><a class="dropdown-item" href="{{ route('pages.show', ['slug' => $page->slug]) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <a href="/profile" class="text-white me-3">Account</a>
            <a href="/cart" class="text-white">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
        </div>
    </div>
</header>

<div class="container mt-4">
    @yield('content')
</div>

<footer>
    <p>&copy; 2024 @Brrevq all rights reserved. </p>
</footer>

<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Item added to cart</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/cart" class="btn btn-primary">To checkout</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/cart.js') }}"></script>
@stack('scripts')
</body>
</html>
