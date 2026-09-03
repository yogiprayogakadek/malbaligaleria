<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Negeri 1 Payangan — Masuk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg-page: #eef6d9;
            --card-bg: #ffffff;
            --text-dark: #22252b;
            --text-muted-solid: #9297a1;
            --input-bg: #f3f4f6;
            --input-bg-focus: #eef1f5;
            --green-500: #8ec73f;
            --green-600: #6fae2a;
            --green-300: #a9d751;
            --line: #ececec;
            --radius-card: 32px;
            --shadow-card: 0 30px 60px -20px rgba(60, 80, 20, 0.18), 0 10px 25px -10px rgba(60, 80, 20, 0.10);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background:
                radial-gradient(circle at 15% 15%, #f4fae2 0%, transparent 45%),
                radial-gradient(circle at 85% 85%, #e7f4cf 0%, transparent 45%),
                var(--bg-page);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            color: var(--text-dark);
        }

        .card {
            width: 100%;
            max-width: 940px;
            background: var(--card-bg);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            overflow: hidden;
        }

        /* ---------- LEFT PANEL ---------- */
        .left {
            padding: 44px 52px;
            display: flex;
            flex-direction: column;
        }

        .school-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 32px;
        }

        .web-logo {
            width: auto;
            height: 56px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .logo {
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 19px;
            color: #2c2f35;
            letter-spacing: 0.4px;
            line-height: 1.3;
        }

        .logo-sub {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--green-500);
            letter-spacing: 1.6px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .left-content {
            max-width: 380px;
            margin: auto 0;
        }

        h1 {
            font-family: 'Baloo 2', sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 6px 0;
            color: #1b1d22;
        }

        .subtitle {
            margin: 0 0 24px 0;
            font-size: 14px;
            color: var(--text-muted-solid);
            line-height: 1.5;
        }

        /* ---------- Error Alert ---------- */
        .alert-error {
            background: #fff2f2;
            border: 1.5px solid #f5c6c6;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #c0392b;
            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.45;
        }

        .alert-error svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            margin-top: 1px;
            color: #e05252;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .field {
            position: relative;
            margin-bottom: 12px;
        }

        .field input {
            width: 100%;
            background: var(--input-bg);
            border: 1.5px solid transparent;
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 14.5px;
            font-family: inherit;
            color: #3a3d43;
            outline: none;
            transition: border-color .15s ease, background .15s ease;
        }

        .field input:focus {
            border-color: var(--green-300);
            background: var(--input-bg-focus);
        }

        .field input.input-error {
            border-color: #e05252;
            background: #fff5f5;
        }

        .field.password-field input {
            padding-right: 60px;
            letter-spacing: 2px;
        }

        .toggle-pass {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 13px;
            font-family: inherit;
            font-weight: 500;
            color: var(--text-muted-solid);
            cursor: pointer;
            padding: 4px;
        }

        .toggle-pass:hover {
            color: var(--text-dark);
        }

        .row-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 22px 0;
            font-size: 13.5px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #5b5f66;
            user-select: none;
        }

        .checkbox input {
            position: absolute;
            opacity: 0;
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
        }

        .box {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            background: var(--green-500);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background .15s ease, box-shadow .15s ease;
        }

        .box svg {
            width: 11px;
            height: 11px;
            opacity: 0;
            transition: opacity .1s ease;
        }

        .checkbox input:checked+.box {
            background: var(--green-500);
        }

        .checkbox input:checked+.box svg {
            opacity: 1;
        }

        .checkbox input:not(:checked)+.box {
            background: #e3e5e8;
        }

        .checkbox input:focus-visible+.box {
            box-shadow: 0 0 0 3px rgba(142, 199, 63, 0.35);
        }

        .link {
            color: var(--green-300);
            text-decoration: none;
            font-weight: 600;
        }

        .link:hover {
            text-decoration: underline;
        }

        .btn-primary {
            border: none;
            border-radius: 12px;
            padding: 14px 20px;
            background: linear-gradient(135deg, var(--green-500), var(--green-600));
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform .12s ease, box-shadow .12s ease, opacity .15s ease;
            box-shadow: 0 10px 20px -8px rgba(111, 174, 42, 0.55);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 24px -8px rgba(111, 174, 42, 0.65);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary svg {
            width: 16px;
            height: 16px;
            transition: transform .15s ease;
        }

        .btn-primary:hover svg {
            transform: translateX(3px);
        }

        .btn-primary[disabled] {
            opacity: 0.8;
            cursor: default;
            transform: none;
        }

        .spinner {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2.5px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            animation: spin .7s linear infinite;
            display: none;
        }

        .btn-primary.loading .spinner {
            display: inline-block;
        }

        .btn-primary.loading .btn-label,
        .btn-primary.loading .arrow-icon {
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .signup {
            text-align: center;
            margin: 22px 0 0 0;
            font-size: 13.5px;
            color: #8b8f96;
        }

        .link-static {
            color: var(--green-300);
            font-weight: 600;
        }

        .school-footer {
            text-align: center;
            font-size: 11.5px;
            color: #a3a8b0;
            margin-top: 24px;
        }

        /* ---------- RIGHT PANEL (photo) ---------- */
        .right {
            position: relative;
            padding: 14px;
        }

        .right-photo {
            width: 100%;
            height: 100%;
            border-radius: 24px;
            overflow: hidden;
            display: block;
        }

        .right-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        /* ---------- Toast ---------- */
        .toast {
            position: fixed;
            left: 50%;
            bottom: 28px;
            transform: translate(-50%, 20px);
            background: #232529;
            color: #fff;
            padding: 13px 22px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 500;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s ease, transform .25s ease;
            box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.4);
            z-index: 50;
        }

        .toast.show {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 800px) {
            .card {
                grid-template-columns: 1fr;
            }

            .right {
                order: -1;
                padding: 12px 12px 0 12px;
                height: 220px;
            }

            .right-photo {
                border-radius: 20px;
                height: 100%;
            }

            .left {
                padding: 32px 24px 40px;
            }

            .left-content {
                max-width: none;
                margin: 0;
            }
        }

        @media (max-width: 420px) {
            .left {
                padding: 24px 18px 32px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="card">

        <!-- LEFT: form -->
        <div class="left">
            <div class="school-header">
                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo Web"
                    class="web-logo"
                >
                <div class="logo">SMA NEGERI 1<br>PAYANGAN</div>
                <div class="logo-sub">Sistem Informasi Akademik</div>
            </div>

            <div class="left-content">
                <h1>Selamat Datang Kembali!</h1>
                <p class="subtitle">Masuk untuk melanjutkan akses ke portal akademik sekolah.</p>

                @if(session('error'))
                <div class="alert-error" id="sessionErrorAlert">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="alert-error" id="validationErrorAlert">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('admin.portal.store') }}">
                    @csrf
                    <div class="field">
                        <input type="email" id="email" name="email" placeholder="Email/NIK/NUPTK/NIP" autocomplete="off"
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            value="{{ old('email') }}">
                    </div>

                    <div class="field password-field">
                        <input type="password" id="password" name="password" placeholder="Password" autocomplete="off"
                            class="{{ $errors->has('password') ? 'input-error' : '' }}">
                        <button type="button" class="toggle-pass" id="togglePass">Lihat</button>
                    </div>

                    <div class="row-options">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" checked>
                            <span class="box">
                                <svg viewBox="0 0 16 16" fill="none">
                                    <path d="M3 8.5L6.2 11.5L13 4.5" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Ingat saya
                        </label>
                        <a href="#" class="link" id="forgotLink">Lupa kata sandi?</a>
                    </div>

                    <button type="submit" class="btn-primary" id="loginBtn">
                        <span class="spinner"></span>
                        <span class="btn-label">Masuk</span>
                        <svg class="arrow-icon" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <p class="signup">Belum punya akun? <span class="link-static">Hubungi admin sekolah</span></p>
            </div>

            <p class="school-footer">© 2026 SMA Negeri 1 Payangan &middot; Jl. Raya Payangan, Gianyar, Bali</p>
        </div>

        <!-- RIGHT: photo -->
        <div class="right">
            <div class="right-photo">
                <img
                    src="https://patrolibali.com/wp-content/uploads/2023/09/IMG-20230929-WA0059-768x1024.jpg"
                    alt="SMA Negeri 1 Payangan"
                >
            </div>
        </div>

    </div>

    <div class="toast" id="toast"></div>

    <script>
        // Password show / hide
        const pwInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePass');
        toggleBtn.addEventListener('click', () => {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            toggleBtn.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
        });

        // Toast helper
        const toastEl = document.getElementById('toast');
        let toastTimer;

        function showToast(message) {
            clearTimeout(toastTimer);
            toastEl.textContent = message;
            toastEl.classList.add('show');
            toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2600);
        }

        // Show error toast if session error exists
        @if(session('error'))
        showToast("{{ session('error') }}");
        @endif

        // Forgot password link
        document.getElementById('forgotLink').addEventListener('click', (e) => {
            e.preventDefault();
            showToast('Fitur reset kata sandi belum terhubung.');
        });
    </script>

</body>

</html>
