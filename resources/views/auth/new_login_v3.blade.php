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
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand:     #b45309;
            --brand-dk:  #92400e;
            --cream:     #faf7f2;
            --warm-100:  #f5ede0;
            --warm-200:  #e9d8c0;
            --warm-300:  #d6b896;
            --stone-400: #a8a29e;
            --stone-500: #78716c;
            --stone-600: #57534e;
            --stone-700: #44403c;
            --stone-800: #292524;
            --stone-900: #1c1917;
        }

        html, body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background-color: var(--cream);
            color: var(--stone-800);
        }

        /* ── Soft mesh background ───────────────────────────── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 55% at 15% 0%, rgba(217, 119, 6, 0.06) 0%, transparent 65%),
                radial-gradient(ellipse 50% 45% at 85% 100%, rgba(180, 83, 9, 0.05) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(245, 158, 11, 0.04) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Page scaffold ──────────────────────────────────── */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* ── Wordmark / Brand header ────────────────────────── */
        .brand-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            margin-bottom: 44px;
        }

        .brand-logo-ring {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            border: 1.5px solid var(--warm-200);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .brand-logo-ring img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand-wordmark {
            text-align: center;
        }

        .brand-name {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.45rem;
            font-weight: 400;
            color: var(--stone-900);
            letter-spacing: 0.01em;
            line-height: 1;
        }

        .brand-sub {
            font-size: 0.72rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--stone-400);
            margin-top: 4px;
            font-weight: 400;
        }

        /* ── Login card ─────────────────────────────────────── */
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border: 1px solid var(--warm-200);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow:
                0 1px 3px rgba(0,0,0,0.04),
                0 8px 32px rgba(0,0,0,0.06),
                0 0 0 1px rgba(255,255,255,0.9) inset;
        }

        /* ── Card heading ───────────────────────────────────── */
        .card-heading {
            margin-bottom: 30px;
        }

        .card-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.55rem;
            font-weight: 400;
            color: var(--stone-900);
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .card-title em {
            font-style: italic;
            color: var(--brand);
        }

        .card-desc {
            font-size: 0.85rem;
            color: var(--stone-500);
            line-height: 1.5;
        }

        /* ── Alert ──────────────────────────────────────────── */
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 0.83rem;
            color: #b91c1c;
            margin-bottom: 22px;
            display: flex;
            gap: 9px;
            align-items: flex-start;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        /* ── Form fields ────────────────────────────────────── */
        .field { margin-bottom: 18px; }

        .field-label {
            display: block;
            font-size: 0.775rem;
            font-weight: 600;
            color: var(--stone-600);
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .field-wrap { position: relative; }

        .field-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid var(--warm-200);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: var(--stone-800);
            background: var(--cream);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.15s ease;
        }

        .field-input::placeholder { color: var(--stone-400); }

        .field-input:focus {
            border-color: var(--brand);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.09);
        }

        .field-input.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239,68,68,0.08);
        }

        .field-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--stone-400);
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .field-err {
            font-size: 0.775rem;
            color: #dc2626;
            margin-top: 5px;
        }

        /* Password toggle */
        .pw-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--stone-400);
            display: flex;
            align-items: center;
            padding: 0;
            transition: color 0.2s;
        }
        .pw-btn:hover { color: var(--brand); }

        /* ── Divider row ────────────────────────────────────── */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .check-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.83rem;
            color: var(--stone-500);
            cursor: pointer;
        }

        .check-label input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--brand);
            cursor: pointer;
        }

        .link-forgot {
            font-size: 0.83rem;
            color: var(--brand);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s, opacity 0.2s;
        }
        .link-forgot:hover { opacity: 0.75; }

        /* ── Submit button ──────────────────────────────────── */
        .btn-login {
            width: 100%;
            padding: 12.5px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
            color: #fff;
            background: var(--brand);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(180, 83, 9, 0.22), 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: var(--brand-dk);
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(180, 83, 9, 0.3), 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(180, 83, 9, 0.2);
        }

        .btn-login.loading .btn-text { opacity: 0.6; }

        .btn-spin {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.65s linear infinite;
            display: none;
        }
        .btn-login.loading .btn-spin { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Footer ─────────────────────────────────────────── */
        .card-footer {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid var(--warm-100);
            text-align: center;
        }

        .footer-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
            color: var(--stone-400);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-link:hover { color: var(--stone-600); }

        /* ── Ambient bottom text ────────────────────────────── */
        .page-footer {
            margin-top: 28px;
            font-size: 0.72rem;
            color: var(--stone-400);
            letter-spacing: 0.5px;
        }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; border-radius: 16px; }
            .card-title { font-size: 1.35rem; }
        }
    </style>
</head>

<body>
    <div class="page">

        {{-- Brand header --}}
        <div class="brand-header">
            <div class="brand-logo-ring">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>
            <div class="brand-wordmark">
                <div class="brand-name">Mal Bali Galeria</div>
                <div class="brand-sub">Management Portal</div>
            </div>
        </div>

        {{-- Card --}}
        <div class="login-card">
            <div class="card-heading">
                <h1 class="card-title">Sign in to your<br><em>account</em></h1>
                <p class="card-desc">Enter your credentials to access the dashboard.</p>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
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
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label class="field-label" for="login-email">Email</label>
                    <div class="field-wrap">
                        <span class="field-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                            required autofocus autocomplete="email"
                            placeholder="your@email.com"
                            class="field-input @error('email') is-invalid @enderror">
                    </div>
                    @error('email')
                        <div class="field-err">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field">
                    <label class="field-label" for="login-password">Password</label>
                    <div class="field-wrap">
                        <span class="field-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <input type="password" id="login-password" name="password"
                            required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="field-input @error('password') is-invalid @enderror">
                        <button type="button" class="pw-btn" onclick="togglePw()" tabindex="-1" aria-label="Toggle password">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-err">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Options --}}
                <div class="options-row">
                    <label class="check-label">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="link-forgot" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-spin" id="btnSpin"></span>
                    <span class="btn-text">Sign In</span>
                </button>
            </form>

            <div class="card-footer">
                <a href="{{ url('/') }}" class="footer-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to website
                </a>
            </div>
        </div>

        <p class="page-footer">&copy; {{ date('Y') }} Mal Bali Galeria. All rights reserved.</p>

    </div>

    <script>
        function togglePw() {
            const inp = document.getElementById('login-password');
            const ico = document.getElementById('eyeIcon');
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            ico.innerHTML = show
                ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>`
                : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>`;
        }

        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>
</body>
</html>
