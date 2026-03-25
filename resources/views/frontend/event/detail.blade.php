<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event['name'] }} - Event Details | Mal Bali Galeria</title>
    <meta name="description" content="{{ Str::limit(strip_tags($event['description']), 160) }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $event['name'] }} | Mal Bali Galeria">
    <meta property="og:description" content="{{ Str::limit(strip_tags($event['description']), 160) }}">
    <meta property="og:image"
        content="{{ $event['primaryPhoto'] ? asset('storage/' . $event['primaryPhoto']) : asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $event['name'] }} | Mal Bali Galeria">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($event['description']), 160) }}">
    <meta property="twitter:image"
        content="{{ $event['primaryPhoto'] ? asset('storage/' . $event['primaryPhoto']) : asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}?v={{ time() + 50 }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/event/detail.css') }}?v={{ time() + 50 }}">
</head>

<body>

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
            <p class="loader-text">LOADING...</p>
        </div>
    </div>


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


    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;"
                    loading="lazy">
            </a>
        </div>

        <div class="logo">
            <img src="{{ asset('assets/images/default/mbg.png') }}" alt="Mal Bali Galeria" class="header-main-logo"
                style="height: 45px; width: auto; object-fit: contain;">
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>


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
                <li><a href="{{ route('frontend.landing') }}/#about">About</a></li>

                <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>

                <li><a href="{{ route('frontend.landing') }}#events">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
            </ul>
        </nav>


        <div class="sidebar-search">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="sidebarSearch">
            </div>
        </div>
    </div>

    <main>

        {{-- Event Hero Banner (no image, styled) --}}
        <div class="event-hero-banner">
            <div class="event-hero-content">
                <span class="event-hero-eyebrow">Mal Bali Galeria</span>
                <h1 class="event-hero-title">{{ $event['name'] }}</h1>
                <p class="event-hero-subtitle">{{ $event['start_date'] }} – {{ $event['end_date'] }}</p>
                <a href="{{ route('frontend.event.index') }}" class="event-hero-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Go to Events
                </a>
            </div>
        </div>


        <section class="event-detail-glass-section">
            <div class="event-glass-container">

                <!-- Main Floating Card -->
                <div class="event-glass-card">
                    <!-- Left Sidebar (Meta & Actions) -->
                    <div class="glass-sidebar">

                        {{-- Mini Image Carousel --}}
                        <div class="glass-photo-carousel" id="glassPhotoCarousel">
                            @php
                                $photos = $event['photos'] ?? [];
                            @endphp
                            @if (count($photos) > 0)
                                <div class="glass-photo-track" id="glassPhotoTrack">
                                    @foreach ($photos as $i => $photo)
                                        <div class="glass-photo-slide {{ $i == 0 ? 'active' : '' }}">
                                            <img src="{{ $photo }}" alt="Event Photo {{ $i + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($photos) > 1)
                                    <button class="gpc-arrow gpc-prev" id="gpcPrev">‹</button>
                                    <button class="gpc-arrow gpc-next" id="gpcNext">›</button>
                                    <div class="gpc-dots" id="gpcDots">
                                        @foreach ($photos as $i => $photo)
                                            <span class="gpc-dot {{ $i == 0 ? 'active' : '' }}"
                                                data-index="{{ $i }}"></span>
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="glass-photo-slide active">
                                    <img src="{{ asset('assets/images/no_image.jpg') }}" alt="No Image">
                                </div>
                            @endif
                        </div>

                        <div class="glass-meta-group">
                            <div class="glass-meta">
                                <h4>Date & Time</h4>
                                <div class="meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    <span>{{ $event['start_date'] }} - {{ $event['end_date'] }}</span>
                                </div>
                                <div class="meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>{{ $event['start_time'] }} - {{ $event['end_time'] }}</span>
                                </div>
                            </div>

                            <div class="glass-meta">
                                <h4>Location</h4>
                                <div class="meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>{{ $event['location'] ?? 'Information Desk' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="glass-actions">
                            <a href="#" class="glass-btn btn-primary" id="addToCalendarBtn"
                                data-event-name="{{ $event['name'] }}"
                                data-event-description="{!! strip_tags($event['description']) !!}"
                                data-event-location="{{ $event['location'] ?? 'Mal Bali Galeria' }}"
                                data-event-start="{{ $event['start_date'] }} {{ $event['start_time'] }}"
                                data-event-end="{{ $event['end_date'] }} {{ $event['end_time'] }}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Add to Calendar
                            </a>
                            <a href="#" class="glass-btn btn-secondary" id="shareEventBtn"
                                data-event-name="{{ $event['name'] }}" data-event-url="{{ url()->current() }}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                    <polyline points="16 6 12 2 8 6" />
                                    <line x1="12" y1="2" x2="12" y2="15" />
                                </svg>
                                Share Event
                            </a>
                        </div>
                    </div>

                    <!-- Right Main Content -->
                    <div class="glass-content">
                        <div class="glass-header">
                            @if ($event['is_exhibition'])
                                <span class="glass-badge glass-badge-exhibition">Exhibition</span>
                            @elseif($event['is_regular'])
                                <span class="glass-badge glass-badge-regular">Regular Show</span>
                            @else
                                <span class="glass-badge">Special Event</span>
                            @endif
                        </div>

                        <div class="glass-description">
                            {!! nl2br(e($event['description'])) !!}
                        </div>

                        <div class="glass-info-grid">
                            <!-- <div class="info-cell">
                                <label>Entrance Fee</label>
                                <p>{{ $event['is_paid'] ? 'Rp ' . number_format($event['price'], 0, ',', '.') : 'Free Admission' }}</p>
                            </div> -->
                            <div class="info-cell">
                                <label>Organizer</label>
                                <p>{{ $event['organizer'] ?? 'Mal Bali Galeria' }}</p>
                            </div>
                            <!-- <div class="info-cell">
                                <label>Target Audience</label>
                                <p>{{ $event['target_audience'] ?? 'General' }}</p>
                            </div> -->
                            <div class="info-cell">
                                <label>Highlights</label>
                                <p>{{ $event['highlights'] ?? 'Exclusive Shows' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Similar Upcoming Events — same card design as landing Upcoming Events --}}
                <div class="similar-section glass-similar">
                    <div class="similar-header">
                        <h3>Upcoming Events <span class="event-count">({{ count($upcomingEvents) }})</span></h3>
                    </div>

                    @if (count($upcomingEvents) > 0)
                        <div class="event-slider-wrapper">
                            <div class="event-grid" id="similarEventGrid">
                                @foreach ($upcomingEvents as $upcoming)
                                    @php
                                        $startDate = $upcoming->start_date;
                                        $fullDate = $startDate
                                            ? date_format(date_create($startDate), 'd M Y')
                                            : 'Regular Event';
                                        $imgUrl =
                                            $upcoming->primaryPhoto && $upcoming->primaryPhoto->path
                                                ? asset('storage/' . $upcoming->primaryPhoto->path)
                                                : asset('assets/images/no_image.jpg');

                                        // Status calculation
                                        $today = now()->toDateString();
                                        $endDate = $upcoming->end_date ?? $startDate;
                                        if (!$startDate) {
                                            $statusLabel = 'Regular';
                                            $statusClass = 'status-regular';
                                        } elseif ($today < $startDate) {
                                            $statusLabel = 'Upcoming';
                                            $statusClass = 'status-upcoming';
                                        } elseif ($today >= $startDate && $today <= $endDate) {
                                            $statusLabel = 'Ongoing';
                                            $statusClass = 'status-ongoing';
                                        } else {
                                            $statusLabel = 'Ended';
                                            $statusClass = 'status-ended';
                                        }
                                    @endphp
                                    <a href="{{ route('frontend.event.detail', $upcoming->uuid) }}"
                                        class="event-card event-card-v2" style="text-decoration:none;">
                                        <div class="event-img-wrapper">
                                            <img src="{{ $imgUrl }}" alt="{{ $upcoming->name }}">
                                            <div class="event-img-overlay"></div>
                                            @if ($statusLabel !== 'Ended')
                                                <span
                                                    class="event-status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                            @endif

                                            <div class="event-card-info">
                                                <span class="event-date-pill">{{ $fullDate }}</span>
                                                <h3 class="event-title-v2">{{ $upcoming->name }}</h3>
                                                @if ($upcoming->description)
                                                    <p class="event-desc-v2">
                                                        {{ Str::limit($upcoming->description, 80) }}</p>
                                                @endif
                                                @if ($upcoming->location)
                                                    <span class="event-location-v2">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2"
                                                            style="width:13px;height:13px;flex-shrink:0;">
                                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                                            <circle cx="12" cy="10" r="3" />
                                                        </svg>
                                                        {{ $upcoming->location }}
                                                    </span>
                                                @endif
                                                <span class="event-learn-more-btn">Learn More →</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="event-controls" id="similarEventControls">
                            <button class="event-nav-btn" id="similarEventPrevBtn" aria-label="Previous">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="3" fill="none">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>
                            <button class="event-nav-btn" id="similarEventNextBtn" aria-label="Next">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="3" fill="none">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>
                        </div>
                    @else
                        <div
                            style="padding: 40px; text-align: center; border-radius: 20px; background: rgba(0,0,0,0.03);">
                            <div style="font-size: 40px;">🎪</div>
                            <h3
                                style="margin: 10px 0; font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--primary-color);">
                                No other events</h3>
                            <p style="color: #666; font-size: 0.95rem;">Check back later for more exciting events!</p>
                        </div>
                    @endif
                </div>

            </div>
        </section>
    </main>


    <footer class="reveal" id="contact">
        <div class="footer-container">
            <div class="footer-content">

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


                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('frontend.landing') }}#about">About Us</a></li>


                        <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                        <li><a href="{{ route('frontend.landing') }}#events">Events</a></li>
                        <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                        <li><a href="#contact">Contact</a></li>

                    </ul>
                </div>




                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer"
                            style="text-decoration: none">
                            <p>Simpang Dewa Ruci<br>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali, Indonesia 80361</p>
                        </a>
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

    {{-- Sticky Mobile CTA --}}
    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="{{ route('frontend.landing') }}" class="mobile-cta-btn-ev">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            <span>Home</span>
        </a>
        <a href="{{ route('frontend.event.index') }}" class="mobile-cta-btn-ev">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            <span>Events</span>
        </a>
        <a href="tel:+62361755277" class="mobile-cta-btn-ev">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Call</span>
        </a>
    </div>

    <script src="{{ asset('assets/frontend/js/event/detail.js') }}"></script>
</body>

</html>
