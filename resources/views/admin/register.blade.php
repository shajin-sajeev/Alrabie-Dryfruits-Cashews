<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Al Rabie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('admin.register.store') }}" class="auth-form">
            @csrf
            <h2>Admin Registration</h2>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Register</button>
            </div>

            <div class="auth-footer">
                Already have an account? <a href="{{ route('admin.login') }}">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
