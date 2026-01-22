<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Al Rabie')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-logo">Al Rabie Admin</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="@if(Route::current()->getName() == 'admin.dashboard') active @endif">📊 Dashboard</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="@if(str_contains(Route::current()->getName(), 'categories')) active @endif">📁 Categories</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="@if(str_contains(Route::current()->getName(), 'products')) active @endif">📦 Products</a></li>
                <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
            </ul>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <h1 class="admin-title">@yield('admin-title', 'Dashboard')</h1>
                <div class="admin-user">
                    <span class="admin-user-name">Welcome, Admin</span>
                </div>
            </header>

            <!-- Content -->
            <div class="admin-content">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-error">
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-error">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                @yield('admin-content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
