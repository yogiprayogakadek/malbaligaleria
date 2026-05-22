/**
 * Gallery Page - Dedicated JavaScript
 * Handles global UI (Loader, Sidebar, Dark Mode) and custom Lightbox
 */

(function() {
    'use strict';

    // Global UI Elements
    const pageLoader = document.getElementById("pageLoader");
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarClose = document.getElementById("sidebarClose");
    const darkModeToggle = document.getElementById("darkModeToggle");

    // --- GLOBAL UI LOGIC ---

    /**
     * Page Loader Logic
     */
    function initLoader() {
        if (!pageLoader) return;
        
        const minLoadTime = 1500;
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
        }, 4000);
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

    // --- LIGHTBOX LOGIC ---

    const lightboxModal = document.getElementById("lightboxModal");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxCaption = document.getElementById("lightboxCaption");
    const btnClose = document.getElementById("lightboxClose");
    const btnPrev = document.getElementById("lightboxPrev");
    const btnNext = document.getElementById("lightboxNext");
    let photos = [];
    let currentIndex = 0;

    function initGalleryItems() {
        photos = [];
        const activeItems = document.querySelectorAll(".gallery-item:not(.gallery-hidden)");
        activeItems.forEach((item, index) => {
            const img = item.querySelector("img");
            const title = item.getAttribute("data-title") || "";
            const path = item.getAttribute("data-path") || img.src;
            photos.push({ path, title });

            // Remove existing listener if any to prevent duplicates
            if (item._clickhandler) {
                item.removeEventListener("click", item._clickhandler);
            }

            const handler = (e) => {
                if (e.target.closest('.btn-download')) {
                    return;
                }
                openLightbox(index);
            };
            item._clickhandler = handler;
            item.addEventListener("click", handler);
        });
    }

    // Initialize visible gallery items
    initGalleryItems();

    // Load More Logic
    const btnLoadMore = document.getElementById("btnLoadMore");
    if (btnLoadMore) {
        btnLoadMore.addEventListener("click", () => {
            const hiddenItems = document.querySelectorAll(".gallery-item.gallery-hidden");
            const limit = 4;
            let revealedCount = 0;

            hiddenItems.forEach((item) => {
                if (revealedCount < limit) {
                    item.classList.remove("gallery-hidden", "d-none");
                    // Trigger scroll reveal animation smoothly
                    setTimeout(() => {
                        item.classList.add("active");
                    }, 50 * revealedCount);
                    revealedCount++;
                }
            });

            // Re-initialize the active items list and their lightbox bindings
            initGalleryItems();

            // Check if we still have hidden items left
            const remainingHidden = document.querySelectorAll(".gallery-item.gallery-hidden");
            if (remainingHidden.length === 0) {
                btnLoadMore.parentElement.style.display = "none";
            }
        });
    }

    function openLightbox(index) {
        if (!lightboxModal) return;
        currentIndex = index;
        updateLightboxContent();
        lightboxModal.classList.add("active");
        document.body.style.overflow = "hidden"; // disable body scroll
    }

    function closeLightbox() {
        if (!lightboxModal) return;
        lightboxModal.classList.remove("active");
        document.body.style.overflow = ""; // enable body scroll
        if (lightboxImage) {
            lightboxImage.classList.remove("loaded");
        }
    }

    function updateLightboxContent() {
        if (!lightboxImage || photos.length === 0) return;

        const photo = photos[currentIndex];

        // Trigger transition out
        lightboxImage.classList.remove("loaded");

        // Wait brief delay for opacity transition to finish, then swap src
        setTimeout(() => {
            lightboxImage.src = photo.path;
            if (lightboxCaption) {
                lightboxCaption.textContent = photo.title || "Gallery Photo";
            }

            const lightboxDownload = document.getElementById("lightboxDownload");
            if (lightboxDownload) {
                lightboxDownload.href = photo.path;
                lightboxDownload.setAttribute("download", photo.title || "download");
            }

            lightboxImage.onload = () => {
                lightboxImage.classList.add("loaded");
            };
        }, 150);
    }

    function showNext() {
        if (photos.length <= 1) return;
        currentIndex = (currentIndex + 1) % photos.length;
        updateLightboxContent();
    }

    function showPrev() {
        if (photos.length <= 1) return;
        currentIndex = (currentIndex - 1 + photos.length) % photos.length;
        updateLightboxContent();
    }

    // Event Listeners
    if (btnClose) btnClose.addEventListener("click", closeLightbox);
    if (btnNext) btnNext.addEventListener("click", showNext);
    if (btnPrev) btnPrev.addEventListener("click", showPrev);

    if (lightboxModal) {
        lightboxModal.addEventListener("click", (e) => {
            // Close only if click is directly on modal wrapper or overlay, not on buttons/image
            if (e.target === lightboxModal || e.target.classList.contains("lightbox-content-wrapper") || e.target.classList.contains("lightbox-image-container")) {
                closeLightbox();
            }
        });
    }

    // Keyboard controls
    document.addEventListener("keydown", (e) => {
        if (!lightboxModal || !lightboxModal.classList.contains("active")) return;

        if (e.key === "Escape") {
            closeLightbox();
        } else if (e.key === "ArrowRight") {
            showNext();
        } else if (e.key === "ArrowLeft") {
            showPrev();
        }
    });

    // Initialize Global UI Elements
    initLoader();
    initSidebar();
    initDarkMode();

})();
