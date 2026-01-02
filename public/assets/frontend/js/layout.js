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
        if (pageLoader) {
            pageLoader.classList.add("hidden");
        }
        document.body.classList.add("loaded");

        // Remove from DOM after transition
        setTimeout(() => {
            if (pageLoader) {
                pageLoader.style.display = "none";
            }
        }, 500);
    }, remainingTime);
});

// Fallback: if load event doesn't fire within 5 seconds, hide loader anyway
setTimeout(() => {
    if (!document.body.classList.contains("loaded")) {
        if (pageLoader) {
            pageLoader.classList.add("hidden");
        }
        document.body.classList.add("loaded");
        setTimeout(() => {
            if (pageLoader) {
                pageLoader.style.display = "none";
            }
        }, 500);
    }
}, 5000);

// Menu toggle
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const sidebarClose = document.getElementById("sidebarClose");
const header = document.querySelector("header");

if (menuBtn && sidebar) {
    menuBtn.addEventListener("click", () => {
        menuBtn.classList.toggle("active");
        sidebar.classList.toggle("active");
        // Toggle body scroll
        document.body.classList.toggle("menu-open");
    });

    // Close sidebar with close button
    if (sidebarClose) {
        sidebarClose.addEventListener("click", () => {
            menuBtn.classList.remove("active");
            sidebar.classList.remove("active");
            document.body.classList.remove("menu-open");
        });
    }

    // Close sidebar when clicking on a link
    const sidebarLinks = sidebar.querySelectorAll("a");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", () => {
            menuBtn.classList.remove("active");
            sidebar.classList.remove("active");
            document.body.classList.remove("menu-open");
        });
    });
}

// Sticky Header - Always visible
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    // Add scrolled class for background
    if (header) {
        if (currentScroll > 100) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    }

    lastScroll = currentScroll;
});

// Dark Mode Toggle
const darkModeToggle = document.getElementById("darkModeToggle");

// Check for saved dark mode preference
if (localStorage.getItem("darkMode") === "enabled") {
    document.body.classList.add("dark-mode");
}

if (darkModeToggle) {
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
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        const href = this.getAttribute("href");
        if (href === "#") return;
        
        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            const headerHeight = header ? header.offsetHeight : 0;
            const targetPosition = target.offsetTop - headerHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: "smooth",
            });
        }
    });
});
