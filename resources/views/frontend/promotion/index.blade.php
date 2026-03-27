<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->payload['site_title'] ?? 'Promotions' }} | Mal Bali Galeria</title>
    <meta name="description"
        content="Check out the latest promotions and exclusive deals at Mal Bali Galeria. Your premium shopping experience simplified.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $setting->payload['site_title'] ?? 'Promotions' }} | Mal Bali Galeria">
    <meta property="og:description" content="Check out the latest promotions and exclusive deals at Mal Bali Galeria.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $setting->payload['site_title'] ?? 'Promotions' }} | Mal Bali Galeria">
    <meta property="twitter:description"
        content="Check out the latest promotions and exclusive deals at Mal Bali Galeria.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/promotion/promotion.css') }}?v={{ time() + 14 }}">
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
            <p class="loader-text">LOADING PROMOTIONS...</p>
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
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" />
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


    <main class="promotion-main">

        {{-- Promo Hero Banner --}}
        <div class="promo-hero-banner">
            <div class="promo-hero-content">
                <span class="promo-hero-eyebrow">Mal Bali Galeria</span>
                <h1 class="promo-hero-title">{{ $setting->payload['page_title'] ?? 'Current Promotions' }}</h1>
                <p class="promo-hero-subtitle">
                    {{ $setting->payload['page_subtitle'] ?? 'Discover amazing deals and offers from our tenants' }}
                </p>
                <a href="{{ route('frontend.landing') }}" class="promo-hero-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>

        <div class="promotion-container">

            {{-- Remove old header because now using hero banner above --}}
            <div class="promotion-layout">

                <aside class="tenant-filter-sidebar">
                    <div class="filter-header">
                        <button class="mobile-filter-close-btn" id="mobileFilterCloseBtn" aria-label="Close Filter">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z" />
                            </svg>
                            Filter by Tenant
                        </h3>
                        <p>Select a tenant to view their promotions</p>
                    </div>
                    <div class="filter-body">

                        <div class="category-filter-section">
                            <h4 class="filter-section-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" />
                                </svg>
                                Categories
                            </h4>
                            <div class="filter-input styled-select" style="margin-top: 10px;">
                                <select id="categoryFilter" aria-label="Filter by category">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="tenant-filter-item" data-filter-type="favorites" id="favoritesFilter">
                            <div class="tenant-filter-icon"
                                style="background: linear-gradient(135deg, #2c5f5d 0%, #F5F5DC 100%);">
                                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </div>
                            <div class="tenant-filter-info">
                                <h4>My Favorites</h4>
                                <span class="promo-count" id="favoritesCount">0 items</span>
                            </div>
                        </div>

                        <div class="filter-divider"></div>


                        <div class="tenant-search-container">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="tenantSearchInput" placeholder="Search tenant..."
                                autocomplete="off">
                        </div>
                        <div class="tenant-filter-item active" data-tenant="all">
                            <div class="tenant-filter-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                            </div>
                            <div class="tenant-filter-info">
                                <h4>All Promotions</h4>
                                <span class="promo-count" id="allPromoCount">0</span>
                            </div>
                        </div>
                        <div class="filter-divider"></div>
                        <div id="tenantFilterList">

                        </div>
                    </div>
                </aside>


                <div class="mobile-filter-overlay" id="mobileFilterOverlay"></div>


                <div class="promotion-content">

                    <div class="promotion-toolbar">
                        <div class="toolbar-left">
                            <button class="mobile-filter-toggle" id="mobileFilterToggle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="4" y1="21" x2="4" y2="14" />
                                    <line x1="4" y1="10" x2="4" y2="3" />
                                    <line x1="12" y1="21" x2="12" y2="12" />
                                    <line x1="12" y1="8" x2="12" y2="3" />
                                    <line x1="20" y1="21" x2="20" y2="16" />
                                    <line x1="20" y1="12" x2="20" y2="3" />
                                    <line x1="1" y1="14" x2="7" y2="14" />
                                    <line x1="9" y1="8" x2="15" y2="8" />
                                    <line x1="17" y1="16" x2="23" y2="16" />
                                </svg>
                                Filter
                            </button>
                            <div class="sort-dropdown">
                                <select id="sortPromotions" aria-label="Sort promotions">
                                    <option value="newest">Newest First</option>
                                    <option value="ending_soon">Ending Soon</option>
                                    <option value="title_asc">A-Z</option>
                                </select>
                                <svg class="sort-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                        <div class="toolbar-right">
                            <div class="view-toggle">
                                <button class="view-btn active" data-view="grid" aria-label="Grid View">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="7" height="7" />
                                        <rect x="14" y="3" width="7" height="7" />
                                        <rect x="14" y="14" width="7" height="7" />
                                        <rect x="3" y="14" width="7" height="7" />
                                    </svg>
                                </button>
                                <button class="view-btn" data-view="list" aria-label="List View">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="8" y1="6" x2="21" y2="6" />
                                        <line x1="8" y1="12" x2="21" y2="12" />
                                        <line x1="8" y1="18" x2="21" y2="18" />
                                        <line x1="3" y1="6" x2="3.01" y2="6" />
                                        <line x1="3" y1="12" x2="3.01" y2="12" />
                                        <line x1="3" y1="18" x2="3.01" y2="18" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- #3 Promo count + #2 Active Filter Pills row --}}
                    <div class="toolbar-meta-row">
                        <span class="promo-result-count" id="promoResultCount">Loading...</span>
                        <div class="active-filter-pills" id="activeFilterPills" style="display:none;"></div>
                    </div>

                    <div class="promotion-grid" id="promotionGrid">

                    </div>


                    <div class="empty-state" id="emptyState" style="display: none;">
                        <div class="empty-state-emoji">🛍️</div>
                        <h3>No promotions found</h3>
                        <p id="emptyStateMsg">No promotions match your current filter. Try adjusting the filter or
                            check back later!</p>
                        <button class="clear-filters-btn" id="clearFiltersBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                style="width:16px;height:16px;margin-right:6px;">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                            Reset All Filters
                        </button>
                    </div>


                    <div class="load-more-container" id="loadMoreContainer" style="display: none;">
                        <button class="load-more-btn" id="loadMoreBtn">
                            <span>Load More Promotions</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="tenant-modal" id="promotionModal">
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

                    </div>
                    <button class="carousel-nav prev" id="modalCarouselPrev" style="display: none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="carousel-nav next" id="modalCarouselNext" style="display: none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                    <div class="carousel-swipe-hint" id="carouselSwipeHint" style="display: none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        <span>Swipe or use navigation buttons</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </div>
                    <div class="carousel-indicators" id="modalCarouselIndicators">

                    </div>
                </div>

                <div class="modal-scroll-hint">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 13l5 5 5-5M7 6l5 5 5-5" />
                    </svg>
                    <span>Scroll down for more details</span>
                </div>

                <div class="modal-details">
                    <div class="modal-header">
                        <div class="modal-logo" id="modalLogo">

                        </div>
                        <div class="modal-title">
                            <span class="modal-promo-badge" id="modalPromoBadge">PROMOTION</span>
                            <h2 id="modalPromoTitle"></h2>
                            <p class="modal-tenant-name" id="modalTenantName"></p>
                        </div>
                    </div>

                    <div class="modal-info">
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <div>
                                <span class="info-label">Valid Period</span>
                                <span class="info-value" id="modalValidPeriod"></span>
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
                    </div>

                    {{-- #9 Share to WhatsApp button --}}
                    <a href="#" id="modalShareWA" target="_blank" rel="noopener noreferrer"
                        class="modal-wa-share-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12c0 2.126.557 4.121 1.532 5.854L0 24l6.336-1.51A11.955 11.955 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.373l-.36-.213-3.727.888.944-3.637-.234-.374A9.786 9.786 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z" />
                        </svg>
                        Share via WhatsApp
                    </a>

                    <div class="modal-description" id="modalDescription">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer id="contact">
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
                        <li><a href="{{ route('frontend.landing') }}#regular-shows">Events</a></li>
                        <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                        <li><a href="{{ route('frontend.new-store.index') }}">New Store</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                        <li><a href="{{ route('frontend.landing') }}#contact">Contact</a></li>

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
    <script src="{{ asset('assets/frontend/js/promotion/promotion.js') }}?v={{ time() }}"></script>

</body>

</html>
