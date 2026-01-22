@extends('layouts.admin')

@section('admin-title', 'Products')

@section('admin-content')

<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
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
                <th>Quantity</th>
                <th>Unit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ ($products->currentPage() - 1) * 10 + $loop->iteration }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 50px; max-height: 50px; border-radius: 5px;">
                        @else
                            <span style="color: var(--text-muted);">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>₪{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->unit }}</td>
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
                    <td colspan="8" style="text-align: center; padding: 2rem; color: var(--text-muted);">No products yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if ($products->hasPages())
    <div class="pagination" style="margin-top: 2rem;">
        @if ($products->onFirstPage())
            <span style="opacity: 0.5; cursor: not-allowed;">← Previous</span>
        @else
            <a href="{{ $products->previousPageUrl() }}">← Previous</a>
        @endif

        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}">Next →</a>
        @else
            <span style="opacity: 0.5; cursor: not-allowed;">Next →</span>
        @endif
    </div>
@endif

@endsection
