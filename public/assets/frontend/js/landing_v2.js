
(function() {
    const pageLoader = document.getElementById("pageLoader");
    if (!pageLoader) return;

// Initialize Lenis Smooth Scroll
window.lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    autoRaf: true
});


let minLoadTime = 3500;
let loadStartTime = Date.now();

window.addEventListener("load", () => {
    let loadTime = Date.now() - loadStartTime;
    let remainingTime = Math.max(0, minLoadTime - loadTime);


    setTimeout(() => {
        pageLoader.classList.add("hidden");
        document.body.classList.add("loaded");


        setTimeout(() => {
            pageLoader.style.display = "none";
        }, 500);
    }, remainingTime);
});


setTimeout(() => {
    if (!document.body.classList.contains("loaded")) {
        pageLoader.classList.add("hidden");
        document.body.classList.add("loaded");
        setTimeout(() => {
            pageLoader.style.display = "none";
        }, 500);
    }
}, 5000);


const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const sidebarClose = document.getElementById("sidebarClose");
const header = document.querySelector("header");

menuBtn.addEventListener("click", () => {
    menuBtn.classList.toggle("active");
    sidebar.classList.toggle("active");

    document.body.classList.toggle("menu-open");
});


sidebarClose.addEventListener("click", () => {
    menuBtn.classList.remove("active");
    sidebar.classList.remove("active");
    document.body.classList.remove("menu-open");
});


const sidebarLinks = sidebar.querySelectorAll("a");
sidebarLinks.forEach((link) => {
    link.addEventListener("click", () => {
        menuBtn.classList.remove("active");
        sidebar.classList.remove("active");
        document.body.classList.remove("menu-open");
    });
});


let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    const headerLogo = document.getElementById("headerLogo");


    if (currentScroll > 100) {
        header.classList.add("scrolled");
        if (headerLogo) {
             headerLogo.src = headerLogo.src.replace("logo.png", "logo.png");
        }
    } else {
        header.classList.remove("scrolled");
        if (headerLogo) {
             headerLogo.src = headerLogo.src.replace("logo.png", "logo.png");
        }
    }

    lastScroll = currentScroll;
});


const darkModeToggle = document.getElementById("darkModeToggle");


if (localStorage.getItem("darkMode") === "enabled") {
    document.body.classList.add("dark-mode");
}

darkModeToggle.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    document.body.classList.toggle("dark-mode");


    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("darkMode", "enabled");
    } else {
        localStorage.setItem("darkMode", "disabled");
    }
});


const hero = document.querySelector(".hero");

// ========================================
// #1 HERO IMAGE SLIDER
// ========================================
(function initHeroSlider() {
    const slides = document.querySelectorAll(".hero-slide");
    const dots = document.querySelectorAll(".hero-dot");
    if (!slides.length) return;

    let current = 0;
    let sliderTimer;

    function goToSlide(index) {
        slides[current].classList.remove("active");
        dots[current].classList.remove("active");
        current = (index + slides.length) % slides.length;
        slides[current].classList.add("active");
        dots[current].classList.add("active");
    }

    function startSlider() {
        sliderTimer = setInterval(() => goToSlide(current + 1), 5000);
    }

    dots.forEach((dot) => {
        dot.addEventListener("click", () => {
            clearInterval(sliderTimer);
            goToSlide(parseInt(dot.dataset.index));
            startSlider();
        });
    });

    // Parallax on scroll for hero content only
    window.addEventListener("scroll", () => {
        const scrolled = window.pageYOffset;
        if (hero && scrolled < hero.offsetHeight) {
            const heroContent = document.querySelector(".hero-content");
            const opacity = 1 - scrolled / (hero.offsetHeight * 0.7);
            const translateY = scrolled * 0.3;
            if (heroContent) {
                heroContent.style.opacity = Math.max(0, opacity);
                heroContent.style.transform = `translateY(${translateY}px)`;
            }
        }
    });

    startSlider();
})();

// ========================================
// #2 SIDEBAR SEARCH — FUNGSIONAL
// ========================================
(function initSidebarSearch() {
    const sidebarSearchInput = document.getElementById("sidebarSearchInput");
    const sidebarSearchForm = document.getElementById("sidebarSearchForm");
    if (!sidebarSearchInput || !sidebarSearchForm) return;

    sidebarSearchInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            sidebarSearchForm.submit();
        }
    });
})();


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
revealOnScroll();
    const carouselContainer = document.getElementById("carouselContainer");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (carouselContainer && prevBtn && nextBtn) {
        let cards = [];
        cards = carouselContainer.querySelectorAll(".tenant-card");

        if (cards.length === 0) {
            cards = document.querySelectorAll(".tenant-card");
        }

        const originalCardsCount = cards.length;
        let currentIndex = 0;
        let cardsPerView = 4;
        let isTransitioning = false;

        if (originalCardsCount > 0) {
            const clonesNeeded = 4;
            for (let i = 0; i < clonesNeeded; i++) {
                const cardToClone = cards[i % originalCardsCount];
                if (cardToClone) {
                    const clone = cardToClone.cloneNode(true);
                    clone.classList.add("clone");
                    carouselContainer.appendChild(clone);
                }
            }
            cards = carouselContainer.querySelectorAll(".tenant-card");
        }

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
            updateCarousel(true);
        };

        const updateCarousel = (instant = false) => {
            if (cards.length === 0) return;
            const cardWidth = cards[0].offsetWidth;
            const gap = 30;
            const offset = -(currentIndex * (cardWidth + gap));

            if (instant) {
                carouselContainer.style.transition = "none";
            } else {
                carouselContainer.style.transition = "transform 0.5s ease-in-out";
            }

            carouselContainer.style.transform = `translateX(${offset}px)`;

            if (originalCardsCount > 0) {
                prevBtn.disabled = false;
                nextBtn.disabled = false;
            } else {
                prevBtn.disabled = true;
                nextBtn.disabled = true;
            }
        };

        carouselContainer.addEventListener("transitionend", () => {
            if (currentIndex >= originalCardsCount) {
                currentIndex = currentIndex % originalCardsCount;
                updateCarousel(true);
            }
            isTransitioning = false;
        });

        prevBtn.addEventListener("click", () => {
            if (isTransitioning) return;
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            } else {
                currentIndex = originalCardsCount - 1;
                updateCarousel(true);
            }
        });

        nextBtn.addEventListener("click", () => {
            if (isTransitioning) return;
            currentIndex++;
            updateCarousel();
        });

        let autoplayInterval;
        const startAutoplay = () => {
            if (autoplayInterval) clearInterval(autoplayInterval);
            if (originalCardsCount > 0) {
                autoplayInterval = setInterval(() => {
                    currentIndex++;
                    updateCarousel();
                }, 4000);
            }
        };

        carouselContainer.addEventListener("mouseenter", () => {
            if (autoplayInterval) clearInterval(autoplayInterval);
        });

        carouselContainer.addEventListener("mouseleave", () => {
            startAutoplay();
        });

        startAutoplay();

        window.addEventListener("resize", () => {
            updateCardsPerView();
        });

        updateCardsPerView();
    }

    // ========================================
    // UPCOMING EVENTS SLIDER
    // ========================================
    (function initUpcomingEventsSlider() {
        const eventGrid = document.getElementById("eventGrid");
        const eventPrevBtn = document.getElementById("eventPrevBtn");
        const eventNextBtn = document.getElementById("eventNextBtn");
        const eventControls = document.getElementById("eventControls");
        if (!eventGrid || !eventPrevBtn || !eventNextBtn) return;

        // Clean up any existing clones from previous version
        const existingClones = eventGrid.querySelectorAll(".clone");
        existingClones.forEach(c => c.remove());

        let isTransitioning = false;
        const getGap = () => window.innerWidth <= 768 ? 0 : 30;

        const updateEventSliderStatus = () => {
            const cards = eventGrid.querySelectorAll(".event-card");
            const count = cards.length;
            const threshold = window.innerWidth <= 768 ? 1 : 3;
            const canRotate = count > threshold;
            if (eventControls) {
                eventControls.classList.toggle("hidden", !canRotate);
            }
            eventGrid.style.justifyContent = canRotate ? "flex-start" : "center";
            eventGrid.style.transform = "translateX(0)";
        };

        const nextEvent = () => {
            if (isTransitioning) return;
            const cards = eventGrid.querySelectorAll(".event-card");
            const threshold = window.innerWidth <= 768 ? 1 : 3;
            if (cards.length <= threshold) return;

            isTransitioning = true;
            const cardWidth = cards[0].offsetWidth;
            const moveAmount = cardWidth + getGap();

            eventGrid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
            eventGrid.style.transform = `translateX(-${moveAmount}px)`;

            const onTransitionEnd = () => {
                eventGrid.style.transition = "none";
                eventGrid.appendChild(eventGrid.firstElementChild);
                eventGrid.style.transform = "translateX(0)";
                isTransitioning = false;
                eventGrid.removeEventListener("transitionend", onTransitionEnd);
            };
            eventGrid.addEventListener("transitionend", onTransitionEnd);
        };

        const prevEvent = () => {
            if (isTransitioning) return;
            const cards = eventGrid.querySelectorAll(".event-card");
            const threshold = window.innerWidth <= 768 ? 1 : 3;
            if (cards.length <= threshold) return;

            isTransitioning = true;
            const cardWidth = cards[0].offsetWidth;
            const moveAmount = cardWidth + getGap();

            eventGrid.style.transition = "none";
            eventGrid.insertBefore(eventGrid.lastElementChild, eventGrid.firstElementChild);
            eventGrid.style.transform = `translateX(-${moveAmount}px)`;

            void eventGrid.offsetWidth; // Force reflow

            eventGrid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
            eventGrid.style.transform = "translateX(0)";

            const onTransitionEnd = () => {
                isTransitioning = false;
                eventGrid.removeEventListener("transitionend", onTransitionEnd);
            };
            eventGrid.addEventListener("transitionend", onTransitionEnd);
        };

        eventNextBtn.addEventListener("click", nextEvent);
        eventPrevBtn.addEventListener("click", prevEvent);

        let autoplayInterval;
        const startAutoplay = () => {
            if (autoplayInterval) clearInterval(autoplayInterval);
            const count = eventGrid.querySelectorAll(".event-card").length;
            const threshold = window.innerWidth <= 768 ? 1 : 3;
            if (count > threshold) {
                autoplayInterval = setInterval(nextEvent, 6000);
            }
        };

        eventGrid.addEventListener("mouseenter", () => {
            if (autoplayInterval) clearInterval(autoplayInterval);
        });
        eventGrid.addEventListener("mouseleave", () => {
            startAutoplay();
        });

        window.addEventListener("resize", () => {
            updateEventSliderStatus();
        });

        updateEventSliderStatus();
        startAutoplay();
    })();
;

// ========================================
// REGULAR SHOWS SLIDER
// ========================================
(function initRegularShowsSlider() {
    const grid = document.getElementById("regularShowsGrid");
    const prevBtn = document.getElementById("regularShowsPrevBtn");
    const nextBtn = document.getElementById("regularShowsNextBtn");
    const controls = document.getElementById("regularShowsControls");
    if (!grid || !prevBtn || !nextBtn) return;

    // Clean up clones
    const clones = grid.querySelectorAll(".clone");
    clones.forEach(c => c.remove());

    let isTransitioning = false;
    const gap = 30;

    const updateStatus = () => {
        const count = grid.querySelectorAll(".regular-show-card").length;
        const canRotate = count > 3;
        if (controls) {
            controls.classList.toggle("hidden", !canRotate);
        }
        grid.style.justifyContent = canRotate ? "flex-start" : "center";
        grid.style.transform = "translateX(0)";
    };

    const next = () => {
        if (isTransitioning) return;
        const cards = grid.querySelectorAll(".regular-show-card");
        if (cards.length <= 3) return;

        isTransitioning = true;
        const cardWidth = cards[0].offsetWidth;
        const moveAmount = cardWidth + gap;

        grid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        grid.style.transform = `translateX(-${moveAmount}px)`;

        const onEnd = () => {
            grid.style.transition = "none";
            grid.appendChild(grid.firstElementChild);
            grid.style.transform = "translateX(0)";
            isTransitioning = false;
            grid.removeEventListener("transitionend", onEnd);
        };
        grid.addEventListener("transitionend", onEnd);
    };

    const prev = () => {
        if (isTransitioning) return;
        const cards = grid.querySelectorAll(".regular-show-card");
        if (cards.length <= 3) return;

        isTransitioning = true;
        const cardWidth = cards[0].offsetWidth;
        const moveAmount = cardWidth + gap;

        grid.style.transition = "none";
        grid.insertBefore(grid.lastElementChild, grid.firstElementChild);
        grid.style.transform = `translateX(-${moveAmount}px)`;
        void grid.offsetWidth;

        grid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        grid.style.transform = "translateX(0)";

        const onEnd = () => {
            isTransitioning = false;
            grid.removeEventListener("transitionend", onEnd);
        };
        grid.addEventListener("transitionend", onEnd);
    };

    nextBtn.addEventListener("click", next);
    prevBtn.addEventListener("click", prev);

    let autoplay;
    const startAuto = () => {
        if (autoplay) clearInterval(autoplay);
        const count = grid.querySelectorAll(".regular-show-card").length;
        if (count > 3) {
            autoplay = setInterval(next, 6000);
        }
    };

    grid.addEventListener("mouseenter", () => clearInterval(autoplay));
    grid.addEventListener("mouseleave", startAuto);

    window.addEventListener("resize", updateStatus);
    updateStatus();
    startAuto();
})();


// ========================================
// EXHIBITION SLIDER
// ========================================
(function initExhibitionSlider() {
    const grid = document.getElementById("exhibitionGrid");
    const prevBtn = document.getElementById("exhibitionPrevBtn");
    const nextBtn = document.getElementById("exhibitionNextBtn");
    const controls = document.getElementById("exhibitionControls");
    if (!grid || !prevBtn || !nextBtn) return;

    // Clean up clones
    const clones = grid.querySelectorAll(".clone");
    clones.forEach(c => c.remove());

    let isTransitioning = false;
    const getGap = () => window.innerWidth <= 768 ? 0 : 30;

    const updateStatus = () => {
        const count = grid.querySelectorAll(".event-card").length;
        const threshold = window.innerWidth <= 768 ? 1 : 3;
        const canRotate = count > threshold;
        if (controls) {
            controls.classList.toggle("hidden", !canRotate);
        }
        grid.style.justifyContent = canRotate ? "flex-start" : "center";
        grid.style.transform = "translateX(0)";
    };

    const next = () => {
        if (isTransitioning) return;
        const cards = grid.querySelectorAll(".event-card");
        const threshold = window.innerWidth <= 768 ? 1 : 3;
        if (cards.length <= threshold) return;

        isTransitioning = true;
        const cardWidth = cards[0].offsetWidth;
        const moveAmount = cardWidth + getGap();

        grid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        grid.style.transform = `translateX(-${moveAmount}px)`;

        const onEnd = () => {
            grid.style.transition = "none";
            grid.appendChild(grid.firstElementChild);
            grid.style.transform = "translateX(0)";
            isTransitioning = false;
            grid.removeEventListener("transitionend", onEnd);
        };
        grid.addEventListener("transitionend", onEnd);
    };

    const prev = () => {
        if (isTransitioning) return;
        const cards = grid.querySelectorAll(".event-card");
        const threshold = window.innerWidth <= 768 ? 1 : 3;
        if (cards.length <= threshold) return;

        isTransitioning = true;
        const cardWidth = cards[0].offsetWidth;
        const moveAmount = cardWidth + getGap();

        grid.style.transition = "none";
        grid.insertBefore(grid.lastElementChild, grid.firstElementChild);
        grid.style.transform = `translateX(-${moveAmount}px)`;
        void grid.offsetWidth;

        grid.style.transition = "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        grid.style.transform = "translateX(0)";

        const onEnd = () => {
            isTransitioning = false;
            grid.removeEventListener("transitionend", onEnd);
        };
        grid.addEventListener("transitionend", onEnd);
    };

    nextBtn.addEventListener("click", next);
    prevBtn.addEventListener("click", prev);

    let autoplay;
    const startAuto = () => {
        if (autoplay) clearInterval(autoplay);
        const count = grid.querySelectorAll(".event-card").length;
        const threshold = window.innerWidth <= 768 ? 1 : 3;
        if (count > threshold) {
            autoplay = setInterval(next, 6000);
        }
    };

    grid.addEventListener("mouseenter", () => clearInterval(autoplay));
    grid.addEventListener("mouseleave", startAuto);

    window.addEventListener("resize", updateStatus);
    updateStatus();
    startAuto();
})();


document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
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








const mapFloors = document.getElementById("mapFloors");
const scrollIndicator = document.getElementById("scrollIndicator");

if (mapFloors && scrollIndicator) {

    const checkScrollable = () => {
        const isScrollable = mapFloors.scrollHeight > mapFloors.clientHeight;
        if (!isScrollable) {
            scrollIndicator.classList.add("hidden");
        }
    };


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


const tenantCards = document.querySelectorAll(".tenant-card");
tenantCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.1}s`;
});


const buttons = document.querySelectorAll(
    "button:not(#darkModeToggle), .explore-btn, .all-experience-btn"
);
buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
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


        const currentPosition = window.getComputedStyle(this).position;
        if (currentPosition === "static") {
            this.style.position = "relative";
        }
        this.style.overflow = "hidden";
        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });
});


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
    },
    {
        threshold: 0.1,
    }
);

const footer = document.querySelector("footer");
if (footer) {
    footerObserver.observe(footer);
}


// Global cache for tenant search (1st and 2nd floor only)
let allTenantsCache = {
    "1st Floor": [],
    "2nd Floor": [],
    "loaded": false
};

async function fetchAllTenantsForSearch() {
    if (allTenantsCache.loaded) return;

    try {
        const [floor1, floor2] = await Promise.all([
            loadTenantsOnDatabase("1st Floor", false),
            loadTenantsOnDatabase("2nd Floor", false)
        ]);

        allTenantsCache["1st Floor"] = floor1 || [];
        allTenantsCache["2nd Floor"] = floor2 || [];
        allTenantsCache.loaded = true;
    } catch (error) {
        console.error("Failed to fetch all tenants for search", error);
    }
}


function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const context = this;
        const later = () => {
            clearTimeout(timeout);
            func.apply(context, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}


const debouncedReveal = debounce(revealOnScroll, 50);
window.removeEventListener("scroll", revealOnScroll);
window.addEventListener("scroll", debouncedReveal);


window.addEventListener("load", () => {
    document.body.classList.add("loaded");

    setTimeout(() => {
        revealOnScroll();
    }, 100);
});




async function loadTenantsOnDatabase(floor, isNew = false) {
    try {
        const data = await $.get(window.location.origin + "/tenants/" + floor + '/' + isNew);
        return data;
    } catch (error) {
        console.error("Failed to load data", error);
        return [];
    }
}

async function renderLandingTenants(floor, isNew = false, searchQuery = "") {
    // Try to get from cache first for performance
    let tenantData = [];
    
    if (floor === "Favorites") {
        const favoriteUnits = JSON.parse(localStorage.getItem('mall_favorites') || '[]')
                                  .map(u => u.trim());
        // We need all tenants to filter by unit. If cache is not loaded, we have to fetch or wait.
        if (!allTenantsCache.loaded) {
            await fetchAllTenantsForSearch();
        }
        tenantData = [...allTenantsCache["1st Floor"], ...allTenantsCache["2nd Floor"]]
                        .filter(t => favoriteUnits.includes(t.unit.trim()));
    } else if (!isNew && allTenantsCache.loaded && allTenantsCache[floor]) {
        tenantData = allTenantsCache[floor];
    } else {
        tenantData = await loadTenantsOnDatabase(floor, isNew);
    }

    const grid = document.getElementById("landingTenantGrid");
    const emptyState = document.getElementById("landingEmptyState");
    if (!grid) return;

    grid.innerHTML = "";

    // Data is already filtered by floor from backend/cache
    let filtered = tenantData;

    if (searchQuery) {
        const query = searchQuery.toLowerCase();
        filtered = filtered.filter(
            (t) =>
                (t.name && t.name.toLowerCase().includes(query)) ||
                (t.category && t.category.toLowerCase().includes(query))
        );
    }

    if (filtered.length === 0) {
        if (emptyState) emptyState.style.display = "block";
        return;
    }

    if (emptyState) emptyState.style.display = "none";

    filtered.forEach((tenant, index) => {
        const card = document.createElement("div");
        card.className = "tenant-card stagger-card";
        card.style.animationDelay = `${index * 0.1}s`;
        card.setAttribute("data-id", tenant.id);

        card.innerHTML = `
                    <div class="tenant-logo">
                        <img src="${tenant.logo}" alt="${tenant.name}" loading="lazy" onerror="this.src='/assets/images/no_image.jpg'">
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
                        <button class="see-details-btn" data-id="${tenant.id}">
                            Learn More
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                `;

        card.addEventListener("click", () => {
            if (typeof openTenantModal === "function") {
                openTenantModal(tenant.id);
            }
        });

        grid.appendChild(card);
        setTimeout(() => card.classList.add("show"), 50);
    });

    if (typeof revealOnScroll === "function") {
        setTimeout(revealOnScroll, 100);
    }
}


document.addEventListener("DOMContentLoaded", () => {
    renderLandingTenants("1st Floor");

    const floorItems = document.querySelectorAll(".map-floors .floor-item");
    floorItems.forEach((item) => {

        item.addEventListener("click", function () {

            floorItems.forEach((i) => i.classList.remove("active"));

            this.classList.add("active");

            const h4 = this.querySelector("h4");
            const floorText = h4 ? h4.textContent.trim() : "";
            let targetFloor = "1st Floor";
            let isNew = false;


            if (floorText.includes("1st") || floorText.includes("Level 1")) {
                targetFloor = "1st Floor";
            } else if (floorText.includes("2nd") || floorText.includes("Level 2")) {
                targetFloor = "2nd Floor";
            } else if (floorText.includes("New Store")) {
                targetFloor = "New Store";
                isNew = true;
            } else if (floorText.includes("Favorites")) {
                renderLandingTenants("Favorites");
                return;
            } else if (floorText.includes("All Floor")){
                window.location.href = "/directory";
            }

            renderLandingTenants(targetFloor, isNew);

            // Clear search input when switching floors MANUALLY (not via search logic)
            if (!this.classList.contains("switching-via-search")) {
                const searchInput = document.getElementById("tenantSearchInput");
                if (searchInput) searchInput.value = "";
            }
        });
    });

    // Initial fetch
    fetchAllTenantsForSearch();

    const searchInput = document.getElementById("tenantSearchInput");
    if (searchInput) {
        searchInput.addEventListener(
            "input",
            debounce(async function (e) {
                const query = e.target.value.toLowerCase();
                if (!query) {
                    // If search is cleared, just re-render current floor
                    const activeItem = document.querySelector(".map-floors .floor-item.active");
                    if (activeItem) activeItem.click();
                    return;
                }

                const activeFloorItem = document.querySelector(".map-floors .floor-item.active");
                if (!activeFloorItem) return;

                const h4 = activeFloorItem.querySelector("h4");
                const currentFloorText = h4 ? h4.textContent.trim() : "";

                // Deterministic floor names for cache
                let currentFloor = "";
                if (currentFloorText.includes("1st") || currentFloorText.includes("Level 1")) currentFloor = "1st Floor";
                else if (currentFloorText.includes("2nd") || currentFloorText.includes("Level 2")) currentFloor = "2nd Floor";

                // Ensure cache is loaded before global search
                if (!allTenantsCache.loaded) {
                    await fetchAllTenantsForSearch();
                }

                // 1. Search in current floor first
                if (currentFloor && allTenantsCache[currentFloor]) {
                    const matchesOnCurrent = allTenantsCache[currentFloor].filter(t =>
                        (t.name && t.name.toLowerCase().includes(query)) ||
                        (t.category && t.category.toLowerCase().includes(query))
                    );

                    if (matchesOnCurrent.length > 0) {
                        renderLandingTenants(currentFloor, false, query);
                        return;
                    }
                }

                // 2. If no matches on current floor, look at the other floor (1st or 2nd only)
                const otherFloor = currentFloor === "1st Floor" ? "2nd Floor" : "1st Floor";
                const matchesOnOther = (allTenantsCache[otherFloor] || []).filter(t =>
                    (t.name && t.name.toLowerCase().includes(query)) ||
                    (t.category && t.category.toLowerCase().includes(query))
                );

                if (matchesOnOther.length > 0) {
                    // Auto-switch floor
                    const floorItems = document.querySelectorAll(".map-floors .floor-item");
                    floorItems.forEach(item => {
                        const text = item.querySelector("h4")?.textContent.trim() || "";
                        const isTarget = otherFloor === "1st Floor" ? (text.includes("1st") || text.includes("Level 1")) : (text.includes("2nd") || text.includes("Level 2"));

                        if (isTarget) {
                            // Click the item, but we'll manually handle the restoration of search and rendering
                            item.classList.add("switching-via-search");
                            item.click();

                            // Restore query and filter (the click event usually clears it)
                            const input = document.getElementById("tenantSearchInput");
                            if (input) {
                                input.value = query;
                                // Small delay to ensure click handler finished
                                setTimeout(() => {
                                    renderLandingTenants(otherFloor, false, query);
                                    item.classList.remove("switching-via-search");
                                }, 50);
                            }
                        }
                    });
                    return;
                }

                // 3. If still no matches (including New Store if it was active), show empty state for current view
                // Default fallback to current rendering
                let targetFloor = currentFloor || "1st Floor";
                let isNew = currentFloorText.includes("New Store");
                renderLandingTenants(targetFloor, isNew, query);

            }, 400)
        );
    }
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


const tenantNavPrev = document.getElementById("tenantNavPrev");
const tenantNavNext = document.getElementById("tenantNavNext");
const tenantGridForNav = document.getElementById("landingTenantGrid");

if (tenantNavPrev && tenantNavNext && tenantGridForNav) {
    const getScrollAmount = () => {
        const card = tenantGridForNav.querySelector(".tenant-card");
        if (card) {
            return card.offsetWidth + 24;
        }
        return 400;
    };

    tenantNavPrev.addEventListener("click", () => {
        const scrollAmount = getScrollAmount();
        tenantGridForNav.scrollBy({
            left: -scrollAmount,
            behavior: "smooth",
        });
    });

    tenantNavNext.addEventListener("click", () => {
        const scrollAmount = getScrollAmount();
        tenantGridForNav.scrollBy({
            left: scrollAmount,
            behavior: "smooth",
        });
    });
}


const floorWrapper = document.querySelector(".floor-list-wrapper");
const floorScrollUp = document.getElementById("floorScrollUp");
const floorScrollDown = document.getElementById("floorScrollDown");

if (floorWrapper && floorScrollUp && floorScrollDown) {
    function updateFloorIndicators() {
        const scrollTop = floorWrapper.scrollTop;
        const scrollHeight = floorWrapper.scrollHeight;
        const clientHeight = floorWrapper.clientHeight;
        const isScrollable = scrollHeight > clientHeight;


        if (scrollTop > 10 && isScrollable) {
            floorScrollUp.classList.remove("hidden");
        } else {
            floorScrollUp.classList.add("hidden");
        }


        if (scrollTop + clientHeight < scrollHeight - 10 && isScrollable) {
            floorScrollDown.classList.remove("hidden");
        } else {
            floorScrollDown.classList.add("hidden");
        }
    }

    floorWrapper.addEventListener("scroll", updateFloorIndicators);


    setTimeout(updateFloorIndicators, 500);


    window.addEventListener("resize", updateFloorIndicators);
}


const tenantModal = document.getElementById("tenantModal");
const modalOverlay = document.getElementById("modalOverlay");
const modalClose = document.getElementById("modalClose");
const modalCarouselImages = document.getElementById("modalCarouselImages");
const modalCarouselPrev = document.getElementById("modalCarouselPrev");
const modalCarouselNext = document.getElementById("modalCarouselNext");
const modalCarouselIndicators = document.getElementById(
    "modalCarouselIndicators"
);

let currentModalImageIndex = 0;
let modalImages = [];
let tenantData = null;
const tenantCache = {}; // Client-side cache for tenant data

// Visual Map Constants
const visualMapContainer = document.getElementById("visualMapContainer");
const visualMapImage = document.getElementById("visualMapImage");
const mapMarker = document.getElementById("mapMarker");
const tenantContentGrid = document.getElementById("tenantContentGrid");
const showOnMapBtn = document.getElementById("showOnMapBtn");
const btnBackToGrid = document.getElementById("btnBackToGrid");


async function getDataByTenantId(tenant_id) {
    try {
        return await $.get("/find/tenants/"+tenant_id);
    } catch (error) {
        console.log("Failed to load data", error);
    }
}


async function openTenantModal(tenant_id) {
    // Check cache first
    let cachedData = tenantCache[tenant_id];

    if (cachedData) {
        tenantData = cachedData;
        updateModalContent(tenantData);
    } else {
        // Fallback to logo from grid if available
        const gridCard = document.querySelector(`.see-details-btn[data-id="${tenant_id}"]`)?.closest('.tenant-card');
        const gridLogo = gridCard?.querySelector('.tenant-logo img')?.src;

        if (gridLogo) {
            // Show modal immediately with fallback data
            const fallbackData = {
                name: gridCard.querySelector('h3')?.textContent || "Loading...",
                logo: gridLogo,
                floor: gridCard.querySelector('.floor-badge')?.textContent || "-",
                category: gridCard.querySelector('.tenant-category')?.textContent?.trim() || "-",
                unit: gridCard.querySelector('.meta-item:first-child span')?.textContent?.replace('Unit ', '') || "",
                hours: "10:00 AM - 10:00 PM",
                description: "Learn more about this tenant and their premium offerings. Visit us today for an unforgettable shopping experience!",
                images: [gridLogo],
                has_album: false
            };
            updateModalContent(fallbackData);
        }

        // Show loading indicator
        const loadingIndicator = document.getElementById("modalCarouselLoading");
        if (loadingIndicator) loadingIndicator.classList.add("active");

        // Fetch full data
        tenantData = await getDataByTenantId(tenant_id);
        if (tenantData) {
            tenantCache[tenant_id] = tenantData;
            updateModalContent(tenantData);
        }

        if (loadingIndicator) loadingIndicator.classList.remove("active");
    }
}

// Global helper to update modal content safely
function updateModalContent(data) {
    if (!data) return;

    // Basic data
    const nameEl = document.getElementById("modalTenantName");
    if (nameEl) nameEl.textContent = data.name;

    const floorBadge = document.getElementById("modalFloorBadge");
    if (floorBadge) floorBadge.textContent = data.floor;

    const categoryText = document.getElementById("modalCategoryText");
    if (categoryText) categoryText.textContent = data.category;

    const locationEl = document.getElementById("modalLocation");
    if (locationEl) locationEl.textContent = data.floor;

    const hoursEl = document.getElementById("modalHours");
    if (hoursEl) hoursEl.textContent = data.hours;

    // Set data-unit for favorite button synchronization
    const modalFavBtn = document.getElementById("modalFavoriteBtn");
    if (modalFavBtn) {
        modalFavBtn.setAttribute("data-unit", data.unit || "");
    }

    // Set logo in modal header ONLY if tenant has album photos
    const modalLogo = document.getElementById("modalLogo");
    if (modalLogo) {
        if (data.has_album) {
            modalLogo.innerHTML = `<img src="${data.logo}" alt="${data.name}">`;
            modalLogo.style.display = 'flex';
        } else {
            modalLogo.innerHTML = '';
            modalLogo.style.display = 'none';
        }
    }

    // Modal Description
    const descEl = document.getElementById("modalDescription");
    if (descEl) {
        const description = data.description || "Discover amazing products and services at this store. Visit us today for an unforgettable shopping experience!";
        descEl.innerHTML = `<p>${description}</p>`;
    }

    // Carousel setup
    modalImages = data.images || [data.logo];
    currentModalImageIndex = 0;
    renderModalCarousel(data.name);

    // Map setup
    // renderModalMap(data); // Don't render map automatically anymore

    // Ensure we start with Info View
    const infoView = document.getElementById("modalInfoView");
    const mapView = document.getElementById("modalMapView");
    if (infoView) infoView.style.display = "block";
    if (mapView) mapView.style.display = "none";
    tenantModal.classList.remove("map-active-mobile");

    // Show modal and prevent body scroll
    document.body.style.overflow = "hidden";
    if (window.lenis) window.lenis.stop();
    if (tenantModal) tenantModal.classList.add("active");

    // Action button listeners
    const modalFavBtn = document.getElementById("modalFavoriteBtn");
    if (modalFavBtn) {
        // Load favorites from localStorage (using mall_favorites key and units for parity)
        let favorites = JSON.parse(localStorage.getItem('mall_favorites') || '[]');
        
        // Ensure accurate comparison (trimmed, consistent casing)
        const currentUnit = (data.unit || "").trim();
        const isFavorited = favorites.some(fav => fav.trim() === currentUnit);
        
        if (isFavorited) {
            modalFavBtn.classList.add("active");
        } else {
            modalFavBtn.classList.remove("active");
        }

        const newFavBtn = modalFavBtn.cloneNode(true);
        modalFavBtn.parentNode.replaceChild(newFavBtn, modalFavBtn);
        
        newFavBtn.addEventListener("click", () => {
            const isActive = newFavBtn.classList.toggle("active");
            let favs = JSON.parse(localStorage.getItem('mall_favorites') || '[]');
            const currentUnit = (data.unit || "").trim();
            
            if (isActive) {
                // Add to favorites (store only unit for parity)
                if (!favs.some(fav => fav.trim() === currentUnit)) {
                    favs.push(currentUnit);
                }
                showToast("Added to favorites ❤️", "success");
            } else {
                // Remove from favorites
                favs = favs.filter(unit => unit.trim() !== currentUnit);
                showToast("Removed from favorites", "success");
                
                // If we are currently on the Favorites floor, refresh the grid
                const activeFloor = document.querySelector(".map-floors .floor-item.active h4")?.textContent;
                if (activeFloor === "Favorites") {
                    renderLandingTenants("Favorites");
                }
            }
            
            localStorage.setItem('mall_favorites', JSON.stringify(favs));
        });
    }

    const modalShareBtn = document.getElementById("modalShareBtn");
    if (modalShareBtn) {
        const newShareBtn = modalShareBtn.cloneNode(true);
        modalShareBtn.parentNode.replaceChild(newShareBtn, modalShareBtn);
        newShareBtn.addEventListener("click", () => {
            const shareUrl = `${window.location.origin}${window.location.pathname}?id=${data.id || data.unit}`;

            if (navigator.share) {
                navigator.share({
                    title: data.name,
                    text: `Check out ${data.name} at Mal Bali Galeria!`,
                    url: shareUrl
                }).catch(err => {
                    console.log("Share failed, falling back to clipboard", err);
                    copyToClipboard(shareUrl);
                });
            } else {
                copyToClipboard(shareUrl);
            }
        });
    }

    // Swipe hint
    const swipeHint = document.getElementById("carouselSwipeHint");
    if (swipeHint) {
        if (modalImages.length > 1) {
            swipeHint.classList.remove("hidden");
            setTimeout(() => {
                swipeHint.classList.add("hidden");
            }, 3000);
        } else {
            swipeHint.classList.add("hidden");
        }
    }
}


function closeTenantModal() {
    if (tenantModal) tenantModal.classList.remove("active");
    if (window.lenis) window.lenis.start();
    
    // Restore body scroll
    document.body.style.overflow = "";
    document.body.style.paddingRight = "";


    setTimeout(() => {
        currentModalImageIndex = 0;
        modalImages = [];
        tenantData = null;
    }, 400);
}


function renderModalCarousel(tenantName) {

    modalCarouselImages.innerHTML = modalImages
        .map(
            (img, index) => `
                <div class="carousel-image">
                    <img src="${img}" alt="${tenantName || 'Tenant'} - Image ${
                index + 1
            }">
                </div>
            `
        )
        .join("");


    modalCarouselIndicators.innerHTML = modalImages
        .map(
            (_, index) => `
                <div class="carousel-indicator ${
                    index === currentModalImageIndex ? "active" : ""
                }" data-index="${index}"></div>
            `
        )
        .join("");


    updateModalCarousel();


    document.querySelectorAll(".carousel-indicator").forEach((indicator) => {
        indicator.addEventListener("click", () => {
            currentModalImageIndex = parseInt(indicator.dataset.index);
            updateModalCarousel();
        });
    });
}


function updateModalCarousel() {
    if (!modalCarouselImages) return;
    const offset = -currentModalImageIndex * 100;
    modalCarouselImages.style.transform = `translateX(${offset}%)`;

    document.querySelectorAll(".carousel-indicator").forEach((indicator, index) => {
        if (index === currentModalImageIndex) {
            indicator.classList.add("active");
        } else {
            indicator.classList.remove("active");
        }
    });
}


if (modalCarouselPrev) {
    modalCarouselPrev.addEventListener("click", () => {
        currentModalImageIndex =
            (currentModalImageIndex - 1 + modalImages.length) %
            modalImages.length;
        updateModalCarousel();
    });
}

if (modalCarouselNext) {
    modalCarouselNext.addEventListener("click", () => {
        currentModalImageIndex =
            (currentModalImageIndex + 1) % modalImages.length;
        updateModalCarousel();
    });
}
let touchStartX = 0;
let touchEndX = 0;
let touchStartY = 0;
let touchEndY = 0;

function handleSwipeGesture() {
    const swipeThreshold = 50;
    const horizontalSwipe = Math.abs(touchEndX - touchStartX);
    const verticalSwipe = Math.abs(touchEndY - touchStartY);


    if (horizontalSwipe > verticalSwipe && horizontalSwipe > swipeThreshold) {
        if (touchEndX < touchStartX) {
            currentModalImageIndex =
                (currentModalImageIndex + 1) % modalImages.length;
            updateModalCarousel();
        } else if (touchEndX > touchStartX) {
            currentModalImageIndex =
                (currentModalImageIndex - 1 + modalImages.length) %
                modalImages.length;
            updateModalCarousel();
        }
    }
}

if (modalCarouselImages) {

    modalCarouselImages.addEventListener(
        "touchstart",
        (e) => {
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
        },
        { passive: true }
    );

    modalCarouselImages.addEventListener(
        "touchend",
        (e) => {
            touchEndX = e.changedTouches[0].screenX;
            touchEndY = e.changedTouches[0].screenY;
            handleSwipeGesture();
        },
        { passive: true }
    );


    let isDragging = false;

    modalCarouselImages.addEventListener("mousedown", (e) => {
        isDragging = true;
        touchStartX = e.screenX;
        touchStartY = e.screenY;
        modalCarouselImages.style.cursor = "grabbing";
    });

    modalCarouselImages.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
    });

    modalCarouselImages.addEventListener("mouseup", (e) => {
        if (!isDragging) return;
        isDragging = false;
        touchEndX = e.screenX;
        touchEndY = e.screenY;
        handleSwipeGesture();
        modalCarouselImages.style.cursor = "grab";
    });

    modalCarouselImages.addEventListener("mouseleave", () => {
        if (isDragging) {
            isDragging = false;
            modalCarouselImages.style.cursor = "grab";
        }
    });


    modalCarouselImages.style.cursor = "grab";
}


const modalCloseBtn = document.getElementById("modalCloseBtn");
if (modalCloseBtn) {
    modalCloseBtn.addEventListener("click", closeTenantModal);
}

if (modalOverlay) {
    modalOverlay.addEventListener("click", closeTenantModal);
}


document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && tenantModal.classList.contains("active")) {
        closeTenantModal();
    }
});


document.addEventListener("click", (e) => {
    if (
        e.target.classList.contains("see-details-btn") ||
        e.target.closest(".see-details-btn") ||
        e.target.classList.contains("featured-tenant-trigger") ||
        e.target.closest(".featured-tenant-trigger")
    ) {
        let button = e.target;
        if (e.target.closest(".see-details-btn")) {
            button = e.target.closest(".see-details-btn");
        } else if (e.target.closest(".featured-tenant-trigger")) {
            button = e.target.closest(".featured-tenant-trigger");
        }

        const tenantId = button.dataset.id;
        if (tenantId) {
            openTenantModal(tenantId);
        }
    }
});

// Helper for clipboard
function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast("Link copied to clipboard!", "success");
        });
    } else {
        const textarea = document.createElement("textarea");
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);
        showToast("Link copied to clipboard!", "success");
    }
}

// Toast notification system
function showToast(message, type = "info") {
    const toast = document.createElement("div");
    toast.className = `toast-notification ${type}`;

    let icon = "";
    if (type === "success") {
        icon = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>';
    } else {
        icon = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';
    }

    toast.innerHTML = `${icon}<span>${message}</span>`;
    document.body.appendChild(toast);

    toast.offsetHeight; // force reflow
    toast.classList.add("active");

    setTimeout(() => {
        toast.classList.remove("active");
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Check for deep-link parameter on load
document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const tenantId = urlParams.get("id") || urlParams.get("store");
    if (tenantId) {
        setTimeout(() => {
            openTenantModal(tenantId);
        }, 1000);
    }
});

// Instagram Load More Logic
document.addEventListener("DOMContentLoaded", () => {
    const loadMoreBtn = document.getElementById("loadMoreIg");
    let currentVisible = 6;

    if (loadMoreBtn) {
        const allItems = document.querySelectorAll(".instagram-item");

        loadMoreBtn.addEventListener("click", (e) => {
            e.preventDefault();

            // Detect current column count (row size)
            const grid = document.querySelector(".instagram-grid");
            const columns = window.getComputedStyle(grid).getPropertyValue("grid-template-columns").split(" ").length;
            const increment = columns;

            const hiddenItems = document.querySelectorAll(".instagram-item.ig-hidden");

            if (hiddenItems.length > 0) {
                const itemsToReveal = Array.from(hiddenItems).slice(0, increment);

                itemsToReveal.forEach((item, index) => {
                    item.style.display = 'block';
                    item.style.opacity = '0';
                    item.classList.remove("ig-hidden");

                    setTimeout(() => {
                        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        item.style.opacity = '1';
                    }, index * 100);
                });

                currentVisible += itemsToReveal.length;

                if (currentVisible >= allItems.length) {
                    loadMoreBtn.style.display = "none";
                }
            } else {
                loadMoreBtn.style.display = "none";
            }
        });
    }
});

// --- INTERACTIVE MAP FUNCTIONS ---
if (showOnMapBtn) {
    showOnMapBtn.addEventListener("click", () => {
        if (tenantData) {
            // Instead of closing modal and scrolling, we swap view inside modal
            renderModalMap(tenantData);

            const infoView = document.getElementById("modalInfoView");
            const mapView = document.getElementById("modalMapView");
            if (infoView) infoView.style.display = "none";
            if (mapView) mapView.style.display = "block";
            tenantModal.classList.add("map-active-mobile");

            // Logically, we still want to keep the old pinpoint function for outside triggers
            // pinpointOnMap(tenantData);
        }
    });
}

const btnBackToInfo = document.getElementById("btnBackToInfo");
if (btnBackToInfo) {
    btnBackToInfo.addEventListener("click", () => {
        const infoView = document.getElementById("modalInfoView");
        const mapView = document.getElementById("modalMapView");
        if (infoView) infoView.style.display = "block";
        if (mapView) mapView.style.display = "none";
        tenantModal.classList.remove("map-active-mobile");
    });
}

if (btnBackToGrid) {
    btnBackToGrid.addEventListener("click", () => {
        if (visualMapContainer) visualMapContainer.style.display = "none";
        if (tenantContentGrid) tenantContentGrid.style.display = "block";
    });
}

function pinpointOnMap(tenant) {
    if (!tenant || !tenant.x || !tenant.y) {
        console.warn("No coordinates for tenant:", tenant?.name);
        alert("Lokasi tenant ini belum tersedia di peta.");
        return;
    }

    // Determine floor image
    const floorId = tenant.floor_id || (tenant.map_coords ? tenant.map_coords.floor : null);
    const floorImg = floorId == 2 ? "2nd_floor.png" : "1st_floor.png";

    // Switch view to map
    if (tenantContentGrid) tenantContentGrid.style.display = "none";
    if (visualMapContainer) visualMapContainer.style.display = "block";

    // Set map image
    if (visualMapImage) {
        if (window.FLOOR_MAPS && window.FLOOR_MAPS[floorId]) {
            visualMapImage.src = window.FLOOR_MAPS[floorId];
        } else {
            const baseUrl = window.FLOOR_MAP_BASE_URL || '/assets/images/floors';
            visualMapImage.src = `${baseUrl}/${floorImg}`;
        }

        // Position marker using percentages
        if (mapMarker) {
            let xPos, yPos;

            const mapWidth = tenant.map_original_size?.width || visualMapImage.naturalWidth || 1400;
            const mapHeight = tenant.map_original_size?.height || visualMapImage.naturalHeight || 1000;

            xPos = (tenant.x / mapWidth) * 100;
            yPos = (tenant.y / mapHeight) * 100;

            mapMarker.style.left = `${xPos}%`;
            mapMarker.style.top = `${yPos}%`;
            mapMarker.style.display = "block";
        }
    }

    // Close modal
    if (typeof closeTenantModal === 'function') {
        closeTenantModal();
    } else {
        const modal = document.getElementById("tenantModal");
        if (modal) modal.classList.remove("active");
        document.body.style.overflow = "";
    }

    // Scroll to section
    const mapSection = document.getElementById("map-section") || document.querySelector(".map-display");
    if (mapSection) {
        mapSection.scrollIntoView({ behavior: "smooth", block: "start" });
    }
}

/**
 * Renders the map inside the modal for a specific tenant
 */
function renderModalMap(data) {
    console.log("renderModalMap called with data:", data);

    const floorMapImg = document.getElementById("modalFloorMap");
    const markerLogo = document.getElementById("modalMapMarkerLogo");
    const logoImg = document.getElementById("markerLogoImg");

    // Check if coordinates exist (map_original_size is optional, we'll use fallback)
    if (data.x && data.y) {
        const floorId = data.floor_id || (data.map_coords ? data.map_coords.floor : null);
        const floorImg = floorId == 2 ? "2nd_floor.png" : "1st_floor.png";
        const floorText = floorId == 2 ? "2nd Floor" : "1st Floor";

        console.log("Setting floor map image for floor:", floorId);

        // Update floor badge
        const floorBadge = document.getElementById("modalMapFloorBadge");
        if (floorBadge) {
            floorBadge.textContent = floorText;
        }

        // Set logo (only if elements exist)
        if (logoImg && data.logo) {
            logoImg.src = data.logo;
        }

        // Define positionMarker closure (captures current tenant's data)
        const positionMarker = () => {
            const mapWidth = data.map_original_size?.width || floorMapImg.naturalWidth || 1400;
            const mapHeight = data.map_original_size?.height || floorMapImg.naturalHeight || 1000;

            const xPos = (data.x / mapWidth) * 100;
            const yPos = (data.y / mapHeight) * 100;

            if (markerLogo) {
                markerLogo.style.left = `${xPos}%`;
                markerLogo.style.top = `${yPos}%`;
                markerLogo.style.display = "block";
            }
        };

        // Always clear previous onload FIRST to prevent stale handler from
        // re-positioning pin to a previous tenant's coordinates.
        floorMapImg.onload = null;

        // Set the floor map src
        if (window.FLOOR_MAPS && window.FLOOR_MAPS[floorId]) {
            floorMapImg.src = window.FLOOR_MAPS[floorId];
        } else {
            const baseUrl = window.FLOOR_MAP_BASE_URL || '/assets/images/floors';
            floorMapImg.src = `${baseUrl}/${floorImg}`;
        }

        // If image is already cached (complete), call positionMarker directly.
        // Otherwise set onload so it fires once the image finishes loading.
        if (floorMapImg.complete && floorMapImg.naturalWidth > 0) {
            positionMarker();
        } else {
            floorMapImg.onload = positionMarker;
        }
    } else {
        console.warn("Missing coordinates:", {
            x: data.x,
            y: data.y
        });
        if (markerLogo) {
            markerLogo.style.display = "none";
        }
    }
}

// ========================================
// EVENT DETAIL MODAL
// ========================================
(function initEventDetailModal() {
    const modal = document.getElementById("eventDetailModal");
    const overlay = document.getElementById("eventModalOverlay");
    const closeBtn = document.getElementById("eventModalCloseBtn");
    const carouselImages = document.getElementById("eventModalCarouselImages");
    const carouselIndicators = document.getElementById("eventModalCarouselIndicators");
    const carouselPrev = document.getElementById("eventModalCarouselPrev");
    const carouselNext = document.getElementById("eventModalCarouselNext");
    const swipeHint = document.getElementById("eventModalCarouselSwipeHint");

    const typeBadge = document.getElementById("eventModalTypeBadge");
    const dateEl = document.getElementById("eventModalDate");
    const titleEl = document.getElementById("eventModalTitle");
    const descEl = document.getElementById("eventModalDescription");
    const locationEl = document.getElementById("eventModalLocation");
    const typeEl = document.getElementById("eventModalType");
    const calendarBtn = document.getElementById("eventModalCalendarBtn");
    const shareBtn = document.getElementById("eventModalShareBtn");

    if (!modal) return;

    let currentEventUuid = null;
    let eventImages = [];
    let currentImageIndex = 0;
    const eventCache = {};

    async function fetchEventData(uuid) {
        if (eventCache[uuid]) return eventCache[uuid];
        try {
            const data = await $.get(`/find/events/${uuid}`);
            eventCache[uuid] = data;
            return data;
        } catch (error) {
            console.error("Failed to fetch event data", error);
            return null;
        }
    }

    function renderCarousel(images, name) {
        if (!carouselImages || !carouselIndicators) return;

        eventImages = images;
        currentImageIndex = 0;

        carouselImages.innerHTML = images.map((img, idx) => `
            <div class="carousel-image">
                <img src="${img}" alt="${name} - Image ${idx + 1}" onerror="this.src='/assets/images/no_image.jpg'">
            </div>
        `).join("");

        carouselIndicators.innerHTML = images.map((_, idx) => `
            <div class="carousel-indicator ${idx === 0 ? 'active' : ''}" data-index="${idx}"></div>
        `).join("");

        const hasMultipleImages = images.length > 1;
        const carouselContainer = carouselImages.parentElement;
        if (carouselContainer) {
            carouselContainer.classList.toggle("has-multiple-images", hasMultipleImages);
        }
        if (carouselPrev) carouselPrev.style.display = hasMultipleImages ? 'flex' : 'none';
        if (carouselNext) carouselNext.style.display = hasMultipleImages ? 'flex' : 'none';
        if (carouselIndicators) carouselIndicators.style.display = hasMultipleImages ? 'flex' : 'none';

        updateCarousel();

        // Re-attach indicator listeners
        carouselIndicators.querySelectorAll(".carousel-indicator").forEach(indicator => {
            indicator.addEventListener("click", () => {
                currentImageIndex = parseInt(indicator.dataset.index);
                updateCarousel();
            });
        });
    }

    function updateCarousel() {
        if (!carouselImages) return;
        const offset = -currentImageIndex * 100;
        carouselImages.style.transform = `translateX(${offset}%)`;

        const indicators = carouselIndicators.querySelectorAll(".carousel-indicator");
        indicators.forEach((indicator, idx) => {
            indicator.classList.toggle("active", idx === currentImageIndex);
        });

        // Toggle swipe hint visibility
        if (swipeHint) {
            swipeHint.style.display = (eventImages.length > 1 && currentImageIndex === 0) ? 'flex' : 'none';
        }
    }

    if (carouselPrev) {
        carouselPrev.addEventListener("click", () => {
            currentImageIndex = (currentImageIndex - 1 + eventImages.length) % eventImages.length;
            updateCarousel();
        });
    }

    if (carouselNext) {
        carouselNext.addEventListener("click", () => {
            currentImageIndex = (currentImageIndex + 1) % eventImages.length;
            updateCarousel();
        });
    }

    async function openEventModal(card) {
        const uuid = card.dataset.eventUuid;
        if (!uuid) return;

        currentEventUuid = uuid;

        // Show modal with skeleton or partial data first
        if (titleEl) titleEl.textContent = card.dataset.eventName || "Loading...";
        if (dateEl) dateEl.textContent = card.dataset.eventDate || "";
        if (descEl) descEl.innerHTML = card.dataset.eventDesc ? `<p>${card.dataset.eventDesc}</p>` : "";
        if (locationEl) locationEl.textContent = card.dataset.eventLocation || "Mal Bali Galeria";
        if (typeBadge) typeBadge.textContent = card.dataset.eventType || "Event";

        // New Fields (Fast Load)
        const timeEl = document.getElementById("eventModalTime");
        const highlightEl = document.getElementById("eventModalHighlights");
        const monthYearEl = document.getElementById("eventModalMonthYear");

        if (timeEl) timeEl.textContent = card.dataset.eventTime || "All Day";
        if (highlightEl) highlightEl.textContent = card.dataset.eventHighlight || "-";
        if (monthYearEl) monthYearEl.textContent = card.dataset.eventMonthyear || "";

        // Use card image as placeholder in carousel
        const placeholderImg = card.dataset.eventImage || "/assets/images/no_image.jpg";
        renderCarousel([placeholderImg], card.dataset.eventName || "Event");

        document.body.style.overflow = "hidden";
        if (window.lenis) window.lenis.stop();
        modal.classList.add("active");

        // Fetch full data
        const data = await fetchEventData(uuid);
        if (data && currentEventUuid === uuid) {
            if (titleEl) titleEl.textContent = data.name;
            if (dateEl) dateEl.textContent = data.date;
            if (locationEl) locationEl.textContent = data.location;
            if (typeBadge) typeBadge.textContent = data.type;
            if (descEl) descEl.innerHTML = data.description ? `<p>${data.description}</p>` : "<p>No description available.</p>";

            // New Fields (Full Data Update)
            if (timeEl) {
                const startTime = data.start_time ? data.start_time.substring(0, 5) : "";
                const endTime = data.end_time ? data.end_time.substring(0, 5) : "";
                timeEl.textContent = startTime && endTime ? `${startTime} - ${endTime}` : "All Day";
            }
            if (highlightEl) highlightEl.textContent = data.highlights || "-";
            if (monthYearEl && data.start_date) {
                const dateObj = new Date(data.start_date);
                const formatter = new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' });
                monthYearEl.textContent = formatter.format(dateObj).toUpperCase();
            }

            renderCarousel(data.images, data.name);
        }

        // Swipe hint logic
        if (swipeHint) {
            if (eventImages.length > 1) {
                swipeHint.classList.remove("hidden");
                setTimeout(() => swipeHint.classList.add("hidden"), 3000);
            } else {
                swipeHint.classList.add("hidden");
            }
        }
    }

    function closeEventModal() {
        modal.classList.remove("active");
        document.body.style.overflow = "";
        if (window.lenis) window.lenis.start();
        currentEventUuid = null;
    }

    document.addEventListener("click", (e) => {
        const card = e.target.closest(".event-modal-trigger");
        if (card) {
            e.preventDefault();
            openEventModal(card);
        }
    });

    if (closeBtn) closeBtn.addEventListener("click", closeEventModal);
    if (overlay) overlay.addEventListener("click", closeEventModal);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.classList.contains("active")) {
            closeEventModal();
        }
    });

    if (calendarBtn) {
        calendarBtn.addEventListener("click", () => {
            if (!titleEl) return;
            const title = titleEl.textContent;
            const location = locationEl ? locationEl.textContent : "Mal Bali Galeria";
            const details = descEl ? descEl.textContent.trim() : "";
            const rawDate = dateEl ? dateEl.textContent : "";

            // Basic date parsing (MBG usually uses DD MMM YYYY or similar)
            // If parsing fails, just use current time or simplified link
            const calendarUrl = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&details=${encodeURIComponent(details)}&location=${encodeURIComponent(location)}`;
            window.open(calendarUrl, "_blank");
        });
    }

    if (shareBtn) {
        shareBtn.addEventListener("click", () => {
            const url = currentEventUuid ? `${window.location.origin}/event/${currentEventUuid}` : window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: titleEl ? titleEl.textContent : "Event at MBG",
                    text: "Check out this event at Mal Bali Galeria!",
                    url: url
                }).catch(() => copyToClipboard(url));
            } else {
                copyToClipboard(url);
            }
        });
    }
})(); // Closing event modal scope
})(); // Closing pageLoader/global scope
