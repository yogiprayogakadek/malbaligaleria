<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - Mal Bali Galeria</title>
    <meta name="description" content="Join the Mal Bali Galeria team. Find job vacancies and realize your dream career at Bali's leading shopping center.">
    <meta name="keywords" content="Job Vacancies Bali, Mal Bali Galeria Careers, Jobs Bali, Kuta Recruitment">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/career') }}">
    <meta property="og:title" content="Careers - Mal Bali Galeria">
    <meta property="og:description" content="Join the Mal Bali Galeria team and realize your dream career.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,400&display=swap" rel="stylesheet">
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
    @include('frontend.partials.announcement_banner')
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
                @foreach ($frontendMenus as $menu)
                    <li>
                        <a href="{{ url($menu->url) }}" 
                           class="{{ request()->url() == url($menu->url) ? 'active-nav' : '' }}">
                            {{ $menu->name }}
                        </a>
                    </li>
                @endforeach
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

    {{-- Hero Section --}}
    <section class="career-hero">
        <div class="career-hero-content">
            <span class="career-hero-eyebrow">Mal Bali Galeria • Careers</span>
            <h1 class="career-hero-title">Shape Your Future in <span>Bali</span></h1>
            <p class="career-hero-subtitle">
                Join our team and build a rewarding career at Bali's premier shopping and lifestyle destination.
            </p>
            <a href="{{ url('/') }}" class="career-hero-back">
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
                <p>Explore opportunities matching your professional skills and aspirations</p>
                <div class="career-divider"></div>
            </div>

            {{-- Filter Bar --}}
            <div class="career-filter-bar career-reveal">
                <div class="filter-group">
                    <span class="career-filter-label">Department:</span>
                    <div class="career-dropdown" id="deptDropdown">
                        <div class="career-dropdown-toggle">
                            <span id="selectedDeptName">All Departments</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                        </div>
                        <div class="career-dropdown-menu">
                            <div class="career-dropdown-item active" data-filter="all">All Departments</div>
                            @foreach($departments as $dept)
                                <div class="career-dropdown-item" data-filter="{{ Str::slug($dept) }}" data-dept="{{ $dept }}">{{ $dept }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="career-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" /><path d="M21 21l-4.35-4.35" stroke-linecap="round" />
                    </svg>
                    <input type="text" id="vacancySearch" placeholder="Search positions...">
                </div>
            </div>

            {{-- Vacancy Grid --}}
            <div class="vacancy-grid" id="vacancyGrid">
                @forelse($vacancies as $vacancy)
                    <div class="vacancy-card career-reveal"
                         data-dept="{{ Str::slug($vacancy->department) }}"
                         data-title="{{ strtolower($vacancy->title) }}"
                         data-dept-name="{{ $vacancy->department }}">

                        <div class="vacancy-card-top">
                            <span class="vacancy-dept-chip">{{ $vacancy->department }}</span>
                            <div class="vacancy-badges">
                                <span class="vacancy-badge badge-{{ $vacancy->type }}">{{ $vacancy->type_label }}</span>
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
                            <div class="vacancy-actions">
                                <button type="button" class="vacancy-card-share-btn" 
                                        data-url="{{ route('frontend.career.show', $vacancy->slug ?: $vacancy->uuid) }}"
                                        data-title="{{ $vacancy->title }}"
                                        title="Share Vacancy">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="18" cy="5" r="3" />
                                        <circle cx="6" cy="12" r="3" />
                                        <circle cx="18" cy="19" r="3" />
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                                    </svg>
                                </button>
                                @if(!$vacancy->isExpired())
                                    <a href="{{ route('frontend.career.show', $vacancy->slug ?: $vacancy->uuid) }}" class="vacancy-apply-btn">
                                        View Role
                                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <span style="font-size:12px; color:#eb5757; font-weight:600; padding:6px 14px; background:rgba(235,87,87,0.12); border-radius:100px;">Closed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="career-empty" style="grid-column: 1/-1;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        </svg>
                        <h3>No Vacancies Open</h3>
                        <p>Currently, there are no open positions. Please check back soon!</p>
                    </div>
                @endforelse
            </div>

            {{-- No match message --}}
            <div id="noMatchState">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:56px;height:56px;stroke:var(--gold);opacity:0.4;margin-bottom:16px;">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
                </svg>
                <h3 style="font-family:var(--font-display);color:var(--text-primary);margin-bottom:8px;">No matching positions</h3>
                <p style="color:var(--text-secondary);font-size:14px;">Try searching with different keywords or clearing filters.</p>
            </div>
        </div>
    </section>

    @include('frontend.partials.share_menu')
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

        // Filter logic
        const cards = document.querySelectorAll('.vacancy-card');
        const noMatch = document.getElementById('noMatchState');
        const searchInput = document.getElementById('vacancySearch');

        searchInput.addEventListener('input', filterCards);

        // Custom Dropdown Logic
        const dropdown = document.getElementById('deptDropdown');
        const dropdownToggle = dropdown.querySelector('.career-dropdown-toggle');
        const dropdownMenu = dropdown.querySelector('.career-dropdown-menu');
        const dropdownItems = dropdown.querySelectorAll('.career-dropdown-item');
        const selectedText = document.getElementById('selectedDeptName');

        dropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });

        dropdownItems.forEach(item => {
            item.addEventListener('click', () => {
                dropdownItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                selectedText.textContent = item.textContent;
                dropdown.classList.remove('active');
                
                // Trigger filter
                filterDropdown(item.dataset.filter);
            });
        });

        document.addEventListener('click', () => {
            dropdown.classList.remove('active');
        });

        function filterDropdown(filter) {
            const searchTerm = searchInput.value.toLowerCase().trim();
            let visible = 0;

            cards.forEach(card => {
                const deptMatch = filter === 'all' || card.dataset.dept === filter;
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

        function filterCards() {
            const activeFilter = dropdown.querySelector('.career-dropdown-item.active')?.dataset.filter || 'all';
            filterDropdown(activeFilter);
        }
        window.filterCards = filterCards;

        // Share Vacancy
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.vacancy-card-share-btn');
            if (btn && window.openShareMenu) {
                const url = btn.dataset.url;
                const title = btn.dataset.title;
                window.openShareMenu({
                    name: title,
                    url: url,
                    type: 'Vacancy',
                    text: `Check out this vacancy at Mal Bali Galeria: ${title}`
                });
            }
        });
    });
    </script>
</body>
</html>
