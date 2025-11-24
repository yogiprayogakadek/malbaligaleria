<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenant Login - {{ config('app.name', 'Laravel') }}</title>

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
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
            display: none;
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

        .auth-tabs {
            display: flex;
            border-bottom: 1px solid var(--border-light);
            margin-bottom: 25px;
            position: relative;
        }

        .auth-tab {
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-secondary);
            position: relative;
            transition: color 0.3s ease;
            z-index: 1;
        }

        .auth-tab.active {
            color: var(--primary-color);
        }

        .auth-tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-color);
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            color: var(--text-secondary);
        }

        .remember-label input {
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
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
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" srcset="{{ asset('assets/images/logo.png') }}">
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
                <h2>Welcome Back!</h2>
                <p>Access your tenant dashboard to manage your store operations</p>
            </div>
        </div>

        <div class="auth-forms">
            <div class="auth-tabs">
                <div class="auth-tab active" onclick="showForm('login')">Tenant Login</div>
                <div class="auth-tab" onclick="showForm('register')">Tenant Register</div>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-container active">
                <div class="auth-header">
                    <h2>Tenant Dashboard Access</h2>
                    <p>Login to manage your store operations</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="Enter your email" class="@error('email') is-invalid @enderror">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password" required
                            placeholder="Enter your password" class="@error('password') is-invalid @enderror">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="auth-button">
                        Access Dashboard
                    </button>
                </form>

                <div class="auth-toggle">
                    Don't have an account? <a href="#" onclick="showForm('register')">Register Store</a>
                </div>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-container">
                <div class="auth-header">
                    <h2>Tenant Registration</h2>
                    <p>Register your store to join our mall community</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="register-name">Full Name</label>
                        <input type="text" id="register-name" name="name" value="{{ old('name') }}" required
                            autofocus placeholder="Enter your full name" class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" value="{{ old('email') }}" required
                            placeholder="Enter your email" class="@error('email') is-invalid @enderror">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input type="password" id="register-password" name="password" required
                            placeholder="Create a password" class="@error('password') is-invalid @enderror">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="register-password-confirm">Confirm Password</label>
                        <input type="password" id="register-password-confirm" name="password_confirmation" required
                            placeholder="Confirm your password"
                            class="@error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-button">
                        Register Store
                    </button>
                </form>

                <div class="auth-toggle">
                    Already have an account? <a href="#" onclick="showForm('login')">Access Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(formName) {
            // Hide all forms
            document.querySelectorAll('.form-container').forEach(form => {
                form.classList.remove('active');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.auth-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected form
            document.getElementById(formName + '-form').classList.add('active');

            // Activate selected tab
            event.target.classList.add('active');
        }
    </script>
</body>

</html>
