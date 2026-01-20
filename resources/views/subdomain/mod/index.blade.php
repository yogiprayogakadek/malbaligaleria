<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager on Duty | Mal Bali Galeria</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/mod.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
</head>

<body>

    <div class="mod-container">
        <!-- Folded Corner Flap -->
        <div class="fold-flap"></div>

        <!-- Left Side: Photo -->
        <div class="photo-container">
            <!-- Placeholder for Manager Photo -->
            <img src="https://ui-avatars.com/api/?name=John+Doe&background=e0e0e0&size=400" alt="Manager Photo">
        </div>

        <!-- Right Side: Logo & Info -->
        <div class="info-side">
            <!-- Logo Top Right (visually via Flex/Grid placement) -->
            <div class="logo-section">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria Logo">
            </div>

            <!-- Info Box -->
            <div class="details-box">
                <h1 class="manager-name">John Doe</h1>
                <p class="manager-position">Operational Manager</p>

                <div class="contact-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                    <span>+62 812 3456 7890</span>
                </div>

                <div class="date-display">
                    <div class="date-day">{{ \Carbon\Carbon::now()->format('l') }}</div>
                    <div class="date-full">{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="footer-section">
            <div class="mbg-title">Mal Bali Galeria</div>
            <div class="mbg-slogan">enjoy, play, eat, shop</div>
        </div>
    </div>

</body>

</html>
