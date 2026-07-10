<div class="inv-topbar">

    {{-- Toggle sidebar button --}}
    <button class="inv-topbar-toggle" id="invSidebarToggle" aria-label="Toggle sidebar">
        <iconify-icon icon="solar:hamburger-menu-line-duotone"></iconify-icon>
    </button>

    {{-- Page title & breadcrumb --}}
    <div class="inv-topbar-breadcrumb">
        <h5>@yield('page-title', 'Inventory')</h5>
        <small>@yield('page-subtitle', 'Mal Bali Galeria · Inventory System')</small>
    </div>

    {{-- Actions area --}}
    <div class="inv-topbar-actions">

        {{-- Dark mode toggle --}}
        <button class="inv-topbar-toggle moon dark-layout" aria-label="Dark mode">
            <iconify-icon icon="solar:moon-line-duotone"></iconify-icon>
        </button>
        <button class="inv-topbar-toggle sun light-layout" aria-label="Light mode" style="display:none;">
            <iconify-icon icon="solar:sun-2-line-duotone"></iconify-icon>
        </button>

        {{-- User dropdown --}}
        <div class="dropdown">
            <a class="inv-user-pill dropdown-toggle" href="javascript:void(0)"
               id="invUserDrop" data-bs-toggle="dropdown" aria-expanded="false"
               style="text-decoration:none;">
                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0f4c81&color=fff&size=64' }}"
                     alt="{{ Auth::user()->name }}">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="invUserDrop">
                <li>
                    <div class="px-4 py-3 border-bottom">
                        <div class="fw-semibold text-dark">{{ Auth::user()->name }}</div>
                        <small class="text-muted">{{ Auth::user()->getRoleNames()->first() }}</small>
                    </div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                        <iconify-icon icon="solar:user-circle-line-duotone" class="me-2"></iconify-icon>
                        My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        <iconify-icon icon="solar:arrow-left-line-duotone" class="me-2"></iconify-icon>
                        Back to Admin
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('inv-topbar-logout').submit()">
                        <iconify-icon icon="solar:logout-2-line-duotone" class="me-2"></iconify-icon>
                        Logout
                    </a>
                    <form id="inv-topbar-logout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>
