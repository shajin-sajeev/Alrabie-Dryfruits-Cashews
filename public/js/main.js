// ===================================
// AL RABIE DRY FRUITS & NUTS - Frontend JS
// ===================================

document.addEventListener('DOMContentLoaded', function() {
    initializeModals();
    initializeAnimations();
    initializeSearch();
    initializeCarousel();
});

// ===================================
// MODAL FUNCTIONALITY
// ===================================

function initializeModals() {
    const modals = document.querySelectorAll('.modal');

    // Close modals
    modals.forEach(modal => {
        const closeBtn = modal.querySelector('.modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                if (modal.id === 'contactSellerModal') {
                    closeContactSellerModal();
                } else {
                    closeModal(modal);
                }
            });
        }

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                if (modal.id === 'contactSellerModal') {
                    closeContactSellerModal();
                } else {
                    closeModal(modal);
                }
            }
        });
    });
}

function openProductModal(productId) {
    const modal = document.getElementById('productModal');
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
        loadProductDetails(productId);
    }
}

function closeModal(modal) {
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
}

function loadProductDetails(productId) {
    const modal = document.getElementById('productModal');
    if (!modal) return;

    // This would typically load via AJAX, but for now we'll use existing data
    const productCard = document.querySelector(`[data-product-id="${productId}"]`);
    if (productCard) {
        const name = productCard.querySelector('.product-name')?.textContent || '';
        const price = productCard.querySelector('.product-price')?.textContent || '';
        const description = productCard.getAttribute('data-description') || '';
        const image = productCard.querySelector('.product-image')?.src || '';
        const category = productCard.getAttribute('data-category') || '';

        modal.querySelector('.modal-title').textContent = name;
        modal.querySelector('.modal-product-image').src = image;
        modal.querySelector('.modal-product-price').textContent = price;
        modal.querySelector('.modal-product-category').textContent = category;
        modal.querySelector('.modal-product-description').textContent = description;
    }
}

// ===================================
// ANIMATIONS
// ===================================

function initializeAnimations() {
    // Intersection Observer for fade-in animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.6s ease-out forwards';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.product-card, .category-card').forEach(el => {
        observer.observe(el);
    });



    // Button hover animation
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// ===================================
// SEARCH FUNCTIONALITY
// ===================================

function initializeSearch() {
    // Search is handled by natural HTML form submission in app.blade.php
    // This function is kept empty for compatibility or future non-reload search features
}

// ===================================
// HERO CAROUSEL
// ===================================

function initializeCarousel() {
    const carousel = document.querySelector('.hero-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.carousel-slide');
    const prevBtn = carousel.querySelector('.prev');
    const nextBtn = carousel.querySelector('.next');
    const indicatorContainer = carousel.querySelector('.carousel-indicators');
    
    let currentSlide = 0;
    let slideInterval;

    // Create indicators
    slides.forEach((_, index) => {
        const indicator = document.createElement('button');
        indicator.classList.add('indicator');
        if (index === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => goToSlide(index));
        indicatorContainer.appendChild(indicator);
    });

    const indicators = carousel.querySelectorAll('.indicator');

    function updateSlides() {
        slides.forEach((slide, index) => {
            slide.classList.remove('active');
            indicators[index].classList.remove('active');
            if (index === currentSlide) {
                slide.classList.add('active');
                indicators[index].classList.add('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlides();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateSlides();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlides();
        resetInterval();
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    function startInterval() {
        slideInterval = setInterval(nextSlide, 8000);
    }

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    // Pause on hover
    carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
    carousel.addEventListener('mouseleave', () => startInterval());

    startInterval();
}

// ===================================
// CART FUNCTIONALITY (Future)
// ===================================

// ===================================
// CONTACT SELLER FUNCTIONALITY
// ===================================

function openContactSellerModal(productName) {
    const modal = document.getElementById('contactSellerModal');
    if (!modal) return;

    const contactNameEl = document.getElementById('contactProductName');
    if (contactNameEl) contactNameEl.textContent = productName;
    
    // Config
    const businessEmail = 'info@alrabie.com';
    const businessPhone = '+918075615183';
    const businessWhatsApp = '918075615183';
    const subject = encodeURIComponent(`Inquiry about ${productName}`);
    const body = encodeURIComponent(`Hello Al Rabie Team,\n\nI am interested in ${productName}. Please provide more details.\n\nThank you.`);

    // Email Link
    const emailLink = document.getElementById('emailEnquiryLink');
    if (emailLink) {
        emailLink.href = `mailto:${businessEmail}?subject=${subject}&body=${body}`;
    }
    
    // WhatsApp Link
    const whatsappLink = document.getElementById('whatsappEnquiryLink');
    if (whatsappLink) {
        whatsappLink.href = `https://wa.me/${businessWhatsApp}?text=${body}`;
    }

    // Call Link
    const callLink = document.getElementById('callEnquiryLink');
    if (callLink) {
        callLink.href = `tel:${businessPhone}`;
    }
    
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeContactSellerModal() {
    const modal = document.getElementById('contactSellerModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.textContent = message;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.maxWidth = '400px';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ===================================
// CATEGORY FILTERS
// ===================================

function filterByCategory(categoryId) {
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        const productCategory = product.getAttribute('data-category-id');
        if (categoryId === 'all' || productCategory === categoryId) {
            product.style.display = 'block';
            product.style.animation = 'fadeIn 0.3s ease-out';
        } else {
            product.style.display = 'none';
        }
    });
}

// ===================================
// PRICE SORTING
// ===================================

function sortByPrice(order) {
    const productsContainer = document.querySelector('.products-grid');
    if (!productsContainer) return;

    const products = Array.from(document.querySelectorAll('.product-card'));
    
    products.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.product-price')?.textContent.replace(/[^0-9.]/g, ''));
        const priceB = parseFloat(b.querySelector('.product-price')?.textContent.replace(/[^0-9.]/g, ''));
        
        return order === 'asc' ? priceA - priceB : priceB - priceA;
    });

    products.forEach(product => {
        productsContainer.appendChild(product);
    });
}

// ===================================
// KEYBOARD SHORTCUTS
// ===================================

document.addEventListener('keydown', function(event) {
    // Ctrl/Cmd + K to open search
    if ((event.ctrlKey || event.metaKey) && event.key === 'k') {
        event.preventDefault();
        const searchInput = document.querySelector('.search-bar input');
        if (searchInput) {
            searchInput.focus();
        }
    }

    // Escape to close modal
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            if (modal.id === 'contactSellerModal') {
                closeContactSellerModal();
            } else {
                closeModal(modal);
            }
        });
    }
});

// ===================================
// LAZY LOADING IMAGES
// ===================================

if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ===================================
// SMOOTH SCROLL NAVIGATION
// ===================================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        // Only prevent default if it's a valid internal anchor (starts with # and has target)
        if (href && href.startsWith('#') && href !== '#') {
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

// ===================================
// SECRET ADMIN ACCESS
// ===================================

async function requestAdminAccess() {
    // Dynamic import SweetAlert2 if not already present
    if (typeof Swal === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        document.head.appendChild(script);
        await new Promise(resolve => script.onload = resolve);
    }

    const { value: code } = await Swal.fire({
        title: 'Secure Access',
        input: 'password',
        inputPlaceholder: 'Enter Entry Code',
        showCancelButton: true,
        confirmButtonText: 'Access Portal',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'admin-access-modal',
            input: 'admin-access-input',
            confirmButton: 'swal2-confirm',
            cancelButton: 'swal2-cancel'
        },
        buttonsStyling: false,
        backdrop: `rgba(6, 78, 59, 0.4)`
    });

    if (code) {
        if (code === 'adminpannelaccessonly') {
            Swal.fire({
                icon: 'success',
                title: 'Access Granted',
                text: 'Redirecting to Admin Portal...',
                timer: 1500,
                showConfirmButton: false,
                willClose: () => {
                    window.location.href = '/admin/login';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'The code you entered is invalid.',
                confirmButtonColor: '#10b981'
            });
        }
    }
}
