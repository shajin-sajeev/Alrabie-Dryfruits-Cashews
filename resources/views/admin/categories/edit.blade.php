@extends('layouts.admin')

@section('admin-title', 'Edit Category')
@section('admin-subtitle', 'Update category information')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2.5rem; color: var(--gray-900);">
        <i class="fas fa-edit" style="color: var(--primary-green); margin-right: 0.75rem;"></i>
        Edit Category
    </h2>
    
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">
                <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                Category Name <span style="color: var(--danger);">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g., Fresh Cashews" required>
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
            <textarea id="description" name="description" placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">
                <i class="fas fa-image" style="margin-right: 0.5rem; color: var(--primary-green);"></i>
                Category Image
            </label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                <label for="image" class="file-upload-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click to upload or drag and drop</span>
                    <small>PNG, JPG, GIF up to 2MB</small>
                </label>
            </div>
            @if ($category->image)
                <div class="image-preview" style="display: block;">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                </div>
            @else
                <div class="image-preview"></div>
            @endif
            @error('image')
                <span style="color: var(--danger); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Update Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
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
