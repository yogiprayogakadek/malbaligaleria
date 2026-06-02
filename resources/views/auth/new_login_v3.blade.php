<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #111;
        }

        /* ── Layout ── */
        .wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 800px) {
            .wrapper { grid-template-columns: 1fr; }
            .panel-right { display: none; }
        }

        /* ── LEFT: Form ── */
        .panel-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 72px;
        }

        @media (max-width: 1024px) { .panel-left { padding: 48px 40px; } }

        .form-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.8px;
            margin-bottom: 10px;
        }

        .form-sub {
            font-size: 0.88rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 36px;
            max-width: 320px;
        }

        /* Alert */
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.83rem;
            color: #b91c1c;
            margin-bottom: 18px;
        }

        /* Inputs */
        .field { margin-bottom: 14px; position: relative; }

        .field input {
            width: 100%;
            padding: 14px 20px;
            border: 1.5px solid #e5e7eb;
            border-radius: 50px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: #111;
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field input::placeholder { color: #aaa; }
        .field input:focus {
            border-color: #111;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.06);
        }
        .field input.is-invalid { border-color: #ef4444; }
        .field input[type="password"] { padding-right: 52px; }

        .pw-btn {
            position: absolute;
            right: 18px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: #aaa;
            display: flex; align-items: center;
            transition: color 0.2s;
            padding: 0;
        }
        .pw-btn:hover { color: #111; }

        .field-err { font-size: 0.78rem; color: #dc2626; margin-top: 4px; padding-left: 12px; }

        /* Forgot */
        .forgot-row { text-align: right; margin-bottom: 18px; margin-top: 2px; }
        .forgot-link { font-size: 0.83rem; color: #6b7280; text-decoration: none; }
        .forgot-link:hover { color: #111; }

        /* Login button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #222; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
        .btn-login.loading { opacity: 0.7; pointer-events: none; }

        .btn-spin {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.65s linear infinite;
            display: none;
        }
        .btn-login.loading .btn-spin { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Footer */
        .form-footer {
            margin-top: 28px;
            font-size: 0.82rem;
            color: #9ca3af;
            text-align: center;
        }
        .form-footer a { color: #111; font-weight: 500; text-decoration: none; }
        .form-footer a:hover { text-decoration: underline; }

        /* ── RIGHT: Illustration panel ── */
        .panel-right {
            background: #eef4ea;
            border-radius: 24px;
            margin: 20px 20px 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            gap: 32px;
        }

        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        /* Decorative ring behind logo */
        .logo-ring {
            position: relative;
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-ring::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px dashed rgba(0,0,0,0.1);
        }

        .logo-ring::after {
            content: '';
            position: absolute;
            inset: 16px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        .logo-ring img {
            position: relative;
            z-index: 1;
            width: 110px;
            height: 110px;
            object-fit: contain;
        }

        .panel-tagline {
            text-align: center;
        }

        .tagline-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #111;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }

        .tagline-sub {
            font-size: 0.83rem;
            color: #6b7280;
            line-height: 1.6;
            max-width: 240px;
            margin: 0 auto;
        }

        /* Small floating stat card */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 14px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            gap: 14px;
            align-self: stretch;
            max-width: 240px;
            margin: 0 auto;
        }

        .stat-icon {
            width: 36px; height: 36px;
            background: #eef4ea;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .stat-label { font-size: 0.78rem; color: #9ca3af; margin-bottom: 2px; }
        .stat-value { font-size: 0.92rem; font-weight: 700; color: #111; }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- ── LEFT: Form ── --}}
    <div class="panel-left">

        <h1 class="form-title">Welcome back!</h1>
        <p class="form-sub">Sign in to the Mal Bali Galeria admin portal to manage your operations.</p>

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        @if (session('status'))
            <div class="alert" style="background:#f0fdf4;border-color:#bbf7d0;color:#15803d;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="field">
                <input type="email" name="email" id="login-email"
                    value="{{ old('email') }}" required autofocus autocomplete="email"
                    placeholder="Email"
                    class="@error('email') is-invalid @enderror">
                @error('email')<div class="field-err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <input type="password" name="password" id="login-password"
                    required autocomplete="current-password"
                    placeholder="Password"
                    class="@error('password') is-invalid @enderror">
                <button type="button" class="pw-btn" onclick="togglePw()" tabindex="-1">
                    <svg id="eyeIco" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
                @error('password')<div class="field-err">{{ $message }}</div>@enderror
            </div>

            <div class="forgot-row">
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <span class="btn-spin"></span>
                <span>Login</span>
            </button>
        </form>

        <div class="form-footer">
            <a href="{{ url('/') }}">← Back to website</a>
        </div>

    </div>

    {{-- ── RIGHT: Illustration ── --}}
    <div class="panel-right">

        <div class="logo-wrap">
            <div class="logo-ring">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria">
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🏬</div>
            <div>
                <div class="stat-label">Mall Management</div>
                <div class="stat-value">Admin Portal</div>
            </div>
        </div>

        <div class="panel-tagline">
            <div class="tagline-title">Manage your mall with ease</div>
            <p class="tagline-sub">All tenant, event, promo, and visitor data in one place.</p>
        </div>

    </div>

</div>

<script>
    function togglePw() {
        const inp = document.getElementById('login-password');
        const ico = document.getElementById('eyeIco');
        const show = inp.type === 'password';
        inp.type = show ? 'text' : 'password';
        ico.innerHTML = show
            ? `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>`
            : `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>`;
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('loading');
        btn.disabled = true;
    });
</script>
</body>
</html>
