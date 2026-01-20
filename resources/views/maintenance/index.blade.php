<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - Mal Bali Galeria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2c5f5d 0%, #1a3a38 100%);
            --secondary-gradient: linear-gradient(135deg, #7d9d9c 0%, #5a7c7a 100%);
            --text-dark: #2c3e50;
            --text-light: #e8ebe9;
            --bg-light: #fafaf8;
            --primary-color: #2c5f5d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#2c5f5d 0.5px, transparent 0.5px), radial-gradient(#2c5f5d 0.5px, var(--bg-light) 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
            z-index: -1;
        }

        .container {
            text-align: center;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .logo img {
            height: 80px;
            width: auto;
            object-fit: contain;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 30px;
        }

        .divider {
            height: 3px;
            width: 60px;
            background: var(--primary-gradient);
            margin: 0 auto 30px;
            border-radius: 2px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(44, 95, 93, 0.1);
            color: var(--primary-color);
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background-color: var(--primary-color);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(44, 95, 93, 0.4);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(44, 95, 93, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(44, 95, 93, 0);
            }
        }

        .contact-info {
            font-size: 14px;
            color: #888;
            margin-top: 40px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--primary-color);
            border: 1px solid rgba(44, 95, 93, 0.2);
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(44, 95, 93, 0.2);
        }

        .social-link svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-pattern"></div>

    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria"
                onerror="this.src='{{ asset('assets/images/logo.png') }}'">
        </div>

        <div class="status-badge">
            <span class="status-dot"></span>
            System Upgrade
        </div>

        <h1>Under Maintenance</h1>
        <div class="divider"></div>

        <p>
            We are currently working on making our website better for you.<br>
            Please check back soon for an enhanced experience.
        </p>

        <p>
            In the meantime, you can visit us directly at<br>
            <strong>Mal Bali Galeria</strong>
        </p>

        <div class="contact-info">
            &copy; {{ date('Y') }} Mal Bali Galeria. All Rights Reserved.
        </div>
    </div>
</body>

</html>
