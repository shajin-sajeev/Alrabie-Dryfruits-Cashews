<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Al Rabie')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Icons & Plugins -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="logo-image">
                    <span class="logo-text">Al Rabie</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <p class="nav-label">Main Dashboard</p>
                    <ul class="sidebar-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif">
                                <i class="fas fa-chart-pie"></i>
                                <span>Overview</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <p class="nav-label">Store Management</p>
                    <ul class="sidebar-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link @if(str_contains(Route::currentRouteName(), 'categories')) active @endif">
                                <i class="fas fa-layer-group"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link @if(str_contains(Route::currentRouteName(), 'products')) active @endif">
                                <i class="fas fa-box-open"></i>
                                <span>Products</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <p class="nav-label">Preferences</p>
                    <ul class="sidebar-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Top Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="sidebar-toggle btn-icon shadow-sm" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="title-meta">
                        <h1 class="page-title">@yield('admin-title', 'Dashboard')</h1>
                        <p class="page-subtitle">@yield('admin-subtitle', 'Welcome back, ' . (Auth::user()->name ?? 'Admin'))</p>
                    </div>
                </div>

                <div class="header-right">
                    <div class="admin-user-nav">
                        <div class="user-profile-trigger" id="profileDropdownTrigger">
                            <div class="user-avatar shadow-sm">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <i class="fas fa-user-tie"></i>
                                @endif
                            </div>
                            <div class="user-details">
                                <p class="user-name">{{ Auth::user()->name ?? 'Administrator' }}</p>
                                <p class="user-role">Master Admin</p>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </div>

                        <div class="profile-dropdown shadow-lg" id="profileDropdown">
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                                        <i class="fas fa-user-circle"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('admin.logout') }}" class="dropdown-item logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="admin-content">
                <!-- Alerts Container -->
                <div class="alerts-wrapper">
                    @if (session('success'))
                    <div class="alert alert-success" style="background: #ecfdf5; border-left: 4px solid var(--success); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                            <span style="color: #065f46; font-weight: 500;">{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #065f46; font-size: 1.25rem;">&times;</button>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" style="background: #fef2f2; border-left: 4px solid var(--danger); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-exclamation-circle" style="color: var(--danger);"></i>
                            <span style="color: #991b1b; font-weight: 500;">{{ session('error') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #991b1b; font-size: 1.25rem;">&times;</button>
                    </div>
                    @endif
                </div>

                @yield('admin-content')
            </div>
        </main>
        <div class="sidebar-overlay"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/sweetalert-theme.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/admin.js') }}?v={{ time() }}"></script>
    @yield('scripts')
</body>

</html>