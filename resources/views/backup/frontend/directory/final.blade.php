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
            font-weight: 400;
            line-height: 1.6;
            background: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
            color: #2c3e50;
        }

        /* Typography enhancements */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
            margin-bottom: 0.5em;
            font-weight: 600;
        }

        h1 {
            font-size: 2.5rem;
            letter-spacing: -0.02em;
        }

        h2 {
            font-size: 2rem;
            letter-spacing: -0.015em;
        }

        h3 {
            font-size: 1.5rem;
        }

        h4 {
            font-size: 1.25rem;
        }

        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4 {
            color: #f0f0f0;
        }

        /* Paragraph and text elements */
        p {
            margin-bottom: 1rem;
        }

        /* Spacing utilities */
        .section {
            padding: 4rem 0;
        }

        .section-title {
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-title h2 {
            position: relative;
            display: inline-block;
            padding-bottom: 1rem;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #5fcfda, #4db8c3);
            border-radius: 2px;
        }

        body.dark-mode {
            background-color: #0d0d0d;
            color: #f0f0f0;
        }

        /* Enhanced dark mode with deeper contrast */
        body.dark-mode .filter-sidebar {
            background: #121212;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .tenant-card {
            background: #1a1a1a;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            border-color: #2a2a2a;
        }

        body.dark-mode .filter-input {
            background: #1e1e1e;
        }

        body.dark-mode .filter-input:focus-within {
            background: #2a2a2a;
            border-color: #5fcfda;
        }

        body.dark-mode .map-container {
            background: #121212;
        }

        body.dark-mode .search-bar {
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid #333;
        }

        body.dark-mode .search-suggestions {
            background: #1a1a1a;
            border: 1px solid #333;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .suggestion-item {
            border-bottom-color: #2a2a2a;
        }

        body.dark-mode .suggestion-item:hover {
            background: #2a2a2a;
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

        /* Search suggestions */
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            z-index: 100;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            margin-top: 5px;
            border: 1px solid #f0f0f0;
        }

        body.dark-mode .search-suggestions {
            background: #2a2a2a;
            border-color: #3a3a3a;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .search-suggestions.show {
            display: block;
        }

        .suggestion-item {
            padding: 12px 20px;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        body.dark-mode .suggestion-item {
            border-bottom-color: #3a3a3a;
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }

        .suggestion-item:hover {
            background: #f8f9fa;
        }

        body.dark-mode .suggestion-item:hover {
            background: #3a3a3a;
        }

        .suggestion-icon {
            width: 24px;
            height: 24px;
            background: #5fcfda;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            flex-shrink: 0;
        }

        .suggestion-text {
            flex: 1;
        }

        .suggestion-category {
            font-size: 11px;
            color: #666;
            font-weight: 500;
        }

        body.dark-mode .suggestion-category {
            color: #b0b0b0;
        }

        .suggestion-floor {
            font-size: 10px;
            background: #5fcfda;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
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

        .sidebar.active nav ul li:nth-child(7) {
            transition-delay: 0.7s;
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
            padding-top: 6rem;
            min-height: 100vh;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 2.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1.5rem;
            }
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 4rem;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        body.dark-mode .page-header h1 {
            color: #f0f0f0;
        }

        .page-header p {
            font-size: 1.25rem;
            color: #666666;
            font-weight: 400;
            line-height: 1.7;
        }

        body.dark-mode .page-header p {
            color: #b0b0b0;
        }

        /* Layout Grid */
        .content-layout {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Filter Section - Sidebar */
        .filter-sidebar {
            position: sticky;
            top: 120px;
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease 0.2s forwards;
            border: 1px solid #f0f0f0;
            overflow: hidden;
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        body.dark-mode .filter-sidebar {
            background: #2a2a2a;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
            border-color: #3a3a3a;
        }

        .filter-header {
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            padding: 25px 30px;
            color: white;
        }

        .filter-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-header h3 svg {
            width: 24px;
            height: 24px;
        }

        .filter-header p {
            font-size: 13px;
            opacity: 0.9;
            margin: 0;
        }

        .filter-body {
            padding: 30px;
        }

        .view-toggle {
            display: flex;
            gap: 8px;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 6px;
            border-radius: 12px;
        }

        body.dark-mode .view-toggle {
            background: #1a1a1a;
        }

        .view-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            color: #666666;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .view-btn svg {
            width: 16px;
            height: 16px;
        }

        .view-btn.active {
            background: white;
            color: #5fcfda;
            box-shadow: 0 2px 8px rgba(95, 207, 218, 0.2);
        }

        body.dark-mode .view-btn.active {
            background: #2a2a2a;
        }

        .view-btn:hover:not(.active) {
            color: #5fcfda;
        }

        .filter-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e8e8e8, transparent);
            margin: 25px 0;
        }

        body.dark-mode .filter-divider {
            background: linear-gradient(90deg, transparent, #3a3a3a, transparent);
        }

        .filter-group {
            margin-bottom: 2rem;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-group label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 0.75rem;
        }

        body.dark-mode .filter-group label {
            color: #e0e0e0;
        }

        .filter-input {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            transition: all 0.3s ease;
            position: relative;
        }

        body.dark-mode .filter-input {
            background: #1a1a1a;
            border-color: transparent;
        }

        .filter-input:focus-within {
            border-color: #5fcfda;
            background: white;
            box-shadow: 0 0 0 3px rgba(95, 207, 218, 0.1);
        }

        body.dark-mode .filter-input:focus-within {
            background: #2a2a2a;
        }

        /* Custom styled dropdowns */
        .styled-select {
            position: relative;
        }

        .styled-select select {
            width: 100%;
            padding: 5px 35px 5px 5px;
            background: transparent;
            border: none;
            outline: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            color: #2c3e50;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.dark-mode .styled-select select {
            color: #e0e0e0;
        }

        .styled-select::after {
            content: "▼";
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #999;
            font-size: 10px;
        }

        body.dark-mode .styled-select::after {
            color: #b0b0b0;
        }

        .filter-input svg {
            width: 18px;
            height: 18px;
            stroke: #999999;
            margin-right: 10px;
            flex-shrink: 0;
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

        body.dark-mode .styled-select::after {
            color: #b0b0b0;
        }

        .filter-input input::placeholder {
            color: #999999;
            font-weight: 400;
        }

        body.dark-mode .filter-input input::placeholder {
            color: #666;
        }

        /* Filter tags */
        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
            min-height: 30px;
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #5fcfda;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .filter-tag .remove-tag {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 0;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s ease;
        }

        .filter-tag .remove-tag:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .multi-select-container {
            position: relative;
        }

        .multi-select-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            z-index: 100;
            max-height: 200px;
            overflow-y: auto;
            margin-top: 0.5rem;
            border: 1px solid #f0f0f0;
            display: none;
            padding: 0.5rem 0;
        }

        body.dark-mode .multi-select-dropdown {
            background: #1a1a1a;
            border-color: #3a3a3a;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .multi-select-dropdown.show {
            display: block;
        }

        .multi-select-option {
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            font-size: 0.9rem;
        }

        .multi-select-option::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: transparent;
            transition: background 0.2s ease;
        }

        .multi-select-option:hover::before {
            background: #5fcfda;
        }

        body.dark-mode .multi-select-option {
            color: #e0e0e0;
        }

        .multi-select-option:hover {
            background: #f8f9fa;
            padding-left: 1.5rem;
        }

        body.dark-mode .multi-select-option:hover {
            background: #2a2a2a;
        }

        .multi-select-option.selected {
            background: #e6f8f9;
            color: #5fcfda;
            font-weight: 500;
        }

        .multi-select-option.selected::before {
            background: #5fcfda;
        }

        body.dark-mode .multi-select-option.selected {
            background: rgba(95, 207, 218, 0.15);
            color: #5fcfda;
        }

        .filter-input select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
            border: none;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            background-color: transparent;
            position: relative;
        }

        .filter-input select:focus {
            outline: none;
        }

        /* Enhanced dropdown container styling */
        .filter-input {
            position: relative;
            overflow: hidden;
        }

        .filter-input::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 30px;
            height: 100%;
            background: linear-gradient(to left, #f8f9fa 0%, transparent 100%);
            pointer-events: none;
            z-index: 1;
        }

        body.dark-mode .filter-input::after {
            background: linear-gradient(to left, #1a1a1a 0%, transparent 100%);
        }

        /* Dropdown container with enhanced styling */
        .enhanced-dropdown-container {
            position: relative;
            width: 100%;
        }

        .enhanced-dropdown {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid transparent;
            border-radius: 12px;
            background: #f8f9fa;
            color: #2c3e50;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            appearance: none;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .enhanced-dropdown:hover {
            background: white;
        }

        .enhanced-dropdown:focus {
            border-color: #5fcfda;
            background: white;
            box-shadow: 0 0 0 3px rgba(95, 207, 218, 0.1);
            outline: none;
        }

        body.dark-mode .enhanced-dropdown {
            background: #1a1a1a;
            color: #e0e0e0;
            border-color: transparent;
        }

        body.dark-mode .enhanced-dropdown:hover {
            background: #2a2a2a;
        }

        body.dark-mode .enhanced-dropdown:focus {
            border-color: #5fcfda;
            background: #2a2a2a;
        }

        /* Dropdown arrow styling */
        .enhanced-dropdown-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .enhanced-dropdown-wrapper::after {
            content: "▼";
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 8px;
            color: #999;
            z-index: 3;
        }

        body.dark-mode .enhanced-dropdown-wrapper::after {
            color: #b0b0b0;
        }

        .filter-stats {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 20px;
            border-radius: 12px;
            margin-top: 25px;
            text-align: center;
        }

        body.dark-mode .filter-stats {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        }

        .filter-stats-number {
            font-size: 32px;
            font-weight: 700;
            color: #5fcfda;
            font-family: 'Playfair Display', serif;
        }

        .filter-stats-label {
            font-size: 12px;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        body.dark-mode .filter-stats-label {
            color: #b0b0b0;
        }

        /* Tenant List in Map View */
        #mapTenantList label {
            color: #2c3e50;
        }

        body.dark-mode #mapTenantList label {
            color: #e0e0e0;
        }

        #tenantListItems {
            scrollbar-width: thin;
            scrollbar-color: #5fcfda #f0f0f0;
        }

        body.dark-mode #tenantListItems {
            scrollbar-color: #5fcfda #2a2a2a;
        }

        #tenantListItems::-webkit-scrollbar {
            width: 6px;
            display: block;
        }

        #tenantListItems::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 3px;
        }

        body.dark-mode #tenantListItems::-webkit-scrollbar-track {
            background: #2a2a2a;
        }

        #tenantListItems::-webkit-scrollbar-thumb {
            background: #5fcfda;
            border-radius: 3px;
        }

        #tenantListItems::-webkit-scrollbar-thumb:hover {
            background: #4db8c3;
        }

        .tenant-list-item {
            padding: 12px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        body.dark-mode .tenant-list-item {
            background: #1a1a1a;
        }

        .tenant-list-item:hover {
            background: white;
            border-color: #5fcfda;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(95, 207, 218, 0.2);
        }

        body.dark-mode .tenant-list-item:hover {
            background: #2a2a2a;
        }

        .tenant-list-item-name {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        body.dark-mode .tenant-list-item-name {
            color: #e0e0e0;
        }

        .tenant-list-item-details {
            font-size: 11px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        body.dark-mode .tenant-list-item-details {
            color: #b0b0b0;
        }

        .tenant-list-item-unit {
            background: #5fcfda;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
        }

        /* Tenant Grid */
        .tenant-content {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.4s forwards;
        }

        .tenant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .tenant-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                        box-shadow 0.3s ease,
                        filter 0.3s ease;
        }

        body.dark-mode .tenant-card {
            background: rgba(42, 42, 42, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tenant-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #5fcfda, #4db8c3);
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
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 20px 40px rgba(95, 207, 218, 0.3);
            filter: brightness(1.05);
        }

        .tenant-card.tilted {
            transform: translateY(-12px) scale(1.03) rotateX(5deg) rotateY(5deg);
        }

        body.dark-mode .tenant-card:hover {
            box-shadow: 0 25px 50px rgba(95, 207, 218, 0.4);
        }

        /* Shimmer loading effect */
        .shimmer {
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer-highlight 1.5s infinite;
        }

        /* Global loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        body.dark-mode .loading-overlay {
            background: rgba(26, 26, 26, 0.9);
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(95, 207, 218, 0.3);
            border-top: 5px solid #5fcfda;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Pull to refresh styles */
        .pull-to-refresh {
            position: relative;
            overflow: hidden;
        }

        .pull-down-indicator {
            position: absolute;
            top: -40px;
            left: 0;
            right: 0;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5fcfda;
            transition: all 0.3s ease;
        }

        .pull-down-indicator.refreshing {
            transform: rotate(180deg);
        }

        /* Swipe indicators */
        .swipe-hint {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: none; /* Only show on mobile */
            background: rgba(95, 207, 218, 0.2);
            color: #5fcfda;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            backdrop-filter: blur(5px);
        }

        @media (max-width: 768px) {
            .swipe-hint {
                display: block;
            }
        }

        .loading-text {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        body.dark-mode .loading-text {
            color: #e0e0e0;
        }

        /* Staggered card loading animation */
        .stagger-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stagger-card:nth-child(1) { animation-delay: 0.1s; }
        .stagger-card:nth-child(2) { animation-delay: 0.2s; }
        .stagger-card:nth-child(3) { animation-delay: 0.3s; }
        .stagger-card:nth-child(4) { animation-delay: 0.4s; }
        .stagger-card:nth-child(5) { animation-delay: 0.5s; }
        .stagger-card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        @keyframes shimmer-highlight {
            0% { left: -100%; }
            20% { left: -50%; }
            100% { left: 100%; }
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
            background: linear-gradient(90deg, transparent, rgba(95, 207, 218, 0.1), transparent);
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
            padding: 25px;
            position: relative;
        }

        .tenant-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 25px;
            right: 25px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e8e8e8, transparent);
        }

        .floor-badge {
            position: absolute;
            top: -12px;
            right: 25px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(95, 207, 218, 0.3);
        }

        .tenant-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        body.dark-mode .tenant-info h3 {
            color: #e0e0e0;
        }

        .tenant-card:hover .tenant-info h3 {
            color: #5fcfda;
        }

        .tenant-category {
            font-size: 12px;
            color: #666666;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        body.dark-mode .tenant-category {
            color: #b0b0b0;
        }

        .tenant-category svg {
            width: 14px;
            height: 14px;
            fill: #5fcfda;
        }

        .tenant-meta {
            display: flex;
            gap: 14px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #666666;
            font-weight: 500;
        }

        body.dark-mode .meta-item {
            color: #b0b0b0;
        }

        .meta-item svg {
            width: 13px;
            height: 13px;
            fill: #5fcfda;
        }

        .see-details-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
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
            transform: translateX(4px);
        }

        /* Map View Styles */
        #mapView {
            display: none;
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
            overflow: hidden;
        }

        body.dark-mode #mapView {
            background: #2a2a2a;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
            border-color: #3a3a3a;
        }

        .map-header {
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            padding: 25px 30px;
            color: white;
        }

        .map-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .map-header h3 svg {
            width: 24px;
            height: 24px;
        }

        .map-header p {
            font-size: 13px;
            opacity: 0.9;
            margin: 0;
        }

        .map-body {
            padding: 30px;
        }

        .floor-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .floor-btn {
            flex: 1;
            min-width: 150px;
            padding: 15px 20px;
            border: 2px solid #e8e8e8;
            background: white;
            color: #666;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }

        body.dark-mode .floor-btn {
            background: #1a1a1a;
            border-color: #3a3a3a;
            color: #b0b0b0;
        }

        .floor-btn.active {
            border-color: #5fcfda;
            background: #5fcfda;
            color: white;
            box-shadow: 0 4px 12px rgba(95, 207, 218, 0.3);
        }

        .floor-btn:hover:not(.active) {
            border-color: #5fcfda;
            color: #5fcfda;
        }

        .map-container {
            position: relative;
            background: #f8f9fa;
            border-radius: 16px;
            overflow: visible;
            min-height: 600px;
        }

        body.dark-mode .map-container {
            background: #1a1a1a;
        }

        .map-wrapper {
            position: relative !important;
            width: 100%;
            display: inline-block;
        }

        .map-container img {
            width: 100%;
            height: auto;
            display: block;
            position: relative;
        }

        /* Map Pin Styles - UPDATED FOR SMALLER SIZE */
        .map-pin {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #5fcfda;
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(95, 207, 218, 0.5);
            z-index: 10;
            animation: pulse 2s infinite;
        }

        .map-pin.cluster {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
            color: white;
            background: linear-gradient(135deg, #5fcfda, #4db8c3);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 2px 8px rgba(95, 207, 218, 0.5), 0 0 0 0 rgba(95, 207, 218, 0.7);
            }

            50% {
                box-shadow: 0 2px 8px rgba(95, 207, 218, 0.5), 0 0 0 8px rgba(95, 207, 218, 0);
            }
        }

        .map-pin:hover {
            transform: translate(-50%, -50%) scale(1.5);
            background: #4db8c3;
            box-shadow: 0 4px 15px rgba(95, 207, 218, 0.7);
            z-index: 20;
            animation: none;
        }

        /* Enhanced map tooltip */
        .map-tooltip-enhanced {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            pointer-events: auto;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            min-width: 280px;
            max-width: 320px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        body.dark-mode .map-tooltip-enhanced {
            background: rgba(42, 42, 42, 0.95);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .map-tooltip-enhanced.show {
            opacity: 1;
        }

        .map-tooltip-enhanced-header {
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            padding: 15px 20px;
            color: white;
        }

        .map-tooltip-enhanced-header h4 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }

        .map-tooltip-enhanced-body {
            padding: 20px;
        }

        .map-tooltip-enhanced-category {
            font-size: 14px;
            color: #666;
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        body.dark-mode .map-tooltip-enhanced-category {
            color: #b0b0b0;
        }

        .map-tooltip-enhanced-category svg {
            width: 14px;
            height: 14px;
            fill: #5fcfda;
        }

        .map-tooltip-enhanced .unit-badge {
            display: inline-block;
            background: linear-gradient(135deg, #5fcfda, #4db8c3);
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 12px;
            letter-spacing: 0.5px;
        }

        .map-tooltip-enhanced .tooltip-see-details {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            letter-spacing: 0.5px;
        }

        .map-tooltip-enhanced .tooltip-see-details:hover {
            background: linear-gradient(135deg, #4db8c3 0%, #3da3ad 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(95, 207, 218, 0.4);
        }

        .map-tooltip-enhanced .tooltip-see-details svg {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .map-tooltip-enhanced .tooltip-see-details:hover svg {
            transform: translateX(4px);
        }


        @media (max-width: 768px) {
            .map-pin {
                width: 8px;
                height: 8px;
                border-width: 2px;
            }
        }

        @media (max-width: 480px) {
            .map-pin {
                width: 7px;
                height: 7px;
            }
        }

        .map-pin-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(44, 62, 80, 0.9);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
            margin-top: 5px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        body.dark-mode .map-pin-label {
            background: rgba(255, 255, 255, 0.9);
            color: #2c3e50;
        }

        .map-pin:hover .map-pin-label {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .map-pin-label {
                display: none;
            }
        }

        /* Map Tooltip - UPDATED WITH IMAGE */
        .map-tooltip {
            position: fixed;
            background: white;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            pointer-events: auto;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1000;
            min-width: 280px;
            max-width: 320px;
            overflow: hidden;
        }

        body.dark-mode .map-tooltip {
            background: #2a2a2a;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .map-tooltip.show {
            opacity: 1;
            transform: translateY(0);
        }

        .map-tooltip-image {
            width: 100%;
            height: 140px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        body.dark-mode .map-tooltip-image {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border-bottom-color: #3a3a3a;
        }

        .map-tooltip-image img {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
        }

        .map-tooltip-content {
            padding: 20px;
        }

        .map-tooltip h4 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
            font-family: 'Playfair Display', serif;
        }

        body.dark-mode .map-tooltip h4 {
            color: #e0e0e0;
        }

        .map-tooltip p {
            font-size: 13px;
            color: #666;
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        body.dark-mode .map-tooltip p {
            color: #b0b0b0;
        }

        .map-tooltip .unit-badge {
            display: inline-block;
            background: linear-gradient(135deg, #5fcfda, #4db8c3);
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 12px;
            letter-spacing: 0.5px;
        }

        .map-tooltip .tooltip-see-details {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #5fcfda 0%, #4db8c3 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            letter-spacing: 0.5px;
        }

        .map-tooltip .tooltip-see-details:hover {
            background: linear-gradient(135deg, #4db8c3 0%, #3da3ad 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(95, 207, 218, 0.4);
        }

        .map-tooltip .tooltip-see-details svg {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .map-tooltip .tooltip-see-details:hover svg {
            transform: translateX(4px);
        }

        .map-tooltip .tooltip-arrow {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 16px;
            height: 16px;
            background: white;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .map-tooltip .tooltip-arrow {
            background: #2a2a2a;
        }

        @media (max-width: 768px) {
            .map-tooltip {
                min-width: 260px;
                max-width: 300px;
            }

            .map-tooltip-image {
                height: 120px;
                padding: 15px;
            }

            .map-tooltip-image img {
                max-height: 90px;
            }

            .map-tooltip-content {
                padding: 16px;
            }

            .map-tooltip h4 {
                font-size: 16px;
            }

            .map-tooltip p {
                font-size: 12px;
            }
        }

        .map-stats {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        body.dark-mode .map-stats {
            background: rgba(26, 26, 26, 0.95);
        }

        .map-stats-number {
            font-size: 24px;
            font-weight: 700;
            color: #5fcfda;
            font-family: 'Playfair Display', serif;
        }

        .map-stats-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        body.dark-mode .map-stats-label {
            color: #b0b0b0;
        }

        .map-stats span {
            color: #666;
        }

        body.dark-mode .map-stats span {
            color: #b0b0b0;
        }

        .map-legend {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        body.dark-mode .map-legend {
            background: #1a1a1a;
        }

        .map-legend h4 {
            font-size: 14px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        body.dark-mode .map-legend h4 {
            color: #e0e0e0;
        }

        .legend-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .legend-text {
            font-size: 13px;
            color: #666;
        }

        body.dark-mode .legend-text {
            color: #b0b0b0;
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

        /* Responsive */
        @media (max-width: 1400px) {
            .content-layout {
                grid-template-columns: 350px 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 1024px) {
            .content-layout {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .filter-sidebar {
                position: relative;
                top: 0;
            }

            .tenant-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
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

            .filter-header {
                padding: 20px;
            }

            .filter-body {
                padding: 20px;
            }

            .view-toggle {
                flex-direction: row;
            }

            .view-btn {
                font-size: 11px;
                padding: 10px 12px;
            }

            .toastr {
                right: 20px;
                left: 20px;
                top: 80px;
                min-width: auto;
            }

            .floor-selector {
                flex-direction: column;
            }

            .floor-btn {
                min-width: 100%;
            }

            .map-body {
                padding: 20px;
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
            <div class="search-bar" style="position: relative;">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="headerSearch">
                <div class="search-suggestions" id="headerSearchSuggestions"></div>
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
        <div class="toastr-icon">✓</div>
        <div class="toastr-content">
            <h4>Success</h4>
            <p>Action completed successfully</p>
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
                <li><a href="#" onclick="event.preventDefault(); enableCoordinatePicker();">📍 Get
                        Coordinates</a></li>
            </ul>
        </nav>

        <!-- Search in Sidebar for Mobile -->
        <div class="sidebar-search">
            <div class="search-bar" style="position: relative;">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="sidebarSearch">
                <div class="search-suggestions" id="sidebarSearchSuggestions"></div>
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

            <!-- Content Layout -->
            <div class="content-layout">
                <!-- Filter Sidebar -->
                <aside class="filter-sidebar">
                    <div class="filter-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            Filter & Search
                        </h3>
                        <p>Find your perfect store</p>
                    </div>

                    <div class="filter-body">
                        <!-- View Toggle -->
                        <div class="view-toggle">
                            <button class="view-btn" id="mapViewBtn">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z" />
                                </svg>
                                Map
                            </button>
                            <button class="view-btn active" id="listViewBtn">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="3" y="4" width="18" height="4" rx="1" />
                                    <rect x="3" y="10" width="18" height="4" rx="1" />
                                    <rect x="3" y="16" width="18" height="4" rx="1" />
                                </svg>
                                List
                            </button>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Search Filter -->
                        <div class="filter-group">
                            <label>Search Tenant</label>
                            <div class="filter-input" style="position: relative;">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                <input type="text" placeholder="Type to search..." id="searchInput">
                                <div class="search-suggestions" id="searchInputSuggestions"></div>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Floor Filter -->
                        <div class="filter-group">
                            <label>Floor Level</label>
                            <div class="filter-input styled-select">
                                <select id="floorFilter">
                                    <option value="1st Floor">1st Floor</option>
                                    <option value="2nd Floor">2nd Floor</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Category Filter -->
                        <div class="filter-group">
                            <label>Categories</label>
                            <div class="filter-input multi-select-container">
                                <div class="multi-select-header" id="multiSelectHeader" style="display: flex; align-items: center; gap: 5px; flex-wrap: wrap; min-height: 24px;">
                                    <span style="color: #999; font-size: 14px;" id="multiSelectPlaceholder">Select categories...</span>
                                    <div class="filter-tags" id="selectedCategoriesContainer"></div>
                                </div>
                                <input type="hidden" id="categoryFilter" value="">
                                <div class="multi-select-dropdown" id="multiSelectDropdown">
                                    <div class="multi-select-option" data-value="Fashion & Apparel">Fashion & Apparel</div>
                                    <div class="multi-select-option" data-value="Fashion & Accessories">Fashion & Accessories</div>
                                    <div class="multi-select-option" data-value="Beauty & Health">Beauty & Health</div>
                                    <div class="multi-select-option" data-value="Jewelry & Watches">Jewelry & Watches</div>
                                    <div class="multi-select-option" data-value="Food & Beverage">Food & Beverage</div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="filter-stats">
                            <div class="filter-stats-number" id="tenantCount">17</div>
                            <div class="filter-stats-label">Tenants Found</div>
                        </div>

                        <!-- Tenant List in Map View -->
                        <div id="mapTenantList" style="display: none; margin-top: 25px;">
                            <div class="filter-divider"></div>
                            <label
                                style="font-size: 11px; font-weight: 700; color: #2c3e50; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 15px;">Stores
                                on Map</label>
                            <div id="tenantListItems" style="max-height: 400px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </aside>

                <!-- Tenant Content -->
                <div class="tenant-content">
                    <!-- Tenant Grid -->
                    <div class="tenant-grid" id="tenantGrid">
                        <!-- Tenants will be dynamically inserted here -->
                    </div>

                    <!-- Map View -->
                    <div id="mapView">
                        <div class="map-header">
                            <h3>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z" />
                                </svg>
                                Interactive Mall Map
                            </h3>
                            <p>Select a floor to view store locations</p>
                        </div>

                        <div class="map-body">
                            <div class="floor-selector">
                                <button class="floor-btn active" data-floor="floor1">1st Floor</button>
                                <button class="floor-btn" data-floor="floor2">2nd Floor</button>
                            </div>

                            <div class="map-container" id="mapContainer">
                                <div style="text-align: center; padding: 40px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#5fcfda" stroke-width="2"
                                        style="width: 60px; height: 60px; margin: 0 auto 20px;">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <p style="color: #666; font-size: 16px; margin: 0;">Loading mall map...</p>
                                </div>
                            </div>

                            <div class="map-legend">
                                <h4>Map Legend</h4>
                                <div class="legend-grid">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #ff6b9d;"></div>
                                        <span class="legend-text">Fashion & Apparel</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #c8a2c8;"></div>
                                        <span class="legend-text">Fashion & Accessories</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #4a90e2;"></div>
                                        <span class="legend-text">Department Store</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #f4d03f;"></div>
                                        <span class="legend-text">Supermarket</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #7cb342;"></div>
                                        <span class="legend-text">Food & Beverage</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div class="empty-state" id="emptyState">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" />
                        </svg>
                        <h3>No tenants found</h3>
                        <p>Try adjusting your search or filter criteria</p>
                    </div>
                </div>
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
        // Add loading overlay to the body
        document.addEventListener('DOMContentLoaded', () => {
            const loadingOverlay = document.createElement('div');
            loadingOverlay.className = 'loading-overlay';
            loadingOverlay.innerHTML = `
                <div class="loading-spinner"></div>
                <div class="loading-text">Loading Mall Directory...</div>
            `;
            document.body.appendChild(loadingOverlay);
        });

        // Function to show/hide loading overlay
        function showLoading() {
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) {
                overlay.classList.add('show');
            }
        }

        function hideLoading() {
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) {
                overlay.classList.remove('show');
            }
        }

        // ===== TENANT DATA DENGAN KOORDINAT PIXEL =====
        const tenants = [{
                name: 'Uniqlo',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-89',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/9/92/UNIQLO_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Japanese casual wear designer, manufacturer and retailer',
                mapCoords: {
                    x: 350,
                    y: 280
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Zara',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-73',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Zara_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer',
                mapCoords: {
                    x: 630,
                    y: 320
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'TUMI',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1C-76',
                logo: 'https://logos-world.net/wp-content/uploads/2022/04/Tumi-Logo.png',
                hours: '10:00 AM - 10:00 PM',
                description: 'Premium travel and lifestyle brand',
                mapCoords: {
                    x: 840,
                    y: 240
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Pandora',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1C-79',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/8/83/Pandora_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Danish jewelry manufacturer',
                mapCoords: {
                    x: 1050,
                    y: 360
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Sephora',
                category: 'Beauty & Health',
                floor: '1st Floor',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/000000/ffffff?text=SEPHORA',
                hours: '10:00 AM - 10:00 PM',
                description: 'French multinational chain of personal care and beauty stores',
                mapCoords: {
                    x: 1120,
                    y: 480
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Victoria\'s Secret',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1A-38',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/29/Victoria%27s_Secret_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American lingerie, clothing, and beauty retailer',
                mapCoords: {
                    x: 490,
                    y: 520
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Mango',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-78',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/23/Mango_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish clothing design and manufacturing company',
                mapCoords: {
                    x: 700,
                    y: 560
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'La Senza',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1A-26',
                logo: 'https://via.placeholder.com/150x80/e91e63/ffffff?text=LA+SENZA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Canadian fashion retailer specializing in lingerie',
                mapCoords: {
                    x: 280,
                    y: 440
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Matahari',
                category: 'Department Store',
                floor: '2nd Floor',
                unit: '2A-01',
                logo: 'https://via.placeholder.com/150x80/1e3a8a/ffffff?text=MATAHARI',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian department store chain',
                mapCoords: {
                    x: 1105,
                    y: 465
                },
                mapOriginalSize: {
                    width: 1184,
                    height: 864
                }
            },
            {
                name: 'Casio G-Shock',
                category: 'Jewelry & Watches',
                floor: '2nd Floor',
                unit: '1A-17',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Casio_G-Shock_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Line of watches manufactured by Casio',
                mapCoords: {
                    x: 420,
                    y: 320
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Oysho',
                category: 'Fashion & Accessories',
                floor: '2nd Floor',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/333333/ffffff?text=OYSHO',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer',
                mapCoords: {
                    x: 770,
                    y: 280
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Chatime',
                category: 'Food & Beverage',
                floor: '2nd Floor',
                unit: '2C-T',
                logo: 'https://via.placeholder.com/150x80/ff6b6b/ffffff?text=Chatime',
                hours: '10:00 AM - 10:00 PM',
                description: 'Taiwanese global franchise teahouse chain',
                mapCoords: {
                    x: 980,
                    y: 400
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Dairy Queen',
                category: 'Food & Beverage',
                floor: '2nd Floor',
                unit: 'D1',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/a/ae/Dairy_Queen_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American chain of soft serve ice cream',
                mapCoords: {
                    x: 910,
                    y: 520
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'ACE Hardware',
                category: 'Home & Lifestyle',
                floor: '1st Floor',
                unit: 'A1',
                logo: 'https://via.placeholder.com/150x80/8b0000/ffffff?text=ACE',
                hours: '9:00 AM - 10:00 PM',
                description: 'Hardware and home improvement retail store',
                mapCoords: {
                    x: 210,
                    y: 200
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Matahari Department',
                category: 'Department Store',
                floor: '1st Floor',
                unit: 'B1',
                logo: 'https://via.placeholder.com/150x80/1e3a8a/ffffff?text=MATAHARI',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian department store chain',
                mapCoords: {
                    x: 1190,
                    y: 240
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Hypermart',
                category: 'Supermarket',
                floor: '2nd Floor',
                unit: 'C1',
                logo: 'https://via.placeholder.com/150x80/ffd700/333333?text=HYPERMART',
                hours: '8:00 AM - 11:00 PM',
                description: 'Hypermarket offering groceries and household items',
                mapCoords: {
                    x: 560,
                    y: 480
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Gramedia',
                category: 'Books & Stationery',
                floor: '2nd Floor',
                unit: 'C2',
                logo: 'https://via.placeholder.com/150x80/ff9800/ffffff?text=GRAMEDIA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian bookstore chain',
                mapCoords: {
                    x: 350,
                    y: 560
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            }
        ];

        // Floor Map Images - GANTI DENGAN PATH GAMBAR ANDA
        const floorMaps = {
            'floor1': '{{ asset('assets/images/floors/1st.png') }}',
            'floor2': '{{ asset('assets/images/floors/2nd.png') }}'
        };

        // Map View State
        let currentView = 'list';
        let currentFloorMap = 'floor1';

        // ===== HELPER FUNCTION =====
        function calculateResponsivePosition(mapCoords, originalSize, currentWidth, currentHeight) {
            const scaleX = currentWidth / originalSize.width;
            const scaleY = currentHeight / originalSize.height;
            return {
                x: mapCoords.x * scaleX,
                y: mapCoords.y * scaleY
            };
        }

        // ===== TOASTR NOTIFICATION =====
        const toastr = document.getElementById('toastr');
        const toastrClose = document.getElementById('toastrClose');

        function showToastr(title, message, duration = 3000) {
            toastr.querySelector('.toastr-content h4').textContent = title;
            toastr.querySelector('.toastr-content p').textContent = message;
            toastr.classList.add('show');
            setTimeout(() => hideToastr(), duration);
        }

        function hideToastr() {
            toastr.classList.remove('show');
        }

        toastrClose.addEventListener('click', hideToastr);

        // ===== MENU TOGGLE =====
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

        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (!link.getAttribute('onclick')) {
                    menuBtn.classList.remove('active');
                    sidebar.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            });
        });

        // ===== DARK MODE =====
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'enabled' :
                'disabled');
        });

        // ===== RENDER TENANTS =====
        const tenantGrid = document.getElementById('tenantGrid');
        const emptyState = document.getElementById('emptyState');
        const mapView = document.getElementById('mapView');

        function renderTenants(tenantsToRender) {
            tenantGrid.innerHTML = '';
            if (tenantsToRender.length === 0) {
                emptyState.classList.add('show');
                return;
            }
            emptyState.classList.remove('show');

            tenantsToRender.forEach((tenant, index) => {
                const card = document.createElement('div');
                card.className = 'tenant-card stagger-card';
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
                setTimeout(() => card.classList.add('show'), 50);
            });
        }

        // ===== FILTER FUNCTION =====
        function filterTenants() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const headerSearchTerm = document.getElementById('headerSearch').value.toLowerCase();
            const sidebarSearchTerm = document.getElementById('sidebarSearch').value.toLowerCase();
            const selectedFloor = document.getElementById('floorFilter').value;
            const selectedCategoriesStr = document.getElementById('categoryFilter').value;
            const selectedCategories = selectedCategoriesStr ? selectedCategoriesStr.split(',') : [];

            const combinedSearch = searchTerm || headerSearchTerm || sidebarSearchTerm;

            const filtered = tenants.filter(tenant => {
                const matchesSearch = !combinedSearch ||
                    tenant.name.toLowerCase().includes(combinedSearch) ||
                    tenant.category.toLowerCase().includes(combinedSearch);
                const matchesFloor = !selectedFloor || tenant.floor === selectedFloor;

                // Check if any selected category matches (or if no categories selected)
                let matchesCategory = selectedCategories.length === 0;
                if (selectedCategories.length > 0) {
                    matchesCategory = selectedCategories.some(cat => cat === tenant.category);
                }

                return matchesSearch && matchesFloor && matchesCategory;
            });

            document.getElementById('tenantCount').textContent = filtered.length;
            renderTenants(filtered);

            // Update tenant count per floor
            updateFloorCounts();
        }

        // Update floor counts for map view
        function updateFloorCounts() {
            const floorCounts = {};
            tenants.forEach(tenant => {
                if (floorCounts[tenant.floor]) {
                    floorCounts[tenant.floor]++;
                } else {
                    floorCounts[tenant.floor] = 1;
                }
            });

            // Update the floor buttons with counts
            document.querySelectorAll('.floor-btn').forEach(btn => {
                const floorValue = btn.dataset.floor === 'floor1' ? '1st Floor' : '2nd Floor';
                const count = floorCounts[floorValue] || 0;
                const originalText = floorValue;
                // Check if there's already a count in parentheses and update it rather than adding again
                const existingCountMatch = btn.innerHTML.match(/\((\d+)\)/);
                if (existingCountMatch) {
                    btn.innerHTML = btn.innerHTML.replace(/\(\d+\)/, `(${count})`);
                } else {
                    btn.innerHTML = `${originalText} <span style="margin-left: 5px; font-size: 12px;">(${count})</span>`;
                }
            });
        }

        // ===== SEARCH SUGGESTIONS =====
        function createSearchSuggestions(searchTerm, containerId) {
            const suggestionsContainer = document.getElementById(containerId);
            if (!searchTerm) {
                suggestionsContainer.classList.remove('show');
                return;
            }

            const filteredTenants = tenants.filter(tenant =>
                tenant.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                tenant.category.toLowerCase().includes(searchTerm.toLowerCase())
            ).slice(0, 8); // Limit to 8 suggestions

            if (filteredTenants.length === 0) {
                suggestionsContainer.classList.remove('show');
                return;
            }

            suggestionsContainer.innerHTML = '';
            filteredTenants.forEach(tenant => {
                const suggestionItem = document.createElement('div');
                suggestionItem.className = 'suggestion-item';
                suggestionItem.innerHTML = `
                    <div class="suggestion-icon">${tenant.name.charAt(0)}</div>
                    <div class="suggestion-text">
                        <div>${tenant.name}</div>
                        <div class="suggestion-category">${tenant.category}</div>
                    </div>
                    <div class="suggestion-floor">${tenant.floor}</div>
                `;

                suggestionItem.addEventListener('click', () => {
                    document.getElementById(containerId.replace('Suggestions', '')).value = tenant.name;
                    suggestionsContainer.classList.remove('show');
                    // Apply the search
                    filterTenants();
                });

                suggestionsContainer.appendChild(suggestionItem);
            });

            suggestionsContainer.classList.add('show');
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-bar')) {
                document.querySelectorAll('.search-suggestions').forEach(container => {
                    container.classList.remove('show');
                });
            }
        });

        // ===== MULTI-SELECT FUNCTIONALITY =====
        const selectedCategories = new Set();
        const multiSelectHeader = document.getElementById('multiSelectHeader');
        const multiSelectDropdown = document.getElementById('multiSelectDropdown');
        const multiSelectPlaceholder = document.getElementById('multiSelectPlaceholder');
        const selectedCategoriesContainer = document.getElementById('selectedCategoriesContainer');
        const hiddenCategoryFilter = document.getElementById('categoryFilter');

        // Toggle dropdown
        multiSelectHeader.addEventListener('click', (e) => {
            if (!e.target.closest('.filter-tag')) { // Don't toggle if clicking on a tag
                multiSelectDropdown.classList.toggle('show');
            }
        });

        // Click on options
        const options = document.querySelectorAll('.multi-select-option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const value = option.dataset.value;

                if (selectedCategories.has(value)) {
                    selectedCategories.delete(value);
                    option.classList.remove('selected');
                } else {
                    selectedCategories.add(value);
                    option.classList.add('selected');
                }

                updateSelectedCategories();
                filterTenants(); // Apply filter immediately
            });
        });

        // Update the display of selected categories
        function updateSelectedCategories() {
            // Clear container
            selectedCategoriesContainer.innerHTML = '';

            // Add tags for each selected category
            selectedCategories.forEach(category => {
                const tag = document.createElement('span');
                tag.className = 'filter-tag';
                tag.innerHTML = `
                    ${category}
                    <button class="remove-tag" data-value="${category}">×</button>
                `;
                selectedCategoriesContainer.appendChild(tag);
            });

            // Update hidden input value
            hiddenCategoryFilter.value = Array.from(selectedCategories).join(',');

            // Update placeholder text
            if (selectedCategories.size > 0) {
                multiSelectPlaceholder.textContent = '';
                multiSelectPlaceholder.style.display = 'none';
            } else {
                multiSelectPlaceholder.style.display = 'inline';
                multiSelectPlaceholder.textContent = 'Select categories...';
            }

            // Add event listeners to remove buttons
            document.querySelectorAll('.remove-tag').forEach(removeBtn => {
                removeBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const value = removeBtn.dataset.value;
                    selectedCategories.delete(value);

                    // Remove selected class from option
                    options.forEach(option => {
                        if (option.dataset.value === value) {
                            option.classList.remove('selected');
                        }
                    });

                    updateSelectedCategories();
                    filterTenants(); // Apply filter immediately
                });
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.multi-select-container')) {
                multiSelectDropdown.classList.remove('show');
            }
        });

        // Prevent dropdown from closing when clicking inside it
        multiSelectDropdown.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Event Listeners
        const searchInput = document.getElementById('searchInput');
        const headerSearch = document.getElementById('headerSearch');
        const sidebarSearch = document.getElementById('sidebarSearch');

        searchInput.addEventListener('input', () => {
            createSearchSuggestions(searchInput.value, 'searchInputSuggestions');
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when searching in map view
            } else {
                filterTenants();
            }
        });

        headerSearch.addEventListener('input', () => {
            createSearchSuggestions(headerSearch.value, 'headerSearchSuggestions');
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when searching in map view
            } else {
                filterTenants();
            }
        });

        sidebarSearch.addEventListener('input', () => {
            createSearchSuggestions(sidebarSearch.value, 'sidebarSearchSuggestions');
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when searching in map view
            } else {
                filterTenants();
            }
        });

        // Also add focus event to show suggestions if there's text
        searchInput.addEventListener('focus', () => {
            if (searchInput.value) {
                createSearchSuggestions(searchInput.value, 'searchInputSuggestions');
            }
        });

        headerSearch.addEventListener('focus', () => {
            if (headerSearch.value) {
                createSearchSuggestions(headerSearch.value, 'headerSearchSuggestions');
            }
        });

        sidebarSearch.addEventListener('focus', () => {
            if (sidebarSearch.value) {
                createSearchSuggestions(sidebarSearch.value, 'sidebarSearchSuggestions');
            }
        });
        document.getElementById('floorFilter').addEventListener('change', () => {
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when filtering by floor
            } else {
                filterTenants();
            }
        });
        document.getElementById('categoryFilter').addEventListener('change', () => {
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when filtering by category
            } else {
                filterTenants();
            }
        });

        // ===== MAP VIEW =====
        function updateMapView() {
            const mapContainer = document.getElementById('mapContainer');
            const selectedFloor = document.getElementById('floorFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('categoryFilter').value;

            // Calculate tenant counts per floor
            const floorCounts = {};
            tenants.forEach(t => {
                if (floorCounts[t.floor]) {
                    floorCounts[t.floor]++;
                } else {
                    floorCounts[t.floor] = 1;
                }
            });

            // Filter tenants based on search, floor, and category
            let floorTenants = tenants.filter(t => {
                const matchesFloor = !selectedFloor || t.floor === selectedFloor;
                const matchesSearch = !searchTerm || t.name.toLowerCase().includes(searchTerm) || t.category
                    .toLowerCase().includes(searchTerm);
                const matchesCategory = !selectedCategory || t.category === selectedCategory;
                return matchesFloor && matchesSearch && matchesCategory;
            });

            // Filter tenants for the current floor only
            let currentFloorTenants = floorTenants.filter(t => {
                const matchesFloor = !selectedFloor || t.floor === selectedFloor;
                return matchesFloor;
            });

            const floorKey = selectedFloor === '1st Floor' ? 'floor1' : selectedFloor === '2nd Floor' ? 'floor2' :
                currentFloorMap;

            // Format tenant counts per floor for display
            const total1stFloor = floorCounts['1st Floor'] || 0;
            const total2ndFloor = floorCounts['2nd Floor'] || 0;

            mapContainer.innerHTML = `
                <div class="map-wrapper" id="mapWrapper" style="position: relative;">
                    <img src="${floorMaps[floorKey]}" alt="Mall Floor Plan" id="floorMapImage" style="width: 100%; height: auto; display: block;">
                </div>
                <div class="map-stats">
                    <div class="map-stats-number">${currentFloorTenants.length}</div>
                    <div class="map-stats-label">Stores on this floor</div>
                    <div style="margin-top: 10px; font-size: 12px; color: #666; display: flex; justify-content: space-between;">
                        <span>1st Floor: <strong>${total1stFloor}</strong></span>
                        <span>2nd Floor: <strong>${total2ndFloor}</strong></span>
                    </div>
                </div>
            `;

            // Update tenant list in sidebar
            updateTenantList(currentFloorTenants);

            const mapImage = document.getElementById('floorMapImage');
            const mapWrapper = document.getElementById('mapWrapper');

            const addPins = () => {
                mapContainer.querySelectorAll('.map-pin').forEach(pin => pin.remove());
                if (!mapImage.width || !mapImage.height) {
                    setTimeout(addPins, 100);
                    return;
                }

                const currentWidth = mapImage.width;
                const currentHeight = mapImage.height;

                // Process tenants for potential clustering
                const allPositions = currentFloorTenants.map(tenant => {
                    if (tenant.mapCoords && tenant.mapOriginalSize) {
                        const position = calculateResponsivePosition(tenant.mapCoords, tenant.mapOriginalSize,
                            currentWidth, currentHeight);
                        return { tenant, position, x: position.x, y: position.y };
                    }
                    return null;
                }).filter(Boolean);

                // Group by position for clustering (markers that are close together)
                const positionGroups = {};
                const clusteringDistance = 20; // pixels threshold for clustering

                allPositions.forEach(pos => {
                    let foundGroup = false;
                    for (const key in positionGroups) {
                        const [groupX, groupY] = key.split(',').map(Number);
                        const distance = Math.sqrt(Math.pow(pos.x - groupX, 2) + Math.pow(pos.y - groupY, 2));
                        if (distance < clusteringDistance) {
                            positionGroups[key].push(pos);
                            foundGroup = true;
                            break;
                        }
                    }
                    if (!foundGroup) {
                        const key = `${pos.x},${pos.y}`;
                        positionGroups[key] = [pos];
                    }
                });

                // Create markers for each group
                for (const key in positionGroups) {
                    const group = positionGroups[key];
                    const [groupX, groupY] = key.split(',').map(Number);

                    let pin;
                    if (group.length > 1) {
                        // Create cluster marker
                        pin = document.createElement('div');
                        pin.className = 'map-pin cluster';
                        pin.style.position = 'absolute';
                        pin.style.left = groupX + 'px';
                        pin.style.top = groupY + 'px';
                        pin.textContent = group.length;

                        // Store all tenants in this cluster
                        pin.dataset.tenants = JSON.stringify(group.map(item => item.tenant));

                        pin.addEventListener('mouseenter', function() {
                            // Show tooltip with all tenants in cluster
                            const tenantList = JSON.parse(this.dataset.tenants);
                            showClusterTooltip(tenantList, this, groupX, groupY);
                        });
                    } else {
                        // Create single marker
                        const tenant = group[0].tenant;
                        pin = document.createElement('div');
                        pin.className = 'map-pin';
                        pin.style.position = 'absolute';
                        pin.style.left = groupX + 'px';
                        pin.style.top = groupY + 'px';
                        pin.dataset.tenant = JSON.stringify(tenant);

                        const label = document.createElement('div');
                        label.className = 'map-pin-label';
                        label.textContent = tenant.name;
                        pin.appendChild(label);

                        pin.addEventListener('mouseenter', function() {
                            const tenantData = JSON.parse(this.dataset.tenant);
                            showMapTooltip(tenantData, this);
                        });
                    }

                    pin.addEventListener('mouseleave', hideMapTooltip);

                    pin.addEventListener('click', function(e) {
                        e.stopPropagation();
                        if (window.innerWidth <= 768) {
                            if (this.classList.contains('cluster')) {
                                const tenantList = JSON.parse(this.dataset.tenants);
                                showClusterTooltip(tenantList, this, groupX, groupY);
                            } else {
                                const tenantData = JSON.parse(this.dataset.tenant);
                                showMapTooltip(tenantData, this);
                            }
                        } else {
                            if (this.classList.contains('cluster')) {
                                const tenantList = JSON.parse(this.dataset.tenants);
                                showClusterTooltip(tenantList, this, groupX, groupY);
                            } else {
                                const tenantData = JSON.parse(this.dataset.tenant);
                                showMapTooltip(tenantData, this);
                            }
                        }
                    });

                    mapWrapper.appendChild(pin);
                }

                if (!document.getElementById('mapTooltip')) {
                    const tooltip = document.createElement('div');
                    tooltip.id = 'mapTooltip';
                    tooltip.className = 'map-tooltip-enhanced';
                    document.body.appendChild(tooltip);
                }
            };

            if (mapImage.complete && mapImage.naturalWidth !== 0) {
                addPins();
            } else {
                mapImage.addEventListener('load', addPins);
                setTimeout(addPins, 500);
            }

            let resizeTimeout;
            const resizeHandler = function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(addPins, 150);
            };

            window.removeEventListener('resize', window._mapResizeHandler);
            window._mapResizeHandler = resizeHandler;
            window.addEventListener('resize', resizeHandler);
        }

        // ===== UPDATE TENANT LIST IN SIDEBAR =====
        function updateTenantList(tenantsToShow) {
            const tenantListItems = document.getElementById('tenantListItems');
            tenantListItems.innerHTML = '';

            if (tenantsToShow.length === 0) {
                tenantListItems.innerHTML =
                    '<p style="text-align: center; color: #666; font-size: 12px; padding: 20px;">No stores found</p>';
                return;
            }

            tenantsToShow.forEach(tenant => {
                const item = document.createElement('div');
                item.className = 'tenant-list-item';
                item.innerHTML = `
                    <div class="tenant-list-item-name">${tenant.name}</div>
                    <div class="tenant-list-item-details">
                        <span class="tenant-list-item-unit">${tenant.unit}</span>
                        <span>${tenant.category}</span>
                    </div>
                `;

                item.addEventListener('click', () => {
                    // Find the pin on map and trigger tooltip
                    const pins = document.querySelectorAll('.map-pin');
                    pins.forEach(pin => {
                        const pinData = JSON.parse(pin.dataset.tenant);
                        if (pinData.unit === tenant.unit) {
                            // Scroll map into view
                            pin.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });

                            // Show tooltip after a short delay
                            setTimeout(() => {
                                showMapTooltip(tenant, pin);

                                // Add highlight animation
                                pin.style.animation = 'none';
                                setTimeout(() => {
                                    pin.style.animation =
                                        'pulse 0.5s ease-in-out 3';
                                }, 10);
                            }, 500);
                        }
                    });
                });

                tenantListItems.appendChild(item);
            });
        }

        // ===== MAP TOOLTIP =====
        function showMapTooltip(tenant, pinElement) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            tooltip.className = 'map-tooltip-enhanced';
            tooltip.innerHTML = `
                <div class="map-tooltip-enhanced-header">
                    <h4>${tenant.name}</h4>
                </div>
                <div class="map-tooltip-enhanced-body">
                    <div style="text-align: center; margin-bottom: 12px;">
                        <img src="${tenant.logo}" alt="${tenant.name}" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                        </svg>
                        ${tenant.category}
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        ${tenant.hours}
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Unit ${tenant.unit} - ${tenant.floor}
                    </div>
                    <span class="unit-badge">${tenant.floor}</span>
                    <a href="#tenant-${tenant.unit.replace(/[^a-zA-Z0-9]/g, '')}" class="tooltip-see-details">
                        See Details
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            `;

            const pinRect = pinElement.getBoundingClientRect();
            const tooltipWidth = 280;
            let left = pinRect.left + (pinRect.width / 2) - (tooltipWidth / 2);
            let top = pinRect.top - 10;

            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }

            // Convert viewport coordinates to document coordinates for proper positioning
            tooltip.style.left = (left + window.scrollX) + 'px';
            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.transform = 'translateY(-100%)';

            setTimeout(() => tooltip.classList.add('show'), 50);
        }

        // ===== CLUSTER TOOLTIP =====
        function showClusterTooltip(tenantList, pinElement, x, y) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            tooltip.className = 'map-tooltip-enhanced';
            tooltip.innerHTML = `
                <div class="map-tooltip-enhanced-header">
                    <h4>${tenantList.length} Stores Found</h4>
                </div>
                <div class="map-tooltip-enhanced-body">
                    <div style="max-height: 200px; overflow-y: auto;">
                        ${tenantList.map(tenant => `
                            <div class="suggestion-item" style="padding: 8px 12px; margin-bottom: 8px; border-radius: 8px; cursor: pointer;">
                                <div class="suggestion-icon" style="width: 20px; height: 20px; font-size: 10px;">${tenant.name.charAt(0)}</div>
                                <div class="suggestion-text" style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 600;">${tenant.name}</div>
                                    <div class="suggestion-category" style="font-size: 10px;">${tenant.category}</div>
                                </div>
                                <div class="suggestion-floor" style="font-size: 9px;">${tenant.floor}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;

            const pinRect = pinElement.getBoundingClientRect();
            const tooltipWidth = 280;
            let left = pinRect.left + (pinRect.width / 2) - (tooltipWidth / 2);
            let top = pinRect.top - 10;

            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }

            // Convert viewport coordinates to document coordinates for proper positioning
            tooltip.style.left = (left + window.scrollX) + 'px';
            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.transform = 'translateY(-100%)';

            setTimeout(() => tooltip.classList.add('show'), 50);

            // Add click events to each tenant in the cluster
            const suggestionItems = tooltip.querySelectorAll('.suggestion-item');
            suggestionItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    const selectedTenant = tenantList[index];
                    showMapTooltip(selectedTenant, pinElement);
                });
            });
        }

        function hideMapTooltip() {
            const tooltip = document.getElementById('mapTooltip');
            if (tooltip) {
                // Delay hiding to allow clicking on links inside tooltip
                setTimeout(() => {
                    if (!tooltip.matches(':hover')) {
                        tooltip.classList.remove('show');
                    }
                }, 100);
            }
        }

        // Keep tooltip visible when hovering over it
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('mouseover', (e) => {
                const tooltip = document.getElementById('mapTooltip');
                if (tooltip && e.target.closest('#mapTooltip')) {
                    tooltip.classList.add('show');
                }
            });

            document.addEventListener('mouseout', (e) => {
                const tooltip = document.getElementById('mapTooltip');
                if (tooltip && e.target.closest('#mapTooltip') && !e.relatedTarget?.closest(
                        '#mapTooltip') && !e.relatedTarget?.closest('.map-pin')) {
                    tooltip.classList.remove('show');
                }
            });
        });

        let currentMobileTooltip = null;

        function toggleMobileTooltip(tenant, pinElement) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            if (currentMobileTooltip === pinElement) {
                hideMapTooltip();
                currentMobileTooltip = null;
                return;
            }

            currentMobileTooltip = pinElement;
            showMapTooltip(tenant, pinElement);

            setTimeout(() => {
                if (currentMobileTooltip === pinElement) {
                    hideMapTooltip();
                    currentMobileTooltip = null;
                }
            }, 5000);
        }

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && !e.target.closest('.map-pin')) {
                hideMapTooltip();
                currentMobileTooltip = null;
            }
        });

        function showTenantDetails(tenant) {
            showToastr(tenant.name, `Unit ${tenant.unit} - ${tenant.floor}`, 3000);
        }

        // ===== COORDINATE PICKER =====
        function enableCoordinatePicker() {
            const mapImage = document.getElementById('floorMapImage');
            if (!mapImage) {
                alert('Please switch to Map View first!');
                return;
            }

            console.clear();
            console.log('%c📍 COORDINATE PICKER ENABLED',
                'background: #5fcfda; color: white; font-size: 16px; padding: 10px; font-weight: bold;');
            console.log('%cClick anywhere on the map to get coordinates', 'font-size: 14px; color: #666;');
            console.log('Image Natural Size:', mapImage.naturalWidth, 'x', mapImage.naturalHeight);
            console.log('Image Display Size:', mapImage.width, 'x', mapImage.height);

            mapImage.style.cursor = 'crosshair';

            if (mapImage._coordinateListener) {
                mapImage.removeEventListener('click', mapImage._coordinateListener);
            }

            const clickHandler = function(e) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;
                const scaleX = this.naturalWidth / this.width;
                const scaleY = this.naturalHeight / this.height;
                const originalX = Math.round(clickX * scaleX);
                const originalY = Math.round(clickY * scaleY);

                console.log('%c✓ COORDINATES', 'background: #2ecc71; color: white; padding: 8px; font-weight: bold;');
                console.log(`mapCoords: { x: ${originalX}, y: ${originalY} },`);
                console.log(`mapOriginalSize: { width: ${this.naturalWidth}, height: ${this.naturalHeight} }`);

                const marker = document.createElement('div');
                marker.style.cssText = `
                    position: absolute; left: ${clickX}px; top: ${clickY}px; width: 12px; height: 12px;
                    background: #ff4757; border: 3px solid white; border-radius: 50%;
                    transform: translate(-50%, -50%); pointer-events: none; z-index: 9999;
                    box-shadow: 0 0 0 0 rgba(255, 71, 87, 1); animation: pulse 1.5s infinite;
                `;

                const wrapper = this.parentElement;
                wrapper.style.position = 'relative';
                wrapper.appendChild(marker);
                setTimeout(() => marker.remove(), 3000);
            };

            mapImage._coordinateListener = clickHandler;
            mapImage.addEventListener('click', clickHandler);

            if (!document.getElementById('pulseAnimation')) {
                const style = document.createElement('style');
                style.id = 'pulseAnimation';
                style.textContent = `
                    @keyframes pulse {
                        0% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7); }
                        70% { box-shadow: 0 0 0 20px rgba(255, 71, 87, 0); }
                        100% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0); }
                    }
                `;
                document.head.appendChild(style);
            }

            showToastr('Coordinate Picker', 'Click on map to get coordinates. Check console!', 4000);
        }

        // ===== VIEW TOGGLE =====
        const mapViewBtn = document.getElementById('mapViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');

        function switchToMapView() {
            currentView = 'map';
            mapViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            tenantGrid.style.display = 'none';
            emptyState.style.display = 'none';
            mapView.style.display = 'block';

            // Show tenant list in sidebar
            document.getElementById('mapTenantList').style.display = 'block';

            updateMapView();
        }

        function switchToListView() {
            currentView = 'list';
            listViewBtn.classList.add('active');
            mapViewBtn.classList.remove('active');
            mapView.style.display = 'none';
            tenantGrid.style.display = 'grid';

            // Hide tenant list in sidebar
            document.getElementById('mapTenantList').style.display = 'none';

            filterTenants();
        }

        mapViewBtn.addEventListener('click', switchToMapView);
        listViewBtn.addEventListener('click', switchToListView);

        // ===== FLOOR BUTTONS =====
        document.querySelectorAll('.floor-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.floor-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFloorMap = this.dataset.floor;
                const floorValue = currentFloorMap === 'floor1' ? '1st Floor' : '2nd Floor';
                document.getElementById('floorFilter').value = floorValue;
                updateMapView();
                filterTenants();
            });
        });

        // ===== 3D TILT EFFECT FOR CARDS =====
        function applyTiltEffect() {
            const cards = document.querySelectorAll('.tenant-card');

            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const cardRect = card.getBoundingClientRect();
                    const x = e.clientX - cardRect.left;
                    const y = e.clientY - cardRect.top;

                    const centerX = cardRect.width / 2;
                    const centerY = cardRect.height / 2;

                    const rotateY = (x - centerX) / 25; // Reduced sensitivity
                    const rotateX = (centerY - y) / 25; // Reduced sensitivity

                    card.style.transform = `translateY(-12px) scale(1.03) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    card.style.transition = 'transform 0.1s ease';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(-8px) scale(1.02)';
                    card.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });
        }

        // ===== SHIMMER LOADING =====
        function showShimmerCards() {
            const tenantGrid = document.getElementById('tenantGrid');
            tenantGrid.innerHTML = '';

            // Create shimmer cards
            for (let i = 0; i < 6; i++) {
                const shimmerCard = document.createElement('div');
                shimmerCard.className = 'tenant-card shimmer';
                shimmerCard.innerHTML = `
                    <div class="tenant-logo shimmer" style="height: 200px;"></div>
                    <div class="tenant-info" style="padding: 25px;">
                        <div class="floor-badge shimmer" style="width: 80px; height: 20px; border-radius: 10px; margin-bottom: 15px;"></div>
                        <div class="shimmer" style="height: 24px; width: 70%; border-radius: 4px; margin-bottom: 10px;"></div>
                        <div class="shimmer" style="height: 16px; width: 100%; border-radius: 4px; margin-bottom: 14px;"></div>
                        <div class="tenant-meta" style="display: flex; gap: 14px; margin-bottom: 18px;">
                            <div class="meta-item shimmer" style="height: 16px; width: 60px; border-radius: 4px;"></div>
                            <div class="meta-item shimmer" style="height: 16px; width: 60px; border-radius: 4px;"></div>
                        </div>
                        <div class="see-details-btn shimmer" style="height: 40px; border-radius: 10px;"></div>
                    </div>
                `;
                tenantGrid.appendChild(shimmerCard);
            }
        }

        // ===== MOBILE SWIPE AND PULL TO REFRESH =====
        let startY = 0;
        let currentY = 0;
        let isPulling = false;

        // Pull to refresh functionality
        function initPullToRefresh() {
            const mainContent = document.querySelector('.main-content');
            if (!mainContent) return;

            // Add pull down indicator
            const pullIndicator = document.createElement('div');
            pullIndicator.className = 'pull-down-indicator';
            pullIndicator.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                </svg>
                <span style="margin-left: 8px;">Pull to refresh</span>
            `;
            mainContent.insertBefore(pullIndicator, mainContent.firstChild);

            // Touch events for pull to refresh
            mainContent.addEventListener('touchstart', (e) => {
                startY = e.touches[0].pageY;
                isPulling = true;
            }, { passive: true });

            mainContent.addEventListener('touchmove', (e) => {
                if (!isPulling) return;

                currentY = e.touches[0].pageY;
                const diffY = currentY - startY;

                // Only allow pull down if at the top of the page
                if (window.scrollY === 0 && diffY > 0) {
                    e.preventDefault();
                    pullIndicator.style.top = `${Math.min(diffY / 2, 40) - 40}px`;

                    if (diffY > 80) {
                        pullIndicator.querySelector('svg').style.transform = 'rotate(180deg)';
                        pullIndicator.innerHTML = `
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform: rotate(180deg);">
                                <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                            </svg>
                            <span style="margin-left: 8px;">Release to refresh</span>
                        `;
                    } else {
                        pullIndicator.querySelector('svg').style.transform = 'rotate(0deg)';
                        pullIndicator.innerHTML = `
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                            </svg>
                            <span style="margin-left: 8px;">Pull to refresh</span>
                        `;
                    }
                }
            }, { passive: false });

            mainContent.addEventListener('touchend', () => {
                if (!isPulling) return;

                const diffY = currentY - startY;

                if (diffY > 80) {
                    // Trigger refresh
                    pullIndicator.querySelector('span').textContent = 'Refreshing...';
                    pullIndicator.querySelector('svg').style.transform = 'rotate(180deg)';
                    pullIndicator.classList.add('refreshing');

                    // Hide indicator and refresh data
                    setTimeout(() => {
                        pullIndicator.style.top = '-40px';
                        pullIndicator.classList.remove('refreshing');

                        // Re-render the page
                        showLoading();
                        showShimmerCards();
                        setTimeout(() => {
                            renderTenants(tenants);
                            setTimeout(() => {
                                applyTiltEffect();
                                hideLoading();
                            }, 100);
                        }, 800);
                    }, 1000);
                } else {
                    // Reset indicator position
                    pullIndicator.style.top = '-40px';
                }

                isPulling = false;
            }, { passive: true });
        }

        // Swipe gesture functionality for mobile
        function initSwipeGestures() {
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            document.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipeGesture();
            }, { passive: true });

            function handleSwipeGesture() {
                const minSwipeDistance = 50;
                const swipeDistance = touchStartX - touchEndX;

                if (Math.abs(swipeDistance) > minSwipeDistance) {
                    if (swipeDistance > 0) {
                        // Swipe left - could implement navigation to next page
                        console.log('Swiped left');
                    } else {
                        // Swipe right - could implement navigation to previous page
                        console.log('Swiped right');
                    }
                }
            }
        }

        // ===== INITIAL RENDER =====
        document.addEventListener('DOMContentLoaded', () => {
            // Set default floor to 1st Floor
            document.getElementById('floorFilter').value = '1st Floor';

            showLoading(); // Show loading overlay initially
            showShimmerCards(); // Show shimmer cards first
            setTimeout(() => {
                renderTenants(tenants); // Then render actual tenants
                setTimeout(() => {
                    applyTiltEffect(); // Apply tilt effect after cards are rendered
                    hideLoading(); // Hide loading overlay after everything is ready
                    initPullToRefresh(); // Initialize pull to refresh
                    initSwipeGestures(); // Initialize swipe gestures
                    // Switch to map view by default and show 1st floor
                    switchToMapView();
                }, 100);
            }, 800); // Small delay to show shimmer effect
        });

        // ===== RIPPLE EFFECT =====
        const buttons = document.querySelectorAll('button:not(#darkModeToggle)');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute; width: ${size}px; height: ${size}px; border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5); left: ${x}px; top: ${y}px;
                    pointer-events: none; animation: ripple 0.6s ease-out;
                `;

                const currentPosition = window.getComputedStyle(this).position;
                if (currentPosition === 'static') this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                from { transform: scale(0); opacity: 1; }
                to { transform: scale(2); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        console.log('%c🏬 Welcome to Mal Bali Galeria Tenant Directory! ',
            'background: #5fcfda; color: white; font-size: 16px; padding: 10px;');
        console.log('%c✓ Responsive Map Pin System Loaded!', 'background: #2ecc71; color: white; padding: 8px;');
    </script>
</body>

</html>
