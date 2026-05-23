<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Maintenance — Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c5f5d;
            --gold: #D4AF37;
            --dark: #0f1c1b;
            --text-light: #e6f0ee;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at center, #1b3534 0%, var(--dark) 100%);
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow: hidden;
            position: relative;
        }

        /* Abstract ambient lights */
        .ambient-light {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--gold);
            filter: blur(150px);
            opacity: 0.15;
            border-radius: 50%;
            pointer-events: none;
        }

        .light-1 { top: 10%; left: 10%; }
        .light-2 { bottom: 10%; right: 10%; }

        .container {
            max-width: 600px;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: pulse-border 2.5s infinite ease-in-out;
        }

        .logo-img {
            height: 50px;
            width: auto;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 600;
            color: var(--gold);
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }

        p {
            font-size: 16px;
            line-height: 1.7;
            color: #b0c4c2;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
            border: 1px solid rgba(212, 175, 55, 0.2);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .admin-link {
            display: inline-block;
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.25);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
            font-weight: 400;
        }

        .admin-link:hover {
            color: var(--gold);
        }

        @keyframes pulse-border {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4);
                border-color: rgba(212, 175, 55, 0.5);
            }
            50% {
                box-shadow: 0 0 20px 4px rgba(212, 175, 55, 0.15);
                border-color: rgba(212, 175, 55, 0.8);
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 40px 20px;
            }
            h1 {
                font-size: 28px;
            }
            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="ambient-light light-1"></div>
    <div class="ambient-light light-2"></div>

    <div class="container">
        <div class="logo-circle">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria Logo" class="logo-img" onerror="this.src='{{ asset('assets/images/default/mbg.png') }}'">
        </div>

        <div class="badge">Scheduled Maintenance</div>

        <h1>We'll Be Back Shortly</h1>

        <p>
            {{ $exception->getMessage() ?: 'We are currently performing scheduled system updates to improve your experience. Please check back with us soon.' }}
        </p>

        <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px; font-size: 12px; color: rgba(255,255,255,0.2);">
            Mal Bali Galeria &copy; {{ date('Y') }}
        </div>

        <a href="{{ url('/admin') }}" class="admin-link">Administrative Portal</a>
    </div>

</body>
</html>
