<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | Mal Bali Galeria</title>
    <meta name="description" content="Stay updated with the latest events and happenings at Mal Bali Galeria. From cultural festivals to shopping marathons.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Events | Mal Bali Galeria">
    <meta property="og:description" content="Stay updated with the latest events and happenings at Mal Bali Galeria.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Events | Mal Bali Galeria">
    <meta property="twitter:description" content="Stay updated with the latest events and happenings at Mal Bali Galeria.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/event/index.css') }}?v={{ time() }}">
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image" onerror="this.style.display='none'">
                </div>
            </div>
            <div class="loader-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
            <div class="loader-progress">
                <div class="progress-bar"></div>
            </div>
            <p class="loader-text">LOADING EVENTS...</p>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
        <svg class="moon-icon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" /></svg>
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
    <header id="mainHeader">
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;" loading="lazy">
            </a>
        </div>

        <div class="logo">
            <img src="{{ asset('assets/images/default/mbg.png') }}"
                 alt="Mal Bali Galeria"
                 class="header-main-logo"
                 style="height: 45px; width: auto; object-fit: contain;"
                 loading="lazy">
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>Mal Bali Galeria<span>Enjoy, Play, Eat, Shop</span></h2>
        </div>
        <button class="sidebar-close" id="sidebarClose">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav>
            <ul>
                <li><a href="{{ route('frontend.landing') }}">Home</a></li>
                <li><a href="{{ route('frontend.landing') }}#about">About</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
            </ul>
        </nav>
    </div>

    <main>
        <!-- Hero Banner -->
        <section class="events-hero">
            <div class="events-hero-content">
                <span class="events-hero-eyebrow">Mal Bali Galeria</span>
                <h1 class="events-hero-title">What's Happening</h1>
                <p class="events-hero-subtitle">Experience extraordinary moments at Bali's favorite lifestyle destination. From musical performances to seasonal festivals.</p>
                <a href="{{ route('frontend.landing') }}" class="events-hero-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </section>

        <!-- Events Grid -->
        <div class="events-main">
            <div class="events-section-label">
                <h2>Upcoming Events</h2>
                <div class="divider"></div>
                <span class="events-count-badge">{{ count($events) }} Events</span>
            </div>

            <div class="events-grid" id="eventsGrid">
                @forelse ($events as $index => $event)
                    @php
                        $day   = date_format(date_create($event->start_date), 'd');
                        $month = date_format(date_create($event->start_date), 'M');
                        $fullDate = date_format(date_create($event->start_date), 'd M Y');
                        $imgUrl = $event->primaryPhoto && $event->primaryPhoto->path
                            ? asset('storage/' . $event->primaryPhoto->path)
                            : asset('assets/images/no_image.jpg');
                    @endphp
                    <a href="{{ route('frontend.event.detail', $event->uuid) }}"
                       class="event-card-v2 {{ $index >= 8 ? 'event-hidden' : '' }}">
                        <div class="event-img-wrapper">
                            <img src="{{ $imgUrl }}" alt="{{ $event->name }}" loading="{{ $index < 4 ? 'eager' : 'lazy' }}">
                            <div class="event-img-overlay"></div>
                            <div class="event-date-badge">
                                <span class="day">{{ $day }}</span>
                                <span class="month">{{ $month }}</span>
                            </div>
                        </div>
                        <div class="event-card-info">
                            <span class="event-category-tag">Mall Event</span>
                            <h3 class="event-title-v2">{{ $event->name }}</h3>
                            <span class="event-date-v2">{{ $fullDate }}</span>
                            <div class="see-details-link">
                                See Details
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="no-events">
                        <h3>No upcoming events at the moment.</h3>
                        <p>Stay tuned for updates!</p>
                    </div>
                @endforelse
            </div>

            @if(count($events) > 8)
                <div class="load-more-container">
                    <button id="loadMoreBtn" class="btn-load-more">Load More Events</button>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>The FIRST Premium Shopping Mall & Life Style Destination in Bali</p>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/malbaligaleria/" class="footer-social-link" aria-label="Instagram">
                            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="white" stroke-width="2" /><circle cx="12" cy="12" r="4" fill="none" stroke="white" stroke-width="2" /><circle cx="18" cy="6" r="1" fill="white" /></svg>
                        </a>
                        <a href="https://www.facebook.com/p/Mal-Bali-Galeria-100063642820316/?locale=id_ID" class="footer-social-link" aria-label="Facebook">
                            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" /></svg>
                        </a>
                        <a href="https://x.com/infombg" class="footer-social-link" aria-label="Twitter">
                            <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" /></svg>
                        </a>
                        <a href="https://www.tiktok.com/@malbaligaleria" class="footer-social-link" aria-label="TikTok">
                            <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" /></svg>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('frontend.landing') }}#about">About Us</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                        <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                        <li><a href="{{ route('frontend.promotion.index') }}">Promotions</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" /></svg>
                        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer">
                            <p>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali 80361</p>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24"><path d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        <a href="tel:+62361755277">(0361) 755277</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg>
                        <a href="mailto:info@malbaligaleria.com">info@malbaligaleria.com</a>
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

    <!-- Sticky Mobile CTA -->
    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="{{ route('frontend.landing') }}" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            <span>Home</span>
        </a>
        <a href="{{ route('frontend.promotion.index') }}" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
            </svg>
            <span>Promo</span>
        </a>
        <a href="tel:+62361755277" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Hubungi</span>
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Page Loader
        const pageLoader = document.getElementById("pageLoader");
        let loadStartTime = Date.now();
        window.addEventListener("load", () => {
            let remaining = Math.max(0, 2500 - (Date.now() - loadStartTime));
            setTimeout(() => {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");
                setTimeout(() => pageLoader.style.display = "none", 500);
            }, remaining);
        });
        setTimeout(() => {
            if (!document.body.classList.contains("loaded")) {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");
                setTimeout(() => pageLoader.style.display = "none", 500);
            }
        }, 5000);

        // Header scroll
        const header = document.getElementById("mainHeader");
        window.addEventListener("scroll", () => {
            header.classList.toggle("scrolled", window.pageYOffset > 80);
        });

        // Sidebar
        const menuBtn = document.getElementById("menuBtn");
        const sidebar = document.getElementById("sidebar");
        const sidebarClose = document.getElementById("sidebarClose");
        menuBtn.addEventListener("click", () => {
            menuBtn.classList.toggle("active");
            sidebar.classList.toggle("active");
            document.body.classList.toggle("menu-open");
        });
        sidebarClose.addEventListener("click", () => {
            menuBtn.classList.remove("active");
            sidebar.classList.remove("active");
            document.body.classList.remove("menu-open");
        });
        sidebar.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                menuBtn.classList.remove("active");
                sidebar.classList.remove("active");
                document.body.classList.remove("menu-open");
            });
        });

        // Dark mode
        const darkModeToggle = document.getElementById("darkModeToggle");
        if (localStorage.getItem("darkMode") === "enabled") document.body.classList.add("dark-mode");
        darkModeToggle.addEventListener("click", (e) => {
            e.preventDefault(); e.stopPropagation();
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("darkMode", document.body.classList.contains("dark-mode") ? "enabled" : "disabled");
        });

        // Load More
        $(document).ready(function() {
            $('#loadMoreBtn').on('click', function() {
                const hidden = $('.event-card-v2.event-hidden');
                hidden.slice(0, 8).removeClass('event-hidden').hide().fadeIn(600);
                if ($('.event-card-v2.event-hidden').length === 0) {
                    $('.load-more-container').fadeOut();
                }
            });
        });
    </script>
</body>

</html>
