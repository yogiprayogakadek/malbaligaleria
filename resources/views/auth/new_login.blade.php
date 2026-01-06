<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenant Login - {{ config('app.name', 'Mal Bali Galeria') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2c5f5d;
            --primary-dark: #1e4544;
            --secondary: #F5F5DC;
            --secondary-dark: #E8E6CA;
            --text-main: #2c5f5d;
            --text-light: #64748b;
            --white: #ffffff;
            --error: #ef4444;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--secondary);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        .split-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left Side - Visual */
        .visual-side {
            width: 45%;
            background-color: var(--primary);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            color: var(--secondary);
            overflow: hidden;
        }

        .visual-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23F5F5DC' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .visual-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 500px;
        }

        .visual-logo {
            width: 120px;
            margin-bottom: 2rem;
            filter: brightness(0) invert(1) sepia(0.2) saturate(0.5) hue-rotate(5deg); /* Make logo beige-ish */
        }
        
        /* Fallback if logo not image */
        .visual-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            font-weight: 600;
        }

        .visual-text {
            font-size: 1.125rem;
            line-height: 1.6;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Right Side - Forms */
        .form-side {
            width: 55%;
            background-color: var(--secondary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 480px;
            background: var(--white);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 40px -10px rgba(44, 95, 93, 0.1);
            transition: all 0.4s ease;
        }

        .form-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* Auth Tabs */
        .auth-tabs {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-light);
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--primary);
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            transition: all 0.2s;
            background-color: #fcfcfc;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(44, 95, 93, 0.1);
            background-color: var(--white);
        }

        .form-input.is-invalid {
            border-color: var(--error);
        }

        .error-message {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 0.375rem;
        }

        /* Checkbox & Links */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .checkbox-container input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .forgot-link:hover {
            opacity: 0.8;
        }

        /* Buttons */
        .btn-primary {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary);
            color: var(--secondary);
            border: none;
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 95, 93, 0.2);
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            position: relative;
            background: var(--white);
            padding: 0 1rem;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* SSO Button */
        .btn-sso {
            width: 100%;
            padding: 0.875rem;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--text-main);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .btn-sso:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Tenant Search Styling */
        .searchable-select {
            position: relative;
        }
        
        .searchable-options {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50;
            margin-top: 4px;
            display: none;
        }

        .searchable-option {
            padding: 10px 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .searchable-option:hover {
            background-color: #f1f5f9;
        }

        .hidden {
            display: none;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .visual-side {
                display: none;
            }
            .form-side {
                width: 100%;
                background-color: var(--secondary);
            }
            .form-container {
                box-shadow: none;
                background: transparent;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="split-layout">
        <!-- Visual Side -->
        <div class="visual-side">
            <div class="visual-pattern"></div>
            <div class="visual-content">
                <div style="margin-bottom: 2rem;">
                     <!-- Using CSS filter to tint the logo beige if it's transparent PNG, or just place it normally -->
                    <img src="{{ asset('assets/images/logo.png') }}" class="visual-logo" alt="Logo">
                </div>
                <h1 class="visual-title">Mal Bali Galeria</h1>
                <p class="visual-text">Discover a world of shopping, dining, and entertainment. <br>Manage your tenant operations with ease and style.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="form-container">
                
                <!-- Tab Switching -->
                <div class="auth-tabs">
                    <div class="auth-tab active" id="tab-login" onclick="switchForm('login')">Login</div>
                    <div class="auth-tab" id="tab-register" onclick="switchForm('register')">Register Store</div>
                </div>

                <!-- LOGIN FORM -->
                <div id="login-form">
                    <div class="form-header">
                        <h2 class="form-title">Welcome Back</h2>
                        <p class="form-subtitle">Please sign in to your dashboard</p>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                         <button class="btn-sso">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path>
                            </svg>
                            <span>Sign in with Google</span>
                        </button>
                    </div>

                    <div class="divider">
                        <span>Or sign in with email</span>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="login-email">Email Address</label>
                            <input type="email" id="login-email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="name@company.com">
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="login-password">Password</label>
                            <input type="password" id="login-password" name="password" class="form-input @error('password') is-invalid @enderror" required placeholder="Enter your password">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <label class="checkbox-container">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn-primary">Sign In</button>
                    </form>
                </div>

                <!-- REGISTER FORM -->
                <div id="register-form" class="hidden">
                    <div class="form-header">
                        <h2 class="form-title">Join Us</h2>
                        <p class="form-subtitle">Register your store today</p>
                    </div>

                    <!-- SSO Register -->
                    <div style="margin-bottom: 1.5rem;">
                         <button class="btn-sso">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path>
                            </svg>
                            <span>Sign up with Google</span>
                        </button>
                    </div>

                    <div class="divider">
                         <span>Or register with email</span>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="John Doe">
                             @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="name@company.com">
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" required placeholder="Create a strong password">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-input" required placeholder="Confirm your password">
                        </div>

                        <!-- Tenant Search -->
                        <div class="form-group">
                            <label class="form-label" for="tenant-search">Select Tenant</label>
                            <div class="searchable-select">
                                <input type="text" id="tenant-search" class="form-input" placeholder="Search tenant..." autocomplete="off">
                                <input type="hidden" name="tenant_id" id="tenant" value="">
                                
                                <div id="tenant-options" class="searchable-options">
                                    <div class="searchable-option" onclick="selectTenant('', 'Select a tenant')">Select a tenant</div>
                                    @if (isset($tenants))
                                        @foreach ($tenants as $tenant)
                                            <div class="searchable-option" 
                                                 data-value="{{ $tenant->id }}" 
                                                 data-name="{{ trim($tenant->name) }}"
                                                 onclick="selectTenant('{{ $tenant->id }}', '{{ addslashes(trim($tenant->name)) }}')">
                                                {{ trim($tenant->name) }}
                                            </div>
                                        @endforeach
                                    @endif
                                    <div id="no-results" class="searchable-option hidden" style="color: #94a3b8; text-align: center;">No results found</div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" style="margin-top: 1rem;">Create Account</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Interface Logic -->
    <script>
        function switchForm(type) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const tabLogin = document.getElementById('tab-login');
            const tabRegister = document.getElementById('tab-register');

            if (type === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                tabLogin.classList.add('active');
                tabRegister.classList.remove('active');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                tabLogin.classList.remove('active');
                tabRegister.classList.add('active');
            }
        }

        // Tenant Search Logic
        const tenantSearchInput = document.getElementById('tenant-search');
        const tenantOptions = document.getElementById('tenant-options');
        const optionsList = document.querySelectorAll('.searchable-option:not(#no-results)');
        const noResults = document.getElementById('no-results');

        if(tenantSearchInput) {
            tenantSearchInput.addEventListener('focus', () => {
                tenantOptions.style.display = 'block';
            });

            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.searchable-select')) {
                    tenantOptions.style.display = 'none';
                }
            });

            tenantSearchInput.addEventListener('input', (e) => {
                const filter = e.target.value.toLowerCase();
                let hasResults = false;

                optionsList.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        option.classList.remove('hidden');
                        hasResults = true;
                    } else {
                        option.classList.add('hidden');
                    }
                });

                if (hasResults) {
                    noResults.classList.add('hidden');
                } else {
                    noResults.classList.remove('hidden');
                }
            });
        }

        function selectTenant(id, name) {
            document.getElementById('tenant').value = id;
            document.getElementById('tenant-search').value = name;
            document.getElementById('tenant-options').style.display = 'none';
        }

        // Check for errors to keep register tab open if needed
        document.addEventListener('DOMContentLoaded', () => {
            @if($errors->has('name') || $errors->has('password_confirmation') || $errors->has('tenant_id'))
                switchForm('register');
            @endif
        });
    </script>
</body>
</html>
