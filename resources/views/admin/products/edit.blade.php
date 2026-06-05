@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product: {{ $product->name }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="discount_price" class="form-label">Discount Price ($) [Optional]</label>
                                <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$product->image_path) }}" width="100" alt="Current Image">
                                </div>
                            @endif
                            <input class="form-control" type="file" id="image" name="image">
                            <small class="text-muted">Leave empty to keep the current image.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
