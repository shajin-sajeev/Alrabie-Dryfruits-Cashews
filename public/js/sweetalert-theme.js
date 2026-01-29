// ===================================
// SWEETALERT2 GLOBAL THEME CONFIGURATION
// Al Rabie - Emerald Green Theme
// ===================================

// Initialize theme configuration
window.swalTheme = {
    // Logo configuration
    logoUrl: '/images/logo.jpeg',
    logoWidth: '80px',
    logoHeight: '80px',
    
    // Primary colors from the admin theme
    colors: {
        primary: '#10b981',
        primaryDark: '#059669',
        primaryLight: '#d1fae5',
        secondary: '#34d399',
        danger: '#ef4444',
        warning: '#f59e0b',
        success: '#10b981',
        info: '#0ea5e9',
        bg: '#f8fafc',
        text: '#1e293b',
        textMuted: '#64748b',
        border: '#e2e8f0',
        white: '#ffffff'
    },
    
    // Add icon to modal (replaces previous logo insertion)
    addIconToModal: function(modal, iconType) {
        try {
            setTimeout(() => {
                if (!modal) {
                    console.warn('[SweetAlert Theme] Modal not available');
                    return;
                }

                // Avoid duplicate
                if (modal.querySelector('.swal-icon-custom')) return;

                const popup = modal.querySelector('.swal2-popup');
                if (!popup) {
                    console.warn('[SweetAlert Theme] Popup element not found');
                    return;
                }

                // Default icon type fallback
                const type = iconType || (modal.getAttribute && modal.getAttribute('data-swal-icon')) || 'info';

                // SVG icon map
                const svgs = {
                    success: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.primary}"/><path d="M18 34 L28 44 L46 22" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>` ,
                    error: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.danger}"/><path d="M22 22 L42 42 M42 22 L22 42" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>` ,
                    warning: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.warning}"/><path d="M32 18 L32 36" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round"/><circle cx="32" cy="46" r="2.5" fill="#fff"/></svg>` ,
                    info: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.info}"/><path d="M32 22 L32 34" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round"/><circle cx="32" cy="44" r="2.5" fill="#fff"/></svg>` ,
                    delete: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.danger}"/><path d="M22 24 L42 24 L38 46 L26 46 Z" fill="#fff"/><rect x="26" y="18" width="12" height="4" rx="1" fill="#fff"/></svg>` ,
                    confirm: `<svg class="swal-icon-svg" width="80" height="80" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="32" cy="32" r="30" fill="${this.colors.primary}"/><path d="M18 34 L28 44 L46 22" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>`
                };

                const iconSvg = svgs[type] || svgs.info;

                const wrapper = document.createElement('div');
                wrapper.className = 'swal-icon-custom';
                wrapper.setAttribute('data-swal-icon-type', type);
                // Inline safety styles
                wrapper.style.cssText = 'display:flex;justify-content:center;align-items:center;visibility:visible;opacity:1;z-index:100;overflow:visible;';

                wrapper.innerHTML = iconSvg;

                popup.insertBefore(wrapper, popup.firstChild);

                // Debug info
                console.log('[SweetAlert Theme] Icon inserted:', type, popup.querySelector('.swal-icon-custom'));
            }, 90);
        } catch (err) {
            console.error('[SweetAlert Theme] Error inserting icon:', err);
        }
    },

    // Generic configuration builder
    buildConfig: function(config) {
        return {
            ...config,
            customClass: {
                popup: 'swal-themed-popup',
                header: 'swal-themed-header',
                title: 'swal-themed-title',
                closeButton: 'swal-themed-close',
                content: 'swal-themed-content',
                confirmButton: 'swal-themed-confirm-btn',
                cancelButton: 'swal-themed-cancel-btn',
                actions: 'swal-themed-actions'
            },
            icon: undefined,
            allowOutsideClick: false,
            allowEscapeKey: true,
            didOpen: (modal) => {
                // pass through a custom iconType if provided in the config
                this.addIconToModal(modal, config && config.iconType ? config.iconType : config && config.icon ? config.icon : undefined);
            }
        };
    },

    // Success alert
    success: function(title, message = '') {
        return this.buildConfig({
            title: title,
            html: message ? `<p style="color: ${this.colors.text}; margin-top: 0.5rem;">${message}</p>` : undefined,
            confirmButtonText: 'OK',
            confirmButtonColor: this.colors.primary,
            iconType: 'success',
            buttonsStyling: true
        });
    },

    // Error alert
    error: function(title, message = '') {
        return this.buildConfig({
            title: title,
            html: message ? `<p style="color: ${this.colors.text}; margin-top: 0.5rem;">${message}</p>` : undefined,
            confirmButtonText: 'OK',
            confirmButtonColor: this.colors.danger,
            iconType: 'error',
            buttonsStyling: true
        });
    },

    // Warning alert
    warning: function(title, message = '') {
        return this.buildConfig({
            title: title,
            html: message ? `<p style="color: ${this.colors.text}; margin-top: 0.5rem;">${message}</p>` : undefined,
            confirmButtonText: 'Understood',
            confirmButtonColor: this.colors.warning,
            iconType: 'warning',
            buttonsStyling: true
        });
    },

    // Info alert
    info: function(title, message = '') {
        return this.buildConfig({
            title: title,
            html: message ? `<p style="color: ${this.colors.text}; margin-top: 0.5rem;">${message}</p>` : undefined,
            confirmButtonText: 'OK',
            confirmButtonColor: this.colors.info,
            iconType: 'info',
            buttonsStyling: true
        });
    },

    // Confirmation dialog
    confirm: function(title, message = '', confirmText = 'Confirm', denyText = 'Cancel') {
        return this.buildConfig({
            title: title,
            html: message ? `<p style="color: ${this.colors.text}; margin-top: 0.5rem;">${message}</p>` : undefined,
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: denyText,
            confirmButtonColor: this.colors.primary,
            cancelButtonColor: '#9ca3af',
            iconType: 'confirm',
            buttonsStyling: true
        });
    },

    // Delete confirmation dialog
    deleteConfirm: function(itemName, itemType = 'item') {
        return this.buildConfig({
            title: `Delete ${itemType}?`,
            html: `<p style="color: ${this.colors.text};">You are about to delete <strong>${itemName}</strong></p>
                   <p style="color: ${this.colors.textMuted}; font-size: 0.9rem; margin-top: 0.5rem;">This action cannot be undone.</p>`,
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: this.colors.danger,
            cancelButtonColor: '#9ca3af',
            iconType: 'delete',
            buttonsStyling: true
        });
    },

    // Bulk delete confirmation
    bulkDeleteConfirm: function(count) {
        return this.buildConfig({
            title: 'Delete Multiple Items?',
            html: `<p style="color: ${this.colors.text};">Are you sure you want to delete <strong>${count} item(s)</strong>?</p>
                   <p style="color: ${this.colors.textMuted}; font-size: 0.9rem; margin-top: 0.5rem;">This action cannot be undone.</p>`,
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete All',
            cancelButtonText: 'Cancel',
            confirmButtonColor: this.colors.danger,
            cancelButtonColor: '#9ca3af',
            iconType: 'delete',
            buttonsStyling: true
        });
    },

    // Loading/Processing state
    loading: function(title = 'Processing...') {
        return this.buildConfig({
            icon: 'info',
            title: title,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }
};

// Add custom CSS for themed SweetAlert
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        /* ===== MODAL SHAPE & APPEARANCE ===== */
        .swal2-popup,
        .swal-themed-popup {
            border-radius: 24px !important;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 40%, #f8fafc 100%) !important;
            box-shadow: 0 25px 70px rgba(16, 185, 129, 0.2), 
                        0 0 0 1px rgba(16, 185, 129, 0.15) !important;
            border: 2px solid #d1fae5 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        /* ===== ENTRANCE ANIMATION ===== */
        .swal2-popup.swal2-show {
            animation: swalPopupIn 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        }

        @keyframes swalPopupIn {
            0% {
                opacity: 0;
                transform: scale(0.3) rotateX(-30deg);
            }
            70% {
                transform: scale(1.08) rotateX(5deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotateX(0);
            }
        }

        /* ===== ICON STYLING (SVG) ===== */
        .swal-icon-custom {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 1.5rem 2rem 0.75rem 2rem !important;
            border-bottom: 2px solid #d1fae5 !important;
            background: linear-gradient(135deg, rgba(15, 252, 226, 0.02) 0%, rgba(16, 185, 129, 0.02) 100%) !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
            min-height: 96px !important;
            position: relative !important;
            z-index: 100 !important;
            overflow: visible !important;
            margin: 0 !important;
            box-sizing: border-box !important;
        }

        .swal-icon-svg {
            width: 80px !important;
            height: 80px !important;
            display: block !important;
            transition: transform 0.25s ease !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2) !important;
            transform-origin: center center !important;
            animation: swalIconReveal 0.55s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            position: relative !important;
            z-index: 101 !important;
        }

        .swal-icon-svg:hover {
            transform: scale(1.06) !important;
        }

        @keyframes swalIconReveal {
            0% { opacity: 0; transform: translateY(-18px) scale(0.6); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ===== HEADER & TITLE ===== */
        /* increase top padding so there's a clear gap between the popup top (close button/icon)
           and the title; add small top margin on titles to separate from the icon area */
        .swal2-header {
            padding: 2.75rem 2rem 0 2rem !important;
        }

        .swal-themed-header {
            padding: 2.75rem 2rem 0 2rem !important;
        }

        .swal-themed-title {
            color: #059669 !important;
            font-weight: 800 !important;
            font-size: 1.65rem !important;
            margin: 0 0 0.75rem 0 !important;
            padding: 0 !important;
            letter-spacing: -0.5px;
        }

        .swal2-title {
            color: #059669 !important;
            font-weight: 800 !important;
            font-size: 1.65rem !important;
            margin-top: 0.5rem !important;
        }

        /* ===== CONTENT ===== */
        .swal2-content,
        .swal-themed-content {
            padding: 1rem 2rem !important;
            color: #1e293b !important;
        }

        .swal2-html-container {
            padding: 0 !important;
            color: #1e293b !important;
        }

        .swal2-html-container p {
            margin: 0.5rem 0;
            line-height: 1.6;
        }

        .swal2-html-container strong {
            color: #059669;
            font-weight: 700;
        }

        /* ===== ICONS - COMPLETELY HIDDEN ===== */
        .swal2-popup .swal2-icon {
            display: none !important;
            visibility: hidden !important;
            width: 0 !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* ===== ENSURE ICON WRAPPER IS VISIBLE ===== */
        .swal2-popup .swal-icon-custom,
        .swal2-popup .swal-icon-custom * {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* ===== ENSURE CLOSE BUTTON & IMAGE ARE VISIBLE ===== */
        /* Some SweetAlert internals use .swal2-image or inner icons that were hidden by broad rules.
           Make the close button and its children visible so users can see the close icon. */
        .swal2-popup .swal2-close,
        .swal2-popup .swal2-close * {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Ensure Swal image placeholders are visible when used */
        .swal2-popup .swal2-image {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: auto !important;
            height: auto !important;
            max-width: 100% !important;
            max-height: 160px !important;
            margin: 0 auto 0.5rem auto !important;
        }

        @keyframes swalIconBounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .swal2-icon.swal2-success {
            display: none !important;
        }

        .swal2-icon.swal2-error {
            display: none !important;
        }

        .swal2-icon.swal2-warning {
            display: none !important;
        }

        .swal2-icon.swal2-info {
            display: none !important;
        }

        .swal2-icon.swal2-question {
            display: none !important;
        }

        /* ===== BUTTONS - REDESIGNED ===== */
        .swal2-actions {
            gap: 1rem !important;
            padding: 2rem !important;
            border-top: 2px solid #e2e8f0 !important;
            display: flex !important;
            justify-content: center !important;
            flex-wrap: wrap !important;
        }

        .swal-themed-confirm-btn,
        .swal-themed-cancel-btn {
            min-width: 140px !important;
            padding: 1rem 2.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            letter-spacing: 0.3px !important;
            border: none !important;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer !important;
            font-family: 'Inter', sans-serif !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.6rem !important;
            text-transform: uppercase !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
        }

        .swal-themed-confirm-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
        }

        .swal-themed-confirm-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.5) !important;
        }

        .swal-themed-confirm-btn:active {
            transform: translateY(0) !important;
        }

        .swal-themed-cancel-btn {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%) !important;
            color: #374151 !important;
            border: 2px solid #d1d5db !important;
            font-weight: 600 !important;
        }

        .swal-themed-cancel-btn:hover {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%) !important;
            border-color: #9ca3af !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12) !important;
        }

        .swal-themed-cancel-btn:active {
            transform: translateY(0) !important;
        }

        /* ===== CLOSE BUTTON ===== */
        .swal2-close {
            color: #64748b !important;
            width: 36px !important;
            height: 36px !important;
            top: 1.5rem !important;
            right: 1.5rem !important;
            transition: transform 0.28s ease, opacity 0.28s ease !important;
            transform-origin: center center !important;
            opacity: 0 !important;
            animation: swalCloseReveal 0.45s cubic-bezier(0.2, 0.9, 0.2, 1) forwards !important;
        }

        .swal2-close:hover,
        .swal2-close:active {
            /* No hover/active visual changes requested - keep layout stable */
            background-color: transparent !important;
            color: inherit !important;
            transform: none !important;
            box-shadow: none !important;
            opacity: 1 !important;
            cursor: pointer !important;
        }

        .swal2-close:focus {
            /* Keep accessible focus ring but no layout-shifting transforms */
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(16,185,129,0.12) !important;
        }

        @keyframes swalCloseReveal {
            0% { opacity: 0; transform: translateY(-8px) scale(0.85); }
            60% { opacity: 1; transform: translateY(2px) scale(1.02); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ===== CLOSE BUTTON CLICK ROTATION ===== */
        .swal2-close.swal-close-rotate {
            animation: swalCloseClick 0.5s cubic-bezier(0.2, 0.9, 0.2, 1) forwards !important;
        }

        @keyframes swalCloseClick {
            0% { transform: rotate(0deg) scale(1); opacity: 1; }
            60% { transform: rotate(340deg) scale(1.03); opacity: 1; }
            100% { transform: rotate(360deg) scale(0.98); opacity: 0.95; }
        }

        /* ===== LOADING SPINNER ===== */
        .swal2-loading {
            border-color: #e5e7eb !important;
            border-right-color: #10b981 !important;
            animation: swalSpinnerRotate 0.8s linear infinite !important;
        }

        @keyframes swalSpinnerRotate {
            to {
                transform: rotate(360deg);
            }
        }

        /* ===== BACKDROP ===== */
        .swal2-container.swal2-backdrop-show {
            background: rgba(0, 0, 0, 0.55) !important;
            backdrop-filter: blur(4px);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .swal2-popup,
            .swal-themed-popup {
                width: 90vw !important;
                padding: 0 !important;
                border-radius: 18px !important;
            }

            .swal-icon-custom {
                padding: 1.5rem;
            }

            .swal-themed-title {
                font-size: 1.35rem !important;
            }

            .swal-themed-confirm-btn,
            .swal-themed-cancel-btn {
                padding: 0.8rem 1.5rem !important;
                font-size: 0.85rem !important;
            }
        }
    `;
    document.head.appendChild(style);
    console.log('✓ SweetAlert2 Theme Initialized Successfully');
    console.log('✓ Enhanced Modal Shape, Icon, and Animations Applied');
});

// Ensure swalTheme is globally accessible
console.log('✓ swalTheme object ready:', typeof window.swalTheme);

// Delegated click handler: run rotation animation on close button then close modal
document.addEventListener('click', function (e) {
    const btn = e.target.closest && e.target.closest('.swal2-close');
    if (!btn) return;

    // Prevent SweetAlert's immediate close so animation can run
    e.stopImmediatePropagation();
    e.preventDefault();

    // If already animating, ignore
    if (btn.classList.contains('swal-close-rotate')) return;

    btn.classList.add('swal-close-rotate');
    btn.setAttribute('aria-pressed', 'true');

    btn.addEventListener('animationend', function () {
        btn.classList.remove('swal-close-rotate');
        btn.removeAttribute('aria-pressed');
        // Close the currently open Swal modal
        if (window.Swal && typeof window.Swal.close === 'function') {
            window.Swal.close();
        }
    }, { once: true });
});
