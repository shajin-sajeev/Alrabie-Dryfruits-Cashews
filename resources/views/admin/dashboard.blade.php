@extends('layouts.admin')

@section('admin-title', 'Dashboard')

@section('admin-content')

<div class="dashboard-cards">
    <div class="stat-card">
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $totalProducts }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Categories</div>
        <div class="stat-value">{{ $totalCategories }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Admin Users</div>
        <div class="stat-value">{{ $totalAdmins }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">₪0</div>
    </div>
</div>

<div style="margin-top: 3rem;">
    <h2 style="margin-bottom: 1.5rem;">Recent Products</h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
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
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>₪{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }} {{ $product->unit }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No products yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">View All Products</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-secondary">Add New Product</a>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        animateStats();
    });
</script>
@endsection
