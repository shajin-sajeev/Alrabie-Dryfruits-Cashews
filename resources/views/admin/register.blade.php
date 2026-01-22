<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Al Rabie</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('admin.register.store') }}" class="auth-form">
            @csrf
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="display: inline-block; margin-bottom: 1rem;">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" style="width: 100px; height: 100px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                </div>
                <h2 style="margin-top: 1rem; color: var(--gray-900);">Al Rabie Admin</h2>
                <p style="color: var(--gray-600); margin: 0.5rem 0;">Create Your Admin Account</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #fee2e2; color: #7f1d1d; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #dc2626;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                    <strong>Registration Failed!</strong>
                    <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                @error('name')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter a valid email">
                @error('email')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Minimum 8 characters">
                @error('password')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Re-enter your password">
                @error('password_confirmation')
                    <span style="color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus" style="margin-right: 0.5rem;"></i>
                    Create Account
                </button>
            </div>

            <div class="auth-footer">
                Already have an account? <a href="{{ route('admin.login') }}" style="color: var(--primary-green); font-weight: 600;">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
