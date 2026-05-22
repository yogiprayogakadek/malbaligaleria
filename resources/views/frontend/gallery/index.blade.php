<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Mal Bali Galeria</title>
    <meta name="description"
        content="Explore the gallery of Mal Bali Galeria. See the vibrant shopping center, beautiful plazas, cozy dining areas, and upcoming events.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Gallery | Mal Bali Galeria">
    <meta property="og:description" content="Explore the gallery of Mal Bali Galeria.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Gallery | Mal Bali Galeria">
    <meta property="twitter:description" content="Explore the gallery of Mal Bali Galeria.">
    <meta property="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/gallery.css') }}?v={{ time() }}">

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
    </style>
</head>

<body class="gallery-page">
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
            <p class="loader-text">LOADING...</p>
        </div>
    </div>

    <div class="gallery-main">
        <!-- Toggle & Header -->
        <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
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

        <!-- Promo Hero Banner -->
        <section class="promo-hero-banner">
            <div class="promo-hero-content reveal">
                <span class="promo-hero-eyebrow">Visual Tour</span>
                <h1 class="promo-hero-title">Mall Gallery</h1>
                <p class="promo-hero-subtitle">Capture the vibrant moments, events, and shopping experiences at Mal Bali Galeria.</p>
                <a href="{{ route('frontend.landing') }}" class="promo-hero-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Home
                </a>
            </div>
        </section>

        <!-- Gallery Grid Section -->
        <section class="gallery-grid-container">
            <div class="gallery-grid">
                @forelse ($photos as $photo)
                    @php
                        $imagePath = str_starts_with($photo->path, 'http') ? $photo->path : asset('storage/' . $photo->path);
                    @endphp
                    <div class="gallery-item reveal @if($loop->index >= 8) gallery-hidden d-none @endif" data-path="{{ $imagePath }}" data-title="{{ $photo->title }}">
                        <img src="{{ $imagePath }}" alt="{{ $photo->title ?? 'Gallery Photo' }}" loading="lazy">
                        <div class="gallery-overlay">
                            <div class="gallery-actions">
                                <div class="gallery-action-btn btn-zoom" title="Zoom Photo">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        <line x1="11" y1="8" x2="11" y2="14"></line>
                                        <line x1="8" y1="11" x2="14" y2="11"></line>
                                    </svg>
                                </div>
                                <a href="{{ $imagePath }}" download="{{ $photo->title ?? 'photo' }}" class="gallery-action-btn btn-download" title="Download Photo" target="_blank">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </a>
                            </div>
                            <div class="gallery-caption">
                                <h4>{{ $photo->title ?? 'Gallery Photo' }}</h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted fs-5">No gallery photos uploaded yet.</p>
                    </div>
                @endforelse
            </div>
            @if ($photos->count() > 8)
                <div class="load-more-container">
                    <button id="btnLoadMore" class="btn-load-more">
                        <span>Load More</span>
                        <iconify-icon icon="solar:round-alt-arrow-down-bold-duotone" class="fs-5 align-middle ms-1"></iconify-icon>
                    </button>
                </div>
            @endif
        </section>

    </div> {{-- End .gallery-main --}}

    <!-- Custom Lightbox Modal -->
    <div class="lightbox-modal" id="lightboxModal">
        <button class="lightbox-btn lightbox-btn-close" id="lightboxClose" aria-label="Close lightbox">&times;</button>
        <button class="lightbox-btn lightbox-btn-share" id="lightboxShare" aria-label="Share image" title="Share Photo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px;">
                <circle cx="18" cy="5" r="3"></circle>
                <circle cx="6" cy="12" r="3"></circle>
                <circle cx="18" cy="19" r="3"></circle>
                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
            </svg>
        </button>
        <a href="#" download class="lightbox-btn lightbox-btn-download" id="lightboxDownload" aria-label="Download image" target="_blank">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px;">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
        </a>
        <button class="lightbox-btn lightbox-btn-prev" id="lightboxPrev" aria-label="Previous image">&#10094;</button>
        <button class="lightbox-btn lightbox-btn-next" id="lightboxNext" aria-label="Next image">&#10095;</button>

        <div class="lightbox-content-wrapper">
            <div class="lightbox-image-container">
                <img class="lightbox-image" id="lightboxImage" src="" alt="Zoomed Photo">
            </div>
            <div class="lightbox-info">
                <h3 id="lightboxCaption">Gallery Photo</h3>
            </div>
        </div>
    </div>

    @include('frontend.partials.footer_v2', ['disableFooterVisitorScript' => true])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/frontend/js/gallery.js') }}?v={{ time() }}"></script>

    <script>
        // Scroll Reveal logic matching other pages
        function revealElements() {
            const reveals = document.querySelectorAll('.reveal');
            const windowHeight = window.innerHeight;
            const revealPoint = 100;

            reveals.forEach(reveal => {
                const revealTop = reveal.getBoundingClientRect().top;
                if (revealTop < windowHeight - revealPoint) {
                    reveal.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealElements);
        document.addEventListener('DOMContentLoaded', revealElements);
        revealElements();
    </script>

    {{-- Lenis Smooth Scroll --}}
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                autoRaf: true
            });
        });
    </script>
</body>

</html>
