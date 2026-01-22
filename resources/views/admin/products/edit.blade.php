@extends('layouts.admin')

@section('admin-title', 'Edit Product')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2rem;">Edit Product</h2>
    
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label for="category_id">Category *</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price (₪) *</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label for="quantity">Quantity *</label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required>
                @error('quantity')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">Unit (kg, lbs, etc) *</label>
                <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit) }}" required>
                @error('unit')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*">
                <label for="image" class="file-upload-label">
                    📁 Click to upload or drag and drop
                    <br>
                    <small>PNG, JPG, GIF up to 2MB</small>
                </label>
            </div>
            @if ($product->image)
                <div class="image-preview">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>
            @else
                <div class="image-preview"></div>
            @endif
            @error('image')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    initializeImagePreview();
</script>
@endsection
