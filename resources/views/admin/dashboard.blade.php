@extends('layouts.admin')

@section('admin-title', 'Market Overview')
@section('admin-subtitle', 'Track your business metrics and recent inventory activity')

@section('admin-content')

<!-- Statistics Section -->
<div class="dashboard-grid">
    <!-- Total Products -->
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-boxes-stacked"></i>
        </div>
        <div class="stat-label">Total Inventory</div>
        <div class="stat-value">{{ number_format($totalProducts) }}</div>
        <div class="stat-change up">
            <i class="fas fa-check-circle"></i>
            <span>All systems active</span>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: var(--info);">
            <i class="fas fa-tags"></i>
        </div>
        <div class="stat-label">Product Categories</div>
        <div class="stat-value">{{ number_format($totalCategories) }}</div>
        <div class="stat-change neutral">
            <i class="fas fa-info-circle"></i>
            <span>Organized catalog</span>
        </div>
    </div>

    <!-- Admin Users -->
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.1); color: var(--accent-color);">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="stat-label">System Admins</div>
        <div class="stat-value">{{ number_format($totalAdmins) }}</div>
        <div class="stat-change up">
            <i class="fas fa-shield-check"></i>
            <span>Secure access</span>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div style="margin-top: 2.5rem;">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-clock-rotate-left"></i>
            Recently Added Products
        </h2>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-small">
                <i class="fas fa-plus"></i> Add New
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-small" style="background: var(--bg-sidebar); border: 1px solid var(--border-color); color: var(--text-muted);">
                View All
            </a>
        </div>
    </div>

    <div class="table-container shadow-sm">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 100px;">Preview</th>
                    <th>Product Details</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock Level</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentProducts as $product)
                <tr>
                    <td style="font-weight: 600; color: var(--text-muted);">#{{ $product->id }}</td>
                    <td>
                        @if ($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        @else
                        <div style="width: 48px; height: 48px; background: var(--bg-main); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; border: 1px dashed var(--border-color);">
                            <i class="fas fa-image" style="color: var(--text-muted); font-size: 1.25rem;"></i>
                        </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ $product->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">Ref: {{ Str::upper(Str::random(8)) }}</div>
                    </td>
                    <td>
                        <span style="background: var(--primary-light); color: var(--primary-dark); padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase;">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 800; color: var(--primary-dark); font-size: 1.1rem;">₹{{ number_format($product->price, 2) }}</div>
                    </td>
                    <td>
                        @if($product->quantity > 10)
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-weight: 600;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--success);"></div>
                            {{ $product->quantity }} {{ $product->unit }}
                        </div>
                        @elseif($product->quantity > 0)
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--warning); font-weight: 600;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--warning);"></div>
                            Low Stock ({{ $product->quantity }})
                        </div>
                        @else
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--danger); font-weight: 600;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--danger);"></div>
                            Out of Stock
                        </div>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                            <a href="{{ route('admin.products.edit', $product->id) }}" title="Edit Product" style="width: 34px; height: 34px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; background: var(--primary-light); color: var(--primary-dark); transition: all 0.2s;">
                                <i class="fas fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn-delete-ajax" data-url="{{ route('admin.products.destroy', $product->id) }}" data-item-name="{{ $product->name }}" data-item-type="product" title="Delete Product" style="width: 34px; height: 34px; border-radius: var(--radius-md); border: none; display: flex; align-items: center; justify-content: center; background: #fee2e2; color: var(--danger); transition: all 0.2s; cursor: pointer;">
                                <i class="fas fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div style="padding: 4rem 2rem; text-align: center;">
                            <div style="width: 64px; height: 64px; background: var(--bg-main); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                <i class="fas fa-box-open" style="font-size: 2rem; color: var(--text-muted);"></i>
                            </div>
                            <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">No products found</h3>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Get started by adding your first product to the inventory.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection