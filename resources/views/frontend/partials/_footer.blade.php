{{-- Footer Component --}}
<footer id="contact">
    <div class="footer-container">
        <div class="footer-content">
            {{-- About Column --}}
            <div class="footer-column footer-about">
                <h3>Mal Bali Galeria</h3>
                <p>Your premier shopping destination in Bali, offering luxury brands, dining, and entertainment
                    experiences in a modern and comfortable environment.</p>
                <div class="footer-social">
                    <a href="#" class="footer-social-link" aria-label="Instagram">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                                fill="none" stroke="white" stroke-width="2" />
                            <circle cx="12" cy="12" r="4" fill="none" stroke="white"
                                stroke-width="2" />
                            <circle cx="18" cy="6" r="1" fill="white" />
                        </svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Facebook">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                        </svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Twitter">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                        </svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="TikTok">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}#about">About Us</a></li>
                    <li><a href="{{ route('frontend.directory.index') }}">Store Directory</a></li>
                    <li><a href="{{ url('/') }}#experience">Experiences</a></li>
                    <li><a href="{{ url('/') }}#events">Events</a></li>
                    <li><a href="#career">Careers</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="footer-column">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="#valet">Valet Parking</a></li>
                    <li><a href="#concierge">Concierge</a></li>
                    <li><a href="#gift">Gift Cards</a></li>
                    <li><a href="#member">Membership</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="footer-column">
                <h3>Contact Us</h3>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <p>Jl. Sunset Road No. 89, Kuta, Badung, Bali 80361</p>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <a href="tel:+6236112345678">+62 361 1234 5678</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    <a href="mailto:info@malbaligaleria.com">info@malbaligaleria.com</a>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <p class="footer-copyright">© 2024 Mal Bali Galeria. All Rights Reserved.</p>
            <div class="footer-brand">
                <span class="footer-brand-logo">MBG</span>
                <span class="footer-brand-text">Premium Shopping Experience</span>
            </div>
        </div>
    </div>
</footer>
