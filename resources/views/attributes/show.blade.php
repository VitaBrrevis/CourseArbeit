@extends('layouts.app')

@section('content')
    <h1>Attributes</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $item->id }}
    </div>

    <div class="mb-3">
        <strong>Title:</strong> {{ $item->name }}
    </div>

    <div class="mb-3">
        <strong>Value:</strong> {{ $item->value }}
    </div>


    <a href="{{ route('admin.attributes.edit', $item->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.attributes.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Back</a>
@endsection
