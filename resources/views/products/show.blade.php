@extends('layouts.app')

@section('content')
    <h1>Product details</h1>

    <ul class="nav nav-tabs" id="productDetailTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">
                Product info
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="attributes-tab" data-bs-toggle="tab" data-bs-target="#attributes" type="button" role="tab" aria-controls="attributes" aria-selected="false">
                Attributes
            </button>
        </li>
    </ul>

    <div class="tab-content" id="productDetailTabContent">
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="card mb-4 mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Category: {{ $item->category->name ?? 'Без категории' }}</h6>
                    <p class="card-text"><strong>Description:</strong> {{ $item->description }}</p>
                    <p class="card-text"><strong>Price:</strong> {{ number_format($item->price, 2) }}</p>
                    <p class="card-text"><strong>Article:</strong> {{ $item->article }}</p>
                    <p class="card-text"><strong>SLUG:</strong> {{ $item->slug }}</p>
                </div>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
            <div class="mt-3">
                <h3>Attributes</h3>

                @if($item->attributes->isEmpty())
                    <p>There are no attributes</p>
                @else
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->attributes as $attribute)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
