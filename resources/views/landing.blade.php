<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria Shopping Center</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Argesta Display';
            src: url('https://fonts.cdnfonts.com/css/argesta-display');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow: hidden;
        }

        body.loaded {
            overflow-x: hidden;
            overflow-y: auto;
        }

        body.dark-mode {
            background-color: #1a1a1a;
            color: #e0e0e0;
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
            background: linear-gradient(135deg, #f5f3ed 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        body.dark-mode .page-loader {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
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
        }

        .loader-logo {
            opacity: 0;
            animation: logoFadeIn 1s ease forwards 0.3s;
            margin-bottom: 50px;
        }

        .loader-logo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: lowercase;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        body.dark-mode .loader-logo h1 {
            color: #e0e0e0;
        }

        .loader-logo span {
            display: block;
            font-size: 12px;
            letter-spacing: 5px;
            color: #5fcfda;
            margin-top: 0;
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
            border-top-color: #5fcfda;
            border-radius: 50%;
            animation: spinnerRotate 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        }

        .spinner-ring:nth-child(1) {
            animation-delay: -0.45s;
        }

        .spinner-ring:nth-child(2) {
            animation-delay: -0.3s;
            border-top-color: rgba(95, 207, 218, 0.6);
        }

        .spinner-ring:nth-child(3) {
            animation-delay: -0.15s;
            border-top-color: rgba(95, 207, 218, 0.3);
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
            width: 280px;
            height: 3px;
            background: rgba(95, 207, 218, 0.2);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            margin: 0 auto 25px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #5fcfda 0%, #4db8c3 100%);
            border-radius: 10px;
            width: 0%;
            animation: progressLoad 3s ease-in-out forwards;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
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
            font-size: 13px;
            color: #5a5a5a;
            letter-spacing: 3px;
            opacity: 0;
            animation: textFadeIn 0.5s ease forwards 1s;
            margin: 0;
            font-weight: 400;
        }

        body.dark-mode .loader-text {
            color: #b0b0b0;
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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2));
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            padding: 15px 40px;
        }

        body.dark-mode header {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }

        body.dark-mode header.scrolled {
            background: rgba(26, 26, 26, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
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
            color: #5fcfda;
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
            background: rgba(95, 207, 218, 0.9);
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            padding: 0;
            cursor: pointer;
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark-mode-toggle:hover {
            background: #4db8c3;
            box-shadow: 0 6px 20px rgba(95, 207, 218, 0.4);
            transform: scale(1.1);
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
            background: rgba(255, 255, 255, 0.3);
            border-color: #5fcfda;
            box-shadow: 0 0 20px rgba(95, 207, 218, 0.3);
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

        /* Mobile: Search di sidebar */
        @media (max-width: 768px) {
            .search-container {
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
            font-family: 'Playfair Display', serif;
            transition: all 0.3s ease;
        }

        .logo span {
            display: block;
            font-size: 10px;
            letter-spacing: 5px;
            margin-top: -5px;
            transition: color 0.3s ease;
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
            font-family: 'Playfair Display', serif;
        }

        body.dark-mode .sidebar-logo h2 {
            color: #e0e0e0;
        }

        .sidebar-logo span {
            display: block;
            font-size: 9px;
            letter-spacing: 4px;
            margin-top: -3px;
            color: #5fcfda;
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
            background: #5fcfda;
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
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 2px;
            background: #5fcfda;
            transition: width 0.3s ease;
        }

        .sidebar nav ul li a:hover {
            color: #5fcfda;
            transform: translateX(10px);
        }

        .sidebar nav ul li a:hover::after {
            width: 50px;
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
            background: url('https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920') center/cover no-repeat;
            will-change: transform;
            transform: translateZ(0);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
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
            font-size: 56px;
            font-weight: 400;
            margin-bottom: 20px;
            line-height: 1.2;
            font-family: 'Playfair Display', serif;
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
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: #5fcfda;
            border-radius: 50%;
            transition: all 0.4s ease;
            z-index: -1;
        }

        .explore-btn::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: #5fcfda;
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
            content: '';
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
            box-shadow: 0 0 30px rgba(95, 207, 218, 0.6), 0 0 60px rgba(95, 207, 218, 0.4);
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
            font-family: 'Playfair Display', serif;
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
            font-family: 'Montserrat', sans-serif;
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
            font-family: 'Playfair Display', serif;
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
            content: '';
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
            font-family: 'Playfair Display', serif;
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
            padding: 5px 15px;
            background: #5fcfda;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
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
            background: #5fcfda;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-btn:hover {
            background: #4db8c3;
            transform: scale(1.1);
            box-shadow: 0 5px 20px rgba(95, 207, 218, 0.4);
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
            font-family: 'Playfair Display', serif;
        }

        body.dark-mode .all-experience-btn {
            color: #e0e0e0;
        }

        .all-experience-btn::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: #5fcfda;
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
            content: '';
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
            box-shadow: 0 0 30px rgba(95, 207, 218, 0.6);
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
            flex: 0.5;
        }

        .experience-card:hover {
            flex: 2 !important;
        }

        .experience-cards:hover .experience-card:not(:hover) {
            flex: 0.5 !important;
        }

        .experience-card::before {
            content: '';
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
            font-family: 'Playfair Display', serif;
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
            background: #5fcfda;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 8px;
        }

        .experience-card-button:hover {
            background: #4db8c3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(95, 207, 218, 0.4), 0 0 30px rgba(95, 207, 218, 0.3);
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
            font-family: 'Playfair Display', serif;
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
            background-image: url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800');
        }

        .experience-card.events {
            background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800');
        }

        .experience-card.destinations {
            background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800');
        }

        .experience-card.new-store {
            background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800');
        }

        /* Event Highlight Section */
        .event-section {
            min-height: 100vh;
            background: #ffffff;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark-mode .event-section {
            background: #1a1a1a;
        }

        .event-container {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .event-container h2 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 400;
            color: #2c3e50;
            margin-bottom: 60px;
            text-align: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active .event-container h2 {
            opacity: 1;
            transform: translateY(0);
        }

        body.dark-mode .event-container h2 {
            color: #e0e0e0;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .event-card {
            position: relative;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }

        .reveal.active .event-card:nth-child(1) {
            animation: slideUpScale 0.8s ease forwards 0.2s;
        }

        .reveal.active .event-card:nth-child(2) {
            animation: slideUpScale 0.8s ease forwards 0.3s;
        }

        @keyframes slideUpScale {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .event-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .event-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }

        .event-card-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 0.4s ease;
        }

        .event-card:hover .event-card-bg {
            transform: scale(1.1);
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(0, 0, 0, 0.8));
            z-index: 1;
        }

        .event-card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            z-index: 2;
            color: white;
        }

        .event-date {
            display: inline-block;
            background: #5fcfda;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .event-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 10px;
            color: white;
        }

        .event-card p {
            font-size: 14px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
        }

        .event-link {
            display: inline-flex;
            align-items: center;
            color: #5fcfda;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            gap: 8px;
            transition: gap 0.3s ease;
        }

        .event-link:hover {
            gap: 12px;
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
            font-family: 'Playfair Display', serif;
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
            width: 80px;
            height: 80px;
            background: #5fcfda;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
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
            font-family: 'Montserrat', sans-serif;
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
            content: '';
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
            font-family: 'Playfair Display', serif;
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
            content: '→';
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
            font-family: 'Playfair Display', serif;
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
    </style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
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
        <div class="search-container">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
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
            <h2>Indonesia's Iconic Resort Lifestyle Destination</h2>
            <p>Retail therapy for communities to connect with nature, leisure and recreations in modern way</p>
            <button class="explore-btn">
                <span class="arrow">→</span>
                <span class="text">Explore beachwalk</span>
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
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>Zara</h3>
                            <p>Fashion & Apparel</p>
                            <span class="tenant-card-tag">Ground Floor</span>
                        </div>
                    </div>
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>H&M</h3>
                            <p>Fashion & Lifestyle</p>
                            <span class="tenant-card-tag">Level 1</span>
                        </div>
                    </div>
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>Sephora</h3>
                            <p>Beauty & Cosmetics</p>
                            <span class="tenant-card-tag">Ground Floor</span>
                        </div>
                    </div>
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>Starbucks</h3>
                            <p>Café & Coffee</p>
                            <span class="tenant-card-tag">Level 2</span>
                        </div>
                    </div>
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>Nike</h3>
                            <p>Sports & Athleisure</p>
                            <span class="tenant-card-tag">Level 1</span>
                        </div>
                    </div>
                    <div class="tenant-card">
                        <div class="tenant-card-image"
                            style="background-image: url('https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=400');">
                        </div>
                        <div class="tenant-card-content">
                            <h3>Dining Hall</h3>
                            <p>Food Court</p>
                            <span class="tenant-card-tag">Level 3</span>
                        </div>
                    </div>
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
            <div class="event-grid">
                <div class="event-card">
                    <div class="event-card-bg"
                        style="background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800');">
                    </div>
                    <div class="event-card-content">
                        <span class="event-date">25 DEC 2024</span>
                        <h3>Christmas Grand Sale</h3>
                        <p>Get up to 70% off on selected items from your favorite brands. Exclusive Christmas deals you
                            don't want to miss!</p>
                        <a href="#" class="event-link">Learn More →</a>
                    </div>
                </div>
                <div class="event-card">
                    <div class="event-card-bg"
                        style="background-image: url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800');">
                    </div>
                    <div class="event-card-content">
                        <span class="event-date">01 JAN 2025</span>
                        <h3>New Year Festival</h3>
                        <p>Ring in the new year with live music, food festival, and spectacular fireworks display at Mal
                            Bali Galeria.</p>
                        <a href="#" class="event-link">Learn More →</a>
                    </div>
                </div>
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
                    <div class="map-placeholder">
                        <div class="map-icon">🗺️</div>
                        <p>Interactive mall map</p>
                    </div>
                </div>
                <div class="map-floors" id="mapFloors">
                    <div class="floor-item active">
                        <h4>Ground Floor</h4>
                        <p>Fashion, Accessories, Cosmetics</p>
                    </div>
                    <div class="floor-item">
                        <h4>Level 1</h4>
                        <p>Electronics, Books, Sports</p>
                    </div>
                    <div class="floor-item">
                        <h4>Level 2</h4>
                        <p>Restaurants, Cafés, Food Court</p>
                    </div>
                    <div class="floor-item">
                        <h4>Level 3</h4>
                        <p>Entertainment, Cinema, Kids Zone</p>
                    </div>
                    <div class="floor-item">
                        <h4>Basement</h4>
                        <p>Supermarket, Parking</p>
                    </div>
                    <div class="scroll-indicator" id="scrollIndicator">
                        SCROLL FOR MORE
                        <svg viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <script>
        // Page Loader
        const pageLoader = document.getElementById('pageLoader');

        // Ensure loader shows first
        let minLoadTime = 3500; // Minimum 3.5 seconds
        let loadStartTime = Date.now();

        window.addEventListener('load', () => {
            let loadTime = Date.now() - loadStartTime;
            let remainingTime = Math.max(0, minLoadTime - loadTime);

            // Hide loader after ensuring minimum display time
            setTimeout(() => {
                pageLoader.classList.add('hidden');
                document.body.classList.add('loaded');

                // Remove from DOM after transition
                setTimeout(() => {
                    pageLoader.style.display = 'none';
                }, 500);
            }, remainingTime);
        });

        // Fallback: if load event doesn't fire within 5 seconds, hide loader anyway
        setTimeout(() => {
            if (!document.body.classList.contains('loaded')) {
                pageLoader.classList.add('hidden');
                document.body.classList.add('loaded');
                setTimeout(() => {
                    pageLoader.style.display = 'none';
                }, 500);
            }
        }, 5000);

        // Menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');
        const header = document.querySelector('header');

        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            sidebar.classList.toggle('active');
            // Toggle body scroll
            document.body.classList.toggle('menu-open');
        });

        // Close sidebar with close button
        sidebarClose.addEventListener('click', () => {
            menuBtn.classList.remove('active');
            sidebar.classList.remove('active');
            document.body.classList.remove('menu-open');
        });

        // Close sidebar when clicking on a link
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuBtn.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });

        // Sticky Header - Always visible
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Add scrolled class for background
            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            document.body.classList.toggle('dark-mode');

            // Save preference
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });

        // Enhanced Parallax Effect for Hero Section
        const hero = document.querySelector('.hero');
        const heroBg = document.querySelector('.hero-bg');

        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;

            if (hero && heroBg && scrolled < hero.offsetHeight) {
                // Parallax untuk background - bergerak lebih lambat
                const parallaxSpeed = 0.5;
                heroBg.style.transform = `translateY(${scrolled * parallaxSpeed}px) scale(1.1)`;

                // Fade out hero content saat scroll
                const heroContent = document.querySelector('.hero-content');
                const opacity = 1 - (scrolled / (hero.offsetHeight * 0.7));
                const translateY = scrolled * 0.3;

                if (heroContent) {
                    heroContent.style.opacity = Math.max(0, opacity);
                    heroContent.style.transform = `translateY(${translateY}px)`;
                }

                // Zoom in effect pada background
                const scale = 1.1 + (scrolled * 0.0001);
                heroBg.style.transform = `translateY(${scrolled * parallaxSpeed}px) scale(${Math.min(scale, 1.3)})`;
            }
        });

        // Reveal on Scroll Animation
        const revealElements = document.querySelectorAll('.reveal');

        const revealOnScroll = () => {
            const windowHeight = window.innerHeight;
            const revealPoint = 100;

            revealElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;

                if (elementTop < windowHeight - revealPoint) {
                    element.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check

        // Tenant Carousel
        const carouselContainer = document.getElementById('carouselContainer');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const cards = document.querySelectorAll('.tenant-card');

        let currentIndex = 0;
        let cardsPerView = 4;

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
            updateCarousel();
        };

        const updateCarousel = () => {
            const cardWidth = cards[0].offsetWidth;
            const gap = 30;
            const offset = -(currentIndex * (cardWidth + gap));
            carouselContainer.style.transform = `translateX(${offset}px)`;

            // Update button states
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= cards.length - cardsPerView;
        };

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex < cards.length - cardsPerView) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Auto-play carousel
        let autoplayInterval = setInterval(() => {
            if (currentIndex < cards.length - cardsPerView) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        }, 5000);

        // Pause autoplay on hover
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });

        carouselContainer.addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(() => {
                if (currentIndex < cards.length - cardsPerView) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }, 5000);
        });

        // Update on window resize
        window.addEventListener('resize', () => {
            updateCardsPerView();
        });

        // Initial setup
        updateCardsPerView();

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerHeight = header.offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Experience cards - track last hovered card and persist on scroll
        const experienceCardsContainer = document.querySelector('.experience-cards');
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

        // When mouse leaves the container, expand the last hovered card
        if (experienceCardsContainer) {
            experienceCardsContainer.addEventListener('mouseleave', () => {
                // Remove all expanded/promotion states
                experienceCards.forEach(card => {
                    card.classList.remove('promotion', 'expanded');
                });
                // Add expanded state to last hovered card
                if (lastHoveredCard) {
                    lastHoveredCard.classList.add('expanded');
                }
            });
        }

        // Keep expanded card visible when scrolling
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            if (!isHovering && lastHoveredCard && experienceCardsContainer) {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    // Reapply expanded class to ensure it stays visible
                    experienceCards.forEach(card => {
                        card.classList.remove('promotion', 'expanded');
                    });
                    lastHoveredCard.classList.add('expanded');
                }, 100);
            }
        });

        // Mall Directory Scroll Indicator
        const mapFloors = document.getElementById('mapFloors');
        const scrollIndicator = document.getElementById('scrollIndicator');

        if (mapFloors && scrollIndicator) {
            // Check if scrollable
            const checkScrollable = () => {
                const isScrollable = mapFloors.scrollHeight > mapFloors.clientHeight;
                if (!isScrollable) {
                    scrollIndicator.classList.add('hidden');
                }
            };

            // Hide indicator when scrolled to bottom
            mapFloors.addEventListener('scroll', () => {
                const isAtBottom = mapFloors.scrollHeight - mapFloors.scrollTop <= mapFloors.clientHeight + 10;
                if (isAtBottom) {
                    scrollIndicator.classList.add('hidden');
                } else {
                    scrollIndicator.classList.remove('hidden');
                }
            });

            checkScrollable();
        }

        // Add intersection observer for more advanced animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        revealElements.forEach(element => {
            observer.observe(element);
        });

        // Add stagger animation to tenant cards
        const tenantCards = document.querySelectorAll('.tenant-card');
        tenantCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Enhance button interactions with ripple effect
        const buttons = document.querySelectorAll('button:not(#darkModeToggle), .explore-btn, .all-experience-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
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
                if (currentPosition === 'static') {
                    this.style.position = 'relative';
                }
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
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
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.style.backgroundImage = `url(${img.dataset.src})`;
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('[data-src]').forEach(img => {
            imageObserver.observe(img);
        });

        // Add fade-in animation for footer elements
        const footerElements = document.querySelectorAll('footer .footer-links a, footer .footer-social-link');
        footerElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'all 0.5s ease';
            element.style.transitionDelay = `${index * 0.05}s`;
        });

        const footerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footerElements.forEach(element => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    });
                }
            });
        }, {
            threshold: 0.1
        });

        const footer = document.querySelector('footer');
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
        window.removeEventListener('scroll', revealOnScroll);
        window.addEventListener('scroll', debouncedReveal);

        // Add loading state
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');

            // Trigger initial animations
            setTimeout(() => {
                revealOnScroll();
            }, 100);
        });

        // Console easter egg
        console.log('%c🏬 Welcome to Mal Bali Galeria Shopping Center! ',
            'background: #5fcfda; color: white; font-size: 20px; padding: 10px;');
        console.log('%cExperience the finest shopping in Denpasar, Bali', 'color: #2c3e50; font-size: 14px;');
    </script>
</body>

</html>
