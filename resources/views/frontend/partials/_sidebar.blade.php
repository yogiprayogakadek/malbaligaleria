{{-- Sidebar Menu Component --}}
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
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/') }}#about">About</a></li>
            <li><a href="{{ url('/') }}#tenants">Tenants</a></li>
            <li><a href="{{ route('frontend.directory.index') }}">Directory</a></li>
            <li><a href="{{ url('/') }}#experience">Experience</a></li>
            <li><a href="{{ url('/') }}#events">Events</a></li>
            <li><a href="{{ route('frontend.career.index') }}">Careers</a></li>
            <li><a href="{{ url('/') }}#contact">Contact</a></li>
        </ul>
    </nav>

    {{-- Mobile Search Bar --}}
    <div class="sidebar-search">
        <div class="search-bar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text" placeholder="Search stores, brands...">
        </div>
    </div>
</div>
