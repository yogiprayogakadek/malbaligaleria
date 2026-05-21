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
            @foreach ($frontendMenus as $menu)
                <li><a href="{{ url($menu->url) }}">{{ $menu->name }}</a></li>
            @endforeach
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
