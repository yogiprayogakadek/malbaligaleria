<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dining | Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Argesta+Display&display=swap" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dining.css') }}?v={{ time() }}">
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                        style="display: block;">
                </div>
                <h1>mal bali galeria</h1>
                <span>SHOPPING CENTER</span>
            </div>
            <div class="loader-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
            <div class="loader-progress">
                <div class="progress-bar"></div>
            </div>
            <p class="loader-text">LOADING...</p>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
        <svg class="moon-icon" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
        <svg class="sun-icon" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="5" />
            <line x1="12" y1="1" x2="12" y2="3" stroke="currentColor" stroke-width="2" />
            <line x1="12" y1="21" x2="12" y2="23" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" />
            <line x1="1" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="21" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor" stroke-width="2" />
        </svg>
    </button>

    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;">
            </a>
        </div>

        <div class="logo">
            <h1>mal bali galeria<span>SHOPPING CENTER</span></h1>
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>mal bali galeria<span>SHOPPING CENTER</span></h2>
        </div>

        <button class="sidebar-close" id="sidebarClose">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav>
            <ul>
                <li><a href="{{ url('/') }}#home">Home</a></li>
                <li><a href="{{ url('/') }}#about">About</a></li>
                <li><a href="{{ url('/') }}#tenants">Tenants</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Directory</a></li>
                <li><a href="{{ url('/') }}#experience">Experience</a></li>
                <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                <li><a href="{{ url('/') }}#contact">Contact</a></li>
            </ul>
        </nav>

        <!-- Search in Sidebar for Mobile -->
        <div class="sidebar-search">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <section class="page-header">
            <h1>Culinary Collection</h1>
            <p>Savor the exquisite flavors of Bali</p>
        </section>

        <!-- Filter Placeholder -->
        <div class="dining-filter">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Fine Dining</button>
            <button class="filter-btn">Casual</button>
            <button class="filter-btn">Cafe</button>
            <button class="filter-btn">Bars</button>
        </div>

        <section class="dining-grid">
            @forelse($tenants as $tenant)
                <div class="dining-card" onclick="window.location.href='javascript:void(0)'">
                    <!-- Placeholder link for now -->
                    <div class="dining-img"
                        style="background-image: url('{{ $tenant->primaryPhoto ? asset('storage/' . $tenant->primaryPhoto->path) : asset('assets/images/placeholder-dining.jpg') }}')">
                    </div>
                    <div class="dining-overlay">
                        <div class="dining-content">
                            <div class="dining-category">{{ $tenant->category->name ?? 'Gastronomy' }}</div>
                            <h3 class="dining-title">{{ $tenant->name }}</h3>
                            <div class="dining-meta">
                                <span>{{ $tenant->map_coords['floor'] == 1 ? '1st Floor' : '2nd Floor' }}</span>
                                <span>&bull;</span>
                                <span>Open 10 AM - 10 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 4rem;">
                    <h3>No Dining Tenants Found</h3>
                    <p>We are currently updating our directory. Please check back soon.</p>
                </div>
            @endforelse
        </section>
    </main>

    <!-- Footer -->
    <footer class="reveal" id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <!-- About Column -->
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>The FIRST Premium Shopping Mall & Life Style Destination in Bali</p>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/malbaligaleria/" class="footer-social-link"
                            aria-label="Instagram">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                                    fill="none" stroke="white" stroke-width="2" />
                                <circle cx="12" cy="12" r="4" fill="none" stroke="white"
                                    stroke-width="2" />
                                <circle cx="18" cy="6" r="1" fill="white" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/p/Mal-Bali-Galeria-100063642820316/?locale=id_ID"
                            class="footer-social-link" aria-label="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="https://x.com/infombg" class="footer-social-link" aria-label="Twitter">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@malbaligaleria" class="footer-social-link"
                            aria-label="TikTok">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}#about">About Us</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Store Directory</a></li>
                        <li><a href="{{ url('/') }}#experience">Experiences</a></li>
                        <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                        <li><a href="{{ url('/') }}#career">Careers</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}#valet">Valet Parking</a></li>
                        <li><a href="{{ url('/') }}#concierge">Concierge</a></li>
                        <li><a href="{{ url('/') }}#gift">Gift Cards</a></li>
                        <li><a href="{{ url('/') }}#member">Membership</a></li>
                        <li><a href="{{ url('/') }}#faq">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <p>Jl. Sunset Road No. 89, Kuta, Badung, Bali 80361</p>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+62361755277">(0361) 755277</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <a href="mailto:info@malbaligaleria.co.id">info@malbaligaleria.co.id</a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <p class="footer-copyright">© 2026 Mal Bali Galeria. All Rights Reserved. | Sites by Yogi Prayoga</p>
                <div class="footer-brand">
                    <span class="footer-brand-logo">Mal Bali Galeria</span>
                    <span class="footer-brand-text">Enjoy, Play, Eat, Shop</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/frontend/js/landing.js') }}"></script>
</body>

</html>
