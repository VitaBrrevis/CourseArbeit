@extends('site.layout')

@section('title', 'Cart')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h4>Checkout</h4>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <button type="submit" class="btn btn-primary">Order</button>
            </form>
        </div>

        <div class="col-md-6">
            <h4>Cart items</h4>
            @if (count($cart) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $productId => $item)
                        <tr>
                            <td><img src="{{ $item['product']->images()->first()->url ?? null }}" alt="{{ $item['product']->name }}" width="50"></td>
                            <td>{{ $item['product']->name }}</td>
                            <td>{{ $item['price'] }}$</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] * $item['quantity'] }}$</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h5>Total: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}$</h5>
            @else
                <p>Cart is empty</p>
            @endif
        </div>
    </div>
@endsection
