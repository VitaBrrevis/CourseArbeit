@extends('layouts.app')

@section('content')
    <h1>Orders</h1>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by name" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="{{ request('email') }}" placeholder="Search by email" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ request('phone') }}" placeholder="Search by phone" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" value="{{ request('address') }}" placeholder="Search by address" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $key => $status)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-success mb-3">Create new order</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Status</th>
                <th>Total price</th>
                <th>sctions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    @else
        <p>There are no orders</p>
    @endif
@endsection
