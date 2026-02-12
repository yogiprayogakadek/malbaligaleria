
const pageLoader = document.getElementById("pageLoader");


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
const heroBg = document.querySelector(".hero-bg");

window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset;

    if (hero && heroBg && scrolled < hero.offsetHeight) {

        const parallaxSpeed = 0.5;
        heroBg.style.transform = `translateY(${
            scrolled * parallaxSpeed
        }px) scale(1.1)`;


        const heroContent = document.querySelector(".hero-content");
        const opacity = 1 - scrolled / (hero.offsetHeight * 0.7);
        const translateY = scrolled * 0.3;

        if (heroContent) {
            heroContent.style.opacity = Math.max(0, opacity);
            heroContent.style.transform = `translateY(${translateY}px)`;
        }


        const scale = 1.1 + scrolled * 0.0001;
        heroBg.style.transform = `translateY(${
            scrolled * parallaxSpeed
        }px) scale(${Math.min(scale, 1.3)})`;
    }
});


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


let cards = [];
if (carouselContainer) {
    cards = carouselContainer.querySelectorAll(".tenant-card");
}


if (cards.length === 0) {
    cards = document.querySelectorAll(".tenant-card");
}

const originalCardsCount = cards.length;

let currentIndex = 0;
let cardsPerView = 4;
let isTransitioning = false;


if (originalCardsCount > 0 && carouselContainer) {
    const clonesNeeded = 4;
    for (let i = 0; i < clonesNeeded; i++) {

        const cardToClone = cards[i % originalCardsCount];
        if (cardToClone) {
            const clone = cardToClone.cloneNode(true);
            clone.classList.add("clone");
            carouselContainer.appendChild(clone);
        }
    }


    if (
        carouselContainer.querySelectorAll(".tenant-card").length >
        originalCardsCount
    ) {
        cards = carouselContainer.querySelectorAll(".tenant-card");
    } else {
        cards = document.querySelectorAll(".tenant-card");
    }
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


    if (typeof startAutoplay === "function") startAutoplay();
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

    // Buttons always enabled for infinite loop if content exists
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
    // Allow clicking into clone territory
    if (originalCardsCount > 0) {
        currentIndex++;
        updateCarousel();
    }
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


if (carouselContainer) {
    carouselContainer.addEventListener("mouseenter", () => {
        if (autoplayInterval) clearInterval(autoplayInterval);
    });

    carouselContainer.addEventListener("mouseleave", () => {
        startAutoplay();
    });
}


startAutoplay();


window.addEventListener("resize", () => {
    updateCardsPerView();
});


updateCardsPerView();


const eventGrid = document.getElementById("eventGrid");
const eventPrevBtn = document.getElementById("eventPrevBtn");
const eventNextBtn = document.getElementById("eventNextBtn");
const eventControls = document.getElementById("eventControls");
const eventCards = document.querySelectorAll(".event-card");

let eventCurrentIndex = 0;
let eventCardsPerView = 2;


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


    if (eventPrevBtn && eventNextBtn) {
        eventPrevBtn.disabled = eventCurrentIndex === 0;
        eventNextBtn.disabled =
            eventCurrentIndex >= eventCards.length - eventCardsPerView;
    }
};

const updateEventControlsVisibility = () => {
    if (!eventControls) return;


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


    window.addEventListener("resize", () => {
        updateEventCardsPerView();
    });


    updateEventCardsPerView();
}


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
        const data = await $.get("/tenants/" + floor + '/' + isNew);
        return data;
    } catch (error) {
        console.error("Failed to load data", error);
        return [];
    }
}

async function renderLandingTenants(floor, isNew = false, searchQuery = "") {
    // Try to get from cache first for performance
    let tenantData = [];
    if (!isNew && allTenantsCache.loaded && allTenantsCache[floor]) {
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
                            See Details
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
                description: "Memuat informasi tenant...",
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

    // Show modal
    document.body.style.overflow = "hidden";
    tenantModal.classList.add("active");

    // Action button listeners
    const modalFavBtn = document.getElementById("modalFavoriteBtn");
    if (modalFavBtn) {
        modalFavBtn.classList.remove("active");
        const newFavBtn = modalFavBtn.cloneNode(true);
        modalFavBtn.parentNode.replaceChild(newFavBtn, modalFavBtn);
        newFavBtn.addEventListener("click", () => {
            newFavBtn.classList.toggle("active");
            showToast(newFavBtn.classList.contains("active") ? "Added to favorites" : "Removed from favorites", "success");
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
        swipeHint.classList.remove("hidden");
        setTimeout(() => {
            swipeHint.classList.add("hidden");
        }, 3000);
    }
}


function closeTenantModal() {
    if (tenantModal) tenantModal.classList.remove("active");
    document.body.style.overflow = "";


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
        visualMapImage.src = `/assets/images/floors/${floorImg}`;
        
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
    const floorMapImg = document.getElementById("modalFloorMap");
    const markerLogo = document.getElementById("modalMapMarkerLogo");
    const logoImg = document.getElementById("markerLogoImg");

    // if (!floorMapImg || !markerLogo || !logoImg) return;

    // Check if coordinates exist
    if (data.x && data.y && data.map_original_size) {
        const floorId = data.floor_id || (data.map_coords ? data.map_coords.floor : null);
        const floorImg = floorId == 2 ? "2nd_floor.png" : "1st_floor.png";
        
        floorMapImg.src = `/assets/images/floors/${floorImg}`;
        
        // Set logo
        logoImg.src = data.logo;
        
        // Calculate percentage positions using the most accurate dimensions available
        // We prefer data.map_original_size if provided by backend, 
        // fallback to naturalWidth if the image is already loaded
        const mapWidth = data.map_original_size?.width || floorMapImg.naturalWidth || 1400;
        const mapHeight = data.map_original_size?.height || floorMapImg.naturalHeight || 1000;

        const xPos = (data.x / mapWidth) * 100;
        const yPos = (data.y / mapHeight) * 100;
        
        markerLogo.style.left = `${xPos}%`;
        markerLogo.style.top = `${yPos}%`;
        markerLogo.style.display = "block";
    } else {
        markerLogo.style.display = "none";
    }
}
