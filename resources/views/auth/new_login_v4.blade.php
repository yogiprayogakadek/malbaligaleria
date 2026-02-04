<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mal Bali Galeria | Premium Access v4</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2c5f5d;
            --primary-light: #428381;
            --primary-dark: #1a3a38;
            --accent: #c9a96e;
            --text-main: #1a1f1e;
            --text-muted: #64748b;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            --noise: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            overflow: hidden;
            perspective: 1000px;
        }

        /* Ultra-Premium Background */
        .page-background {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: #f8fafc;
        }

        .noise-layer {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background: var(--noise);
            pointer-events: none;
            z-index: 2;
        }

        .mesh-gradient {
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(at 0% 0%, hsla(177, 36%, 27%, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(41, 46%, 61%, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, hsla(177, 36%, 17%, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(41, 46%, 61%, 0.15) 0px, transparent 50%);
            filter: blur(80px);
            z-index: 1;
        }

        .organic-blob {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.4;
            transition: transform 0.2s ease-out;
        }

        .blob-1 {
            background: hsla(177, 36%, 27%, 0.2);
            top: -100px;
            left: -100px;
            animation: drift 20s infinite alternate;
        }

        .blob-2 {
            background: hsla(41, 46%, 61%, 0.15);
            bottom: -150px;
            right: -100px;
            animation: drift 25s infinite alternate-reverse;
        }

        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(50px, 50px) scale(1.1); }
        }

        /* Auth Card */
        .auth-card {
            width: 100%;
            max-width: 480px;
            padding: 60px;
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 40px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        /* Light Leak Effect */
        .auth-card::before {
            content: "";
            position: absolute;
            top: -200px;
            left: -200px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Noise on Card */
        .card-noise {
            position: absolute;
            inset: 0;
            opacity: 0.03;
            background: var(--noise);
            pointer-events: none;
            z-index: 1;
        }

        .card-inner {
            position: relative;
            z-index: 2;
        }

        /* Staggered Animations */
        .stagger-1 { opacity: 0; animation: reveal 0.8s ease forwards 0.6s; }
        .stagger-2 { opacity: 0; animation: reveal 0.8s ease forwards 0.7s; }
        .stagger-3 { opacity: 0; animation: reveal 0.8s ease forwards 0.8s; }
        .stagger-4 { opacity: 0; animation: reveal 0.8s ease forwards 0.9s; }
        .stagger-5 { opacity: 0; animation: reveal 0.8s ease forwards 1.0s; }

        @keyframes reveal {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-section {
            text-align: center;
            margin-bottom: 45px;
        }

        .auth-logo {
            width: 85px;
            height: 85px;
            margin: 0 auto 25px;
            padding: 18px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-3deg);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .auth-logo:hover {
            transform: rotate(0deg) scale(1.05);
        }

        .auth-logo img {
            max-width: 100%;
            height: auto;
        }

        .brand-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .brand-section p {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
        }

        /* Input Fields */
        .form-group {
            position: relative;
            margin-bottom: 28px;
        }

        .form-group label {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 15px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 24px 16px 8px;
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            font-size: 16px;
            color: var(--text-main);
            outline: none;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(44, 95, 93, 0.1);
        }

        .form-group.focused label,
        .form-group.has-value label {
            top: 12px;
            font-size: 11px;
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Buttons & Actions */
        .btn-primary {
            width: 100%;
            padding: 18px;
            margin-top: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.4s;
            box-shadow: 0 10px 20px rgba(44, 95, 93, 0.2);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        /* Shimmer Effect */
        .btn-primary::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 4s infinite;
        }

        @keyframes shimmer {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(44, 95, 93, 0.3);
        }

        .utility-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            font-size: 13px;
            font-weight: 500;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .remember-me input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            transition: 0.2s;
        }

        .forgot-password:hover {
            color: var(--accent);
        }

        /* Preloader Refined */
        .preloader {
            position: fixed;
            inset: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.8s ease;
        }

        .preloader.hidden { opacity: 0; pointer-events: none; }

        .preloader-logo {
            width: 60px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        @media (max-width: 576px) {
            .auth-card { padding: 40px 30px; margin: 20px; border-radius: 30px; }
        }
    </style>
</head>

<body>
    <div class="preloader" id="preloader">
        <img src="{{ asset('assets/images/logo.png') }}" class="preloader-logo" alt="MBG">
    </div>

    <div class="page-background">
        <div class="noise-layer"></div>
        <div class="mesh-gradient"></div>
        <div class="organic-blob blob-1" id="blob-1"></div>
        <div class="organic-blob blob-2" id="blob-2"></div>
    </div>

    <main class="auth-card">
        <div class="card-noise"></div>
        <div class="card-inner">
            <header class="brand-section">
                <div class="auth-logo stagger-1">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo">
                </div>
                <h1 class="stagger-2">Premium Access</h1>
                <p class="stagger-3">Manage your destination dashboard</p>
            </header>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group stagger-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="form-control @error('email') is-invalid @enderror" 
                        required autofocus autocomplete="username">
                    @error('email')
                        <p class="error-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group stagger-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        required autocomplete="current-password">
                    @error('password')
                        <p class="error-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="utility-links stagger-5">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Keep me signed in</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Recovery Access?</a>
                    @endif
                </div>

                <button type="submit" class="btn-primary stagger-5">
                    <span>Unlock Dashboard</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </button>
            </form>
        </div>
    </main>

    <script>
        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            setTimeout(() => { preloader.classList.add('hidden'); }, 800);
        });

        // Mouse Parallax for blobs
        const blob1 = document.getElementById('blob-1');
        const blob2 = document.getElementById('blob-2');

        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX - window.innerWidth / 2) / 30;
            const y = (e.clientY - window.innerHeight / 2) / 30;
            
            blob1.style.transform = `translate(${x}px, ${y}px)`;
            blob2.style.transform = `translate(${-x}px, ${-y}px)`;
        });

        // Input Interactions
        const inputs = document.querySelectorAll('.form-control');
        
        function updateGroup(input) {
            const group = input.parentElement;
            if (input.value.trim() !== '') {
                group.classList.add('has-value');
            } else {
                group.classList.remove('has-value');
            }
        }

        inputs.forEach(input => {
            if (input.value.trim() !== '') updateGroup(input);

            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
                updateGroup(input);
            });

            input.addEventListener('input', () => updateGroup(input));
        });
    </script>
</body>

</html>
