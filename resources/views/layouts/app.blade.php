<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Al Rabie Dry Fruits & Cashews')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="logo-image">
                <span class="logo-text">Al Rabie </span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li><a href="{{ route('home') }}#categories" class="nav-link">Categories</a></li>
                <li><a href="{{ route('home') }}#products" class="nav-link">Featured Products</a></li>
                <li><a href="{{ route('home') }}#contact" class="nav-link">Contact</a></li>
                {{-- <li><a href="{{ route('admin.login') }}">Admin</a></li> --}}
            </ul>
            <form action="{{ route('search') }}" method="GET" class="search-bar">
                <input type="text" name="q" placeholder="Search">
                <button type="submit">🔍</button>
            </form>
        </div>
    </header>

    <!-- Messages/Alerts -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="margin: 1rem 2rem;">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-error" style="margin: 1rem 2rem;">
            {{ $message }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error" style="margin: 1rem 2rem;">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>About Us</h4>
                <p>Al Rabie is your trusted source for premium quality dry fruits, nuts, and imported chocolates. We bring the finest products to your doorstep.</p>
            </div>
            <div class="footer-section">
                <h4>Categories</h4>
                <ul>
                    <li><a href="{{ route('home') }}#categories">Browse Categories</a></li>
                    <li><a href="{{ route('home') }}">All Products</a></li>
                    <li><a href="{{ route('home') }}#products">Featured Products</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                    <li><a href="{{ route('home') }}#categories">Categories</a></li>
                    <li><a href="{{ route('home') }}#products">Products</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Info</h4>
                <ul>
                    <li>📧 info@alrabie.com</li>
                    <li>📱 +966 50 123 4567</li>
                    <li>📍 Saudi Arabia</li>
                    <li>🕐 Open 24/7</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Al Rabie Dry Fruits & Nuts. All rights reserved.</p>
        </div>
    </footer>

    <!-- Contact Seller Modal -->
    <div id="contactSellerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Contact Seller</h2>
                <button class="modal-close" onclick="closeContactSellerModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 1.5rem; color: var(--text-muted);">
                    Product: <strong id="contactProductName" style="color: var(--primary-color);"></strong>
                </p>
                
                <div class="contact-method-selector">
                    <button class="contact-method-btn active" onclick="selectContactMethod('email'); return false;">
                        📧 Email
                    </button>
                    <button class="contact-method-btn" onclick="selectContactMethod('phone'); return false;">
                        📱 Phone
                    </button>
                </div>

                <!-- Email Contact -->
                <div id="emailContact" class="contact-method-content">
                    <h3 style="margin-bottom: 1rem; color: var(--primary-color);">Contact via Email</h3>
                    <div class="seller-contact-info">
                        <p><strong>Email:</strong> <a href="mailto:info@alrabie.com" style="color: var(--primary-color);">info@alrabie.com</a></p>
                        <p><strong>Subject:</strong> Inquiry about <span id="emailProductName"></span></p>
                    </div>
                    <a href="#" id="emailLink" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">
                        Open Email Client
                    </a>
                </div>

                <!-- Phone Contact -->
                <div id="phoneContact" class="contact-method-content" style="display: none;">
                    <h3 style="margin-bottom: 1rem; color: var(--primary-color);">Contact via Phone</h3>
                    <div class="seller-contact-info">
                        <p><strong>Phone:</strong> <a href="tel:+8075615183" style="color: var(--primary-color);">+91 8075615183</a></p>
                        <p><strong>WhatsApp:</strong> <a href="https://wa.me/8075615183" target="_blank" style="color: var(--primary-color);">+91 8075615183</a></p>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 1rem;">
                            Available: Everyday 9:00 AM - 9:00 PM 
                        </p>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <a href="tel:+8075615183" class="btn btn-primary" style="flex: 1; text-align: center;">
                            📞 Call Now
                        </a>
                        <a href="https://wa.me/8136954390" target="_blank" class="btn btn-secondary" style="flex: 1; text-align: center;">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
