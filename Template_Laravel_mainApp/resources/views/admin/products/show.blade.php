@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <h1 class="mb-0">{{ $product->title }}</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Description:</strong></p>
                    <p>{{ $product->description }}</p>

                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                </div>
                <div class="col-md-6">
                    @if($product->img_path)
                        <img src="{{ asset($product->img_path) }}" 
                             alt="Product Image" 
                             class="img-fluid rounded shadow"
                             style="max-width: 90%; height: auto;">
                    @else
                        <div class="alert alert-secondary">No image available</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>
</div>
@endsection
