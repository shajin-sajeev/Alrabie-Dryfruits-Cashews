<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Al Rabie</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('admin.login.store') }}" class="auth-form">
            @csrf
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="display: inline-block; margin-bottom: 1rem;">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" style="width: 100px; height: 100px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                </div>
                <h2 style="margin-top: 1rem; color: var(--gray-900);">Al Rabie Admin</h2>
                <p style="color: var(--gray-600); margin: 0.5rem 0;">Stock Management Portal</p>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="background: #fee2e2; color: #7f1d1d; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #dc2626;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your registered email">
                @error('email')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                @error('password')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.5rem; margin-bottom: 1.5rem;">
                <input type="checkbox" id="remember" name="remember" value="1" style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary-green);">
                <label for="remember" style="margin: 0; cursor: pointer; color: #111827; font-weight: 500; font-size: 0.95rem;">Remember me for 30 days</label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
                    Login
                </button>
            </div>

            <div class="auth-footer">
                Don't have an account? <a href="{{ route('admin.register') }}" style="color: var(--primary-green); font-weight: 600;">Register here</a>
            </div>
        </form>
    </div>
</body>
</html>
