<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In — Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --indigo-500: #6366f1;
            --indigo-600: #4f46e5;
            --indigo-700: #4338ca;
            --slate-50:  #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--slate-50);
        }

        /* ── Grid Layout ──────────────────────────────────────── */
        .login-wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 900px) {
            .login-wrapper { grid-template-columns: 1fr; }
            .login-panel-left { display: none; }
        }

        /* ── Left Decorative Panel ────────────────────────────── */
        .login-panel-left {
            position: relative;
            background: linear-gradient(145deg, #312e81 0%, #4f46e5 45%, #818cf8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 48px;
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -120px; left: -120px;
            pointer-events: none;
        }
        .login-panel-left::after {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px; right: -80px;
            pointer-events: none;
        }

        .panel-inner {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 400px;
        }

        .panel-logo-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 20px;
            margin-bottom: 28px;
        }

        .panel-logo-box img {
            width: 52px; height: 52px;
            object-fit: contain;
        }

        .panel-title {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
        }

        .panel-subtitle {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            max-width: 300px;
            margin: 0 auto 40px;
        }

        .panel-features { display: flex; flex-direction: column; gap: 14px; text-align: left; }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 14px 18px;
        }

        .feature-icon {
            width: 36px; height: 36px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .feature-text {
            color: rgba(255,255,255,0.9);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ── Right Form Panel ─────────────────────────────────── */
        .login-panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 32px;
            background: #fff;
        }

        .form-box { width: 100%; max-width: 420px; }

        /* Mobile logo */
        .mobile-logo { display: none; text-align: center; margin-bottom: 32px; }
        @media (max-width: 900px) { .mobile-logo { display: block; } }
        .mobile-logo img { height: 48px; object-fit: contain; margin-bottom: 8px; }
        .mobile-logo-name { font-size: 1.1rem; font-weight: 700; color: var(--slate-800); }

        /* Form header */
        .form-header { margin-bottom: 32px; }

        .form-eyebrow {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--indigo-600);
            margin-bottom: 8px;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-desc { font-size: 0.9rem; color: var(--slate-500); }

        /* Alert */
        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #be123c;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        /* Input group */
        .input-group { margin-bottom: 20px; }

        .input-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 7px;
            letter-spacing: 0.3px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
            display: flex; align-items: center;
            pointer-events: none;
        }

        .input-field {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--slate-200);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: var(--slate-800);
            background: var(--slate-50);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }

        .input-field:focus {
            border-color: var(--indigo-500);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
            background: #fff;
        }

        .input-field.is-invalid {
            border-color: #f43f5e;
            box-shadow: 0 0 0 4px rgba(244,63,94,0.07);
        }

        .error-msg {
            font-size: 0.78rem;
            color: #f43f5e;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Password toggle */
        .pw-toggle {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--slate-400);
            cursor: pointer;
            display: flex; align-items: center;
            padding: 0;
            transition: color 0.2s;
        }
        .pw-toggle:hover { color: var(--indigo-600); }

        /* Options row */
        .row-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex; align-items: center; gap: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--slate-600);
        }

        .remember-cb {
            width: 16px; height: 16px;
            accent-color: var(--indigo-600);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--indigo-600);
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: var(--indigo-700); text-decoration: underline; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, var(--indigo-600) 0%, var(--indigo-700) 100%);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(79,70,229,0.3);
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, var(--indigo-700) 0%, #3730a3 100%);
            box-shadow: 0 6px 20px rgba(79,70,229,0.4);
            transform: translateY(-1px);
        }
        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        }

        /* Spinner */
        .btn-spinner {
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-submit.loading .btn-spinner { display: block; }
        .btn-submit.loading .btn-label { opacity: 0.7; }

        /* Back link */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            font-size: 0.82rem;
            color: var(--slate-400);
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--indigo-600); }
    </style>
</head>

<body>
    <div class="login-wrapper">

        {{-- ── Left Panel ───────────────────────────────────── --}}
        <div class="login-panel-left">
            <div class="panel-inner">
                <div class="panel-logo-box">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria">
                </div>

                <h1 class="panel-title">Mal Bali Galeria<br>Admin Portal</h1>
                <p class="panel-subtitle">
                    Central management system for mall operations, tenants, events, and promotions.
                </p>

                <div class="panel-features">
                    <div class="feature-item">
                        <div class="feature-icon">🏬</div>
                        <div class="feature-text">Manage tenants and store data</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📅</div>
                        <div class="feature-text">Schedule events and promotions</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📊</div>
                        <div class="feature-text">Monitor visitor analytics and reports</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Right Panel ──────────────────────────────────── --}}
        <div class="login-panel-right">
            <div class="form-box">

                {{-- Mobile Logo --}}
                <div class="mobile-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    <div class="mobile-logo-name">Mal Bali Galeria</div>
                </div>

                <div class="form-header">
                    <p class="form-eyebrow">Admin Portal</p>
                    <h2 class="form-title">Welcome back 👋</h2>
                    <p class="form-desc">Sign in to access the management dashboard.</p>
                </div>

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" style="flex-shrink:0; margin-top:1px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert-error" style="background:#f0fdf4; border-color:#bbf7d0; color:#15803d;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    {{-- Email --}}
                    <div class="input-group">
                        <label class="input-label" for="login-email">Email Address</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                                required autofocus autocomplete="email"
                                placeholder="you@example.com"
                                class="input-field @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                            <div class="error-msg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="input-group">
                        <label class="input-label" for="login-password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input type="password" id="login-password" name="password"
                                required autocomplete="current-password"
                                placeholder="Enter your password"
                                class="input-field @error('password') is-invalid @enderror">
                            <button type="button" class="pw-toggle" onclick="togglePassword()" tabindex="-1" aria-label="Toggle password">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-msg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="row-options">
                        <label class="remember-label">
                            <input type="checkbox" class="remember-cb" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span class="btn-spinner" id="btnSpinner"></span>
                        <span class="btn-label">Sign In</span>
                        <svg id="btnArrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <a href="{{ url('/') }}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to website
                </a>

            </div>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('login-password');
            const icon  = document.getElementById('eye-icon');
            const show  = input.type === 'password';
            input.type  = show ? 'text' : 'password';
            icon.innerHTML = show
                ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>`
                : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>`;
        }

        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn   = document.getElementById('submitBtn');
            const arrow = document.getElementById('btnArrow');
            btn.classList.add('loading');
            if (arrow) arrow.style.display = 'none';
        });
    </script>
</body>

</html>
