@extends('layouts.app')

@section('content')
    <h1>Attributes</h1>

    <form method="GET" action="{{ route('admin.attributes.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Title:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by name"
                       class="form-control">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filer</button>
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.attributes.create') }}" class="btn btn-success mb-3">Create new attribute</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->value }}</td>
                    <td>
                        <a href="{{ route('admin.attributes.show', $attribute->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Aro you sure?')">
                                Delete
                            </button>
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
        <p>There are no attributes.</p>
    @endif
@endsection
