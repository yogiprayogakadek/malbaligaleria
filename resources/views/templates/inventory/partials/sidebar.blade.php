<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->

        <div>

            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="{{ route('inventory.index') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;" />
                    <span class="hide-menu ms-2 fw-bold text-dark fs-5"
                        style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">MBG Inventory</span>
                </a>
                <div class="d-block d-xl-none sidebartoggler cursor-pointer" style="margin-right: -10px;">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>

            <style>
                /* Collapsible section wrapper */
                .sidebar-section-items {
                    overflow: hidden;
                    transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease;
                    max-height: 2000px;
                    opacity: 1;
                }
                .sidebar-section-items.section-collapsed {
                    max-height: 0 !important;
                    opacity: 0;
                    pointer-events: none;
                }

                /* Section cap header toggle button */
                .nav-small-cap {
                    cursor: pointer;
                    user-select: none;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                .nav-small-cap .section-toggle-icon {
                    display: inline-flex;
                    align-items: center;
                    transition: transform 0.3s ease;
                    color: #a1aab2;
                    margin-left: auto;
                    font-size: 14px;
                    flex-shrink: 0;
                }
                .nav-small-cap.section-collapsed-header .section-toggle-icon {
                    transform: rotate(-90deg);
                }
                .nav-small-cap:hover .section-toggle-icon {
                    color: #5d87ff;
                }
            </style>

            <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                <ul class="sidebar-menu" id="sidebarnav">

                    <!-- HOME CATEGORY -->
                    <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-home">
                        <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                        <span class="hide-menu">Home</span>
                        <span class="section-toggle-icon hide-menu">
                            <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                        </span>
                    </li>
                    <div class="sidebar-section-items" id="section-home">
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('inventory.index') ? 'active' : '' }}" href="{{ route('inventory.index') }}" aria-expanded="false">
                                <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                    </div>

                    <!-- ASSETS CATEGORY -->
                    <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-assets">
                        <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                        <span class="hide-menu">Assets</span>
                        <span class="section-toggle-icon hide-menu">
                            <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                        </span>
                    </li>
                    <div class="sidebar-section-items" id="section-assets">
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ (request()->routeIs('inventory.assets.*') && !request()->routeIs('inventory.assets.create')) ? 'active' : '' }}" href="{{ route('inventory.assets.index') }}" aria-expanded="false">
                                <iconify-icon icon="solar:box-line-duotone"></iconify-icon>
                                <span class="hide-menu">All Assets</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('inventory.assets.create') ? 'active' : '' }}" href="{{ route('inventory.assets.create') }}" aria-expanded="false">
                                <iconify-icon icon="solar:add-square-line-duotone"></iconify-icon>
                                <span class="hide-menu">Add Asset</span>
                            </a>
                        </li>
                    </div>

                    <!-- MANAGEMENT CATEGORY -->
                    <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-management">
                        <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                        <span class="hide-menu">Management</span>
                        <span class="section-toggle-icon hide-menu">
                            <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                        </span>
                    </li>
                    <div class="sidebar-section-items" id="section-management">
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('inventory.categories.*') ? 'active' : '' }}" href="{{ route('inventory.categories.index') }}" aria-expanded="false">
                                <iconify-icon icon="solar:folder-with-files-line-duotone"></iconify-icon>
                                <span class="hide-menu">Categories</span>
                            </a>
                        </li>
                    </div>

                    <!-- SYSTEM CATEGORY -->
                    <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-system">
                        <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                        <span class="hide-menu">System</span>
                        <span class="section-toggle-icon hide-menu">
                            <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                        </span>
                    </li>
                    <div class="sidebar-section-items" id="section-system">
                        @if(auth()->check() && (auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view dashboard')))
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:arrow-left-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Back to Admin</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('inventory.logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('inv-logout-form').submit();"
                               aria-expanded="false">
                                <iconify-icon icon="solar:logout-2-line-duotone"></iconify-icon>
                                <span class="hide-menu">Logout</span>
                            </a>
                            <form id="inv-logout-form" action="{{ route('inventory.logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </div>

                </ul>
            </nav>

        </div>
    </div>
</aside>
