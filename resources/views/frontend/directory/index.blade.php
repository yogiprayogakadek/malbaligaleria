<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Directory - Mal Bali Galeria</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        body.dark-mode {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }

        /* Hide Scrollbar */
        * {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        *::-webkit-scrollbar {
            display: none;
        }

        /* Header */
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
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
        }

        body.dark-mode header {
            background: rgba(26, 26, 26, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .header-search {
            flex: 0 0 280px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        body.dark-mode .search-bar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-bar:focus-within {
            border-color: #5fcfda;
            box-shadow: 0 0 20px rgba(95, 207, 218, 0.3);
        }

        .search-bar svg {
            width: 20px;
            height: 20px;
            stroke: #2c3e50;
            margin-right: 10px;
        }

        body.dark-mode .search-bar svg {
            stroke: #e0e0e0;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: #2c3e50;
            font-size: 14px;
            width: 100%;
            outline: none;
        }

        body.dark-mode .search-bar input {
            color: #e0e0e0;
        }

        .search-bar input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .logo h1 {
            color: #2c3e50;
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: lowercase;
            font-family: 'Playfair Display', serif;
        }

        body.dark-mode .logo h1 {
            color: #e0e0e0;
        }

        .logo span {
            display: block;
            font-size: 10px;
            letter-spacing: 5px;
            margin-top: -5px;
            color: #5fcfda;
        }

        .menu-btn {
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
            background: #2c3e50;
            margin: 6px 0;
            transition: 0.3s;
        }

        body.dark-mode .menu-btn span {
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

        body.menu-open {
            overflow: hidden;
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
            cursor: pointer;
            transition: all 0.3s ease;
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

        .dark-mode-toggle svg {
            width: 24px;
            height: 24px;
            fill: white;
            transition: opacity 0.5s ease, transform 0.5s ease;
            position: absolute;
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

        /* Main Content */
        .main-content {
            padding-top: 100px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 50px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        body.dark-mode .page-header h1 {
            color: #e0e0e0;
        }

        .page-header p {
            font-size: 16px;
            color: #666666;
            font-weight: 400;
        }

        body.dark-mode .page-header p {
            color: #b0b0b0;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 80px 40px 30px;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 100px;
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
        }

        @media (max-width: 768px) {
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

            .sidebar {
                width: 100%;
                padding: 80px 30px 120px;
            }

            .sidebar-logo {
                left: 30px;
                top: 25px;
            }

            .sidebar-close {
                right: 25px;
                top: 25px;
            }
        }

        /* Filter Section */
        .filter-section {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 50px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.2s forwards;
            border: 1px solid #e8e8e8;
        }

        body.dark-mode .filter-section {
            background: #2a2a2a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-color: #3a3a3a;
        }

        .view-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .view-btn {
            flex: 1;
            padding: 14px 28px;
            border: 2px solid #e0e0e0;
            background: white;
            color: #666666;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .view-btn.active {
            background: #5fcfda;
            color: white;
            border-color: #5fcfda;
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.25);
        }

        .view-btn:hover:not(.active) {
            background: #f5f5f5;
            border-color: #5fcfda;
            color: #5fcfda;
        }

        .filter-controls {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-size: 12px;
            font-weight: 700;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        body.dark-mode .filter-group label {
            color: #e0e0e0;
        }

        .filter-input {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 13px 16px;
            transition: all 0.3s ease;
        }

        body.dark-mode .filter-input {
            background: #1a1a1a;
            border: 1px solid #3a3a3a;
        }

        .filter-input:focus-within {
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .filter-input svg {
            width: 18px;
            height: 18px;
            stroke: #999999;
            margin-right: 10px;
        }

        body.dark-mode .filter-input svg {
            stroke: #b0b0b0;
        }

        .filter-input input,
        .filter-input select {
            background: transparent;
            border: none;
            color: #2c3e50;
            font-size: 14px;
            width: 100%;
            outline: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
        }

        body.dark-mode .filter-input input,
        body.dark-mode .filter-input select {
            color: #e0e0e0;
        }

        .filter-input input::placeholder {
            color: #999999;
            font-weight: 400;
        }

        body.dark-mode .filter-input input::placeholder {
            color: #666;
        }

        .filter-input select {
            cursor: pointer;
        }

        /* Tenant Grid */
        .tenant-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .tenant-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            position: relative;
            border: 1px solid #f0f0f0;
        }

        body.dark-mode .tenant-card {
            background: #2a2a2a;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border-color: #3a3a3a;
        }

        .tenant-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4A90E2, #357ABD);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tenant-card:hover::before {
            transform: scaleX(1);
        }

        .tenant-card.show {
            animation: cardFadeIn 0.6s ease forwards;
        }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .tenant-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 12px 32px rgba(74, 144, 226, 0.15);
        }

        body.dark-mode .tenant-card:hover {
            box-shadow: 0 25px 50px rgba(95, 207, 218, 0.35);
        }

        .tenant-logo {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        body.dark-mode .tenant-logo {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        }

        .tenant-logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.08), transparent);
            transition: left 0.6s ease;
        }

        .tenant-card:hover .tenant-logo::before {
            left: 100%;
        }

        .tenant-logo img {
            max-width: 150px;
            max-height: 120px;
            object-fit: contain;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            filter: grayscale(0.1);
        }

        .tenant-card:hover .tenant-logo img {
            transform: scale(1.08);
            filter: grayscale(0);
        }

        .tenant-info {
            padding: 28px;
            position: relative;
        }

        .tenant-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 28px;
            right: 28px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e8e8e8, transparent);
        }

        .floor-badge {
            position: absolute;
            top: -12px;
            right: 28px;
            background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.25);
        }

        .tenant-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
            transition: color 0.3s ease;
        }

        body.dark-mode .tenant-info h3 {
            color: #e0e0e0;
        }

        .tenant-card:hover .tenant-info h3 {
            color: #4A90E2;
        }

        .tenant-category {
            font-size: 13px;
            color: #666666;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        body.dark-mode .tenant-category {
            color: #b0b0b0;
        }

        .tenant-category svg {
            width: 16px;
            height: 16px;
            fill: #4A90E2;
        }

        .tenant-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #666666;
            font-weight: 500;
        }

        body.dark-mode .meta-item {
            color: #b0b0b0;
        }

        .meta-item svg {
            width: 14px;
            height: 14px;
            fill: #4A90E2;
        }

        .see-details-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #5fcfda;
            color: white;
            padding: 13px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            width: 100%;
            justify-content: center;
            letter-spacing: 0.5px;
        }

        .see-details-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .see-details-btn:hover::before {
            left: 100%;
        }

        .see-details-btn:hover {
            background: #4db8c3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 144, 226, 0.3);
        }

        .see-details-btn svg {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
        }

        .see-details-btn:hover svg {
            transform: translateX(4px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            display: none;
        }

        .empty-state.show {
            display: block;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            fill: #5fcfda;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        body.dark-mode .empty-state h3 {
            color: #e0e0e0;
        }

        .empty-state p {
            color: #5a5a5a;
        }

        body.dark-mode .empty-state p {
            color: #b0b0b0;
        }

        /* Toastr Notification */
        .toastr {
            position: fixed;
            top: 100px;
            right: 30px;
            background: white;
            padding: 20px 25px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: none;
            align-items: center;
            gap: 15px;
            min-width: 300px;
            animation: slideInRight 0.4s ease;
            border-left: 5px solid #5fcfda;
        }

        body.dark-mode .toastr {
            background: #2a2a2a;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .toastr.show {
            display: flex;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toastr-icon {
            width: 40px;
            height: 40px;
            background: #5fcfda;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .toastr-content h4 {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        body.dark-mode .toastr-content h4 {
            color: #e0e0e0;
        }

        .toastr-content p {
            font-size: 14px;
            color: #5a5a5a;
            margin: 0;
        }

        body.dark-mode .toastr-content p {
            color: #b0b0b0;
        }

        .toastr-close {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #5a5a5a;
            transition: all 0.3s ease;
            margin-left: auto;
        }

        body.dark-mode .toastr-close {
            background: rgba(255, 255, 255, 0.1);
            color: #b0b0b0;
        }

        .toastr-close:hover {
            background: #ff4757;
            color: white;
            transform: rotate(90deg);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .tenant-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-controls {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            .header-search {
                display: none;
            }

            .logo {
                position: static;
                transform: none;
                text-align: left;
                flex: 1;
            }

            .logo h1 {
                font-size: 24px;
            }

            .container {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 36px;
            }

            .tenant-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .filter-section {
                padding: 20px;
            }

            .view-toggle {
                flex-direction: column;
            }

            .toastr {
                right: 20px;
                left: 20px;
                top: 80px;
                min-width: auto;
            }
        }
    </style>
</head>

<body>
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
        <div class="header-search">
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="headerSearch">
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

    <!-- Toastr Notification -->
    <div class="toastr" id="toastr">
        <div class="toastr-icon">🚧</div>
        <div class="toastr-content">
            <h4>Feature in Development</h4>
            <p>Map View is coming soon!</p>
        </div>
        <button class="toastr-close" id="toastrClose">×</button>
    </div>

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
                <li><a href="index.html">Home</a></li>
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Tenant Directory</h1>
                <p>Discover our collection of premium brands and stores</p>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="view-toggle">
                    <button class="view-btn" id="mapViewBtn">Map View</button>
                    <button class="view-btn active" id="listViewBtn">List View</button>
                </div>

                <div class="filter-controls">
                    <div class="filter-group">
                        <label>Search Tenant</label>
                        <div class="filter-input">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle cx="11" cy="11" r="8" stroke-width="2" />
                                <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <input type="text" placeholder="What do you want to find" id="searchInput">
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>Floors</label>
                        <div class="filter-input">
                            <select id="floorFilter">
                                <option value="">All Floors</option>
                                <option value="Ground Floor">Ground Floor</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>Categories</label>
                        <div class="filter-input">
                            <select id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="Fashion & Apparel">Fashion & Apparel</option>
                                <option value="Fashion & Accessories">Fashion & Accessories</option>
                                <option value="Beauty & Health">Beauty & Health</option>
                                <option value="Jewelry & Watches">Jewelry & Watches</option>
                                <option value="Food & Beverage">Food & Beverage</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tenant Grid -->
            <div class="tenant-grid" id="tenantGrid">
                <!-- Tenants will be dynamically inserted here -->
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState">
                <svg viewBox="0 0 24 24">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" />
                </svg>
                <h3>No tenants found</h3>
                <p>Try adjusting your search or filter criteria</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
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
        // Tenant Data
        const tenants = [{
                name: 'Uniqlo',
                category: 'Fashion & Apparel',
                floor: 'Ground Floor',
                unit: '1C-89',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/9/92/UNIQLO_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Japanese casual wear designer, manufacturer and retailer offering high-quality basics and seasonal fashion.'
            },
            {
                name: 'Zara',
                category: 'Fashion & Apparel',
                floor: 'Ground Floor',
                unit: '1C-73',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Zara_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer specializing in fast fashion clothing and accessories for men, women, and children.'
            },
            {
                name: 'TUMI',
                category: 'Fashion & Accessories',
                floor: 'Ground Floor',
                unit: '1C-76',
                logo: 'https://logos-world.net/wp-content/uploads/2022/04/Tumi-Logo.png',
                hours: '10:00 AM - 10:00 PM',
                description: 'Premium travel and lifestyle brand offering high-quality luggage, bags, and accessories.'
            },
            {
                name: 'Pandora',
                category: 'Fashion & Accessories',
                floor: 'Ground Floor',
                unit: '1C-79',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/8/83/Pandora_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Danish jewelry manufacturer known for customizable charm bracelets and elegant jewelry pieces.'
            },
            {
                name: 'Sephora',
                category: 'Beauty & Health',
                floor: 'Ground Floor',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/000000/ffffff?text=SEPHORA',
                hours: '10:00 AM - 10:00 PM',
                description: 'French multinational chain of personal care and beauty stores featuring cosmetics and skincare products.'
            },
            {
                name: 'Victoria\'s Secret',
                category: 'Fashion & Accessories',
                floor: 'Level 1',
                unit: '1A-38',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/29/Victoria%27s_Secret_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American lingerie, clothing, and beauty retailer known for high visibility marketing and branding.'
            },
            {
                name: 'Mango',
                category: 'Fashion & Apparel',
                floor: 'Level 1',
                unit: '1C-78',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/23/Mango_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish clothing design and manufacturing company offering contemporary fashion for urban women and men.'
            },
            {
                name: 'La Senza',
                category: 'Fashion & Accessories',
                floor: 'Level 1',
                unit: '1A-26',
                logo: 'https://via.placeholder.com/150x80/e91e63/ffffff?text=LA+SENZA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Canadian fashion retailer specializing in lingerie and intimate apparel for women.'
            },
            {
                name: 'Casio G-Shock',
                category: 'Jewelry & Watches',
                floor: 'Level 2',
                unit: '1A-17',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Casio_G-Shock_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Line of watches manufactured by Casio, designed to resist mechanical stress, shock and vibration.'
            },
            {
                name: 'Oysho',
                category: 'Fashion & Accessories',
                floor: 'Level 2',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/333333/ffffff?text=OYSHO',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer specializing in women\'s homewear, underwear, and loungewear.'
            },
            {
                name: 'Chatime',
                category: 'Food & Beverage',
                floor: 'Level 2',
                unit: '2C-T',
                logo: 'https://via.placeholder.com/150x80/ff6b6b/ffffff?text=Chatime',
                hours: '10:00 AM - 10:00 PM',
                description: 'Taiwanese global franchise teahouse chain offering bubble tea and other tea-based beverages.'
            },
            {
                name: 'Dairy Queen',
                category: 'Food & Beverage',
                floor: 'Level 3',
                unit: 'D1',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/a/ae/Dairy_Queen_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American chain of soft serve ice cream and fast-food restaurants famous for Blizzards and ice cream cakes.'
            },
            {
                name: 'ACE Hardware',
                category: 'Home & Lifestyle',
                floor: 'Ground Floor',
                unit: 'A1',
                logo: 'https://via.placeholder.com/150x80/8b0000/ffffff?text=ACE',
                hours: '9:00 AM - 10:00 PM',
                description: 'Hardware and home improvement retail store offering tools, building materials, and home essentials.'
            },
            {
                name: 'Matahari',
                category: 'Department Store',
                floor: 'Ground Floor',
                unit: 'B1',
                logo: 'https://via.placeholder.com/150x80/1e3a8a/ffffff?text=MATAHARI',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian department store chain offering fashion, cosmetics, and household goods.'
            },
            {
                name: 'Hypermart',
                category: 'Supermarket',
                floor: '2nd Floor',
                unit: 'C1',
                logo: 'https://via.placeholder.com/150x80/ffd700/333333?text=HYPERMART',
                hours: '8:00 AM - 11:00 PM',
                description: 'Hypermarket offering groceries, fresh produce, household items, and everyday essentials.'
            },
            {
                name: 'Gramedia',
                category: 'Books & Stationery',
                floor: '2nd Floor',
                unit: 'C2',
                logo: 'https://via.placeholder.com/150x80/ff9800/ffffff?text=GRAMEDIA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian bookstore chain offering books, stationery, toys, and multimedia products.'
            }
        ];

        // Toastr Notification System
        const toastr = document.getElementById('toastr');
        const toastrClose = document.getElementById('toastrClose');

        function showToastr(title, message, duration = 3000) {
            toastr.querySelector('.toastr-content h4').textContent = title;
            toastr.querySelector('.toastr-content p').textContent = message;
            toastr.classList.add('show');

            setTimeout(() => {
                hideToastr();
            }, duration);
        }

        function hideToastr() {
            toastr.classList.remove('show');
        }

        toastrClose.addEventListener('click', hideToastr);

        // Menu Toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            sidebar.classList.toggle('active');
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

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });

        // Render Tenants
        const tenantGrid = document.getElementById('tenantGrid');
        const emptyState = document.getElementById('emptyState');

        function renderTenants(tenantsToRender) {
            tenantGrid.innerHTML = '';

            if (tenantsToRender.length === 0) {
                emptyState.classList.add('show');
                return;
            }

            emptyState.classList.remove('show');

            tenantsToRender.forEach((tenant, index) => {
                const card = document.createElement('div');
                card.className = 'tenant-card';
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

                tenantGrid.appendChild(card);

                // Trigger animation
                setTimeout(() => {
                    card.classList.add('show');
                }, 50);
            });
        }

        // Filter Function
        function filterTenants() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const headerSearchTerm = document.getElementById('headerSearch').value.toLowerCase();
            const selectedFloor = document.getElementById('floorFilter').value;
            const selectedCategory = document.getElementById('categoryFilter').value;

            const combinedSearch = searchTerm || headerSearchTerm;

            const filtered = tenants.filter(tenant => {
                const matchesSearch = tenant.name.toLowerCase().includes(combinedSearch) ||
                    tenant.category.toLowerCase().includes(combinedSearch);
                const matchesFloor = !selectedFloor || tenant.floor === selectedFloor;
                const matchesCategory = !selectedCategory || tenant.category === selectedCategory;

                return matchesSearch && matchesFloor && matchesCategory;
            });

            renderTenants(filtered);
        }

        // Event Listeners
        document.getElementById('searchInput').addEventListener('input', filterTenants);
        document.getElementById('headerSearch').addEventListener('input', filterTenants);
        document.getElementById('floorFilter').addEventListener('change', filterTenants);
        document.getElementById('categoryFilter').addEventListener('change', filterTenants);

        // View Toggle
        const mapViewBtn = document.getElementById('mapViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');

        mapViewBtn.addEventListener('click', function() {
            showToastr('Feature in Development', 'Interactive Map View is coming soon! Stay tuned for updates.',
                4000);
        });

        listViewBtn.addEventListener('click', function() {
            mapViewBtn.classList.remove('active');
            listViewBtn.classList.add('active');
        });

        // Initial Render - render after DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            renderTenants(tenants);
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('button:not(#darkModeToggle)');
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

        // Console easter egg
        console.log('%c🏬 Welcome to Mal Bali Galeria Tenant Directory! ',
            'background: #5fcfda; color: white; font-size: 16px; padding: 10px;');
        console.log('%cDiscover amazing brands and stores', 'color: #2c3e50; font-size: 12px;');
    </script>
</body>

</html>
