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
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* ── Center wrapper ── */
        .page-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 420px;
        }

        /* ── Logo above card ── */
        .top-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .top-logo img {
            width: 56px;
            height: 56px;
            object-fit: contain;
        }

        .top-logo-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #111;
            letter-spacing: -0.2px;
        }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04), 0 8px 32px rgba(0,0,0,0.07);
        }

        .form-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-sub {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        /* Alert */
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.83rem;
            color: #b91c1c;
            margin-bottom: 16px;
        }

        /* Inputs */
        .field { margin-bottom: 12px; position: relative; }

        .field input {
            width: 100%;
            padding: 13px 20px;
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
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }
        .field input.is-invalid { border-color: #ef4444; }
        .field input[type="password"] { padding-right: 50px; }

        .pw-btn {
            position: absolute;
            right: 18px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: #aaa;
            display: flex; align-items: center;
            padding: 0;
            transition: color 0.2s;
        }
        .pw-btn:hover { color: #111; }

        .field-err {
            font-size: 0.78rem;
            color: #dc2626;
            margin-top: 4px;
            padding-left: 14px;
        }

        /* Forgot */
        .forgot-row { text-align: right; margin-bottom: 20px; margin-top: 4px; }
        .forgot-link { font-size: 0.82rem; color: #6b7280; text-decoration: none; }
        .forgot-link:hover { color: #111; }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 0.92rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #2b2b2b; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
        .btn-login.loading { opacity: 0.7; pointer-events: none; }

        .btn-spin {
            width: 15px; height: 15px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.65s linear infinite;
            display: none;
        }
        .btn-login.loading .btn-spin { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Footer */
        .card-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
            font-size: 0.8rem;
            color: #9ca3af;
        }
        .card-footer a { color: #6b7280; font-weight: 500; text-decoration: none; }
        .card-footer a:hover { color: #111; }
    </style>
</head>
<body>

<div class="page-center">

    {{-- Logo above card --}}
    <div class="top-logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria Logo">
        <span class="top-logo-name">Mal Bali Galeria</span>
    </div>

    {{-- Card --}}
    <div class="card">
        <h1 class="form-title">Welcome back!</h1>
        <p class="form-sub">Sign in to access the admin portal.</p>

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
                    <svg id="eyeIco" xmlns="http://www.w3.org/2000/svg" width="17" height="17"
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

        <div class="card-footer">
            <a href="{{ url('/') }}">← Back to website</a>
            &nbsp;·&nbsp;
            &copy; {{ date('Y') }} Mal Bali Galeria
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
