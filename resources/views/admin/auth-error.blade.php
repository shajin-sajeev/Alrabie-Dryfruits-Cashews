<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access Required - Al Rabie Dry Fruits</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --primary-light: rgba(16, 185, 129, 0.1);
            --secondary-color: #f59e0b;
            --accent-color: #0d9488;
            --text-main: #0f172a;
            --text-muted: #475569;
            --bg-card: #f8fafc;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, var(--bg-card) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative background elements */
        body::before {
            content: '';
            position: fixed;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .error-wrapper {
            position: relative;
            z-index: 10;
        }

        .error-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08), 0 0 40px rgba(16, 185, 129, 0.05);
            max-width: 550px;
            width: 100%;
            padding: 70px 50px;
            text-align: center;
            border-top: 5px solid var(--primary-color);
            position: relative;
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        /* Logo Section */
        .logo-section {
            margin-bottom: 40px;
        }

        .logo-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .logo-image {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-color);
            letter-spacing: -0.5px;
        }

        /* Badge */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            margin-bottom: 25px;
        }

        /* Error Icon */
        .error-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(13, 148, 136, 0.08) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 52px;
            color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.1);
            border: 2px solid rgba(16, 185, 129, 0.15);
        }

        h1 {
            color: var(--text-main);
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .error-message {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 35px;
            background: var(--bg-card);
            padding: 22px;
            border-radius: 14px;
            border-left: 4px solid var(--primary-color);
        }

        /* Auth Info Box */
        .auth-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(13, 148, 136, 0.05) 100%);
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 35px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .auth-info-icon {
            font-size: 22px;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .auth-info-text {
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: 600;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.25);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.35);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
        }

        .btn-secondary:active {
            transform: translateY(-1px);
        }

        /* Divider */
        .divider {
            margin: 35px 0 0 0;
            padding-top: 30px;
            border-top: 1px solid rgba(16, 185, 129, 0.15);
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 500;
        }

        .divider i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 600px) {
            .error-container {
                padding: 50px 30px;
            }

            h1 {
                font-size: 26px;
            }

            .error-message {
                font-size: 14px;
            }

            .error-icon {
                width: 85px;
                height: 85px;
                font-size: 45px;
            }

            .logo-image {
                width: 45px;
                height: 45px;
            }

            .logo-text {
                font-size: 20px;
            }

            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="error-wrapper">
        <div class="error-container">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-brand">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Al Rabie Logo" class="logo-image">
                    <span class="logo-text">Al Rabie</span>
                </div>
            </div>

            <!-- Admin Badge -->
            <div class="admin-badge">
                <i class="fas fa-shield-alt"></i>
                Admin Panel
            </div>

            <!-- Error Icon -->
            <div class="error-icon">
                <i class="fas fa-lock"></i>
            </div>

            <!-- Heading -->
            <div class="subtitle">Secure Access Required</div>
            <h1>Authentication Required</h1>

            <!-- Message -->
            <p class="error-message">
                You need to log in first to access the admin panel. Please authenticate with your admin credentials to proceed.
            </p>

            <!-- Auth Info -->
            <div class="auth-info">
                <span class="auth-info-icon"><i class="fas fa-info-circle"></i></span>
                <span class="auth-info-text">Verify your credentials to continue</span>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Admin Login
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>

            <!-- Divider -->
            <div class="divider">
                <i class="fas fa-leaf"></i> Premium Dry Fruits & Nuts
            </div>
        </div>
    </div>
</body>

</html>
