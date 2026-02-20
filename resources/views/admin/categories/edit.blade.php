@extends('layouts.admin')

@section('admin-title', 'Edit Category')
@section('admin-subtitle', 'Update category information')

@section('admin-content')

<div class="form-card">
    <header style="text-align: center; margin-bottom: 3rem;">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--primary-light); color: var(--primary-color); border-radius: 20px; font-size: 1.5rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
            <i class="fas fa-folder-open"></i>
        </div>
        <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">Edit Category</h2>
        <p style="color: var(--text-muted); font-size: 0.95rem;">Update the details for <strong>{{ $category->name }}</strong>.</p>
    </header>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">
                <i class="fas fa-tag"></i>
                Category Name <span style="color: var(--danger); margin-left: 0.25rem;">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g., Premium Cashews" required autofocus>
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
            <textarea id="description" name="description" placeholder="Provide a brief description of this category...">{{ old('description', $category->description) }}</textarea>
            @error('description')
            <div style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fas fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">
                <i class="fas fa-image"></i>
                Category Image
            </label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                <label for="image" class="file-upload-label">
                    <i class="fas fa-cloud-arrow-up"></i>
                    <span>Change Category Image</span>
                    <small>Leave empty to keep current image</small>
                </label>
            </div>

            <div class="image-preview" id="image-preview-container" style="{{ $category->image ? 'display: block;' : '' }}">
                @if ($category->image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="{{ $category->name }}">
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
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
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