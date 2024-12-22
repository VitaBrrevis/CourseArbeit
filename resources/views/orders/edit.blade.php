@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit an order</h1>

    <form method="POST" action="{{ route('admin.orders.update', $item->id) }}" class="row g-3">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There are errors occurred:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-6">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $item->phone) }}" required class="form-control @error('phone') is-invalid @enderror">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $item->email) }}" required class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12">
            <label for="address" class="form-label">Address:</label>
            <textarea id="address" name="address" rows="3" required class="form-control @error('address') is-invalid @enderror">{{ old('address', $item->address) }}</textarea>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Choose the status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $item->status) == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="total_price" class="form-label">Total price:</label>
            <input type="number" id="total_price" name="total_price" value="{{ old('total_price', $item->total_price) }}" step="0.01" required class="form-control @error('total_price') is-invalid @enderror">
            @error('total_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
@endsection
