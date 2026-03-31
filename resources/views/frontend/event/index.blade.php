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
        .event-status-pills {
            display: none !important;
        }

        .events-filter-toolbar {
            justify-content: flex-end;
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
                {{-- <li><a href="{{ route('frontend.landing') }}">Home</a></li>
                <li><a href="{{ route('frontend.landing') }}#about">About</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenant List</a></li>
                <li><a href="{{ route('frontend.event.index') }}">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li> --}}
                <li><a href="{{ route('frontend.landing') }}">Home</a></li>
                <li><a href="{{ route('frontend.landing') }}/#about">About</a></li>

                <li><a href="{{ route('frontend.landing') }}#regular-shows">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.new-store.index') }}">New Store</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenant List</a></li>

                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
                @role(['admin', 'superuser'])
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endrole
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
                <h2>What's Happening</h2>
                <div class="divider"></div>
                <span class="events-count-badge" id="eventsShownCount">{{ count($events) }} Events</span>
            </div>

            {{-- #1 & #8: Filter toolbar + month pills --}}
            <div class="events-filter-toolbar">
                <div class="events-filter-left">
                    {{-- Status filter --}}
                    <div class="event-status-pills">
                        <button class="event-status-pill active" data-status="all">All</button>
                        <button class="event-status-pill" data-status="upcoming">Upcoming</button>
                        <button class="event-status-pill" data-status="ongoing">Ongoing</button>
                    </div>
                </div>
                <div class="events-filter-right">
                        {{-- Category filter --}}
                        <select class="events-sort-select" id="eventsCategory">
                            <option value="all">All Types</option>
                            <option value="regular">Regular Shows</option>
                            <option value="special">Special Events</option>
                        </select>
                        {{-- Month filter --}}
                        <select class="events-sort-select" id="eventsMonth">
                            <option value="all">All Months</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        {{-- Year filter --}}
                        <select class="events-sort-select" id="eventsYear">
                            <option value="all">All Years</option>
                        </select>
                        {{-- Sort --}}
                        <select class="events-sort-select" id="eventsSort">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name_asc">A–Z</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="events-grid" id="eventsGrid">
                @foreach ($events->whereIn('type', ['regular', 'special']) as $index => $event)
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
                        class="event-card-v2 event-modal-trigger {{ $index >= 8 ? 'event-hidden' : '' }} {{ $statusLabel === 'Ended' ? 'event-ended' : '' }}"
                        data-event-uuid="{{ $event->uuid }}" data-event-name="{{ e($event->name) }}"
                        data-event-image="{{ $imgUrl }}" data-event-date="{{ $dateRange }}"
                        data-event-time="{{ $event->start_time && $event->end_time ? date('H:i', strtotime($event->start_time)) . ' - ' . date('H:i', strtotime($event->end_time)) : 'All Day' }}"
                        data-event-location="{{ $event->location ?? 'Mal Bali Galeria' }}"
                        data-event-type="{{ ucfirst($event->type) }}"
                        data-event-description="{{ e($event->description) }}"
                        data-event-highlights="{{ e($event->highlights) }}" data-month="{{ $monthValue }}"
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
                                    {{ strtoupper(date('F Y', strtotime($event->start_date ?? now()))) }}</p>
                                <div class="event-card-footer">
                                    <span class="event-learn-more-btn">LEARN MORE →</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- JS Empty State Filter (Di luar events-grid) --}}
            <div class="no-events-improved" id="noEventsState"
                style="display: {{ count($events) == 0 ? 'flex' : 'none' }}; margin: 60px auto; max-width: 600px; padding: 40px;">
                <div class="no-events-emoji">🎪</div>
                <h3>No Events Found</h3>
                <p>Please adjust your month, year, or sort filters to find what you're looking for.</p>
                <button type="button" class="no-events-cta" style="border:none; cursor:pointer;"
                    onclick="document.getElementById('eventsMonth').value='all'; document.getElementById('eventsYear').value='all'; document.querySelector('.event-status-pill[data-status=&quot;all&quot;]').click();">Show
                    All Events</button>
            </div>

            @if (count($events) > 8)
                <div class="load-more-container">
                    <button id="loadMoreBtn" class="btn-load-more">Load More Events</button>
                    <p class="load-more-hint" id="loadMoreHint"></p>
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
                    <h3>Quick Links</h3>
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
                        <button class="event-modal-share-btn" style="display: none" id="eventModalShareBtn">
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

        // Run menu init
        initMenu();
        document.addEventListener('DOMContentLoaded', initMenu);

        // ===== DARK MODE =====
        const darkModeToggle = document.getElementById("darkModeToggle");
        if (localStorage.getItem("darkMode") === "enabled") document.body.classList.add("dark-mode");
        darkModeToggle.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("darkMode", document.body.classList.contains("dark-mode") ? "enabled" :
                "disabled");
        });

        // ===== #10: SCROLL TO TOP =====
        const scrollTopBtn = document.getElementById("scrollToTop");
        window.addEventListener("scroll", () => {
            const stBtn = document.getElementById("scrollToTop");
            if (stBtn) {
                stBtn.classList.toggle("visible", window.scrollY > 400);
            }
        });
        if (scrollTopBtn) {
            scrollTopBtn.addEventListener("click", () => window.scrollTo({
                top: 0,
                behavior: "smooth"
            }));
        }

        // ===== #1 & #8: FILTER / SORT ENGINE =====
        let activeStatus = 'all';
        let activeMonth = 'all';
        let activeYear = 'all';
        let activeCategory = 'all';
        let activeSort = 'newest';

        // Collect all event cards (including hidden initially)
        const allCards = [...document.querySelectorAll('.event-card-v2')];

        // Build month & year dropdown from unique data
        const yearMap = new Map();
        allCards.forEach(card => {
            const y = card.dataset.year;
            if (y && y !== 'regular' && !yearMap.has(y)) yearMap.set(y, y);
        });

        const monthSelectEl = document.getElementById('eventsMonth');
        if (monthSelectEl) {
            monthSelectEl.addEventListener('change', () => {
                activeMonth = monthSelectEl.value;
                applyFilters();
            });
        }

        const yearSelectEl = document.getElementById('eventsYear');
        if (yearSelectEl && yearMap.size > 0) {
            const sortedYears = Array.from(yearMap.entries()).sort((a, b) => b[0].localeCompare(a[0]));
            sortedYears.forEach(([key, label]) => {
                const opt = document.createElement('option');
                opt.value = key;
                opt.textContent = label;
                yearSelectEl.appendChild(opt);
            });
            yearSelectEl.addEventListener('change', () => {
                activeYear = yearSelectEl.value;
                applyFilters();
            });
        } else if (yearSelectEl) {
            yearSelectEl.style.display = 'none';
        }

        // Status pill clicks
        document.querySelectorAll('.event-status-pill').forEach(pill => {
            pill.addEventListener('click', () => {
                activeStatus = pill.dataset.status;
                document.querySelectorAll('.event-status-pill').forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                applyFilters();
            });
        });

        // Sort change
        const sortSelect = document.getElementById('eventsSort');
        if (sortSelect) {
            sortSelect.addEventListener('change', () => {
                activeSort = sortSelect.value;
                applyFilters();
            });
        }

        const catSelect = document.getElementById('eventsCategory');
        if (catSelect) {
            catSelect.addEventListener('change', () => {
                activeCategory = catSelect.value;
                applyFilters();
            });
        }

        function applyFilters() {
            const grid = document.getElementById('eventsGrid');
            const allCards = [...document.querySelectorAll('.event-card-v2')];
            let visible = allCards.filter(card => {
                const statusMatch = activeStatus === 'all' || card.dataset.status === activeStatus;
                const monthMatch = activeMonth === 'all' || card.dataset.month === activeMonth;
                const yearMatch = activeYear === 'all' || card.dataset.year === activeYear;
                const targetCat = activeCategory.toLowerCase();
                const cardCat = (card.dataset.eventType || '').toLowerCase();
                const catMatch = activeCategory === 'all' || cardCat === targetCat;
                return statusMatch && monthMatch && yearMatch && catMatch;
            });

            // Sort
            visible.sort((a, b) => {
                const dateA = a.dataset.date || '';
                const dateB = b.dataset.date || '';
                const nameA = a.dataset.name || '';
                const nameB = b.dataset.name || '';
                if (activeSort === 'newest') return dateB.localeCompare(dateA);
                if (activeSort === 'oldest') return dateA.localeCompare(dateB);
                if (activeSort === 'name_asc') return nameA.localeCompare(nameB);
                return 0;
            });

            // Hide all first
            allCards.forEach(c => {
                c.style.display = 'none';
                c.classList.remove('event-reveal');
            });

            // Show filtered with animation (#6)
            visible.forEach((card, i) => {
                card.style.display = '';
                card.style.animationDelay = (i * 0.06) + 's';
                card.classList.add('event-reveal');
            });

            // Update counter
            const countEl = document.getElementById('eventsShownCount');
            if (countEl) countEl.textContent = `${visible.length} Event${visible.length !== 1 ? 's' : ''}`;

            // Show empty state if needed
            const emptyState = document.getElementById('noEventsState');
            if (emptyState) {
                emptyState.style.display = visible.length === 0 ? 'flex' : 'none';
            }

            // Hide load more when filtering (show all filtered results)
            const lmContainer = document.querySelector('.load-more-container');
            if (lmContainer) lmContainer.style.display = (visible.length === 0 || activeStatus !== 'all' || activeMonth !==
                'all' || activeYear !== 'all') ? 'none' : '';
        }

        // ===== #6: LOAD MORE with animation =====
        $(document).ready(function() {
            $('#loadMoreBtn').on('click', function() {
                const hidden = $('.event-card-v2.event-hidden:not([style*="display: none"])');
                const toShow = hidden.slice(0, 8);
                toShow.each(function(i) {
                    const card = $(this);
                    setTimeout(() => {
                        card.removeClass('event-hidden')
                            .css({
                                opacity: 0,
                                transform: 'translateY(20px)'
                            })
                            .animate({
                                opacity: 1
                            }, 300);
                        card[0].style.transform = 'translateY(0)';
                        card[0].style.transition = 'transform 0.4s ease';
                    }, i * 80);
                });
                const remaining = hidden.length - toShow.length;
                const hintEl = document.getElementById('loadMoreHint');
                if (hintEl) hintEl.textContent = remaining > 0 ? `${remaining} events more to load` : '';
                if ($('.event-card-v2.event-hidden').length === 0) {
                    $('.load-more-container').fadeOut();
                }
            });
        });
    </script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}?v={{ time() }}"></script>
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
</body>

</html>
