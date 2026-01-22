@extends('layouts.admin')

@section('admin-title', 'Dashboard')
@section('admin-subtitle', 'Monitor your store performance and statistics')

@section('admin-content')

<!-- Stats Grid -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $totalProducts }}</div>
        <div class="stat-change">
            <i class="fas fa-arrow-up"></i> All active products
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-folder"></i>
        </div>
        <div class="stat-label">Total Categories</div>
        <div class="stat-value">{{ $totalCategories }}</div>
        <div class="stat-change">
            <i class="fas fa-arrow-up"></i> Product organization
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-label">Admin Users</div>
        <div class="stat-value">{{ $totalAdmins }}</div>
        <div class="stat-change">
            <i class="fas fa-check-circle"></i> Active administrators
        </div>
    </div>
</div>

<div style="margin-top: 3rem;">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-history" style="margin-right: 0.75rem; color: var(--primary-green);"></i>
            Recent Products
        </h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-small">
            <i class="fas fa-plus"></i> View All
        </a>
    </div>
    
    <div class="table-container">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentProducts as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <div style="width: 50px; height: 50px; background: var(--gray-200); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="color: var(--gray-400);"></i>
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>
                                <span style="background: var(--primary-light); color: var(--primary-dark); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td><strong>₹{{ number_format($product->price, 2) }}</strong></td>
                            <td>
                                <span>{{ $product->quantity }} {{ $product->unit }}</span>
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
                                    <i class="fas fa-inbox"></i>
                                    <p class="empty-state-text">No products yet</p>
                                    <p class="empty-state-subtext">Start by creating your first product</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>
</div>

@endsection
