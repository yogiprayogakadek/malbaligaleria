<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria Shopping Center</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}">
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
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#tenants">Tenants</a></li>
                <li><a href="{{ route('directory') }}">Directory</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#contact">Contact</a></li>
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

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h2>Bali’s Most Refined Luxury Lifestyle Destination</h2>
            <p>An elevated sanctuary where you enjoy, play, eat, and shop with exceptional sophistication</p>
            <button class="explore-btn">
                <span class="arrow">→</span>
                <span class="text">Explore malbaligaleria</span>
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section reveal" id="about">
        <div class="about-container">
            <h2>Welcome to Mal Bali Galeria</h2>
            <div class="about-content">
                <p>Mal Bali Galeria Shopping Center offers an exclusive shopping experience with modern architectural
                    design and comprehensive facilities. Located in the strategic area of Denpasar, we provide a
                    comfortable and luxurious shopping environment for all your needs.</p>

                <p>As a premier retail destination in Bali, Mal Bali Galeria hosts a diverse collection of local and
                    international brands, from fashion, beauty, dining, to lifestyle & entertainment. We are committed
                    to providing the best shopping experience with various facilities and services for the whole family.
                </p>

                <p>With our strategic location and complete amenities, Mal Bali Galeria is the perfect destination for
                    shopping, dining, and spending quality time with your loved ones in Denpasar.</p>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <h3>Open Hour</h3>
                    <p>10AM - 10PM (Daily)</p>
                </div>
                <div class="info-item">
                    <h3>Address</h3>
                    <p>Jl. Sunset Road No. 89,<br>Kuta, Badung, Bali, Indonesia 80361</p>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </section>

    <!-- Tenant Carousel Section -->
    <section class="tenant-section reveal" id="tenants">
        <div class="tenant-container">
            <h2>Featured Tenants</h2>
            <div class="carousel-wrapper">
                <div class="carousel-container" id="carouselContainer">
                    @forelse ($tenants as $tenant)
                        <div class="tenant-card">
                            <a href="{{ route('tenant') }}" style="text-decoration: none;">
                                <div class="tenant-card-image"
                                    style="background-image: url({{ asset('storage/' . $tenant->primaryPhoto->path) }});">
                                </div>
                                <div class="tenant-card-content">
                                    <h3>{{ $tenant->name }}</h3>
                                    <p>{{ $tenant->category->name }}</p>
                                    <span
                                        class="tenant-card-tag">{{ $tenant->map_coords['floor'] == 1 ? $tenant->map_coords['floor'] . 'st Floor' : $tenant->map_coords['floor'] . 'nd Floor' }}</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h3 class="text-center">No data available</h3>
                    @endforelse
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn" id="prevBtn">←</button>
                <button class="carousel-btn" id="nextBtn">→</button>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience-section reveal" id="experience">
        <div class="experience-wrapper">
            <div class="experience-left">
                <button class="all-experience-btn">
                    <span class="arrow">→</span>
                    <span class="text">All Experience</span>
                </button>
            </div>

            <div class="experience-cards">
                <div class="experience-card promotion">
                    <div class="experience-card-title-vertical">
                        <h4>Promotion</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Promotion</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card events">
                    <div class="experience-card-title-vertical">
                        <h4>D&E Events</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>D&E Events</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card destinations">
                    <div class="experience-card-title-vertical">
                        <h4>Destinations</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Destinations</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card new-store">
                    <div class="experience-card-title-vertical">
                        <h4>New Store</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>New Store</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Highlight Section -->
    <section class="event-section reveal" id="events">
        <div class="event-container">
            <h2>Upcoming Events</h2>
            <div class="event-slider-wrapper">
                <div class="event-grid" id="eventGrid">
                    @forelse ($events as $event)
                        <div class="event-card">
                            <div class="event-card-bg"
                                style="background-image: url({{ asset('storage/' . $event->primaryPhoto->path) }});">
                            </div>
                            <div class="event-card-content">
                                <span
                                    class="event-date">{{ date_format(date_create($event->start_date), 'd M Y') }}</span>
                                <h3>{{ $event->name }}</h3>
                                <p>{{ $event->description }}</p>
                                <a href="#" class="event-link">Learn More →</a>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">No data available</h3>
                    @endforelse
                </div>
            </div>
            <div class="event-controls" id="eventControls">
                <button class="event-nav-btn" id="eventPrevBtn">←</button>
                <button class="event-nav-btn" id="eventNextBtn">→</button>
            </div>
        </div>
    </section>

    <!-- Mall Map Section -->
    <section class="map-section reveal">
        <div class="map-container">
            <h2>Mall Directory</h2>
            <p class="map-subtitle">Navigate through our shopping center with ease</p>
            <div class="map-wrapper">
                <div class="map-display">
                    <div class="tenant-content">
                        <div class="tenant-grid-wrapper">
                            <button class="tenant-nav-btn prev" id="tenantNavPrev">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6" />
                                </svg>
                            </button>
                            <div class="tenant-grid" id="landingTenantGrid">
                                {{-- RENDER --}}
                            </div>
                            <button class="tenant-nav-btn next" id="tenantNavNext">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </button>
                        </div>
                        <div class="empty-state" id="landingEmptyState" style="display: none;">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" />
                            </svg>
                            <h3>No tenants found</h3>
                        </div>

                        {{-- Tenant Scroll Indicators --}}
                        <div class="tenant-scroll-indicator left hidden" id="tenantScrollBack">
                            <svg viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" /> {{-- Left Arrow --}}
                            </svg>
                            SWIPE BACK
                        </div>

                        <div class="tenant-scroll-indicator right" id="tenantScrollIndicator">
                            SWIPE FOR MORE
                            <svg viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" /> {{-- Right Arrow --}}
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="map-floors" id="mapFloors">
                    <div class="floor-list-wrapper" id="floorListWrapper">
                        <div class="floor-item active">
                            <h4>Level 1</h4>
                            <p>Electronics, Books, Sports</p>
                        </div>
                        <div class="floor-item">
                            <h4>Level 2</h4>
                            <p>Restaurants, Cafés, Food Court</p>
                        </div>
                        <div class="floor-item">
                            <h4>New Store</h4>
                            <p>Fashion, Accessories, Cosmetics</p>
                        </div>
                        <div class="floor-item">
                            <h4>All Floor</h4>
                            <p>Entertainment, Cinema, Kids Zone</p>
                        </div>
                    </div>

                    {{-- Vertical Scroll Indicators --}}
                    <div class="floor-scroll-indicator up hidden" id="floorScrollUp">
                        <svg viewBox="0 0 24 24">
                            <path d="M7 14l5-5 5 5z" />
                        </svg>
                        Scroll up
                    </div>
                    <div class="floor-scroll-indicator down" id="floorScrollDown">
                        Scroll for more
                        <svg viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </div>
                </div> <!-- End of .map-floors -->
            </div>
        </div>
    </section>

    <!-- Tenant Details Modal -->
    <div class="tenant-modal" id="tenantModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-container">
            <button class="modal-close" id="modalClose">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>

            <div class="modal-content">
                <div class="modal-carousel">
                    <div class="carousel-images" id="modalCarouselImages">
                        <!-- Images will be inserted here dynamically -->
                    </div>
                    <button class="carousel-nav prev" id="modalCarouselPrev">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="carousel-nav next" id="modalCarouselNext">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                    <div class="carousel-swipe-hint" id="carouselSwipeHint">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        <span>Swipe or use navigation buttons</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </div>
                    <div class="carousel-indicators" id="modalCarouselIndicators">
                        <!-- Indicators will be inserted here dynamically -->
                    </div>
                </div>

                <div class="modal-details">
                    <div class="modal-header">
                        <div class="modal-logo" id="modalLogo">
                            <!-- Logo will be inserted here -->
                        </div>
                        <div class="modal-title">
                            <span class="modal-floor-badge" id="modalFloorBadge"></span>
                            <h2 id="modalTenantName"></h2>
                            <p class="modal-category" id="modalCategory"></p>
                        </div>
                    </div>

                    <div class="modal-info">
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <div>
                                <span class="info-label">Location</span>
                                <span class="info-value" id="modalUnit"></span>
                            </div>
                        </div>
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <div>
                                <span class="info-label">Operating Hours</span>
                                <span class="info-value" id="modalHours"></span>
                            </div>
                        </div>
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <div>
                                <span class="info-label">Floor</span>
                                <span class="info-value" id="modalFloor"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-description" id="modalDescription">
                        <!-- Description will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="reveal" id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <!-- About Column -->
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>Your premier shopping destination in Bali, offering luxury brands, dining, and entertainment
                        experiences in a modern and comfortable environment.</p>
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
                        <li><a href="#tenants">Store Directory</a></li>
                        <li><a href="#experience">Experiences</a></li>
                        <li><a href="#events">Events</a></li>
                        <li><a href="#career">Careers</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#valet">Valet Parking</a></li>
                        <li><a href="#concierge">Concierge</a></li>
                        <li><a href="#gift">Gift Cards</a></li>
                        <li><a href="#member">Membership</a></li>
                        <li><a href="#faq">FAQ</a></li>
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
                <p class="footer-copyright">© 2024 Mal Bali Galeria. All Rights Reserved.</p>
                <div class="footer-brand">
                    <span class="footer-brand-logo">MBG</span>
                    <span class="footer-brand-text">Premium Shopping Experience</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/frontend/js/landing.js') }}"></script>

</body>

</html>
