@extends('layouts.app')

@section('content')
    <h1>Pages</h1>

    <a href="{{ route('admin.pages.create') }}" class="btn btn-success mb-3">Create new page</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('admin.pages.show', $page->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">
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
        <p>There are no pages</p>
    @endif
@endsection
