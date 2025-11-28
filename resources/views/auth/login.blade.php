<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenant Login - {{ config('app.name', 'Laravel') }}</title>

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

                <!-- Google SSO Login -->
                <div class="auth-sso">
                    <button class="auth-button auth-sso-button"
                        style="background: white; border: 1px solid var(--border-light); color: var(--text-primary); display: flex; align-items: center; justify-content: center; gap: 12px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" style="display: block;">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z">
                            </path>
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z">
                            </path>
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z">
                            </path>
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z">
                            </path>
                        </svg>
                        Sign in with Google
                    </button>
                </div>

                <div class="divider">
                    Or continue with email
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
                    Don't have an account? <a href="#"
                        onclick="event.preventDefault(); showForm('register')">Register Store</a>
                </div>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-container">
                <div class="auth-header">
                    <h2>Tenant Registration</h2>
                    <p>Register your store to join our mall community</p>
                </div>

                <!-- Google SSO Register -->
                <div class="auth-sso">
                    <button class="auth-button auth-sso-button"
                        style="background: white; border: 1px solid var(--border-light); color: var(--text-primary); display: flex; align-items: center; justify-content: center; gap: 12px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" style="display: block;">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z">
                            </path>
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z">
                            </path>
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z">
                            </path>
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z">
                            </path>
                        </svg>
                        Sign up with Google
                    </button>
                </div>

                <div class="divider">
                    Or register with email
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
                        <input type="email" id="register-email" name="email" value="{{ old('email') }}"
                            required placeholder="Enter your email" class="@error('email') is-invalid @enderror">
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

                    <div class="form-group">
                        <label for="tenant">Tenant</label>
                        <div class="searchable-select">
                            <div class="searchable-select-control" style="position: relative;">
                                <input type="text" id="tenant-search" placeholder="Search or select tenant..."
                                    style="width: 100%; padding: 12px 16px; border: 1px solid var(--border-light); border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease; background-color: white; color: var(--text-primary); padding-right: 40px;"
                                    autocomplete="off" />
                                <input type="hidden" name="tenant_id" id="tenant" value="" />
                                <div
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #94a3b8;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </div>
                            <div id="tenant-options" class="searchable-options"
                                style="position: absolute; width: 100%; background: white; border: 1px solid var(--border-light); border-top: none; border-radius: 0 0 8px 8px; max-height: 200px; overflow-y: auto; z-index: 1000; display: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                                <div class="tenant-option" data-value=""
                                    style="padding: 10px 16px; cursor: pointer; transition: background-color 0.2s ease;"
                                    onclick="selectTenant('', 'Select a tenant')">Select a tenant</div>
                                @if (isset($tenants))
                                    @foreach ($tenants as $tenant)
                                        <div class="tenant-option" data-value="{{ $tenant->id }}"
                                            style="padding: 10px 16px; cursor: pointer; transition: background-color 0.2s ease;"
                                            onclick="selectTenant('{{ $tenant->id }}', '{{ addslashes(trim($tenant->name)) }}')">
                                            {{ trim($tenant->name) }}</div>
                                    @endforeach
                                @endif
                                <div id="no-results" class="tenant-option hidden"
                                    style="padding: 10px 16px; color: #94a3b8; font-style: italic; text-align: center;">
                                    Data tidak ada</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="auth-button">
                        Register Store
                    </button>
                </form>

                <div class="auth-toggle">
                    Already have an account? <a href="#"
                        onclick="event.preventDefault(); showForm('login')">Access Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/frontend/js/auth.js') }}"></script>
</body>

</html>
