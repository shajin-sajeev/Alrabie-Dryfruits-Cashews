// ===================================
// ADMIN PANEL - JavaScript
// ===================================

document.addEventListener('DOMContentLoaded', function() {
    initializeAdminFeatures();
    initializeFormValidation();
    initializeImagePreview();
    initializeDeleteButtons();
});

// ===================================
// DELETE WITH AJAX & SWEETALERT
// ===================================

function initializeDeleteButtons() {
    const deleteButtons = document.querySelectorAll('.btn-delete-ajax');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const itemName = this.getAttribute('data-item-name');
            const url = this.getAttribute('data-url');
            const itemType = this.getAttribute('data-item-type') || 'item';
            
            Swal.fire({
                title: 'Delete ' + itemType.charAt(0).toUpperCase() + itemType.slice(1) + '?',
                html: `<p style="color: #666; font-size: 0.95rem;">You are about to delete <strong>${itemName}</strong></p>
                       <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem;">This action cannot be undone.</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash"></i> Delete',
                cancelButtonText: '<i class="fas fa-times"></i> Cancel',
                htmlContent: true,
                allowOutsideClick: false,
                allowEscapeKey: true,
                didOpen: (modal) => {
                    const confirmBtn = modal.querySelector('[data-swal-role="confirm"]');
                    if (confirmBtn) {
                        confirmBtn.innerHTML = '<i class="fas fa-trash" style="margin-right: 0.5rem;"></i> Delete';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete(url, itemName, itemType);
                }
            });
        });
    });
}

function performDelete(url, itemName, itemType) {
    // Show loading state
    Swal.fire({
        title: 'Deleting...',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Delete failed');
        }
        return response.json();
    })
    .then(data => {
        Swal.fire({
            title: 'Deleted!',
            html: `<p style="color: #333;">${itemType.charAt(0).toUpperCase() + itemType.slice(1)} <strong>${itemName}</strong> has been deleted.</p>`,
            icon: 'success',
            confirmButtonColor: '#10b981',
            confirmButtonText: 'OK'
        }).then(() => {
            location.reload();
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            html: '<p style="color: #333;">Failed to delete the ' + itemType + '. Please try again.</p>',
            icon: 'error',
            confirmButtonColor: '#10b981',
            confirmButtonText: 'OK'
        });
    });
}

// ===================================
// ADMIN FEATURES
// ===================================

function initializeAdminFeatures() {
    // Toggle sidebar on mobile
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking on a link
    const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            }
        });
    });

    // Active menu highlighting
    const currentLocation = location.pathname;
    sidebarLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentLocation.includes(href) && href !== '/admin/dashboard') {
            link.classList.add('active');
        } else if (currentLocation === '/admin/dashboard' && href === '/admin/dashboard') {
            link.classList.add('active');
        }
    });
}

// ===================================
// FORM VALIDATION
// ===================================

function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            showFieldError(input, 'This field is required');
            isValid = false;
        } else if (input.type === 'email' && !validateEmail(input.value)) {
            showFieldError(input, 'Please enter a valid email');
            isValid = false;
        } else if (input.type === 'number' && isNaN(input.value)) {
            showFieldError(input, 'Please enter a valid number');
            isValid = false;
        } else {
            clearFieldError(input);
        }
    });
    
    return isValid;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showFieldError(input, message) {
    let errorEl = input.nextElementSibling;
    
    if (!errorEl || !errorEl.classList.contains('error-message')) {
        errorEl = document.createElement('div');
        errorEl.className = 'error-message';
        input.parentNode.insertBefore(errorEl, input.nextSibling);
    }
    
    errorEl.textContent = message;
    errorEl.style.color = 'var(--error-color)';
    errorEl.style.fontSize = '0.85rem';
    errorEl.style.marginTop = '0.25rem';
    input.style.borderColor = 'var(--error-color)';
}

function clearFieldError(input) {
    const errorEl = input.nextElementSibling;
    if (errorEl && errorEl.classList.contains('error-message')) {
        errorEl.remove();
    }
    input.style.borderColor = '';
}

// ===================================
// IMAGE PREVIEW
// ===================================

function initializeImagePreview() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    let preview = document.querySelector('.image-preview img');
                    
                    if (!preview) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'image-preview';
                        preview = document.createElement('img');
                        previewDiv.appendChild(preview);
                        input.parentNode.insertBefore(previewDiv, input.nextSibling);
                    }
                    
                    preview.src = e.target.result;
                    preview.style.animation = 'fadeIn 0.3s ease-out';
                };
                
                reader.readAsDataURL(file);
            }
        });
    });
}

// ===================================
// DELETE CONFIRMATION
// ===================================

function confirmDelete(message = 'Are you sure you want to delete this item?') {
    return confirm(message);
}

// ===================================
// TABLE ACTIONS
// ===================================

function enableRowSelection() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectAllCheckbox = document.querySelector('input[name="select_all"]');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                if (checkbox !== selectAllCheckbox) {
                    checkbox.checked = this.checked;
                }
            });
        });
    }
}

// ===================================
// SEARCH & FILTER
// ===================================

function searchTable(inputSelector, tableSelector) {
    const searchInput = document.querySelector(inputSelector);
    const table = document.querySelector(tableSelector);
    
    if (!searchInput || !table) return;
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
}

// ===================================
// BULK ACTIONS
// ===================================

function performBulkAction(action) {
    const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    const selectedIds = Array.from(selectedCheckboxes)
        .map(cb => cb.value)
        .filter(val => val);
    
    if (selectedIds.length === 0) {
        alert('Please select at least one item');
        return false;
    }
    
    if (action === 'delete' && !confirm('Are you sure you want to delete these items?')) {
        return false;
    }
    
    return true;
}

// ===================================
// EXPORT FUNCTIONALITY
// ===================================

function exportTableToCSV(filename, tableSelector) {
    const table = document.querySelector(tableSelector);
    if (!table) return;
    
    let csv = [];
    const rows = table.querySelectorAll('tr');
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td, th');
        const rowData = Array.from(cells).map(cell => {
            return '"' + cell.textContent.trim().replace(/"/g, '""') + '"';
        });
        csv.push(rowData.join(','));
    });
    
    downloadCSV(csv.join('\n'), filename);
}

function downloadCSV(csvContent, filename) {
    const link = document.createElement('a');
    link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent);
    link.download = filename || 'export.csv';
    link.click();
}

// ===================================
// NOTIFICATIONS
// ===================================

function showAdminNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.textContent = message;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.maxWidth = '400px';
    notification.style.animation = 'slideDown 0.3s ease-out';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ===================================
// DATA TABLE INITIALIZATION
// ===================================

function initializeDataTable(tableSelector) {
    const table = document.querySelector(tableSelector);
    if (!table) return;

    // Add row numbers
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        const firstCell = row.querySelector('td');
        if (firstCell && !firstCell.textContent.match(/^\d+$/)) {
            const numberCell = document.createElement('td');
            numberCell.textContent = index + 1;
            numberCell.style.fontWeight = 'bold';
            numberCell.style.color = 'var(--primary-color)';
            row.insertBefore(numberCell, firstCell);
        }
    });
}

// ===================================
// CHART/STATS ANIMATIONS
// ===================================

function animateStats() {
    const statValues = document.querySelectorAll('.stat-value');
    
    statValues.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        if (isNaN(finalValue)) return;
        
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 50);
        
        const interval = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                stat.textContent = finalValue;
                clearInterval(interval);
            } else {
                stat.textContent = currentValue;
            }
        }, 20);
    });
}

// ===================================
// DARK MODE TOGGLE (If needed)
// ===================================

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

// ===================================
// EXPORT & IMPORT
// ===================================

function exportData(dataType) {
    // This would typically make an API call to export data
    console.log(`Exporting ${dataType}...`);
    showAdminNotification(`${dataType} exported successfully`, 'success');
}

function importData(file) {
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        try {
            const data = JSON.parse(e.target.result);
            console.log('Imported data:', data);
            showAdminNotification('Data imported successfully', 'success');
        } catch (error) {
            showAdminNotification('Invalid file format', 'error');
        }
    };
    
    reader.readAsText(file);
}
