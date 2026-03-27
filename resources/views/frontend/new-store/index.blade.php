<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Stores | Mal Bali Galeria</title>
    <meta name="description"
        content="Welcome our newest brands and stores at Mal Bali Galeria. Discover the latest arrivals in Bali's premium shopping destination.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="New Stores | Mal Bali Galeria">
    <meta property="og:description" content="Welcome our newest brands and stores at Mal Bali Galeria.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="New Stores | Mal Bali Galeria">
    <meta property="twitter:description" content="Welcome our newest brands and stores at Mal Bali Galeria.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Argesta+Display&display=swap" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/new-store.css') }}?v={{ time() }}">
</head>

<body class="new-store-page">
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                        onerror="this.style.display='none'">
                </div>
                <h1>Mal Bali Galeria</h1>
                <span>Enjoy, Play, Eat, Shop</span>
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

    <!-- Toggle & Header -->
    <button class="dark-mode-toggle" id="darkModeToggle">
        <svg class="moon-icon" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
        <svg class="sun-icon" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="5" />
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
                <li><a href="{{ route('frontend.landing') }}/#about">About</a></li>

                <li><a href="{{ route('frontend.landing') }}#regular-shows">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.new-store.index') }}">New Store</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>

                <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
                @role('admin')
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endrole
            </ul>
        </nav>
    </div>

    <main>
        <section class="page-header">
            <h1>Latest Additions</h1>
            <p>Welcome our newest brands and stores</p>
        </section>

        <section class="new-store-grid" id="tenantGrid">
            @forelse($tenants as $index => $tenant)
                <div class="tenant-card stagger-card show" style="animation-delay: {{ $index * 0.1 }}s"
                    onclick="openStoreModal({{ $tenant->id }})">
                    <div class="tenant-card-image"
                        style="background-image: url({{ $tenant->logo ? asset('storage/' . $tenant->logo) : ($tenant->primaryPhoto ? asset('storage/' . $tenant->primaryPhoto->path) : asset('assets/images/no_image.jpg')) }});"
                        loading="lazy">
                    </div>
                    <div class="tenant-card-content">
                        <h3>{{ $tenant->name }}</h3>
                        <p>{{ $tenant->category->name }}</p>
                        <span class="tenant-card-tag">
                            @php
                                $floor = $tenant->map_coords['floor'] ?? 1;
                            @endphp
                            {{ $floor == 1 ? '1st Floor' : '2nd Floor' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 4rem;">
                    <h3>No new stores to display yet.</h3>
                    <p>Stay tuned for exciting new arrivals!</p>
                </div>
            @endforelse
        </section>
    </main>

    {{-- Tenant Modal (Info + Map) --}}
    <div class="tenant-modal" id="tenantModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-container">
            <button class="modal-close-btn" id="modalCloseBtn" aria-label="Close Modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <button class="favorite-btn" id="modalFavoriteBtn" data-unit="">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </button>

            <button class="share-btn" id="modalShareBtn" title="Share Store">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="18" cy="5" r="3" />
                    <circle cx="6" cy="12" r="3" />
                    <circle cx="18" cy="19" r="3" />
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                </svg>
            </button>

            <div class="modal-content">
                <div class="modal-carousel">
                    <div class="carousel-swipe-hint" id="carouselSwipeHint">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Swipe to browse
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </div>
                    <div class="carousel-loading" id="modalCarouselLoading">
                        <div class="loading-status">
                            <div class="loading-spinner"></div>
                            <span>Memuat Album...</span>
                        </div>
                    </div>
                    <div class="carousel-images" id="modalCarouselImages"></div>
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
                    <div class="carousel-indicators" id="modalCarouselIndicators"></div>
                </div>

                <div class="modal-details">
                    {{-- Info View --}}
                    <div id="modalInfoView">
                        <div class="modal-header">
                            <div class="modal-logo" id="modalLogo"></div>
                            <div class="modal-title">
                                <span class="modal-floor-badge" id="modalFloorBadge"></span>
                                <h2 id="modalTenantName"></h2>
                                <div class="modal-category" id="modalCategory">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z" />
                                    </svg>
                                    <span id="modalCategoryText"></span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-info">
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
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <div>
                                    <span class="info-label">Location</span>
                                    <span class="info-value" id="modalLocation"></span>
                                </div>
                            </div>
                            <div class="modal-info-item highlight" id="showOnMapBtn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6" />
                                    <line x1="8" y1="2" x2="8" y2="18" />
                                    <line x1="16" y1="6" x2="16" y2="22" />
                                </svg>
                                <div>
                                    <span class="info-label">Direction</span>
                                    <span class="info-value">Show on Map</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-description" id="modalDescription"></div>
                    </div>

                    <div id="modalMapView" style="display: none;">
                        <div class="modal-map-header">
                            <button class="modal-map-back" id="btnBackToInfo">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 12H5M12 19l-7-7 7-7" />
                                </svg>
                                Back to Info
                            </button>
                            <h4 class="modal-map-title">
                                Store Location
                                <span class="modal-map-floor-badge" id="modalMapFloorBadge"></span>
                            </h4>
                        </div>
                        <div class="modal-map-wrapper">
                            <img src="" id="modalFloorMap" alt="Floor Map">
                            <div class="map-marker-logo" id="modalMapMarkerLogo">
                                <div class="logo-pin">
                                    <img src="" id="markerLogoImg" alt="">
                                </div>
                                <div class="marker-pulse"></div>
                            </div>
                        </div>
                        <div class="map-floors" style="padding-top: 15px;">
                            <button class="floor-btn" data-floor="1">1st Floor</button>
                            <button class="floor-btn" data-floor="2">2nd Floor</button>
                        </div>
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
                        <li><a href="{{ route('frontend.landing') }}#about">About Us</a></li>
                        <li><a href="{{ route('frontend.landing') }}#regular-shows">Events</a></li>
                        <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                        <li><a href="{{ route('frontend.new-store.index') }}">New Store</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                        <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>
                    </ul>
                </div>

                <!-- Services -->
                {{-- <div class="footer-column">
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
                        <p>Simpang Dewa Ruci<br>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali, Indonesia 80361</p>
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

    <button class="scroll-to-top" id="scrollToTop" aria-label="Scroll to top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 19V5M5 12l7-7 7 7" />
        </svg>
    </button>

    {{-- Sticky Mobile CTA Bar --}}
    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="{{ route('frontend.landing') }}" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            <span>Home</span>
        </a>
        <a href="{{ route('frontend.directory.index') }}" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z" />
            </svg>
            <span>Directory</span>
        </a>
        <a href="tel:+62361755277" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Call</span>
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/frontend/js/landing.js') }}"></script>

    <script>
        // Use var for better global access in scripts
        window.tenants = @json($tenants);
        var currentTenant = null;
        var currentPhotoIndex = 0;
        var currentMapFloor = 1;

        // Modal Elements
        const modal = document.getElementById('tenantModal');
        const carouselImages = document.getElementById('modalCarouselImages');
        const carouselIndicators = document.getElementById('modalCarouselIndicators');
        const modalInfoView = document.getElementById('modalInfoView');
        const modalMapView = document.getElementById('modalMapView');
        const mapImage = document.getElementById('modalMapImage');
        const mapMarker = document.getElementById('modalMapMarker');

        // Map Paths
        const floorMaps = {
            1: "{{ asset('assets/images/floors/1st_floor.png') }}",
            2: "{{ asset('assets/images/floors/2nd_floor.png') }}"
        };

        function openStoreModal(id) {
            currentTenant = window.tenants.find(t => t.id == id);
            if (!currentTenant) return;

            // Reset View
            modalInfoView.style.display = 'block';
            modalMapView.style.display = 'none';
            currentPhotoIndex = 0;

            // Populate Info
            document.getElementById('modalTenantName').textContent = currentTenant.name;
            document.getElementById('modalCategoryText').textContent = currentTenant.category.name;
            document.getElementById('modalHours').textContent = currentTenant.hours || '10:00 AM - 10:00 PM';
            document.getElementById('modalLocation').textContent = `Unit ${currentTenant.map_coords.unit || ''}, ${currentTenant.map_coords.floor == 1 ? '1st Floor' : '2nd Floor'}`;
            document.getElementById('modalDescription').innerHTML = currentTenant.description || 'No description available.';
            document.getElementById('modalFloorBadge').textContent = (currentTenant.map_coords.floor || 1) == 1 ? '1st Floor' : '2nd Floor';

            // Favorite Button State
            const favBtn = document.getElementById('modalFavoriteBtn');
            const favorites = JSON.parse(localStorage.getItem('mbg_favorites') || '[]');
            favBtn.classList.toggle('active', favorites.includes(currentTenant.map_coords.unit));
            favBtn.dataset.unit = currentTenant.map_coords.unit;

            // Logo
            const logoContainer = document.getElementById('modalLogo');
            const logoUrl = currentTenant.logo ? `/storage/${currentTenant.logo}` : (currentTenant.primaryPhoto ? `/storage/${currentTenant.primaryPhoto.path}` : '{{ asset('assets/images/no_image.jpg') }}');
            logoContainer.innerHTML = `<img src="${logoUrl}" alt="${currentTenant.name}">`;

            // Carousel
            renderCarousel();

            // Show Modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Show swipe hint if multiple photos
            const photosCount = (currentTenant.photos && currentTenant.photos.length) || (currentTenant.primaryPhoto ? 1 : 0);
            const hint = document.getElementById('carouselSwipeHint');
            if (photosCount > 1) {
                hint.classList.add('show');
                setTimeout(() => hint.classList.remove('show'), 3000);
            } else {
                hint.classList.remove('show');
            }
        }

        function renderCarousel() {
            carouselImages.innerHTML = '';
            carouselIndicators.innerHTML = '';

            const photos = currentTenant.photos && currentTenant.photos.length > 0 
                ? currentTenant.photos 
                : (currentTenant.primaryPhoto ? [currentTenant.primaryPhoto] : []);

            if (photos.length === 0) {
                carouselImages.innerHTML = `<img src="{{ asset('assets/images/no_image.jpg') }}" alt="No Image">`;
                return;
            }

            photos.forEach((photo, index) => {
                const img = document.createElement('img');
                img.src = `/storage/${photo.path}`;
                carouselImages.appendChild(img);

                const dot = document.createElement('div');
                dot.className = `indicator-dot ${index === 0 ? 'active' : ''}`;
                dot.onclick = () => goToPhoto(index);
                carouselIndicators.appendChild(dot);
            });

            updateModalCarousel();
        }

        function updateModalCarousel() {
            const width = carouselImages.parentElement.offsetWidth;
            carouselImages.style.transform = `translateX(-${currentPhotoIndex * width}px)`;
            
            document.querySelectorAll('.indicator-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentPhotoIndex);
            });
        }

        function goToPhoto(index) {
            currentPhotoIndex = index;
            updateModalCarousel();
        }

        // Event Listeners
        document.getElementById('modalCloseBtn').onclick = closeModal;
        document.getElementById('modalOverlay').onclick = closeModal;

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Favorite Button Logic
        const favBtn = document.getElementById('modalFavoriteBtn');
        favBtn.onclick = () => {
            const unit = favBtn.dataset.unit;
            let favorites = JSON.parse(localStorage.getItem('mbg_favorites') || '[]');
            
            if (favorites.includes(unit)) {
                favorites = favorites.filter(f => f !== unit);
                favBtn.classList.remove('active');
            } else {
                favorites.push(unit);
                favBtn.classList.add('active');
            }
            
            localStorage.setItem('mbg_favorites', JSON.stringify(favorites));
        };

        // Share Button Logic
        document.getElementById('modalShareBtn').onclick = () => {
            if (navigator.share) {
                navigator.share({
                    title: currentTenant.name + ' | Mal Bali Galeria',
                    text: 'Check out ' + currentTenant.name + ' at Mal Bali Galeria',
                    url: window.location.href
                }).catch(console.error);
            } else {
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        };

        document.getElementById('modalCarouselPrev').onclick = () => {
            const photosCount = carouselImages.children.length;
            if (photosCount <= 1) return;
            currentPhotoIndex = (currentPhotoIndex - 1 + photosCount) % photosCount;
            updateModalCarousel();
        };

        document.getElementById('modalCarouselNext').onclick = () => {
            const photosCount = carouselImages.children.length;
            if (photosCount <= 1) return;
            currentPhotoIndex = (currentPhotoIndex + 1) % photosCount;
            updateModalCarousel();
        };

        // Map Logic
        document.getElementById('showOnMapBtn').onclick = () => {
            modalInfoView.style.display = 'none';
            modalMapView.style.display = 'block';
            
            // Marker Logo
            const logoUrl = currentTenant.logo ? `/storage/${currentTenant.logo}` : (currentTenant.primaryPhoto ? `/storage/${currentTenant.primaryPhoto.path}` : '{{ asset('assets/images/no_image.jpg') }}');
            document.getElementById('markerLogoImg').src = logoUrl;
            
            setMapFloor(currentTenant.map_coords.floor);
            positionMarker(currentTenant.map_coords.x, currentTenant.map_coords.y);
        };

        document.getElementById('btnBackToInfo').onclick = () => {
            modalMapView.style.display = 'none';
            modalInfoView.style.display = 'block';
        };

        function setMapFloor(floor) {
            currentMapFloor = floor;
            document.getElementById('modalFloorMap').src = floorMaps[floor];
            document.getElementById('modalMapFloorBadge').textContent = floor == 1 ? '1st Floor' : '2nd Floor';
            
            document.querySelectorAll('.floor-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.floor == floor);
            });

            const markerContainer = document.getElementById('modalMapMarkerLogo');
            if (floor != currentTenant.map_coords.floor) {
                markerContainer.style.display = 'none';
            } else {
                markerContainer.style.display = 'block';
                positionMarker(currentTenant.map_coords.x, currentTenant.map_coords.y);
            }
        }

        function positionMarker(x, y) {
            const markerContainer = document.getElementById('modalMapMarkerLogo');
            markerContainer.style.left = x + '%';
            markerContainer.style.top = y + '%';
        }

        document.querySelectorAll('.floor-btn').forEach(btn => {
            btn.onclick = () => setMapFloor(btn.dataset.floor);
        });

        // Initialize reveal animations for cards
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.stagger-card').forEach(card => {
                const rect = card.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50) {
                    card.classList.add('show');
                }
            });
        });
    </script>
</body>

</html>
