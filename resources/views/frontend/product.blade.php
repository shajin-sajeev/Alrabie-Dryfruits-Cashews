@extends('layouts.app')

@section('title', $product->name . ' - Al Rabie Premium')

@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-container" style="padding: 2rem 2rem 0; max-width: 1400px; margin: 0 auto;">
    <x-breadcrumb :items="[
        ['label' => $product->category->name ?? 'Collection', 'url' => $product->category ? route('category', $product->category->slug) : route('home')],
        ['label' => $product->name]
    ]" />
</div>

<!-- Product Detail Section -->
<section class="product-detail-section" style="padding: 4rem 2rem; max-width: 1400px; margin: 0 auto;">
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));">

        <!-- Product Image -->
        <div style="padding: 2rem; background: rgba(255, 255, 255, 0.02); display: flex; align-items: center; justify-content: center; position: relative;">
            @if ($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; height: auto; border-radius: 16px; box-shadow: var(--shadow-lg);">
            @else
            <div style="width: 100%; aspect-ratio: 1; border-radius: 16px; background: var(--bg-card); display: flex; align-items: center; justify-content: center; border: 1px dashed var(--border-color);">
                <i class="fas fa-image" style="font-size: 5rem; opacity: 0.1;"></i>
            </div>
            @endif

            <div style="position: absolute; top: 3rem; right: 3rem;">
                @if ($product->quantity > 0)
                <span style="background: rgba(16, 185, 129, 0.15); color: var(--primary-color); padding: 0.5rem 1rem; border-radius: 50px; font-weight: 800; font-size: 0.75rem; border: 1px solid var(--primary-color); text-transform: uppercase;">
                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i> In Stock
                </span>
                @else
                <span style="background: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 800; font-size: 0.75rem; border: 1px solid #ef4444; text-transform: uppercase;">
                    <i class="fas fa-times-circle" style="margin-right: 0.5rem;"></i> Out of Stock
                </span>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div style="padding: 4rem; display: flex; flex-direction: column; gap: 2rem;">
            <div>
                <span style="color: var(--primary-color); text-transform: uppercase; font-weight: 800; font-size: 0.85rem; letter-spacing: 0.1em; margin-bottom: 0.5rem; display: block;">
                    {{ $product->category->name ?? 'Premium Collection' }}
                </span>
                <h1 style="font-size: 3rem; font-weight: 900; color: var(--text-main); margin-bottom: 1.5rem; letter-spacing: -0.02em; line-height: 1.1;">{{ $product->name }}</h1>

                <div style="display: flex; align-items: baseline; gap: 0.75rem;">
                    <span style="font-size: 2.5rem; font-weight: 900; color: var(--text-main);">₹{{ number_format($product->price, 0) }}</span>
                    <span style="font-size: 1.15rem; color: var(--text-muted); font-weight: 500;">/ {{ $product->unit }}</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; padding: 2rem; background: rgba(255, 255, 255, 0.03); border-radius: 20px; border: 1px solid var(--border-color);">
                <div>
                    <label style="color: var(--text-dim); font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em; display: block; margin-bottom: 0.5rem;">Availability</label>
                    <div style="color: var(--text-main); font-weight: 700; font-size: 1.1rem;">{{ $product->quantity }} {{ $product->unit }}</div>
                </div>
                <div>
                    <label style="color: var(--text-dim); font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em; display: block; margin-bottom: 0.5rem;">Origin</label>
                    <div style="color: var(--text-main); font-weight: 700; font-size: 1.1rem;">Authentic Pick</div>
                </div>
            </div>

            <div>
                <h3 style="color: var(--text-main); font-size: 1.1rem; font-weight: 800; margin-bottom: 1rem;">Product Details</h3>
                <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.7; max-width: 500px;">{{ $product->description ?: 'No additional details available for this hand-selected item.' }}</p>
            </div>

            <div style="margin-top: 2rem;">
                <button class="btn btn-primary" style="width: 100%; padding: 1.25rem; font-size: 1.1rem;" onclick="openContactSellerModal('{{ $product->name }}')">
                    <span>Enquire Now</span>
                    <i class="fab fa-whatsapp"></i>
                </button>
            </div>

            <div style="display: flex; gap: 2rem; margin-top: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--text-muted); font-size: 0.9rem;">
                    <i class="fas fa-certificate" style="color: var(--primary-color);"></i>
                    <span>Premium Quality</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--text-muted); font-size: 0.9rem;">
                    <i class="fas fa-truck-fast" style="color: var(--primary-color);"></i>
                    <span>Fast Delivery</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if (isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="products-section" style="padding-top: 4rem;">
    <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
        <h2 class="section-title">You Might Also Like</h2>
        <p class="section-subtitle">More premium selections from the same collection</p>
    </div>
    <div class="products-grid">
        @foreach ($relatedProducts as $relatedProduct)
        <x-product-card :product="$relatedProduct" />
        @endforeach
    </div>
</section>
@endif

@endsection