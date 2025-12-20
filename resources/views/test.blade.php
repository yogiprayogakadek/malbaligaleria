<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria Shopping Center</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}"> --}}
    <style>
        @font-face {
            font-family: "Argesta Display";
            src: url("https://fonts.cdnfonts.com/css/argesta-display");
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gradient: linear-gradient(135deg, #2c5f5d 0%, #1a3a38 100%);
            --secondary-gradient: linear-gradient(135deg, #7d9d9c 0%, #5a7c7a 100%);
            --accent-gradient: linear-gradient(135deg, #a8c5c3 0%, #8ba9a7 100%);
            --primary-color: #2c5f5d;
            --secondary-color: #5a7c7a;
            --accent-color: #8ba9a7;
            --highlight-color: #c9a96e;
            --text-dark: #2c3e50;
            --text-light: #e8ebe9;
            --bg-light: #fafaf8;
            --bg-dark: #1a1f1e;
            --card-light: #f5f6f4;
            --card-dark: #252a29;
        }

        body {
            font-family: "Montserrat", sans-serif;
            overflow-x: hidden;
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        body.loaded {
            overflow-x: hidden;
            overflow-y: auto;
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }

        body.menu-open {
            overflow: hidden;
        }

        /* Hide content until loaded */
        body:not(.loaded)>*:not(.page-loader) {
            opacity: 0;
            visibility: hidden;
        }

        /* Page Loader */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #fafaf8 0%, #f5f6f4 50%, #e8ebe9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1),
                visibility 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.dark-mode .page-loader {
            background: linear-gradient(135deg, #1a1f1e 0%, #252a29 50%, #2c3e3c 100%);
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 500px;
            padding: 0 20px;
        }

        .loader-logo {
            opacity: 0;
            animation: logoFadeIn 1s ease forwards 0.3s;
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .loader-logo-circle {
            width: 150px;
            height: 150px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(44, 95, 93, 0.3);
            margin-bottom: 20px;
        }

        .loader-logo-image {
            width: 90px;
            height: 90px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.1));
        }

        .loader-logo h1 {
            font-family: "Playfair Display", serif;
            font-size: 42px;
            font-weight: 400;
            letter-spacing: 3px;
            text-transform: lowercase;
            color: var(--primary-color);
            margin-bottom: 5px;
            text-shadow: 0 2px 10px rgba(44, 95, 93, 0.1);
        }

        body.dark-mode .loader-logo h1 {
            color: var(--text-light);
        }

        .loader-logo span {
            display: block;
            font-size: 12px;
            letter-spacing: 5px;
            color: var(--secondary-color);
            margin-top: 0;
            text-shadow: 0 1px 5px rgba(90, 124, 122, 0.1);
            text-transform: uppercase;
        }

        @keyframes logoFadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Spinner */
        .loader-spinner {
            position: relative;
            width: 60px;
            height: 60px;
            margin: 0 auto 50px;
        }

        .spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 3px solid transparent;
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spinnerRotate 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            box-shadow: 0 0 15px rgba(44, 95, 93, 0.2);
        }

        .spinner-ring:nth-child(1) {
            animation-delay: -0.45s;
        }

        .spinner-ring:nth-child(2) {
            animation-delay: -0.3s;
            border-top-color: var(--secondary-color);
        }

        .spinner-ring:nth-child(3) {
            animation-delay: -0.15s;
            border-top-color: var(--accent-color);
        }

        @keyframes spinnerRotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Progress Bar */
        .loader-progress {
            width: 300px;
            height: 3px;
            background: rgba(44, 95, 93, 0.15);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            margin: 0 auto 25px;
            box-shadow: 0 2px 8px rgba(44, 95, 93, 0.08);
        }

        .progress-bar {
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 10px;
            width: 0%;
            animation: progressLoad 3s ease-in-out forwards;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(44, 95, 93, 0.3);
        }

        .progress-bar::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.4),
                    transparent);
            animation: progressShine 1.5s infinite;
        }

        @keyframes progressLoad {
            0% {
                width: 0%;
            }

            30% {
                width: 30%;
            }

            60% {
                width: 60%;
            }

            90% {
                width: 90%;
            }

            100% {
                width: 100%;
            }
        }

        @keyframes progressShine {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .loader-text {
            font-size: 12px;
            color: #6a7a78;
            letter-spacing: 2px;
            opacity: 0;
            animation: textFadeIn 0.5s ease forwards 1s;
            margin: 0;
            font-weight: 400;
        }

        body.dark-mode .loader-text {
            color: #b8c4c2;
        }

        @keyframes textFadeIn {
            to {
                opacity: 1;
            }
        }

        /* Hide Scrollbar */
        * {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        *::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            z-index: 100;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.3));
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(5px);
        }

        header.scrolled {
            background: rgba(250, 250, 248, 0.98);
            box-shadow: 0 4px 20px rgba(44, 95, 93, 0.08);
            backdrop-filter: blur(30px);
            padding: 15px 40px;
            border-bottom: 1px solid rgba(44, 95, 93, 0.08);
        }

        body.dark-mode header {
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.7),
                    rgba(0, 0, 0, 0.4));
        }

        body.dark-mode header.scrolled {
            background: rgba(26, 31, 30, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(168, 197, 195, 0.1);
        }

        header.scrolled .search-bar {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark-mode header.scrolled .search-bar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        header.scrolled .search-bar svg {
            stroke: #2c3e50;
        }

        body.dark-mode header.scrolled .search-bar svg {
            stroke: #e0e0e0;
        }

        header.scrolled .search-bar input {
            color: #2c3e50;
        }

        body.dark-mode header.scrolled .search-bar input {
            color: #e0e0e0;
        }

        header.scrolled .search-bar input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        body.dark-mode header.scrolled .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        header.scrolled .logo h1 {
            color: #2c3e50;
        }

        body.dark-mode header.scrolled .logo h1 {
            color: #e0e0e0;
        }

        header.scrolled .logo span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        header.scrolled .menu-btn span {
            background: #2c3e50;
        }

        body.dark-mode header.scrolled .menu-btn span {
            background: #e0e0e0;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 101;
            background: var(--primary-gradient);
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            padding: 0;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(44, 95, 93, 0.25), 0 0 0 0 rgba(44, 95, 93, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark-mode-toggle:hover {
            background: var(--secondary-gradient);
            box-shadow: 0 6px 25px rgba(44, 95, 93, 0.35),
                0 0 30px rgba(44, 95, 93, 0.15);
            transform: scale(1.08);
        }

        .dark-mode-toggle:active {
            transform: scale(0.95);
        }

        .dark-mode-toggle svg {
            width: 24px;
            height: 24px;
            fill: white;
            transition: opacity 0.5s ease, transform 0.5s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -12px;
            margin-top: -12px;
        }

        .dark-mode-toggle .sun-icon {
            opacity: 0;
            transform: rotate(-90deg) scale(0);
        }

        .dark-mode-toggle .moon-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }

        body.dark-mode .dark-mode-toggle .sun-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }

        body.dark-mode .dark-mode-toggle .moon-icon {
            opacity: 0;
            transform: rotate(90deg) scale(0);
        }

        /* Search Bar */
        .search-container {
            flex: 0 0 280px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 12px 20px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .search-bar:focus-within {
            background: rgba(255, 255, 255, 0.35);
            border-color: var(--primary-color);
            box-shadow: 0 0 20px rgba(44, 95, 93, 0.2), 0 0 40px rgba(44, 95, 93, 0.1);
            transform: translateY(-2px);
        }

        .search-bar svg {
            width: 20px;
            height: 20px;
            stroke: white;
            margin-right: 10px;
            transition: stroke 0.3s ease;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: white;
            font-size: 14px;
            width: 100%;
            outline: none;
            transition: color 0.3s ease;
        }

        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.3s ease;
        }

        /* Header Logo Circle */
        .header-logo-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(44, 95, 93, 0.2);
            transition: all 0.3s ease;
        }

        .header-logo-circle:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(44, 95, 93, 0.3);
        }

        /* Mobile: Search/Logo di sidebar */
        @media (max-width: 768px) {

            .search-container,
            .header-left {
                display: none;
            }
        }

        /* Logo */
        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .logo h1 {
            color: white;
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: lowercase;
            font-family: "Playfair Display", serif;
            transition: all 0.3s ease;
        }

        .logo span {
            display: block;
            font-size: 10px;
            letter-spacing: 5px;
            margin-top: -5px;
            transition: color 0.3s ease;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Mobile: Logo di kiri */
        @media (max-width: 768px) {
            .logo {
                position: static;
                transform: none;
                text-align: left;
                flex: 1;
            }

            .logo h1 {
                font-size: 24px;
            }
        }

        /* Menu Button */
        .menu-btn {
            flex: 0 0 auto;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
            z-index: 103;
        }

        .menu-btn span {
            display: block;
            width: 30px;
            height: 2px;
            background: white;
            margin: 6px 0;
            transition: 0.3s;
        }

        .menu-btn.active span {
            background: #2c3e50;
        }

        body.dark-mode .menu-btn.active span {
            background: #e0e0e0;
        }

        .menu-btn.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-6px, 6px);
        }

        .menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-btn.active span:nth-child(3) {
            transform: rotate(45deg) translate(-6px, -6px);
        }

        /* Sidebar Menu */
        .sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 400px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 102;
            padding: 100px 50px 120px;
            overflow-y: auto;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .sidebar {
            background: rgba(26, 26, 26, 0.98);
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.5);
        }

        .sidebar.active {
            right: 0;
        }

        .sidebar-logo {
            position: absolute;
            left: 50px;
            top: 30px;
            opacity: 0;
            transition: opacity 0.4s ease 0.3s;
        }

        .sidebar.active .sidebar-logo {
            opacity: 1;
        }

        .sidebar-logo h2 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: lowercase;
            font-family: "Playfair Display", serif;
        }

        body.dark-mode .sidebar-logo h2 {
            color: #e0e0e0;
        }

        .sidebar-logo span {
            display: block;
            font-size: 9px;
            letter-spacing: 4px;
            margin-top: -3px;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Close Button */
        .sidebar-close {
            position: absolute;
            right: 30px;
            top: 30px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.4s ease 0.3s;
        }

        .sidebar.active .sidebar-close {
            opacity: 1;
        }

        .sidebar-close span {
            display: block;
            width: 30px;
            height: 2px;
            background: #2c3e50;
            margin: 6px 0;
            transition: 0.3s;
        }

        body.dark-mode .sidebar-close span {
            background: #e0e0e0;
        }

        .sidebar-close span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .sidebar-close span:nth-child(2) {
            opacity: 0;
        }

        .sidebar-close span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .sidebar-close:hover span {
            background: var(--primary-color);
        }

        /* Sidebar Search - Mobile only */
        .sidebar-search {
            display: none;
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .sidebar-search {
                display: block;
            }
        }

        .sidebar-search .search-bar {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .sidebar-search .search-bar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-search .search-bar svg {
            stroke: #2c3e50;
        }

        body.dark-mode .sidebar-search .search-bar svg {
            stroke: #e0e0e0;
        }

        .sidebar-search .search-bar input {
            color: #2c3e50;
        }

        body.dark-mode .sidebar-search .search-bar input {
            color: #e0e0e0;
        }

        .sidebar-search .search-bar input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .sidebar-search .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .sidebar nav ul {
            list-style: none;
        }

        .sidebar nav ul li {
            margin: 30px 0;
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.3s ease;
        }

        .sidebar.active nav ul li {
            opacity: 1;
            transform: translateX(0);
        }

        .sidebar.active nav ul li:nth-child(1) {
            transition-delay: 0.1s;
        }

        .sidebar.active nav ul li:nth-child(2) {
            transition-delay: 0.2s;
        }

        .sidebar.active nav ul li:nth-child(3) {
            transition-delay: 0.3s;
        }

        .sidebar.active nav ul li:nth-child(4) {
            transition-delay: 0.4s;
        }

        .sidebar.active nav ul li:nth-child(5) {
            transition-delay: 0.5s;
        }

        .sidebar.active nav ul li:nth-child(6) {
            transition-delay: 0.6s;
        }

        .sidebar nav ul li a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 24px;
            font-weight: 400;
            transition: 0.3s;
            display: block;
            position: relative;
        }

        body.dark-mode .sidebar nav ul li a {
            color: #e0e0e0;
        }

        .sidebar nav ul li a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 2px;
            background: #5fcfda;
            transition: width 0.3s ease;
        }

        .sidebar nav ul li a:hover {
            color: var(--primary-color);
            transform: translateX(10px);
        }

        .sidebar nav ul li a:hover::after {
            width: 60px;
            background: var(--primary-gradient);
        }

        /* Hero Section with Parallax */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 20px;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            background: url("../../backgorund.webp") center/cover no-repeat;
            will-change: transform;
            transform: translateZ(0);
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.3),
                    rgba(0, 0, 0, 0.5));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease forwards 0.3s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h2 {
            font-size: 50px;
            font-weight: 400;
            margin-bottom: 20px;
            line-height: 1.2;
            font-family: "Playfair Display", serif;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .explore-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            background: transparent;
            color: white;
            padding: 0;
            padding-right: 35px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
            overflow: visible;
            font-weight: 500;
            height: 50px;
        }

        .explore-btn::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            transition: all 0.4s ease;
            z-index: -1;
        }

        .explore-btn::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            z-index: -2;
            opacity: 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.3);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .explore-btn .arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin-right: 10px;
            font-size: 20px;
            transition: transform 0.4s ease;
            flex-shrink: 0;
        }

        .explore-btn .text {
            position: relative;
            transition: all 0.4s ease;
        }

        .explore-btn .text::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 1px;
            background: white;
            transition: width 0.4s ease;
        }

        .explore-btn:hover::before {
            width: calc(100% + 35px);
            border-radius: 50px;
            box-shadow: 0 0 30px rgba(44, 95, 93, 0.4), 0 0 60px rgba(44, 95, 93, 0.2),
                0 8px 25px rgba(44, 95, 93, 0.25);
        }

        .explore-btn:hover .arrow {
            transform: translateX(5px);
        }

        .explore-btn:hover .text::after {
            width: 100%;
        }

        .explore-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(95, 207, 218, 0.3);
        }

        /* Contact Circle */
        .contact-circle {
            display: none;
        }

        /* Reveal on Scroll Animation */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger animation for children */
        .reveal.active .stagger-item {
            opacity: 0;
            transform: translateY(30px);
            animation: staggerFadeIn 0.6s ease forwards;
        }

        .reveal.active .stagger-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .reveal.active .stagger-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .reveal.active .stagger-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .reveal.active .stagger-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .reveal.active .stagger-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .reveal.active .stagger-item:nth-child(6) {
            animation-delay: 0.6s;
        }

        @keyframes staggerFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fade in from left */
        .fade-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        /* Fade in from right */
        .fade-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        /* Scale animation */
        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scale-in.active {
            opacity: 1;
            transform: scale(1);
        }

        /* Rotate in animation */
        .rotate-in {
            opacity: 0;
            transform: rotate(-5deg) scale(0.95);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .rotate-in.active {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }

        /* About Section */
        .about-section {
            min-height: 100vh;
            background: #ffffff;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark-mode .about-section {
            background: #1a1a1a;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .about-container h2 {
            font-family: "Playfair Display", serif;
            font-size: 48px;
            font-weight: 400;
            color: #2c3e50;
            margin-bottom: 60px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .about-container h2 {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .about-container h2 {
            color: #e0e0e0;
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .about-content p {
            font-size: 16px;
            line-height: 1.8;
            color: #5a5a5a;
            margin-bottom: 30px;
            text-align: center;
        }

        body.dark-mode .about-content p {
            color: #b0b0b0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 60px;
            margin-top: 80px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .info-item {
            text-align: center;
            padding: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .info-item:nth-child(1) {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.3s;
        }

        .reveal.active .info-item:nth-child(2) {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.4s;
        }

        .info-item h3 {
            font-family: "Montserrat", sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        body.dark-mode .info-item h3 {
            color: #e0e0e0;
        }

        .info-item p {
            font-size: 15px;
            line-height: 1.6;
            color: #5a5a5a;
            margin: 0;
        }

        body.dark-mode .info-item p {
            color: #b0b0b0;
        }

        .divider {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 1px;
            height: 60%;
            background: rgba(44, 62, 80, 0.1);
            pointer-events: none;
        }

        body.dark-mode .divider {
            background: rgba(224, 224, 224, 0.1);
        }

        /* Tenant Carousel Section */
        .tenant-section {
            min-height: 100vh;
            background: #ffffff;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark-mode .tenant-section {
            background: #1a1a1a;
        }

        .tenant-container {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .tenant-container h2 {
            font-family: "Playfair Display", serif;
            font-size: 48px;
            font-weight: 400;
            color: #2c3e50;
            margin-bottom: 60px;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .tenant-container h2 {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .tenant-container h2 {
            color: #e0e0e0;
        }

        .carousel-wrapper {
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        }

        .reveal.active .carousel-wrapper {
            opacity: 1;
            transform: translateY(0);
        }

        .carousel-container {
            display: flex;
            gap: 30px;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tenant-card {
            flex: 0 0 calc(25% - 22.5px);
            background: #f8f8f8;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        body.dark-mode .tenant-card {
            background: #2a2a2a;
        }

        .tenant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        body.dark-mode .tenant-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        }

        .tenant-card-image {
            width: 100%;
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .tenant-card-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tenant-card:hover .tenant-card-image::after {
            opacity: 1;
        }

        .tenant-card-content {
            padding: 25px;
        }

        .tenant-card h3 {
            font-family: "Playfair Display", serif;
            font-size: 22px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        body.dark-mode .tenant-card h3 {
            color: #e0e0e0;
        }

        .tenant-card p {
            font-size: 14px;
            color: #5a5a5a;
            margin-bottom: 15px;
        }

        body.dark-mode .tenant-card p {
            color: #b0b0b0;
        }

        .tenant-card-tag {
            display: inline-block;
            padding: 6px 18px;
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 12px rgba(44, 95, 93, 0.25);
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 40px;
        }

        .carousel-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 12px rgba(44, 95, 93, 0.25);
        }

        .carousel-btn:hover {
            background: var(--secondary-gradient);
            transform: scale(1.12);
            box-shadow: 0 5px 20px rgba(44, 95, 93, 0.35),
                0 0 30px rgba(44, 95, 93, 0.15);
        }

        .carousel-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: scale(1);
        }

        /* Experience Section */
        .experience-section {
            min-height: 100vh;
            background: #ffffff;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            position: relative;
        }

        body.dark-mode .experience-section {
            background: #1a1a1a;
        }

        .experience-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .experience-wrapper {
            opacity: 1;
            transform: translateY(0);
        }

        .experience-left {
            flex: 0 0 300px;
            padding-left: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .all-experience-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            background: transparent;
            color: #2c3e50;
            padding: 0;
            padding-right: 35px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 20px;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
            overflow: visible;
            font-weight: 500;
            height: 50px;
            font-family: "Playfair Display", serif;
        }

        body.dark-mode .all-experience-btn {
            color: #e0e0e0;
        }

        .all-experience-btn::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            transition: all 0.4s ease;
            z-index: 0;
        }

        .all-experience-btn .arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin-right: 15px;
            font-size: 20px;
            transition: transform 0.4s ease;
            flex-shrink: 0;
            color: white;
            position: relative;
            z-index: 1;
        }

        .all-experience-btn .text {
            position: relative;
            transition: all 0.4s ease;
            z-index: 1;
        }

        .all-experience-btn .text::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0px;
            width: 0;
            height: 1px;
            background: #2c3e50;
            transition: width 0.4s ease;
        }

        body.dark-mode .all-experience-btn .text::after {
            background: #e0e0e0;
        }

        .all-experience-btn:hover::before {
            width: calc(100% + 35px);
            border-radius: 50px;
            box-shadow: 0 0 30px rgba(44, 95, 93, 0.4), 0 0 60px rgba(44, 95, 93, 0.2);
        }

        .all-experience-btn:hover .arrow {
            transform: translateX(5px);
        }

        .all-experience-btn:hover .text::after {
            width: 100%;
        }

        .all-experience-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(95, 207, 218, 0.3);
        }

        .experience-cards {
            flex: 1;
            display: flex;
            gap: 20px;
            height: 600px;
            overflow: hidden;
            position: relative;
        }

        .experience-card {
            position: relative;
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            background-size: cover;
            background-position: center;
        }

        .experience-card.expanded {
            flex: 2 !important;
        }

        .experience-card.promotion {
            flex: 2;
        }

        .experience-card:not(.promotion):not(.expanded) {
            flex: 1;
            /* Changed from 0.5 to 1 to match default stability */
        }

        .experience-card {
            will-change: flex;
        }

        /* Only apply hover expand effect on devices that support hover properly and are wide enough */
        @media (min-width: 1025px) {
            .experience-card:hover {
                flex: 2 !important;
            }

            .experience-cards:hover .experience-card:not(:hover) {
                flex: 0.8 !important;
                /* Less aggressive shrinking */
            }
        }

        /* On smaller screens (Tablets/Laptops < 1025px), disable the confusing resizing behavior */
        @media (max-width: 1024px) {
            .experience-cards {
                gap: 15px;
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .experience-card {
                flex: 0 0 280px !important;
                /* Fixed width carousels are safer/better UX on small screens */
                min-width: 280px;
                height: 450px;
                /* Ensure consistent height */
            }

            /* Remove the complex hover interactions that cause blinking */
            .experience-cards:hover .experience-card:not(:hover) {
                flex: 0 0 280px !important;
            }

            .experience-card:hover {
                flex: 0 0 280px !important;
                transform: translateY(-5px);
                /* Simple subtle lift instead */
            }
        }

        .experience-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(0, 0, 0, 0.8));
            z-index: 1;
        }

        .experience-card-content {
            position: absolute;
            bottom: 40px;
            left: 40px;
            z-index: 2;
            text-align: left;
            opacity: 0;
            transition: opacity 0.4s ease;
            max-width: calc(100% - 80px);
        }

        .experience-card-content.active {
            pointer-events: auto;
        }

        .experience-card-title {
            margin-bottom: 20px;
        }

        .experience-card h4 {
            font-family: "Playfair Display", serif;
            font-size: 32px;
            font-weight: 400;
            color: white;
            margin: 0;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .experience-card-button-wrapper {
            display: inline-block;
        }

        .experience-card-button {
            display: inline-flex;
            align-items: center;
            background: var(--primary-gradient);
            color: white;
            padding: 14px 28px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 10px;
            box-shadow: 0 3px 12px rgba(44, 95, 93, 0.25);
            letter-spacing: 0.5px;
        }

        .experience-card-button:hover {
            background: var(--secondary-gradient);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(44, 95, 93, 0.35),
                0 0 40px rgba(44, 95, 93, 0.15);
        }

        .experience-card-button .arrow {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .experience-card-button:hover .arrow {
            transform: translateX(3px);
        }

        .experience-card-title-vertical {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 20px;
        }

        .experience-card-title-vertical h4 {
            font-family: "Playfair Display", serif;
            font-size: 28px;
            font-weight: 400;
            color: white;
            margin: 0;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            margin: 0 auto;
            letter-spacing: 3px;
        }

        .experience-card.promotion .experience-card-content {
            opacity: 1;
        }

        .experience-card.promotion .experience-card-title-vertical {
            opacity: 0;
        }

        .experience-card.expanded .experience-card-content {
            opacity: 1;
        }

        .experience-card.expanded .experience-card-title-vertical {
            opacity: 0;
        }

        .experience-card:hover .experience-card-content {
            opacity: 1;
        }

        .experience-card:hover .experience-card-title-vertical {
            opacity: 0;
        }

        .experience-cards:hover .experience-card.promotion:not(:hover):not(.expanded) .experience-card-content {
            opacity: 0;
        }

        .experience-cards:hover .experience-card.promotion:not(:hover):not(.expanded) .experience-card-title-vertical {
            opacity: 1;
        }

        .experience-cards:hover .experience-card.expanded:not(:hover) .experience-card-content {
            opacity: 0;
        }

        .experience-cards:hover .experience-card.expanded:not(:hover) .experience-card-title-vertical {
            opacity: 1;
        }

        .experience-card.promotion {
            background-image: url("https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800");
        }

        .experience-card.events {
            background-image: url("https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800");
        }

        .experience-card.destinations {
            background-image: url("https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800");
        }

        .experience-card.new-store {
            background-image: url("https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800");
        }

        /* Event Highlight Section with Slider */
        .event-section {
            min-height: 100vh;
            background: var(--bg-light);
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark-mode .event-section {
            background: var(--bg-dark);
        }

        .event-container {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .event-container h2 {
            font-family: "Playfair Display", serif;
            font-size: 52px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 70px;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 1px;
        }

        .reveal.active .event-container h2 {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .event-container h2 {
            color: var(--text-light);
        }

        /* Event Slider Wrapper */
        .event-slider-wrapper {
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        }

        .reveal.active .event-slider-wrapper {
            opacity: 1;
            transform: translateY(0);
        }

        .event-grid {
            display: flex;
            gap: 30px;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Desktop: Show 2 cards */
        @media (min-width: 769px) {
            .event-card {
                flex: 0 0 calc(50% - 15px);
                min-width: calc(50% - 15px);
            }
        }

        /* Mobile: Show 1 card */
        @media (max-width: 768px) {
            .event-card {
                flex: 0 0 100%;
                min-width: 100%;
            }
        }

        .event-card {
            position: relative;
            height: 450px;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            transform: translateY(0) scale(1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .event-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 50px rgba(44, 95, 93, 0.2),
                0 0 60px rgba(44, 95, 93, 0.08);
        }

        body.dark-mode .event-card {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .event-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6),
                0 0 60px rgba(168, 197, 195, 0.1);
        }

        .event-card-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .event-card:hover .event-card-bg {
            transform: scale(1.15);
        }

        .event-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    rgba(0, 0, 0, 0.3) 40%,
                    rgba(0, 0, 0, 0.85) 100%);
            z-index: 1;
            transition: opacity 0.4s ease;
        }

        .event-card:hover::before {
            background: linear-gradient(to bottom,
                    rgba(44, 95, 93, 0.08) 0%,
                    rgba(44, 95, 93, 0.2) 40%,
                    rgba(0, 0, 0, 0.88) 100%);
        }

        .event-card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 35px;
            z-index: 2;
            color: white;
        }

        .event-date {
            display: inline-block;
            background: var(--primary-gradient);
            color: white;
            padding: 10px 24px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            box-shadow: 0 3px 15px rgba(44, 95, 93, 0.3);
            transition: all 0.3s ease;
        }

        .event-card:hover .event-date {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(44, 95, 93, 0.4);
        }

        .event-card h3 {
            font-family: "Playfair Display", serif;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 12px;
            color: white;
            line-height: 1.3;
            letter-spacing: 0.5px;
        }

        .event-card p {
            font-size: 15px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 18px;
            letter-spacing: 0.3px;
        }

        .event-link {
            display: inline-flex;
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            gap: 10px;
            transition: all 0.3s ease;
            padding: 8px 0;
            letter-spacing: 0.5px;
        }

        .event-link::before {
            content: "";
            position: absolute;
            bottom: 28px;
            left: 35px;
            width: 0;
            height: 2px;
            background: var(--accent-gradient);
            transition: width 0.4s ease;
        }

        .event-card:hover .event-link::before {
            width: 120px;
        }

        .event-link:hover {
            gap: 15px;
            transform: translateX(5px);
        }

        /* Event Navigation Controls */
        .event-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 50px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.4s;
        }

        .reveal.active .event-controls {
            opacity: 1;
            transform: translateY(0);
        }

        .event-nav-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 15px rgba(44, 95, 93, 0.25);
            position: relative;
            overflow: hidden;
        }

        .event-nav-btn::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .event-nav-btn:hover::before {
            width: 100%;
            height: 100%;
        }

        .event-nav-btn:hover {
            background: var(--secondary-gradient);
            transform: scale(1.12);
            box-shadow: 0 5px 25px rgba(44, 95, 93, 0.4), 0 0 40px rgba(44, 95, 93, 0.2);
        }

        .event-nav-btn:active {
            transform: scale(0.95);
        }

        .event-nav-btn:disabled {
            background: linear-gradient(135deg, #ccc 0%, #999 100%);
            cursor: not-allowed;
            transform: scale(1);
            opacity: 0.5;
        }

        .event-nav-btn:disabled:hover {
            transform: scale(1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Hide controls if not needed */
        .event-controls.hidden {
            display: none;
        }

        /* Mall Map Section */
        .map-section {
            min-height: 100vh;
            background: #ffffff;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark-mode .map-section {
            background: #1a1a1a;
        }

        .map-container {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .map-container h2 {
            font-family: "Playfair Display", serif;
            font-size: 48px;
            font-weight: 400;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .map-container h2 {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .map-container h2 {
            color: #e0e0e0;
        }

        .map-subtitle {
            text-align: center;
            font-size: 16px;
            color: #5a5a5a;
            margin-bottom: 60px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.1s;
        }

        .reveal.active .map-subtitle {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .map-subtitle {
            color: #b0b0b0;
        }

        .map-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        .map-display {
            background: #f8f8f8;
            border-radius: 15px;
            overflow: hidden;
            height: 600px;
            position: relative;
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        }

        .reveal.active .map-display {
            opacity: 1;
            transform: translateX(0);
        }

        body.dark-mode .map-display {
            background: #2a2a2a;
        }

        .map-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            color: #5a5a5a;
        }

        body.dark-mode .map-placeholder {
            color: #b0b0b0;
        }

        .map-icon {
            width: 90px;
            height: 90px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            box-shadow: 0 6px 25px rgba(44, 95, 93, 0.3);
        }

        .map-floors {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-height: calc(4 * 78px + 3 * 15px);
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 10px;
            position: relative;
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
        }

        .reveal.active .map-floors {
            opacity: 1;
            transform: translateX(0);
        }

        /* Scroll indicator for map floors */
        .scroll-indicator {
            position: sticky;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.95), transparent);
            padding: 15px 0 0;
            text-align: center;
            font-size: 12px;
            color: #5fcfda;
            font-weight: 600;
            letter-spacing: 1px;
            pointer-events: none;
            transition: opacity 0.3s ease;
            margin-right: -10px;
        }

        body.dark-mode .scroll-indicator {
            background: linear-gradient(to top, rgba(26, 26, 26, 0.95), transparent);
        }

        .scroll-indicator.hidden {
            opacity: 0;
        }

        .scroll-indicator svg {
            width: 16px;
            height: 16px;
            fill: #5fcfda;
            animation: bounceDown 1.5s infinite;
            display: block;
            margin: 5px auto 0;
        }

        @keyframes bounceDown {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateY(-3px);
            }
        }

        /* Hide scrollbar for map floors */
        .map-floors {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .map-floors::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        .floor-item {
            background: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            min-height: 78px;
        }

        body.dark-mode .floor-item {
            background: #2a2a2a;
        }

        .floor-item:hover {
            border-color: #5fcfda;
            transform: translateX(5px) scale(1.02);
            box-shadow: 0 5px 15px rgba(95, 207, 218, 0.2);
        }

        .floor-item.active {
            background: #5fcfda;
            border-color: #5fcfda;
        }

        .floor-item.active h4,
        .floor-item.active p {
            color: white;
        }

        .floor-item h4 {
            font-family: "Montserrat", sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        body.dark-mode .floor-item h4 {
            color: #e0e0e0;
        }

        .floor-item p {
            font-size: 13px;
            color: #5a5a5a;
            margin: 0;
        }

        body.dark-mode .floor-item p {
            color: #b0b0b0;
        }

        /* Responsive untuk section baru */
        @media (max-width: 1024px) {
            .event-grid {
                grid-template-columns: 1fr;
            }

            .dining-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .map-wrapper {
                grid-template-columns: 1fr;
            }

            .map-display {
                height: 400px;
            }

            .parking-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {

            .event-section,
            .dining-section,
            .map-section,
            .parking-section {
                padding: 60px 20px;
            }

            .event-container h2,
            .dining-container h2,
            .map-container h2,
            .parking-container h2 {
                font-size: 36px;
            }

            .event-card {
                height: 300px;
            }

            .dining-grid {
                grid-template-columns: 1fr;
            }

            .parking-features {
                grid-template-columns: 1fr;
            }
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 80px 40px 30px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="rgba(95,207,218,0.02)"/><circle cx="50" cy="50" r="30" fill="rgba(95,207,218,0.03)"/></svg>');
            opacity: 0.5;
        }

        body.dark-mode footer {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 50px;
        }

        .footer-column h3 {
            font-family: "Playfair Display", serif;
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 25px;
            color: white;
        }

        .footer-about p {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-block;
            position: relative;
        }

        .footer-links a::before {
            content: "→";
            position: absolute;
            left: -20px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #5fcfda;
            transform: translateX(10px);
        }

        .footer-links a:hover::before {
            left: -15px;
            opacity: 1;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 15px;
        }

        .footer-contact-item svg {
            width: 20px;
            height: 20px;
            fill: #5fcfda;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-contact-item p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .footer-contact-item a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-contact-item a:hover {
            color: #5fcfda;
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .footer-social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            backdrop-filter: blur(10px);
        }

        .footer-social-link:hover {
            background: #5fcfda;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(95, 207, 218, 0.3);
        }

        .footer-social-link svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .footer-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 40px 0 30px;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-copyright {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-brand-logo {
            font-family: "Playfair Display", serif;
            font-size: 20px;
            font-weight: 500;
            color: white;
            letter-spacing: 1px;
        }

        .footer-brand-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }

            .experience-wrapper {
                flex-direction: column;
            }

            .experience-left {
                flex: none;
                width: 100%;
                padding-left: 0;
                text-align: center;
            }

            .experience-cards {
                width: 100%;
                height: 500px;
            }

            .tenant-card {
                flex: 0 0 calc(33.333% - 20px);
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            .sidebar {
                width: 100%;
                right: -100%;
                padding: 80px 30px 120px;
            }

            .sidebar-logo {
                left: 30px;
                top: 25px;
            }

            .hero h2 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }

            .contact-circle {
                display: none;
            }

            .dark-mode-toggle {
                bottom: 20px;
                right: 20px;
            }

            .about-section {
                padding: 60px 20px;
            }

            .about-container h2 {
                font-size: 36px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .divider {
                display: none;
            }

            .tenant-section {
                padding: 60px 20px;
            }

            .tenant-container h2 {
                font-size: 36px;
            }

            .tenant-card {
                flex: 0 0 calc(50% - 15px);
            }

            .experience-section {
                padding: 60px 20px;
            }

            .experience-cards {
                flex-direction: column;
                height: auto;
                gap: 15px;
            }

            .experience-card {
                height: 200px;
                flex: none !important;
            }

            .experience-card h4 {
                writing-mode: horizontal-tb;
                font-size: 24px;
            }

            .experience-card-content {
                left: 20px;
                bottom: 20px;
                opacity: 1 !important;
            }

            .experience-card-title-vertical {
                display: none;
            }

            footer {
                padding: 60px 20px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .tenant-card {
                flex: 0 0 100%;
            }
        }

        /* Tenant Grid in Landing */
        .tenant-content {
            width: 100%;
            position: relative;
            padding-right: 20px;
            /* Prevent overlap with map-floors */
        }

        @media (max-width: 1023px) {
            .tenant-content {
                padding-right: 0;
            }
        }

        /* Horizontal Scroll Indicator for Tenant Grid */
        .tenant-scroll-indicator {
            position: absolute;
            bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: var(--primary-color);
            opacity: 1 !important;
            transition: all 0.3s ease;
            z-index: 5;
            pointer-events: none;

            /* Enhanced Glassmorphism Effect */
            background: rgba(255, 255, 255, 0.85);
            /* More solid background */
            backdrop-filter: saturate(180%) blur(12px);
            /* iOS-style frosted glass */
            -webkit-backdrop-filter: saturate(180%) blur(12px);
            padding: 10px 20px;
            /* Slightly larger padding */
            border-radius: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(255, 255, 255, 0.5);
            /* Inner border ring */
            border: none;
            /* Removed standard border for shadow ring approach */
        }

        .tenant-scroll-indicator.right {
            right: 20px;
        }

        .tenant-scroll-indicator.left {
            left: 20px;
            flex-direction: row;
            /* Default row */
        }

        body.dark-mode .tenant-scroll-indicator {
            color: var(--text-light);
            background: rgba(30, 30, 30, 0.85);
            backdrop-filter: saturate(180%) blur(12px);
            -webkit-backdrop-filter: saturate(180%) blur(12px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .tenant-scroll-indicator.hidden {
            opacity: 0 !important;
            visibility: hidden;
            transform: scale(0.9);
        }

        .tenant-scroll-indicator svg {
            width: 20px;
            height: 20px;
            fill: none;
            /* Changed to none for stroke path */
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .tenant-scroll-indicator.right svg {
            animation: bounceRight 2s ease-in-out infinite;
        }

        .tenant-scroll-indicator.left svg {
            animation: bounceLeft 2s ease-in-out infinite;
        }

        body.dark-mode .tenant-scroll-indicator svg {
            fill: none;
            stroke: var(--text-light);
        }

        @keyframes bounceRight {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }
        }

        @keyframes bounceLeft {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-5px);
            }
        }

        @media (max-width: 768px) {
            .tenant-scroll-indicator {
                font-size: 10px;
                bottom: 15px;
                right: 15px;
            }

            .tenant-scroll-indicator svg {
                width: 16px;
                height: 16px;
            }
        }

        .tenant-grid {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 20px;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on iOS */
        }

        .tenant-grid::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        /* Tenant Grid Wrapper with Navigation */
        .tenant-grid-wrapper {
            position: relative;
            width: 100%;
        }

        .tenant-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(44, 95, 93, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 10;
            opacity: 0;
        }

        .tenant-grid-wrapper:hover .tenant-nav-btn {
            opacity: 1;
        }

        .tenant-nav-btn:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(44, 95, 93, 0.25);
            border-color: var(--primary-color);
        }

        .tenant-nav-btn:active {
            transform: translateY(-50%) scale(0.95);
        }

        .tenant-nav-btn.prev {
            left: 10px;
        }

        .tenant-nav-btn.next {
            right: 10px;
        }

        .tenant-nav-btn svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary-color);
            transition: stroke 0.3s ease;
        }

        .tenant-nav-btn:hover svg {
            stroke: var(--secondary-color);
        }

        body.dark-mode .tenant-nav-btn {
            background: rgba(40, 40, 40, 0.95);
            border-color: rgba(168, 197, 195, 0.2);
        }

        body.dark-mode .tenant-nav-btn:hover {
            background: rgba(50, 50, 50, 1);
            border-color: var(--accent-color);
        }

        body.dark-mode .tenant-nav-btn svg {
            stroke: var(--accent-color);
        }

        body.dark-mode .tenant-nav-btn:hover svg {
            stroke: var(--text-light);
        }

        /* Mobile: Adjust button positioning and always show */
        @media (max-width: 1024px) {
            .tenant-nav-btn {
                opacity: 1; /* Always visible on mobile */
                width: 40px;
                height: 40px;
            }

            .tenant-nav-btn.prev {
                left: 5px;
            }

            .tenant-nav-btn.next {
                right: 5px;
            }

            .tenant-nav-btn svg {
                width: 20px;
                height: 20px;
            }
        }

        @media (max-width: 768px) {
            .tenant-nav-btn {
                width: 36px;
                height: 36px;
            }

            .tenant-nav-btn.prev {
                left: 5px;
            }

            .tenant-nav-btn.next {
                right: 5px;
            }

            .tenant-nav-btn svg {
                width: 18px;
                height: 18px;
            }
        }

        .tenant-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            opacity: 1 !important;
            transform: none !important;
            /* Force visible */
            flex-shrink: 0;
            scroll-snap-align: start;
            touch-action: pan-y pinch-zoom;
            /* Allow vertical scroll and pinch zoom */
        }

        /* Desktop: Show 3 cards */
        @media (min-width: 1024px) {
            .tenant-card {
                min-width: calc((100% - 3rem) / 3);
                /* 3 cards with 1.5rem gap between */
                max-width: calc((100% - 3rem) / 3);
            }
        }

        /* Tablet: Show 2 cards */
        @media (min-width: 768px) and (max-width: 1023px) {
            .tenant-card {
                min-width: calc((100% - 1.5rem) / 2);
                /* 2 cards */
                max-width: calc((100% - 1.5rem) / 2);
            }
        }

        /* Mobile: Show 1 card */
        @media (max-width: 767px) {
            .tenant-card {
                min-width: calc(100% - 40px);
                max-width: calc(100% - 40px);
            }
        }

        .tenant-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 15px 30px rgba(44, 95, 93, 0.15);
        }

        body.dark-mode .tenant-card {
            background: rgba(40, 40, 40, 0.6);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .tenant-logo {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            padding: 20px;
            position: relative;
        }

        body.dark-mode .tenant-logo {
            background: rgba(255, 255, 255, 0.05);
        }

        .tenant-logo img {
            max-width: 120px;
            max-height: 100px;
            object-fit: contain;
            filter: grayscale(1);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .tenant-card:hover .tenant-logo img {
            filter: grayscale(0);
            opacity: 1;
            transform: scale(1.1);
        }

        .tenant-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Pill Badge (Overlapping) - Positioned at top-right of tenant-logo */
        .floor-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(95, 207, 218, 0.3);
        }

        .tenant-info h3 {
            font-family: "Playfair Display", serif;
            font-size: 20px;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 700;
        }

        body.dark-mode .tenant-info h3 {
            color: #e0e0e0;
        }

        .tenant-category {
            font-size: 13px;
            color: #6a7a78;
            margin-bottom: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tenant-category svg {
            width: 14px;
            height: 14px;
            fill: #5fcfda;
        }

        .tenant-meta {
            margin-top: auto;
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: #666;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        body.dark-mode .tenant-meta {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item svg {
            width: 14px;
            height: 14px;
            fill: #5fcfda;
        }

        .see-details-btn {
            margin-top: 18px;
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            border: none;
            color: white;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(95, 207, 218, 0.25);
            position: relative;
            overflow: hidden;
        }

        .see-details-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: left 0.5s ease;
        }

        .see-details-btn:hover::before {
            left: 100%;
        }

        .see-details-btn:hover {
            background: linear-gradient(135deg, #4db8c3 0%, #3da3ad 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(95, 207, 218, 0.4);
        }

        .see-details-btn svg {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .see-details-btn:hover svg {
            transform: translateX(3px);
        }

        /* Tenant Details Modal */
        .tenant-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        visibility 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tenant-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.dark-mode .modal-overlay {
            background: rgba(0, 0, 0, 0.85);
        }

        .modal-container {
            position: relative;
            width: 90%;
            max-width: 1200px;
            max-height: 90vh;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            transform: scale(0.9) translateY(30px);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tenant-modal.active .modal-container {
            transform: scale(1) translateY(0);
        }

        body.dark-mode .modal-container {
            background: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .modal-close:hover {
            background: white;
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .modal-close {
            background: rgba(50, 50, 50, 0.9);
        }

        body.dark-mode .modal-close:hover {
            background: rgba(60, 60, 60, 1);
        }

        .modal-close svg {
            width: 20px;
            height: 20px;
            stroke: #2c3e50;
        }

        body.dark-mode .modal-close svg {
            stroke: #e0e0e0;
        }

        .modal-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-height: 90vh;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .modal-content {
                grid-template-columns: 1fr;
                overflow-y: auto;
            }
        }

        /* Modal Carousel */
        .modal-carousel {
            position: relative;
            background: #f8f9fa;
            overflow: hidden;
        }

        body.dark-mode .modal-carousel {
            background: rgba(20, 20, 20, 0.8);
        }

        .carousel-images {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .carousel-image {
            min-width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .carousel-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
        }

        .modal-carousel:hover .carousel-nav {
            opacity: 1;
        }

        .carousel-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .carousel-nav.prev {
            left: 20px;
        }

        .carousel-nav.next {
            right: 20px;
        }

        body.dark-mode .carousel-nav {
            background: rgba(50, 50, 50, 0.9);
        }

        body.dark-mode .carousel-nav:hover {
            background: rgba(60, 60, 60, 1);
        }

        .carousel-nav svg {
            width: 24px;
            height: 24px;
            stroke: #2c3e50;
        }

        body.dark-mode .carousel-nav svg {
            stroke: #e0e0e0;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .carousel-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background: white;
            width: 24px;
            border-radius: 4px;
        }

        body.dark-mode .carousel-indicator {
            background: rgba(255, 255, 255, 0.3);
        }

        body.dark-mode .carousel-indicator.active {
            background: rgba(255, 255, 255, 0.8);
        }

        /* Carousel Swipe Hint */
        .carousel-swipe-hint {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 50px;
            color: white;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            opacity: 1;
            transition: opacity 0.5s ease;
            z-index: 5;
            pointer-events: none;
        }

        .carousel-swipe-hint.hidden {
            opacity: 0;
        }

        body.dark-mode .carousel-swipe-hint {
            background: rgba(255, 255, 255, 0.15);
        }

        .carousel-swipe-hint svg {
            width: 16px;
            height: 16px;
            stroke: white;
            animation: swipeHintBounce 2s ease-in-out infinite;
        }

        .carousel-swipe-hint svg:first-child {
            animation-delay: 0s;
        }

        .carousel-swipe-hint svg:last-child {
            animation-delay: 0.5s;
        }

        @keyframes swipeHintBounce {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(-3px);
            }
        }

        .carousel-swipe-hint svg:last-child {
            animation-name: swipeHintBounceRight;
        }

        @keyframes swipeHintBounceRight {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(3px);
            }
        }

        @media (max-width: 768px) {
            .carousel-swipe-hint {
                font-size: 10px;
                padding: 10px 18px;
                gap: 8px;
            }

            .carousel-swipe-hint svg {
                width: 14px;
                height: 14px;
            }
        }

        /* Modal Details */
        .modal-details {
            padding: 40px;
            overflow-y: auto;
            max-height: 90vh;
        }

        @media (max-width: 768px) {
            .modal-details {
                padding: 30px 20px;
            }
        }

        .modal-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .modal-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        .modal-logo {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            flex-shrink: 0;
        }

        body.dark-mode .modal-logo {
            background: rgba(255, 255, 255, 0.05);
        }

        .modal-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .modal-title {
            flex: 1;
        }

        .modal-floor-badge {
            display: inline-block;
            padding: 6px 12px;
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .modal-title h2 {
            font-size: 28px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        body.dark-mode .modal-title h2 {
            color: var(--text-light);
        }

        .modal-category {
            font-size: 14px;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .modal-info {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .modal-info-item {
            display: flex;
            gap: 15px;
            padding: 20px;
            background: rgba(44, 95, 93, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .modal-info-item:hover {
            background: rgba(44, 95, 93, 0.1);
            transform: translateX(5px);
        }

        body.dark-mode .modal-info-item {
            background: rgba(255, 255, 255, 0.05);
        }

        body.dark-mode .modal-info-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .modal-info-item svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary-color);
            flex-shrink: 0;
        }

        body.dark-mode .modal-info-item svg {
            stroke: var(--accent-color);
        }

        .modal-info-item div {
            flex: 1;
        }

        .info-label {
            display: block;
            font-size: 12px;
            color: var(--secondary-color);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            display: block;
            font-size: 16px;
            font-weight: 500;
            color: var(--text-dark);
        }

        body.dark-mode .info-value {
            color: var(--text-light);
        }

        .modal-description {
            padding: 20px;
            background: rgba(44, 95, 93, 0.03);
            border-radius: 12px;
            border-left: 4px solid var(--primary-color);
        }

        body.dark-mode .modal-description {
            background: rgba(255, 255, 255, 0.03);
        }

        .modal-description p {
            line-height: 1.8;
            color: var(--text-dark);
        }

        body.dark-mode .modal-description p {
            color: var(--text-light);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .modal-container {
                width: 95%;
                max-height: 95vh;
                border-radius: 16px;
            }

            .modal-carousel {
                min-height: 300px;
            }

            .carousel-image {
                padding: 20px;
            }

            .carousel-nav {
                width: 40px;
                height: 40px;
            }

            .carousel-nav.prev {
                left: 10px;
            }

            .carousel-nav.next {
                right: 10px;
            }

            .modal-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-logo {
                width: 100px;
                height: 100px;
            }

            .modal-title h2 {
                font-size: 22px;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            display: none;
            width: 100%;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            fill: #5fcfda;
            opacity: 0.5;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 20px;
            color: #2c3e50;
        }

        body.dark-mode .empty-state h3 {
            color: #ddd;
        }

        /* Map Floors Styling */
        .map-floors {
            background: white;
            /* White background request */
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: fit-content;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05);
            color: #2c3e50;
            position: relative;
            /* For absolute indicators */
            overflow: hidden;
            /* Contain inner scroll */
            padding: 0;
            /* Remove padding from container, move to wrapper */
        }

        .floor-list-wrapper {
            padding: 1.5rem;
            max-height: 450px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* simple IE */
        }

        .floor-list-wrapper::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari */
        }

        /* Vertical Scroll Indicators for Floors */
        .floor-scroll-indicator {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            /* Glassmorphism */
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(12px);
            -webkit-backdrop-filter: saturate(180%) blur(12px);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            opacity: 1;
            pointer-events: none;
            color: var(--primary-color);
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        body.dark-mode .floor-scroll-indicator {
            background: rgba(40, 40, 40, 0.85);
            color: white;
        }

        .floor-scroll-indicator svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        .floor-scroll-indicator.up {
            top: 15px;
            animation: bounceUp 2s infinite;
        }

        .floor-scroll-indicator.down {
            bottom: 15px;
            animation: bounceDown 2s infinite;
        }

        .floor-scroll-indicator.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateX(-50%) translateY(10px);
        }

        @keyframes bounceUp {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        @keyframes bounceDown {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(5px);
            }
        }

        body.dark-mode .map-floors {
            background: rgba(40, 40, 40, 0.6);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .floor-item {
            padding: 1rem;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            background: transparent;
        }

        .floor-item:hover {
            background: rgba(95, 207, 218, 0.1);
            transform: translateX(5px);
        }

        .floor-item.active {
            background: var(--primary-gradient);
            /* Solid active background */
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(95, 207, 218, 0.3);
            transform: translateX(5px);
        }

        .floor-item h4 {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            /* Dark text for inactive items */
            margin-bottom: 4px;
            transition: color 0.3s ease;
        }

        body.dark-mode .floor-item h4 {
            color: #e0e0e0;
        }

        .floor-item p {
            font-size: 12px;
            color: #6a7a78;
            /* Muted text for inactive items */
            margin: 0;
            transition: color 0.3s ease;
        }

        /* Active State Text Colors - White for constrast on gradient */
        .floor-item.active h4 {
            color: white !important;
        }

        .floor-item.active p {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Adjust Map Wrapper for Grid - Ensure Left/Right Split */
        .map-wrapper {
            display: flex;
            flex-direction: column-reverse;
            gap: 30px;
        }

        @media (min-width: 1024px) {
            .map-wrapper {
                display: grid;
                grid-template-columns: 1fr 400px;
                /* Widened to 400px */
                align-items: start;
                gap: 40px;
            }

            .map-floors {
                order: 2;
                display: flex !important;
                /* Ensure it's visible */
                position: sticky;
                top: 2rem;
            }

            .map-display {
                order: 1;
                background: transparent;
                box-shadow: none;
                height: auto;
                overflow: visible;
                min-width: 0;
                /* CRITICAL: Prevents grid item from expanding beyond its cell */
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                        onerror="this.style.display='none'">
                </div>
                <h1>mal bali galeria</h1>
                <span>SHOPPING CENTER</span>
            </div>
            <div class="loader-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
            <div class="loader-progress">
                <div class="progress-bar"></div>
            </div>
            <p class="loader-text">LOADING...</p>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
        <svg class="moon-icon" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
        <svg class="sun-icon" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="5" />
            <line x1="12" y1="1" x2="12" y2="3" stroke="currentColor" stroke-width="2" />
            <line x1="12" y1="21" x2="12" y2="23" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" />
            <line x1="1" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="21" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor" stroke-width="2" />
        </svg>
    </button>

    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;">
            </a>
        </div>

        <div class="logo">
            <h1>mal bali galeria<span>SHOPPING CENTER</span></h1>
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>mal bali galeria<span>SHOPPING CENTER</span></h2>
        </div>

        <button class="sidebar-close" id="sidebarClose">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#tenants">Tenants</a></li>
                <li><a href="{{ route('directory') }}">Directory</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>

        <!-- Search in Sidebar for Mobile -->
        <div class="sidebar-search">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h2>Bali’s Most Refined Luxury Lifestyle Destination</h2>
            <p>An elevated sanctuary where you enjoy, play, eat, and shop with exceptional sophistication</p>
            <button class="explore-btn">
                <span class="arrow">→</span>
                <span class="text">Explore malbaligaleria</span>
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section reveal" id="about">
        <div class="about-container">
            <h2>Welcome to Mal Bali Galeria</h2>
            <div class="about-content">
                <p>Mal Bali Galeria Shopping Center offers an exclusive shopping experience with modern architectural
                    design and comprehensive facilities. Located in the strategic area of Denpasar, we provide a
                    comfortable and luxurious shopping environment for all your needs.</p>

                <p>As a premier retail destination in Bali, Mal Bali Galeria hosts a diverse collection of local and
                    international brands, from fashion, beauty, dining, to lifestyle & entertainment. We are committed
                    to providing the best shopping experience with various facilities and services for the whole family.
                </p>

                <p>With our strategic location and complete amenities, Mal Bali Galeria is the perfect destination for
                    shopping, dining, and spending quality time with your loved ones in Denpasar.</p>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <h3>Open Hour</h3>
                    <p>10AM - 10PM (Daily)</p>
                </div>
                <div class="info-item">
                    <h3>Address</h3>
                    <p>Jl. Sunset Road No. 89,<br>Kuta, Badung, Bali, Indonesia 80361</p>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </section>

    <!-- Tenant Carousel Section -->
    <section class="tenant-section reveal" id="tenants">
        <div class="tenant-container">
            <h2>Featured Tenants</h2>
            <div class="carousel-wrapper">
                <div class="carousel-container" id="carouselContainer">
                    @forelse ($tenants as $tenant)
                        <div class="tenant-card">
                            <a href="{{ route('tenant') }}" style="text-decoration: none;">
                                <div class="tenant-card-image"
                                    style="background-image: url({{ asset('storage/' . $tenant->primaryPhoto->path) }});">
                                </div>
                                <div class="tenant-card-content">
                                    <h3>{{ $tenant->name }}</h3>
                                    <p>{{ $tenant->category->name }}</p>
                                    <span
                                        class="tenant-card-tag">{{ $tenant->map_coords['floor'] == 1 ? $tenant->map_coords['floor'] . 'st Floor' : $tenant->map_coords['floor'] . 'nd Floor' }}</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h3 class="text-center">No data available</h3>
                    @endforelse
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn" id="prevBtn">←</button>
                <button class="carousel-btn" id="nextBtn">→</button>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience-section reveal" id="experience">
        <div class="experience-wrapper">
            <div class="experience-left">
                <button class="all-experience-btn">
                    <span class="arrow">→</span>
                    <span class="text">All Experience</span>
                </button>
            </div>

            <div class="experience-cards">
                <div class="experience-card promotion">
                    <div class="experience-card-title-vertical">
                        <h4>Promotion</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Promotion</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card events">
                    <div class="experience-card-title-vertical">
                        <h4>D&E Events</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>D&E Events</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card destinations">
                    <div class="experience-card-title-vertical">
                        <h4>Destinations</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>Destinations</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="experience-card new-store">
                    <div class="experience-card-title-vertical">
                        <h4>New Store</h4>
                    </div>
                    <div class="experience-card-content">
                        <div class="experience-card-title">
                            <h4>New Store</h4>
                        </div>
                        <div class="experience-card-button-wrapper">
                            <button class="experience-card-button">
                                <span class="text">See More</span>
                                <span class="arrow">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Highlight Section -->
    <section class="event-section reveal" id="events">
        <div class="event-container">
            <h2>Upcoming Events</h2>
            <div class="event-slider-wrapper">
                <div class="event-grid" id="eventGrid">
                    @forelse ($events as $event)
                        <div class="event-card">
                            <div class="event-card-bg"
                                style="background-image: url({{ asset('storage/' . $event->primaryPhoto->path) }});">
                            </div>
                            <div class="event-card-content">
                                <span
                                    class="event-date">{{ date_format(date_create($event->start_date), 'd M Y') }}</span>
                                <h3>{{ $event->name }}</h3>
                                <p>{{ $event->description }}</p>
                                <a href="#" class="event-link">Learn More →</a>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">No data available</h3>
                    @endforelse
                </div>
            </div>
            <div class="event-controls" id="eventControls">
                <button class="event-nav-btn" id="eventPrevBtn">←</button>
                <button class="event-nav-btn" id="eventNextBtn">→</button>
            </div>
        </div>
    </section>

    <!-- Mall Map Section -->
    <section class="map-section reveal">
        <div class="map-container">
            <h2>Mall Directory</h2>
            <p class="map-subtitle">Navigate through our shopping center with ease</p>
            <div class="map-wrapper">
                <div class="map-display">
                    <div class="tenant-content">
                        <div class="tenant-grid-wrapper">
                            <button class="tenant-nav-btn prev" id="tenantNavPrev">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </button>
                            <div class="tenant-grid" id="landingTenantGrid">
                                {{-- RENDER --}}
                            </div>
                            <button class="tenant-nav-btn next" id="tenantNavNext">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                            </button>
                        </div>
                        <div class="empty-state" id="landingEmptyState" style="display: none;">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" />
                            </svg>
                            <h3>No tenants found</h3>
                        </div>

                        {{-- Tenant Scroll Indicators --}}
                        <div class="tenant-scroll-indicator left hidden" id="tenantScrollBack">
                            <svg viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" /> {{-- Left Arrow --}}
                            </svg>
                            SWIPE BACK
                        </div>

                        <div class="tenant-scroll-indicator right" id="tenantScrollIndicator">
                            SWIPE FOR MORE
                            <svg viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" /> {{-- Right Arrow --}}
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="map-floors" id="mapFloors">
                    <div class="floor-list-wrapper" id="floorListWrapper">
                        <div class="floor-item active">
                            <h4>Level 1</h4>
                            <p>Electronics, Books, Sports</p>
                        </div>
                        <div class="floor-item">
                            <h4>Level 2</h4>
                            <p>Restaurants, Cafés, Food Court</p>
                        </div>
                        <div class="floor-item">
                            <h4>New Store</h4>
                            <p>Fashion, Accessories, Cosmetics</p>
                        </div>
                        <div class="floor-item">
                            <h4>All Floor</h4>
                            <p>Entertainment, Cinema, Kids Zone</p>
                        </div>
                    </div>

                    {{-- Vertical Scroll Indicators --}}
                    <div class="floor-scroll-indicator up hidden" id="floorScrollUp">
                        <svg viewBox="0 0 24 24">
                            <path d="M7 14l5-5 5 5z" />
                        </svg>
                        Scroll up
                    </div>
                    <div class="floor-scroll-indicator down" id="floorScrollDown">
                        Scroll for more
                        <svg viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </div>
                </div> <!-- End of .map-floors -->
            </div>
        </div>
    </section>

    <!-- Tenant Details Modal -->
    <div class="tenant-modal" id="tenantModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-container">
            <button class="modal-close" id="modalClose">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="modal-content">
                <div class="modal-carousel">
                    <div class="carousel-images" id="modalCarouselImages">
                        <!-- Images will be inserted here dynamically -->
                    </div>
                    <button class="carousel-nav prev" id="modalCarouselPrev">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                    <button class="carousel-nav next" id="modalCarouselNext">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                    <div class="carousel-swipe-hint" id="carouselSwipeHint">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                        <span>Swipe or use navigation buttons</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </div>
                    <div class="carousel-indicators" id="modalCarouselIndicators">
                        <!-- Indicators will be inserted here dynamically -->
                    </div>
                </div>
                
                <div class="modal-details">
                    <div class="modal-header">
                        <div class="modal-logo" id="modalLogo">
                            <!-- Logo will be inserted here -->
                        </div>
                        <div class="modal-title">
                            <span class="modal-floor-badge" id="modalFloorBadge"></span>
                            <h2 id="modalTenantName"></h2>
                            <p class="modal-category" id="modalCategory"></p>
                        </div>
                    </div>
                    
                    <div class="modal-info">
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <span class="info-label">Location</span>
                                <span class="info-value" id="modalUnit"></span>
                            </div>
                        </div>
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <div>
                                <span class="info-label">Operating Hours</span>
                                <span class="info-value" id="modalHours"></span>
                            </div>
                        </div>
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            <div>
                                <span class="info-label">Floor</span>
                                <span class="info-value" id="modalFloor"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-description" id="modalDescription">
                        <!-- Description will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="reveal" id="contact">
        <div class="footer-container">
            <div class="footer-content">
                <!-- About Column -->
                <div class="footer-column footer-about">
                    <h3>Mal Bali Galeria</h3>
                    <p>Your premier shopping destination in Bali, offering luxury brands, dining, and entertainment
                        experiences in a modern and comfortable environment.</p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link" aria-label="Instagram">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                                    fill="none" stroke="white" stroke-width="2" />
                                <circle cx="12" cy="12" r="4" fill="none" stroke="white"
                                    stroke-width="2" />
                                <circle cx="18" cy="6" r="1" fill="white" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Twitter">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="TikTok">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#tenants">Store Directory</a></li>
                        <li><a href="#experience">Experiences</a></li>
                        <li><a href="#events">Events</a></li>
                        <li><a href="#career">Careers</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#valet">Valet Parking</a></li>
                        <li><a href="#concierge">Concierge</a></li>
                        <li><a href="#gift">Gift Cards</a></li>
                        <li><a href="#member">Membership</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <p>Jl. Sunset Road No. 89, Kuta, Badung, Bali 80361</p>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+6236112345678">+62 361 1234 5678</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <a href="mailto:info@malbaligaleria.com">info@malbaligaleria.com</a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <p class="footer-copyright">© 2024 Mal Bali Galeria. All Rights Reserved.</p>
                <div class="footer-brand">
                    <span class="footer-brand-logo">MBG</span>
                    <span class="footer-brand-text">Premium Shopping Experience</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('assets/frontend/js/landing.js') }}"></script> --}}
    <script>
        // Page Loader
        const pageLoader = document.getElementById("pageLoader");

        // Ensure loader shows first
        let minLoadTime = 3500; // Minimum 3.5 seconds
        let loadStartTime = Date.now();

        window.addEventListener("load", () => {
            let loadTime = Date.now() - loadStartTime;
            let remainingTime = Math.max(0, minLoadTime - loadTime);

            // Hide loader after ensuring minimum display time
            setTimeout(() => {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");

                // Remove from DOM after transition
                setTimeout(() => {
                    pageLoader.style.display = "none";
                }, 500);
            }, remainingTime);
        });

        // Fallback: if load event doesn't fire within 5 seconds, hide loader anyway
        setTimeout(() => {
            if (!document.body.classList.contains("loaded")) {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");
                setTimeout(() => {
                    pageLoader.style.display = "none";
                }, 500);
            }
        }, 5000);

        // Menu toggle
        const menuBtn = document.getElementById("menuBtn");
        const sidebar = document.getElementById("sidebar");
        const sidebarClose = document.getElementById("sidebarClose");
        const header = document.querySelector("header");

        menuBtn.addEventListener("click", () => {
            menuBtn.classList.toggle("active");
            sidebar.classList.toggle("active");
            // Toggle body scroll
            document.body.classList.toggle("menu-open");
        });

        // Close sidebar with close button
        sidebarClose.addEventListener("click", () => {
            menuBtn.classList.remove("active");
            sidebar.classList.remove("active");
            document.body.classList.remove("menu-open");
        });

        // Close sidebar when clicking on a link
        const sidebarLinks = sidebar.querySelectorAll("a");
        sidebarLinks.forEach((link) => {
            link.addEventListener("click", () => {
                menuBtn.classList.remove("active");
                sidebar.classList.remove("active");
                document.body.classList.remove("menu-open");
            });
        });

        // Sticky Header - Always visible
        let lastScroll = 0;

        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;

            // Add scrolled class for background
            if (currentScroll > 100) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }

            lastScroll = currentScroll;
        });

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById("darkModeToggle");

        // Check for saved dark mode preference
        if (localStorage.getItem("darkMode") === "enabled") {
            document.body.classList.add("dark-mode");
        }

        darkModeToggle.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            document.body.classList.toggle("dark-mode");

            // Save preference
            if (document.body.classList.contains("dark-mode")) {
                localStorage.setItem("darkMode", "enabled");
            } else {
                localStorage.setItem("darkMode", "disabled");
            }
        });

        // Enhanced Parallax Effect for Hero Section
        const hero = document.querySelector(".hero");
        const heroBg = document.querySelector(".hero-bg");

        window.addEventListener("scroll", () => {
            const scrolled = window.pageYOffset;

            if (hero && heroBg && scrolled < hero.offsetHeight) {
                // Parallax untuk background - bergerak lebih lambat
                const parallaxSpeed = 0.5;
                heroBg.style.transform = `translateY(${
            scrolled * parallaxSpeed
        }px) scale(1.1)`;

                // Fade out hero content saat scroll
                const heroContent = document.querySelector(".hero-content");
                const opacity = 1 - scrolled / (hero.offsetHeight * 0.7);
                const translateY = scrolled * 0.3;

                if (heroContent) {
                    heroContent.style.opacity = Math.max(0, opacity);
                    heroContent.style.transform = `translateY(${translateY}px)`;
                }

                // Zoom in effect pada background
                const scale = 1.1 + scrolled * 0.0001;
                heroBg.style.transform = `translateY(${
            scrolled * parallaxSpeed
        }px) scale(${Math.min(scale, 1.3)})`;
            }
        });

        // Reveal on Scroll Animation
        const revealElements = document.querySelectorAll(".reveal");

        const revealOnScroll = () => {
            const windowHeight = window.innerHeight;
            const revealPoint = 100;

            revealElements.forEach((element) => {
                const elementTop = element.getBoundingClientRect().top;

                if (elementTop < windowHeight - revealPoint) {
                    element.classList.add("active");
                }
            });
        };

        window.addEventListener("scroll", revealOnScroll);
        revealOnScroll(); // Initial check

        // Tenant Carousel
        // Tenant Carousel - Infinite Loop
        const carouselContainer = document.getElementById("carouselContainer");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        // Strategy: Try scoped first, fallback to global if empty (to match previous behavior)
        let cards = [];
        if (carouselContainer) {
            cards = carouselContainer.querySelectorAll(".tenant-card");
        }

        // Fallback to global if scoped is empty (restore previous functionality)
        if (cards.length === 0) {
            cards = document.querySelectorAll(".tenant-card");
        }

        const originalCardsCount = cards.length;

        let currentIndex = 0;
        let cardsPerView = 4;
        let isTransitioning = false;

        // Clone first 4 cards for infinite loop
        // Ensure container exists before appending
        if (originalCardsCount > 0 && carouselContainer) {
            const clonesNeeded = 4;
            for (let i = 0; i < clonesNeeded; i++) {
                // Use modulus to handle case where originalCardsCount < 4
                const cardToClone = cards[i % originalCardsCount];
                if (cardToClone) {
                    const clone = cardToClone.cloneNode(true);
                    clone.classList.add("clone");
                    carouselContainer.appendChild(clone);
                }
            }

            // Re-query cards after appending clones
            // We must maintain the same selector strategy
            if (
                carouselContainer.querySelectorAll(".tenant-card").length >
                originalCardsCount
            ) {
                cards = carouselContainer.querySelectorAll(".tenant-card");
            } else {
                cards = document.querySelectorAll(".tenant-card");
            }
        }

        // Update cards per view based on screen size
        const updateCardsPerView = () => {
            if (window.innerWidth <= 480) {
                cardsPerView = 1;
            } else if (window.innerWidth <= 768) {
                cardsPerView = 2;
            } else if (window.innerWidth <= 1024) {
                cardsPerView = 3;
            } else {
                cardsPerView = 4;
            }
            updateCarousel(true); // Instant update on resize

            // Restart autoplay logic
            if (typeof startAutoplay === "function") startAutoplay();
        };

        const updateCarousel = (instant = false) => {
            if (cards.length === 0) return;

            const cardWidth = cards[0].offsetWidth;
            const gap = 30; // Match CSS gap
            const offset = -(currentIndex * (cardWidth + gap));

            if (instant) {
                carouselContainer.style.transition = "none";
            } else {
                carouselContainer.style.transition = "transform 0.5s ease-in-out";
            }

            carouselContainer.style.transform = `translateX(${offset}px)`;

            // Buttons always enabled for infinite loop if content exists
            if (originalCardsCount > 0) {
                prevBtn.disabled = false;
                nextBtn.disabled = false;
            } else {
                prevBtn.disabled = true;
                nextBtn.disabled = true;
            }
        };

        // Handle Infinite Loop Reset
        carouselContainer.addEventListener("transitionend", () => {
            // If we've scrolled past the original set
            if (currentIndex >= originalCardsCount) {
                currentIndex = currentIndex % originalCardsCount;
                updateCarousel(true); // Snap back instantly
            }
            isTransitioning = false;
        });

        prevBtn.addEventListener("click", () => {
            if (isTransitioning) return;
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            } else {
                // Loop back to end (optional complexity, for now just stop at 0 or wrap)
                // Simple wrapping for Prev button to match infinite feel
                currentIndex = originalCardsCount - 1;
                updateCarousel(true); // Jump to end of real items
                // Then slide to adjustment? No, to emulate infinite scroll left needs prepend clones
                // For now, simple Prev behavior stops at 0 is acceptable or wrap to end value
            }
        });

        nextBtn.addEventListener("click", () => {
            // Allow clicking into clone territory
            if (originalCardsCount > 0) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Auto-play carousel
        let autoplayInterval;

        const startAutoplay = () => {
            if (autoplayInterval) clearInterval(autoplayInterval);

            // Only autoplay if we have enough content (Infinite loop always active if content exists)
            if (originalCardsCount > 0) {
                autoplayInterval = setInterval(() => {
                    currentIndex++;
                    updateCarousel();
                    // Reset logic is handled by transitionend
                }, 4000); // Slightly faster for infinite feel
            }
        };

        // Pause on hover
        if (carouselContainer) {
            carouselContainer.addEventListener("mouseenter", () => {
                if (autoplayInterval) clearInterval(autoplayInterval);
            });

            carouselContainer.addEventListener("mouseleave", () => {
                startAutoplay();
            });
        }

        // Start initially
        startAutoplay();

        // Update on window resize
        window.addEventListener("resize", () => {
            updateCardsPerView();
        });

        // Initial setup
        updateCardsPerView();

        // Event Slider
        const eventGrid = document.getElementById("eventGrid");
        const eventPrevBtn = document.getElementById("eventPrevBtn");
        const eventNextBtn = document.getElementById("eventNextBtn");
        const eventControls = document.getElementById("eventControls");
        const eventCards = document.querySelectorAll(".event-card");

        let eventCurrentIndex = 0;
        let eventCardsPerView = 2;

        // Update cards per view based on screen size
        const updateEventCardsPerView = () => {
            if (window.innerWidth <= 768) {
                eventCardsPerView = 1;
            } else {
                eventCardsPerView = 2;
            }
            updateEventSlider();
            updateEventControlsVisibility();
        };

        const updateEventSlider = () => {
            if (!eventGrid || eventCards.length === 0) return;

            const cardWidth = eventCards[0].offsetWidth;
            const gap = 30;
            const offset = -(eventCurrentIndex * (cardWidth + gap));
            eventGrid.style.transform = `translateX(${offset}px)`;

            // Update button states
            if (eventPrevBtn && eventNextBtn) {
                eventPrevBtn.disabled = eventCurrentIndex === 0;
                eventNextBtn.disabled =
                    eventCurrentIndex >= eventCards.length - eventCardsPerView;
            }
        };

        const updateEventControlsVisibility = () => {
            if (!eventControls) return;

            // Hide controls if:
            // - Desktop (2 cards per view) and 2 or fewer events
            // - Mobile (1 card per view) and 1 or fewer events
            const shouldHideControls = eventCards.length <= eventCardsPerView;

            if (shouldHideControls) {
                eventControls.classList.add("hidden");
            } else {
                eventControls.classList.remove("hidden");
            }
        };

        if (eventPrevBtn && eventNextBtn && eventGrid) {
            eventPrevBtn.addEventListener("click", () => {
                if (eventCurrentIndex > 0) {
                    eventCurrentIndex--;
                    updateEventSlider();
                }
            });

            eventNextBtn.addEventListener("click", () => {
                if (eventCurrentIndex < eventCards.length - eventCardsPerView) {
                    eventCurrentIndex++;
                    updateEventSlider();
                }
            });

            // Auto-play event slider
            let eventAutoplayInterval = setInterval(() => {
                if (eventCards.length > eventCardsPerView) {
                    if (eventCurrentIndex < eventCards.length - eventCardsPerView) {
                        eventCurrentIndex++;
                    } else {
                        eventCurrentIndex = 0;
                    }
                    updateEventSlider();
                }
            }, 6000);

            // Pause autoplay on hover
            eventGrid.addEventListener("mouseenter", () => {
                clearInterval(eventAutoplayInterval);
            });

            eventGrid.addEventListener("mouseleave", () => {
                eventAutoplayInterval = setInterval(() => {
                    if (eventCards.length > eventCardsPerView) {
                        if (eventCurrentIndex < eventCards.length - eventCardsPerView) {
                            eventCurrentIndex++;
                        } else {
                            eventCurrentIndex = 0;
                        }
                        updateEventSlider();
                    }
                }, 6000);
            });

            // Update on window resize
            window.addEventListener("resize", () => {
                updateEventCardsPerView();
            });

            // Initial setup
            updateEventCardsPerView();
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    const headerHeight = header.offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: "smooth",
                    });
                }
            });
        });

        // Experience cards - DISABLED to prevent blinking
        /*
                const experienceCardsContainer = document.querySelector('.experience-cards');
                const experienceCards = document.querySelectorAll('.experience-card');
                let lastHoveredCard = document.querySelector('.experience-card.promotion');
                let isHovering = false;

                experienceCards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        card.style.boxShadow = '0 0 40px rgba(95, 207, 218, 0.4)';
                        lastHoveredCard = card;
                        isHovering = true;
                    });

                    card.addEventListener('mouseleave', () => {
                        card.style.boxShadow = 'none';
                        isHovering = false;
                    });
                });


                if (experienceCardsContainer) {
                    experienceCardsContainer.addEventListener('mouseleave', () => {
                        experienceCards.forEach(card => {
                            card.classList.remove('promotion', 'expanded');
                        });
                        if (lastHoveredCard) {
                            lastHoveredCard.classList.add('expanded');
                        }
                    });
                }
                */

        // Disabled scroll event to prevent blinking
        // The CSS hover states are sufficient for the experience cards behavior
        /*
                let scrollTimeout;
                let lastExpandedCard = null;
                window.addEventListener('scroll', () => {
                    if (!isHovering && lastHoveredCard && experienceCardsContainer) {
                        clearTimeout(scrollTimeout);
                        scrollTimeout = setTimeout(() => {
                            if (lastExpandedCard !== lastHoveredCard) {
                                experienceCards.forEach(card => {
                                    card.classList.remove('promotion', 'expanded');
                                });
                                lastHoveredCard.classList.add('expanded');
                                lastExpandedCard = lastHoveredCard;
                            }
                        }, 500);
                    }
                });
                */

        // Mall Directory Scroll Indicator
        const mapFloors = document.getElementById("mapFloors");
        const scrollIndicator = document.getElementById("scrollIndicator");

        if (mapFloors && scrollIndicator) {
            // Check if scrollable
            const checkScrollable = () => {
                const isScrollable = mapFloors.scrollHeight > mapFloors.clientHeight;
                if (!isScrollable) {
                    scrollIndicator.classList.add("hidden");
                }
            };

            // Hide indicator when scrolled to bottom
            mapFloors.addEventListener("scroll", () => {
                const isAtBottom =
                    mapFloors.scrollHeight - mapFloors.scrollTop <=
                    mapFloors.clientHeight + 10;
                if (isAtBottom) {
                    scrollIndicator.classList.add("hidden");
                } else {
                    scrollIndicator.classList.remove("hidden");
                }
            });

            checkScrollable();
        }

        // Add intersection observer for more advanced animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: "0px 0px -100px 0px",
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                }
            });
        }, observerOptions);

        revealElements.forEach((element) => {
            observer.observe(element);
        });

        // Add stagger animation to tenant cards
        const tenantCards = document.querySelectorAll(".tenant-card");
        tenantCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Enhance button interactions with ripple effect
        const buttons = document.querySelectorAll(
            "button:not(#darkModeToggle), .explore-btn, .all-experience-btn"
        );
        buttons.forEach((button) => {
            button.addEventListener("click", function(e) {
                const ripple = document.createElement("span");
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;
                    animation: ripple 0.6s ease-out;
                `;

                // Check if button already has position relative
                const currentPosition = window.getComputedStyle(this).position;
                if (currentPosition === "static") {
                    this.style.position = "relative";
                }
                this.style.overflow = "hidden";
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation
        const style = document.createElement("style");
        style.textContent = `
            @keyframes ripple {
                from {
                    transform: scale(0);
                    opacity: 1;
                }
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Lazy loading for images
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.style.backgroundImage = `url(${img.dataset.src})`;
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll("[data-src]").forEach((img) => {
            imageObserver.observe(img);
        });

        // Add fade-in animation for footer elements
        const footerElements = document.querySelectorAll(
            "footer .footer-links a, footer .footer-social-link"
        );
        footerElements.forEach((element, index) => {
            element.style.opacity = "0";
            element.style.transform = "translateY(20px)";
            element.style.transition = "all 0.5s ease";
            element.style.transitionDelay = `${index * 0.05}s`;
        });

        const footerObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        footerElements.forEach((element) => {
                            element.style.opacity = "1";
                            element.style.transform = "translateY(0)";
                        });
                    }
                });
            }, {
                threshold: 0.1,
            }
        );

        const footer = document.querySelector("footer");
        if (footer) {
            footerObserver.observe(footer);
        }

        // Performance optimization: Debounce scroll events
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply debounce to scroll-heavy functions
        const debouncedReveal = debounce(revealOnScroll, 50);
        window.removeEventListener("scroll", revealOnScroll);
        window.addEventListener("scroll", debouncedReveal);

        // Add loading state
        window.addEventListener("load", () => {
            document.body.classList.add("loaded");

            // Trigger initial animations
            setTimeout(() => {
                revealOnScroll();
            }, 100);
        });

        // MALL DIRECTORY TENANT
        // Load data from database

        async function loadTenantsOnDatabase(floor) {
            try {
                tenantData = await $.get("/tenant/" + floor);
                return tenantData;
            } catch (error) {
                console.error("Gagal memuat data", error);
            }
        }

        async function renderLandingTenants(floor) {
            const tenantData = await loadTenantsOnDatabase(floor);
            const grid = document.getElementById("landingTenantGrid");
            const emptyState = document.getElementById("landingEmptyState");

            if (!grid) return;

            grid.innerHTML = "";

            // Normalize floor comparison
            let searchFloor = floor;
            // if (floor === "1st Floor") searchFloor = "1st Floor"; // Map Ground to 1st if needed

            const filtered = tenantData.filter(
                (t) => t.floor === searchFloor || t.floor === floor
            );
            if (filtered.length === 0) {
                if (emptyState) emptyState.style.display = "block";
                return;
            }

            if (emptyState) emptyState.style.display = "none";

            filtered.forEach((tenant, index) => {
                const card = document.createElement("div");
                card.className = "tenant-card stagger-card";
                card.style.animationDelay = `${index * 0.1}s`;

                card.innerHTML = `
                    <div class="tenant-logo">
                        <img src="${tenant.logo}" alt="${tenant.name}">
                    </div>
                    <div class="tenant-info">
                        <span class="floor-badge">${tenant.floor}</span>
                        <h3>${tenant.name}</h3>
                        <p class="tenant-category">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                            </svg>
                            ${tenant.category}
                        </p>
                        <div class="tenant-meta">
                            <div class="meta-item">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span>Unit ${tenant.unit}</span>
                            </div>
                            <div class="meta-item">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <span>${tenant.hours}</span>
                            </div>
                        </div>
                        <button class="see-details-btn">
                            See Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                `;

                grid.appendChild(card);
                setTimeout(() => card.classList.add("show"), 50);
            });
        }

        // Initialize Landing Directory
        document.addEventListener("DOMContentLoaded", () => {
            renderLandingTenants("1st Floor");

            const floorItems = document.querySelectorAll(".map-floors .floor-item");
            floorItems.forEach((item) => {
                // Initial check for active
                if (item.classList.contains("active")) {
                    const floor = item.querySelector("h4").textContent;
                    // Or simplify if data-floor missing
                    if (floor.includes("1st"))
                        renderLandingTenants("1st Floor");
                    else if (floor.includes("2nd"))
                        renderLandingTenants("2nd Floor");
                    else if (floor.includes("New Store"))
                        renderLandingTenants("2nd Floor");
                    else if (floor.includes("All Floor"))
                        window.location.href = '/directory';
                }

                item.addEventListener("click", function() {
                    // Remove active class
                    floorItems.forEach((i) => i.classList.remove("active"));
                    // Add active class
                    this.classList.add("active");

                    const floorText = this.querySelector("h4").textContent;
                    let targetFloor = "1st Floor";

                    // Simple Mapping for now based on Text if data-floor not set
                    if (floorText.includes("1st") || floorText.includes('Level 1'))
                        targetFloor = "1st Floor";
                    else if (floorText.includes("2nd") || floorText.includes('Level 2'))
                        targetFloor = "2nd Floor";
                    else if (floorText.includes("New Store"))
                        targetFloor = "New Store";
                    else if (floorText.includes("All Floor"))
                        window.location.href = '/directory';

                    renderLandingTenants(targetFloor);
                });
            });
        });

        // Tenant Scroll Indicators
        const tenantGrid = document.getElementById("landingTenantGrid");
        const tenantScrollRight = document.getElementById("tenantScrollIndicator");
        const tenantScrollLeft = document.getElementById("tenantScrollBack");

        if (tenantGrid) {
            // Function to check if scrollable and update indicator visibility
            function updateScrollIndicator() {
                const isScrollable = tenantGrid.scrollWidth > tenantGrid.clientWidth;
                const scrollLeft = tenantGrid.scrollLeft;
                const maxScroll = tenantGrid.scrollWidth - tenantGrid.clientWidth;
                const isAtEnd = scrollLeft >= maxScroll - 10;
                const isAtStart = scrollLeft <= 10;

                // Right Indicator Logic (Swipe For More)
                if (tenantScrollRight) {
                    if (!isScrollable || isAtEnd) {
                        tenantScrollRight.classList.add("hidden");
                    } else {
                        tenantScrollRight.classList.remove("hidden");
                    }
                }

                // Left Indicator Logic (Swipe Back)
                if (tenantScrollLeft) {
                    if (!isScrollable || isAtStart) {
                        tenantScrollLeft.classList.add("hidden");
                    } else {
                        tenantScrollLeft.classList.remove("hidden");
                    }
                }
            }

            // Update on scroll
            let scrollTimeout;
            tenantGrid.addEventListener("scroll", () => {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(updateScrollIndicator, 100);
            });

            // Initial check
            setTimeout(updateScrollIndicator, 500);

            // Update on window resize
            let resizeTimeout;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updateScrollIndicator, 200);
            });
        }

        // Tenant Grid Navigation Buttons
        const tenantNavPrev = document.getElementById('tenantNavPrev');
        const tenantNavNext = document.getElementById('tenantNavNext');
        const tenantGridForNav = document.getElementById('landingTenantGrid');

        if (tenantNavPrev && tenantNavNext && tenantGridForNav) {
            // Scroll amount (one card width + gap)
            const getScrollAmount = () => {
                const card = tenantGridForNav.querySelector('.tenant-card');
                if (card) {
                    return card.offsetWidth + 24; // card width + gap (1.5rem = 24px)
                }
                return 400; // fallback
            };

            tenantNavPrev.addEventListener('click', () => {
                const scrollAmount = getScrollAmount();
                tenantGridForNav.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            tenantNavNext.addEventListener('click', () => {
                const scrollAmount = getScrollAmount();
                tenantGridForNav.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        }

        // Floor List Vertical Scroll Indicators
        const floorWrapper = document.querySelector(".floor-list-wrapper");
        const floorScrollUp = document.getElementById("floorScrollUp");
        const floorScrollDown = document.getElementById("floorScrollDown");

        if (floorWrapper && floorScrollUp && floorScrollDown) {
            function updateFloorIndicators() {
                const scrollTop = floorWrapper.scrollTop;
                const scrollHeight = floorWrapper.scrollHeight;
                const clientHeight = floorWrapper.clientHeight;
                const isScrollable = scrollHeight > clientHeight;

                // Toggle Up Indicator
                if (scrollTop > 10 && isScrollable) {
                    floorScrollUp.classList.remove("hidden");
                } else {
                    floorScrollUp.classList.add("hidden");
                }

                // Toggle Down Indicator
                if (scrollTop + clientHeight < scrollHeight - 10 && isScrollable) {
                    floorScrollDown.classList.remove("hidden");
                } else {
                    floorScrollDown.classList.add("hidden");
                }
            }

            floorWrapper.addEventListener("scroll", updateFloorIndicators);

            // Initial Check
            setTimeout(updateFloorIndicators, 500);

            // Resize Check
            window.addEventListener("resize", updateFloorIndicators);
        }

        // Tenant Details Modal
        const tenantModal = document.getElementById('tenantModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const modalClose = document.getElementById('modalClose');
        const modalCarouselImages = document.getElementById('modalCarouselImages');
        const modalCarouselPrev = document.getElementById('modalCarouselPrev');
        const modalCarouselNext = document.getElementById('modalCarouselNext');
        const modalCarouselIndicators = document.getElementById('modalCarouselIndicators');
        
        let currentModalImageIndex = 0;
        let modalImages = [];
        let currentTenantData = null;

        // Open modal function
        function openTenantModal(tenantData) {
            currentTenantData = tenantData;
            
            // Populate modal with tenant data
            document.getElementById('modalTenantName').textContent = tenantData.name;
            document.getElementById('modalFloorBadge').textContent = tenantData.floor;
            document.getElementById('modalCategory').textContent = tenantData.category;
            document.getElementById('modalUnit').textContent = 'Unit ' + tenantData.unit;
            document.getElementById('modalHours').textContent = tenantData.hours;
            document.getElementById('modalFloor').textContent = tenantData.floor;
            
            // Set logo
            document.getElementById('modalLogo').innerHTML = `<img src="${tenantData.logo}" alt="${tenantData.name}">`;
            
            // Set description (if available)
            const description = tenantData.description || 'Discover amazing products and services at this store. Visit us today for an unforgettable shopping experience!';
            document.getElementById('modalDescription').innerHTML = `<p>${description}</p>`;
            
            // Setup carousel images
            // For now, we'll use the logo as the main image and create placeholder images
            // In production, you should have actual tenant photos from the database
            modalImages = [
                tenantData.logo,
                tenantData.logo, // You can replace these with actual tenant photos
                tenantData.logo
            ];
            
            currentModalImageIndex = 0;
            renderModalCarousel();
            
            // Show modal with animation
            document.body.style.overflow = 'hidden';
            tenantModal.classList.add('active');
            
            // Show swipe hint and auto-hide after 3 seconds
            const swipeHint = document.getElementById('carouselSwipeHint');
            if (swipeHint) {
                swipeHint.classList.remove('hidden');
                setTimeout(() => {
                    swipeHint.classList.add('hidden');
                }, 3000);
            }
        }

        // Close modal function
        function closeTenantModal() {
            tenantModal.classList.remove('active');
            document.body.style.overflow = '';
            
            // Reset after animation
            setTimeout(() => {
                currentModalImageIndex = 0;
                modalImages = [];
                currentTenantData = null;
            }, 400);
        }

        // Render carousel
        function renderModalCarousel() {
            // Render images
            modalCarouselImages.innerHTML = modalImages.map((img, index) => `
                <div class="carousel-image">
                    <img src="${img}" alt="${currentTenantData.name} - Image ${index + 1}">
                </div>
            `).join('');
            
            // Render indicators
            modalCarouselIndicators.innerHTML = modalImages.map((_, index) => `
                <div class="carousel-indicator ${index === currentModalImageIndex ? 'active' : ''}" data-index="${index}"></div>
            `).join('');
            
            // Update carousel position
            updateModalCarousel();
            
            // Add click events to indicators
            document.querySelectorAll('.carousel-indicator').forEach(indicator => {
                indicator.addEventListener('click', () => {
                    currentModalImageIndex = parseInt(indicator.dataset.index);
                    updateModalCarousel();
                });
            });
        }

        // Update carousel position
        function updateModalCarousel() {
            const offset = -currentModalImageIndex * 100;
            modalCarouselImages.style.transform = `translateX(${offset}%)`;
            
            // Update indicators
            document.querySelectorAll('.carousel-indicator').forEach((indicator, index) => {
                if (index === currentModalImageIndex) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        // Carousel navigation
        if (modalCarouselPrev) {
            modalCarouselPrev.addEventListener('click', () => {
                currentModalImageIndex = (currentModalImageIndex - 1 + modalImages.length) % modalImages.length;
                updateModalCarousel();
            });
        }

        if (modalCarouselNext) {
            modalCarouselNext.addEventListener('click', () => {
                currentModalImageIndex = (currentModalImageIndex + 1) % modalImages.length;
                updateModalCarousel();
            });
        }

        // Close modal events
        if (modalClose) {
            modalClose.addEventListener('click', closeTenantModal);
        }

        if (modalOverlay) {
            modalOverlay.addEventListener('click', closeTenantModal);
        }

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && tenantModal.classList.contains('active')) {
                closeTenantModal();
            }
        });

        // Attach click event to dynamically created see-details buttons
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('see-details-btn') || e.target.closest('.see-details-btn')) {
                const button = e.target.classList.contains('see-details-btn') ? e.target : e.target.closest('.see-details-btn');
                const tenantCard = button.closest('.tenant-card');
                
                if (tenantCard) {
                    // Extract tenant data from the card
                    const tenantData = {
                        name: tenantCard.querySelector('h3')?.textContent || '',
                        floor: tenantCard.querySelector('.floor-badge')?.textContent || '',
                        category: tenantCard.querySelector('.tenant-category')?.textContent?.trim() || '',
                        unit: tenantCard.querySelector('.meta-item span')?.textContent?.replace('Unit ', '') || '',
                        hours: tenantCard.querySelectorAll('.meta-item span')[1]?.textContent || '',
                        logo: tenantCard.querySelector('.tenant-logo img')?.src || '',
                        description: tenantCard.dataset.description || ''
                    };
                    
                    openTenantModal(tenantData);
                }
            }
        });
    </script>
</body>

</html>
