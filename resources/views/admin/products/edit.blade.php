@extends('layouts.admin')

@section('admin-title', 'Edit Product')
@section('admin-subtitle', 'Update product information')

@section('admin-content')

<div class="form-card">
    <header style="text-align: center; margin-bottom: 3rem;">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--primary-light); color: var(--primary-color); border-radius: 20px; font-size: 1.5rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
            <i class="fas fa-pen-to-square"></i>
        </div>
        <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">Edit Product</h2>
        <p style="color: var(--text-muted); font-size: 0.95rem;">Update the details for <strong>{{ $product->name }}</strong>.</p>
    </header>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">
                <i class="fas fa-tag"></i>
                Product Name <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="e.g., Premium Roasted Cashews" required autofocus>
            @error('name')
            <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fas fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">
                <i class="fas fa-align-left"></i>
                Description
            </label>
            <textarea id="description" name="description" placeholder="Provide a detailed description of the product...">{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fas fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category_id">
                    <i class="fas fa-folder"></i>
                    Category <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
                </label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">
                    <i class="fas fa-indian-rupee-sign"></i>
                    Price <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
                </label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" placeholder="0.00" required>
                @error('price')
                <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="quantity">
                    <i class="fas fa-boxes-stacked"></i>
                    Stock Quantity <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
                </label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" placeholder="0" required>
                @error('quantity')
                <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">
                    <i class="fas fa-weight-hanging"></i>
                    Unit <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
                </label>
                <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit) }}" placeholder="e.g., kg, gm, packet" required>
                @error('unit')
                <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">
                <i class="fas fa-image"></i>
                Product Image
            </label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                <label for="image" class="file-upload-label">
                    <i class="fas fa-cloud-arrow-up"></i>
                    <span>Change Product Image</span>
                    <small>Leave empty to keep current image</small>
                </label>
            </div>

            <div class="image-preview" id="image-preview-container" style="{{ $product->image ? 'display: block;' : '' }}">
                @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                @endif
            </div>

            @error('image')
            <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fas fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-check-double"></i>
                Save Changes
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                <i class="fas fa-xmark"></i>
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview-container');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                preview.style.display = 'block';
                preview.style.animation = 'fadeIn 0.3s ease-out';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection