<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers — Mal Bali Galeria</title>
    <meta name="description" content="Join the Mal Bali Galeria team. Find job vacancies and realize your dream career at Bali's leading shopping center.">
    <meta name="keywords" content="Job Vacancies Bali, Mal Bali Galeria Careers, Jobs Bali, Kuta Recruitment">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/career') }}">
    <meta property="og:title" content="Careers — Mal Bali Galeria">
    <meta property="og:description" content="Join the Mal Bali Galeria team and realize your dream career.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing_v2.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/career.css') }}?v={{ time() }}">
</head>

<body>
    {{-- Page Loader --}}
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image" onerror="this.style.display='none'">
                </div>
            </div>
            <div class="loader-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
            <div class="loader-progress"><div class="progress-bar"></div></div>
            <p class="loader-text">LOADING...</p>
        </div>
    </div>

    {{-- Dark Mode Toggle --}}
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
        <svg class="moon-icon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" /></svg>
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

    {{-- Header --}}
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" id="headerLogo" style="height: 30px; width: auto;">
            </a>
        </div>
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/default/mbg.png') }}" alt="Mal Bali Galeria" class="header-main-logo" style="height: 45px; width: auto; object-fit: contain;">
            </a>
        </div>
        <button class="menu-btn" id="menuBtn">
            <span></span><span></span><span></span>
        </button>
    </header>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>Mal Bali Galeria<span>Enjoy, Play, Eat, Shop</span></h2>
        </div>
        <button class="sidebar-close" id="sidebarClose">
            <span></span><span></span><span></span>
        </button>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/') }}#about">About</a></li>
                <li><a href="{{ route('frontend.landing') }}#regular-shows">Events</a></li>
                <li><a href="{{ route('frontend.promotion.index') }}">Promo</a></li>
                <li><a href="{{ route('frontend.new-store.index') }}">New Store</a></li>
                <li><a href="{{ route('frontend.directory.index') }}">Tenant List</a></li>
                <li><a href="{{ route('frontend.career.index') }}" class="active-nav">Careers</a></li>
                <li><a href="{{ url('/') }}#contact">Contact</a></li>
                @role(['admin', 'superuser'])
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endrole
            </ul>
        </nav>
        <div class="sidebar-search">
            <form action="{{ route('frontend.directory.index') }}" method="GET">
                <div class="search-bar">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="8" stroke-width="2" /><path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" /></svg>
                    <input type="text" name="search" placeholder="Search tenants..." autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <section class="career-hero">
        <div class="career-hero-content">
            <span class="career-hero-eyebrow">Mal Bali Galeria</span>
            <h1 class="career-hero-title">Careers</h1>
            <p class="career-hero-subtitle">
                Join our team and be part of the most iconic shopping center in Bali.
            </p>
            <a href="{{ route('frontend.landing') }}" class="career-hero-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to Home
            </a>
        </div>
    </section>

    {{-- Vacancy Section --}}
    <section class="career-section">
        <div class="career-container">
            <div class="career-section-header career-reveal">
                <h2>Available Vacancies</h2>
                <p>Choose a position that suits your skills and passion</p>
                <div class="career-divider"></div>
            </div>

            {{-- Filter Bar --}}
            <div class="career-filter-bar career-reveal">
                <span class="career-filter-label">Filter:</span>
                <div class="filter-pills">
                    <button class="filter-pill active" data-filter="all">All</button>
                    @foreach($departments as $dept)
                        <button class="filter-pill" data-filter="{{ Str::slug($dept) }}" data-dept="{{ $dept }}">{{ $dept }}</button>
                    @endforeach
                </div>
                <div class="career-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" /><path d="M21 21l-4.35-4.35" stroke-linecap="round" />
                    </svg>
                    <input type="text" id="vacancySearch" placeholder="Search positions...">
                </div>
            </div>

            {{-- Vacancy Grid --}}
            @forelse($vacancies as $vacancy)
                <div class="vacancy-grid" id="vacancyGrid">
                    {{-- rendered by JS --}}
                </div>
            @empty
            @endforelse

            <div class="vacancy-grid" id="vacancyGrid">
                @forelse($vacancies as $vacancy)
                    <div class="vacancy-card career-reveal"
                         data-dept="{{ Str::slug($vacancy->department) }}"
                         data-title="{{ strtolower($vacancy->title) }}"
                         data-dept-name="{{ $vacancy->department }}">

                        <div class="vacancy-card-header">
                            <div class="vacancy-icon">
                                <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                            </div>
                            <div class="vacancy-badges">
                                <span class="vacancy-badge badge-{{ $vacancy->type }}">{{ $vacancy->type_label }}</span>
                                <span class="vacancy-badge badge-department">{{ $vacancy->department }}</span>
                                @if($vacancy->isExpired())
                                    <span class="vacancy-badge badge-expired">Closed</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="vacancy-title">{{ $vacancy->title }}</h3>

                        <div class="vacancy-meta">
                            <div class="vacancy-meta-item">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $vacancy->location }}
                            </div>
                            @if($vacancy->salary_range)
                            <div class="vacancy-meta-item">
                                <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                {{ $vacancy->salary_range }}
                            </div>
                            @endif
                        </div>

                        <p class="vacancy-description">{{ $vacancy->description }}</p>

                        <div class="vacancy-card-footer">
                            <div class="vacancy-deadline">
                                @if($vacancy->deadline)
                                    Deadline: <span>{{ $vacancy->deadline->format('d M Y') }}</span>
                                @else
                                    <span>Open Recruitment</span>
                                @endif
                            </div>
                            @if(!$vacancy->isExpired())
                                <a href="{{ route('frontend.career.show', $vacancy->uuid) }}" class="vacancy-apply-btn">
                                    View Details
                                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            @else
                                <span style="font-size:12px; color:#e74c3c; font-weight:600;">Recruitment Closed</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="career-empty" style="grid-column: 1/-1;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        </svg>
                        <h3>No Vacancies Yet</h3>
                        <p>Currently, there are no positions available. Please visit again later.</p>
                    </div>
                @endforelse
            </div>

            {{-- No match message --}}
            <div id="noMatchState">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:60px;height:60px;stroke:var(--gold);opacity:0.3;margin-bottom:16px;">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
                </svg>
                <h3 style="font-family:var(--font-display);color:var(--dark);margin-bottom:8px;">Not found</h3>
                <p style="color:var(--text-secondary);font-size:14px;">Try different keywords or filters.</p>
            </div>
        </div>
    </section>

    @include('frontend.partials.footer_v2')

    <div class="mobile-sticky-cta" id="mobileStickyBar">
        <a href="https://maps.app.goo.gl/z1C9ELFzaXps7dNi6" target="_blank" rel="noopener noreferrer" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>Location</span>
        </a>
        <a href="{{ route('frontend.career.index') }}" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            <span>Careers</span>
        </a>
        <a href="tel:+62361755277" class="mobile-cta-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Call</span>
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}?v={{ time() }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Reveal animation
        const reveals = document.querySelectorAll('.career-reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 80);
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));

        // Filter pills
        const pills = document.querySelectorAll('.filter-pill');
        const cards = document.querySelectorAll('.vacancy-card');
        const noMatch = document.getElementById('noMatchState');
        const searchInput = document.getElementById('vacancySearch');

        function filterCards() {
            const activeFilter = document.querySelector('.filter-pill.active')?.dataset.filter || 'all';
            const searchTerm = searchInput.value.toLowerCase().trim();
            let visible = 0;

            cards.forEach(card => {
                const deptMatch = activeFilter === 'all' || card.dataset.dept === activeFilter;
                const searchMatch = !searchTerm || card.dataset.title.includes(searchTerm) || card.dataset.deptName?.toLowerCase().includes(searchTerm);
                if (deptMatch && searchMatch) {
                    card.style.display = '';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            noMatch.style.display = visible === 0 ? 'block' : 'none';
        }

        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                filterCards();
            });
        });

        searchInput.addEventListener('input', filterCards);
    });
    </script>
</body>
</html>
