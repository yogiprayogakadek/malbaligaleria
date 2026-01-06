<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/auth.css') }}">
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

    <div class="auth-container" style="max-width: 700px;">
        <div class="auth-image">
            <div class="auth-image-content">
                <div class="auth-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                        srcset="{{ asset('assets/images/logo.png') }}">
                </div>
                <h2>Reset Your Password</h2>
                <p>Enter your email address and we'll send you a link to reset your password</p>
            </div>
        </div>

        <div class="auth-forms">
            <div class="form-container active">
                <div class="auth-header">
                    <h2>Forgot Password?</h2>
                    <p>No worries, we'll send you reset instructions</p>
                </div>

                @if (session('status'))
                    <div style="padding: 12px 16px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; margin-bottom: 20px; color: var(--success); font-size: 14px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="Enter your registered email" class="@error('email') is-invalid @enderror">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-button">
                        Send Reset Link
                    </button>
                </form>

                <div class="auth-toggle">
                    <a href="{{ route('login') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--primary-color); text-decoration: none; font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/frontend/js/auth.js') }}"></script>
</body>

</html>
