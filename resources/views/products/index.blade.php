@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Title:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by name" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="article" class="form-label">Article:</label>
                <input type="text" id="article" name="article" value="{{ request('article') }}" placeholder="Search by article" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="category_name" class="form-label">Category:</label>
                <select id="category_name" name="category_id" class="form-select">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Create new product</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name ?? 'Без категории' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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
        <p>There are no products.</p>
    @endif
@endsection
