<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vacancy->title }} - Careers Mal Bali Galeria</title>
    <meta name="description" content="Apply for {{ $vacancy->title }} position at Mal Bali Galeria, {{ $vacancy->department }}. {{ Str::limit($vacancy->description, 120) }}">

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
            <div class="loader-logo"><div class="loader-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image" onerror="this.style.display='none'">
            </div></div>
            <div class="loader-spinner"><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div></div>
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
        <button class="menu-btn" id="menuBtn"><span></span><span></span><span></span></button>
    </header>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo"><h2>Mal Bali Galeria<span>Enjoy, Play, Eat, Shop</span></h2></div>
        <button class="sidebar-close" id="sidebarClose"><span></span><span></span><span></span></button>
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

    {{-- Detail Hero --}}
    <div class="career-detail-hero">
        <div style="max-width:1180px;margin:0 auto;">
            <div class="career-detail-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <a href="{{ route('frontend.career.index') }}">Careers</a>
                <svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>{{ $vacancy->title }}</span>
            </div>

            <div class="vacancy-badges" style="margin-bottom:16px;">
                <span class="vacancy-badge badge-{{ $vacancy->type }}">{{ $vacancy->type_label }}</span>
                <span class="vacancy-badge" style="background:rgba(255,255,255,0.12); color:#ffffff; border:1px solid rgba(255,255,255,0.25);">{{ $vacancy->department }}</span>
                @if($vacancy->isExpired())
                    <span class="vacancy-badge badge-expired">Recruitment Closed</span>
                @endif
            </div>

            <h1 class="career-detail-title">{{ $vacancy->title }}</h1>

            <div class="career-detail-meta">
                <div class="detail-meta-item">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $vacancy->location }}
                </div>
                <div class="detail-meta-item">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $vacancy->deadline ? 'Deadline: ' . $vacancy->deadline->format('d M Y') : 'Open Recruitment' }}
                </div>
                @if($vacancy->salary_range)
                <div class="detail-meta-item">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    Salary: {{ $vacancy->salary_range }}
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Detail Body --}}
    <div class="career-detail-body-section">
        <div class="career-detail-layout">

            {{-- Left: Content --}}
            <div>
                @if(session('success'))
                    <div class="career-success-alert">
                        <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div style="background:rgba(231,76,60,0.1);border:1px solid rgba(231,76,60,0.3);border-left:4px solid #e74c3c;border-radius:14px;padding:18px 22px;margin-bottom:24px;">
                        <ul style="margin:0;padding-left:18px;font-size:14px;color:#e74c3c;font-family:var(--font-main);">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="detail-card career-reveal">
                    <div class="detail-section">
                        <h3>
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            About This Position
                        </h3>
                        @php
                            $description = array_filter(array_map('trim', explode("\n", $vacancy->description ?? '')));
                        @endphp
                        <div class="detail-content {{ count($description) > 1 ? 'structured-content' : '' }}">
                            @if(count($description) > 1)
                                <ul class="detail-list">@foreach($description as $item)<li>{{ ltrim($item, "-* \t\n\r\0\x0B") }}</li>@endforeach</ul>
                            @else
                                {{ $vacancy->description }}
                            @endif
                        </div>
                    </div>

                    <div class="detail-section">
                        <h3>
                            <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            Required Qualifications
                        </h3>
                        @php
                            $requirements = array_filter(array_map('trim', explode("\n", $vacancy->requirements ?? '')));
                        @endphp
                        <div class="detail-content {{ count($requirements) > 1 ? 'structured-content' : '' }}">
                            @if(count($requirements) > 1)
                                <ul class="detail-list">@foreach($requirements as $item)<li>{{ ltrim($item, "-* \t\n\r\0\x0B") }}</li>@endforeach</ul>
                            @else
                                {{ $vacancy->requirements }}
                            @endif
                        </div>
                    </div>

                    @if($vacancy->responsibilities)
                    <div class="detail-section">
                        <h3>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Key Responsibilities
                        </h3>
                        @php
                            $responsibilities = array_filter(array_map('trim', explode("\n", $vacancy->responsibilities ?? '')));
                        @endphp
                        <div class="detail-content {{ count($responsibilities) > 1 ? 'structured-content' : '' }}">
                            @if(count($responsibilities) > 1)
                                <ul class="detail-list">@foreach($responsibilities as $item)<li>{{ ltrim($item, "-* \t\n\r\0\x0B") }}</li>@endforeach</ul>
                            @else
                                {{ $vacancy->responsibilities }}
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Apply Sidebar --}}
            <div class="apply-sidebar">
                <div class="apply-card">
                    <div class="apply-card-header">
                        <h3>Job Summary</h3>
                    </div>
                    <div class="apply-card-body">
                        <div class="apply-quick-info">
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                                    Position
                                </span>
                                <span class="apply-info-value">{{ $vacancy->title }}</span>
                            </div>
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                    Department
                                </span>
                                <span class="apply-info-value">{{ $vacancy->department }}</span>
                            </div>
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    Type
                                </span>
                                <span class="apply-info-value">{{ $vacancy->type_label }}</span>
                            </div>
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    Location
                                </span>
                                <span class="apply-info-value">{{ $vacancy->location }}</span>
                            </div>
                            @if($vacancy->salary_range)
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    Salary
                                </span>
                                <span class="apply-info-value">{{ $vacancy->salary_range }}</span>
                            </div>
                            @endif
                            <div class="apply-info-row">
                                <span class="apply-info-label">
                                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Deadline
                                </span>
                                <span class="apply-info-value" style="{{ $vacancy->isExpired() ? 'color:#e74c3c' : '' }}">
                                    {{ $vacancy->deadline ? $vacancy->deadline->format('d M Y') : 'Open' }}
                                </span>
                            </div>
                        </div>

                        @if(!$vacancy->isExpired())
                            <button type="button" class="apply-now-btn" id="openApplyModal">
                                Apply Now &rarr;
                            </button>
                        @else
                            <div style="text-align:center;padding:12px;background:rgba(231,76,60,0.1);border-radius:100px;font-size:13px;color:#e74c3c;font-weight:600;font-family:var(--font-main);">
                                Recruitment Closed
                            </div>
                        @endif

                        @if($vacancy->flyer_path)
                            <button type="button" class="career-flyer-btn" id="openFlyerModal">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                View Job Flyer
                            </button>
                        @endif

                        <button type="button" class="career-share-btn" id="careerShareBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                            </svg>
                            Share Vacancy
                        </button>
                    </div>
                </div>

                <div class="apply-card">
                    <div class="apply-card-body" style="padding:22px 24px;">
                        <p style="font-family:var(--font-main);font-size:13.5px;color:var(--text-secondary);line-height:1.65;margin-bottom:16px;">
                            Interested in exploring more opportunities at Mal Bali Galeria?
                        </p>
                        <a href="{{ route('frontend.career.index') }}" style="display:flex;align-items:center;gap:8px;color:var(--gold-dark);font-family:var(--font-main);font-size:13.5px;font-weight:700;text-decoration:none;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            Explore All Vacancies
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Apply Modal --}}
    @if(!$vacancy->isExpired())
    <div class="apply-modal-overlay" id="applyModalOverlay"></div>
    <div class="apply-modal" id="applyModal" data-lenis-prevent>
        <div class="apply-modal-header">
            <h3>Submit Application</h3>
            <button class="apply-modal-close" id="closeApplyModal">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="apply-modal-body">
            <div class="apply-modal-info">
                <div class="modal-info-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div>
                    <p class="modal-info-label">Applying for position</p>
                    <h4 class="modal-info-title">{{ $vacancy->title }}</h4>
                </div>
            </div>
            <form action="{{ route('frontend.career.apply', $vacancy->slug ?: $vacancy->uuid) }}" method="POST" enctype="multipart/form-data" id="applyForm">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name <span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control-career" placeholder="Full name as on ID" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="form-control-career" placeholder="name@email.com" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone / WhatsApp Number <span class="required">*</span></label>
                    <input type="tel" name="phone" id="phone" class="form-control-career" placeholder="08xx-xxxx-xxxx" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address <small style="color:var(--text-secondary);text-transform:none;">(optional)</small></label>
                    <input type="text" name="address" id="address" class="form-control-career" placeholder="Current city or residence" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="cover_letter">Cover Letter <small style="color:var(--text-secondary);text-transform:none;">(optional)</small></label>
                    <textarea name="cover_letter" id="cover_letter" class="form-control-career" rows="4"
                        placeholder="Briefly describe your interest and qualifications for this role...">{{ old('cover_letter') }}</textarea>
                </div>
                <div class="form-group">
                    <label>CV / Resume <span class="required">*</span></label>
                    <div class="file-upload-area" id="fileUploadArea">
                        <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" required>
                        <div class="file-upload-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <div class="file-upload-text">
                            <strong>Click to upload</strong> or drag & drop<br>
                            <small>PDF, DOC, DOCX — Max 2MB</small>
                        </div>
                        <div class="file-name-display" id="fileNameDisplay"></div>
                    </div>
                </div>
                <button type="submit" class="submit-apply-btn" id="submitApplyBtn">
                    Submit Application
                </button>
            </form>
        </div>
    </div>
    @endif

    @if($vacancy->flyer_path)
    {{-- Flyer Modal --}}
    <div class="apply-modal-overlay" id="flyerModalOverlay"></div>
    <div class="apply-modal" id="flyerModal" data-lenis-prevent style="max-width: 620px; border-radius: 24px; overflow: hidden; background: var(--card-bg);">
        <div class="apply-modal-header" style="border-bottom: none; padding: 22px 28px; position: sticky; top: 0; background: var(--card-bg); z-index: 10; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-family:var(--font-display); font-size:1.35rem; font-weight:700; color:var(--text-primary); margin:0;">Job Flyer</h3>
            <button class="apply-modal-close" id="closeFlyerModal">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="apply-modal-body" style="padding: 0 28px 28px; max-height: calc(85vh - 72px); overflow-y: auto;">
            <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); background: var(--teal-soft); border: 1px solid var(--border);">
                <img src="{{ asset('storage/' . $vacancy->flyer_path) }}" alt="Job Flyer {{ $vacancy->title }}" style="width: 100%; height: auto; display: block; object-fit: contain;">
            </div>
        </div>
    </div>
    @endif

    @include('frontend.partials.share_menu')
    @include('frontend.partials.footer_v2')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script src="{{ asset('assets/frontend/js/landing_v2.js') }}?v={{ time() }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Reveal
        const reveals = document.querySelectorAll('.career-reveal');
        const observer = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) { setTimeout(() => e.target.classList.add('visible'), i * 100); observer.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));

        @if(!$vacancy->isExpired())
        const overlay  = document.getElementById('applyModalOverlay');
        const modal    = document.getElementById('applyModal');
        const openBtn  = document.getElementById('openApplyModal');
        const closeBtn = document.getElementById('closeApplyModal');

        const openModal  = () => {
            overlay.classList.add('active');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (window.lenis) window.lenis.stop();
        };

        const closeModal = () => {
            overlay.classList.remove('active');
            modal.classList.remove('active');
            document.body.style.overflow = '';
            if (window.lenis) window.lenis.start();
        };

        openBtn?.addEventListener('click', openModal);
        closeBtn?.addEventListener('click', closeModal);
        overlay?.addEventListener('click', closeModal);

        // Auto-open if there were validation errors
        @if($errors->any())
            openModal();
        @endif

        // File upload display
        const fileInput = document.getElementById('cv');
        const fileDisplay = document.getElementById('fileNameDisplay');
        const uploadArea = document.getElementById('fileUploadArea');

        fileInput?.addEventListener('change', e => {
            const file = e.target.files[0];
            fileDisplay.textContent = file ? '✓ ' + file.name : '';
        });

        ['dragover', 'dragenter'].forEach(evt => {
            uploadArea?.addEventListener(evt, e => { e.preventDefault(); uploadArea.classList.add('drag-over'); });
        });
        ['dragleave', 'drop'].forEach(evt => {
            uploadArea?.addEventListener(evt, () => uploadArea.classList.remove('drag-over'));
        });

        // Submit loading state
        document.getElementById('applyForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('submitApplyBtn');
            btn.disabled = true;
            btn.textContent = 'Sending Application...';
        });
        @endif

        // Success Alert
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#D4AF37',
                background: '#ffffff',
                color: '#1a1a1a',
                customClass: {
                    popup: 'swal-premium-popup',
                    confirmButton: 'swal-premium-btn'
                }
            });
        @endif

        // Flyer Modal JS
        @if($vacancy->flyer_path)
        const flyerOverlay  = document.getElementById('flyerModalOverlay');
        const flyerModal    = document.getElementById('flyerModal');
        const flyerOpenBtn  = document.getElementById('openFlyerModal');
        const flyerCloseBtn = document.getElementById('closeFlyerModal');

        const openFlyerModal  = () => {
            flyerOverlay.classList.add('active');
            flyerModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (window.lenis) window.lenis.stop();
        };

        const closeFlyerModal = () => {
            flyerOverlay.classList.remove('active');
            flyerModal.classList.remove('active');
            document.body.style.overflow = '';
            if (window.lenis) window.lenis.start();
        };

        flyerOpenBtn?.addEventListener('click', openFlyerModal);
        flyerCloseBtn?.addEventListener('click', closeFlyerModal);
        flyerOverlay?.addEventListener('click', closeFlyerModal);
        @endif

        // Share Vacancy
        const shareBtn = document.getElementById('careerShareBtn');
        if (shareBtn) {
            shareBtn.addEventListener('click', () => {
                if (window.openShareMenu) {
                    window.openShareMenu({
                        name: "{{ $vacancy->title }}",
                        url: window.location.href,
                        type: 'Vacancy',
                        text: "Check out this vacancy at Mal Bali Galeria: {{ $vacancy->title }}"
                    });
                }
            });
        }
    });
    </script>
</body>
</html>
