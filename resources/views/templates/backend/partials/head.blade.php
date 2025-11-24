<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png"
        href="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/favicon.png" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/styles.css') }}" />
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.js') }}"></script>

    {{-- STACK CSS --}}
    @stack('css')

    <title>Aksara Bali Tour | @yield('page-title')</title>
</head>
