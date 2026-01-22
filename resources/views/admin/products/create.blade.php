@extends('layouts.admin')

@section('admin-title', 'Create Product')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2rem;">Create New Product</h2>
    
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
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
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price (₪) *</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                @error('price')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label for="quantity">Quantity *</label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', 0) }}" required>
                @error('quantity')
                    <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">Unit (kg, lbs, etc) *</label>
                <input type="text" id="unit" name="unit" value="{{ old('unit', 'kg') }}" required>
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
            <div class="image-preview"></div>
            @error('image')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">Create Product</button>
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
