<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | Mal Bali Galeria</title>
    <meta name="description"
        content="Stay updated with the latest events and happenings at Mal Bali Galeria. From cultural festivals to shopping marathons.">

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
    <meta property="twitter:description"
        content="Stay updated with the latest events and happenings at Mal Bali Galeria.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/event/index.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() }}">
    <style>
        .events-filter-toolbar {
            justify-content: flex-end;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                        onerror="this.style.display='none'">
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
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor"
                stroke-width="2" />
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor"
                stroke-width="2" />
        </svg>
    </button>

    <!-- Header -->
    @include('frontend.partials.announcement_banner')
    <header id="mainHeader">
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;"
                    loading="lazy">
            </a>
        </div>

        <a href="{{ route('frontend.landing') }}" class="logo">
            <img src="{{ asset('assets/images/default/mbg.png') }}" alt="Mal Bali Galeria" class="header-main-logo"
                style="height: 45px; width: auto; object-fit: contain;" loading="lazy">
        </a>

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
                @foreach ($frontendMenus as $menu)
                    <li><a href="{{ url($menu->url) }}">{{ $menu->name }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>

    <main>
        <!-- Hero Banner -->
        <section class="events-hero">
            <div class="events-hero-content">
                <span class="events-hero-eyebrow">Mal Bali Galeria</span>
                <h1 class="events-hero-title">What's Happening</h1>
                <p class="events-hero-subtitle">Experience extraordinary moments at Bali's favorite lifestyle
                    destination. From musical performances to seasonal festivals.</p>
                {{-- #5: Hero stat --}}
                <div class="events-hero-stats">
                    <div class="hero-stat-item">
                        <span class="hero-stat-number">{{ count($events) }}</span>
                        <span class="hero-stat-label">Events</span>
                    </div>
                </div>
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
                <h2>All Events</h2>
                <div class="divider"></div>
                <span class="events-count-badge" id="eventsShownCount">{{ count($events) }} Events</span>
            </div>
            
            {{-- Status/Category filter --}}
            <div class="events-filter-toolbar">
                <div class="events-filter-right">
                    <div style="display: flex; gap: 10px;">
                        <select class="events-sort-select" id="eventsCategory">
                            <option value="all">All Types</option>
                            <option value="regular">Regular Shows</option>
                            <option value="special">Special Events</option>
                        </select>
                        <select class="events-sort-select" id="eventsSort">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name_asc">A–Z</option>
                        </select>
                    </div>
                </div>
            </div>


                <div class="events-grid" id="eventsGrid">
                @foreach ($events as $index => $event)
                    @php
                        $startDate = $event->start_date;
                        $day = $startDate ? date_format(date_create($startDate), 'd') : '—';
                        $monthShort = $startDate ? date_format(date_create($startDate), 'M') : '';
                        $monthValue = $startDate ? date_format(date_create($startDate), 'm') : 'regular';
                        $monthLabel = $startDate ? date_format(date_create($startDate), 'F') : 'Regular';
                        $yearValue = $startDate ? date_format(date_create($startDate), 'Y') : 'regular';
                        $fullDate = $startDate ? date_format(date_create($startDate), 'd M Y') : 'Regular Event';
                        $imgUrl =
                            $event->primaryPhoto && $event->primaryPhoto->path
                                ? asset('storage/' . $event->primaryPhoto->path)
                                : asset('assets/images/no_image.jpg');

                        // Date range logic
                        $startDate = $event->start_date;
                        $endDate = $event->end_date ?? null;

                        if ($event->type === 'regular') {
                            // For regular shows, use label
                            $dateRange = $event->recurring_label ?: 'Regular Event';
                        } else {
                            // For special/other events, use date range
                            $dateRange = $startDate ? date_format(date_create($startDate), 'd M Y') : 'Event';
                            if ($endDate && $endDate !== $startDate) {
                                $endFmt = date_format(date_create($endDate), 'd M Y');
                                $dateRange = date_format(date_create($startDate), 'd M') . ' – ' . $endFmt;
                            }
                        }
                        $fullDate = $dateRange;

                        // Event status — handle nullable date
                        $today = now()->toDateString();
                        $startStr = $event->start_date;
                        $endStr = $endDate ?? $startStr;
                        if (!$startStr) {
                            $statusLabel = 'Regular';
                            $statusClass = 'status-regular';
                        } elseif ($today < $startStr) {
                            $statusLabel = 'Upcoming';
                            $statusClass = 'status-upcoming';
                        } elseif ($today >= $startStr && $today <= $endStr) {
                            $statusLabel = 'Ongoing';
                            $statusClass = 'status-ongoing';
                        } else {
                            $statusLabel = 'Ended';
                            $statusClass = 'status-ended';
                        }

                        // #2 & #11: Dynamic category from event attributes
                        $isPaid = $event->is_paid ?? false;
                        $location = strtolower($event->location ?? '');
                        if (!$isPaid) {
                            $catLabel = 'Free Entry';
                            $catClass = 'cat-free';
                        } elseif (str_contains($location, 'atrium') || str_contains($location, 'lobby')) {
                            $catLabel = 'Atrium Event';
                            $catClass = 'cat-atrium';
                        } else {
                            $catLabel = 'Mall Event';
                            $catClass = 'cat-mall';
                        }

                        // #7: WA share URL
                        $shareUrl = route('frontend.event.detail', $event->uuid);
                        $waText = urlencode(
                            'Jangan lewatkan event seru di Mal Bali Galeria: ' .
                                $event->name .
                                ' 📅 ' .
                                $dateRange .
                                ' 👉 ' .
                                $shareUrl,
                        );
                        $waHref = 'https://wa.me/?text=' . $waText;
                    @endphp
                    <a href="javascript:void(0)"
                        class="event-card-v2 event-modal-trigger {{ $statusLabel === 'Ended' ? 'event-ended' : '' }}"
                        data-event-uuid="{{ $event->uuid }}" data-event-name="{{ e($event->name) }}"
                        data-event-image="{{ $imgUrl }}" data-event-date="{{ $dateRange }}"
                        data-event-time="{{ $event->start_time && $event->end_time ? date('H:i', strtotime($event->start_time)) . ' - ' . date('H:i', strtotime($event->end_time)) : 'All Day' }}"
                        data-event-location="{{ $event->location ?? 'Mal Bali Galeria' }}"
                        data-event-type="{{ ucfirst($event->type) }}"
                        data-event-description="{{ e($event->description) }}"
                        data-event-highlights="{{ e($event->highlights) }}" 
                        data-event-specific-dates="{{ $event->specific_dates ? json_encode($event->specific_dates) : '' }}"
                        data-month="{{ $monthValue }}"
                        data-month-label="{{ $monthLabel }}" data-year="{{ $yearValue }}"
                        data-status="{{ strtolower($statusLabel) }}" data-date="{{ $event->start_date }}"
                        data-name="{{ e($event->name) }}">
                        <div class="event-img-wrapper">
                            <!-- <div class="event-card-logo-badge">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG">
                                <div class="logo-text">
                                    <span class="main">Mal Bali Galeria</span>
                                    <span class="sub">Enjoy, Play, Eat, Shop</span>
                                </div>
                            </div> -->
                            <img src="{{ $imgUrl }}" alt="{{ $event->name }}"
                                loading="{{ $index < 4 ? 'eager' : 'lazy' }}">
                            <div class="event-img-overlay"></div>

                            {{-- Content overlay at bottom --}}
                            <div class="event-card-info">
                                <span class="event-date-pill">{{ $fullDate }}</span>
                                <h3 class="event-title-v2">{{ $event->name }}</h3>
                                <p class="event-month-year-v2">
                                    {{ strtoupper(\Carbon\Carbon::now()->format('F Y')) }}</p>
                                <div class="event-card-footer">
                                    <span class="event-learn-more-btn">LEARN MORE →</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            {{-- New Carousel Nav below cards --}}
            <div class="events-carousel-nav" id="eventsCarouselNav">
                <button class="events-nav-btn prev" id="eventsPrevBtn" aria-label="Previous">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="events-nav-btn next" id="eventsNextBtn" aria-label="Next">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        </div>
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>The Pioneer Shopping Center in Bali.</p>
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
                                <path fill="white"
                                    d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="https://x.com/infombg" class="footer-social-link" aria-label="Twitter">
                            <svg viewBox="0 0 24 24">
                                <path fill="white"
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@malbaligaleria" class="footer-social-link"
                            aria-label="TikTok">
                            <svg viewBox="0 0 24 24">
                                <path fill="white"
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Menu</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('frontend.landing') }}#about">About Us</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Tenant List</a></li>
                        <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                        <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="#f5f5dc">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" fill="#2c5f5d" />
                        </svg>
                        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank"
                            rel="noopener noreferrer">
                            <p>Simpang Dewa Ruci<br>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali, Indonesia 80361</p>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="#f5f5dc">
                            <path
                                d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+62361755277">(0361) 755277</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="#f5f5dc">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" fill="none" stroke="#2c5f5d" stroke-width="1.5" />
                        </svg>
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



    {{-- #10: Scroll to top --}}
    <button class="scroll-to-top" id="scrollToTop" aria-label="Scroll to Top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="19" x2="12" y2="5" />
            <polyline points="5 12 12 5 19 12" />
        </svg>
    </button>
    {{-- ===== EVENT DETAIL MODAL ===== --}}
    <div class="event-detail-modal" id="eventDetailModal">
        <div class="event-modal-overlay" id="eventModalOverlay" onclick="closeEventModal()"></div>
        <div class="event-modal-container">

            <button class="event-modal-close" id="eventModalCloseBtn" aria-label="Close">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <div class="event-modal-content">
                <div class="event-modal-carousel">
                    <div class="carousel-swipe-hint" id="eventModalCarouselSwipeHint">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Swipe to browse
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </div>

                    <div class="carousel-images" id="eventModalCarouselImages">
                        <!-- Dynamic images -->
                    </div>

                    <button class="carousel-nav prev" id="eventModalCarouselPrev">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="carousel-nav next" id="eventModalCarouselNext">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>

                    <div class="carousel-indicators" id="eventModalCarouselIndicators">
                        <!-- Dynamic indicators -->
                    </div>
                </div>

                <div class="event-modal-details" data-lenis-prevent>
                    <div class="event-modal-header">
                        <span class="event-modal-badge" id="eventModalTypeBadge"></span>
                        <h2 id="eventModalTitle"></h2>
                    </div>

                    <div class="event-modal-info">
                        <div class="event-modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <div>
                                <span class="info-label">Date</span>
                                <span class="info-value" id="eventModalDate"></span>
                            </div>
                        </div>

                        <div class="event-modal-info-item" id="specificDatesContainer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <polyline points="9 11 12 14 22 4" />
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                            </svg>
                            <div>
                                <span class="info-label">Dates Highlighted</span>
                                <span class="info-value" id="eventModalSpecificDates"></span>
                            </div>
                        </div>

                        <div class="event-modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <div>
                                <span class="info-label">Time</span>
                                <span class="info-value" id="eventModalTime"></span>
                            </div>
                        </div>

                        <div class="event-modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <div>
                                <span class="info-label">Location</span>
                                <span class="info-value" id="eventModalLocation"></span>
                            </div>
                        </div>

                        <div class="event-modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <div>
                                <span class="info-label">Highlight</span>
                                <span class="info-value" id="eventModalHighlights"></span>
                            </div>
                        </div>

                        <div class="event-modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                                <polyline points="10 9 9 9 8 9" />
                            </svg>
                            <div>
                                <span class="info-label">Description</span>
                                <span class="info-value" id="eventModalDescription"
                                    style="color: var(--gold);"></span>
                            </div>
                        </div>
                    </div>

                    <div class="event-modal-actions">
                        <button class="event-modal-calendar-btn" id="eventModalCalendarBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Add to Calendar
                        </button>
                        <button class="event-modal-share-btn" id="eventModalShareBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                            </svg>
                            Share Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script>
        // Initialize Lenis Smooth Scroll
        window.lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            autoRaf: true
        });

        document.addEventListener('DOMContentLoaded', () => {
        // ===== PAGE LOADER =====
        const pageLoader = document.getElementById("pageLoader");
        let loadStartTime = Date.now();
        window.addEventListener("load", () => {
            let remaining = Math.max(0, 2500 - (Date.now() - loadStartTime));
            setTimeout(() => {
                if (pageLoader) {
                    pageLoader.classList.add("hidden");
                    document.body.classList.add("loaded");
                    setTimeout(() => pageLoader.style.display = "none", 500);
                }
            }, remaining);
        });

        // ===== SIDEBAR / MENU =====
        function initMenu() {
            const menuBtn = document.getElementById("menuBtn");
            const sidebar = document.getElementById("sidebar");
            const sidebarClose = document.getElementById("sidebarClose");

            if (menuBtn && sidebar && sidebarClose) {
                // Remove existing for clean init
                menuBtn.replaceWith(menuBtn.cloneNode(true));
                sidebarClose.replaceWith(sidebarClose.cloneNode(true));

                const newMenuBtn = document.getElementById("menuBtn");
                const newSidebarClose = document.getElementById("sidebarClose");

                newMenuBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    newMenuBtn.classList.toggle("active");
                    sidebar.classList.toggle("active");
                    document.body.classList.toggle("menu-open");
                });

                newSidebarClose.addEventListener("click", () => {
                    newMenuBtn.classList.remove("active");
                    sidebar.classList.remove("active");
                    document.body.classList.remove("menu-open");
                });

                sidebar.querySelectorAll("a").forEach(link => {
                    link.addEventListener("click", () => {
                        newMenuBtn.classList.remove("active");
                        sidebar.classList.remove("active");
                        document.body.classList.remove("menu-open");
                    });
                });
            }
        }

        // Init
        initMenu();

        // Dark mode
        const darkModeToggle = document.getElementById("darkModeToggle");
        if (localStorage.getItem("darkMode") === "enabled") document.body.classList.add("dark-mode");
        darkModeToggle.addEventListener("click", (e) => {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("darkMode", document.body.classList.contains("dark-mode") ? "enabled" : "disabled");
        });

        // Scroll top
        const scrollTopBtn = document.getElementById("scrollToTop");
        window.addEventListener("scroll", () => {
            if (scrollTopBtn) scrollTopBtn.classList.toggle("visible", window.scrollY > 400);
        });

        // Filter engine
        window.activeCategory = 'all';
        window.activeSort = 'newest';

        const catSelect = document.getElementById('eventsCategory');
        if (catSelect) {
            catSelect.addEventListener('change', () => {
                window.activeCategory = catSelect.value;
                applyFilters();
            });
        }

        const sortSelect = document.getElementById('eventsSort');
        if (sortSelect) {
            sortSelect.addEventListener('change', () => {
                window.activeSort = sortSelect.value;
                applyFilters();
            });
        }

        // Initial run
        applyFilters();

        // Check for deep-link parameter on load
        const urlParams = new URLSearchParams(window.location.search);
        const eventUuid = urlParams.get("id") || urlParams.get("uuid");
        if (eventUuid) {
            setTimeout(() => {
                const card = document.querySelector(`.event-modal-trigger[data-event-uuid="${eventUuid}"]`);
                if (card && typeof openEventModal === "function") {
                    openEventModal(card);
                }
            }, 600);
        }

        // ===== CAROUSEL NAVIGATION =====
        const eventsGrid = document.getElementById('eventsGrid');
        const prevBtn = document.getElementById('eventsPrevBtn');
        const nextBtn = document.getElementById('eventsNextBtn');

        if (eventsGrid && prevBtn && nextBtn) {
            const updateNavButtons = () => {
                const isMobile = window.innerWidth <= 768;
                const carouselNav = document.getElementById('eventsCarouselNav');
                
                if (!isMobile) {
                    if (carouselNav) carouselNav.style.display = 'none';
                    return;
                }

                if (carouselNav) carouselNav.style.display = 'flex';

                const scrollLeft = eventsGrid.scrollLeft;
                const maxScroll = eventsGrid.scrollWidth - eventsGrid.clientWidth;
                
                // Use class instead of display:none for better UI
                if (scrollLeft <= 5) {
                    prevBtn.classList.add('disabled');
                } else {
                    prevBtn.classList.remove('disabled');
                }

                if (scrollLeft >= maxScroll - 5) {
                    nextBtn.classList.add('disabled');
                } else {
                    nextBtn.classList.remove('disabled');
                }
                
                // Hide nav entirely if only 1 card or no scroll possible
                if (maxScroll <= 0 && carouselNav) {
                    carouselNav.style.display = 'none';
                }
            };

            eventsGrid.addEventListener('scroll', updateNavButtons);
            window.addEventListener('resize', updateNavButtons);
            
            // Check after a short delay since cards might be revealed via animation
            setTimeout(updateNavButtons, 500);

            prevBtn.addEventListener('click', () => {
                eventsGrid.scrollBy({ left: -eventsGrid.clientWidth, behavior: 'smooth' });
            });

            nextBtn.addEventListener('click', () => {
                eventsGrid.scrollBy({ left: eventsGrid.clientWidth, behavior: 'smooth' });
            });
            
            // Re-check buttons after any filter application
            const originalApplyFilters = window.applyFilters;
            window.applyFilters = function() {
                originalApplyFilters();
                setTimeout(updateNavButtons, 300);
            };
        }


        }); // End DOMContentLoaded

        function applyFilters() {
            const grid = document.getElementById('eventsGrid');
            if (!grid) return;

            const allCards = [...document.querySelectorAll('.event-card-v2')];
            
            // 1. Filter
            let visible = allCards.filter(card => {
                const targetCat = (window.activeCategory || 'all').toLowerCase();
                const cardTypeAttr = (card.dataset.eventType || '').toLowerCase();
                
                let catMatch = targetCat === 'all' || cardTypeAttr.includes(targetCat);
                return catMatch;
            });

            // 2. Sort
            visible.sort((a, b) => {
                const sortVal = window.activeSort || 'newest';
                const dateA = a.dataset.date || '';
                const dateB = b.dataset.date || '';
                const nameA = a.dataset.name || '';
                const nameB = b.dataset.name || '';
                
                if (sortVal === 'newest') return dateB.localeCompare(dateA);
                if (sortVal === 'oldest') return dateA.localeCompare(dateB);
                if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
                return 0;
            });

            // 3. Update DOM Order & Visibility
            allCards.forEach(c => {
                c.style.display = 'none';
                c.classList.remove('event-reveal');
            });

            visible.forEach((card, i) => {
                // Re-append moves the element to the end of the container in the new order
                grid.appendChild(card); 
                card.style.display = '';
                card.style.animationDelay = (i * 0.05) + 's';
                
                // Small timeout to trigger animation
                setTimeout(() => {
                    card.classList.add('event-reveal');
                }, 10);
            });

            // 4. Update count
            const countEl = document.getElementById('eventsShownCount');
            if (countEl) countEl.textContent = `${visible.length} Events`;
        }
    </script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}?v={{ time() }}"></script>
    <script>
        // Event Modal Share - Defined after landing_v2.js to ensure dependencies exist
        document.addEventListener('DOMContentLoaded', () => {
            const eventShareBtn = document.getElementById('eventModalShareBtn');
            if (eventShareBtn) {
                eventShareBtn.addEventListener('click', () => {
                    // Use the global currentEventUuid from landing_v2.js
                    if (typeof window.currentEventUuid !== 'undefined' && window.currentEventUuid) {
                        const shareUrl = `${window.location.origin}${window.location.pathname}?id=${window.currentEventUuid}`;
                        const eventTitle = document.getElementById('eventModalTitle')?.textContent || 'Event at Mal Bali Galeria';
                        
                        if (typeof openShareMenu === 'function') {
                            openShareMenu({
                                name: eventTitle,
                                url: shareUrl,
                                type: 'Event'
                            });
                        } else {
                            copyToClipboard(shareUrl);
                        }
                    }
                });
            }

            // Consistency: Re-attach share menu handlers if landing_v2.js missed them due to timing
            const copyBtn = document.getElementById('shareCopyLink');
            const waBtn = document.getElementById('shareWhatsApp');
            const fbBtn = document.getElementById('shareFacebook');
            const twBtn = document.getElementById('shareTwitter');

            if (copyBtn) copyBtn.onclick = () => shareContent('copy');
            if (waBtn) waBtn.onclick = () => shareContent('whatsapp');
            if (fbBtn) fbBtn.onclick = () => shareContent('facebook');
            if (twBtn) twBtn.onclick = () => shareContent('twitter');
        });
    </script>
    {{-- Sticky Mobile CTA Bar --}}
    <div class="dir-mobile-sticky-cta" id="eventMobileStickyBar">
        <a href="{{ route('frontend.landing') }}" class="dir-mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            <span>Home</span>
        </a>
        <a href="{{ route('frontend.promotion.index') }}" class="dir-mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
            </svg>
            <span>Promo</span>
        </a>
        <a href="tel:+62361755277" class="dir-mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Call</span>
        </a>
    </div>

    {{-- SHARE MENU MODAL (CONSISTENT WITH DIRECTORY) --}}
    <div class="share-menu" id="shareMenu">
        <div class="share-menu-overlay" onclick="document.getElementById('shareMenu').classList.remove('active')">
        </div>
        <div class="share-menu-container">
            <div class="share-menu-header">
                <h4 id="shareMenuTitle">Share Content</h4>
                <button class="share-menu-close"
                    onclick="document.getElementById('shareMenu').classList.remove('active')">×</button>
            </div>
            <div class="share-menu-body">
                <button class="share-option" id="shareCopyLink">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                        <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                    </svg>
                    <span>Copy Link</span>
                </button>
                <button class="share-option" id="shareWhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    <span>WhatsApp</span>
                </button>
                <button class="share-option" id="shareFacebook">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    <span>Facebook</span>
                </button>
                <button class="share-option" id="shareTwitter">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                    </svg>
                    <span>Twitter</span>
                </button>
            </div>
        </div>
    </div>

</body>

</html>
