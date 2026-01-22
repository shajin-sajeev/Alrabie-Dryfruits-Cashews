<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Al Rabie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('admin.login.store') }}" class="auth-form">
            @csrf
            <h2>Admin Login</h2>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Login</button>
            </div>

            <div class="auth-footer">
                Don't have an account? <a href="{{ route('admin.register') }}">Register here</a>
            </div>
        </form>
    </div>
</body>
</html>
