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

            <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                <ul class="sidebar-menu" id="sidebarnav">

                    <!-- HOME CATEGORY -->
                    @role(['admin', 'superuser', 'hr'])
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                    @endrole

                    <!-- SYSTEM ADMIN CATEGORY -->
                    @role('superuser')
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">System Admin</span>
                        </li>
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
                    @endrole

                    <!-- CONTENT MANAGEMENT CATEGORY -->
                    @role(['admin', 'superuser'])
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Content Management</span>
                        </li>
                        <!-- Category Tenants -->
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.category.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Events -->
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.event.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
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
                                        <li class="sidebar-item">
                                            <a class="sidebar-link" href="{{ route('admin.event.photo.create') }}">
                                                <span class="icon-small"></span>
                                                <span class="hide-menu">Create</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Gallery -->
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.gallery.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Promo -->
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.promo.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Tenants -->
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.tenant.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
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
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endrole

                    <!-- HUMAN RESOURCES CATEGORY -->
                    @role(['hr', 'superuser'])
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Human Resources</span>
                        </li>
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
                    @endrole

                    <!-- SETTINGS CATEGORY -->
                    @role('superuser')
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                            <span class="hide-menu">Settings</span>
                        </li>
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
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.setting.create') }}">
                                        <span class="icon-small"></span>
                                        <span class="hide-menu">Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole

                </ul>
            </nav>

        </div>
    </div>
</aside>
