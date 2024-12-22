@extends('layouts.app')

@section('content')
    <h1>Order details</h1>

    <ul class="nav nav-tabs" id="orderDetailTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="order-info-tab" data-bs-toggle="tab" data-bs-target="#order-info" type="button" role="tab" aria-controls="order-info" aria-selected="true">
                Info
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-items-tab" data-bs-toggle="tab" data-bs-target="#order-items" type="button" role="tab" aria-controls="order-items" aria-selected="false">
                Products
            </button>
        </li>
    </ul>

    <div class="tab-content" id="orderDetailTabContent">
        <div class="tab-pane fade show active" id="order-info" role="tabpanel" aria-labelledby="order-info-tab">
            <div class="card mb-4 mt-3">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $item->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Status: {{ $item->status }}</h6>
                    <p class="card-text"><strong>Customer name:</strong> {{ $item->name }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $item->phone }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $item->email }}</p>
                    <p class="card-text"><strong>Address:</strong> {{ $item->address }}</p>
                    <p class="card-text"><strong>Total price:</strong> {{ number_format($item->total_price, 2) }}</p>
                    <p class="card-text"><strong>Creation date:</strong> {{ $item->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.orders.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.orders.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wan to delete this order?')">Delete</button>
                </form>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="tab-pane fade" id="order-items" role="tabpanel" aria-labelledby="order-items-tab">
            <div class="mt-3">
                <h3>Items</h3>

                @if($item->items->isEmpty())
                    <p>There are no items</p>
                @else
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Price per item</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->name ?? 'Item deletes' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
