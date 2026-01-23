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
<header class="category-header-banner" style="padding: 2rem; max-width: 1400px; margin: 0 auto;">
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 4rem; display: flex; gap: 5rem; align-items: center; position: relative; overflow: hidden; box-shadow: var(--shadow-sm);">
        <!-- Backdrop Glow -->
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: var(--primary-glow); filter: blur(80px); opacity: 0.15; z-index: 0; pointer-events: none;"></div>

        @if ($category->image)
        <div style="position: relative; z-index: 1; flex-shrink: 0;">
            <div style="position: relative;">
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="width: 320px; height: 320px; border-radius: 24px; object-fit: cover; box-shadow: var(--shadow-lg); position: relative; z-index: 2;">
                <!-- Decorative element behind image -->
                <div style="position: absolute; top: 20px; right: -20px; bottom: -20px; left: 20px; border: 2px solid var(--primary-color); border-radius: 24px; opacity: 0.15; z-index: 1;"></div>
            </div>
        </div>
        @endif

        <div style="position: relative; z-index: 1;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <span style="background: var(--primary-glow); color: var(--primary-color); padding: 0.5rem 1.25rem; border-radius: 50px; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;">Premium Selection</span>
                <div style="height: 1px; width: 40px; background: var(--border-color);"></div>
            </div>

            <h1 style="font-size: 4rem; font-weight: 900; color: var(--text-main); margin-bottom: 1.5rem; letter-spacing: -0.03em; line-height: 1;">{{ $category->name }}</h1>
            <p style="color: var(--text-muted); font-size: 1.25rem; line-height: 1.7; max-width: 650px; margin-bottom: 2.5rem; font-weight: 400;">{{ $category->description ?? 'Discover our hand-picked selection of the finest ' . strtolower($category->name) . ' from around the globe, curated for quality and taste.' }}</p>

            <div style="display: flex; gap: 3rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                        <i class="fas fa-boxes-stacked" style="color: var(--primary-color); font-size: 1.1rem;"></i>
                    </div>
                    <div>
                        <span style="display: block; font-size: 1.1rem; font-weight: 800; color: var(--text-main);">{{ $products->total() }} items</span>
                        <span style="display: block; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em;">In Collection</span>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                        <i class="fas fa-medal" style="color: #f59e0b; font-size: 1.1rem;"></i>
                    </div>
                    <div>
                        <span style="display: block; font-size: 1.1rem; font-weight: 800; color: var(--text-main);">Verified</span>
                        <span style="display: block; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em;">Quality Grade</span>
                    </div>
                </div>
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