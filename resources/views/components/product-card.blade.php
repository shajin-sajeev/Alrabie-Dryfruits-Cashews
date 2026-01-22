@props(['product'])

@props(['product'])

<div class="product-card">
    <!-- Product Image Container -->
    <div class="product-image-container">
        @if ($product->image)
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
        @else
        <div class="product-image-placeholder" style="display: flex; align-items: center; justify-content: center; height: 100%; background: var(--bg-card); color: var(--text-muted);">
            <i class="fas fa-image" style="font-size: 3rem; opacity: 0.2;"></i>
        </div>
        @endif

        <!-- Status Badge -->
        <span class="product-badge {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
        </span>
    </div>

    <!-- Product Content -->
    <div class="product-content">
        <!-- Category Tag -->
        <div class="product-category-badge">
            <i class="fas fa-leaf" style="margin-right: 0.25rem;"></i>
            {{ $product->category->name ?? 'Premium' }}
        </div>

        <!-- Product Name -->
        <h3 class="product-name">{{ $product->name }}</h3>

        <!-- Product Description -->
        <p class="product-description">{{ Str::limit($product->description, 80) }}</p>

        <!-- Price and Unit -->
        <div class="product-pricing">
            <span class="product-price">₹{{ number_format($product->price, 0) }}</span>
            <span class="product-unit">/ {{ $product->unit }}</span>
        </div>

        <!-- Action Buttons -->
        <div class="product-actions-container">
            <a href="{{ route('product', $product->slug) }}" class="btn-small btn-primary-small">
                <span>Details</span>
                <i class="fas fa-arrow-right"></i>
            </a>
            <button class="btn-small btn-secondary-small" onclick="openContactSellerModal('{{ $product->name }}')">
                <i class="fab fa-whatsapp"></i>
                <span>Enquire</span>
            </button>
        </div>
    </div>
</div>