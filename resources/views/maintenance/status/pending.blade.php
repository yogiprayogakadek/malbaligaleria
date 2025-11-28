<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Account Pending - {{ config('app.name', 'Laravel') }}</title>

    <style>
        :root {
            --primary-color: #3b82f6;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --warning: #f59e0b;
            --bg-light: #f8fafc;
            --border-light: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: var(--bg-light);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .status-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-icon svg {
            width: 40px;
            height: 40px;
        }

        .status-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--warning);
            margin-bottom: 10px;
        }

        .status-message {
            font-size: 16px;
            color: var(--text-primary);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .status-details {
            background-color: rgba(245, 158, 11, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: left;
        }

        .status-details p {
            margin: 5px 0;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .auth-button {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 10px 0;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }

        .auth-button:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }

        .auth-button:active {
            transform: translateY(0);
        }

        .auth-button.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .auth-button.secondary:hover {
            background: #f1f5f9;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </div>

        <div class="status-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>

        <h3 class="status-title">Account Pending</h3>
        <p class="status-message">
            Your registration is currently under review. Please wait while we verify your information.
        </p>

        <div class="status-details">
            <p>• Verification typically takes 24-48 hours</p>
            <p>• You will receive an email once approved</p>
            <p>• Contact support if you have questions</p>
        </div>

        <a href="#" class="auth-button secondary"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        {{-- <a href="{{ route('login') }}" class="auth-button">Back to Login</a> --}}
    </div>
</body>

</html>
