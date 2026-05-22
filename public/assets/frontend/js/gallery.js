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
        const grid = document.querySelector(".gallery-grid");
        const enableZoom = grid ? grid.getAttribute("data-enable-zoom") !== "0" : true;
        const activeItems = document.querySelectorAll(".gallery-item:not(.gallery-hidden)");
        activeItems.forEach((item, index) => {
            const img = item.querySelector("img");
            const title = item.getAttribute("data-title") || "";
            const path = item.getAttribute("data-path") || img.src;
            photos.push({ path, title });

            // Handle image load state for shimmer removal
            if (img) {
                if (img.complete) {
                    item.classList.add("img-loaded");
                } else {
                    img.addEventListener("load", () => {
                        item.classList.add("img-loaded");
                    });
                }
            }

            // Remove existing listener if any to prevent duplicates
            if (item._clickhandler) {
                item.removeEventListener("click", item._clickhandler);
            }

            const handler = (e) => {
                if (e.target.closest('.btn-download')) {
                    return;
                }
                if (enableZoom) {
                    openLightbox(index);
                }
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
            const limit = parseInt(btnLoadMore.getAttribute("data-increment")) || 4;
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

    // Touch/Swipe Gestures for Lightbox
    let touchStartX = 0;
    let touchEndX = 0;

    if (lightboxModal) {
        lightboxModal.addEventListener("touchstart", (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightboxModal.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        const threshold = 50;
        if (touchEndX < touchStartX - threshold) {
            showNext();
        } else if (touchEndX > touchStartX + threshold) {
            showPrev();
        }
    }

    // Share Button Event Listener
    const btnShare = document.getElementById("lightboxShare");
    if (btnShare) {
        btnShare.addEventListener("click", async () => {
            const photo = photos[currentIndex];
            if (!photo) return;

            const shareData = {
                title: photo.title || 'Gallery Photo - Mal Bali Galeria',
                text: 'Check out this photo from Mal Bali Galeria!',
                url: photo.path
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    // Fallback: Copy path to clipboard
                    await navigator.clipboard.writeText(photo.path);

                    // Show temporary checkmark success state
                    const originalHTML = btnShare.innerHTML;
                    btnShare.innerHTML = `
                        <svg viewBox="0 0 24 24" fill="none" stroke="#2ac5b5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    `;
                    btnShare.style.borderColor = "#2ac5b5";

                    setTimeout(() => {
                        btnShare.innerHTML = originalHTML;
                        btnShare.style.borderColor = "";
                    }, 2000);
                }
            } catch (err) {
                console.error("Error sharing or copying path: ", err);
            }
        });
    }

    // Initialize Global UI Elements
    initLoader();
    initSidebar();
    initDarkMode();

})();
