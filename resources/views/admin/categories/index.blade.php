@extends('layouts.admin')

@section('admin-title', 'Categories')
@section('admin-subtitle', 'Manage your product categories')

@section('admin-content')

<div class="section-header">
    <h2 class="section-title">
        <i class="fas fa-folder"></i>
        All Categories
    </h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>
                    <strong style="color: var(--primary-dark);">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</strong>
                </td>
                <td>
                    @if ($category->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="{{ $category->name }}">
                    @else
                    <div style="width: 48px; height: 48px; background: var(--bg-main); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; border: 1px dashed var(--border-color);">
                        <i class="fas fa-image" style="color: var(--text-muted);"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $category->name }}</strong>
                </td>
                <td>
                    <div class="description-cell" title="{{ $category->description }}">
                        {{ Str::limit($category->description, 80) }}
                    </div>
                </td>
                <td>
                    <span style="background: var(--primary-light); color: var(--primary-dark); padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                        {{ $category->products()->count() }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit" title="Edit Category">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn-delete-ajax" data-url="{{ route('admin.categories.destroy', $category->id) }}" data-item-name="{{ $category->name }}" data-item-type="category" title="Delete Category">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p class="empty-state-text">No categories yet</p>
                        <p class="empty-state-subtext">Create your first category to get started</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>

<!-- Pagination -->
@if ($categories->hasPages())
<div class="pagination-wrapper">
    <div class="pagination-info">
        Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories
    </div>
    {{ $categories->links('vendor.pagination.admin') }}
</div>
@endif

@endsection