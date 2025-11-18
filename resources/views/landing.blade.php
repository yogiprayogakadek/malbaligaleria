<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beachwalk Shopping Center</title>
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
        }

        /* Hide Scrollbar - All Browsers */
        * {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        *::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        /* Smooth Scroll */
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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), transparent);
            transition: all 0.3s ease;
        }

        header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        header.scrolled .search-bar {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        header.scrolled .search-bar svg {
            stroke: #2c3e50;
        }

        header.scrolled .search-bar input {
            color: #2c3e50;
        }

        header.scrolled .search-bar input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        header.scrolled .logo h1 {
            color: #2c3e50;
        }

        header.scrolled .logo span {
            color: #5fcfda;
        }

        header.scrolled .menu-btn span {
            background: #2c3e50;
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
        }

        .search-bar svg {
            width: 20px;
            height: 20px;
            stroke: white;
            margin-right: 10px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: white;
            font-size: 14px;
            width: 100%;
            outline: none;
        }

        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
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
        }

        .logo span {
            display: block;
            font-size: 10px;
            letter-spacing: 5px;
            margin-top: -5px;
            transition: color 0.3s ease;
        }

        /* Menu Button */
        .menu-btn {
            flex: 0 0 auto;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
            z-index: 101;
        }

        .menu-btn span {
            display: block;
            width: 30px;
            height: 2px;
            background: white;
            margin: 6px 0;
            transition: 0.3s;
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
            z-index: 99;
            padding: 100px 50px;
            overflow-y: auto;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
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

        .sidebar-logo span {
            display: block;
            font-size: 9px;
            letter-spacing: 4px;
            margin-top: -3px;
            color: #5fcfda;
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

        .sidebar nav ul li a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 24px;
            font-weight: 400;
            transition: 0.3s;
            display: block;
        }

        .sidebar nav ul li a:hover {
            color: #5fcfda;
            transform: translateX(10px);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 1200px;
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
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 140px;
            height: 140px;
            z-index: 98;
        }

        .circle-text {
            width: 100%;
            height: 100%;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .circle-text text {
            fill: white;
            font-size: 11px;
            letter-spacing: 4px;
        }

        .contact-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            background: #5fcfda;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .contact-icon:hover {
            background: #4db8c3;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .contact-icon svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        /* About Section */
        .about-section {
            min-height: 100vh;
            background: #f5f3ed;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 60px;
            margin-top: 80px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .info-item {
            text-align: center;
            padding: 20px;
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

        .info-item p {
            font-size: 15px;
            line-height: 1.6;
            color: #5a5a5a;
            margin: 0;
        }

        .divider {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 1px;
            height: 60%;
            background: rgba(44, 62, 80, 0.1);
        }

        /* Mobile Styles */
        /* Experience Section */
        .experience-section {
            min-height: 100vh;
            background: #f5f3ed;
            padding: 100px 40px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .experience-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            align-items: center;
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

        .all-experience-btn:hover::before {
            width: calc(100% + 35px);
            border-radius: 50px;
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

        /* Default state - Destinations is large */
        .experience-card.destinations {
            flex: 2;
        }

        .experience-card:not(.destinations) {
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
            box-shadow: 0 5px 15px rgba(95, 207, 218, 0.4);
        }

        .experience-card-button .arrow {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .experience-card-button:hover .arrow {
            transform: translateX(3px);
        }

        .experience-card-button .text {
            font-weight: 500;
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

        .experience-card:hover {
            flex: 2 !important;
        }

        .experience-cards:hover .experience-card:not(:hover) {
            flex: 0.5 !important;
        }

        /* Show button on Destinations by default and on hover for others */
        .experience-card.destinations .experience-card-content {
            opacity: 1;
        }

        .experience-card.destinations .experience-card-title-vertical {
            opacity: 0;
        }

        /* When hovering any card */
        .experience-card:hover .experience-card-content {
            opacity: 1;
        }

        .experience-card:hover .experience-card-title-vertical {
            opacity: 0;
        }

        /* When hovering other cards, hide Destinations content and show vertical title */
        .experience-cards:hover .experience-card.destinations:not(:hover) .experience-card-content {
            opacity: 0;
        }

        .experience-cards:hover .experience-card.destinations:not(:hover) .experience-card-title-vertical {
            opacity: 1;
        }

        /* Card Backgrounds */
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

        @media (max-width: 1024px) {
            .experience-wrapper {
                flex-direction: column;
            }

            .experience-left {
                flex: none;
                width: 100%;
                padding-left: 0;
                text-align: center;
            }

            .all-experience-btn {
                margin: 0 auto;
            }

            .experience-cards {
                width: 100%;
                height: 500px;
            }

            .experience-card h4 {
                font-size: 24px;
            }
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
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

            .experience-card.destinations {
                flex: none !important;
            }

            .experience-card h4 {
                writing-mode: horizontal-tb;
                font-size: 24px;
                opacity: 1 !important;
            }

            .experience-card-content {
                left: 20px;
                bottom: 20px;
            }

            .experience-card-title-vertical {
                display: none;
            }
        }

        .experience-card-button {
            position: static;
            transform: none;
            margin-top: 15px;
            opacity: 1;
        }
        }

        /* Footer */
        footer {
            background: #f8f8f8;
            color: #5a5a5a;
            padding: 80px 40px 40px;
            width: 100%;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            text-align: center;
            margin-bottom: 50px;
        }

        .footer-logo {
            display: inline-block;
            margin-bottom: 40px;
        }

        .footer-logo svg {
            width: 200px;
            height: auto;
        }

        .footer-nav {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .footer-nav a {
            color: #5a5a5a;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer-nav a:hover {
            color: #5fcfda;
        }

        .footer-contact {
            text-align: center;
            margin-bottom: 40px;
        }

        .footer-address {
            font-size: 15px;
            color: #5a5a5a;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .footer-contact-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .footer-contact-info a {
            color: #5a5a5a;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .footer-contact-info a:hover {
            color: #5fcfda;
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #8bc34a;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-link:hover {
            background: #7cb342;
            transform: translateY(-3px);
        }

        .social-link svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .footer-bottom {
            border-top: 1px solid #e0e0e0;
            padding-top: 30px;
            margin-top: 40px;
            text-align: center;
        }

        .footer-copyright {
            font-size: 13px;
            color: #999;
            margin-bottom: 15px;
        }

        .footer-managed {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 13px;
            color: #999;
        }

        .footer-managed svg {
            height: 16px;
            width: auto;
        }

        @media (max-width: 768px) {
            footer {
                padding: 60px 20px 20px;
            }

            .footer-nav {
                flex-direction: column;
                gap: 20px;
            }

            .footer-contact-info {
                flex-direction: column;
                gap: 15px;
            }
        }

        .about-section {
            padding: 60px 20px;
        }

        .about-container h2 {
            font-size: 36px;
            margin-bottom: 40px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 40px;
            margin-top: 60px;
        }

        .divider {
            display: none;
        }
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            .search-container {
                flex: 1;
                margin-right: 20px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .sidebar {
                width: 100%;
                right: -100%;
                padding: 80px 30px;
            }

            .sidebar-logo {
                left: 30px;
                top: 25px;
            }

            .sidebar-logo h2 {
                font-size: 24px;
            }

            .sidebar.active {
                right: 0;
            }

            .hero h2 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }

            .contact-circle {
                width: 120px;
                height: 120px;
                bottom: 20px;
                right: 20px;
            }

            .circle-text text {
                font-size: 9px;
                letter-spacing: 3px;
            }

            .contact-icon {
                width: 45px;
                height: 45px;
            }

            .contact-icon svg {
                width: 20px;
                height: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
        </div>

        <!-- Logo -->
        <div class="logo">
            <h1>beachwalk<span>SHOPPING CENTER</span></h1>
        </div>

        <!-- Menu Button -->
        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>beachwalk<span>SHOPPING CENTER</span></h2>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#stores">Stores</a></li>
                <li><a href="#dining">Dining</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
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
    <section class="about-section" id="about">
        <div class="about-container">
            <h2>Welcome to beachwalk</h2>
            <div class="about-content">
                <p>beachwalk Shopping Center offers an exclusive Bali resort lifestyle experience with its unique open
                    concept and award-winning architectural design. Surrounded by lush greenery and calming waters,
                    complete with the feel of the ocean breeze, it is no surprise that beachwalk Shopping Center is
                    marked as the oasis in the heart of Kuta.</p>

                <p>As an iconic retail destination in Bali, beachwalk hosts flagship retail stores with a wide selection
                    of international fashion brands, beauty, dining, lifestyle & entertainment. To complete the holiday
                    experience, beachwalk presents various cultural art performances and activities for kids & families.
                </p>

                <p>With its diverse collection of international and domestic stores, facilities, and experiences, this
                    resort-like shopping center caters to your every need with the promise that "Bali Start Here."</p>
            </div>

            <div class="info-grid">
                <div class="info-item" style="position: relative;">
                    <h3>Open Hour</h3>
                    <p>10AM - 10PM (Monday - Thursday)<br>10AM - 11PM (Friday - Sunday)</p>
                    <div class="divider"></div>
                </div>
                <div class="info-item">
                    <h3>Address</h3>
                    <p>Jl. Pantai Kuta, Kec. Kuta Selatan,<br>Kabupaten Badung, Bali, Indonesia 80361</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience-section">
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
                                <span class="arrow">→</span>
                                <span class="text">See More</span>
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
                                <span class="arrow">→</span>
                                <span class="text">See More</span>
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
                                <span class="arrow">→</span>
                                <span class="text">See More</span>
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
                                <span class="arrow">→</span>
                                <span class="text">See More</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Circle -->
    <div class="contact-circle">
        <svg class="circle-text" viewBox="0 0 140 140">
            <defs>
                <path id="circlePath" d="M 70, 70 m -55, 0 a 55,55 0 1,1 110,0 a 55,55 0 1,1 -110,0" />
            </defs>
            <text>
                <textPath href="#circlePath">
                    GET IN TOUCH • GET IN TOUCH •
                </textPath>
            </text>
        </svg>
        <div class="contact-icon">
            <svg viewBox="0 0 24 24">
                <path
                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
        </div>
    </div>

    <!-- Footer Contact Section -->
    <section class="footer-contact">
        <p class="footer-address">
            Jl. Pantai Kuta, Kecamatan Kuta Selatan, Kabupaten Badung, Bali, Indonesia 80361
        </p>
        <div class="footer-contact-info">
            <a href="tel:+623618464888">+62 361 8464 888</a>
            <a href="mailto:hello@beachwalkbali.com">hello@beachwalkbali.com</a>
        </div>

        <!-- Social Media -->
        <div class="footer-social">
            <a href="#" class="social-link" aria-label="Instagram">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none"
                        stroke="white" stroke-width="2" />
                    <circle cx="12" cy="12" r="4" fill="none" stroke="white" stroke-width="2" />
                    <circle cx="18" cy="6" r="1" fill="white" />
                </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                </svg>
            </a>
            <a href="#" class="social-link" aria-label="TikTok">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                </svg>
            </a>
            <a href="#" class="social-link" aria-label="Facebook">
                <svg viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <!-- Logo -->
                <div class="footer-logo">
                    <svg width="200" height="50" viewBox="0 0 200 50">
                        <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
                            font-family="Playfair Display, serif" font-size="28" font-weight="300"
                            letter-spacing="2">
                            <tspan fill="#5fcfda">beach</tspan>
                            <tspan fill="#8bc34a">walk</tspan>
                        </text>
                        <text x="50%" y="75%" dominant-baseline="middle" text-anchor="middle"
                            font-family="Montserrat, sans-serif" font-size="8" letter-spacing="4" fill="#c49b63">
                            SHOPPING CENTER
                        </text>
                    </svg>
                </div>

                <!-- Navigation -->
                <nav class="footer-nav">
                    <a href="#about">About Us</a>
                    <a href="#experience">Experience</a>
                    <a href="#directory">Directory</a>
                    <a href="#personal">Personal Shopper</a>
                    <a href="#corner">Corner's Card</a>
                    <a href="#connect">Connect</a>
                    <a href="#career">Career</a>
                </nav>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="footer-copyright">© 2023 PT Indonesian Paradise Island. All Right Reserved.</p>
                <div class="footer-managed">
                    <span>Managed by</span>
                    <svg width="120" height="20" viewBox="0 0 120 20">
                        <text x="0" y="15" font-family="Arial, sans-serif" font-size="14" font-weight="600"
                            fill="#c49b63">CORNERSTONE</text>
                    </svg>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const header = document.querySelector('header');

        // Menu toggle
        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking on a link
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuBtn.classList.remove('active');
                sidebar.classList.remove('active');
            });
        });

        // Header background on scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
