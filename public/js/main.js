// ===================================
// AL RABIE DRY FRUITS & NUTS - Frontend JS
// ===================================

document.addEventListener('DOMContentLoaded', function() {
    initializeModals();
    initializeAnimations();
    initializeSearch();
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

    // Parallax effect
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const hero = document.querySelector('.hero');
        if (hero) {
            hero.style.backgroundPosition = `0 ${scrollY * 0.5}px`;
        }
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
    const searchForm = document.querySelector('.search-bar');
    if (searchForm) {
        const input = searchForm.querySelector('input');
        const button = searchForm.querySelector('button');

        button.addEventListener('click', (e) => {
            e.preventDefault();
            if (input.value.trim()) {
                window.location.href = `/search?q=${encodeURIComponent(input.value)}`;
            }
        });

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (input.value.trim()) {
                    window.location.href = `/search?q=${encodeURIComponent(input.value)}`;
                }
            }
        });
    }
}

// ===================================
// CART FUNCTIONALITY (Future)
// ===================================

// ===================================
// CONTACT SELLER FUNCTIONALITY
// ===================================

function openContactSellerModal(productName) {
    const modal = document.getElementById('contactSellerModal');
    if (modal) {
        document.getElementById('contactProductName').textContent = productName;
        document.getElementById('emailProductName').textContent = productName;
        
        // Update email link with product name
        const emailLink = document.getElementById('emailLink');
        if (emailLink) {
            const subject = encodeURIComponent(`Inquiry about ${productName}`);
            emailLink.href = `mailto:info@alrabie.com?subject=${subject}`;
        }
        
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
        // Reset to email method
        selectContactMethod('email');
    }
}

function sendEmail() {
    const productName = document.getElementById('contactProductName').textContent;
    const subject = encodeURIComponent(`Inquiry about ${productName}`);
    window.location.href = `mailto:info@alrabie.com?subject=${subject}`;
}

function closeContactSellerModal() {
    const modal = document.getElementById('contactSellerModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}

function selectContactMethod(method) {
    // Update button states
    document.querySelectorAll('.contact-method-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.textContent.includes(method === 'email' ? '📧' : '📱')) {
            btn.classList.add('active');
        }
    });
    
    // Show/hide content
    document.getElementById('emailContact').style.display = method === 'email' ? 'block' : 'none';
    document.getElementById('phoneContact').style.display = method === 'phone' ? 'block' : 'none';
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
        if (href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});
