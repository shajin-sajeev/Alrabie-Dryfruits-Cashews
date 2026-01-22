<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Al Rabie</title>

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
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Join the Al Rabie administration team.</p>
            </header>

            @if ($errors->any())
            <div class="auth-alert auth-alert-danger">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <strong>Registration Error</strong>
                    <ul style="margin: 0.25rem 0 0 0; padding-left: 1.25rem; font-size: 0.8125rem;">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.register.store') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="auth-input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="auth-input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Min. 8 characters">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat password">
                        <i class="fas fa-shield-check"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Create Account</span>
                    <i class="fas fa-user-plus" style="margin-left: 0.5rem; font-size: 0.875rem;"></i>
                </button>
            </form>

            <footer class="auth-footer">
                Already have an account? <a href="{{ route('admin.login') }}">Sign In</a>
            </footer>
        </div>
    </div>
</body>

</html>