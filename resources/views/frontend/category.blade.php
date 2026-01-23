@extends('layouts.app')

@section('title', $category->name . ' - Al Rabie Premium')

@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-container" style="padding: 2rem 2rem 0; max-width: 1400px; margin: 0 auto;">
    <x-breadcrumb :items="[
        ['label' => $category->name]
    ]" />
</div>

<!-- Category Header -->
<header class="category-header-banner" style="padding: 4rem 2rem; max-width: 1400px; margin: 0 auto;">
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 3rem; display: flex; gap: 4rem; align-items: center; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -50%; left: -10%; width: 40%; height: 200%; background: var(--primary-glow); filter: blur(100px); opacity: 0.1; z-index: 0;"></div>

        @if ($category->image)
        <div style="position: relative; z-index: 1; flex-shrink: 0;">
            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="width: 280px; height: 280px; border-radius: 20px; object-fit: cover; box-shadow: var(--shadow-lg);">
        </div>
        @endif

        <div style="position: relative; z-index: 1;">
            <span style="color: var(--primary-color); text-transform: uppercase; font-weight: 800; font-size: 0.85rem; letter-spacing: 0.1em; margin-bottom: 1rem; display: block;">Our Collection</span>
            <h1 style="font-size: 3.5rem; font-weight: 900; color: var(--text-main); margin-bottom: 1rem; letter-spacing: -0.02em;">{{ $category->name }}</h1>
            <p style="color: var(--text-muted); font-size: 1.15rem; line-height: 1.6; max-width: 600px; margin-bottom: 2rem;">{{ $category->description ?? 'Discover our hand-picked selection of the finest ' . strtolower($category->name) . ' from around the globe.' }}</p>
            <div style="display: flex; align-items: center; gap: 1rem; color: var(--text-main); font-weight: 600;">
                <i class="fas fa-boxes-stacked" style="color: var(--primary-color);"></i>
                <span>{{ $products->total() }} Premium Items Available</span>
            </div>
        </div>
    </div>
</header>

<!-- Products Section -->
<section class="products-section" style="padding-top: 0;">
    <div class="products-grid">
        @forelse ($products as $product)
        <x-product-card :product="$product" />
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 6rem 2rem; background: var(--bg-card); border-radius: 24px; border: 1px solid var(--border-color);">
            <i class="fas fa-search" style="font-size: 4rem; color: var(--border-color); margin-bottom: 1.5rem; display: block;"></i>
            <h3 style="color: var(--text-main); font-size: 1.5rem; margin-bottom: 0.5rem;">No products found</h3>
            <p style="color: var(--text-muted);">We couldn't find any products in this category at the moment.</p>
            <a href="{{ route('home') }}" class="btn btn-small" style="margin-top: 2rem; display: inline-flex;">Go Home</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
    <div class="pagination">
        @if ($products->onFirstPage())
        <span class="page-link disabled"><i class="fas fa-chevron-left"></i></span>
        @else
        <a href="{{ $products->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
        <span class="active">{{ $page }}</span>
        @else
        <a href="{{ $url }}">{{ $page }}</a>
        @endif
        @endforeach

        @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right"></i></a>
        @else
        <span class="page-link disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
    @endif
</section>

@endsection