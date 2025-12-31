// Page Loader Logic
const pageLoader = document.getElementById('pageLoader');
let minLoadTime = 2500;
let loadStartTime = Date.now();

window.addEventListener('load', () => {
    let loadTime = Date.now() - loadStartTime;
    let remainingTime = Math.max(0, minLoadTime - loadTime);

    setTimeout(() => {
        if (pageLoader) {
            pageLoader.classList.add('hidden');
            document.body.classList.add('loaded');
        }
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

// Sidebar Search (Mobile)
const sidebarSearch = document.getElementById('sidebarSearch');
if (sidebarSearch) {
    sidebarSearch.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            // Implement search logic here if needed
            console.log('Searching for:', this.value);
        }
    });
}

/**
 * Custom Carousel Logic (if not using a library)
 * Supports basic dot navigation and auto-play
 */
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelector('.carousel-images');
    const imageCount = document.querySelectorAll('.carousel-image').length;
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.querySelector('.carousel-arrow.prev'); // If added to HTML
    const nextBtn = document.querySelector('.carousel-arrow.next'); // If added to HTML
    
    let currentIndex = 0;
    let interval;

    function showImage(index) {
        if (index >= imageCount) index = 0;
        if (index < 0) index = imageCount - 1;
        
        currentIndex = index;
        
        if (images) {
            images.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        dots.forEach(dot => dot.classList.remove('active'));
        if (dots[currentIndex]) {
            dots[currentIndex].classList.add('active');
        }
    }

    function startAutoSlide() {
        interval = setInterval(() => {
            showImage(currentIndex + 1);
        }, 5000);
    }

    function stopAutoSlide() {
        clearInterval(interval);
    }

    // Dot Click Events
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            stopAutoSlide();
            const index = parseInt(dot.getAttribute('data-index'));
            showImage(index);
            startAutoSlide();
        });
    });

    // Arrow Click Events (if exist)
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            showImage(currentIndex - 1);
            startAutoSlide();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            showImage(currentIndex + 1);
            startAutoSlide();
        });
    }

    // Initialize
    if (imageCount > 0) {
        startAutoSlide();
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
// Trigger once on load
window.addEventListener('load', revealOnScroll);
revealOnScroll();

// Footer Animation (Fade in links)
const footerElements = document.querySelectorAll('footer .footer-links a, footer .footer-social-link');
if (footerElements.length > 0) {
    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                footerElements.forEach((element, index) => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                    element.style.transition = 'all 0.5s ease';
                    element.style.transitionDelay = `${index * 0.05}s`;
                });
            }
        });
    }, { threshold: 0.1 });

    const footer = document.querySelector('footer');
    if (footer) {
        footerObserver.observe(footer);
    }
}

