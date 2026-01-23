<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Al Rabie Dry Fruits & Cashews')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>

<body>
    <!-- Header & Navigation -->
    <header id="mainHeader">
        <div class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="logo-image">
                <span class="logo-text">Al Rabie</span>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li><a href="{{ route('home') }}#categories" class="nav-link">Categories</a></li>
                <li><a href="{{ route('home') }}#products" class="nav-link">Products</a></li>
                <li><a href="{{ route('home') }}#contact" class="nav-link">Contact</a></li>
            </ul>

            <div class="header-actions">
                <form action="{{ route('search') }}" method="GET" class="search-bar">
                    <input type="text" name="q" placeholder="Search premium fruits..." required>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>

    <!-- Messages/Alerts -->
    <div class="alerts-container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ $message }}</span>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $message }}</span>
        </div>
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ $error }}</span>
        </div>
        @endforeach
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="logo-image" style="height: 40px; width: 40px; border-radius: 8px; margin-bottom: 1rem;">
                    <h4>Al Rabie</h4>
                </div>
                <p>Pure, premium, and hand-picked. Bringing the world's finest dry fruits and nuts straight to your table since 2024.</p>
                <div class="social-links" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h4>Categories</h4>
                <ul>
                    <li><a href="{{ route('home') }}#categories">Nuts & Seeds</a></li>
                    <li><a href="{{ route('home') }}#categories">Dried Fruits</a></li>
                    <li><a href="{{ route('home') }}#categories">Exotic Gifts</a></li>
                    <li><a href="{{ route('home') }}">View All</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Order Tracking</a></li>
                    <li><a href="{{ route('home') }}#contact">Customer Care</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Contact Us</h4>
                <ul class="contact-list" style="list-style: none; padding: 0;">
                    <li style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                        <i class="fas fa-envelope" style="color: var(--primary-color);"></i>
                        <span>info@alrabie.com</span>
                    </li>
                    <li style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                        <i class="fas fa-phone" style="color: var(--primary-color);"></i>
                        <span>+966 50 123 4567</span>
                    </li>
                    <li style="display: flex; gap: 0.75rem; align-items: center;">
                        <i class="fas fa-location-dot" style="color: var(--primary-color);"></i>
                        <span>Riyadh, Saudi Arabia</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Al Rabie Dry Fruits & Cashews. Crafted for excellence.</p>
        </div>
    </footer>

    <!-- Contact Seller Modal -->
    <div id="contactSellerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Contact Seller</h2>
                <button class="modal-close" onclick="closeContactSellerModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 1.5rem; color: var(--text-muted); font-size: 1.1rem;">
                    Inquiring about: <strong id="contactProductName" style="color: var(--primary-color);"></strong>
                </p>

                <div class="contact-method-selector" style="display: flex; gap: 1rem; margin-bottom: 2rem; background: rgba(0,0,0,0.03); padding: 0.5rem; border-radius: 12px;">
                    <button class="contact-method-btn active" onclick="selectContactMethod('email'); return false;" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s; background: var(--primary-color); color: white; font-weight: 700;">
                        <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i> Email
                    </button>
                    <button class="contact-method-btn" onclick="selectContactMethod('phone'); return false;" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s; background: transparent; color: var(--text-muted); font-weight: 600;">
                        <i class="fas fa-phone" style="margin-right: 0.5rem;"></i> Phone
                    </button>
                </div>

                <!-- Email Contact -->
                <div id="emailContact" class="contact-method-content">
                    <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: 16px; margin-bottom: 1.5rem;">
                        <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-main);">Direct Email:</strong></p>
                        <a href="mailto:info@alrabie.com" style="color: var(--primary-color); font-size: 1.25rem; font-weight: 700; text-decoration: none;">info@alrabie.com</a>
                    </div>
                    <a href="#" id="emailLink" class="btn btn-primary" style="width: 100%;">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </a>
                </div>

                <!-- Phone Contact -->
                <div id="phoneContact" class="contact-method-content" style="display: none;">
                    <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: 16px; margin-bottom: 1.5rem;">
                        <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-main);">WhatsApp & Call:</strong></p>
                        <a href="tel:+918075615183" style="color: var(--primary-color); font-size: 1.25rem; font-weight: 700; text-decoration: none;">+91 8075615183</a>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="tel:+918075615183" class="btn btn-primary" style="flex: 1;">
                            <i class="fas fa-phone"></i>
                            <span>Call Now</span>
                        </a>
                        <a href="https://wa.me/918075615183" target="_blank" class="btn btn-secondary" style="flex: 1;">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>