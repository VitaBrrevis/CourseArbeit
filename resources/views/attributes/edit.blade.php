@extends('layouts.app')

@section('content')
    <h1>Edit attribue</h1>

    <form method="POST" action="{{ route('admin.attributes.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Errors occurred:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Title:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value:</label>
            <input type="text" id="value" name="value" value="{{ old('value', $item->value) }}" required class="form-control @error('value') is-invalid @enderror">
            @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
