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

// ===== GLASS PHOTO CAROUSEL (GPC) =====
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.glass-photo-slide');
    const dots   = document.querySelectorAll('.gpc-dot');
    const prevBtn = document.getElementById('gpcPrev');
    const nextBtn = document.getElementById('gpcNext');

    if (!slides.length) return;

    let current = 0;
    let autoTimer;

    function goTo(index) {
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        if (dots[current]) dots[current].classList.add('active');
    }

    function startAuto() {
        if (slides.length <= 1) return;
        autoTimer = setInterval(() => goTo(current + 1), 4000);
    }

    function stopAuto() { clearInterval(autoTimer); }

    if (prevBtn) prevBtn.addEventListener('click', () => { stopAuto(); goTo(current - 1); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { stopAuto(); goTo(current + 1); startAuto(); });

    dots.forEach((dot, i) => dot.addEventListener('click', () => { stopAuto(); goTo(i); startAuto(); }));

    // Touch / swipe support
    const carousel = document.getElementById('glassPhotoCarousel');
    if (carousel) {
        let startX = 0;
        carousel.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
        carousel.addEventListener('touchend', e => {
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) { stopAuto(); goTo(diff > 0 ? current + 1 : current - 1); startAuto(); }
        });
    }

    startAuto();
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

// ========================================
// SIMILAR EVENTS SLIDER (event-card style)
// ========================================
(function initSimilarEventSlider() {
    const grid = document.getElementById("similarEventGrid");
    const prevBtn = document.getElementById("similarEventPrevBtn");
    const nextBtn = document.getElementById("similarEventNextBtn");
    const controls = document.getElementById("similarEventControls");
    if (!grid || !prevBtn || !nextBtn) return;

    const cards = grid.querySelectorAll(".event-card");
    let currentIndex = 0;
    let cardsPerView = window.innerWidth <= 768 ? 1 : 3;

    const update = () => {
        if (!cards.length) return;
        const cardWidth = cards[0].offsetWidth;
        const gap = 30;
        grid.style.transform = `translateX(${-(currentIndex * (cardWidth + gap))}px)`;
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= cards.length - cardsPerView;
        if (controls) {
            controls.classList.toggle("hidden", cards.length <= cardsPerView);
        }
    };

    const onResize = () => {
        cardsPerView = window.innerWidth <= 768 ? 1 : 3;
        currentIndex = 0;
        update();
    };

    prevBtn.addEventListener("click", () => { if (currentIndex > 0) { currentIndex--; update(); } });
    nextBtn.addEventListener("click", () => { if (currentIndex < cards.length - cardsPerView) { currentIndex++; update(); } });

    window.addEventListener("resize", onResize);
    update();
})();

// ===== ADD TO CALENDAR FUNCTIONALITY =====
const addToCalendarBtn = document.getElementById('addToCalendarBtn');

if (addToCalendarBtn) {
    addToCalendarBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const eventName = this.dataset.eventName;
        const eventDescription = this.dataset.eventDescription;
        const eventLocation = this.dataset.eventLocation;
        const eventStart = this.dataset.eventStart;
        const eventEnd = this.dataset.eventEnd;
        
        // Generate .ics file content
        const icsContent = generateICS(eventName, eventDescription, eventLocation, eventStart, eventEnd);
        
        // Create download link
        const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = `${eventName.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.ics`;
        
        // Trigger download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Show success message (optional)
        showNotification('Event added to calendar!', 'success');
    });
}

function generateICS(name, description, location, startDateTime, endDateTime) {
    // Parse date and time
    const start = new Date(startDateTime);
    const end = new Date(endDateTime);
    
    // Format dates for ICS (YYYYMMDDTHHMMSS)
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        return `${year}${month}${day}T${hours}${minutes}${seconds}`;
    };
    
    const startFormatted = formatDate(start);
    const endFormatted = formatDate(end);
    const now = formatDate(new Date());
    
    // Clean description (remove line breaks and special characters)
    const cleanDescription = description.replace(/\n/g, '\\n').replace(/,/g, '\\,');
    
    // Generate ICS content
    const ics = `BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Mal Bali Galeria//Event Calendar//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
UID:${now}@malbaligaleria.com
DTSTAMP:${now}
DTSTART:${startFormatted}
DTEND:${endFormatted}
SUMMARY:${name}
DESCRIPTION:${cleanDescription}
LOCATION:${location}
STATUS:CONFIRMED
SEQUENCE:0
BEGIN:VALARM
TRIGGER:-PT1H
DESCRIPTION:Reminder
ACTION:DISPLAY
END:VALARM
END:VEVENT
END:VCALENDAR`;
    
    return ics;
}

// ===== SHARE EVENT FUNCTIONALITY =====
const shareEventBtn = document.getElementById('shareEventBtn');

if (shareEventBtn) {
    shareEventBtn.addEventListener('click', async function(e) {
        e.preventDefault();
        
        const eventName = this.dataset.eventName;
        const eventUrl = this.dataset.eventUrl;
        const shareText = `Check out this event: ${eventName}`;
        
        // Check if Web Share API is supported
        if (navigator.share) {
            try {
                await navigator.share({
                    title: eventName,
                    text: shareText,
                    url: eventUrl
                });
                showNotification('Event shared successfully!', 'success');
            } catch (error) {
                if (error.name !== 'AbortError') {
                    console.error('Error sharing:', error);
                    fallbackShare(eventUrl);
                }
            }
        } else {
            // Fallback: Copy to clipboard
            fallbackShare(eventUrl);
        }
    });
}

function fallbackShare(url) {
    // Copy URL to clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(() => {
            showNotification('Link copied to clipboard!', 'success');
        }).catch(() => {
            // Fallback for older browsers
            copyToClipboardFallback(url);
        });
    } else {
        copyToClipboardFallback(url);
    }
}

function copyToClipboardFallback(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showNotification('Link copied to clipboard!', 'success');
    } catch (err) {
        console.error('Failed to copy:', err);
        showNotification('Failed to copy link', 'error');
    }
    
    document.body.removeChild(textArea);
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    // Remove existing notification if any
    const existingNotification = document.querySelector('.event-notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `event-notification event-notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                ${type === 'success' ? '<polyline points="20 6 9 17 4 12"></polyline>' : '<circle cx="12" cy="12" r="10"></circle>'}
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Trigger animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
