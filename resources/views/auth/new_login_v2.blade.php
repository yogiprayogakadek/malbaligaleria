<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenant Login - {{ config('app.name', 'Mal Bali Galeria') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2c5f5d;
            --primary-dark: #1e4544;
            --secondary: #F5F5DC;
            --secondary-dark: #E8E6CA;
            --white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.4);
            --text-main: #2c5f5d;
            --text-muted: #5e7e7d;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary);
            /* Abstract background pattern */
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(245, 245, 220, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(245, 245, 220, 0.1) 0%, transparent 20%),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23F5F5DC' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            padding: 1rem;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.25), 
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
            width: 100%;
            max-width: 1000px;
            display: flex;
            overflow: hidden;
            position: relative;
            min-height: 600px;
        }

        /* Decorative Elements */
        .decoration-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
        }
        .blob-1 {
            width: 300px;
            height: 300px;
            background: #F5F5DC;
            top: -100px;
            right: -50px;
            opacity: 0.2;
        }
        .blob-2 {
            width: 250px;
            height: 250px;
            background: #2c5f5d;
            bottom: -50px;
            left: -100px;
            opacity: 0.4;
        }

        /* Information Section */
        .info-section {
            width: 45%;
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            background: rgba(44, 95, 93, 0.05); /* Subtle dark teal tint */
        }

        .brand-logo img {
            height: 60px;
            max-width: 100%;
            object-fit: contain;
        }

        .info-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .info-content p {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .info-footer {
            font-size: 0.85rem;
            color: var(--text-muted);
            opacity: 0.8;
        }

        /* Form Section */
        .form-section {
            width: 55%;
            padding: 3.5rem;
            background: rgba(255, 255, 255, 0.6);
            display: flex;
            flex-direction: column;
        }

        .auth-toggle {
            display: inline-flex;
            background: rgba(44, 95, 93, 0.08);
            border-radius: 50px;
            padding: 5px;
            margin-bottom: 2.5rem;
            align-self: flex-start;
        }

        .toggle-btn {
            border: none;
            background: transparent;
            padding: 10px 24px;
            border-radius: 25px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-btn.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 4px 12px rgba(44, 95, 93, 0.15);
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        /* Material / Minimal Inputs */
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 1rem 0;
            border: none;
            border-bottom: 2px solid #e2e8f0;
            background: transparent;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.3s;
        }

        .form-control::placeholder {
            color: transparent; /* For floating label effect */
        }

        .floating-label {
            position: absolute;
            top: 1rem;
            left: 0;
            font-size: 1rem;
            color: var(--text-muted);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-control:not(:placeholder-shown) {
            outline: none;
            border-bottom-color: var(--primary);
        }

        .form-control:focus + .floating-label,
        .form-control:not(:placeholder-shown) + .floating-label {
            top: -12px;
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 500;
        }

        .form-control.is-invalid {
            border-bottom-color: var(--error);
        }

        .error-msg {
            font-size: 0.75rem;
            color: var(--error);
            position: absolute;
            bottom: -20px;
            left: 0;
        }

        /* Button Styling */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: var(--secondary);
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            box-shadow: 0 10px 20px rgba(44, 95, 93, 0.2);
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(44, 95, 93, 0.3);
        }

        /* Other Actions */
        .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
        }
        
        .checkbox-wrapper input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
        }

        .link-text {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            position: relative;
        }

        .link-text::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--primary);
            transform: scaleX(0);
            transition: transform 0.3s;
            transform-origin: right;
        }

        .link-text:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* SSO */
        .sso-divider {
            text-align: center;
            margin: 2rem 0 1.5rem;
            position: relative;
        }
        
        .sso-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(0,0,0,0.1);
        }

        .sso-divider span {
            background: rgba(246, 246, 246, 0.8); /* Match form bg mostly */
            padding: 0 15px;
            position: relative;
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0.8rem;
            background: var(--white);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: var(--text-main);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-google:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Tenant Search */
        .search-container {
            position: relative;
        }
        
        .search-results {
            position: absolute;
            background: var(--white);
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-top: 5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 50;
            display: none;
            border: 1px solid #f1f5f9;
        }

        .search-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-item:hover {
            background: #f1f5f9;
        }

        .hidden { display: none; }
        .fade-in { animation: fadeIn 0.4s ease forwards; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 968px) {
            .glass-card {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }
            .info-section {
                width: 100%;
                padding: 2rem;
                padding-bottom: 1rem;
            }
            .form-section {
                width: 100%;
                padding: 2rem;
            }
            .info-content h1 { font-size: 2rem; }
            .info-content p { display: none; }
            .brand-logo { margin-bottom: 0; }
        }
    </style>
</head>

<body>
    <!-- Decorative Blobs -->
    <div class="decoration-blob blob-1"></div>
    <div class="decoration-blob blob-2"></div>

    <div class="glass-card">
        <!-- Left: Info -->
        <div class="info-section">
            <div class="brand-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>
            
            <div class="info-content">
                <h1>Managed with<br>Excellence.</h1>
                <p>Welcome to the Tenant Portal. Access your dashboard to manage sales, reporting, and store operations efficiently.</p>
            </div>

            <div class="info-footer">
                &copy; {{ date('Y') }} Mal Bali Galeria. All rights reserved.
            </div>
        </div>

        <!-- Right: Forms -->
        <div class="form-section">
            <div class="auth-toggle">
                <button class="toggle-btn active" id="btn-login" onclick="toggleForm('login')">Log In</button>
                <button class="toggle-btn" id="btn-register" onclick="toggleForm('register')">Register</button>
            </div>

            <!-- LOGIN FORM -->
            <div id="login-form" class="fade-in">
                <div class="form-header">
                    <h2>Welcome Back</h2>
                    <p>Enter your credentials to access your account.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="input-group">
                        <input type="email" id="login-email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder=" " value="{{ old('email') }}" required autofocus>
                        <label for="login-email" class="floating-label">Email Address</label>
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input type="password" id="login-password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder=" " required>
                        <label for="login-password" class="floating-label">Password</label>
                        @error('password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="actions-row">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-text">Forgot?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">Sign In</button>
                </form>

                <div class="sso-divider">
                    <span>Or continue with</span>
                </div>

                <button class="btn-google">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path>
                    </svg>
                    Google
                </button>
            </div>

            <!-- REGISTER FORM -->
            <div id="register-form" class="fade-in hidden">
                <div class="form-header">
                    <h2>Join the Community</h2>
                    <p>Register your tenant account.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="input-group">
                        <input type="text" id="reg-name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder=" " value="{{ old('name') }}" required>
                        <label for="reg-name" class="floating-label">Full Name</label>
                        @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group">
                        <input type="email" id="reg-email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder=" " value="{{ old('email') }}" required>
                        <label for="reg-email" class="floating-label">Email Address</label>
                        @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group">
                        <input type="password" id="reg-pass" name="password" class="form-control @error('password') is-invalid @enderror" placeholder=" " required>
                        <label for="reg-pass" class="floating-label">Password</label>
                        @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group">
                        <input type="password" id="reg-confirm" name="password_confirmation" class="form-control" placeholder=" " required>
                        <label for="reg-confirm" class="floating-label">Confirm Password</label>
                    </div>

                    <!-- Tenant Search -->
                    <div class="input-group search-container">
                        <input type="text" id="tenant-search" class="form-control" placeholder=" " autocomplete="off">
                        <label for="tenant-search" class="floating-label">Select Tenant</label>
                        <input type="hidden" name="tenant_id" id="tenant-id-input">
                        
                        <div id="tenant-results" class="search-results">
                            <div class="search-item" onclick="selectTenant('', '')">Select a tenant</div>
                            @if (isset($tenants))
                                @foreach ($tenants as $tenant)
                                    <div class="search-item" 
                                         data-value="{{ $tenant->id }}"
                                         onclick="selectTenant('{{ $tenant->id }}', '{{ addslashes(trim($tenant->name)) }}')">
                                        {{ trim($tenant->name) }}
                                    </div>
                                @endforeach
                            @endif
                            <div id="no-res" class="search-item hidden" style="text-align: center; color: #94a3b8;">No matches</div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleForm(formType) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const btnLogin = document.getElementById('btn-login');
            const btnRegister = document.getElementById('btn-register');

            if (formType === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                btnLogin.classList.add('active');
                btnRegister.classList.remove('active');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                btnLogin.classList.remove('active');
                btnRegister.classList.add('active');
            }
        }

        // Search Logic
        const searchInput = document.getElementById('tenant-search');
        const resultsBox = document.getElementById('tenant-results');
        const items = document.querySelectorAll('.search-item:not(#no-res)');
        const noRes = document.getElementById('no-res');

        if(searchInput) {
            searchInput.addEventListener('focus', () => resultsBox.style.display = 'block');
            
            // Close logic
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.search-container')) {
                    resultsBox.style.display = 'none';
                }
            });

            searchInput.addEventListener('input', (e) => {
                const val = e.target.value.toLowerCase();
                let found = false;
                
                items.forEach(item => {
                    if(item.textContent.toLowerCase().includes(val)) {
                        item.classList.remove('hidden');
                        found = true;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                if(found) noRes.classList.add('hidden');
                else noRes.classList.remove('hidden');
            });
        }

        function selectTenant(id, name) {
            document.getElementById('tenant-id-input').value = id;
            document.getElementById('tenant-search').value = name;
            resultsBox.style.display = 'none';
        }

        // Persist state on error
        @if($errors->has('name') || $errors->has('password_confirmation') || $errors->has('tenant_id'))
            toggleForm('register');
        @endif
    </script>
</body>
</html>
