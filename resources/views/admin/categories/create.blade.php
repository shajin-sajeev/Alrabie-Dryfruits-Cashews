@extends('layouts.admin')

@section('admin-title', 'Create Category')

@section('admin-content')

<div class="form-card">
    <h2 style="text-align: center; margin-bottom: 2rem;">Create New Category</h2>
    
    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Category Name *</label>
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
            <div class="image-preview"></div>
            @error('image')
                <span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">Create Category</button>
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
