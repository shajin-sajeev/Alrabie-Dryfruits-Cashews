@extends('layouts.app')

@section('title', 'Al Rabie - Premium Dry Fruits & Nuts')

@section('content')

<!-- Modern Home Carousel -->
<section class="hero-carousel">
    <div class="carousel-container">
        <!-- Slide 1 -->
        <div class="carousel-slide active">
            <img src="{{ asset('images/carousel/slide1.jpg') }}" alt="Premium Dry Fruits" class="carousel-image">
            <div class="carousel-overlay"></div>
            <div class="hero-content">
                <h1>Premium Nature, <br>Delivered Daily.</h1>
                <p>Discover our artisanal collection of hand-picked dry fruits, organic nuts, and imported chocolates. Perfection in every bite.</p>
                <div class="cta-buttons">
                    <button class="btn btn-primary" onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})">
                        <span>Shop Collection</span>
                        <i class="fas fa-shopping-bag"></i>
                    </button>
                    <button class="btn btn-secondary" onclick="document.getElementById('categories').scrollIntoView({behavior: 'smooth'})">
                        <span>Browse Categories</span>
                        <i class="fas fa-th-large"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-slide">
            <img src="{{ asset('images/carousel/slide2.jpg') }}" alt="Dried Fruits Harvest" class="carousel-image">
            <div class="carousel-overlay"></div>
            <div class="hero-content">
                <h1>The Purest Harvest, <br>Direct to You.</h1>
                <p>Sun-dried perfection and organic goodness, curated for your sophisticated palate.</p>
                <div class="cta-buttons">
                    <button class="btn btn-primary" onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})">
                        <span>View Featured</span>
                        <i class="fas fa-star"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-slide">
            <img src="{{ asset('images/carousel/slide3.jpg') }}" alt="Tradition and Quality" class="carousel-image">
            <div class="carousel-overlay"></div>
            <div class="hero-content">
                <h1>A Legacy of <br>Curated Excellence.</h1>
                <p>Rooted in tradition, Al Rabie brings you the finest selections from global spice markets.</p>
                <div class="cta-buttons">
                    <button class="btn btn-primary" onclick="document.getElementById('categories').scrollIntoView({behavior: 'smooth'})">
                        <span>Discover More</span>
                        <i class="fas fa-compass"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-slide">
            <img src="{{ asset('images/carousel/slide4.jpg') }}" alt="Healthy Gourmet Snacking" class="carousel-image">
            <div class="carousel-overlay"></div>
            <div class="hero-content">
                <h1>Gourmet Health <br>In Every Handful.</h1>
                <p>The perfect blend of nutrition and luxury. Healthy snacking redefined for the premium lifestyle.</p>
                <div class="cta-buttons">
                    <button class="btn btn-primary" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
                        <span>Get In Touch</span>
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <button class="carousel-nav-btn prev" aria-label="Previous slide">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-nav-btn next" aria-label="Next slide">
        <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Indicators -->
    <div class="carousel-indicators"></div>
</section>

<!-- Categories Section -->
<section id="categories" class="categories-section">
    <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
        <h2 class="section-title">Exclusive Categories</h2>
        <p class="section-subtitle">Specially curated selections for every occasion</p>
    </div>

    <div class="categories-grid">
        @forelse ($categories as $category)
        <div class="category-card" onclick="window.location.href='{{ route('category', $category->slug) }}'">
            @if ($category->image)
            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
            @else
            <div class="category-image" style="background: linear-gradient(135deg, #10b981 0%, #064e3b 100%);"></div>
            @endif
            <div class="category-content">
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description ? Str::limit($category->description, 60) : 'Explore our premium selection.' }}</p>
                <a href="{{ route('category', $category->slug) }}" class="info-link" style="color: white; font-weight: 700;">
                    <span>Explore Collection</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 4rem; background: var(--bg-card); border-radius: 20px; border: 1px solid var(--border-color);">
            <i class="fas fa-box-open" style="font-size: 3rem; color: var(--border-color); margin-bottom: 1rem; display: block;"></i>
            <p style="color: var(--text-muted); font-size: 1.1rem;">No categories available at the moment.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Products Section -->
<section id="products" class="products-section">
    <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
        <h2 class="section-title">Featured Selections</h2>
        <p class="section-subtitle">The freshest picks from the current harvest</p>
    </div>

    <div class="products-grid">
        @forelse ($products as $product)
        <x-product-card :product="$product" />
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 4rem; background: var(--bg-card); border-radius: 20px; border: 1px solid var(--border-color);">
            <i class="fas fa-search" style="font-size: 3rem; color: var(--border-color); margin-bottom: 1rem; display: block;"></i>
            <p style="color: var(--text-muted); font-size: 1.1rem;">No featured products found.</p>
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

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="contact-container">
        <div class="section-header" style="text-align: center; margin-bottom: 5rem;">
            <h2 class="section-title">Elevate Your Experience</h2>
            <p class="section-subtitle">Need assistance? Our concierge team is here to help.</p>
        </div>

        <div class="contact-content">
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="info-details">
                        <h3>Mail Inquiry</h3>
                        <p>Our experts will respond within 12 business hours.</p>
                        <a href="mailto:info@alrabie.com" class="info-link">info@alrabie.com</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone-volume"></i></div>
                    <div class="info-details">
                        <h3>Direct Call</h3>
                        <p>Speak with our customer relations team directly.</p>
                        <a href="tel:+91 8075615183" class="info-link">+91 8075615183</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                    <div class="info-details">
                        <h3>Instant Concierge</h3>
                        <p>Message us on WhatsApp for 24/7 priority support.</p>
                        <a href="https://wa.me/8075615183" target="_blank" class="info-link">Start Priority Chat</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-location-dot"></i></div>
                    <div class="info-details">
                        <h3>Flagship Store</h3>
                        <p>Visit our flagship store in the heart of Attingal.</p>
                        <span class="info-text" style="color: var(--text-main); font-weight: 600;">Mamam, Attingal, Kerala</span>
                        <a href="https://maps.app.goo.gl/xqoHAAuAYgeTdhXZ9" target="_blank" class="info-link">Get Directions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection