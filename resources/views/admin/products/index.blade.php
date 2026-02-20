@extends('layouts.admin')

@section('admin-title', 'Products')
@section('admin-subtitle', 'Manage your product inventory')
<style>
    /* Filter Accordion Styles */
    .filter-accordion-wrapper {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .filter-accordion-wrapper:hover {
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.08);
        border-color: #d1fae5;
    }

    .filter-accordion-toggle {
        width: 100%;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-bottom: 1px solid #e2e8f0;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        font-family: inherit;
        font-weight: 600;
        color: var(--text-main);
    }

    .filter-accordion-toggle:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .filter-accordion-toggle.expanded {
        background: linear-gradient(135deg, #f1f5f9 0%, #e0f2fe 100%);
        border-bottom-color: #0ea5e9;
    }

    .filter-toggle-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
    }

    .filter-toggle-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
    }

    .filter-toggle-title i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.85rem;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: var(--primary-dark);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
    }

    .filter-toggle-icon {
        transition: transform 0.3s ease;
        color: var(--primary-color);
        font-size: 1rem;
    }

    .filter-accordion-toggle.expanded .filter-toggle-icon {
        transform: rotate(180deg);
    }

    .filter-accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.3s ease;
        opacity: 0;
    }

    .filter-accordion-content.open {
        max-height: 600px;
        opacity: 1;
    }

    .filter-form {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .filter-group-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .filter-group-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 700;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .filter-group-title i {
        color: var(--primary-color);
        width: 28px;
        height: 28px;
        background: var(--primary-light);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .filter-group-count {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary-color);
        background: var(--primary-light);
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
    }

    .category-chips-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .category-chip-wrapper {
        position: relative;
    }

    .category-checkbox {
        display: none;
    }

    .category-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1.2rem;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.25s ease;
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--text-main);
    }

    .category-chip:hover {
        background: #e0f2fe;
        border-color: #0ea5e9;
        transform: translateY(-2px);
    }

    .chip-checkmark {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        background: white;
        border: 2px solid #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: transparent;
        transition: all 0.2s ease;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .category-chip.active {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-color: var(--primary-color);
        color: var(--primary-dark);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .category-chip.active .chip-checkmark {
        background: var(--primary-color);
        border-color: var(--primary-dark);
        color: white;
    }

    .category-chip.active:hover {
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .chip-label {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .filter-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        padding-top: 0.75rem;
        border-top: 1px solid #e2e8f0;
    }

    .btn-filter-apply,
    .btn-filter-reset {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: inherit;
        text-decoration: none;
    }

    .btn-filter-apply {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .btn-filter-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-filter-apply:active {
        transform: translateY(0);
    }

    .btn-filter-reset {
        background: #f1f5f9;
        color: var(--text-main);
        border: 1px solid #cbd5e1;
    }

    .btn-filter-reset:hover {
        background: #e2e8f0;
        border-color: #94a3b8;
        transform: translateY(-2px);
    }

    .btn-filter-reset:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .filter-form {
            padding: 1.25rem;
        }

        .category-chips-container {
            gap: 0.5rem;
        }

        .category-chip {
            font-size: 0.85rem;
            padding: 0.55rem 1rem;
        }

        .filter-actions {
            margin-top: 0.5rem;
        }

        .btn-filter-apply,
        .btn-filter-reset {
            flex: 1;
            justify-content: center;
            font-size: 0.85rem;
            padding: 0.65rem 1rem;
        }
    }
</style>

@section('admin-content')

    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-box"></i>
            All Products
        </h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Filter Accordion Section -->
    @php
        $hasActiveFilters = request()->has('categories') && !empty(request()->query('categories', []));
    @endphp
    <div class="filter-accordion-wrapper">
        <button type="button" class="filter-accordion-toggle {{ $hasActiveFilters ? 'expanded' : '' }}" id="filterToggleBtn">
            <div class="filter-toggle-content">
                <span class="filter-toggle-title">
                    <i class="fas fa-filter"></i> Filter Products
                </span>
                @if ($hasActiveFilters)
                    <span class="filter-badge">{{ count(request()->query('categories', [])) }} selected</span>
                @endif
            </div>
            <i class="fas fa-chevron-down filter-toggle-icon"></i>
        </button>

        <div class="filter-accordion-content {{ $hasActiveFilters ? 'open' : '' }}" id="filterContent">
            <form id="filterForm" method="GET" action="{{ route('admin.products.index') }}" class="filter-form">
                <div class="filter-group">
                    <div class="filter-group-header">
                        <span class="filter-group-title">
                            <i class="fas fa-layer-group"></i> Select Categories
                        </span>
                        <span class="filter-group-count" id="filterSelectedCount">
                            @if ($hasActiveFilters)
                                {{ count(request()->query('categories', [])) }} selected
                            @else
                                All
                            @endif
                        </span>
                    </div>
                    <div class="category-chips-container">
                        @foreach ($categories as $category)
                            @php
                                $isSelected = in_array($category->id, request()->query('categories', []));
                            @endphp
                            <div class="category-chip-wrapper">
                                <input type="checkbox" id="category-{{ $category->id }}" name="categories[]"
                                    value="{{ $category->id }}" class="category-checkbox"
                                    {{ $isSelected ? 'checked' : '' }}>
                                <label for="category-{{ $category->id }}"
                                    class="category-chip {{ $isSelected ? 'active' : '' }}">
                                    <span class="chip-checkmark">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="chip-label">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter-apply">
                        <i class="fas fa-search"></i>
                        <span>Apply Filters</span>
                    </button>
                    @if ($hasActiveFilters)
                        <a href="{{ route('admin.products.index') }}" class="btn-filter-reset">
                            <i class="fas fa-redo"></i>
                            <span>Reset All</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryChips = document.querySelectorAll('.category-chip');
            const categoryInputs = document.querySelectorAll('.category-chip-input');
            const filterForm = document.getElementById('filterForm');
            const resetBtn = document.getElementById('resetFilterBtn');

            // Auto-submit form when category is selected/deselected
            categoryChips.forEach((chip, index) => {
                chip.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'INPUT') {
                        categoryInputs[index].click();
                    }
                });
            });

            categoryInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    categoryChips[index].classList.toggle('active');
                });
            });

            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = "{{ route('admin.products.index') }}";
                });
            }
        });
    </script>


    <!-- Bulk Actions Section -->
    <div class="bulk-actions-section" id="bulkActionsSection" style="display: none;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <span id="bulkSelectedCount" style="font-weight: 600; color: var(--text-dark);">0 products selected</span>
            <button type="button" id="selectAllBtn" class="btn"
                style="padding: 0.5rem 1rem; background: var(--primary-light); color: var(--primary-dark); border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">
                <i class="fas fa-check-square"></i> Select All
            </button>
            <button type="button" id="deselectAllBtn" class="btn"
                style="padding: 0.5rem 1rem; background: var(--primary-light); color: var(--primary-dark); border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">
                <i class="fas fa-square"></i> Deselect All
            </button>
        </div>
        <button type="button" id="bulkDeleteBtn" class="btn"
            style="padding: 0.5rem 1rem; background: #ef4444; color: white; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">
            <i class="fas fa-trash"></i> Delete Selected
        </button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">
                        <input type="checkbox" id="masterCheckbox" style="cursor: pointer; width: 18px; height: 18px;">
                    </th>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="product-row">
                        <td>
                            <input type="checkbox" class="product-checkbox" data-product-id="{{ $product->id }}"
                                style="cursor: pointer; width: 18px; height: 18px;">
                        </td>
                        <td>
                            <strong
                                style="color: var(--primary-dark);">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</strong>
                        </td>
                        <td>
                            @if ($product->image)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div
                                    style="width: 48px; height: 48px; background: var(--bg-main); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; border: 1px dashed var(--border-color);">
                                    <i class="fas fa-image" style="color: var(--text-muted);"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small style="color: var(--gray-500);">{{ $product->unit }}</small>
                        </td>
                        <td>
                            <span
                                style="background: var(--primary-light); color: var(--primary-dark); padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            <strong
                                style="color: var(--primary-dark); font-size: 1.1rem;">₹{{ number_format($product->price, 2) }}</strong>
                        </td>
                        <td>
                            @if ($product->quantity > 10)
                                <span
                                    style="background: #ecfdf5; color: #059669; padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">
                                    {{ $product->quantity }} in stock
                                </span>
                            @elseif($product->quantity > 0)
                                <span
                                    style="background: #fffbeb; color: #d97706; padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">
                                    Low: {{ $product->quantity }}
                                </span>
                            @else
                                <span
                                    style="background: #fef2f2; color: #dc2626; padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">
                                    Out of Stock
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit"
                                    title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn-delete-ajax"
                                    data-url="{{ route('admin.products.destroy', $product->id) }}"
                                    data-item-name="{{ $product->name }}" data-item-type="product" title="Delete Product">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <p class="empty-state-text">No products yet</p>
                                <p class="empty-state-subtext">Start adding products to build your catalog</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
                products
            </div>
            {{ $products->links('vendor.pagination.admin') }}
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const masterCheckbox = document.getElementById('masterCheckbox');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const bulkActionsSection = document.getElementById('bulkActionsSection');
            const selectedCountSpan = document.getElementById('bulkSelectedCount');
            const selectAllBtn = document.getElementById('selectAllBtn');
            const deselectAllBtn = document.getElementById('deselectAllBtn');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

            // Update bulk actions section visibility and count
            function updateBulkActionsUI() {
                const productCheckboxesAll = document.querySelectorAll('.product-checkbox:not([disabled])');
                const selectedCount = document.querySelectorAll('.product-checkbox:checked').length;

                selectedCountSpan.textContent = selectedCount + ' product' + (selectedCount !== 1 ? 's' : '') +
                    ' selected';

                if (selectedCount > 0) {
                    bulkActionsSection.style.display = 'flex';
                } else {
                    bulkActionsSection.style.display = 'none';
                }

                // Update master checkbox state
                const totalCheckboxes = productCheckboxesAll.length;
                if (selectedCount === totalCheckboxes && totalCheckboxes > 0) {
                    masterCheckbox.checked = true;
                    masterCheckbox.indeterminate = false;
                } else if (selectedCount > 0) {
                    masterCheckbox.checked = false;
                    masterCheckbox.indeterminate = true;
                } else {
                    masterCheckbox.checked = false;
                    masterCheckbox.indeterminate = false;
                }
            }

            // Master checkbox toggle
            masterCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActionsUI();
            });

            // Individual product checkbox toggle
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateBulkActionsUI();
                });
            });

            // Select All button
            selectAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
                // Trigger change events
                productCheckboxes.forEach(checkbox => {
                    checkbox.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                });
                updateBulkActionsUI();
            });

            // Deselect All button
            deselectAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                // Trigger change events
                productCheckboxes.forEach(checkbox => {
                    checkbox.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                });
                updateBulkActionsUI();
            });

            // Bulk Delete button
            bulkDeleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedIds = Array.from(document.querySelectorAll('.product-checkbox:checked'))
                    .map(checkbox => checkbox.dataset.productId);

                if (selectedIds.length === 0) {
                    Swal.fire(swalTheme.warning(
                        'No Selection',
                        'Please select at least one product to delete'
                    ));
                    return;
                }

                Swal.fire(swalTheme.bulkDeleteConfirm(selectedIds.length)).then((result) => {
                    if (result.isConfirmed) {
                        bulkDeleteBtn.disabled = true;
                        const originalText = bulkDeleteBtn.innerHTML;
                        bulkDeleteBtn.innerHTML =
                            '<i class="fas fa-spinner fa-spin"></i> Deleting...';

                        // Delete each product
                        let completed = 0;
                        let failed = 0;

                        selectedIds.forEach(id => {
                            const deleteBtn = document.querySelector(
                                `button[data-url*="/admin/products/${id}"]`);
                            if (deleteBtn) {
                                const url = deleteBtn.dataset.url;

                                fetch(url, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').content,
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        completed++;
                                        if (data.success) {
                                            document.querySelector(
                                                    `input[data-product-id="${id}"]`)
                                                .closest('tr').remove();
                                        } else {
                                            failed++;
                                        }
                                        checkIfAllCompleted();
                                    })
                                    .catch(error => {
                                        failed++;
                                        completed++;
                                        checkIfAllCompleted();
                                    });
                            }
                        });

                        function checkIfAllCompleted() {
                            if (completed === selectedIds.length) {
                                bulkDeleteBtn.disabled = false;
                                bulkDeleteBtn.innerHTML = originalText;

                                if (failed === 0) {
                                    Swal.fire(swalTheme.success(
                                        'Deleted Successfully!',
                                        `${completed} product(s) deleted successfully.`
                                    )).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(swalTheme.info(
                                        'Deletion Complete',
                                        `<strong>${completed}</strong> product(s) deleted successfully.<br><strong>${failed}</strong> failed to delete.`
                                    )).then(() => {
                                        location.reload();
                                    });
                                }
                            }
                        }
                    }
                });
            });

            // Initialize UI on page load
            updateBulkActionsUI();

            // ===== FILTER ACCORDION FUNCTIONALITY =====
            const filterToggleBtn = document.getElementById('filterToggleBtn');
            const filterContent = document.getElementById('filterContent');
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const selectedCountSpan2 = document.getElementById('filterSelectedCount');

            // Toggle accordion
            filterToggleBtn.addEventListener('click', function() {
                this.classList.toggle('expanded');
                filterContent.classList.toggle('open');
            });

            // Update chip styles when checkbox changes
            categoryCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function() {
                    const label = this.nextElementSibling;
                    if (this.checked) {
                        label.classList.add('active');
                    } else {
                        label.classList.remove('active');
                    }
                    updateSelectedCount();
                });
            });

            // Update selected count display
            function updateSelectedCount() {
                const selected = document.querySelectorAll('.category-checkbox:checked').length;
                if (selected > 0) {
                    selectedCountSpan2.textContent = selected + ' selected';
                } else {
                    selectedCountSpan2.textContent = 'All';
                }
            }

            // Initialize chip styles on page load
            categoryCheckboxes.forEach((checkbox) => {
                const label = checkbox.nextElementSibling;
                if (checkbox.checked) {
                    label.classList.add('active');
                }
            });
        });
    </script>

@endsection
