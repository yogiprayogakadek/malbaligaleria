<aside class="inv-sidebar" id="invSidebar">

    {{-- Brand --}}
    <a href="{{ route('inventory.index') }}" class="inv-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo">
        <div>
            <div class="inv-brand-name">Mal Bali Galeria</div>
            <div class="inv-brand-sub">Inventory System</div>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="inv-nav">
        <ul style="list-style: none; padding: 0; margin: 0;">

            {{-- MAIN --}}
            <li class="inv-section-title">Main</li>

            <li class="inv-nav-item">
                <a href="{{ route('inventory.index') }}"
                   class="{{ request()->routeIs('inventory.index') ? 'active' : '' }}">
                    <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                    <span class="inv-nav-label">Dashboard</span>
                </a>
            </li>

            {{-- ASSETS --}}
            <li class="inv-section-title">Assets</li>

            <li class="inv-nav-item">
                <a href="{{ route('inventory.assets.index') }}"
                   class="{{ request()->routeIs('inventory.assets.*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:box-line-duotone"></iconify-icon>
                    <span class="inv-nav-label">All Assets</span>
                </a>
            </li>

            <li class="inv-nav-item">
                <a href="{{ route('inventory.assets.create') }}"
                   class="{{ request()->routeIs('inventory.assets.create') ? 'active' : '' }}">
                    <iconify-icon icon="solar:add-square-line-duotone"></iconify-icon>
                    <span class="inv-nav-label">Add Asset</span>
                </a>
            </li>

            {{-- CATEGORIES --}}
            <li class="inv-section-title">Management</li>

            <li class="inv-nav-item">
                <a href="{{ route('inventory.categories.index') }}"
                   class="{{ request()->routeIs('inventory.categories.*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:folder-with-files-line-duotone"></iconify-icon>
                    <span class="inv-nav-label">Categories</span>
                </a>
            </li>

            {{-- SYSTEM --}}
            <li class="inv-section-title">System</li>

            <li class="inv-nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:arrow-left-line-duotone"></iconify-icon>
                    <span class="inv-nav-label">Back to Admin</span>
                </a>
            </li>

        </ul>
    </nav>

    {{-- Sidebar Footer --}}
    <div class="inv-sidebar-footer">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('inv-logout-form').submit()">
            <iconify-icon icon="solar:logout-2-line-duotone"></iconify-icon>
            <span class="inv-nav-label">Logout</span>
        </a>
        <form id="inv-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

</aside>

{{-- Mobile overlay --}}
<div class="inv-sidebar-overlay" id="invSidebarOverlay"></div>
