@extends('layouts.app')

@section('title', 'Search Results - Al Rabie Dry Fruits & Nuts')

@section('content')

<!-- Search Results Section -->
<section class="search-results-section">
    <div class="search-results-container">
        <!-- Search Header -->
        <div class="search-header">
            <h1>Search Results</h1>
            <p>Results for: <strong>"{{ $query }}"</strong></p>
            <p class="result-count">Found {{ $products->total() }} product{{ $products->total() != 1 ? 's' : '' }}</p>
        </div>

        <!-- Products Display -->
        @if ($products->count() > 0)
            <div class="products-grid">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
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
        @else
            <!-- No Results -->
            <div class="no-results">
                <p>No products found for "<strong>{{ $query }}</strong>"</p>
                <p class="no-results-hint">Try searching with different keywords</p>
                <div class="no-results-actions">
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                    <a href="{{ route('home') }}#categories" class="btn btn-secondary">Browse Categories</a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection

