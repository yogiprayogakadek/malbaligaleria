/**
 * Event Page Logic
 * Handles Carousel, Calendar Export, and Social Sharing
 */

document.addEventListener('DOMContentLoaded', () => {
    initCarousel();
    initCalendar();
    initShare();
});

/**
 * Enhanced Carousel Logic
 */
function initCarousel() {
    const track = document.getElementById('carouselImages');
    const prevBtn = document.getElementById('carouselPrev');
    const nextBtn = document.getElementById('carouselNext');
    const dots = document.querySelectorAll('.carousel-dot');
    
    if (!track || !prevBtn || !nextBtn) return;

    const slides = track.children;
    const totalSlides = slides.length;
    let currentSlide = 0;
    let autoplayTimer;

    function updateSlide(index) {
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        currentSlide = index;
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    function nextSlide() {
        updateSlide(currentSlide + 1);
    }

    function startAutoplay() {
        if (autoplayTimer) clearInterval(autoplayTimer);
        autoplayTimer = setInterval(nextSlide, 5000);
    }

    function pauseAutoplay() {
        if (autoplayTimer) clearInterval(autoplayTimer);
    }

    // Event Listeners
    prevBtn.addEventListener('click', () => {
        updateSlide(currentSlide - 1);
        startAutoplay(); // Reset timer
    });

    nextBtn.addEventListener('click', () => {
        updateSlide(currentSlide + 1);
        startAutoplay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            updateSlide(index);
            startAutoplay();
        });
    });

    // Pause on hover
    const section = document.querySelector('.carousel-section');
    if (section) {
        section.addEventListener('mouseenter', pauseAutoplay);
        section.addEventListener('mouseleave', startAutoplay);
    }

    // Init
    startAutoplay();
}

/**
 * Add to Calendar Functionality
 * Generates an .ics file for download
 */
function initCalendar() {
    const addToCalendarBtn = document.querySelector('.action-btn.primary');
    
    if (!addToCalendarBtn) return;

    addToCalendarBtn.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Extract data from DOM (Assuming static structure for now)
        const title = document.querySelector('.tenant-info h1')?.innerText || 'Event at Mal Bali Galeria';
        const description = document.querySelector('.tenant-description')?.innerText || '';
        const location = "Mal Bali Galeria, Jl. Sunset Road No. 89, Kuta";
        
        // Hardcoded dates for demo purposes (matching the static HTML: 14-28 Dec 2025)
        // In a real app, these would come from data attributes
        const startDate = '20251214T100000';
        const endDate = '20251228T220000';

        const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
URL:${window.location.href}
DTSTART:${startDate}
DTEND:${endDate}
SUMMARY:${title}
DESCRIPTION:${description.replace(/\n/g, '\\n')}
LOCATION:${location}
END:VEVENT
END:VCALENDAR`;

        const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', 'event-details.ics');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
}

/**
 * Share Event Functionality
 * Uses Web Share API or Clipboard Fallback
 */
function initShare() {
    const shareBtn = document.querySelector('.action-btn.secondary');
    
    if (!shareBtn) return;

    shareBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        
        const shareData = {
            title: document.querySelector('.tenant-info h1')?.innerText || 'Mal Bali Galeria Event',
            text: 'Check out this amazing event at Mal Bali Galeria!',
            url: window.location.href
        };

        try {
            if (navigator.share) {
                await navigator.share(shareData);
            } else {
                // Fallback: Copy to Clipboard
                await navigator.clipboard.writeText(window.location.href);
                
                // Show temporary feedback
                const originalText = shareBtn.innerHTML;
                shareBtn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Link Copied!
                `;
                
                setTimeout(() => {
                    shareBtn.innerHTML = originalText;
                }, 2000);
            }
        } catch (err) {
            console.error('Error sharing:', err);
        }
    });
}
