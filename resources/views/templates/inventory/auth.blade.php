<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/styles.css') }}" />
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            background: #0a2a4a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            animation: float 8s ease-in-out infinite;
        }
        body::before {
            width: 500px; height: 500px;
            background: #1e88e5;
            top: -100px; left: -100px;
        }
        body::after {
            width: 400px; height: 400px;
            background: #00acc1;
            bottom: -100px; right: -100px;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-30px) scale(1.05); }
        }

        .auth-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 44px 40px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.3);
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .auth-brand img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            margin-bottom: 12px;
        }
        .auth-brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: #0a2a4a;
            margin: 0 0 4px;
        }
        .auth-brand p {
            font-size: 13px;
            color: #6c757d;
            margin: 0;
        }

        @yield('auth-content')
    </style>

    @stack('css')
    <title>@yield('page-title', 'Login') — Inventory | Mal Bali Galeria</title>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-brand">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo">
                <h1>Mal Bali Galeria</h1>
                <p>Inventory Management System</p>
            </div>

            @yield('content')
        </div>

        <p class="text-center mt-4" style="color: rgba(255,255,255,0.5); font-size: 12px;">
            &copy; {{ date('Y') }} Mal Bali Galeria. All rights reserved.
        </p>
    </div>

    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/iconify-icon.min.js') }}"></script>
    @stack('script')
</body>
</html>
