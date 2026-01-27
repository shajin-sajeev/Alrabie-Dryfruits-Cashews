<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Al Rabie</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="auth-page-wrapper">
        <div class="auth-card">
            <header class="auth-header">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="auth-logo shadow-lg">
                <h1 class="auth-title">Al Rabie Admin</h1>
                <p class="auth-subtitle">Welcome back! Please login to your account.</p>
            </header>

            @if ($errors->any())
            <div class="auth-alert auth-alert-danger">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    @foreach ($errors->all() as $error)
                    <p style="margin: 0;">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="auth-input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                        <!-- <i class="fas fa-envelope"></i> -->
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="••••••••">
                        <!-- <i class="fas fa-lock"></i> -->
                    </div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem; margin-top: 1rem;">
                    <input type="checkbox" id="remember" name="remember" value="1" style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary-color);">
                    <label for="remember" style="margin: 0; cursor: pointer; font-weight: 500; color: var(--text-muted);">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right" style="margin-left: 0.5rem; font-size: 0.875rem;"></i>
                </button>
            </form>

            <div class="auth-divider">
                <span>OR</span>
            </div>

            <div class="oauth-links">
                <a href="{{ route('admin.auth.google') }}" class="btn-google">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo">
                    <span>Sign in with Google</span>
                </a>
            </div>

            <footer class="auth-footer">
                Don't have an account? <a href="{{ route('admin.register') }}">Create Account</a>
            </footer>
        </div>
    </div>
</body>

</html>