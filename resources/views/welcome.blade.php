<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Bali Galeria - Modern Shopping Experience</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">

    <!-- AOS Animation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2C3E50;
            --secondary: #3498DB;
            --accent: #E74C3C;
            --dark: #1A252F;
            --gray: #7F8C8D;
            --light-gray: #ECF0F1;
            --white: #FFFFFF;
            --gradient: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--white);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1.5rem 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .navbar-brand {
            color: var(--primary);
        }

        .navbar-brand i {
            font-size: 1.8rem;
            color: var(--secondary);
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .nav-link {
            color: var(--dark) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 70%;
        }

        .search-icon {
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px 12px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .navbar.scrolled .search-icon {
            color: var(--dark);
        }

        .search-icon:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar.scrolled .search-icon:hover {
            background-color: var(--light-gray);
        }

        .btn-contact {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-contact:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
        }

        .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(52, 152, 219, 0.6) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            max-width: 700px;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .hero-content p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            font-weight: 300;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.5);
        }

        .hero-btn {
            background: white;
            color: var(--primary);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(255, 255, 255, 0.3);
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(255, 255, 255, 0.4);
            background: var(--secondary);
            color: white;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: white;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            width: 40px;
            border-radius: 6px;
        }

        /* About Section */
        .section {
            padding: 100px 0;
            background: var(--white);
        }

        .section.bg-light {
            background: var(--light-gray);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        .about-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        }

        .about-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .about-icon i {
            font-size: 2rem;
            color: white;
        }

        .about-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .about-card p {
            color: var(--gray);
            line-height: 1.8;
        }

        /* Stats Section */
        .stats-section {
            background: var(--primary);
            color: white;
            padding: 80px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            font-family: 'Playfair Display', serif;
            margin-bottom: 0.5rem;
            color: var(--secondary);
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        /* Services Section */
        .services-section {
            background: var(--light-gray);
        }

        .service-card {
            position: relative;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

        .service-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .service-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(44, 62, 80, 0.95) 0%, rgba(44, 62, 80, 0.4) 60%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 30px;
            transition: all 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-card:hover .service-overlay {
            background: linear-gradient(to top, rgba(52, 152, 219, 0.95) 0%, rgba(52, 152, 219, 0.6) 100%);
        }

        .service-card h3 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .service-card p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
        }

        /* Advantages Section */
        .advantages-section {
            background: white;
        }

        .advantage-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .advantage-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
            border-color: var(--secondary);
        }

        .advantage-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--light-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .advantage-card:hover .advantage-icon {
            background: var(--gradient);
        }

        .advantage-icon i {
            font-size: 2.2rem;
            color: var(--secondary);
            transition: all 0.3s ease;
        }

        .advantage-card:hover .advantage-icon i {
            color: white;
        }

        .advantage-card h4 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .advantage-card p {
            color: var(--gray);
            line-height: 1.7;
        }

        /* Contact Section */
        .contact-section {
            background: var(--light-gray);
        }

        .contact-info {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
        }

        .contact-item {
            display: flex;
            align-items: start;
            margin-bottom: 2rem;
        }

        .contact-item i {
            font-size: 1.5rem;
            color: var(--secondary);
            margin-right: 1.5rem;
            margin-top: 5px;
        }

        .contact-item h5 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-weight: 700;
        }

        .contact-item p {
            color: var(--gray);
            margin: 0;
        }

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
        }

        .contact-form h3 {
            color: var(--primary);
            font-family: 'Playfair Display', serif;
        }

        .form-control {
            border: 2px solid var(--light-gray);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .btn-submit {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            cursor: pointer;
        }

        .btn-submit:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(52, 152, 219, 0.4);
        }

        /* Footer */
        .footer {
            background: var(--primary);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-links a {
            display: inline-flex;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            margin-top: 40px;
            text-align: center;
            opacity: 0.7;
        }

        /* Search Modal */
        .search-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 62, 80, 0.95);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .search-modal-content {
            background: white;
            width: 90%;
            max-width: 600px;
            border-radius: 20px;
            padding: 40px;
            position: relative;
            animation: modalSlideUp 0.4s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-search {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 2rem;
            cursor: pointer;
            color: var(--gray);
            transition: all 0.3s ease;
        }

        .close-search:hover {
            color: var(--accent);
            transform: rotate(90deg);
        }

        .search-modal h4 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--primary);
        }

        .search-modal input {
            width: 100%;
            padding: 18px 20px;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .search-modal input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        }

        .search-modal button {
            width: 100%;
            padding: 15px;
            background: var(--secondary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-modal button:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(52, 152, 219, 0.4);
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .hero-content h1 {
                font-size: 3rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .mobile-menu-btns {
                display: block;
                padding: 1.5rem;
                border-top: 1px solid var(--light-gray);
                margin-top: 1rem;
            }

            .navbar-collapse.show {
                background: white;
                padding: 1.5rem;
                border-radius: 15px;
                margin-top: 10px;
                box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            }

            .navbar.scrolled .nav-link,
            .navbar-collapse.show .nav-link {
                color: var(--dark) !important;
            }

            .d-lg-flex {
                display: none !important;
            }

            .service-card {
                height: 350px;
            }
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .service-card {
                height: 300px;
            }

            .section {
                padding: 60px 0;
            }
        }

        .mobile-menu-btns {
            display: none;
        }

        .mobile-btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .mobile-search-btn {
            background: var(--light-gray);
            color: var(--dark);
            border: 2px solid var(--light-gray);
        }

        .mobile-contact-btn {
            background: var(--secondary);
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-mountain"></i>
                Mal Bali Galeria
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#advantages">Advantages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <div class="d-none d-lg-flex align-items-center">
                    <i class="search-icon fas fa-search me-3" id="searchToggle"></i>
                    <a href="#contact" class="btn-contact">Get In Touch</a>
                </div>

                <div class="mobile-menu-btns">
                    <button class="mobile-btn mobile-search-btn" id="searchToggleMobile">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                    <a href="#contact" class="mobile-btn mobile-contact-btn">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Us</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div class="search-modal" id="searchModal">
        <div class="search-modal-content">
            <span class="close-search" id="closeSearch">&times;</span>
            <h4><i class="fas fa-search me-2"></i>What are you looking for?</h4>
            <input type="text" placeholder="Search stores, restaurants, services..." id="searchInput" />
            <button onclick="performSearch()">
                <i class="fas fa-search me-2"></i>Search Now
            </button>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=1920&q=80');">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up">
                            <h1>Welcome to Mal Bali Galeria</h1>
                            <p>Experience the ultimate shopping destination where luxury meets tradition. Discover
                                world-class retail, dining, and entertainment in the heart of Bali's paradise.</p>
                            <a href="#about" class="hero-btn">Explore More</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1920&q=80');">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up">
                            <h1>Luxury Shopping Experience</h1>
                            <p>From international brands to local artisans, explore our curated selection of premium
                                retail stores offering the finest products and exceptional service.</p>
                            <a href="#services" class="hero-btn">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&q=80');">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up">
                            <h1>Culinary Paradise</h1>
                            <p>Indulge in a world of flavors with our diverse dining options. From authentic Indonesian
                                cuisine to international gourmet experiences.</p>
                            <a href="#services" class="hero-btn">View Restaurants</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1920&q=80');">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up">
                            <h1>Entertainment Hub</h1>
                            <p>Create unforgettable memories with state-of-the-art cinema, family entertainment zones,
                                and exciting events for all ages.</p>
                            <a href="#services" class="hero-btn">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">About Mal Bali Galeria</h2>
                <p class="section-subtitle">Your premier shopping and lifestyle destination in Bali</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Community Focus</h4>
                        <p>More than just a mall - we're a community hub bringing together locals and tourists through
                            culture, shopping, and entertainment experiences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up">
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Retail Stores</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Dining Options</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number">2M+</div>
                        <div class="stat-label">Annual Visitors</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Security & Safety</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section services-section" id="services">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Our Services</h2>
                <p class="section-subtitle">Everything you need under one roof</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80"
                            alt="Shopping">
                        <div class="service-overlay">
                            <h3>Premium Shopping</h3>
                            <p>Discover international and local brands across fashion, electronics, home decor, and
                                more.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80"
                            alt="Dining">
                        <div class="service-overlay">
                            <h3>World-Class Dining</h3>
                            <p>From fine dining to casual eats, enjoy cuisines from around the world prepared by expert
                                chefs.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=800&q=80"
                            alt="Entertainment">
                        <div class="service-overlay">
                            <h3>Entertainment</h3>
                            <p>State-of-the-art cinema, gaming zones, and family entertainment centers for all ages.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80"
                            alt="Events">
                        <div class="service-overlay">
                            <h3>Event Spaces</h3>
                            <p>Host your corporate events, product launches, and special celebrations in our premium
                                venues.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80"
                            alt="Wellness">
                        <div class="service-overlay">
                            <h3>Wellness & Beauty</h3>
                            <p>Pamper yourself at our premium spas, salons, and wellness centers.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1534452203293-494d7ddbf7e0?w=800&q=80"
                            alt="Services">
                        <div class="service-overlay">
                            <h3>Banking & Services</h3>
                            <p>ATMs, currency exchange, and essential services conveniently located throughout the mall.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages Section -->
    <section class="section advantages-section" id="advantages">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Why Choose Us</h2>
                <p class="section-subtitle">Experience the difference at Mal Bali Galeria</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6" data-aos="fade-up">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Safe & Secure</h4>
                        <p>24/7 security surveillance and trained personnel ensuring your safety at all times.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-parking"></i>
                        </div>
                        <h4>Ample Parking</h4>
                        <p>Multi-level parking with over 2,000 spaces, including designated areas for disabled guests.
                        </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h4>Free WiFi</h4>
                        <p>Complimentary high-speed internet access throughout the entire mall premises.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-wheelchair"></i>
                        </div>
                        <h4>Accessible</h4>
                        <p>Wheelchair-friendly facilities with elevators, ramps, and accessible restrooms.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h4>Family Friendly</h4>
                        <p>Nursing rooms, kids play areas, and family-oriented facilities throughout the mall.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-snowflake"></i>
                        </div>
                        <h4>Climate Control</h4>
                        <p>Fully air-conditioned spaces maintaining perfect temperature for comfortable shopping.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <h4>Concierge Service</h4>
                        <p>Professional staff ready to assist with directions, reservations, and special requests.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h4>Easy Payment</h4>
                        <p>Multiple payment options accepted including cash, cards, and digital wallets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-section" id="contact">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-subtitle">We'd love to hear from you</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h5>Visit Us</h5>
                                <p>Jl. Sunset Road No. 99<br>Kuta, Badung, Bali 80361<br>Indonesia</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h5>Call Us</h5>
                                <p>+62 361 123 4567<br>+62 812 3456 7890</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h5>Email Us</h5>
                                <p>info@malbaligaleria.com<br>customer@malbaligaleria.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h5>Opening Hours</h5>
                                <p>Mon - Sun: 10:00 AM - 10:00 PM<br>Public Holidays: 10:00 AM - 11:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-form">
                        <h3 class="mb-4">Send Us a Message</h3>
                        <form id="contactForm">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                            <input type="email" class="form-control" placeholder="Your Email" required>
                            <input type="text" class="form-control" placeholder="Subject" required>
                            <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-mountain me-2"></i>Mal Bali Galeria</h5>
                    <p class="opacity-75 mb-4">Your premier shopping and lifestyle destination in Bali. Experience
                        luxury, culture, and entertainment all in one place.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#advantages">Advantages</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5>Services</h5>
                    <ul class="footer-links">
                        <li><a href="#">Shopping</a></li>
                        <li><a href="#">Dining</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Wellness</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5>Information</h5>
                    <ul class="footer-links">
                        <li><a href="#">Store Directory</a></li>
                        <li><a href="#">Promotions</a></li>
                        <li><a href="#">Events Calendar</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 mb-4">
                    <h5>Legal</h5>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Mal Bali Galeria. All Rights Reserved. Designed with <i class="fas fa-heart"
                        style="color: #3498DB;"></i> in Bali</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Initialize Swiper
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Search Modal
        const searchModal = document.getElementById('searchModal');
        const searchToggle = document.getElementById('searchToggle');
        const searchToggleMobile = document.getElementById('searchToggleMobile');
        const closeSearch = document.getElementById('closeSearch');
        const searchInput = document.getElementById('searchInput');

        function openSearchModal() {
            searchModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            setTimeout(() => searchInput.focus(), 400);
        }

        function closeSearchModal() {
            searchModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function performSearch() {
            const query = searchInput.value.trim();
            if (query) {
                alert(`Searching for: ${query}`);
                closeSearchModal();
                searchInput.value = '';
            }
        }

        searchToggle.addEventListener('click', openSearchModal);
        searchToggleMobile.addEventListener('click', openSearchModal);
        closeSearch.addEventListener('click', closeSearchModal);

        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) closeSearchModal();
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') performSearch();
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });

                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    if (this.classList.contains('nav-link')) {
                        this.classList.add('active');
                    }

                    // Close mobile menu
                    const navbarCollapse = document.getElementById('navbarNav');
                    if (window.innerWidth <= 991.98) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // Active Nav on Scroll
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = document.querySelectorAll('section[id]');

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Form Submission
        document.getElementById('contactForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thank you for your message! We will get back to you soon.');
            e.target.reset();
        });

        // Counter Animation
        const animateCounter = (element, target) => {
            let current = 0;
            const increment = target / 100;
            const hasPlus = element.textContent.includes('+');

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + (hasPlus ? '+' : '');
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + (hasPlus ? '+' : '');
                }
            }, 20);
        };

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    document.querySelectorAll('.stat-number').forEach(stat => {
                        const text = stat.textContent;
                        const number = parseInt(text.replace(/\D/g, ''));
                        animateCounter(stat, number);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    </script>
</body>

</html>
