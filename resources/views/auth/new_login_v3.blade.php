<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body { height: 100%; font-family: 'Inter', sans-serif; }

        .wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #f0f2f8;
            padding: 24px;
            gap: 0;
        }

        @media (max-width: 860px) {
            .wrapper { grid-template-columns: 1fr; padding: 20px; }
            .panel-right { display: none; }
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            background: linear-gradient(135deg, #ffffff 0%, #f3f4fb 50%, #edf5ee 100%);
            border-radius: 20px 0 0 20px;
            display: flex;
            flex-direction: column;
            padding: 40px 52px;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-logo {
            width: 34px; height: 34px;
            background: #111;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .brand-logo img { width: 22px; height: 22px; object-fit: contain; filter: invert(1); }
        .brand-name { font-size: 1rem; font-weight: 700; color: #111; letter-spacing: -0.3px; }

        .form-area { flex: 1; display: flex; flex-direction: column; justify-content: center; max-width: 360px; }

        .form-title { font-size: 2rem; font-weight: 800; color: #0d0f12; margin-bottom: 6px; letter-spacing: -0.5px; }
        .form-sub { font-size: 0.88rem; color: #6b7280; margin-bottom: 36px; }

        /* Alert */
        .alert { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 10px 14px; font-size: 0.83rem; color: #b91c1c; margin-bottom: 20px; }

        /* Input */
        .field { margin-bottom: 14px; position: relative; }

        .field input {
            width: 100%;
            padding: 16px 18px;
            background: #fff;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: #111;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .field input::placeholder { color: #9ca3af; }
        .field input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
        }
        .field input.is-invalid { border-color: #ef4444; }

        .pw-toggle {
            position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #9ca3af;
            display: flex; align-items: center; transition: color 0.2s;
        }
        .pw-toggle:hover { color: #6366f1; }

        .field-err { font-size: 0.78rem; color: #dc2626; margin-top: 5px; padding-left: 2px; }

        .forgot-row { text-align: right; margin-bottom: 20px; }
        .forgot-link { font-size: 0.83rem; color: #6b7280; text-decoration: none; font-weight: 500; }
        .forgot-link:hover { color: #111; }

        /* Buttons */
        .btn-signin {
            width: 100%;
            padding: 16px;
            background: #0d0f12;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-signin:hover { background: #1f2937; transform: translateY(-1px); }
        .btn-signin:active { transform: translateY(0); }
        .btn-signin.loading { opacity: 0.75; pointer-events: none; }

        .btn-spin {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.3); border-top-color: #fff;
            border-radius: 50%; animation: spin 0.65s linear infinite; display: none;
        }
        .btn-signin.loading .btn-spin { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .panel-bottom { font-size: 0.8rem; color: #9ca3af; text-align: center; }
        .panel-bottom a { color: #6b7280; text-decoration: none; font-weight: 500; }
        .panel-bottom a:hover { color: #111; }

        /* ── RIGHT PANEL ── */
        .panel-right {
            background: #0d0f12;
            border-radius: 0 20px 20px 0;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 40px;
        }

        /* Hex grid background */
        .panel-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='104'%3E%3Cpolygon points='30,2 58,17 58,47 30,62 2,47 2,17' fill='none' stroke='rgba(255,255,255,0.055)' stroke-width='1'/%3E%3Cpolygon points='30,62 58,77 58,107 30,122 2,107 2,77' fill='none' stroke='rgba(255,255,255,0.055)' stroke-width='1'/%3E%3Cpolygon points='-30,32 -2,17 -2,47 -30,62 -58,47 -58,17' fill='none' stroke='rgba(255,255,255,0.055)' stroke-width='1'/%3E%3Cpolygon points='90,32 118,17 118,47 90,62 62,47 62,17' fill='none' stroke='rgba(255,255,255,0.055)' stroke-width='1'/%3E%3C/svg%3E");
            background-size: 60px 104px;
            pointer-events: none;
        }

        /* Glow blob */
        .panel-right::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(56,189,148,0.15) 0%, rgba(99,102,241,0.08) 45%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -60%);
            pointer-events: none;
        }

        /* Center illustration */
        .illus-wrap {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -58%);
            z-index: 2;
        }

        .hex-glow {
            width: 260px; height: 280px;
            clip-path: polygon(50% 0%, 93% 25%, 93% 75%, 50% 100%, 7% 75%, 7% 25%);
            background: linear-gradient(160deg, #1a2535, #0f1620);
            border: 0;
            position: relative;
            display: flex; align-items: center; justify-content: center;
            filter: drop-shadow(0 0 18px rgba(56,189,148,0.35)) drop-shadow(0 0 40px rgba(99,102,241,0.2));
        }

        .hex-border {
            position: absolute;
            inset: 0;
            clip-path: polygon(50% 0%, 93% 25%, 93% 75%, 50% 100%, 7% 75%, 7% 25%);
            background: linear-gradient(to bottom, rgba(56,189,148,0.5), rgba(99,102,241,0.3));
            z-index: -1;
        }

        /* Building SVG inside hex */
        .hex-content {
            width: 130px; height: 130px;
            display: flex; align-items: center; justify-content: center;
        }

        /* Floating shapes */
        .float-shape {
            position: absolute;
            z-index: 3;
        }
        .shape-diamond {
            width: 14px; height: 14px;
            background: #facc15;
            transform: rotate(45deg);
            top: 22%; right: 28%;
        }
        .shape-diamond2 {
            width: 10px; height: 10px;
            background: #4ade80;
            transform: rotate(45deg);
            bottom: 38%; left: 20%;
        }
        .shape-ring {
            width: 50px; height: 50px;
            border: 8px solid #34d399;
            border-radius: 50%;
            bottom: 30%; right: 18%;
            opacity: 0.8;
        }
        .shape-gem {
            width: 40px; height: 40px;
            top: 16%; left: 30%;
            opacity: 0.75;
        }

        /* Bottom text */
        .illus-text {
            position: relative;
            z-index: 5;
            text-align: center;
            color: #fff;
        }
        .illus-title { font-size: 1.3rem; font-weight: 700; margin-bottom: 8px; letter-spacing: -0.3px; }
        .illus-sub { font-size: 0.82rem; color: rgba(255,255,255,0.5); line-height: 1.6; max-width: 240px; margin: 0 auto 20px; }

        .dots { display: flex; gap: 6px; justify-content: center; }
        .dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,0.25); }
        .dot.active { background: #fff; width: 18px; border-radius: 3px; }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- ── LEFT: Form Panel ── --}}
    <div class="panel-left">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>
            <span class="brand-name">Mal Bali Galeria</span>
        </div>

        <div class="form-area">
            <h1 class="form-title">Welcome Back!</h1>
            <p class="form-sub">Please enter your log in details below</p>

            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
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
                        class="@error('password') is-invalid @enderror" style="padding-right: 48px;">
                    <button type="button" class="pw-toggle" onclick="togglePw()" tabindex="-1">
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
                        <a class="forgot-link" href="{{ route('password.request') }}">Forget password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-signin" id="loginBtn">
                    <span class="btn-spin" id="btnSpin"></span>
                    <span class="btn-text">Sign in</span>
                </button>
            </form>
        </div>

        <div class="panel-bottom">
            <a href="{{ url('/') }}">← Back to website</a>
            &nbsp;&nbsp;·&nbsp;&nbsp;
            &copy; {{ date('Y') }} Mal Bali Galeria
        </div>
    </div>

    {{-- ── RIGHT: Dark Illustration Panel ── --}}
    <div class="panel-right">

        {{-- Floating decorative shapes --}}
        <div class="float-shape shape-diamond"></div>
        <div class="float-shape shape-diamond2"></div>
        <div class="float-shape shape-ring"></div>
        <div class="float-shape shape-gem">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="20,2 38,14 38,26 20,38 2,26 2,14" fill="rgba(99,102,241,0.25)" stroke="rgba(99,102,241,0.6)" stroke-width="1.5"/>
            </svg>
        </div>

        {{-- Central hex illustration --}}
        <div class="illus-wrap">
            <div class="hex-glow">
                <div class="hex-border"></div>
                <div class="hex-content">
                    <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" width="120" height="120">
                        {{-- Mall building illustration --}}
                        <rect x="10" y="55" width="100" height="55" rx="3" fill="rgba(255,255,255,0.07)" stroke="rgba(56,189,148,0.4)" stroke-width="1.5"/>
                        <rect x="22" y="38" width="76" height="20" rx="2" fill="rgba(255,255,255,0.05)" stroke="rgba(56,189,148,0.35)" stroke-width="1.5"/>
                        <rect x="35" y="24" width="50" height="17" rx="2" fill="rgba(255,255,255,0.05)" stroke="rgba(56,189,148,0.3)" stroke-width="1.5"/>
                        <rect x="48" y="14" width="24" height="13" rx="2" fill="rgba(255,255,255,0.04)" stroke="rgba(56,189,148,0.25)" stroke-width="1.5"/>
                        {{-- Windows --}}
                        <rect x="18" y="62" width="12" height="10" rx="1" fill="rgba(56,189,148,0.2)" stroke="rgba(56,189,148,0.5)" stroke-width="1"/>
                        <rect x="36" y="62" width="12" height="10" rx="1" fill="rgba(56,189,148,0.2)" stroke="rgba(56,189,148,0.5)" stroke-width="1"/>
                        <rect x="54" y="62" width="12" height="10" rx="1" fill="rgba(56,189,148,0.2)" stroke="rgba(56,189,148,0.5)" stroke-width="1"/>
                        <rect x="72" y="62" width="12" height="10" rx="1" fill="rgba(56,189,148,0.2)" stroke="rgba(56,189,148,0.5)" stroke-width="1"/>
                        <rect x="90" y="62" width="12" height="10" rx="1" fill="rgba(56,189,148,0.2)" stroke="rgba(56,189,148,0.5)" stroke-width="1"/>
                        {{-- Door --}}
                        <rect x="48" y="85" width="24" height="25" rx="2" fill="rgba(99,102,241,0.25)" stroke="rgba(99,102,241,0.6)" stroke-width="1.5"/>
                        {{-- Glow base --}}
                        <ellipse cx="60" cy="112" rx="40" ry="5" fill="rgba(56,189,148,0.15)"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Bottom text --}}
        <div class="illus-text">
            <h2 class="illus-title">Manage Your Mall Anywhere</h2>
            <p class="illus-sub">Access and control all mall operations from one powerful admin dashboard.</p>
            <div class="dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
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
