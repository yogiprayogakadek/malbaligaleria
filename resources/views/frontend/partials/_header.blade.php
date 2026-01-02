{{-- Header Component --}}
<header>
    @if($showSearch ?? false)
    <div class="search-container">
        <div class="search-bar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text" placeholder="Search stores, brands...">
        </div>
    </div>
    @else
    <div class="header-left">
        <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
            <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;">
        </a>
    </div>
    @endif

    <div class="logo">
        <h1>mal bali galeria<span>SHOPPING CENTER</span></h1>
    </div>

    <button class="menu-btn" id="menuBtn">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>
