<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Email Verification - {{ config('app.name', 'Laravel') }}</title>

    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-light: #f1f5f9;
            --border-light: #cbd5e1;
            --success: #10b981;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            min-height: 100vh;
            background:
                linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #e0e7ff 100%),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M15,35 C25,25 45,15 65,25 C85,35 85,55 65,65 C45,75 25,65 15,55 C5,45 5,35 15,35 Z' fill='none' stroke='%233b82f6' stroke-width='0.5' stroke-opacity='0.1'/%3E%3Cpath d='M85,65 C75,75 55,85 35,75 C15,65 15,45 35,35 C55,25 75,35 85,45 C95,55 95,65 85,65 Z' fill='none' stroke='%238b5cf6' stroke-width='0.5' stroke-opacity='0.1'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: auto;
        }

        /* Additional organic pattern */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(147, 51, 234, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 50% 30%, rgba(236, 72, 153, 0.05) 0%, transparent 15%),
                radial-gradient(circle at 20% 70%, rgba(34, 197, 94, 0.05) 0%, transparent 15%);
            z-index: 0;
        }

        .auth-container {
            position: relative;
            z-index: 10;
            display: flex;
            width: 100%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .auth-image {
            flex: 1;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px 40px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .auth-image::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent 30%);
            animation: rotate 20s linear infinite;
        }

        .auth-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 10%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 10%);
            z-index: 1;
        }

        .auth-image-content {
            position: relative;
            z-index: 2;
            max-width: 300px;
            text-align: center;
        }

        .auth-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }

        .auth-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .auth-logo {
                width: 100px;
                height: 100px;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .auth-logo {
                width: 80px;
                height: 80px;
                margin-bottom: 15px;
            }
        }

        .preloader-logo img {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .preloader-content {
            text-align: center;
        }

        .preloader-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }

        .preloader-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .preloader-text {
            color: #64748b;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
        }

        .preloader-progress {
            width: 200px;
            height: 4px;
            background-color: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 15px;
        }

        .preloader-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color, #8b5cf6));
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .auth-image h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .auth-image p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .auth-forms {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-container {
            display: block;
        }

        .form-container.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 24px;
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .auth-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }

        .auth-button:hover {
            background: linear-gradient(135deg, var(--primary-hover), #4f46e5);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }

        .auth-button:active {
            transform: translateY(0);
        }

        .auth-button:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .auth-button.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .auth-button.secondary:hover {
            background: #f1f5f9;
        }

        .auth-toggle {
            text-align: center;
            margin-top: 15px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .auth-toggle a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-toggle a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: var(--success);
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            color: var(--error);
            font-size: 14px;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: var(--error) !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-light);
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-image {
                padding: 30px 20px;
            }

            .auth-forms {
                padding: 30px 20px;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    srcset="{{ asset('assets/images/logo.png') }}">
            </div>
            <div class="preloader-text">
                <p>Loading...</p>
            </div>
            <div class="preloader-progress">
                <div class="preloader-progress-bar" id="preloaderProgressBar"></div>
            </div>
        </div>
    </div>

    <script>
        // Preloader functionality with progress bar
        window.addEventListener('load', function() {
            const progressBar = document.getElementById('preloaderProgressBar');
            let width = 0;
            const interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                } else {
                    width++;
                    progressBar.style.width = width + '%';
                }
            }, 30); // Update every 30ms for smooth animation

            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 1500); // Delay of 1.5s before starting fade out to allow progress bar to complete
        });
    </script>

    <div class="auth-container">
        <div class="auth-image">
            <div class="auth-image-content">
                <div class="auth-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                        srcset="{{ asset('assets/images/logo.png') }}">
                </div>
                <h2>Verify Your Email</h2>
                <p>Check your email for verification link</p>
            </div>
        </div>

        <div class="auth-forms">
            <div class="auth-header">
                <h2>Email Verification</h2>
                <p>Please check your email for a verification link</p>
            </div>

            @if (session('message'))
                <div class="success-message">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-container active">
                <div style="text-align: center; margin-bottom: 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        style="color: var(--success); margin: 0 auto 15px auto; display: block;">
                        <path
                            d="M21.8 10.5H12v3h5.5c-.8 2.3-3 4-5.5 4-3.3 0-6-2.7-6-6s2.7-6 6-6c1.7 0 3.2.7 4.2 1.8l3-3A10 10 0 0 0 6 2C2.7 2 0 4.7 0 8s2.7 6 6 6c2.2 0 4-1.2 5-3z">
                        </path>
                    </svg>
                    <p style="font-size: 16px; color: var(--text-primary); margin-bottom: 5px;">Verification Email Sent!
                    </p>
                    <p style="font-size: 14px; color: var(--text-secondary);">We've sent a verification link to your
                        email address.</p>
                </div>

                <form id="resend-form" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button id="resend-button" type="submit" class="auth-button" disabled>
                        <span id="resend-text">Resend Email (60s)</span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="auth-button secondary">
                        Logout
                    </button>
                </form>

                <div class="auth-toggle">
                    Back to <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Countdown functionality for resend button
        document.addEventListener('DOMContentLoaded', function() {
            const resendButton = document.getElementById('resend-button');
            const resendText = document.getElementById('resend-text');
            const form = document.getElementById('resend-form');

            // Check if there's a stored countdown time
            let countdownTime = localStorage.getItem('resendCountdown');
            let countdown = 60;

            if (countdownTime) {
                const timeDiff = Math.floor((parseInt(countdownTime) - Date.now()) / 1000);
                if (timeDiff > 0) {
                    countdown = timeDiff;
                    startCountdown(countdown);
                } else {
                    enableButton();
                }
            } else {
                enableButton();
            }

            function startCountdown(seconds) {
                resendButton.disabled = true;
                countdown = seconds;

                const countdownInterval = setInterval(function() {
                    resendText.textContent = `Resend Email (${countdown}s)`;

                    countdown--;

                    if (countdown < 0) {
                        clearInterval(countdownInterval);
                        enableButton();
                    }
                }, 1000);
            }

            function enableButton() {
                resendButton.disabled = false;
                resendText.textContent = 'Resend Email';
                localStorage.removeItem('resendCountdown');
            }

            form.addEventListener('submit', function(e) {
                // Store the time when button is clicked to maintain countdown after refresh
                const futureTime = Date.now() + 60000; // 60 seconds from now
                localStorage.setItem('resendCountdown', futureTime.toString());

                // Start the countdown immediately
                startCountdown(60);

                // Disable button during form submission to prevent double submission
                resendButton.disabled = true;
                resendText.textContent = 'Sending...';
            });
        });
    </script>
</body>

</html>
