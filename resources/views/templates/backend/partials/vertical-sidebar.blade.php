<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->

        <div>

            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/index.html"
                    class="text-nowrap logo-img">
                    <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/dark-logo.svg"
                        class="dark-logo" alt="MaterialM-img" />
                    <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/light-logo.svg"
                        class="light-logo" alt="MaterialM-img" />
                </a>
            </div>

            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                <ul class="sidebar-menu" id="sidebarnav">
                    <!-- ---------------------------------- -->
                    <!-- Home -->
                    <!-- ---------------------------------- -->
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                        <span class="hide-menu">Menu</span>
                    </li>

                    <!-- ---------------------------------- -->
                    <!-- Category Tenants -->
                    <!-- ---------------------------------- -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-line-duotone"></iconify-icon>
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

                    <!-- ---------------------------------- -->
                    <!-- Tenants -->
                    <!-- ---------------------------------- -->

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-line-duotone"></iconify-icon>
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
                        </ul>
                    </li>

                    <!-- ---------------------------------- -->
                    <!-- Tenants Photo -->
                    <!-- ---------------------------------- -->

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-line-duotone"></iconify-icon>
                            <span class="hide-menu">Tenant Photos</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
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
                        </ul>
                    </li>

                    <!-- ---------------------------------- -->
                    <!-- Events -->
                    <!-- ---------------------------------- -->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-angle-broken"></iconify-icon>
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
                        </ul>
                    </li>

                    <!-- ---------------------------------- -->
                    <!-- Events Photo -->
                    <!-- ---------------------------------- -->

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-line-duotone"></iconify-icon>
                            <span class="hide-menu">Event Photos</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
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

                    <!-- ---------------------------------- -->
                    <!-- Promo -->
                    <!-- ---------------------------------- -->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-angle-broken"></iconify-icon>
                            <span class="hide-menu">Promo</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="javascript:void(0)">
                                    <span class="icon-small"></span>
                                    <span class="hide-menu">List</span>

                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="javascript:void(0)">
                                    <span class="icon-small"></span>
                                    <span class="hide-menu">Create</span>

                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ---------------------------------- -->
                    <!-- Settings -->
                    <!-- ---------------------------------- -->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <iconify-icon icon="solar:wheel-angle-broken"></iconify-icon>
                            <span class="hide-menu">Settings</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="javascript:void(0)">
                                    <span class="icon-small"></span>
                                    <span class="hide-menu">List</span>

                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="javascript:void(0)">
                                    <span class="icon-small"></span>
                                    <span class="hide-menu">Create</span>

                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>

        </div>
    </div>
</aside>
