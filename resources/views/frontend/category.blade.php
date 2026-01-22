@extends('layouts.app')

@section('title', $category->name . ' - Al Rabie Dry Fruits & Nuts')

@section('content')

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => $category->name]
]" />

<!-- Category Header -->
<section style="padding: 3rem 2rem; max-width: 1400px; margin: 0 auto; border-bottom: 1px solid var(--dark-border);">
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; align-items: center;">
        @if ($category->image)
            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="border-radius: 10px; max-height: 300px; object-fit: cover;">
        @endif
        <div>
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">{{ $category->name }}</h1>
            <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 1rem;">{{ $category->description }}</p>
            <p style="color: var(--primary-color);">{{ $products->total() }} Products Available</p>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section">
    <div class="section-header">
        <h2 class="section-title">{{ $category->name }} Products</h2>
        <p class="section-subtitle">{{ $products->total() }} premium items available</p>
    </div>
    
    <div class="products-grid">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 5rem 2rem;">
                <p style="color: var(--text-muted); font-size: 1.2rem;">No products in this category</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="pagination">
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
</section>

@endsection

