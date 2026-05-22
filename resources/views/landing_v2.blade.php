<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria | Enjoy, Play, Eat, Shop</title>
    <meta name="description"
        content="Mal Bali Galeria - The Pioneer Shopping Center in Bali. Discover premium brands, dining, and entertainment.">
    <meta name="keywords"
        content="Mal Bali Galeria, Bali Shopping Mall, Kuta Mall, Bali Lifestyle, Bali Shopping Destination">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Mal Bali Galeria | Enjoy, Play, Eat, Shop">
    <meta property="og:description"
        content="The Pioneer Shopping Center in Bali. Discover premium brands, dining, and entertainment.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Mal Bali Galeria | Enjoy, Play, Eat, Shop">
    <meta property="twitter:description"
        content="The Pioneer Shopping Center in Bali. Discover premium brands, dining, and entertainment.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() + 1 }}">

    <!-- Lenis Smooth Scroll CSS -->
    <style>
        html.lenis,
        html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }

        /* Gate Path and Label Styles */
        .map-gate-path {
            fill: none;
            stroke: #FF0000;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.8;
            filter: drop-shadow(0 0 2px rgba(255, 0, 0, 0.4));
        }

        .map-gate-label {
            position: absolute;
            background: rgba(255, 0, 0, 0.85);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 700;
            pointer-events: none;
            white-space: nowrap;
            z-index: 10;
            text-transform: uppercase;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transform: translate(-50%, -50%);
        }

        @media (max-width: 768px) {
            .map-gate-label {
                font-size: 7px;
                padding: 1px 4px;
            }
        }

        #specificDatesContainer {
            transition: all 0.3s ease;
            border-left: 3px solid var(--gold);
            background: rgba(212, 175, 55, 0.05);
            margin-top: 10px !important;
        }
    </style>
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

    @include('frontend.partials.announcement_banner')
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" id="headerLogo"
                    style="height: 30px; width: auto;">
            </a>
        </div>

        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/default/mbg.png') }}" alt="Mal Bali Galeria"
                    class="header-main-logo" style="height: 45px; width: auto; object-fit: contain;">
            </a>
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
                @foreach ($frontendMenus as $menu)
                    <li><a href="{{ url($menu->url) }}">{{ $menu->name }}</a></li>
                @endforeach
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
            <div class="hero-slide active"
                style="background-image: url('{{ asset('assets/facade/landscape.jpg') }}')">
            </div>
            {{-- <div class="hero-slide" style="background-image: url('{{ asset('assets/bg_front.jfif') }}')"></div> --}}
            {{-- <div class="hero-slide" style="background-image: url('{{ asset('assets/bg_front.jfif') }}')"></div> --}}
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
                    <span class="arrow">&rarr;</span>
                    <span class="text">Explore malbaligaleria</span>
                </button>
            </a>
        </div>
        <div class="hero-slider-dots" id="heroSliderDots" style="display: none;">
            <span class="hero-dot active" data-index="0"></span>
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
                    Bali's first mall to introduce premium retail concepts that continue to thrive, Mal Bali Galeria
                    blends refined shopping and curated dining with a vibrant calendar of unique, high-energy
                    events-delivering a sophisticated Family Mall experience where excitement, culture, and elegance
                    come together.
                    Enjoy. Play. Eat. Shop.</p> --}}

                <p>
                    Right in the vibrant heart of Kuta at the iconic Simpang Dewa Ruci, Mal Bali Galeria is where Bali
                    comes to life. As the island's pioneer of premium retail concepts, the mall continues to set the
                    standard for trendsetting brands, exciting experiences, and unforgettable moments.
                    With its signature motto, Enjoy Play Eat Shop, Mal Bali Galeria is more than a shopping
                    destination, it's a lifestyle playground. From fashion, forward retail and curated dining spots to
                    thrilling, high-energy events that light up the calendar, there's always something happening.
                    Designed as a dynamic Family Mall, it's the place where friends gather, families connect, cultures
                    meet, and excitement never stops. Every visit brings new discoveries, fresh flavors, and vibrant
                    experiences, all under one roof.
                </p>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <h3>Open Hour</h3>
                    <p>10AM - 10PM (Daily)</p>
                </div>
                <div class="info-item">
                    <h3>Address</h3>
                    <p>Simpang Dewa Ruci<br>Jl. Bypass Ngurah Rai, Kuta, Badung, Bali, Indonesia 80361</p>
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
                <button class="carousel-btn" id="prevBtn">&larr;</button>
                <button class="carousel-btn" id="nextBtn">&rarr;</button>
            </div>
        </div>
    </section>

    <section class="experience-section reveal" id="experience">
        <div class="experience-container">
            <div class="experience-header">
                <h2>What's On at MBG</h2>
                <p class="experience-subtitle">From exciting events to brand-new stores - there's always
                    something
                    happening.</p>
                <div class="header-divider"></div>
            </div>

            <div class="experience-cards">
                <a href="{{ route('frontend.event.index') }}" class="experience-card events">
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Events</h4>
                        </div>
                    </div>
                </a>

                <a href="{{ route('frontend.promotion.index') }}" class="experience-card promotion">
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Promotion</h4>
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


    {{-- ===== REGULAR SHOWS SECTION ===== --}}
    @if (isset($regularEvents) && $regularEvents->count() > 0)
        <section class="regular-shows-section reveal" id="regular-shows">
            <div class="regular-shows-container">
                <div class="regular-shows-header">
                    {{-- <div class="regular-shows-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg>
                        Live Entertainment
                    </div> --}}
                    <h2>What's Happening</h2>
                    <p class="regular-shows-subtitle">Every week, always entertaining</p>
                </div>

                <div class="regular-shows-slider-wrapper">
                    <div class="regular-shows-grid" id="regularShowsGrid">
                        @php
                            $typeLabels = [
                                'regular' => 'Regular Show',
                                'special' => 'Special Event',
                                'exhibition' => 'Exhibition',
                                'upcoming' => 'Upcoming Event',
                            ];
                        @endphp
                        @foreach ($regularEvents as $rEvent)
                            @php
                                $rDateStr = '';
                                if ($rEvent->type === 'regular') {
                                    $rDateStr = $rEvent->recurring_label ?: 'Every Weekend';
                                } else {
                                    if ($rEvent->start_date) {
                                        $rDateStr = date('d M', strtotime($rEvent->start_date));
                                        if ($rEvent->end_date && $rEvent->start_date != $rEvent->end_date) {
                                            $rDateStr .= ' - ' . date('d M Y', strtotime($rEvent->end_date));
                                        } else {
                                            $rDateStr .= ' ' . date('Y', strtotime($rEvent->start_date));
                                        }
                                    } else {
                                        $rDateStr = $rEvent->recurring_label ?: 'Event';
                                    }
                                }
                            @endphp
                            <div class="regular-show-card event-modal-trigger" style="cursor:pointer;"
                                data-event-uuid="{{ optional($rEvent)->uuid }}"
                                data-event-name="{{ optional($rEvent)->name }}"
                                data-event-date="{{ $rDateStr }}"
                                data-event-time="{{ optional($rEvent)->start_time && optional($rEvent)->end_time ? \Carbon\Carbon::parse($rEvent->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($rEvent->end_time)->format('h:i A') : 'Check Schedule' }}"
                                data-event-desc="{{ optional($rEvent)->description }}"
                                data-event-location="{{ optional($rEvent)->location }}"
                                data-event-highlight="{{ optional($rEvent)->highlights ?? '-' }}"
                                data-event-monthyear="{{ strtoupper(\Carbon\Carbon::now()->format('F Y')) }}"
                                data-event-image="{{ optional(optional($rEvent)->primaryPhoto)->path ? asset('storage/' . optional(optional($rEvent)->primaryPhoto)->path) : asset('assets/images/no_image.jpg') }}"
                                data-event-type="{{ $typeLabels[optional($rEvent)->type] ?? 'Event' }}"
                                data-event-specific-dates="{{ $rEvent->specific_dates ? json_encode($rEvent->specific_dates) : '' }}">
                                <div class="rsc-card-bg"
                                    style="background-image: url({{ optional(optional($rEvent)->primaryPhoto)->path ? asset('storage/' . $rEvent->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});">
                                </div>
                                <div class="rsc-card-content">
                                    <span class="event-date">{{ $rDateStr }}</span>
                                    <h3>{{ optional($rEvent)->name }}</h3>
                                    <p class="event-desc">
                                        {{ strtoupper(\Carbon\Carbon::now()->format('F Y')) }}
                                    </p>
                                    <span class="event-link">Learn More &rarr;</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="regular-shows-controls" id="regularShowsControls">
                    <button class="event-nav-btn" id="regularShowsPrevBtn">&larr;</button>
                    <button class="event-nav-btn" id="regularShowsNextBtn">&rarr;</button>
                </div>
            </div>
        </section>
    @endif

    <!-- EVENTS -->
    <section class="event-section reveal" id="events">
        <div class="event-container">
            <h2>Upcoming Events</h2>
            <p class="event-subtitle">Don't miss out - explore what's coming up at Mal Bali Galeria</p>
            <div class="event-slider-wrapper">
                <div class="event-grid" id="eventGrid">
                    @forelse ($events as $event)
                        @php
                            $eDateStr = '';
                            if (optional($event)->start_date) {
                                $eDateStr = date('d M', strtotime(optional($event)->start_date));
                                if (
                                    optional($event)->end_date &&
                                    optional($event)->start_date != optional($event)->end_date
                                ) {
                                    $eDateStr .= ' - ' . date('d M Y', strtotime(optional($event)->end_date));
                                } else {
                                    $eDateStr .= ' ' . date('Y', strtotime(optional($event)->start_date));
                                }
                            } else {
                                $eDateStr = optional($event)->recurring_label ?: 'Upcoming Event';
                            }
                        @endphp
                        <div class="event-card event-modal-trigger" style="cursor:pointer;"
                            data-event-uuid="{{ optional($event)->uuid }}"
                            data-event-name="{{ optional($event)->name }}" data-event-date="{{ $eDateStr }}"
                            data-event-time="{{ optional($event)->start_time && optional($event)->end_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($event->end_time)->format('h:i A') : 'All Day' }}"
                            data-event-desc="{{ optional($event)->description }}"
                            data-event-location="{{ optional($event)->location }}"
                            data-event-highlight="{{ optional($event)->highlights ?? '-' }}"
                            data-event-monthyear="{{ strtoupper(\Carbon\Carbon::now()->format('F Y')) }}"
                            data-event-image="{{ optional(optional($event)->primaryPhoto)->path ? asset('storage/' . optional(optional($event)->primaryPhoto)->path) : asset('assets/images/no_image.jpg') }}"
                            data-event-type="{{ $typeLabels[optional($event)->type] ?? 'Upcoming Event' }}"
                            data-event-specific-dates="{{ optional($event)->specific_dates ? json_encode($event->specific_dates) : '' }}">
                            <div class="rsc-card-bg"
                                style="background-image: url({{ optional(optional($event)->primaryPhoto)->path ? asset('storage/' . optional(optional($event)->primaryPhoto)->path) : asset('assets/images/no_image.jpg') }});">
                            </div>
                            <div class="rsc-card-content">
                                <span class="event-date">{{ $eDateStr }}</span>
                                <h3>{{ optional($event)->name }}</h3>
                                <p class="event-desc">
                                    {{ strtoupper(\Carbon\Carbon::now()->format('F Y')) }}
                                </p>
                                <span class="event-link">Learn More &rarr;</span>
                            </div>
                        </div>
                    @empty
                        <div class="event-empty-state">
                            <div class="empty-state-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M8 2v3M16 2v3M3.5 9.09h17M21 8.5V17c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V8.5c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5Z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="m11.995 13.7h.01M11.995 16.7h.01M8.291 13.7h.01M8.291 16.7h.01M15.701 13.7h.01M15.701 16.7h.01"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>
                            <h3>No events scheduled at the moment</h3>
                            <p>Check back soon for exciting upcoming events and activities at Mal Bali Galeria.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="event-controls {{ !isset($events) || $events->count() <= 1 ? 'hidden' : '' }}"
                id="eventControls">
                <button class="event-nav-btn" id="eventPrevBtn">&larr;</button>
                <button class="event-nav-btn" id="eventNextBtn">&rarr;</button>
            </div>
        </div>
    </section>

    {{-- ===== EXHIBITION SECTION ===== --}}
    <section class="event-section reveal" id="exhibition">
        <div class="event-container">
            <h2>Exhibition</h2>
            <p class="event-subtitle">Discover exclusive exhibitions and unique experiences at Mal Bali Galeria</p>
            <div class="event-slider-wrapper">
                <div class="event-grid" id="exhibitionGrid">
                    @forelse ($exhibitionEvents ?? [] as $exEvent)
                        @php
                            $exDateStr = '';
                            if (optional($exEvent)->start_date) {
                                $exDateStr = date('d M', strtotime(optional($exEvent)->start_date));
                                if (
                                    optional($exEvent)->end_date &&
                                    optional($exEvent)->start_date != optional($exEvent)->end_date
                                ) {
                                    $exDateStr .= ' - ' . date('d M Y', strtotime(optional($exEvent)->end_date));
                                } else {
                                    $exDateStr .= ' ' . date('Y', strtotime(optional($exEvent)->start_date));
                                }
                            }
                        @endphp
                        <div class="event-card event-modal-trigger" style="cursor:pointer;"
                            data-event-uuid="{{ optional($exEvent)->uuid }}"
                            data-event-name="{{ optional($exEvent)->name }}" data-event-date="{{ $exDateStr }}"
                            data-event-time="{{ $exEvent && property_exists($exEvent, 'start_time') && $exEvent->start_time && property_exists($exEvent, 'end_time') && $exEvent->end_time ? \Carbon\Carbon::parse($exEvent->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($exEvent->end_time)->format('h:i A') : 'All Day' }}"
                            data-event-desc="{{ isset($exEvent->description) ? $exEvent->description : '' }}"
                            data-event-location="{{ isset($exEvent->location) ? $exEvent->location : '' }}"
                            data-event-highlight="{{ isset($exEvent->highlights) ? $exEvent->highlights : '-' }}"
                            data-event-monthyear="{{ $exEvent && isset($exEvent->start_date) ? strtoupper(\Carbon\Carbon::parse($exEvent->start_date)->format('F Y')) : strtoupper(\Carbon\Carbon::now()->format('F Y')) }}"
                            data-event-image="{{ $exEvent && isset($exEvent->primaryPhoto) && isset($exEvent->primaryPhoto->path) ? asset('storage/' . $exEvent->primaryPhoto->path) : asset('assets/images/no_image.jpg') }}"
                            data-event-type="{{ $exEvent && isset($exEvent->type) && isset($typeLabels[$exEvent->type]) ? $typeLabels[$exEvent->type] : 'Exhibition' }}">
                            <div class="rsc-card-bg"
                                style="background-image: url({{ $exEvent && isset($exEvent->primaryPhoto) && isset($exEvent->primaryPhoto->path) ? asset('storage/' . $exEvent->primaryPhoto->path) : asset('assets/images/no_image.jpg') }});">
                            </div>
                            <div class="rsc-card-content">
                                <span class="event-date">{{ $exDateStr }}</span>
                                <h3>{{ isset($exEvent->name) ? $exEvent->name : '' }}</h3>
                                <p class="event-desc">
                                    {{ $exEvent && isset($exEvent->start_date) ? strtoupper(\Carbon\Carbon::parse($exEvent->start_date)->format('F Y')) : strtoupper(\Carbon\Carbon::now()->format('F Y')) }}
                                </p>
                                <span class="event-link">Learn More &rarr;</span>
                            </div>
                        </div>
                    @empty
                        <div class="event-empty-state">
                            <div class="empty-state-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M8 2v3M16 2v3M3.5 9.09h17M21 8.5V17c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V8.5c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5Z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="m11.995 13.7h.01M11.995 16.7h.01M8.291 13.7h.01M8.291 16.7h.01M15.701 13.7h.01M15.701 16.7h.01"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>
                            <h3>No exhibitions scheduled at the moment</h3>
                            <p>Stay tuned for upcoming exclusive experiences and unique showcases at Mal Bali Galeria.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="event-controls {{ !isset($exhibitionEvents) || $exhibitionEvents->count() <= 1 ? 'hidden' : '' }}"
                id="exhibitionControls">
                <button class="event-nav-btn" id="exhibitionPrevBtn">&larr;</button>
                <button class="event-nav-btn" id="exhibitionNextBtn">&rarr;</button>
            </div>
        </div>
    </section>

    {{-- ===== LIVE IG FEED SECTION ===== --}}
    {{-- <section class="ig-feed-section reveal" id="ig-feed">
        <div class="ig-feed-container">

            <div class="ig-feed-header">
                <div class="ig-feed-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                    @malbaligaleria
                </div>
                <h2 class="ig-feed-title">Live <span>IG</span> Feed</h2>
                <p class="ig-feed-subtitle">Lihat momen terkini dari Mal Bali Galeria</p>
            </div>

            @php
                $igDummy = [
                    [
                        'img' => 'https://picsum.photos/seed/mbg1/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '1.2K',
                        'caption' => 'An amazing evening at MBG',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg2/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '894',
                        'caption' => 'Your favorite food spots are here',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg3/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '2.1K',
                        'caption' => 'LED Dance Butterfly every thursday',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg4/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '3.4K',
                        'caption' => 'New season, new style. Shop now',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg5/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '756',
                        'caption' => 'Weekends are better at Galeria',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg6/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '1.8K',
                        'caption' => 'Bali vibes at the heart of Kuta',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg7/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '990',
                        'caption' => 'Enjoy, Play, Eat, Shop',
                    ],
                    [
                        'img' => 'https://picsum.photos/seed/mbg8/600/600',
                        'link' => 'https://www.instagram.com/malbaligaleria/',
                        'likes' => '1.5K',
                        'caption' => 'Family fun every weekend',
                    ],
                ];
            @endphp

            <div class="ig-feed-grid">
                @foreach ($igDummy as $index => $post)
                    <a href="{{ $post['link'] }}" target="_blank" rel="noopener noreferrer" class="ig-feed-item"
                        data-index="{{ $index }}">
                        <img src="{{ $post['img'] }}" alt="Instagram post" loading="lazy">
                        <div class="ig-feed-overlay">
                            <div class="ig-feed-overlay-inner">
                                <svg class="ig-heart-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <span class="ig-likes">{{ $post['likes'] }}</span>
                            </div>
                            <p class="ig-caption">{{ $post['caption'] }}</p>
                        </div>
                        <div class="ig-item-corner">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="ig-feed-cta">
                <div class="ig-feed-cta-inner">
                    <div class="ig-cta-avatar">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo">
                    </div>
                    <div class="ig-cta-text">
                        <strong>@malbaligaleria</strong>
                        <span>Ikuti kami untuk momen terbaru</span>
                    </div>
                    <a href="https://www.instagram.com/malbaligaleria/" target="_blank" rel="noopener noreferrer"
                        class="ig-cta-btn" id="igViewAllBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                        Lihat di Instagram
                    </a>
                </div>
            </div>

        </div>
    </section> --}}
    {{-- ===== END IG FEED SECTION ===== --}}

    <section class="map-section reveal">
        <div class="map-container">
            <h2>Tenant List</h2>
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
                            <p>Fresh arrivals - fashion, food & island vibes</p>
                        </div>
                        <div class="floor-item">
                            <h4>Favorites</h4>
                            <p>Quick access to your saved and most-loved stores</p>
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
        <div class="modal-overlay" id="modalOverlay" onclick="closeTenantModal()"></div>
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


            <div class="modal-content" data-lenis-prevent>

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
                                {{-- <span class="info-value" id="eventModalMonthYear"
                                    style="text-transform: uppercase; font-weight: 700; color: var(--gold);"></span> --}}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="event-modal-description" id="eventModalDescription"></div> --}}

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

    @include('frontend.partials.footer_v2')

    {{-- #7 Sticky Mobile CTA Bar --}}
    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer"
            class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
            </svg>
            <span>Location</span>
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
                    onclick="document.getElementById('shareMenu').classList.remove('active')">Ã—</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script>
        window.FLOOR_MAPS = {
            1: "{{ asset('assets/images/floors/1st_floor.png') }}",
            2: "{{ asset('assets/images/floors/2nd_floor.png') }}"
        };
    </script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}?v={{ time() }}"></script>


</body>

</html>
