@extends('layouts.app')

@section('title', 'Home - Al Rabie Dry Fruits & Nuts')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Premium Dry Fruits & Nuts</h1>
        <p>Discover the finest collection of organic dry fruits, premium nuts, and imported chocolates for your table</p>
        <div class="cta-buttons">
            <button class="btn btn-primary" onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})">Shop Now</button>
            <button class="btn btn-secondary" onclick="document.getElementById('categories').scrollIntoView({behavior: 'smooth'})">Explore Categories</button>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="categories-section">
    <h2 class="section-title">Our Categories</h2>
    <div class="categories-grid">
        @forelse ($categories as $category)
            <div class="category-card" onclick="window.location.href='{{ route('category', $category->slug) }}'">
                @if ($category->image)
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
                @else
                    <div class="category-image" style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);"></div>
                @endif
                <div class="category-content">
                    <h3>{{ $category->name }}</h3>
                    <p>{{ $category->description ? Str::limit($category->description, 60) : 'Explore this category' }}</p>
                    <a href="{{ route('category', $category->slug) }}" class="btn btn-small" style="display: inline-block;">View Products →</a>
                </div>
            </div>
        @empty
            <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">No categories available</p>
        @endforelse
    </div>
</section>

<!-- Products Section -->
<section id="products" class="products-section">
    <div class="section-header">
        <h2 class="section-title">Featured Products</h2>
        <p class="section-subtitle">Handpicked selections of premium quality dry fruits and nuts</p>
    </div>
    
    <div class="products-grid">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 3rem 0;">No products available</p>
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

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="contact-container">
        <div class="section-header">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Have questions? We'd love to hear from you. Contact us today!</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-details">
                        <h3>Email Us</h3>
                        <p>Have a question? Send us an email and we'll respond as quickly as possible.</p>
                        <a href="mailto:info@alrabie.com" class="info-link">info@alrabie.com</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📱</div>
                    <div class="info-details">
                        <h3>Call Us</h3>
                        <p>Available Monday - Sunday, 9:00 AM - 9:00 PM (Saudi Arabia Time)</p>
                        <a href="tel:+966501234567" class="info-link">+966 50 123 4567</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">💬</div>
                    <div class="info-details">
                        <h3>WhatsApp</h3>
                        <p>Chat with us on WhatsApp for instant support</p>
                        <a href="https://wa.me/966501234567" target="_blank" class="info-link">Start Chat</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-details">
                        <h3>Location</h3>
                        <p>Visit us in Saudi Arabia</p>
                        <span class="info-text">Saudi Arabia, Riyadh</span>
                    </div>
                </div>
            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

