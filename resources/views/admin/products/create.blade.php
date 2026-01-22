@extends('layouts.admin')

@section('admin-title', 'Create Product')
@section('admin-subtitle', 'Add a new product to your catalog')

@section('admin-content')

<div class="form-card">
    <header style="text-align: center; margin-bottom: 3rem;">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--primary-light); color: var(--primary-color); border-radius: 20px; font-size: 1.5rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
            <i class="fas fa-plus"></i>
        </div>
        <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">New Product</h2>
        <p style="color: var(--text-muted); font-size: 0.95rem;">Please fill in the details below to create a new product entry.</p>
    </header>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">
                <i class="fas fa-tag"></i>
                Product Name <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Premium Roasted Cashews" required autofocus>
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
            <textarea id="description" name="description" placeholder="Provide a detailed description of the product...">{{ old('description') }}</textarea>
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
                    <option value="" disabled selected>Select a Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ $category->name }}</option>
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
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" placeholder="0.00" required>
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
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', 0) }}" placeholder="0" required>
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
                <input type="text" id="unit" name="unit" value="{{ old('unit', 'kg') }}" placeholder="e.g., kg, gm, packet" required>
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
                    <span>Click to upload or drag & drop</span>
                    <small>High quality PNG, JPG (Max 2MB)</small>
                </label>
            </div>
            <div class="image-preview" id="image-preview-container"></div>
            @error('image')
            <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fas fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i>
                Create Product
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
        } else {
            preview.style.display = 'none';
            preview.innerHTML = '';
        }
    }
</script>
@endsection