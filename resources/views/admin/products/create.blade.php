@extends('layouts.admin')

@section('admin-title', 'Create Product')
@section('admin-subtitle', 'Add a new product to your catalog')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2.5rem; color: var(--gray-900);">
        <i class="fas fa-plus-circle" style="color: var(--primary-green); margin-right: 0.75rem;"></i>
        Create New Product
    </h2>
    
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">
                <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                Product Name <span style="color: var(--danger);">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Premium Roasted Cashews" required>
            @error('name')
                <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">
                <i class="fas fa-align-left" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                Description
            </label>
            <textarea id="description" name="description" placeholder="Enter product description...">{{ old('description') }}</textarea>
            @error('description')
                <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category_id">
                    <i class="fas fa-folder" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                    Category <span style="color: var(--danger);">*</span>
                </label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Select a Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">
                    <i class="fas fa-dollar-sign" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                    Price (₹) <span style="color: var(--danger);">*</span>
                </label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" placeholder="0.00" required>
                @error('price')
                    <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="quantity">
                    <i class="fas fa-cubes" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                    Quantity <span style="color: var(--danger);">*</span>
                </label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', 0) }}" placeholder="0" required>
                @error('quantity')
                    <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">
                    <i class="fas fa-ruler" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                    Unit (kg, lbs, etc) <span style="color: var(--danger);">*</span>
                </label>
                <input type="text" id="unit" name="unit" value="{{ old('unit', 'kg') }}" placeholder="kg" required>
                @error('unit')
                    <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group form-full">
            <label for="image">
                <i class="fas fa-image" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                Product Image
            </label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                <label for="image" class="file-upload-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click to upload or drag and drop</span>
                    <small>PNG, JPG, GIF up to 2MB</small>
                </label>
            </div>
            <div class="image-preview"></div>
            @error('image')
                <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.querySelector('.image-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
