/**
 * New Store Page - Dedicated JavaScript
 * Handles global UI (Loader, Sidebar, Dark Mode) and tenant modal
 */

(function() {
    'use strict';

    // Global UI Elements
    const pageLoader = document.getElementById("pageLoader");
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarClose = document.getElementById("sidebarClose");
    const darkModeToggle = document.getElementById("darkModeToggle");

    // State for Modal
    let tenantData = null;
    let tenantCache = {};
    let modalImages = [];
    let currentModalImageIndex = 0;

    // Elements for Modal
    const tenantModal = document.getElementById("tenantModal");
    const modalOverlay = document.getElementById("modalOverlay");
    const modalCarouselImages = document.getElementById("modalCarouselImages");
    const modalCarouselIndicators = document.getElementById("modalCarouselIndicators");
    const modalCarouselPrev = document.getElementById("modalCarouselPrev");
    const modalCarouselNext = document.getElementById("modalCarouselNext");

    // --- GLOBAL UI LOGIC ---

    /**
     * Page Loader Logic
     */
    function initLoader() {
        if (!pageLoader) return;
        
        const minLoadTime = 2500; // Slightly faster than landing for efficiency
        const loadStartTime = Date.now();

        window.addEventListener("load", () => {
            const loadTime = Date.now() - loadStartTime;
            const remainingTime = Math.max(0, minLoadTime - loadTime);

            setTimeout(() => {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");
                setTimeout(() => {
                    pageLoader.style.display = "none";
                }, 500);
            }, remainingTime);
        });

        // Fail-safe
        setTimeout(() => {
            if (!document.body.classList.contains("loaded") && pageLoader) {
                pageLoader.classList.add("hidden");
                document.body.classList.add("loaded");
                setTimeout(() => {
                    pageLoader.style.display = "none";
                }, 500);
            }
        }, 5000);
    }

    /**
     * Sidebar / Menu Logic
     */
    function initSidebar() {
        if (!menuBtn || !sidebar || !sidebarClose) return;

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

        sidebar.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                menuBtn.classList.remove("active");
                sidebar.classList.remove("active");
                document.body.classList.remove("menu-open");
            });
        });
    }

    /**
     * Dark Mode Logic
     */
    function initDarkMode() {
        if (!darkModeToggle) return;

        // Apply saved state
        if (localStorage.getItem("darkMode") === "enabled") {
            document.body.classList.add("dark-mode");
        }

        darkModeToggle.addEventListener("click", (e) => {
            e.preventDefault();
            document.body.classList.toggle("dark-mode");
            
            if (document.body.classList.contains("dark-mode")) {
                localStorage.setItem("darkMode", "enabled");
            } else {
                localStorage.setItem("darkMode", "disabled");
            }
        });
    }

    // --- MODAL LOGIC ---

    /**
     * Fetch tenant data by ID
     */
    async function getDataByTenantId(tenant_id) {
        try {
            return await $.get("/find/tenants/" + tenant_id);
        } catch (error) {
            console.error("Failed to load tenant data", error);
            return null;
        }
    }

    /**
     * Open the tenant detail modal
     */
    async function openTenantModal(tenant_id) {
        if (!tenantModal) return;

        // Check cache first
        let cachedData = tenantCache[tenant_id];

        if (cachedData) {
            tenantData = cachedData;
            updateModalContent(tenantData);
        } else {
            // Fallback to basic info from the card while loading
            const gridCard = document.querySelector(`.see-details-btn[data-id="${tenant_id}"]`)?.closest('.tenant-card');
            if (gridCard) {
                const gridLogo = gridCard.querySelector('.tenant-logo img')?.src;
                const fallbackData = {
                    name: gridCard.querySelector('h3')?.textContent || "Loading...",
                    logo: gridLogo,
                    floor: gridCard.querySelector('.floor-badge')?.textContent || "-",
                    category: gridCard.querySelector('.tenant-category')?.textContent?.trim() || "-",
                    unit: gridCard.querySelector('.meta-item:first-child span')?.textContent?.replace('Unit ', '') || "",
                    hours: "10:00 AM - 10:00 PM",
                    description: "Loading content...",
                    images: gridLogo ? [gridLogo] : [],
                    has_album: false
                };
                updateModalContent(fallbackData);
            }

            // Show loading indicator
            const loadingIndicator = document.getElementById("modalCarouselLoading");
            if (loadingIndicator) loadingIndicator.classList.add("active");

            // Fetch full data
            const fullData = await getDataByTenantId(tenant_id);
            if (fullData) {
                tenantData = fullData;
                tenantCache[tenant_id] = tenantData;
                updateModalContent(tenantData);
            }

            if (loadingIndicator) loadingIndicator.classList.remove("active");
        }
    }

    /**
     * Update modal UI with tenant data
     */
    function updateModalContent(data) {
        if (!data) return;

        // Basic Info
        const elements = {
            "modalTenantName": data.name,
            "modalFloorBadge": data.floor,
            "modalCategoryText": data.category,
            "modalLocation": data.floor,
            "modalMapFloorBadge": data.floor,
            "modalHours": data.hours || "10:00 AM - 10:00 PM"
        };

        for (const [id, value] of Object.entries(elements)) {
            const el = document.getElementById(id);
            if (el) el.textContent = value;
        }

        const descEl = document.getElementById("modalDescription");
        if (descEl) {
            descEl.innerHTML = `<p>${data.description || "Discover amazing products and services at this store. Visit us today for an unforgettable shopping experience!"}</p>`;
        }

        // Logo
        const modalLogo = document.getElementById("modalLogo");
        if (modalLogo) {
            if (data.has_album || data.logo) {
                modalLogo.innerHTML = `<img src="${data.logo}" alt="${data.name}">`;
                modalLogo.style.display = 'flex';
            } else {
                modalLogo.style.display = 'none';
            }
        }

        // Carousel
        modalImages = data.images && data.images.length > 0 ? data.images : [data.logo];
        currentModalImageIndex = 0;
        renderModalCarousel(data.name);

        // Reset Views
        const infoView = document.getElementById("modalInfoView");
        const mapView = document.getElementById("modalMapView");
        if (infoView) infoView.style.display = "block";
        if (mapView) mapView.style.display = "none";
        tenantModal.classList.remove("map-active-mobile");

        // Show Modal
        document.body.style.overflow = "hidden";
        tenantModal.classList.add("active");

        // Favorites & Share
        setupActionButtons(data);

        // Swipe Hint
        const swipeHint = document.getElementById("carouselSwipeHint");
        if (swipeHint) {
            if (modalImages.length > 1) {
                swipeHint.classList.remove("hidden");
                // Auto hide after 3 seconds
                setTimeout(() => swipeHint.classList.add("hidden"), 3000);
            } else {
                swipeHint.classList.add("hidden");
            }
        }
    }

    /**
     * Setup Favorite and Share buttons
     */
    function setupActionButtons(data) {
        const modalFavBtn = document.getElementById("modalFavoriteBtn");
        if (modalFavBtn) {
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
                const shareUrl = `${window.location.origin}${window.location.pathname}?id=${data.id}`;
                if (navigator.share) {
                    navigator.share({
                        title: data.name,
                        text: `Check out ${data.name} at Mal Bali Galeria!`,
                        url: shareUrl
                    }).catch(() => copyToClipboard(shareUrl));
                } else {
                    copyToClipboard(shareUrl);
                }
            });
        }
    }

    /**
     * Render Carousel Images and Indicators
     */
    function renderModalCarousel(tenantName) {
        if (!modalCarouselImages || !modalCarouselIndicators) return;

        modalCarouselImages.innerHTML = modalImages
            .map((img, index) => `
                <div class="carousel-image">
                    <img src="${img}" alt="${tenantName} - Image ${index + 1}">
                </div>
            `).join("");

        modalCarouselIndicators.innerHTML = modalImages
            .map((_, index) => `
                <div class="carousel-indicator ${index === 0 ? "active" : ""}" data-index="${index}"></div>
            `).join("");

        updateModalCarousel();

        // Indicator Clicks
        document.querySelectorAll(".carousel-indicator").forEach(indicator => {
            indicator.addEventListener("click", () => {
                currentModalImageIndex = parseInt(indicator.dataset.index);
                updateModalCarousel();
            });
        });
    }

    /**
     * Update Carousel Position
     */
    function updateModalCarousel() {
        if (!modalCarouselImages) return;
        const offset = -currentModalImageIndex * 100;
        modalCarouselImages.style.transform = `translateX(${offset}%)`;

        document.querySelectorAll(".carousel-indicator").forEach((indicator, index) => {
            indicator.classList.toggle("active", index === currentModalImageIndex);
        });
    }

    /**
     * Close Modal
     */
    function closeTenantModal() {
        if (tenantModal) tenantModal.classList.remove("active");
        document.body.style.overflow = "";
    }

    /**
     * Clipboard Helper
     */
    function copyToClipboard(text) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        showToast("Link copied to clipboard!", "success");
    }

    /**
     * Toast System
     */
    function showToast(message, type = "info") {
        const toast = document.createElement("div");
        toast.className = `toast-notification ${type}`;
        const icon = type === "success" 
            ? '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>'
            : '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';

        toast.innerHTML = `${icon}<span>${message}</span>`;
        document.body.appendChild(toast);
        
        requestAnimationFrame(() => toast.classList.add("active"));
        setTimeout(() => {
            toast.classList.remove("active");
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    /**
     * Map Pinpoint
     */
    function renderModalMap(data) {
        if (!data) return;
        
        const floorMapImg = document.getElementById("modalFloorMap");
        const markerLogo = document.getElementById("modalMapMarkerLogo");
        const logoImg = document.getElementById("markerLogoImg");

        // Try to get coordinates from flat or nested structure
        const coords = {
            x: data.x || data.map_coords?.x || 0,
            y: data.y || data.map_coords?.y || 0,
            floor: data.floor_id || data.map_coords?.floor || 1
        };

        if (coords.x && coords.y) {
            const floorId = coords.floor;
            const floorText = floorId == 2 ? "2nd Floor" : "1st Floor";
            
            // Update floor badge
            const floorBadge = document.getElementById("modalMapFloorBadge");
            if (floorBadge) floorBadge.textContent = floorText;
            
            // Set marker logo
            if (logoImg && data.logo) logoImg.src = data.logo;

            // Define positionMarker closure
            const positionMarker = () => {
                const mapWidth = data.map_original_size?.width || floorMapImg.naturalWidth || 1400;
                const mapHeight = data.map_original_size?.height || floorMapImg.naturalHeight || 1000;

                const xPos = (coords.x / mapWidth) * 100;
                const yPos = (coords.y / mapHeight) * 100;

                if (markerLogo) {
                    markerLogo.style.left = `${xPos}%`;
                    markerLogo.style.top = `${yPos}%`;
                    markerLogo.style.display = "block";
                }
            };

            // Always clear previous onload
            floorMapImg.onload = null;

            // Determine floor map source
            if (floorMapImg && window.FLOOR_MAPS) {
                const mapUrl = window.FLOOR_MAPS[floorId] || window.FLOOR_MAPS[1];
                floorMapImg.src = mapUrl;
            }

            // If image is already cached (complete), call positionMarker directly.
            if (floorMapImg.complete && floorMapImg.naturalWidth > 0) {
                positionMarker();
            } else {
                floorMapImg.onload = positionMarker;
            }
        } else {
            console.warn("Missing coordinates for tenant:", data.name, data);
            if (markerLogo) markerLogo.style.display = "none";
        }
    }

    /**
     * Scroll Reveal Logic
     */
    function initReveal() {
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
        // Initial check
        setTimeout(revealOnScroll, 500);
    }

    // Initialize Everything
    initLoader();
    initSidebar();
    initDarkMode();
    initReveal();

    // Event Listeners for Modal
    if (modalCarouselPrev) {
        modalCarouselPrev.addEventListener("click", () => {
            currentModalImageIndex = (currentModalImageIndex - 1 + modalImages.length) % modalImages.length;
            updateModalCarousel();
        });
    }

    if (modalCarouselNext) {
        modalCarouselNext.addEventListener("click", () => {
            currentModalImageIndex = (currentModalImageIndex + 1) % modalImages.length;
            updateModalCarousel();
        });
    }

    const modalCloseBtn = document.getElementById("modalCloseBtn");
    if (modalCloseBtn) modalCloseBtn.addEventListener("click", closeTenantModal);
    if (modalOverlay) modalOverlay.addEventListener("click", closeTenantModal);

    const showOnMapBtn = document.getElementById("showOnMapBtn");
    if (showOnMapBtn) {
        showOnMapBtn.addEventListener("click", () => {
            if (tenantData) {
                renderModalMap(tenantData);
                document.getElementById("modalInfoView").style.display = "none";
                document.getElementById("modalMapView").style.display = "block";
                tenantModal.classList.add("map-active-mobile");
            }
        });
    }

    const btnBackToInfo = document.getElementById("btnBackToInfo");
    if (btnBackToInfo) {
        btnBackToInfo.addEventListener("click", () => {
            document.getElementById("modalInfoView").style.display = "block";
            document.getElementById("modalMapView").style.display = "none";
            tenantModal.classList.remove("map-active-mobile");
        });
    }

    // Floor Switching in Modal
    document.querySelectorAll(".floor-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".floor-btn").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            
            const floorId = btn.dataset.floor;
            const floorMapImg = document.getElementById("modalFloorMap");
            if (floorMapImg && window.FLOOR_MAPS) {
                floorMapImg.src = window.FLOOR_MAPS[floorId];
            }
            
            // Re-render map to update pin visibility for current floor
            if (tenantData) {
                const markerLogo = document.getElementById("modalMapMarkerLogo");
                const tenantFloor = tenantData.floor_id || tenantData.map_coords?.floor || 1;
                if (markerLogo) {
                    markerLogo.style.display = (tenantFloor == floorId) ? "block" : "none";
                }
                
                const floorBadge = document.getElementById("modalMapFloorBadge");
                if (floorBadge) {
                    floorBadge.textContent = floorId == 2 ? "2nd Floor" : "1st Floor";
                }
            }
        });
    });

    // Delegate Click for Cards
    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".see-details-btn");
        if (btn && btn.dataset.id) {
            openTenantModal(btn.dataset.id);
        }
    });

    // ESC Key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeTenantModal();
    });

    // URL Param Check
    const urlParams = new URLSearchParams(window.location.search);
    const tenantId = urlParams.get("id");
    if (tenantId) {
        setTimeout(() => openTenantModal(tenantId), 1000);
    }

})();

// Visitor Counter Animation
(() => {
    const formatNumber = (num) => num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    const parseNumber = (str) => parseInt(str.replace(/,/g, '')) || 0;

    const animateCounter = (el) => {
        const end = parseNumber(el.getAttribute('data-target') || el.textContent);
        const duration = parseInt(el.getAttribute('data-duration')) || 2000;
        let start = 0;
        const increment = end / (duration / 16);

        const updateCount = () => {
            start += increment;
            if (start < end) {
                el.textContent = formatNumber(Math.floor(start));
                requestAnimationFrame(updateCount);
            } else {
                el.textContent = formatNumber(end);
            }
        };
        updateCount();
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.visitor-count').forEach(animateCounter);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    const footer = document.querySelector('footer');
    if (footer) observer.observe(footer);
})();
