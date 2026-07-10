<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

@include('templates.inventory.partials.head')

<body class="link-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/images/logo.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <!-- Sidebar Start -->
        @include('templates.inventory.partials.sidebar')
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Header Start -->
            @include('templates.inventory.partials.topbar')
            <!--  Header End -->

            <div class="body-wrapper">
                <div class="container-fluid">

                    <div class="card card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="d-sm-flex align-items-center justify-space-between">
                                    <h4 class="fw-semibold fs-4 mb-4 mb-md-0 card-title">@yield('page-title', 'Inventory')</h4>
                                    <nav aria-label="breadcrumb" class="ms-auto">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item d-flex align-items-center">
                                                <a class="text-muted text-decoration-none d-flex"
                                                    href="@yield('page-link', '#')">
                                                    <iconify-icon icon="solar:home-2-line-duotone"
                                                        class="fs-6"></iconify-icon>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">
                                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                                    @yield('page-title', 'Inventory')
                                                </span>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <iconify-icon icon="solar:check-circle-line-duotone" class="me-2 fs-5"></iconify-icon>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <iconify-icon icon="solar:close-circle-line-duotone" class="me-2 fs-5"></iconify-icon>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- CONTENT --}}
                    @yield('content')
                    {{-- END CONTENT --}}
                    @yield('additional-content')
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <!-- Import Js Files -->
        @include('templates.inventory.partials.script')

        <!-- Additional Scripts from Child Views -->
        @stack('scripts')
</body>
</html>
