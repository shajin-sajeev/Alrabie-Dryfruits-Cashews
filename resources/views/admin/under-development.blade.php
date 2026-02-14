<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Al Rabie Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        .dev-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top left, #f8fafc, #e2e8f0);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dev-container::before,
        .dev-container::after {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: var(--primary-glow);
            filter: blur(80px);
            z-index: 0;
        }

        .dev-container::before {
            top: -200px;
            right: -200px;
        }

        .dev-container::after {
            bottom: -200px;
            left: -200px;
            background: rgba(14, 165, 233, 0.1);
        }

        .dev-card {
            width: 100%;
            max-width: 600px;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 4rem;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            animation: devFadeIn 0.8s ease-out;
        }

        @keyframes devFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dev-illustration {
            width: 100%;
            max-width: 350px;
            margin: 0 auto 2.5rem;
            display: block;
            filter: drop-shadow(0 20px 30px rgba(16, 185, 129, 0.2));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .dev-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.025em;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dev-message {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .pulse-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2.5rem;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        .pulse-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .pulse-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.5);
                opacity: 1;
            }
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            transition: all var(--duration);
            box-shadow: var(--shadow-glow);
        }

        .btn-back:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
        }
    </style>
</head>

<body>
    <div class="dev-container">
        <div class="dev-card">
            <!-- Lottie Animation -->
            <div style="width: 100%; max-width: 300px; margin: 0 auto 2rem;">
                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                <dotlottie-player src="https://lottie.host/81a96677-7038-4e56-9ce2-9c3f46f48a95/t9yQ70S6Y8.lottie" background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay></dotlottie-player>
            </div>

            <h1 class="dev-title">We're Brewing Something Great!</h1>
            <p class="dev-message">
                We are working hard on the Google Login integration to make your experience even smoother. Hope you get it soon!
            </p>

            <div class="pulse-container">
                <div class="pulse-dot"></div>
                <div class="pulse-dot"></div>
                <div class="pulse-dot"></div>
            </div>

            <a href="{{ route('admin.login') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Login</span>
            </a>
        </div>
    </div>
</body>

</html>