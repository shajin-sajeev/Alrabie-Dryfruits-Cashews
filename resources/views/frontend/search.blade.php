@extends('layouts.app')

@section('title', 'Searching for "' . $query . '" - Al Rabie Premium')

@section('content')

<!-- Search Results Section -->
<section class="products-section" style="padding-top: 5rem;">
    <div class="search-results-container" style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        <!-- Search Header -->
        <header class="search-header-banner" style="margin-bottom: 4rem;">
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 3rem; position: relative; overflow: hidden; display: flex; flex-direction: column; align-items: center; text-align: center;">
                <div style="position: absolute; top: -50%; left: -10%; width: 50%; height: 200%; background: var(--primary-glow); filter: blur(100px); opacity: 0.1; z-index: 0;"></div>

                <div style="position: relative; z-index: 1;">
                    <i class="fas fa-search" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1.5rem;"></i>
                    <h1 style="font-size: 2.5rem; font-weight: 800; color: white; margin-bottom: 0.5rem;">Search Results</h1>
                    <p style="color: var(--text-muted); font-size: 1.1rem;">You searched for "<strong style="color: white;">{{ $query }}</strong>"</p>
                    <div style="margin-top: 1.5rem; background: rgba(16, 185, 129, 0.1); color: var(--primary-color); padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem; border: 1px solid rgba(16, 185, 129, 0.2);">
                        Found {{ $products->total() }} premium product{{ $products->total() != 1 ? 's' : '' }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Products Display -->
        @if ($products->count() > 0)
        <div class="products-grid" style="padding: 0;">
            @foreach ($products as $product)
            <x-product-card :product="$product" />
            @endforeach
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
        @else
        <!-- No Results -->
        <div style="text-align: center; padding: 6rem 2rem; background: var(--bg-card); border-radius: 24px; border: 1px solid var(--border-color);">
            <i class="fas fa-magnifying-glass" style="font-size: 4rem; color: var(--border-color); margin-bottom: 1.5rem; display: block;"></i>
            <h3 style="color: white; font-size: 1.5rem; margin-bottom: 0.5rem;">No matches found</h3>
            <p style="color: var(--text-muted); max-width: 400px; margin: 0 auto;">We couldn't find any products matching your search for "{{ $query }}". Try checking for spelling or using different keywords.</p>
            <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
                <a href="{{ route('home') }}" class="btn btn-primary-small">Back to Home</a>
                <button class="btn btn-secondary-small" onclick="document.querySelector('.search-bar input').focus();">Try New Search</button>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@endsection