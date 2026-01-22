@extends('layouts.admin')

@section('admin-title', 'Products')
@section('admin-subtitle', 'Manage your product inventory')

@section('admin-content')

<div class="section-header">
    <h2 class="section-title">
        <i class="fas fa-box"></i>
        All Products
    </h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        <strong style="color: var(--primary-green);">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</strong>
                    </td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div style="width: 50px; height: 50px; background: var(--gray-200); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: var(--gray-400);"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        <br>
                        <small style="color: var(--gray-500);">{{ $product->unit }}</small>
                    </td>
                    <td>
                        <span style="background: var(--primary-light); color: var(--primary-dark); padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td>
                        <strong style="color: var(--primary-green); font-size: 1.1rem;">₹{{ number_format($product->price, 2) }}</strong>
                    </td>
                    <td>
                        @if($product->quantity > 0)
                            <span style="background: #d1fae5; color: #065f46; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                {{ $product->quantity }}
                            </span>
                        @else
                            <span style="background: #fee2e2; color: #7f1d1d; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                Out of Stock
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn-delete-ajax" data-url="{{ route('admin.products.destroy', $product->id) }}" data-item-name="{{ $product->name }}" data-item-type="product">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <p class="empty-state-text">No products yet</p>
                            <p class="empty-state-subtext">Start adding products to build your catalog</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if ($products->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </div>
        {{ $products->links() }}
    </div>
@endif

@endsection
