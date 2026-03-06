<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria | Enjoy, Play, Eat, Shop</title>
    <meta name="description"
        content="Mal Bali Galeria - The FIRST Premium Shopping Mall & Life Style Destination in Bali. Discover premium brands, dining, and entertainment.">
    <meta name="keywords"
        content="Mal Bali Galeria, Bali Shopping Mall, Kuta Mall, Bali Lifestyle, Bali Shopping Destination">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Mal Bali Galeria | Enjoy, Play, Eat, Shop">
    <meta property="og:description"
        content="The FIRST Premium Shopping Mall & Life Style Destination in Bali. Discover premium brands, dining, and entertainment.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Mal Bali Galeria | Enjoy, Play, Eat, Shop">
    <meta property="twitter:description"
        content="The FIRST Premium Shopping Mall & Life Style Destination in Bali. Discover premium brands, dining, and entertainment.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() + 1 }}">
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
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" id="headerLogo"
                    style="height: 30px; width: auto;">
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
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                <li><a href="{{ route('frontend.landing') }}#events">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>

        <div class="sidebar-search">
            <form action="{{ route('frontend.directory.index') }}" method="GET" id="sidebarSearchForm">
                <div class="search-bar">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="8" stroke-width="2" />
                        <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <input type="text" name="search" id="sidebarSearchInput" placeholder="Search tenants..."
                        autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <section class="hero" id="home">
        <div class="hero-slider" id="heroSlider">
            <div class="hero-slide active" style="background-image: url('{{ asset('assets/bg_front.jfif') }}')">
            </div>
            <div class="hero-slide" style="background-image: url('{{ asset('assets/bg_front.jfif') }}')"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('assets/bg_front.jfif') }}')"></div>
            {{-- <div class="hero-slide active" style="background-image: url('{{ asset('assets/frontend/images/hero/hero_slide_1.png') }}')"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('assets/frontend/images/hero/hero_slide_2.png') }}')"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('assets/frontend/images/hero/hero_slide_3.png') }}')"></div> --}}
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>The Pioneer Shopping Center in Bali</h2>
            <p>Enjoy the moment. Play without limits. Eat with passion. Shop the best.</p>
            <a href="{{ route('frontend.directory.index') }}" style="text-decoration: none;">
                <button class="explore-btn">
                    <span class="arrow">→</span>
                    <span class="text">Explore malbaligaleria</span>
                </button>
            </a>
        </div>
        <div class="hero-slider-dots" id="heroSliderDots">
            <span class="hero-dot active" data-index="0"></span>
            <span class="hero-dot" data-index="1"></span>
            <span class="hero-dot" data-index="2"></span>
        </div>
    </section>

    <section class="about-section reveal" id="about">
        <div class="about-container">
            <div class="about-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" loading="lazy">
            </div>
            <h2>Welcome to Mal Bali Galeria</h2>
            <div class="about-content">
                {{-- <p>An iconic lifestyle destination in the heart of Kuta, set at the prestigious Simpang Dewa Ruci. As
                    Bali’s first mall to introduce premium retail concepts that continue to thrive, Mal Bali Galeria
                    blends refined shopping and curated dining with a vibrant calendar of unique, high-energy
                    events—delivering a sophisticated Family Mall experience where excitement, culture, and elegance
                    come together.
                    Enjoy. Play. Eat. Shop.</p> --}}

                <p>
                    Right in the vibrant heart of Kuta at the iconic Simpang Dewa Ruci, Mal Bali Galeria is where Bali
                    comes to life. As the island’s pioneer of premium retail concepts, the mall continues to set the
                    standard for trendsetting brands, exciting experiences, and unforgettable moments.
                    With its signature motto, Enjoy. Play. Eat. Shop., Mal Bali Galeria is more than a shopping
                    destination—it’s a lifestyle playground. From fashion-forward retail and curated dining spots to
                    thrilling, high-energy events that light up the calendar, there’s always something happening.
                    Designed as a dynamic Family Mall, it’s the place where friends gather, families connect, cultures
                    meet, and excitement never stops. Every visit brings new discoveries, fresh flavors, and vibrant
                    experiences—all under one roof.
                </p>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <h3>Open Hour</h3>
                    <p>10AM - 10PM (Daily)</p>
                </div>
                <div class="info-item">
                    <h3>Address</h3>
                    <p>Jl. Bypass Ngurah Rai,<br>Kuta, Badung, Bali, Indonesia 80361</p>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </section>

    <section class="tenant-section reveal" id="tenants" style="display: none;">
        <div class="tenant-container">
            <h2>Featured Tenants</h2>
            <div class="carousel-wrapper">
                <div class="carousel-container" id="carouselContainer">
                    @forelse ($tenants as $tenant)
                        <div class="tenant-card">
                            <a href="javascript:void(0);" class="featured-tenant-trigger"
                                data-id="{{ $tenant->id }}" style="text-decoration: none;">
                                <div class="tenant-card-image"
                                    style="background-image: url({{ $tenant->primaryPhoto && $tenant->primaryPhoto->path
                                        ? asset('storage/' . $tenant->primaryPhoto->path)
                                        : asset('assets/images/no_image.jpg') }});"
                                    loading="lazy">
                                </div>
                                <div class="tenant-card-content">
                                    <h3>{{ $tenant->name }}</h3>
                                    <p>{{ $tenant->category->name }}</p>
                                    <span class="tenant-card-tag">
                                        @php
                                            $floor = data_get($tenant->map_coords, 'floor');
                                        @endphp

                                        {{ $floor ? ($floor === 1 ? "{$floor}st Floor" : "{$floor}nd Floor") : '-' }}
                                    </span>

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

    <section class="experience-section reveal" id="experience">
        <div class="experience-container">
            <div class="experience-header">
                <h2>What's On at MBG</h2>
                <p class="experience-subtitle">From exciting promos to brand-new stores — there's always something
                    happening.</p>
                <div class="header-divider"></div>
            </div>

            <div class="experience-cards">
                <a href="{{ route('frontend.promotion.index') }}" class="experience-card promotion">
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Promotion</h4>
                        </div>
                    </div>
                </a>

                <a href="{{ route('frontend.event.index') }}" class="experience-card events">
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Events</h4>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/new-store') }}" class="experience-card new-store">
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>New Store</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- <section class="instagram-section reveal" id="instagram">
        <div class="instagram-container">
            <div class="instagram-header">
                <h2>Moments @ Galeria</h2>
                <p>Follow us <a href="https://www.instagram.com/malbaligaleria/" target="_blank">@malbaligaleria</a></p>
            </div>
            <div class="instagram-grid">
                @php
                    $igImages = [
                        asset('assets/frontend/images/instagram/ig_1.png'),
                        asset('assets/frontend/images/instagram/ig_2.png'),
                        asset('assets/frontend/images/instagram/ig_3.png'),
                        asset('assets/frontend/images/instagram/ig_4.png'),
                        asset('assets/frontend/images/instagram/ig_5.png'),
                        asset('assets/frontend/images/instagram/ig_6.png'),
                    ];
                @endphp
                @for ($i = 0; $i < 20; $i++)
                    <div class="instagram-item {{ $i >= 6 ? 'ig-hidden' : '' }}">
                        <img src="{{ $igImages[$i % 6] }}" alt="Instagram Moment">
                        <div class="instagram-overlay">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="instagram-footer">
                <button class="instagram-btn load-more-ig" id="loadMoreIg">
                    <span>Load More</span>
                </button>
                <a href="https://www.instagram.com/malbaligaleria/" target="_blank" class="instagram-btn">
                    <span>Follow us on Instagram</span>
                </a>
            </div>
        </div>
    </section> --}}

    {{-- ===== REGULAR SHOWS SECTION ===== --}}
    @if(isset($regularEvents) && $regularEvents->count() > 0)
    <section class="regular-shows-section reveal" id="regular-shows">
        <div class="regular-shows-container">
            <div class="regular-shows-header">
                <div class="regular-shows-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                    Live Entertainment
                </div>
                <h2>Regular Shows</h2>
                <p class="regular-shows-subtitle">Hadir setiap minggu, menghibur selalu</p>
            </div>

            <div class="regular-shows-grid">
                @foreach($regularEvents as $rEvent)
                <a href="{{ route('frontend.event.detail', $rEvent->uuid) }}" class="regular-show-card" style="text-decoration:none;">
                    <div class="rsc-image-wrap">
                        <div class="rsc-image" style="background-image: url({{ $rEvent->primaryPhoto && $rEvent->primaryPhoto->path ? asset('storage/' . $rEvent->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});"></div>
                        <div class="rsc-overlay"></div>
                        <div class="rsc-schedule-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $rEvent->recurring_label ?? 'Rutin' }}
                        </div>
                    </div>
                    <div class="rsc-content">
                        <h3 class="rsc-title">{{ $rEvent->name }}</h3>
                        <p class="rsc-desc">{{ Str::limit($rEvent->description, 90) }}</p>
                        <div class="rsc-meta">
                            @if($rEvent->start_time)
                            <span class="rsc-meta-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ date('H:i', strtotime($rEvent->start_time)) }}
                                @if($rEvent->end_time) – {{ date('H:i', strtotime($rEvent->end_time)) }} @endif
                            </span>
                            @endif
                            @if($rEvent->location)
                            <span class="rsc-meta-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $rEvent->location }}
                            </span>
                            @endif
                        </div>
                        <span class="rsc-cta">Lihat Detail →</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== EXHIBITION SECTION ===== --}}
    @if(isset($exhibitionEvents) && $exhibitionEvents->count() > 0)
    <section class="exhibition-section reveal" id="exhibition">
        <div class="exhibition-container">
            <div class="exhibition-header">
                <h2>Exhibition</h2>
                <p class="exhibition-subtitle">Discover exclusive exhibitions and unique experiences at Mal Bali Galeria</p>
            </div>

            <div class="exhibition-grid">
                @foreach($exhibitionEvents as $exEvent)
                <a href="{{ route('frontend.event.detail', $exEvent->uuid) }}" class="exhibition-card" style="text-decoration:none;">
                    <div class="exc-image-wrap">
                        <div class="exc-image" style="background-image: url({{ $exEvent->primaryPhoto && $exEvent->primaryPhoto->path ? asset('storage/' . $exEvent->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});"></div>
                        <div class="exc-overlay"></div>
                        @if($exEvent->start_date && $exEvent->end_date)
                        <div class="exc-date-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ date('d M', strtotime($exEvent->start_date)) }}
                            @if($exEvent->start_date != $exEvent->end_date)
                                – {{ date('d M Y', strtotime($exEvent->end_date)) }}
                            @else
                                {{ date(' Y', strtotime($exEvent->start_date)) }}
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="exc-content">
                        <h3 class="exc-title">{{ $exEvent->name }}</h3>
                        <p class="exc-desc">{{ Str::limit($exEvent->description, 90) }}</p>
                        @if($exEvent->location)
                        <div class="exc-location">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $exEvent->location }}
                        </div>
                        @endif
                        <span class="exc-cta">Lihat Detail →</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="event-section reveal" id="events">
        <div class="event-container">
            <h2>Upcoming Events</h2>
            <p class="event-subtitle">Don't miss out — explore what's coming up at Mal Bali Galeria</p>
            <div class="event-slider-wrapper">
                <div class="event-grid" id="eventGrid">
                    @forelse ($events as $event)
                        <div class="event-card">
                            <div class="event-card-bg"
                                style="background-image: url({{ $event->primaryPhoto && $event->primaryPhoto->path ? asset('storage/' . $event->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});">
                            </div>
                            <div class="event-card-content">
                                <span
                                    class="event-date">{{ date_format(date_create($event->start_date), 'd M Y') }}</span>
                                <h3>{{ $event->name }}</h3>
                                <p class="event-desc">{{ Str::limit($event->description, 110) }}</p>
                                <a href="{{ route('frontend.event.detail', $event->uuid) }}" class="event-link">Learn
                                    More →</a>
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

    <section class="map-section reveal">
        <div class="map-container">
            <h2>Tenants Directory</h2>
            <p class="map-subtitle">Navigate through our shopping center with ease</p>
            <div class="tenant-search-wrapper">
                <div class="tenant-search-bar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" stroke-linecap="round" />
                    </svg>
                    <input type="text" id="tenantSearchInput" placeholder="Search tenants by name or category...">
                </div>
            </div>
            <div class="map-wrapper">
                <div class="map-display">
                    <div class="visual-map-container" id="visualMapContainer" style="display: none;">
                        <img id="visualMapImage" src="" alt="Mall Map">
                        <div id="mapMarker" class="map-marker" style="display: none;">
                            <div class="marker-pin"></div>
                            <div class="marker-pulse"></div>
                        </div>
                        <button class="back-to-grid-btn" id="btnBackToGrid">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5M12 19l-7-7 7-7" />
                            </svg>
                            Back to List
                        </button>
                    </div>
                    <div class="tenant-content" id="tenantContentGrid">
                        <div class="tenant-grid-wrapper">
                            <button class="tenant-nav-btn prev" id="tenantNavPrev">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6" />
                                </svg>
                            </button>
                            <div class="tenant-grid" id="landingTenantGrid">
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

                        <div class="tenant-scroll-indicator left hidden" id="tenantScrollBack">
                            <svg viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" />
                            </svg>
                            SWIPE BACK
                        </div>

                        <div class="tenant-scroll-indicator right" id="tenantScrollIndicator">
                            SWIPE FOR MORE
                            <svg viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="map-floors" id="mapFloors">
                    <div class="floor-list-wrapper" id="floorListWrapper">
                        <div class="floor-item active">
                            <h4>Level 1</h4>
                            <p>Fashion · Food & Beverages · IT & Games · Beauty & Accessories · Bookstore</p>
                        </div>
                        <div class="floor-item">
                            <h4>Level 2</h4>
                            <p>Fashion · Kids & Play Zone · Beauty & Accessories · Sport & Swim Apparel · Salon</p>
                        </div>
                        <div class="floor-item">
                            <h4>New Store</h4>
                            <p>Fresh arrivals — fashion, food & island vibes</p>
                        </div>
                        <div class="floor-item">
                            <h4>All Floor</h4>
                            <p>Explore every tenant across all levels</p>
                        </div>
                    </div>

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
                </div>
            </div>
        </div>
    </section>

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

                    <div class="carousel-images" id="modalCarouselImages">

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

                    <div class="carousel-indicators" id="modalCarouselIndicators">

                    </div>
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

                    <!-- Map View (Shown when clicked) -->
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="reveal" id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>The FIRST Premium Shopping Mall & Life Style Destination in Bali.</p>
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
                        <li><a href="#about">About Us</a></li>
                        <li><a href="{{ route('frontend.directory.index') }}">Tenants Directory</a></li>
                        <li><a href="#events">Events</a></li>
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
                            <p>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali 80361</p>
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

    {{-- #7 Sticky Mobile CTA Bar --}}
    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer"
            class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
            </svg>
            <span>Lokasi</span>
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
                <path
                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Hubungi</span>
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        window.FLOOR_MAPS = {
            1: "{{ asset('assets/images/floors/1st_floor.png') }}",
            2: "{{ asset('assets/images/floors/2nd_floor.png') }}"
        };
    </script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}"></script>

</body>

</html>
