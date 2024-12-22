@extends('layouts.app')

@section('content')
    <h1>Details</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $item->id }}
    </div>

    <div class="mb-3">
        <strong>Title:</strong> {{ $item->name }}
    </div>

    <div class="mb-3">
        <strong>Parent category:</strong> {{ $item->parent->name ?? 'No' }}
    </div>

    <div class="mb-3">
        <strong>Active:</strong> {{ $item->published ? 'Yes' : 'No' }}
    </div>

    <div class="mb-3">
        <strong>Sort order:</strong> {{ $item->sort }}
    </div>

    @if ($item->image)
        <div class="mb-3">
            <strong>Image:</strong><br>
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 200px;">
        </div>
    @endif

    <a href="{{ route('admin.categories.edit', $item->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Delete</button>
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
@endsection
