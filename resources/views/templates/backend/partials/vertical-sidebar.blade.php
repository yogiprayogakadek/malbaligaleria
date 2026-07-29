<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->

        <div>

            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;" />
                    <span class="hide-menu ms-2 fw-bold text-dark fs-5"
                        style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Mal Bali Galeria</span>
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
                    @php
                        $boardVisibilitySetting = \App\Models\Setting::where('pages', 'dashboard_menu')
                            ->where('name', 'calendar_kanban_visibility')
                            ->where('is_active', true)
                            ->first();
                        $allowedBoardRoles = $boardVisibilitySetting ? ($boardVisibilitySetting->payload['roles'] ?? []) : [];
                        $userHasBoardAccess = auth()->user()->hasRole('superuser') || collect($allowedBoardRoles)->contains(function($role) {
                            return auth()->user()->hasRole($role);
                        });
                        $hasHomeAccess = auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view dashboard') || auth()->user()->hasRole('tenant') || $userHasBoardAccess;
                    @endphp

                    @if($hasHomeAccess)
                        <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-home">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Home</span>
                            <span class="section-toggle-icon hide-menu">
                                <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </span>
                        </li>
                        <div class="sidebar-section-items" id="section-home">
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view dashboard') || auth()->user()->hasRole('tenant'))
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ auth()->user()->hasRole('tenant') ? route('tenant.dashboard') : route('admin.dashboard') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                            </li>
                            @endif

                            @if($userHasBoardAccess)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.event-board.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:calendar-date-line-duotone" class=""></iconify-icon>
                                    <span class="hide-menu">Event Board</span>
                                </a>
                            </li>
                            @endif
                        </div>
                    @endif


                    <!-- SYSTEM ADMIN CATEGORY -->
                    @role('superuser')
                        <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-system-admin">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">System Admin</span>
                            <span class="section-toggle-icon hide-menu">
                                <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </span>
                        </li>
                        <div class="sidebar-section-items" id="section-system-admin">
                            <!-- Activity Logs -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.activity.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:history-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Activity Logs</span>
                                </a>
                            </li>
                            <!-- Database Backups -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.backup.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:database-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Database Backups</span>
                                </a>
                            </li>
                            <!-- Error Logs -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.logs.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:document-text-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Error Logs</span>
                                </a>
                            </li>
                            <!-- Frontend Menu Visibility -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.menu.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:menu-dots-bold-duotone"></iconify-icon>
                                    <span class="hide-menu">Frontend Menus</span>
                                </a>
                            </li>
                            <!-- Media Cleanup -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.media-cleanup.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:folder-error-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Media Cleanup</span>
                                </a>
                            </li>
                            <!-- Image Compressor -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.image-compression.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:gallery-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Image Compressor</span>
                                </a>
                            </li>
                            <!-- User -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:user-circle-line-duotone"></iconify-icon>
                                    <span class="hide-menu">User</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.user.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.user.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Visitor Logs -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.visitors.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:graph-up-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Visitor Logs</span>
                                </a>
                            </li>
                            <!-- Role & Permission -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.role-permission.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:shield-keyhole-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Role & Permission</span>
                                </a>
                            </li>
                            <!-- Subdomain Access -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.subdomain-access.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:user-check-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Subdomain Access</span>
                                </a>
                            </li>
                            <!-- IP Whitelist -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.ip-whitelist.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:shield-network-line-duotone"></iconify-icon>
                                    <span class="hide-menu">IP Whitelist</span>
                                </a>
                            </li>
                            <!-- Inventory -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:box-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Inventory</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('inventory.assets.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Assets List</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('inventory.categories.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Categories</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    @endrole

                    <!-- CONTENT MANAGEMENT CATEGORY -->
                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasAnyPermission(['view category tenants', 'view tenants', 'view events', 'view gallery', 'view promo']))
                        <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-content">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Content Management</span>
                            <span class="section-toggle-icon hide-menu">
                                <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </span>
                        </li>
                        <div class="sidebar-section-items" id="section-content">
                            <!-- Category Tenants -->
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view category tenants'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:layers-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Category Tenants</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.category.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create category tenants'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.category.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            <!-- Events -->
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view events'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:calendar-mark-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Events</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.event.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create events'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.event.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow {{ request()->routeIs('admin.event.photo*') ? 'active' : '' }}"
                                            href="javascript:void(0)" aria-expanded="false">
                                            <iconify-icon icon="solar:album-line-duotone"></iconify-icon>
                                            <span class="hide-menu">Photo</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse two-level">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('admin.event.photo.index') }}">
                                                    <span class="icon-small"></span>
                                                    <span class="hide-menu">List</span>
                                                </a>
                                            </li>
                                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create events'))
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('admin.event.photo.create') }}">
                                                    <span class="icon-small"></span>
                                                    <span class="hide-menu">Create</span>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <!-- Gallery -->
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view gallery'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:album-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Gallery</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.gallery.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create gallery'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.gallery.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            <!-- Promo -->
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view promo'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:tag-price-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Promo</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.promo.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create promo'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.promo.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            <!-- Tenants -->
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view tenants'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:shop-2-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Tenants</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.tenant.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create tenants'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.tenant.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow {{ request()->routeIs('admin.tenant.photo*') ? 'active' : '' }}"
                                            href="javascript:void(0)" aria-expanded="false">
                                            <iconify-icon icon="solar:album-line-duotone"></iconify-icon>
                                            <span class="hide-menu">Photo</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse two-level">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('admin.tenant.photo.index') }}">
                                                    <span class="icon-small"></span>
                                                    <span class="hide-menu">List</span>
                                                </a>
                                            </li>
                                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create tenants'))
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('admin.tenant.photo.create') }}">
                                                    <span class="icon-small"></span>
                                                    <span class="hide-menu">Create</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('admin.tenant.photo.bulk.create') }}">
                                                    <span class="icon-small"></span>
                                                    <span class="hide-menu">Bulk Insert</span>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </div>
                    @endif

                    <!-- HUMAN RESOURCES CATEGORY -->
                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view careers'))
                        <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-hr">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Human Resources</span>
                            <span class="section-toggle-icon hide-menu">
                                <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </span>
                        </li>
                        <div class="sidebar-section-items" id="section-hr">
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:case-minimalistic-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Careers</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.career.vacancy.index') }}">
                                            <iconify-icon icon="solar:document-text-line-duotone" class="fs-4 me-1"></iconify-icon>
                                            <span class="hide-menu">Vacancies</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.career.application.index') }}">
                                            <iconify-icon icon="solar:users-group-two-rounded-line-duotone" class="fs-4 me-1"></iconify-icon>
                                            <span class="hide-menu">Applications</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.career.email-logs.index') }}">
                                            <iconify-icon icon="solar:letter-line-duotone" class="fs-4 me-1"></iconify-icon>
                                            <span class="hide-menu">Email Logs</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    @endif

                    <!-- SETTINGS CATEGORY -->
                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasAnyPermission(['view settings', 'view announcements']))
                        <li class="nav-small-cap sidebar-section-header hide-menu" data-section="section-settings">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Settings & Tools</span>
                            <span class="section-toggle-icon hide-menu">
                                <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </span>
                        </li>
                        <div class="sidebar-section-items" id="section-settings">
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view settings'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:settings-linear"></iconify-icon>
                                    <span class="hide-menu">Settings</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.setting.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create settings'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.setting.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('view announcements'))
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:volume-loud-linear"></iconify-icon>
                                    <span class="hide-menu">Announcement</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.announcement.index') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasRole('superuser') || auth()->user()->hasPermissionTo('create announcements'))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('admin.announcement.create') }}">
                                            <span class="icon-small"></span>
                                            <span class="hide-menu">Create</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if(auth()->user()->hasRole('superuser') || auth()->user()->hasRole('admin'))
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.recycle-bin.index') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:trash-bin-trash-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Recycle Bin</span>
                                </a>
                            </li>
                            @endif
                        </div>
                    @endif

                </ul>
            </nav>

            <script>
                (function () {
                    const STORAGE_KEY = 'mbg_sidebar_sections';

                    // Load persisted state from localStorage
                    function loadState() {
                        try {
                            return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
                        } catch (e) {
                            return {};
                        }
                    }

                    // Save state to localStorage
                    function saveState(state) {
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                    }

                    // Check if a section contains an active link
                    function sectionHasActiveLink(sectionEl) {
                        return sectionEl.querySelector('.sidebar-link.active') !== null;
                    }

                    function initSections() {
                        const state = loadState();
                        const headers = document.querySelectorAll('.sidebar-section-header');

                        headers.forEach(function (header) {
                            const sectionId = header.dataset.section;
                            const sectionEl = document.getElementById(sectionId);
                            if (!sectionEl) return;

                            // Determine initial collapsed state:
                            // - If the section contains an active link, always expand it
                            // - Otherwise fall back to persisted state (default: expanded)
                            let isCollapsed;
                            if (sectionHasActiveLink(sectionEl)) {
                                isCollapsed = false;
                            } else if (sectionId in state) {
                                isCollapsed = state[sectionId];
                            } else {
                                isCollapsed = false; // default expanded
                            }

                            applyState(header, sectionEl, isCollapsed, false);

                            header.addEventListener('click', function () {
                                const collapsed = sectionEl.classList.contains('section-collapsed');
                                const newCollapsed = !collapsed;

                                // Never allow collapsing a section with an active link
                                if (!newCollapsed === false && sectionHasActiveLink(sectionEl)) {
                                    return;
                                }

                                applyState(header, sectionEl, newCollapsed, true);

                                const updatedState = loadState();
                                updatedState[sectionId] = newCollapsed;
                                saveState(updatedState);
                            });
                        });
                    }

                    function applyState(header, sectionEl, isCollapsed, animate) {
                        if (!animate) {
                            sectionEl.style.transition = 'none';
                        } else {
                            sectionEl.style.transition = '';
                        }

                        if (isCollapsed) {
                            sectionEl.classList.add('section-collapsed');
                            header.classList.add('section-collapsed-header');
                        } else {
                            sectionEl.classList.remove('section-collapsed');
                            header.classList.remove('section-collapsed-header');
                        }

                        if (!animate) {
                            // Force reflow to apply instant state
                            sectionEl.offsetHeight;
                            sectionEl.style.transition = '';
                        }
                    }

                    // Initialize after DOM is ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initSections);
                    } else {
                        initSections();
                    }
                })();
            </script>

        </div>
    </div>
</aside>
