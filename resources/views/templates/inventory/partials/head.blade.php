<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />

    <!-- Core Backend CSS (reuse same assets) -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/styles.css') }}" />
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.js') }}"></script>

    <!-- Inventory-specific styles -->
    <style>
        :root {
            --inv-primary:     #0f4c81;
            --inv-primary-rgb: 15, 76, 129;
            --inv-accent:      #1e88e5;
            --inv-sidebar-bg:  #0a2a4a;
            --inv-sidebar-hover: #0f3a61;
            --inv-sidebar-active: #1e88e5;
            --inv-sidebar-text:  #b0c4de;
            --inv-sidebar-text-active: #ffffff;
            --inv-topbar-bg:   #ffffff;
            --inv-body-bg:     #f0f4f8;
        }

        body {
            font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            background-color: var(--inv-body-bg);
        }

        /* ── LAYOUT WRAPPER ── */
        .inv-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .inv-sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--inv-sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            overflow-x: hidden;
        }
        .inv-sidebar.collapsed {
            width: 64px;
        }
        .inv-sidebar.collapsed .inv-nav-label,
        .inv-sidebar.collapsed .inv-brand-name,
        .inv-sidebar.collapsed .inv-section-title {
            display: none;
        }
        .inv-sidebar.collapsed .inv-nav-item a {
            justify-content: center;
            padding: 12px;
        }
        .inv-sidebar.collapsed .inv-nav-item a iconify-icon {
            margin: 0;
        }

        /* Brand */
        .inv-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-decoration: none;
            min-height: 70px;
        }
        .inv-brand img { width: 32px; height: 32px; object-fit: contain; border-radius: 6px; }
        .inv-brand-name {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            line-height: 1.2;
        }
        .inv-brand-sub {
            font-size: 10px;
            color: var(--inv-sidebar-text);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Nav */
        .inv-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
        }
        .inv-section-title {
            font-size: 10px;
            font-weight: 600;
            color: rgba(176, 196, 222, 0.5);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 12px 18px 4px;
        }
        .inv-nav-item { list-style: none; }
        .inv-nav-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: var(--inv-sidebar-text);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 0;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }
        .inv-nav-item a iconify-icon { font-size: 18px; flex-shrink: 0; }
        .inv-nav-item a:hover {
            background: var(--inv-sidebar-hover);
            color: #fff;
        }
        .inv-nav-item a.active {
            background: var(--inv-sidebar-active);
            color: var(--inv-sidebar-text-active);
            font-weight: 600;
        }
        .inv-nav-item a.active iconify-icon { color: #fff; }

        .inv-nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 10px;
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* Sidebar footer */
        .inv-sidebar-footer {
            padding: 16px 18px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .inv-sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--inv-sidebar-text);
            text-decoration: none;
            font-size: 13px;
        }
        .inv-sidebar-footer a:hover { color: #fff; }

        /* ── MAIN AREA ── */
        .inv-main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }
        .inv-sidebar.collapsed ~ .inv-main,
        .inv-main.sidebar-collapsed {
            margin-left: 64px;
        }

        /* ── TOPBAR ── */
        .inv-topbar {
            background: var(--inv-topbar-bg);
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 1040;
            box-shadow: 0 1px 0 rgba(0,0,0,0.08);
            gap: 16px;
        }
        .inv-topbar-toggle {
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            padding: 6px;
            border-radius: 6px;
            font-size: 20px;
            display: flex;
            align-items: center;
        }
        .inv-topbar-toggle:hover { background: #f0f4f8; color: var(--inv-primary); }

        .inv-topbar-breadcrumb {
            flex: 1;
        }
        .inv-topbar-breadcrumb h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #1a2b4a;
        }
        .inv-topbar-breadcrumb small {
            font-size: 12px;
            color: #8898aa;
        }

        .inv-topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* User badge in topbar */
        .inv-user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 40px;
            background: #f0f4f8;
            cursor: pointer;
            text-decoration: none;
        }
        .inv-user-pill img { width: 28px; height: 28px; border-radius: 50%; object-fit: cover; }
        .inv-user-pill span { font-size: 13px; font-weight: 500; color: #1a2b4a; }

        /* ── CONTENT ── */
        .inv-content {
            flex: 1;
            padding: 28px 24px;
        }

        /* ── MOBILE ── */
        @media (max-width: 991.98px) {
            .inv-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .inv-sidebar.mobile-open {
                transform: translateX(0);
            }
            .inv-main {
                margin-left: 0 !important;
            }
            .inv-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1049;
            }
            .inv-sidebar-overlay.visible { display: block; }
        }
    </style>

    @stack('css')

    <title>Inventory | @yield('page-title', 'Dashboard') — Mal Bali Galeria</title>
</head>
