<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Al Rabie')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="logo-image">
                    <span>Al Rabie</span>
                </div>
                <p class="sidebar-subtitle">Admin Portal</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <p class="nav-label">Main</p>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::current()->getName() == 'admin.dashboard') active @endif">
                                <i class="fas fa-chart-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <p class="nav-label">Management</p>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="nav-link @if(str_contains(Route::current()->getName(), 'categories')) active @endif">
                                <i class="fas fa-folder"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="nav-link @if(str_contains(Route::current()->getName(), 'products')) active @endif">
                                <i class="fas fa-box"></i>
                                <span>Products</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <p class="nav-label">Account</p>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
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
                    <div class="logo-section">
                        <i class="fas fa-leaf"></i>
                        <div>
                            <h1 class="page-title">@yield('admin-title', 'Dashboard')</h1>
                            <p class="page-subtitle">@yield('admin-subtitle', 'Welcome back to your store')</p>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="admin-user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-details">
                            <p class="user-name">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="user-role">Stock Manager</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            <div class="alerts-container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $message }}</span>
                        <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                        <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle"></i>
                            <span>{{ $error }}</span>
                            <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Content -->
            <div class="admin-content">
                @yield('admin-content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
