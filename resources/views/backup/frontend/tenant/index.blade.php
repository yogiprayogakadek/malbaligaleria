<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zara - Tenant Details | Mal Bali Galeria</title>
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
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
            max-width: 100vw;
        }

        body.dark-mode {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }

        body.menu-open {
            overflow: hidden;
        }

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
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.dark-mode header {
            background: rgba(26, 26, 26, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .search-container {
            flex: 0 0 280px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            padding: 12px 20px;
            backdrop-filter: blur(10px);
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

        @media (max-width: 768px) {
            .search-container {
                display: none;
            }
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
            background: #2c3e50;
            margin: 6px 0;
            transition: 0.3s;
        }

        body.dark-mode .menu-btn span {
            background: #e0e0e0;
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

        main {
            padding-top: 80px;
        }

        .carousel-section {
            width: 100%;
            height: 80vh;
            min-height: 500px;
            position: relative;
            overflow: hidden;
            background: #000;
            clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
        }

        .carousel-images {
            display: flex;
            height: 100%;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .carousel-image {
            flex: 0 0 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
            animation: kenBurns 20s ease-in-out infinite alternate;
        }

        @keyframes kenBurns {
            0% {
                transform: scale(1) translateX(0);
            }

            100% {
                transform: scale(1.1) translateX(-20px);
            }
        }

        .carousel-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.4));
        }

        .carousel-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 10;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: white;
            transform: scale(1.2);
        }

        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            color: white;
            font-size: 24px;
        }

        .carousel-arrow:hover {
            background: rgba(95, 207, 218, 0.8);
            border-color: #5fcfda;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-arrow.prev {
            left: 30px;
        }

        .carousel-arrow.next {
            right: 30px;
        }

        .detail-section {
            padding: 100px 40px;
            background: #ffffff;
        }

        body.dark-mode .detail-section {
            background: #1a1a1a;
        }

        .detail-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 60px;
            width: 100%;
        }

        .detail-left {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 40px;
        }

        .tenant-logo-wrapper {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .tenant-logo {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: all 0.4s ease;
        }

        .tenant-logo::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 15px;
            padding: 2px;
            background: linear-gradient(135deg, #5fcfda, transparent);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .tenant-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(95, 207, 218, 0.2);
        }

        .tenant-logo:hover::before {
            opacity: 1;
        }

        body.dark-mode .tenant-logo {
            background: linear-gradient(135deg, #2a2a2a 0%, #333333 100%);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .tenant-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .tenant-location {
            background: #f8f8f8;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .tenant-location {
            background: #2a2a2a;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
        }

        .tenant-location h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        body.dark-mode .tenant-location h4 {
            color: #e0e0e0;
        }

        .location-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #5a5a5a;
        }

        body.dark-mode .location-item {
            color: #b0b0b0;
        }

        .location-item svg {
            width: 18px;
            height: 18px;
            fill: #5fcfda;
            flex-shrink: 0;
        }

        .tenant-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .tenant-info h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 500;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #2c3e50 0%, #5fcfda 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        body.dark-mode .tenant-info h1 {
            background: linear-gradient(135deg, #e0e0e0 0%, #5fcfda 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tenant-category {
            display: inline-block;
            background: #5fcfda;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .tenant-description {
            font-size: 16px;
            line-height: 1.8;
            color: #5a5a5a;
            margin-bottom: 30px;
        }

        body.dark-mode .tenant-description {
            color: #b0b0b0;
        }

        .tenant-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-item label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #5fcfda;
        }

        .detail-item p {
            font-size: 15px;
            color: #2c3e50;
            font-weight: 500;
        }

        body.dark-mode .detail-item p {
            color: #e0e0e0;
        }

        .tenant-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            width: 100%;
            max-width: 100%;
        }

        .action-btn {
            flex: 1;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .action-btn.primary {
            background: #5fcfda;
            color: white;
        }

        .action-btn.primary:hover {
            background: #4db8c3;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(95, 207, 218, 0.4);
        }

        .action-btn.secondary {
            background: transparent;
            color: #2c3e50;
            border: 2px solid #2c3e50;
        }

        body.dark-mode .action-btn.secondary {
            color: #e0e0e0;
            border-color: #e0e0e0;
        }

        .action-btn.secondary:hover {
            background: #2c3e50;
            color: white;
            transform: translateY(-2px);
        }

        body.dark-mode .action-btn.secondary:hover {
            background: #e0e0e0;
            color: #1a1a1a;
        }

        .similar-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
        }

        .similar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .similar-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 500;
            color: #2c3e50;
        }

        body.dark-mode .similar-section h3 {
            color: #e0e0e0;
        }

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

        .similar-tenants-wrapper {
            position: relative;
        }

        .similar-tenants {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-height: calc(2 * 270px + 1 * 20px);
            overflow-y: auto;
            padding-right: 10px;
            scroll-behavior: smooth;
        }

        @media (min-width: 769px) {
            .similar-tenants::-webkit-scrollbar {
                display: block;
                width: 6px;
            }

            .similar-tenants::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.05);
                border-radius: 10px;
            }

            body.dark-mode .similar-tenants::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.05);
            }

            .similar-tenants::-webkit-scrollbar-thumb {
                background: #5fcfda;
                border-radius: 10px;
            }

            .similar-tenants::-webkit-scrollbar-thumb:hover {
                background: #4db8c3;
            }
        }

        .similar-tenant-card {
            position: relative;
            width: 100%;
            height: 250px;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .similar-tenant-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
            z-index: 1;
            transition: background 0.3s ease;
        }

        .similar-tenant-card:hover::before {
            background: linear-gradient(to bottom, rgba(95, 207, 218, 0.3), rgba(0, 0, 0, 0.9));
        }

        .similar-tenant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .similar-tenant-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 25px;
            z-index: 2;
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .similar-tenant-card:hover .similar-tenant-content {
            transform: translateY(0);
            opacity: 1;
        }

        .similar-tenant-content h4 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 500;
            color: white;
            margin-bottom: 10px;
        }

        .similar-tenant-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #5fcfda;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: gap 0.3s ease;
        }

        .similar-tenant-link:hover {
            gap: 12px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .detail-container {
                grid-template-columns: 1fr;
            }

            .detail-left {
                grid-template-columns: 1fr;
            }

            .tenant-logo-wrapper {
                flex-direction: row;
                align-items: flex-start;
            }

            .tenant-logo {
                width: 150px;
                height: 150px;
            }

            .tenant-location {
                flex: 1;
            }

            .similar-tenants {
                flex-direction: row;
                max-height: none;
                overflow-x: auto;
                overflow-y: hidden;
                padding-right: 0;
                padding-bottom: 10px;
            }

            .similar-tenant-card {
                flex: 0 0 300px;
                height: 200px;
            }

            .scroll-indicator svg {
                transform: rotate(90deg);
            }

            @keyframes bounce {

                0%,
                100% {
                    transform: translateX(0) rotate(90deg);
                }

                50% {
                    transform: translateX(5px) rotate(90deg);
                }
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            .sidebar {
                width: 100%;
                padding: 80px 30px 120px;
            }

            .sidebar-logo {
                left: 30px;
                top: 25px;
            }

            .carousel-section {
                height: 60vh;
                min-height: 400px;
            }

            .carousel-arrow {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .carousel-arrow.prev {
                left: 15px;
            }

            .carousel-arrow.next {
                right: 15px;
            }

            .detail-section {
                padding: 60px 20px;
            }

            .detail-container {
                gap: 40px;
            }

            .detail-left {
                gap: 30px;
            }

            .tenant-logo-wrapper {
                flex-direction: column;
                width: 100%;
            }

            .tenant-logo {
                width: 120px;
                height: 120px;
                margin: 0 auto;
            }

            .tenant-location {
                width: 100%;
            }

            .tenant-info {
                width: 100%;
                overflow: hidden;
            }

            .tenant-info h1 {
                font-size: 32px;
            }

            .tenant-description {
                font-size: 15px;
            }

            .tenant-details-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .tenant-actions {
                flex-direction: column;
                width: 100%;
            }

            .action-btn {
                width: 100%;
            }

            .similar-section {
                width: 100%;
                overflow: hidden;
            }

            .similar-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .similar-section h3 {
                font-size: 24px;
            }

            .scroll-indicator {
                font-size: 12px;
            }

            .similar-tenants {
                flex-direction: row;
                max-height: none;
                overflow-x: auto;
                overflow-y: hidden;
                padding-right: 0;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
            }

            .similar-tenants::-webkit-scrollbar {
                height: 6px;
            }

            .similar-tenant-card {
                flex: 0 0 280px;
                height: 200px;
            }

            .similar-tenant-content {
                padding: 20px;
            }

            .similar-tenant-content h4 {
                font-size: 20px;
            }

            .scroll-indicator svg {
                transform: rotate(-90deg);
            }

            @keyframes bounce {

                0%,
                100% {
                    transform: translateX(0) rotate(-90deg);
                }

                50% {
                    transform: translateX(5px) rotate(-90deg);
                }
            }

            .dark-mode-toggle {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }

            .dark-mode-toggle svg {
                width: 20px;
                height: 20px;
                margin-left: -10px;
                margin-top: -10px;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 18px;
            }

            .tenant-info h1 {
                font-size: 28px;
            }

            .tenant-category {
                font-size: 12px;
                padding: 6px 15px;
            }

            .similar-tenant-card {
                flex: 0 0 250px;
                height: 180px;
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
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
</head>

<body>
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

    <main>
        <section class="carousel-section">
            <div class="carousel-images" id="carouselImages">
                <div class="carousel-image"
                    style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1920');">
                </div>
                <div class="carousel-image"
                    style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1920');">
                </div>
                <div class="carousel-image"
                    style="background-image: url('https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1920');">
                </div>
                <div class="carousel-image"
                    style="background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?w=1920');">
                </div>
            </div>

            <button class="carousel-arrow prev" id="carouselPrev">‹</button>
            <button class="carousel-arrow next" id="carouselNext">›</button>

            <div class="carousel-controls">
                <div class="carousel-dot active" data-index="0"></div>
                <div class="carousel-dot" data-index="1"></div>
                <div class="carousel-dot" data-index="2"></div>
                <div class="carousel-dot" data-index="3"></div>
            </div>
        </section>

        <section class="detail-section">
            <div class="detail-container">
                <div class="detail-left">
                    <div class="tenant-logo-wrapper">
                        <div class="tenant-logo">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Zara_Logo.svg/2560px-Zara_Logo.svg.png"
                                alt="Zara Logo">
                        </div>
                        <div class="tenant-location">
                            <h4>Location</h4>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>Ground Floor, Unit G-15</span>
                            </div>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                <span>Open Daily</span>
                            </div>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                <span>10:00 AM - 10:00 PM</span>
                            </div>
                        </div>
                    </div>

                    <div class="tenant-info">
                        <div>
                            <h1>Zara</h1>
                            <span class="tenant-category">Fashion & Apparel</span>
                        </div>

                        <p class="tenant-description">
                            Zara is one of the largest international fashion companies belonging to the Inditex group.
                            We offer the latest fashion trends for women, men, and children through our collections.
                            With a focus on fast fashion, Zara brings runway-inspired designs to customers quickly and
                            affordably.
                        </p>

                        <div class="tenant-details-grid">
                            <div class="detail-item">
                                <label>Brand Origin</label>
                                <p>Spain</p>
                            </div>
                            <div class="detail-item">
                                <label>Established</label>
                                <p>1975</p>
                            </div>
                            <div class="detail-item">
                                <label>Product Category</label>
                                <p>Women, Men, Kids Fashion</p>
                            </div>
                            <div class="detail-item">
                                <label>Price Range</label>
                                <p>$ (Mid to High)</p>
                            </div>
                            <div class="detail-item">
                                <label>Contact</label>
                                <p>+62 361 234 5678</p>
                            </div>
                            <div class="detail-item">
                                <label>Payment Methods</label>
                                <p>Cash, Card, E-Wallet</p>
                            </div>
                        </div>

                        <div class="tenant-actions">
                            <a href="#" class="action-btn primary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Visit Website
                            </a>
                            <a href="#" class="action-btn secondary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Get Directions
                            </a>
                        </div>
                    </div>
                </div>

                <div class="similar-section">
                    <div class="similar-header">
                        <h3>Similar Stores</h3>
                    </div>
                    <div class="similar-tenants-wrapper">
                        <div class="similar-tenants" id="similarTenants">
                            <div class="similar-tenant-card"
                                style="background-image: url('https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800');">
                                <div class="similar-tenant-content">
                                    <h4>H&M</h4>
                                    <a href="#" class="similar-tenant-link">See Details<span>→</span></a>
                                </div>
                            </div>

                            <div class="similar-tenant-card"
                                style="background-image: url('https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?w=800');">
                                <div class="similar-tenant-content">
                                    <h4>Uniqlo</h4>
                                    <a href="#" class="similar-tenant-link">See Details<span>→</span></a>
                                </div>
                            </div>

                            <div class="similar-tenant-card"
                                style="background-image: url('https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=800');">
                                <div class="similar-tenant-content">
                                    <h4>Pull & Bear</h4>
                                    <a href="#" class="similar-tenant-link">See Details<span>→</span></a>
                                </div>
                            </div>

                            <div class="similar-tenant-card"
                                style="background-image: url('https://images.unsplash.com/photo-1467043237213-65f2da53396f?w=800');">
                                <div class="similar-tenant-content">
                                    <h4>Mango</h4>
                                    <a href="#" class="similar-tenant-link">See Details<span>→</span></a>
                                </div>
                            </div>

                            <div class="similar-tenant-card"
                                style="background-image: url('https://images.unsplash.com/photo-1558769132-cb1aea197ce7?w=800');">
                                <div class="similar-tenant-content">
                                    <h4>Massimo Dutti</h4>
                                    <a href="#" class="similar-tenant-link">See Details<span>→</span></a>
                                </div>
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
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
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
        // Menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            sidebar.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        sidebarClose.addEventListener('click', () => {
            menuBtn.classList.remove('active');
            sidebar.classList.remove('active');
            document.body.classList.remove('menu-open');
        });

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
            e.stopPropagation();

            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });

        // Image Carousel
        const carouselImages = document.getElementById('carouselImages');
        const carouselDots = document.querySelectorAll('.carousel-dot');
        const carouselPrev = document.getElementById('carouselPrev');
        const carouselNext = document.getElementById('carouselNext');
        let currentSlide = 0;
        const totalSlides = 4;

        function updateCarousel() {
            carouselImages.style.transform = `translateX(-${currentSlide * 100}%)`;

            carouselDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        carouselNext.addEventListener('click', nextSlide);
        carouselPrev.addEventListener('click', prevSlide);

        carouselDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                updateCarousel();
            });
        });

        let autoplayInterval = setInterval(nextSlide, 5000);

        const carouselSection = document.querySelector('.carousel-section');
        carouselSection.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });

        carouselSection.addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(nextSlide, 5000);
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'ArrowRight') nextSlide();
        });

        // Scroll Indicator
        const similarTenants = document.getElementById('similarTenants');
        const scrollIndicator = document.getElementById('scrollIndicator');

        function checkScroll() {
            if (!similarTenants || !scrollIndicator) return;

            const isDesktop = window.innerWidth > 768;

            if (isDesktop) {
                const scrollTop = similarTenants.scrollTop;
                const scrollHeight = similarTenants.scrollHeight;
                const clientHeight = similarTenants.clientHeight;

                const isScrollable = scrollHeight > clientHeight;

                if (!isScrollable) {
                    scrollIndicator.classList.add('hidden');
                    return;
                }

                const isAtBottom = scrollTop + clientHeight >= scrollHeight - 50;

                if (isAtBottom) {
                    scrollIndicator.classList.add('hidden');
                } else {
                    scrollIndicator.classList.remove('hidden');
                }
            } else {
                const scrollLeft = similarTenants.scrollLeft;
                const scrollWidth = similarTenants.scrollWidth;
                const clientWidth = similarTenants.clientWidth;

                const isScrollable = scrollWidth > clientWidth;

                if (!isScrollable) {
                    scrollIndicator.classList.add('hidden');
                    return;
                }

                const isAtEnd = scrollLeft + clientWidth >= scrollWidth - 50;

                if (isAtEnd) {
                    scrollIndicator.classList.add('hidden');
                } else {
                    scrollIndicator.classList.remove('hidden');
                }
            }
        }

        if (similarTenants && scrollIndicator) {
            similarTenants.addEventListener('scroll', checkScroll);
            window.addEventListener('resize', checkScroll);

            setTimeout(checkScroll, 100);
        }

        window.addEventListener('load', () => {
            document.querySelectorAll('.detail-section, .similar-section').forEach(el => {
                el.classList.add('fade-in');
            });

            setTimeout(checkScroll, 200);
        });
    </script>
</body>

</html>
