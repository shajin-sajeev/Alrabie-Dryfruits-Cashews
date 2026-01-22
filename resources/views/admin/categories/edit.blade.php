@extends('layouts.admin')

@section('admin-title', 'Edit Category')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2rem;">Edit Category</h2>
    
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Category Image</label>
            <div class="file-upload">
                <input type="file" id="image" name="image" accept="image/*">
                <label for="image" class="file-upload-label">
                    📁 Click to upload or drag and drop
                    <br>
                    <small>PNG, JPG, GIF up to 2MB</small>
                </label>
            </div>
            @if ($category->image)
                <div class="image-preview">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                </div>
            @else
                <div class="image-preview"></div>
            @endif
            @error('image')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">Update Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    initializeImagePreview();
</script>
@endsection
