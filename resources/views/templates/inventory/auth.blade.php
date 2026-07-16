<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/styles.css') }}" />
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f5f0ea;
            overflow: hidden;
        }

        /* ── Left panel: visual branding ── */
        .left-panel {
            flex: 0 0 48%;
            position: relative;
            background: #1a1a2e;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 48px 52px;
        }

        /* Deep layered gradient */
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg,
                #2d1b4e 0%,
                #1a1a2e 35%,
                #0d2137 65%,
                #1c3a54 100%);
            z-index: 0;
        }

        /* Geometric grid lines – mall glass-ceiling feel */
        .grid-lines {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            opacity: 0.15;
        }
        .grid-lines::before {
            content: '';
            position: absolute;
            top: -60px; left: -60px;
            width: 160%; height: 160%;
            background-image:
                linear-gradient(rgba(212,175,55,0.7) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212,175,55,0.7) 1px, transparent 1px);
            background-size: 58px 58px;
            transform: rotate(-12deg);
        }

        /* Ambient glow circles */
        .glow-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 1;
        }
        .glow-circle.c1 {
            width: 380px; height: 380px;
            background: rgba(212, 175, 55, 0.22);
            top: -80px; right: -80px;
        }
        .glow-circle.c2 {
            width: 280px; height: 280px;
            background: rgba(99, 143, 210, 0.18);
            bottom: 60px; left: -60px;
        }

        /* Decorative shapes (mall architecture motifs) */
        .mall-shape { position: absolute; z-index: 2; }
        .mall-shape.arch {
            bottom: 185px; right: 44px;
            width: 110px; height: 110px;
            border: 2px solid rgba(212,175,55,0.3);
            border-radius: 55px 55px 0 0;
        }
        .mall-shape.ring {
            top: 110px; left: 54px;
            width: 60px; height: 60px;
            border: 2px solid rgba(255,255,255,0.12);
            border-radius: 50%;
        }
        .mall-shape.dot-accent {
            top: 220px; right: 80px;
            width: 10px; height: 10px;
            background: rgba(212,175,55,0.45);
            border-radius: 50%;
        }

        /* Pill badge */
        .lp-badge {
            position: relative; z-index: 5;
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(212,175,55,0.12);
            border: 1px solid rgba(212,175,55,0.38);
            color: #d4af37;
            font-size: 10.5px; font-weight: 600;
            letter-spacing: 1.8px; text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 20px;
            width: fit-content;
        }
        .lp-badge .dot { width: 6px; height: 6px; background: #d4af37; border-radius: 50%; }

        .lp-headline {
            position: relative; z-index: 5;
            font-family: 'Playfair Display', serif;
            font-size: 40px; font-weight: 700;
            color: #fff; line-height: 1.2;
            margin-bottom: 16px;
        }
        .lp-headline em { font-style: normal; color: #d4af37; }

        .lp-sub {
            position: relative; z-index: 5;
            font-size: 13.5px; color: rgba(255,255,255,0.48);
            line-height: 1.65; max-width: 340px; margin-bottom: 38px;
        }

        .lp-stats {
            position: relative; z-index: 5;
            display: flex; gap: 28px;
        }
        .lp-stat-item { display: flex; flex-direction: column; }
        .lp-stat-item .num { font-size: 24px; font-weight: 700; color: #d4af37; line-height: 1; }
        .lp-stat-item .lbl { font-size: 10.5px; color: rgba(255,255,255,0.38); margin-top: 3px; letter-spacing: .5px; }
        .lp-divider { width: 1px; background: rgba(255,255,255,0.1); margin: 2px 0; }

        /* ── Right panel ── */
        .right-panel {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 60px 52px;
            background: #f5f0ea;
            position: relative;
        }
        .right-panel::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 80% 15%, rgba(212,175,55,0.06) 0%, transparent 55%),
                radial-gradient(circle at 20% 85%, rgba(99,143,210,0.04) 0%, transparent 50%);
            pointer-events: none;
        }

        .form-container {
            position: relative; z-index: 1;
            width: 100%; max-width: 390px;
        }

        .form-eyebrow {
            font-size: 11px; font-weight: 600;
            letter-spacing: 2px; text-transform: uppercase;
            color: #b8860b; margin-bottom: 10px;
        }
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 700;
            color: #1a1a2e; margin-bottom: 6px; line-height: 1.2;
        }
        .form-desc {
            font-size: 13.5px; color: #7a6f5e;
            margin-bottom: 32px; line-height: 1.5;
        }

        /* Fields */
        .field-group { margin-bottom: 20px; }
        .field-label {
            display: block; font-size: 11.5px; font-weight: 600;
            letter-spacing: .5px; color: #3d3327;
            margin-bottom: 7px; text-transform: uppercase;
        }
        .field-wrap { position: relative; }
        .field-wrap .field-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: #a09282;
            font-size: 16px; pointer-events: none;
            display: flex; align-items: center;
        }
        .field-wrap input {
            width: 100%;
            padding: 13px 44px 13px 44px;
            background: #fff;
            border: 1.5px solid #e8e0d4;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px; color: #2a2018;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field-wrap input::placeholder { color: #c0b49f; }
        .field-wrap input:focus {
            border-color: #b8860b;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.1);
        }
        .field-wrap .toggle-eye {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #a09282; font-size: 16px;
            display: flex; align-items: center; padding: 0;
        }

        /* Remember */
        .remember-row {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 26px;
        }
        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #b8860b; cursor: pointer;
        }
        .remember-row label { font-size: 13px; color: #6b5e4e; cursor: pointer; }

        /* Submit */
        .btn-login {
            width: 100%; padding: 14px 20px;
            background: linear-gradient(135deg, #b8860b 0%, #d4af37 50%, #c9951a 100%);
            color: #fff; border: none; border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14.5px; font-weight: 700; letter-spacing: .5px;
            cursor: pointer; position: relative; overflow: hidden;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 20px rgba(184,134,11,0.3);
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 28px rgba(184,134,11,0.38); }
        .btn-login:active { transform: translateY(0); }

        /* Error alert */
        .alert-err {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fdf4f4;
            border: 1px solid #f0c0c0;
            border-left: 4px solid #dc2626;
            border-radius: 8px;
            padding: 12px 14px; margin-bottom: 22px;
            font-size: 13px; color: #7f1d1d;
        }
        .alert-err .icon { flex-shrink: 0; font-size: 16px; margin-top: 1px; }

        /* Footer note */
        .form-footer-note {
            text-align: center; margin-top: 30px;
            font-size: 12px; color: #a8997f; line-height: 1.6;
        }

        /* Copyright */
        .page-copyright {
            position: absolute; bottom: 24px;
            left: 0; right: 0;
            text-align: center;
            font-size: 11.5px; color: #c5b89a;
        }

        /* Mobile */
        @media (max-width: 820px) {
            .left-panel { display: none; }
            body { justify-content: center; }
            .right-panel { padding: 40px 28px; }
        }
    </style>

    @stack('css')
    <title>@yield('page-title', 'Login') — Inventory | Mal Bali Galeria</title>
</head>
<body>

    <!-- ── LEFT PANEL ── -->
    <div class="left-panel">
        <div class="grid-lines"></div>
        <div class="glow-circle c1"></div>
        <div class="glow-circle c2"></div>
        <div class="mall-shape arch"></div>
        <div class="mall-shape ring"></div>
        <div class="mall-shape dot-accent"></div>

        <div class="lp-badge">
            <span class="dot"></span>
            Mal Bali Galeria
        </div>

        <h1 class="lp-headline">
            Pusat Kendali<br><em>Inventaris</em> Modern
        </h1>

        <p class="lp-sub">
            Sistem manajemen aset terpadu untuk operasional Mal Bali Galeria — efisien, akurat, dan real-time.
        </p>

        <div class="lp-stats">
            <div class="lp-stat-item">
                <span class="num">5+</span>
                <span class="lbl">Lantai</span>
            </div>
            <div class="lp-divider"></div>
            <div class="lp-stat-item">
                <span class="num">200+</span>
                <span class="lbl">Tenant</span>
            </div>
            <div class="lp-divider"></div>
            <div class="lp-stat-item">
                <span class="num">∞</span>
                <span class="lbl">Aset Terkelola</span>
            </div>
        </div>
    </div>

    <!-- ── RIGHT PANEL ── -->
    <div class="right-panel">
        <div class="form-container">

            <p class="form-eyebrow">Inventory System</p>
            <h2 class="form-title">Selamat Datang</h2>
            <p class="form-desc">Masuk untuk mengelola aset dan perangkat mal.</p>

            @yield('content')

        </div>

        <p class="page-copyright">
            &copy; {{ date('Y') }} Mal Bali Galeria &mdash; All rights reserved.
        </p>
    </div>

    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/iconify-icon.min.js') }}"></script>
    @stack('script')
</body>
</html>
