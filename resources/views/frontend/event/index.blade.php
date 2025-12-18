<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega Sale - Event Details | Mal Bali Galeria</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
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
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            line-height: 1.6;
            background: var(--bg-light);
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1), color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-x: hidden;
            color: var(--text-dark);
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

        /* Hide content until loaded */
        body:not(.loaded) > *:not(.page-loader) {
            opacity: 0;
            visibility: hidden;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
            margin-bottom: 0.5em;
            font-weight: 600;
        }

        /* Page Loader (Exact Match from Directory) */
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
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.6s cubic-bezier(0.4, 0, 0.2, 1);
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
            font-family: 'Playfair Display', serif;
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
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

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

        .spinner-ring:nth-child(1) { animation-delay: -0.45s; }
        .spinner-ring:nth-child(2) { animation-delay: -0.3s; border-top-color: var(--secondary-color); }
        .spinner-ring:nth-child(3) { animation-delay: -0.15s; border-top-color: var(--accent-color); }

        @keyframes spinnerRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

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
            0% { width: 0%; }
            30% { width: 30%; }
            60% { width: 60%; }
            90% { width: 90%; }
            100% { width: 100%; }
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
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
        
        @keyframes textFadeIn { to { opacity: 1; } }

        /* Header (Exact Match) */
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
            background: rgba(250, 250, 248, 0.98);
            box-shadow: 0 4px 20px rgba(44, 95, 93, 0.08);
            backdrop-filter: blur(30px);
        }

        body.dark-mode header {
            background: rgba(26, 31, 30, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        .header-search { flex: 0 0 280px; }

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
            border-color: var(--primary-color);
            box-shadow: 0 0 20px rgba(44, 95, 93, 0.2), 0 0 40px rgba(44, 95, 93, 0.1);
        }

        .search-bar svg {
            width: 20px;
            height: 20px;
            stroke: #2c3e50;
            margin-right: 10px;
        }

        body.dark-mode .search-bar svg { stroke: #e0e0e0; }

        .search-bar input {
            background: transparent;
            border: none;
            color: #2c3e50;
            font-size: 14px;
            width: 100%;
            outline: none;
        }

        body.dark-mode .search-bar input { color: #e0e0e0; }
        
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

        body.dark-mode .logo h1 { color: #e0e0e0; }

        .logo span {
            display: block;
            font-size: 10px;
            letter-spacing: 5px;
            margin-top: -5px;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        body.dark-mode .menu-btn span { background: #e0e0e0; }

        .menu-btn.active span { background: #2c3e50; }
        body.dark-mode .menu-btn.active span { background: #e0e0e0; }
        .menu-btn.active span:nth-child(1) { transform: rotate(-45deg) translate(-6px, 6px); }
        .menu-btn.active span:nth-child(2) { opacity: 0; }
        .menu-btn.active span:nth-child(3) { transform: rotate(45deg) translate(-6px, -6px); }

        /* Header Logo Circle */
        .header-logo-circle {
            display: flex; align-items: center; justify-content: center;
            width: 50px; height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(44, 95, 93, 0.2);
            transition: all 0.3s ease;
        }
        .header-logo-circle:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(44, 95, 93, 0.3); }

        /* Sidebar (Exact Match) */
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
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.05);
        }

        body.dark-mode .sidebar {
            background: rgba(26, 31, 30, 0.98);
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
        }

        .sidebar.active { right: 0; }
        
        .sidebar-logo {
            position: absolute;
            left: 50px;
            top: 30px;
            opacity: 0;
            transition: opacity 0.4s ease 0.3s;
        }
        
        .sidebar.active .sidebar-logo { opacity: 1; }

        .sidebar-logo h2 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: lowercase;
            font-family: 'Playfair Display', serif;
        }
        body.dark-mode .sidebar-logo h2 { color: #e0e0e0; }
        
        .sidebar-logo span {
            display: block;
            font-size: 9px;
            letter-spacing: 4px;
            margin-top: -3px;
            color: var(--secondary-color);
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

        .sidebar.active .sidebar-close { opacity: 1; }
        .sidebar-close span { 
            display: block; width: 30px; height: 2px; background: #2c3e50; margin: 6px 0; transition: 0.3s; 
        }
        body.dark-mode .sidebar-close span { background: #e0e0e0; }
        .sidebar-close span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .sidebar-close span:nth-child(2) { opacity: 0; }
        .sidebar-close span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        .sidebar nav ul { list-style: none; }
        .sidebar nav ul li { 
            margin: 30px 0; opacity: 0; transform: translateX(50px); transition: all 0.3s ease; 
        }
        
        .sidebar.active nav ul li { opacity: 1; transform: translateX(0); }
        .sidebar.active nav ul li:nth-child(1) { transition-delay: 0.1s; }
        .sidebar.active nav ul li:nth-child(2) { transition-delay: 0.2s; }
        .sidebar.active nav ul li:nth-child(3) { transition-delay: 0.3s; }
        .sidebar.active nav ul li:nth-child(4) { transition-delay: 0.4s; }
        .sidebar.active nav ul li:nth-child(5) { transition-delay: 0.5s; }
        .sidebar.active nav ul li:nth-child(6) { transition-delay: 0.6s; }

        .sidebar nav ul li a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 24px;
            font-weight: 400;
            transition: 0.3s;
            display: block;
            position: relative;
        }
        body.dark-mode .sidebar nav ul li a { color: #e0e0e0; }
        .sidebar nav ul li a::after {
            content: ''; position: absolute; left: 0; bottom: -5px; width: 0; height: 2px; 
            background: var(--secondary-color); transition: width 0.3s ease;
        }
        .sidebar nav ul li a:hover { color: var(--secondary-color); transform: translateX(10px); }
        .sidebar nav ul li a:hover::after { width: 50px; }

        /* Mobile Sidebar Search */
        .sidebar-search {
            display: none;
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
        }
        @media (max-width: 768px) { .sidebar-search { display: block; } }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 101;
            background: var(--secondary-gradient);
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
            background: var(--primary-gradient);
            box-shadow: 0 6px 20px rgba(90, 124, 122, 0.4);
            transform: scale(1.1);
        }
        .dark-mode-toggle:active { transform: scale(0.95); }
        .dark-mode-toggle svg {
            width: 24px; height: 24px; fill: white; position: absolute; top: 50%; left: 50%; 
            margin-left: -12px; margin-top: -12px; transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .dark-mode-toggle .sun-icon { opacity: 0; transform: rotate(-90deg) scale(0); }
        .dark-mode-toggle .moon-icon { opacity: 1; transform: rotate(0deg) scale(1); }
        body.dark-mode .dark-mode-toggle .sun-icon { opacity: 1; transform: rotate(0deg) scale(1); }
        body.dark-mode .dark-mode-toggle .moon-icon { opacity: 0; transform: rotate(90deg) scale(0); }

        main { padding-top: 80px; }

        /* ================== EVENT SPECIFIC STYLES ================== */
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
            transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .carousel-image {
            flex: 0 0 100%; height: 100%; background-size: cover; background-position: center; position: relative;
            animation: kenBurns 20s ease-in-out infinite alternate;
        }

        @keyframes kenBurns {
            0% { transform: scale(1) translateX(0); }
            100% { transform: scale(1.1) translateX(-20px); }
        }

        .carousel-image::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(26, 31, 30, 0.6));
        }

        .carousel-controls {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 15px; z-index: 10;
        }

        .carousel-dot {
            width: 12px; height: 12px; border-radius: 50%; background: rgba(255, 255, 255, 0.4);
            border: 2px solid rgba(255,255,255,0.8); cursor: pointer; transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: var(--secondary-color); border-color: var(--secondary-color); transform: scale(1.2);
        }

        .carousel-arrow {
            position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); width: 50px; height: 50px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;
            transition: all 0.3s ease; z-index: 10; color: white; font-size: 24px;
        }
        .carousel-arrow:hover {
            background: var(--secondary-color); border-color: var(--secondary-color); transform: translateY(-50%) scale(1.1);
        }
        .carousel-arrow.prev { left: 30px; }
        .carousel-arrow.next { right: 30px; }

        .detail-section { padding: 100px 40px; background: var(--bg-light); position: relative; }
        body.dark-mode .detail-section { background: var(--bg-dark); }
        .detail-container { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr; gap: 60px; width: 100%; }
        .detail-left { display: grid; grid-template-columns: 200px 1fr; gap: 40px; }
        .tenant-logo-wrapper { display: flex; flex-direction: column; gap: 30px; }
        
        .tenant-logo {
            width: 200px; height: 200px; background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
            border-radius: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;
            padding: 30px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08); position: relative;
        }
        body.dark-mode .tenant-logo { background: linear-gradient(135deg, #2a2a2a 0%, #333333 100%); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); }
        .tenant-logo img { width: 100%; height: 100%; object-fit: cover; border-radius: 10px; }

        .tenant-location { background: var(--card-light); border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); }
        body.dark-mode .tenant-location { background: var(--card-dark); box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2); }
        .tenant-location h4 { font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
        body.dark-mode .tenant-location h4 { color: var(--text-light); }
        .location-item { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; font-size: 14px; color: #5a5a5a; }
        body.dark-mode .location-item { color: #b0b0b0; }
        .location-item svg { width: 18px; height: 18px; fill: var(--secondary-color); flex-shrink: 0; }

        .tenant-info { display: flex; flex-direction: column; gap: 30px; }
        .tenant-info h1 {
            font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 500; margin-bottom: 10px;
            background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        body.dark-mode .tenant-info h1 { background: linear-gradient(135deg, #e0e0e0 0%, #a8c5c3 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .tenant-category {
            display: inline-block; background: var(--secondary-color); color: white; padding: 8px 20px;
            border-radius: 20px; font-size: 14px; font-weight: 600; letter-spacing: 1px; margin-bottom: 20px;
        }
        .tenant-description { font-size: 16px; line-height: 1.8; color: #5a5a5a; margin-bottom: 30px; }
        body.dark-mode .tenant-description { color: #b0b0b0; }
        .tenant-details-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; }
        .detail-item { display: flex; flex-direction: column; gap: 8px; }
        .detail-item label { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary-color); }
        .detail-item p { font-size: 15px; color: var(--text-dark); font-weight: 500; }
        body.dark-mode .detail-item p { color: var(--text-light); }
        
        .tenant-actions { display: flex; gap: 15px; margin-top: 30px; }
        .action-btn {
            flex: 1; padding: 15px 30px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;
            text-align: center; transition: all 0.3s ease; cursor: pointer; border: none; display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .action-btn.primary { background: var(--primary-color); color: white; }
        .action-btn.primary:hover { background: #1e4544; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(44, 95, 93, 0.4); }
        .action-btn.secondary { background: transparent; color: var(--text-dark); border: 2px solid var(--text-dark); }
        body.dark-mode .action-btn.secondary { color: var(--text-light); border-color: var(--text-light); }
        .action-btn.secondary:hover { background: var(--text-dark); color: white; transform: translateY(-2px); }
        body.dark-mode .action-btn.secondary:hover { background: var(--text-light); color: var(--bg-dark); }

        .similar-section { display: flex; flex-direction: column; gap: 20px; }
        .similar-header h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 500; color: var(--text-dark); }
        body.dark-mode .similar-header h3 { color: var(--text-light); }
        .similar-tenants { display: flex; flex-direction: column; gap: 20px; }
        .similar-tenant-card {
            position: relative; width: 100%; height: 250px; border-radius: 15px; overflow: hidden; cursor: pointer;
            transition: all 0.4s ease; background-size: cover; background-position: center;
        }
        .similar-tenant-card::before {
            content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8)); transition: background 0.3s ease;
        }
        .similar-tenant-card:hover::before { background: linear-gradient(to bottom, rgba(44, 95, 93, 0.3), rgba(0, 0, 0, 0.9)); }
        .similar-tenant-content {
            position: absolute; bottom: 0; left: 0; right: 0; padding: 25px; transform: translateY(10px); opacity: 0; transition: all 0.3s ease;
        }
        .similar-tenant-card:hover .similar-tenant-content { transform: translateY(0); opacity: 1; }
        .similar-tenant-content h4 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 500; color: white; margin-bottom: 5px; }
        .similar-tenant-date { font-size: 12px; color: var(--accent-color); margin-bottom: 10px; display: block; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
        .similar-tenant-link { display: inline-flex; align-items: center; gap: 8px; color: var(--secondary-color); text-decoration: none; font-size: 14px; font-weight: 600; transition: gap 0.3s ease; }
        body.dark-mode .similar-tenant-link { color: var(--accent-color); }
        .similar-tenant-link:hover { gap: 12px; }

        /* Footer (Matched with Landing) */
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

        /* Responsive Styles (Matches Directory) */
        @media (max-width: 1024px) {
            /* Directory Globals */
            .sidebar { padding: 100px 30px 120px; }
            .sidebar-logo { left: 40px; top: 30px; }
            
            /* Event Specifics */
            .detail-container { grid-template-columns: 1fr; }
            .detail-left { grid-template-columns: 1fr; }
            .tenant-logo-wrapper { flex-direction: row; align-items: flex-start; }
            .tenant-logo { width: 150px; height: 150px; }
            
            /* Prevent Grid Blowout for horizontal scroll */
            .similar-section { min-width: 0; width: 100%; } 
            .similar-tenants { flex-direction: row; overflow-x: auto; max-height: none; padding-bottom: 20px; max-width: 100%; scroll-snap-type: x mandatory; }
            .similar-tenant-card { flex: 0 0 300px; height: 200px; scroll-snap-align: start; margin-right: 20px; }
            
            .footer-content { grid-template-columns: 1fr 1fr; gap: 40px; }
        }

        @media (max-width: 768px) {
            /* Directory Globals - Header & Sidebar Fixes */
            header { padding: 15px 20px; }
            .header-search, .header-left { display: none; }
            .logo { position: static; transform: none; text-align: left; flex: 1; }
            .logo h1 { font-size: 24px; }
            
            .sidebar { width: 100%; padding: 80px 30px 120px; }
            .sidebar-logo { left: 30px; top: 25px; }
            .sidebar-close { right: 25px; top: 25px; }
            
            .footer-content { grid-template-columns: 1fr; gap: 40px; }
            .footer-bottom { flex-direction: column; text-align: center; }
            
            /* Event Specifics */
            .tenant-logo-wrapper { flex-direction: column; align-items: center; text-align: center; }
            .tenant-logo { width: 100%; height: auto; aspect-ratio: 1/1; max-width: 300px; }
            .carousel-section { height: 60vh; min-height: 400px; }
            .detail-section { padding: 60px 20px; overflow: hidden; /* Extra safety */ }
        }
    </style>
</head>

<body>
    <!-- Page Loader (Exact Match) -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image" onerror="this.style.display='none'; this.parentElement.innerHTML += '<h1 style=\'color:#2c5f5d; font-family:Playfair Display\'>MBG</h1>'">
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

    <!-- Header (Exact Match) -->
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;">
            </a>
        </div>

        <div class="logo">
            <h1>mal bali galeria<span>EVENTS</span></h1>
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Sidebar Menu (Exact Match + Events Link Active) -->
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
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/directory') }}">Directory</a></li>
                <li><a href="{{ url('/event') }}" style="color: var(--secondary-color); transform: translateX(10px);">Events</a></li>
                <li><a href="{{ url('/') }}#contact">Contact</a></li>
            </ul>
        </nav>

        <div class="sidebar-search">
            <div class="search-bar" style="position: relative;">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="sidebarSearch">
            </div>
        </div>
    </div>

    <main>
        <!-- Hero Carousel (Custom Event Logic) -->
        <section class="carousel-section">
            <div class="carousel-images" id="carouselImages">
                <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?w=1920&q=80');"></div>
                <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1472851294608-4152ef336f63?w=1920&q=80');"></div>
                <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1511266854972-763aa5394ef3?w=1920&q=80');"></div>
            </div>

            <button class="carousel-arrow prev" id="carouselPrev">‹</button>
            <button class="carousel-arrow next" id="carouselNext">›</button>

            <div class="carousel-controls">
                <div class="carousel-dot active" data-index="0"></div>
                <div class="carousel-dot" data-index="1"></div>
                <div class="carousel-dot" data-index="2"></div>
            </div>
        </section>

        <!-- Details -->
        <section class="detail-section">
            <div class="detail-container">
                <div class="detail-left">
                    <div class="tenant-logo-wrapper">
                        <!-- Square Event Poster/Thumbnail -->
                        <div class="tenant-logo">
                            <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=400&q=80" alt="Event Thumbnail">
                        </div>
                        
                        <div class="tenant-location">
                            <h4>Date & Time</h4>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                <span>14 - 28 Dec 2025</span>
                            </div>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" /></svg>
                                <span>10:00 AM - 10:00 PM</span>
                            </div>
                        </div>
                        
                        <div class="tenant-location">
                            <h4>Location</h4>
                            <div class="location-item">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" /></svg>
                                <span>Main Atrium, Ground Floor</span>
                            </div>
                        </div>
                    </div>

                    <div class="tenant-info">
                        <div>
                            <h1>Grand Year End Sale</h1>
                            <span class="tenant-category">Sales & Promotion</span>
                        </div>

                        <p class="tenant-description">
                            Celebrate the end of the year with our biggest sale event! Enjoy up to 80% OFF on your favorite brands across Fashion, Beauty, Electronics, and Home Living. 
                            <br><br>
                            Don't miss out on our special midnight sale with live DJ performances, lucky draws, and exclusive shopping vouchers. Win a grand prize of a luxury holiday trip to Japan!
                        </p>

                        <div class="tenant-details-grid">
                            <div class="detail-item">
                                <label>Entrance Fee</label>
                                <p>Free Admission</p>
                            </div>
                            <div class="detail-item">
                                <label>Organizer</label>
                                <p>Mal Bali Galeria</p>
                            </div>
                            <div class="detail-item">
                                <label>Target Audience</label>
                                <p>Family & General</p>
                            </div>
                            <div class="detail-item">
                                <label>Highlights</label>
                                <p>Live Music & Midnight Sale</p>
                            </div>
                        </div>

                        <div class="tenant-actions">
                            <a href="#" class="action-btn primary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Add to Calendar
                            </a>
                            <a href="#" class="action-btn secondary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                    <polyline points="16 6 12 2 8 6" />
                                    <line x1="12" y1="2" x2="12" y2="15" />
                                </svg>
                                Share Event
                            </a>
                        </div>
                    </div>
                </div>

                <div class="similar-section">
                    <div class="similar-header">
                        <h3>Upcoming Events</h3>
                    </div>
                    <div class="similar-tenants">
                        <div class="similar-tenant-card" style="background-image: url('https://images.unsplash.com/photo-1543087903-1ac2ec7aa8c5?w=800');">
                            <div class="similar-tenant-content">
                                <span class="similar-tenant-date">01 Jan 2025</span>
                                <h4>New Year Concert</h4>
                                <a href="#" class="similar-tenant-link">View Details<span>→</span></a>
                            </div>
                        </div>

                        <div class="similar-tenant-card" style="background-image: url('https://images.unsplash.com/photo-1513159446162-54eb8bdaa79b?w=800');">
                            <div class="similar-tenant-content">
                                <span class="similar-tenant-date">14 Feb 2025</span>
                                <h4>Valentine's Fair</h4>
                                <a href="#" class="similar-tenant-link">View Details<span>→</span></a>
                            </div>
                        </div>
                        
                        <div class="similar-tenant-card" style="background-image: url('https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=800');">
                            <div class="similar-tenant-content">
                                <span class="similar-tenant-date">Every Weekend</span>
                                <h4>Weekend Food Market</h4>
                                <a href="#" class="similar-tenant-link">View Details<span>→</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer (Matched with Landing) -->
    <footer id="contact">
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
                        <li><a href="{{ url('/') }}#about">About Us</a></li>
                        <li><a href="{{ url('/directory') }}">Store Directory</a></li>
                        <li><a href="{{ url('/') }}#experience">Experiences</a></li>
                        <li><a href="{{ url('/event') }}">Events</a></li>
                        <li><a href="{{ url('/') }}#career">Careers</a></li>
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
        // Page Loader Logic (Matching Directory)
        const pageLoader = document.getElementById('pageLoader');
        let minLoadTime = 2500; 
        let loadStartTime = Date.now();

        window.addEventListener('load', () => {
            let loadTime = Date.now() - loadStartTime;
            let remainingTime = Math.max(0, minLoadTime - loadTime);

            setTimeout(() => {
                pageLoader.classList.add('hidden');
                document.body.classList.add('loaded');
            }, remainingTime);
        });

        // Menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

        if (menuBtn && sidebar && sidebarClose) {
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
        }

        // Dark Mode
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
            });
        }

        // Image Carousel
        const carouselImages = document.getElementById('carouselImages');
        const carouselDots = document.querySelectorAll('.carousel-dot');
        const carouselPrev = document.getElementById('carouselPrev');
        const carouselNext = document.getElementById('carouselNext');
        let currentSlide = 0;
        const totalSlides = 3;

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

        if (carouselNext && carouselPrev) {
            carouselNext.addEventListener('click', nextSlide);
            carouselPrev.addEventListener('click', prevSlide);
        }

        // Auto-play
        let autoplay = setInterval(nextSlide, 5000);
        const carouselSection = document.querySelector('.carousel-section');
        if (carouselSection) {
            carouselSection.addEventListener('mouseenter', () => clearInterval(autoplay));
            carouselSection.addEventListener('mouseleave', () => autoplay = setInterval(nextSlide, 5000));
        }
    </script>
</body>
</html>
