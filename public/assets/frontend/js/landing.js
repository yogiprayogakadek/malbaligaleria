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

darkModeToggle.addEventListener("click", function (e) {
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
    },
    {
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
            if (floor.includes("1st")) renderLandingTenants("1st Floor");
            else if (floor.includes("2nd")) renderLandingTenants("2nd Floor");
            else if (floor.includes("New Store"))
                renderLandingTenants("2nd Floor");
            else if (floor.includes("All Floor"))
                window.location.href = "/directory";
        }

        item.addEventListener("click", function () {
            // Remove active class
            floorItems.forEach((i) => i.classList.remove("active"));
            // Add active class
            this.classList.add("active");

            const floorText = this.querySelector("h4").textContent;
            let targetFloor = "1st Floor";

            // Simple Mapping for now based on Text if data-floor not set
            if (floorText.includes("1st") || floorText.includes("Level 1"))
                targetFloor = "1st Floor";
            else if (floorText.includes("2nd") || floorText.includes("Level 2"))
                targetFloor = "2nd Floor";
            else if (floorText.includes("New Store")) targetFloor = "New Store";
            else if (floorText.includes("All Floor"))
                window.location.href = "/directory";

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
const tenantNavPrev = document.getElementById("tenantNavPrev");
const tenantNavNext = document.getElementById("tenantNavNext");
const tenantGridForNav = document.getElementById("landingTenantGrid");

if (tenantNavPrev && tenantNavNext && tenantGridForNav) {
    // Scroll amount (one card width + gap)
    const getScrollAmount = () => {
        const card = tenantGridForNav.querySelector(".tenant-card");
        if (card) {
            return card.offsetWidth + 24; // card width + gap (1.5rem = 24px)
        }
        return 400; // fallback
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
let currentTenantData = null;

// Open modal function
function openTenantModal(tenantData) {
    currentTenantData = tenantData;

    // Populate modal with tenant data
    document.getElementById("modalTenantName").textContent = tenantData.name;
    document.getElementById("modalFloorBadge").textContent = tenantData.floor;
    document.getElementById("modalCategory").textContent = tenantData.category;
    document.getElementById("modalUnit").textContent =
        "Unit " + tenantData.unit;
    document.getElementById("modalHours").textContent = tenantData.hours;
    document.getElementById("modalFloor").textContent = tenantData.floor;

    // Set logo
    document.getElementById(
        "modalLogo"
    ).innerHTML = `<img src="${tenantData.logo}" alt="${tenantData.name}">`;

    // Set description (if available)
    const description =
        tenantData.description ||
        "Discover amazing products and services at this store. Visit us today for an unforgettable shopping experience!";
    document.getElementById(
        "modalDescription"
    ).innerHTML = `<p>${description}</p>`;

    // Setup carousel images
    // For now, we'll use the logo as the main image and create placeholder images
    // In production, you should have actual tenant photos from the database
    modalImages = [
        tenantData.logo,
        tenantData.logo, // You can replace these with actual tenant photos
        tenantData.logo,
    ];

    currentModalImageIndex = 0;
    renderModalCarousel();

    // Show modal with animation
    document.body.style.overflow = "hidden";
    tenantModal.classList.add("active");

    // Show swipe hint and auto-hide after 3 seconds
    const swipeHint = document.getElementById("carouselSwipeHint");
    if (swipeHint) {
        swipeHint.classList.remove("hidden");
        setTimeout(() => {
            swipeHint.classList.add("hidden");
        }, 3000);
    }
}

// Close modal function
function closeTenantModal() {
    tenantModal.classList.remove("active");
    document.body.style.overflow = "";

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
    modalCarouselImages.innerHTML = modalImages
        .map(
            (img, index) => `
                <div class="carousel-image">
                    <img src="${img}" alt="${currentTenantData.name} - Image ${
                index + 1
            }">
                </div>
            `
        )
        .join("");

    // Render indicators
    modalCarouselIndicators.innerHTML = modalImages
        .map(
            (_, index) => `
                <div class="carousel-indicator ${
                    index === currentModalImageIndex ? "active" : ""
                }" data-index="${index}"></div>
            `
        )
        .join("");

    // Update carousel position
    updateModalCarousel();

    // Add click events to indicators
    document.querySelectorAll(".carousel-indicator").forEach((indicator) => {
        indicator.addEventListener("click", () => {
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
    document
        .querySelectorAll(".carousel-indicator")
        .forEach((indicator, index) => {
            if (index === currentModalImageIndex) {
                indicator.classList.add("active");
            } else {
                indicator.classList.remove("active");
            }
        });
}

// Carousel navigation
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

// Add touch/swipe support for carousel
let touchStartX = 0;
let touchEndX = 0;
let touchStartY = 0;
let touchEndY = 0;

function handleSwipeGesture() {
    const swipeThreshold = 50; // minimum distance for swipe
    const horizontalSwipe = Math.abs(touchEndX - touchStartX);
    const verticalSwipe = Math.abs(touchEndY - touchStartY);

    // Only process if horizontal swipe is greater than vertical (to avoid conflict with scroll)
    if (horizontalSwipe > verticalSwipe && horizontalSwipe > swipeThreshold) {
        if (touchEndX < touchStartX) {
            // Swipe left - next image
            currentModalImageIndex =
                (currentModalImageIndex + 1) % modalImages.length;
            updateModalCarousel();
        } else if (touchEndX > touchStartX) {
            // Swipe right - previous image
            currentModalImageIndex =
                (currentModalImageIndex - 1 + modalImages.length) %
                modalImages.length;
            updateModalCarousel();
        }
    }
}

if (modalCarouselImages) {
    // Touch events for mobile
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

    // Mouse events for desktop (drag to swipe)
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

    // Set initial cursor
    modalCarouselImages.style.cursor = "grab";
}

// Close modal events
if (modalClose) {
    modalClose.addEventListener("click", closeTenantModal);
}

if (modalOverlay) {
    modalOverlay.addEventListener("click", closeTenantModal);
}

// Close on ESC key
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && tenantModal.classList.contains("active")) {
        closeTenantModal();
    }
});

// Attach click event to dynamically created see-details buttons
document.addEventListener("click", (e) => {
    if (
        e.target.classList.contains("see-details-btn") ||
        e.target.closest(".see-details-btn")
    ) {
        const button = e.target.classList.contains("see-details-btn")
            ? e.target
            : e.target.closest(".see-details-btn");
        const tenantCard = button.closest(".tenant-card");

        if (tenantCard) {
            // Extract tenant data from the card
            const tenantData = {
                name: tenantCard.querySelector("h3")?.textContent || "",
                floor:
                    tenantCard.querySelector(".floor-badge")?.textContent || "",
                category:
                    tenantCard
                        .querySelector(".tenant-category")
                        ?.textContent?.trim() || "",
                unit:
                    tenantCard
                        .querySelector(".meta-item span")
                        ?.textContent?.replace("Unit ", "") || "",
                hours:
                    tenantCard.querySelectorAll(".meta-item span")[1]
                        ?.textContent || "",
                logo: tenantCard.querySelector(".tenant-logo img")?.src || "",
                description: tenantCard.dataset.description || "",
            };

            openTenantModal(tenantData);
        }
    }
});
