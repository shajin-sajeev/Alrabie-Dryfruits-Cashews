@props(['product'])

<div class="product-card">
    <!-- Product Image Container -->
    <div class="product-image-container">
        <div class="product-image-wrapper">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
            @else
                <div class="product-image-placeholder">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <path d="M21 15l-5-5L5 21"></path>
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Overlay with CTA -->
        <div class="product-overlay">
            <a href="{{ route('product', $product->slug) }}" class="product-overlay-link">
                <span>View Details</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"></path>
                </svg>
            </a>
        </div>
        
        <!-- Status Badge -->
        <span class="product-badge {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
        </span>
    </div>

    <!-- Product Content -->
    <div class="product-content">
        <!-- Category Tag -->
        <div class="product-category-badge">
            {{ $product->category->name ?? 'Uncategorized' }}
        </div>

        <!-- Product Name -->
        <h3 class="product-name">{{ $product->name }}</h3>

        <!-- Product Description -->
        <p class="product-description">{{ Str::limit($product->description, 100) }}</p>

        <!-- Rating -->
        <div class="product-rating">
            <div class="stars">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
            </div>
            <span class="rating-count">(0)</span>
        </div>

        <!-- Price and Unit -->
        <div class="product-pricing">
            <div class="price-info">
                <span class="product-price">₪{{ number_format($product->price, 2) }}</span>
                <span class="product-unit">per {{ $product->unit }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="product-actions-container">
            <a href="{{ route('product', $product->slug) }}" class="btn btn-primary-small">
                <span>Explore</span>
            </a>
            <button class="btn btn-secondary-small" onclick="openContactSellerModal('{{ $product->name }}')">
                <span>Contact</span>
            </button>
        </div>
    </div>
</div>
