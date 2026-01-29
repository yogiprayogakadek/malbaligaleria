<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event['name'] }} - Event Details | Mal Bali Galeria</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}?v={{ time() + 50 }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/event/detail.css') }}?v={{ time() + 50 }}">
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
                {{-- <h1>Mal Bali Galeria</h1>
                <span>Enjoy, Play, Eat, Shop</span> --}}
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
            <h1>Mal Bali Galeria<span>Enjoy, Play, Eat, Shop</span></h1>
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
                {{-- <li><a href="#tenants">Tenants</a></li> --}}
                <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                {{-- <li><a href="#experience">Experience</a></li> --}}
                <li><a href="{{ route('frontend.landing') }}#events">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
            </ul>
        </nav>

        <!-- Search in Sidebar for Mobile -->
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
        <!-- Hero Carousel -->
        <section class="carousel-section">
            <div class="carousel-images" id="carouselImages">
                @if (isset($event['photos']) && count($event['photos']) > 0)
                    @foreach ($event['photos'] as $photo)
                        <div class="carousel-image" style="background-image: url({{ $photo }});"></div>
                    @endforeach
                @else
                    <div class="carousel-image" style="background-image: url({{ $event['primaryPhoto'] ?: asset('assets/images/no_image.jpg') }});"></div>
                @endif
            </div>

            @if (isset($event['photos']) && count($event['photos']) > 1)
                <button class="carousel-arrow prev" id="carouselPrev">‹</button>
                <button class="carousel-arrow next" id="carouselNext">›</button>

                <div class="carousel-controls">
                    @foreach ($event['photos'] as $index => $photo)
                        <div class="carousel-dot {{ $index == 0 ? 'active' : '' }}"
                            data-index="{{ $index }}"></div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Details -->
        <section class="detail-section">
            <div class="detail-container">
                <div class="detail-left">
                    <div class="tenant-logo-wrapper">
                        <!-- Square Event Poster/Thumbnail -->
                        <div class="tenant-logo">
                            <img src="{{ $event['primaryPhoto'] ?: asset('assets/images/no_image.jpg') }}" alt="Event Thumbnail">
                        </div>

                        <div class="tenant-location">
                            <h4>Date & Time</h4>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                <span>{{ $event['start_date'] }} - {{ $event['end_date'] }}</span>
                            </div>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                <span>{{ $event['start_time'] }} - {{ $event['end_time'] }}</span>
                            </div>
                        </div>

                        <div class="tenant-location">
                            <h4>Location</h4>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>{{ $event['location'] ?? 'Information Desk' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="tenant-info">
                        <div class="tenant-header-group">
                            <h1>{{ $event['name'] }}</h1>
                            <span class="tenant-category">Event</span>
                        </div>

                        <div class="tenant-description">
                            {!! nl2br(e($event['description'])) !!}
                        </div>

                        <div class="tenant-details-grid">
                            <div class="detail-item">
                                <label>Entrance Fee</label>
                                <p>{{ $event['is_paid'] ? 'Rp ' . number_format($event['price'], 0, ',', '.') : 'Free Admission' }}</p>
                            </div>
                            <div class="detail-item">
                                <label>Organizer</label>
                                <p>{{ $event['organizer'] ?? 'Mal Bali Galeria' }}</p>
                            </div>
                            <div class="detail-item">
                                <label>Target Audience</label>
                                <p>{{ $event['target_audience'] ?? 'General' }}</p>
                            </div>
                            <div class="detail-item">
                                <label>Highlights</label>
                                <p>{{ $event['highlights'] ?? 'Special Event' }}</p>
                            </div>
                        </div>

                        <div class="tenant-actions">
                            <a href="#" class="action-btn primary" id="addToCalendarBtn"
                                data-event-name="{{ $event['name'] }}"
                                data-event-description="{{ strip_tags($event['description']) }}"
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
                            <a href="#" class="action-btn secondary" id="shareEventBtn"
                                data-event-name="{{ $event['name'] }}"
                                data-event-url="{{ url()->current() }}">
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
                </div>

                <div class="similar-section">
                    <div class="similar-header">
                        <h3>Upcoming Events <span class="event-count">({{ count($upcomingEvents) }})</span></h3>
                    </div>
                    <div class="similar-carousel-wrapper">
                        <button class="similar-arrow similar-prev" id="similarPrev">‹</button>
                        <div class="similar-tenants" id="similarTenants">
                            @forelse ($upcomingEvents as $upcoming)
                                <div class="similar-tenant-card"
                                    style="background-image: url({{ $upcoming->primaryPhoto && $upcoming->primaryPhoto->path ? asset('storage/' . $upcoming->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});">
                                    <div class="similar-tenant-content">
                                        <span
                                            class="similar-tenant-date">{{ date_format(date_create($upcoming->start_date), 'd M Y') }}</span>
                                        <h4>{{ $upcoming->name }}</h4>
                                        <!-- Using # for now as we might be on the same route structure or need named route -->
                                        <a href="{{ route('frontend.event.detail', $upcoming->uuid) }}"
                                            class="similar-tenant-link">View Details<span>→</span></a>
                                    </div>
                                </div>
                            @empty
                                <p class="no-events-message">No upcoming events available.</p>
                            @endforelse
                        </div>
                        <button class="similar-arrow similar-next" id="similarNext">›</button>
                        
                        {{-- Scroll Indicators --}}
                        @if (count($upcomingEvents) > 2)
                            <div class="carousel-scroll-indicators" id="scrollIndicators"></div>
                        @endif
                    </div>
                </div>
            </div>
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
                        <a href="#" class="footer-social-link" aria-label="Instagram">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                                    fill="none" stroke="white" stroke-width="2" />
                                <circle cx="12" cy="12" r="4" fill="none" stroke="white"
                                    stroke-width="2" />
                                <circle cx="18" cy="6" r="1" fill="white" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Twitter">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="TikTok">
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
                        <li><a href="#about">About Us</a></li>
                        {{-- <li><a href="#tenants">Store Directory</a></li> --}}
                        {{-- <li><a href="#experience">Experiences</a></li> --}}
                        <li><a href="{{ route('frontend.dining.index') }}">Tenants Directory</a></li>
                        <li><a href="#events">Events</a></li>
                        <li><a href="#career">Careers</a></li>
                    </ul>
                </div>

                {{-- <!-- Services -->
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}#valet">Valet Parking</a></li>
                        <li><a href="{{ url('/') }}#concierge">Concierge</a></li>
                        <li><a href="{{ url('/') }}#gift">Gift Cards</a></li>
                        <li><a href="{{ url('/') }}#member">Membership</a></li>
                        <li><a href="{{ url('/') }}#faq">FAQ</a></li>
                    </ul>
                </div> --}}

                <!-- Contact -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer"
                            style="text-decoration: none">
                            <p>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali 80361</p>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+6236112345678">+62 361 1234 5678</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <a href="mailto:info@malbaligaleria.com">info@malbaligaleria.com</a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <p class="footer-copyright">© 2026 Mal Bali Galeria. All Rights Reserved.</p>
                <div class="footer-brand">
                    <span class="footer-brand-logo">Mal Bali Galeria</span>
                    <span class="footer-brand-text">Enjoy, Play, Eat, Shop</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Use separate event logic -->
    <script src="{{ asset('assets/frontend/js/event/detail.js') }}"></script>
</body>

</html>
