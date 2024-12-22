@extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Category title:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by title" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="parent_id" class="form-label">Parent category:</label>
                <select id="parent_id" name="parent_id" class="form-select">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('parent_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Create new category</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Parent category</th>
                <th>Active</th>
                <th>Sort order</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent->name ?? 'Нет' }}</td>
                    <td>{{ $category->published ? 'Да' : 'Нет' }}</td>
                    <td>{{ $category->sort }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
        <p>There are no categories</p>
    @endif
@endsection
