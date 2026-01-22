@extends('layouts.app')

@section('title', $product->name . ' - Al Rabie Dry Fruits & Nuts')

@section('content')

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => $product->category->name ?? 'Category', 'url' => $product->category ? route('category', $product->category->slug) : route('home')],
    ['label' => $product->name]
]" />

<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="product-detail-container">
        <!-- Product Image -->
        <div class="product-detail-image-wrapper">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-detail-image">
            @else
                <div class="product-detail-image" style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%); display: flex; align-items: center; justify-content: center; color: #1e293b; font-weight: bold; font-size: 1.5rem;">No Image Available</div>
            @endif
            @if ($product->quantity > 0)
                <span class="product-stock-badge in-stock">✓ In Stock</span>
            @else
                <span class="product-stock-badge out-of-stock">✗ Out of Stock</span>
            @endif
        </div>

        <!-- Product Info -->
        <div class="product-detail-info">
            <span class="product-detail-category">{{ $product->category->name ?? 'Uncategorized' }}</span>
            <h1 class="product-detail-name">{{ $product->name }}</h1>
            
            <div class="product-detail-price-section">
                <span class="product-detail-price">₪{{ number_format($product->price, 2) }}</span>
                <span class="product-detail-unit">/ {{ $product->unit }}</span>
            </div>

            <div class="product-detail-meta">
                <div class="meta-item">
                    <strong>📦 Quantity Available</strong>
                    <span>{{ $product->quantity }} {{ $product->unit }}</span>
                </div>
                <div class="meta-item">
                    <strong>🏷️ Category</strong>
                    <span>{{ $product->category->name ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="product-detail-description">
                <h3>Product Description</h3>
                <p>{{ $product->description ?: 'No description available for this product.' }}</p>
            </div>

            <div class="product-detail-actions">
                <button class="btn btn-primary btn-large" onclick="openContactSellerModal('{{ $product->name }}')">
                    📞 Contact Seller
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if ($relatedProducts->count() > 0)
<section class="related-products-section">
    <div class="section-header">
        <h2 class="section-title">Related Products</h2>
        <p class="section-subtitle">You might also like these products</p>
    </div>
    <div class="products-grid">
        @foreach ($relatedProducts as $relatedProduct)
            <x-product-card :product="$relatedProduct" />
        @endforeach
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
    function openContactSellerModal(productName) {
        document.getElementById('contactSellerModal').classList.add('show');
        document.getElementById('contactProductName').textContent = productName;
        document.body.style.overflow = 'hidden';
    }
</script>
@endsection
