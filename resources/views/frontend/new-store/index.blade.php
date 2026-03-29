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

    <div class="main-content">
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

    <main class="new-store-main">
        {{-- Hero Banner --}}
        <div class="promo-hero-banner">
            <div class="promo-hero-content">
                <span class="promo-hero-eyebrow">Mal Bali Galeria</span>
                <h1 class="promo-hero-title">Latest Additions</h1>
                <p class="promo-hero-subtitle">Welcome our newest brands and stores</p>
                <a href="{{ route('frontend.landing') }}" class="promo-hero-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>

        <section class="new-store-grid" id="tenantGrid">
            @forelse($tenants as $index => $tenant)
                <div class="tenant-card stagger-card" 
                     data-id="{{ $tenant->id }}"
                     style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="tenant-logo">
                        <img src="{{ $tenant->logo ? asset('storage/' . $tenant->logo) : ($tenant->primaryPhoto ? asset('storage/' . $tenant->primaryPhoto->path) : asset('assets/images/no_image.jpg')) }}"
                             alt="{{ $tenant->name }}" loading="lazy">
                    </div>
                    <div class="tenant-info">
                        <span class="floor-badge">{{ ($tenant->map_coords['floor'] ?? 1) == 1 ? '1st Floor' : '2nd Floor' }}</span>
                        <h3>{{ $tenant->name }}</h3>
                        <p class="tenant-category">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                            </svg>
                            {{ $tenant->category->name }}
                        </p>
                        <div class="tenant-meta">
                            <div class="meta-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>Unit {{ $tenant->map_coords['unit'] ?? '' }}</span>
                            </div>
                            <div class="meta-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                <span>{{ $tenant->hours ?: '10:00 - 22:00' }}</span>
                            </div>
                        </div>
                        <button class="see-details-btn" data-id="{{ $tenant->id }}">
                            Learn More
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
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
                    <!-- Detail View (Initially Shown) -->
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

    </div> {{-- End .main-content --}}

    @include('frontend.partials.footer_v2')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        window.FLOOR_MAPS = {
            1: "{{ asset('assets/images/floors/1st_floor.png') }}",
            2: "{{ asset('assets/images/floors/2nd_floor.png') }}"
        };
    </script>
    <script src="{{ asset('assets/frontend/js/new-store.js') }}?v={{ time() }}"></script>

    <script>
        // Staggered reveal for cards
        function revealCards() {
            const cards = document.querySelectorAll('.stagger-card');
            const triggerBottom = window.innerHeight * 0.9;

            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < triggerBottom) {
                    card.classList.add('show');
                }
            });
        }

        window.addEventListener('scroll', revealCards);
        document.addEventListener('DOMContentLoaded', revealCards);
    </script>
</body>
</html>
