
        // Add loading overlay to the body
        document.addEventListener('DOMContentLoaded', () => {
            const loadingOverlay = document.createElement('div');
            loadingOverlay.className = 'loading-overlay';
            loadingOverlay.innerHTML = `
                <div class="loading-spinner"></div>
                <div class="loading-text">Loading Mall Directory...</div>
            `;
            document.body.appendChild(loadingOverlay);
        });

        // Function to show/hide loading overlay
        function showLoading() {
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) {
                overlay.classList.add('show');
            }
        }

        function hideLoading() {
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) {
                overlay.classList.remove('show');
            }
        }

        // ===== TOAST NOTIFICATION SYSTEM =====
        let toastIdCounter = 0;
        let autoShowModalTimer = null; // Debounce timer for auto-show modal

        function showToast(message, type = 'info', duration = 3000) {
            const toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) return;

            const toastId = `toast-${toastIdCounter++}`;
            const icons = {
                success: '<circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/>',
                info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>',
                warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                error: '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>'
            };

            const toast = document.createElement('div');
            toast.id = toastId;
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <div class="toast-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        ${icons[type] || icons.info}
                    </svg>
                </div>
                <div class="toast-content">
                    <div class="toast-message">${message}</div>
                </div>
                <div class="toast-close" onclick="hideToast('${toastId}')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </div>
            `;

            toastContainer.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 10);

            if (duration > 0) {
                setTimeout(() => hideToast(toastId), duration);
            }

            return toastId;
        }

        function hideToast(toastId) {
            const toast = document.getElementById(toastId);
            if (!toast) return;

            toast.classList.remove('show');
            toast.classList.add('hide');

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }

        // ===== CATEGORY COLOR MAPPING =====
        function getCategoryColor(category) {
            const colorMap = {
                'Fashion & Apparel': '#ff6b9d',
                'Fashion & Accessories': '#c8a2c8',
                'Beauty & Health': '#ffa07a',
                'Jewelry & Watches': '#daa520',
                'Food & Beverage': '#7cb342',
                'Home & Lifestyle': '#4a90e2',
                'Department Store': '#4a90e2',
                'Supermarket': '#f4d03f',
                'Books & Stationery': '#9c27b0'
            };
            return colorMap[category] || '#5fcfda';
        }

        // ===== ANIMATED COUNTER =====
        function animateCounter(element, start, end, duration = 1000) {
            if (!element) return;

            const startTime = performance.now();
            const difference = end - start;

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOut = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(start + (difference * easeOut));

                element.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = end;
                }
            }

            requestAnimationFrame(updateCounter);
        }

        // ===== FAVORITES SYSTEM =====
        function getFavorites() {
            const favorites = localStorage.getItem('mall_favorites');
            return favorites ? JSON.parse(favorites) : [];
        }

        function saveFavorites(favorites) {
            localStorage.setItem('mall_favorites', JSON.stringify(favorites));
        }

        function toggleFavorite(tenantUnit) {
            let favorites = getFavorites();
            const index = favorites.indexOf(tenantUnit);

            if (index > -1) {
                favorites.splice(index, 1);
                showToast('Removed from favorites', 'info', 2000);
            } else {
                favorites.push(tenantUnit);
                showToast('Added to favorites ❤️', 'success', 2000);
            }

            saveFavorites(favorites);
            updateFavoritesUI();
            return favorites.includes(tenantUnit);
        }

        function isFavorite(tenantUnit) {
            return getFavorites().includes(tenantUnit);
        }

        function updateFavoritesUI() {
            const favorites = getFavorites();
            const favCount = document.querySelector('.favorites-count');
            if (favCount) {
                favCount.textContent = favorites.length;
            }

            // Update favorite buttons in modals and cards
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                const unit = btn.dataset.unit;
                if (unit && isFavorite(unit)) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            // Update tenant cards
            document.querySelectorAll('.tenant-card').forEach(card => {
                const unit = card.dataset.unit;
                if (unit && isFavorite(unit)) {
                    card.classList.add('favorited');
                } else {
                    card.classList.remove('favorited');
                }
            });
        }

        function filterFavorites() {
            const favBtn = document.getElementById('favoritesFilterBtn');
            const isActive = favBtn && favBtn.classList.contains('active');

            if (isActive) {
                // Show all
                favBtn.classList.remove('active');
                filterTenants();
            } else {
                // Show only favorites
                if (favBtn) favBtn.classList.add('active');
                const favorites = getFavorites();
                const filtered = tenants.filter(t => favorites.includes(t.unit));

                if (filtered.length === 0) {
                    showToast('No favorites yet. Click ❤️ to add stores!', 'info', 3000);
                    if (favBtn) favBtn.classList.remove('active');
                    return;
                }

                renderTenants(filtered);
                showToast(`Showing ${filtered.length} favorite${filtered.length > 1 ? 's' : ''}`, 'success', 2000);
            }
        }

        // ===== KEYBOARD SHORTCUTS =====
        function initKeyboardShortcuts() {
            document.addEventListener('keydown', (e) => {
                // Ignore if typing in input
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                    // Allow ESC to clear search
                    if (e.key === 'Escape') {
                        e.target.value = '';
                        e.target.blur();
                        filterTenants();
                    }
                    return;
                }

                // / - Focus search
                if (e.key === '/') {
                    e.preventDefault();
                    const searchInput = document.getElementById('searchInput');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }

                // ? - Show shortcuts help
                if (e.key === '?') {
                    e.preventDefault();
                    document.getElementById('shortcutsModal').classList.add('active');
                }

                // ESC - Close modals
                if (e.key === 'Escape') {
                    document.getElementById('shortcutsModal').classList.remove('active');
                    closeTenantModal();
                }

                // CTRL+M - Toggle view
                if (e.ctrlKey && e.key === 'm') {
                    e.preventDefault();
                    if (currentView === 'map') {
                        switchToListView();
                    } else {
                        switchToMapView();
                    }
                }

                // Arrow keys - Navigate cards
                if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                    e.preventDefault();
                    navigateTenantCards(e.key === 'ArrowDown' ? 1 : -1);
                }
            });
        }

        let currentCardIndex = -1;
        function navigateTenantCards(direction) {
            const cards = document.querySelectorAll('.tenant-card');
            if (cards.length === 0) return;

            // Remove previous focus
            if (currentCardIndex >= 0 && currentCardIndex < cards.length) {
                cards[currentCardIndex].style.outline = 'none';
            }

            // Update index
            currentCardIndex += direction;
            if (currentCardIndex < 0) currentCardIndex = cards.length - 1;
            if (currentCardIndex >= cards.length) currentCardIndex = 0;

            // Focus new card
            const card = cards[currentCardIndex];
            card.style.outline = '3px solid #5fcfda';
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Press Enter to open
            const enterHandler = (e) => {
                if (e.key === 'Enter') {
                    card.click();
                    card.removeEventListener('keydown', enterHandler);
                }
            };
            card.addEventListener('keydown', enterHandler);
        }

        // ===== RECENT SEARCHES =====
        function getRecentSearches() {
            const searches = localStorage.getItem('mall_recent_searches');
            return searches ? JSON.parse(searches) : [];
        }

        function saveRecentSearches(searches) {
            localStorage.setItem('mall_recent_searches', JSON.stringify(searches));
        }

        function addRecentSearch(term) {
            if (!term || term.length < 2) return;

            let searches = getRecentSearches();
            searches = searches.filter(s => s.toLowerCase() !== term.toLowerCase());
            searches.unshift(term);
            searches = searches.slice(0, 5); // Keep only last 5

            saveRecentSearches(searches);
            updateRecentSearchesUI();
        }

        function updateRecentSearchesUI() {
            const searches = getRecentSearches();
            const dropdown = document.getElementById('recentSearchesDropdown');
            const list = document.getElementById('recentSearchesList');

            if (!list) return;

            if (searches.length === 0) {
                list.innerHTML = '<div style="padding: 20px; text-align: center; color: #999; font-size: 14px;">No recent searches</div>';
                return;
            }

            list.innerHTML = searches.map(search => `
                <div class="recent-search-item" data-search="${search}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <span>${search}</span>
                </div>
            `).join('');

            // Add click handlers
            list.querySelectorAll('.recent-search-item').forEach(item => {
                item.addEventListener('click', () => {
                    const search = item.dataset.search;
                    const searchInput = document.getElementById('searchInput');
                    if (searchInput) {
                        searchInput.value = search;
                        filterTenants();
                        dropdown.classList.remove('show');
                    }
                });
            });
        }

        function clearRecentSearches() {
            localStorage.removeItem('mall_recent_searches');
            updateRecentSearchesUI();
            showToast('Search history cleared', 'info', 2000);
        }

        // ===== SHARE FUNCTIONALITY =====
        let currentShareData = null;

        function openShareMenu(tenant) {
            currentShareData = tenant;
            document.getElementById('shareMenu').classList.add('active');
        }

        function shareStore(platform) {
            if (!currentShareData) return;

            const url = window.location.origin + window.location.pathname + '?store=' + encodeURIComponent(currentShareData.unit);
            const text = `Check out ${currentShareData.name} at Mall Bali Galeria!`;

            switch(platform) {
                case 'copy':
                    navigator.clipboard.writeText(url).then(() => {
                        showToast('Link copied to clipboard!', 'success', 2000);
                        document.getElementById('shareMenu').classList.remove('active');
                    });
                    break;

                case 'whatsapp':
                    window.open(`https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`, '_blank');
                    break;

                case 'facebook':
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
                    break;

                case 'twitter':
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
                    break;
            }
        }

        // ===== STORE HOURS STATUS =====
        function getStoreStatus(hoursString) {
            // Parse hours like "10:00 AM - 10:00 PM"
            const match = hoursString.match(/(\d+):(\d+)\s*(AM|PM)\s*-\s*(\d+):(\d+)\s*(AM|PM)/i);
            if (!match) return { status: 'unknown', text: '' };

            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();

            // Convert opening time to 24h
            let openHour = parseInt(match[1]);
            const openMinute = parseInt(match[2]);
            if (match[3].toUpperCase() === 'PM' && openHour !== 12) openHour += 12;
            if (match[3].toUpperCase() === 'AM' && openHour === 12) openHour = 0;

            // Convert closing time to 24h
            let closeHour = parseInt(match[4]);
            const closeMinute = parseInt(match[5]);
            if (match[6].toUpperCase() === 'PM' && closeHour !== 12) closeHour += 12;
            if (match[6].toUpperCase() === 'AM' && closeHour === 12) closeHour = 0;

            const currentTime = currentHour * 60 + currentMinute;
            const openTime = openHour * 60 + openMinute;
            const closeTime = closeHour * 60 + closeMinute;

            if (currentTime >= openTime && currentTime < closeTime) {
                // Calculate time until closing
                const minutesUntilClose = closeTime - currentTime;
                if (minutesUntilClose < 60) {
                    return { status: 'open', text: `Closes in ${minutesUntilClose} min` };
                }
                return { status: 'open', text: 'Open Now' };
            } else {
                // Calculate time until opening
                let minutesUntilOpen = openTime - currentTime;
                if (minutesUntilOpen < 0) minutesUntilOpen += 24 * 60; // Next day

                if (minutesUntilOpen < 60) {
                    return { status: 'closed', text: `Opens in ${minutesUntilOpen} min` };
                } else if (minutesUntilOpen < 24 * 60) {
                    const hours = Math.floor(minutesUntilOpen / 60);
                    return { status: 'closed', text: `Opens in ${hours}h` };
                }
                return { status: 'closed', text: 'Closed' };
            }
        }

        function addStatusBadge(hoursElement, hoursString) {
            if (!hoursElement || !hoursString) return;

            const status = getStoreStatus(hoursString);
            if (status.status === 'unknown') return;

            const badge = document.createElement('span');
            badge.className = `store-status-badge ${status.status}`;
            badge.textContent = status.text;
            hoursElement.appendChild(badge);
        }

        // ===== TENANT DATA DENGAN KOORDINAT PIXEL =====
        const tenants = [{
                name: 'Uniqlo',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-89',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/9/92/UNIQLO_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Japanese casual wear designer, manufacturer and retailer',
                mapCoords: {
                    x: 350,
                    y: 280
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Zara',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-73',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Zara_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer',
                mapCoords: {
                    x: 630,
                    y: 320
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'TUMI',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1C-76',
                logo: 'https://logos-world.net/wp-content/uploads/2022/04/Tumi-Logo.png',
                hours: '10:00 AM - 10:00 PM',
                description: 'Premium travel and lifestyle brand',
                mapCoords: {
                    x: 840,
                    y: 240
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Pandora',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1C-79',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/8/83/Pandora_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Danish jewelry manufacturer',
                mapCoords: {
                    x: 1050,
                    y: 360
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Sephora',
                category: 'Beauty & Health',
                floor: '1st Floor',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/000000/ffffff?text=SEPHORA',
                hours: '10:00 AM - 10:00 PM',
                description: 'French multinational chain of personal care and beauty stores',
                mapCoords: {
                    x: 1120,
                    y: 480
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Victoria\'s Secret',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1A-38',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/29/Victoria%27s_Secret_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American lingerie, clothing, and beauty retailer',
                mapCoords: {
                    x: 490,
                    y: 520
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Mango',
                category: 'Fashion & Apparel',
                floor: '1st Floor',
                unit: '1C-78',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/2/23/Mango_Logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish clothing design and manufacturing company',
                mapCoords: {
                    x: 700,
                    y: 560
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'La Senza',
                category: 'Fashion & Accessories',
                floor: '1st Floor',
                unit: '1A-26',
                logo: 'https://via.placeholder.com/150x80/e91e63/ffffff?text=LA+SENZA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Canadian fashion retailer specializing in lingerie',
                mapCoords: {
                    x: 280,
                    y: 440
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Matahari',
                category: 'Department Store',
                floor: '2nd Floor',
                unit: '2A-01',
                logo: 'https://via.placeholder.com/150x80/1e3a8a/ffffff?text=MATAHARI',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian department store chain',
                mapCoords: {
                    x: 1105,
                    y: 465
                },
                mapOriginalSize: {
                    width: 1184,
                    height: 864
                }
            },
            {
                name: 'Casio G-Shock',
                category: 'Jewelry & Watches',
                floor: '2nd Floor',
                unit: '1A-17',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Casio_G-Shock_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'Line of watches manufactured by Casio',
                mapCoords: {
                    x: 420,
                    y: 320
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Oysho',
                category: 'Fashion & Accessories',
                floor: '2nd Floor',
                unit: '1C-95',
                logo: 'https://via.placeholder.com/150x80/333333/ffffff?text=OYSHO',
                hours: '10:00 AM - 10:00 PM',
                description: 'Spanish fashion retailer',
                mapCoords: {
                    x: 770,
                    y: 280
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Chatime',
                category: 'Food & Beverage',
                floor: '2nd Floor',
                unit: '2C-T',
                logo: 'https://via.placeholder.com/150x80/ff6b6b/ffffff?text=Chatime',
                hours: '10:00 AM - 10:00 PM',
                description: 'Taiwanese global franchise teahouse chain',
                mapCoords: {
                    x: 980,
                    y: 400
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Dairy Queen',
                category: 'Food & Beverage',
                floor: '2nd Floor',
                unit: 'D1',
                logo: 'https://upload.wikimedia.org/wikipedia/commons/a/ae/Dairy_Queen_logo.svg',
                hours: '10:00 AM - 10:00 PM',
                description: 'American chain of soft serve ice cream',
                mapCoords: {
                    x: 910,
                    y: 520
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'ACE Hardware',
                category: 'Home & Lifestyle',
                floor: '1st Floor',
                unit: 'A1',
                logo: 'https://via.placeholder.com/150x80/8b0000/ffffff?text=ACE',
                hours: '9:00 AM - 10:00 PM',
                description: 'Hardware and home improvement retail store',
                mapCoords: {
                    x: 210,
                    y: 200
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Matahari Department',
                category: 'Department Store',
                floor: '1st Floor',
                unit: 'B1',
                logo: 'https://via.placeholder.com/150x80/1e3a8a/ffffff?text=MATAHARI',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian department store chain',
                mapCoords: {
                    x: 1190,
                    y: 240
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Hypermart',
                category: 'Supermarket',
                floor: '2nd Floor',
                unit: 'C1',
                logo: 'https://via.placeholder.com/150x80/ffd700/333333?text=HYPERMART',
                hours: '8:00 AM - 11:00 PM',
                description: 'Hypermarket offering groceries and household items',
                mapCoords: {
                    x: 560,
                    y: 480
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            },
            {
                name: 'Gramedia',
                category: 'Books & Stationery',
                floor: '2nd Floor',
                unit: 'C2',
                logo: 'https://via.placeholder.com/150x80/ff9800/ffffff?text=GRAMEDIA',
                hours: '10:00 AM - 10:00 PM',
                description: 'Indonesian bookstore chain',
                mapCoords: {
                    x: 350,
                    y: 560
                },
                mapOriginalSize: {
                    width: 1400,
                    height: 800
                }
            }
        ];

        // Floor Map Images - GANTI DENGAN PATH GAMBAR ANDA
        const floorMaps = {
            'floor1': '../../../assets/images/floors/1st_floor.png',
            'floor2': '../../../assets/images/floors/2nd_floor.png'
        };

        // Map View State
        let currentView = 'list';
        let currentFloorMap = 'floor1';

        // Filter State (Simplified to native inputs)

        // ===== HELPER FUNCTION =====
        function calculateResponsivePosition(mapCoords, originalSize, currentWidth, currentHeight) {
            const scaleX = currentWidth / originalSize.width;
            const scaleY = currentHeight / originalSize.height;
            return {
                x: mapCoords.x * scaleX,
                y: mapCoords.y * scaleY
            };
        }

        // ===== TOASTR NOTIFICATION =====
        const toastr = document.getElementById('toastr');
        const toastrClose = document.getElementById('toastrClose');

        function showToastr(title, message, duration = 3000) {
            toastr.querySelector('.toastr-content h4').textContent = title;
            toastr.querySelector('.toastr-content p').textContent = message;
            toastr.classList.add('show');
            setTimeout(() => hideToastr(), duration);
        }

        function hideToastr() {
            toastr.classList.remove('show');
        }

        toastrClose.addEventListener('click', hideToastr);

        // ===== MENU TOGGLE =====
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

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

        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (!link.getAttribute('onclick')) {
                    menuBtn.classList.remove('active');
                    sidebar.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            });
        });

        // ===== DARK MODE =====
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'enabled' :
                'disabled');
        });

        // ===== RENDER TENANTS =====
        const tenantGrid = document.getElementById('tenantGrid');
        const emptyState = document.getElementById('emptyState');
        const mapView = document.getElementById('mapView');

        function renderTenants(tenantsToRender) {
            tenantGrid.innerHTML = '';
            if (tenantsToRender.length === 0) {
                emptyState.classList.add('show');
                return;
            }
            emptyState.classList.remove('show');

            tenantsToRender.forEach((tenant, index) => {
                const card = document.createElement('div');
                card.className = 'tenant-card stagger-card';
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

                // Add click event to See Details button
                const seeDetailsBtn = card.querySelector('.see-details-btn');
                if (seeDetailsBtn) {
                    seeDetailsBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        showTenantModal(tenant);
                    });
                }

                tenantGrid.appendChild(card);
                setTimeout(() => card.classList.add('show'), 50);
            });
        }

        // ===== FILTER FUNCTION =====
        function filterTenants() {
            const searchInput = document.getElementById('searchInput');
            const headerSearch = document.getElementById('headerSearch');
            const sidebarSearch = document.getElementById('sidebarSearch');

            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const headerSearchTerm = headerSearch ? headerSearch.value.toLowerCase() : '';
            const sidebarSearchTerm = sidebarSearch ? sidebarSearch.value.toLowerCase() : '';
            const selectedFloor = document.getElementById('floorFilter').value;
            const selectedCategory = document.getElementById('categoryFilter').value;

            const combinedSearch = searchTerm || headerSearchTerm || sidebarSearchTerm;

            const filtered = tenants.filter(tenant => {
                const matchesSearch = !combinedSearch ||
                    tenant.name.toLowerCase().includes(combinedSearch) ||
                    tenant.category.toLowerCase().includes(combinedSearch);
                const matchesFloor = !selectedFloor || tenant.floor === selectedFloor;
                const matchesCategory = !selectedCategory || tenant.category === selectedCategory;

                return matchesSearch && matchesFloor && matchesCategory;
            });

            const tenantCountElement = document.getElementById('tenantCount');
            const currentCount = parseInt(tenantCountElement.textContent) || 0;
            animateCounter(tenantCountElement, currentCount, filtered.length, 800);

            if (filtered.length > 0) {
                showToast(`Found ${filtered.length} store${filtered.length > 1 ? 's' : ''}`, 'success', 2000);
            } else {
                showToast('No stores found matching your criteria', 'info', 2000);
            }

            renderTenants(filtered);

            // Clear previous timer
            if (autoShowModalTimer) {
                clearTimeout(autoShowModalTimer);
                autoShowModalTimer = null;
            }

            // Auto-show modal if only 1 result AND search term is not empty
            if (filtered.length === 1 && combinedSearch && combinedSearch.length > 0) {
                autoShowModalTimer = setTimeout(() => {
                    showTenantModal(filtered[0]);
                    autoShowModalTimer = null;
                }, 1500); // Wait 1.5 seconds after last keystroke
            }

            // Update tenant count per floor
            updateFloorCounts();
        }

        // Update floor counts for map view
        function updateFloorCounts() {
            const floorCounts = {};
            tenants.forEach(tenant => {
                if (floorCounts[tenant.floor]) {
                    floorCounts[tenant.floor]++;
                } else {
                    floorCounts[tenant.floor] = 1;
                }
            });

            // Update the floor buttons with counts
            document.querySelectorAll('.floor-btn').forEach(btn => {
                const floorValue = btn.dataset.floor === 'floor1' ? '1st Floor' : '2nd Floor';
                const count = floorCounts[floorValue] || 0;
                const originalText = floorValue;
                // Check if there's already a count in parentheses and update it rather than adding again
                const existingCountMatch = btn.innerHTML.match(/\((\d+)\)/);
                if (existingCountMatch) {
                    btn.innerHTML = btn.innerHTML.replace(/\(\d+\)/, `(${count})`);
                } else {
                    btn.innerHTML =
                        `${originalText} <span style="margin-left: 5px; font-size: 12px;">(${count})</span>`;
                }
            });
        }

        // ===== SEARCH SUGGESTIONS =====
        function createSearchSuggestions(searchTerm, containerId) {
            const suggestionsContainer = document.getElementById(containerId);
            if (!searchTerm) {
                suggestionsContainer.classList.remove('show');
                return;
            }

            const filteredTenants = tenants.filter(tenant =>
                tenant.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                tenant.category.toLowerCase().includes(searchTerm.toLowerCase())
            ).slice(0, 8); // Limit to 8 suggestions

            if (filteredTenants.length === 0) {
                suggestionsContainer.classList.remove('show');
                return;
            }

            suggestionsContainer.innerHTML = '';
            filteredTenants.forEach(tenant => {
                const suggestionItem = document.createElement('div');
                suggestionItem.className = 'suggestion-item';
                suggestionItem.innerHTML = `
                    <div class="suggestion-icon">${tenant.name.charAt(0)}</div>
                    <div class="suggestion-text">
                        <div>${tenant.name}</div>
                        <div class="suggestion-category">${tenant.category}</div>
                    </div>
                    <div class="suggestion-floor">${tenant.floor}</div>
                `;

                suggestionItem.addEventListener('click', () => {
                    document.getElementById(containerId.replace('Suggestions', '')).value = tenant.name;
                    suggestionsContainer.classList.remove('show');
                    // Apply the search
                    filterTenants();
                });

                suggestionsContainer.appendChild(suggestionItem);
            });

            suggestionsContainer.classList.add('show');
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-bar')) {
                document.querySelectorAll('.search-suggestions').forEach(container => {
                    container.classList.remove('show');
                });
            }
        });

        // ===== CATEGORY FILTER =====
        // Native select implementation (Simplified)
        document.getElementById('categoryFilter').addEventListener('change', () => {
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts();
            } else {
                filterTenants();
            }
        });

        // Event Listeners
        const searchInput = document.getElementById('searchInput');
        const sidebarSearch = document.getElementById('sidebarSearch');

        searchInput.addEventListener('input', () => {
            createSearchSuggestions(searchInput.value, 'searchInputSuggestions');
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when searching in map view
            } else {
                filterTenants();
            }
        });



        sidebarSearch.addEventListener('input', () => {
            createSearchSuggestions(sidebarSearch.value, 'sidebarSearchSuggestions');
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when searching in map view
            } else {
                filterTenants();
            }
        });

        // Also add focus event to show suggestions if there's text
        searchInput.addEventListener('focus', () => {
            if (searchInput.value) {
                createSearchSuggestions(searchInput.value, 'searchInputSuggestions');
            }
        });



        sidebarSearch.addEventListener('focus', () => {
            if (sidebarSearch.value) {
                createSearchSuggestions(sidebarSearch.value, 'sidebarSearchSuggestions');
            }
        });
        document.getElementById('floorFilter').addEventListener('change', () => {
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when filtering by floor
            } else {
                filterTenants();
            }
        });
        document.getElementById('categoryFilter').addEventListener('change', () => {
            if (currentView === 'map') {
                updateMapView();
                updateFloorCounts(); // Update counts when filtering by category
            } else {
                filterTenants();
            }
        });

        // ===== MAP VIEW =====
        function updateMapView() {
            const mapContainer = document.getElementById('mapContainer');
            const selectedFloor = document.getElementById('floorFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('categoryFilter').value;

            // Calculate tenant counts per floor
            const floorCounts = {};
            tenants.forEach(t => {
                if (floorCounts[t.floor]) {
                    floorCounts[t.floor]++;
                } else {
                    floorCounts[t.floor] = 1;
                }
            });

            // Filter tenants based on search, floor, and category
            let floorTenants = tenants.filter(t => {
                const matchesFloor = !selectedFloor || t.floor === selectedFloor;
                const matchesSearch = !searchTerm || t.name.toLowerCase().includes(searchTerm) || t.category
                    .toLowerCase().includes(searchTerm);
                const matchesCategory = !selectedCategory || t.category === selectedCategory;
                return matchesFloor && matchesSearch && matchesCategory;
            });

            // Filter tenants for the current floor only
            let currentFloorTenants = floorTenants.filter(t => {
                const matchesFloor = !selectedFloor || t.floor === selectedFloor;
                return matchesFloor;
            });

            const floorKey = selectedFloor === '1st Floor' ? 'floor1' : selectedFloor === '2nd Floor' ? 'floor2' :
                currentFloorMap;

            // Format tenant counts per floor for display
            const total1stFloor = floorCounts['1st Floor'] || 0;
            const total2ndFloor = floorCounts['2nd Floor'] || 0;

            mapContainer.innerHTML = `
                <div class="map-wrapper" id="mapWrapper" style="position: relative;">
                    <img src="${floorMaps[floorKey]}" alt="Mall Floor Plan" id="floorMapImage" style="width: 100%; height: auto; display: block;">
                </div>
                <div class="map-stats">
                    <div class="map-stats-number" id="mapStatsNumber">${currentFloorTenants.length}</div>
                    <div class="map-stats-label">Stores on this floor</div>
                    <div style="margin-top: 10px; font-size: 12px; color: #666; display: flex; justify-content: space-between;">
                        <span>1st Floor: <strong>${total1stFloor}</strong></span>
                        <span>2nd Floor: <strong>${total2ndFloor}</strong></span>
                    </div>
                </div>
            `;

            const mapStatsNumberElement = document.getElementById('mapStatsNumber');
            const currentMapCount = parseInt(mapStatsNumberElement.textContent) || 0;
            animateCounter(mapStatsNumberElement, currentMapCount, currentFloorTenants.length, 800);

            if (currentFloorTenants.length > 0) {
                showToast(`${currentFloorTenants.length} store${currentFloorTenants.length > 1 ? 's' : ''} on this floor`, 'success', 2000);
            }

            // Update tenant list in sidebar
            updateTenantList(currentFloorTenants);

            const mapImage = document.getElementById('floorMapImage');
            const mapWrapper = document.getElementById('mapWrapper');

            const addPins = () => {
                mapContainer.querySelectorAll('.map-pin').forEach(pin => pin.remove());
                if (!mapImage.width || !mapImage.height) {
                    setTimeout(addPins, 100);
                    return;
                }

                const currentWidth = mapImage.width;
                const currentHeight = mapImage.height;

                // Process tenants for potential clustering
                const allPositions = currentFloorTenants.map(tenant => {
                    if (tenant.mapCoords && tenant.mapOriginalSize) {
                        const position = calculateResponsivePosition(tenant.mapCoords, tenant.mapOriginalSize,
                            currentWidth, currentHeight);
                        return {
                            tenant,
                            position,
                            x: position.x,
                            y: position.y
                        };
                    }
                    return null;
                }).filter(Boolean);

                // Group by position for clustering (markers that are close together)
                const positionGroups = {};
                const clusteringDistance = 20; // pixels threshold for clustering

                allPositions.forEach(pos => {
                    let foundGroup = false;
                    for (const key in positionGroups) {
                        const [groupX, groupY] = key.split(',').map(Number);
                        const distance = Math.sqrt(Math.pow(pos.x - groupX, 2) + Math.pow(pos.y - groupY, 2));
                        if (distance < clusteringDistance) {
                            positionGroups[key].push(pos);
                            foundGroup = true;
                            break;
                        }
                    }
                    if (!foundGroup) {
                        const key = `${pos.x},${pos.y}`;
                        positionGroups[key] = [pos];
                    }
                });

                // Create markers for each group
                for (const key in positionGroups) {
                    const group = positionGroups[key];
                    const [groupX, groupY] = key.split(',').map(Number);

                    let pin;
                    if (group.length > 1) {
                        // Create cluster marker
                        pin = document.createElement('div');
                        pin.className = 'map-pin cluster';
                        pin.style.position = 'absolute';
                        pin.style.left = groupX + 'px';
                        pin.style.top = groupY + 'px';
                        pin.textContent = group.length;
                        pin.style.background = 'linear-gradient(135deg, #5fcfda, #4db8c3)';

                        // Store all tenants in this cluster
                        pin.dataset.tenants = JSON.stringify(group.map(item => item.tenant));

                        pin.addEventListener('mouseenter', function() {
                            // Show simple tooltip with tenant count
                            showSimpleTooltip(`${group.length} Stores`, this);
                        });
                    } else {
                        // Create single marker
                        const tenant = group[0].tenant;
                        pin = document.createElement('div');
                        pin.className = 'map-pin';
                        pin.style.position = 'absolute';
                        pin.style.left = groupX + 'px';
                        pin.style.top = groupY + 'px';
                        pin.style.background = getCategoryColor(tenant.category);
                        pin.dataset.tenant = JSON.stringify(tenant);

                        const label = document.createElement('div');
                        label.className = 'map-pin-label';
                        label.textContent = tenant.name;
                        pin.appendChild(label);

                        pin.addEventListener('mouseenter', function() {
                            const tenantData = JSON.parse(this.dataset.tenant);
                            showSimpleTooltip(tenantData.name, this);
                        });
                    }

                    pin.addEventListener('mouseleave', hideMapTooltip);

                    pin.addEventListener('click', function(e) {
                        e.stopPropagation();
                        if (this.classList.contains('cluster')) {
                            const tenantList = JSON.parse(this.dataset.tenants);
                            showClusterModal(tenantList);
                        } else {
                            const tenantData = JSON.parse(this.dataset.tenant);
                            showTenantModal(tenantData);
                        }
                    });

                    mapWrapper.appendChild(pin);
                }

                if (!document.getElementById('mapTooltip')) {
                    const tooltip = document.createElement('div');
                    tooltip.id = 'mapTooltip';
                    tooltip.className = 'map-tooltip-enhanced';
                    document.body.appendChild(tooltip);
                }
            };

            if (mapImage.complete && mapImage.naturalWidth !== 0) {
                addPins();
            } else {
                mapImage.addEventListener('load', addPins);
                setTimeout(addPins, 500);
            }

            let resizeTimeout;
            const resizeHandler = function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(addPins, 150);
            };

            window.removeEventListener('resize', window._mapResizeHandler);
            window._mapResizeHandler = resizeHandler;
            window.addEventListener('resize', resizeHandler);
        }

        // ===== UPDATE TENANT LIST IN SIDEBAR =====
        function updateTenantList(tenantsToShow) {
            const tenantListItems = document.getElementById('tenantListItems');
            tenantListItems.innerHTML = '';

            if (tenantsToShow.length === 0) {
                tenantListItems.innerHTML =
                    '<p style="text-align: center; color: #666; font-size: 12px; padding: 20px;">No stores found</p>';
                return;
            }

            tenantsToShow.forEach(tenant => {
                const item = document.createElement('div');
                item.className = 'tenant-list-item';
                item.innerHTML = `
                    <div class="tenant-list-item-name">${tenant.name}</div>
                    <div class="tenant-list-item-details">
                        <span class="tenant-list-item-unit">${tenant.unit}</span>
                        <span>${tenant.category}</span>
                    </div>
                `;

                item.addEventListener('click', () => {
                    // Open modal directly instead of just showing tooltip
                    showTenantModal(tenant);
                });

                tenantListItems.appendChild(item);
            });
        }

        // ===== MAP TOOLTIP =====
        function showMapTooltip(tenant, pinElement) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            tooltip.className = 'map-tooltip-enhanced';
            tooltip.innerHTML = `
                <div class="map-tooltip-enhanced-header">
                    <h4>${tenant.name}</h4>
                </div>
                <div class="map-tooltip-enhanced-body">
                    <div style="text-align: center; margin-bottom: 12px;">
                        <img src="${tenant.logo}" alt="${tenant.name}" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                        </svg>
                        ${tenant.category}
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        ${tenant.hours}
                    </div>
                    <div class="map-tooltip-enhanced-category">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Unit ${tenant.unit} - ${tenant.floor}
                    </div>
                    <span class="unit-badge">${tenant.floor}</span>
                    <a href="#tenant-${tenant.unit.replace(/[^a-zA-Z0-9]/g, '')}" class="tooltip-see-details">
                        See Details
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            `;

            const pinRect = pinElement.getBoundingClientRect();
            const tooltipWidth = 280;
            let left = pinRect.left + (pinRect.width / 2) - (tooltipWidth / 2);
            let top = pinRect.top - 10;

            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }

            // Convert viewport coordinates to document coordinates for proper positioning
            tooltip.style.left = (left + window.scrollX) + 'px';
            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.transform = 'translateY(-100%)';

            setTimeout(() => tooltip.classList.add('show'), 50);
        }

        // ===== CLUSTER TOOLTIP =====
        function showClusterTooltip(tenantList, pinElement, x, y) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            tooltip.className = 'map-tooltip-enhanced';
            tooltip.innerHTML = `
                <div class="map-tooltip-enhanced-header">
                    <h4>${tenantList.length} Stores Found</h4>
                </div>
                <div class="map-tooltip-enhanced-body">
                    <div style="max-height: 200px; overflow-y: auto;">
                        ${tenantList.map(tenant => `
                                    <div class="suggestion-item" style="padding: 8px 12px; margin-bottom: 8px; border-radius: 8px; cursor: pointer;">
                                        <div class="suggestion-icon" style="width: 20px; height: 20px; font-size: 10px;">${tenant.name.charAt(0)}</div>
                                        <div class="suggestion-text" style="flex: 1;">
                                            <div style="font-size: 13px; font-weight: 600;">${tenant.name}</div>
                                            <div class="suggestion-category" style="font-size: 10px;">${tenant.category}</div>
                                        </div>
                                        <div class="suggestion-floor" style="font-size: 9px;">${tenant.floor}</div>
                                    </div>
                                `).join('')}
                    </div>
                </div>
            `;

            const pinRect = pinElement.getBoundingClientRect();
            const tooltipWidth = 280;
            let left = pinRect.left + (pinRect.width / 2) - (tooltipWidth / 2);
            let top = pinRect.top - 10;

            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }

            // Convert viewport coordinates to document coordinates for proper positioning
            tooltip.style.left = (left + window.scrollX) + 'px';
            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.transform = 'translateY(-100%)';

            setTimeout(() => tooltip.classList.add('show'), 50);

            // Add click events to each tenant in the cluster
            const suggestionItems = tooltip.querySelectorAll('.suggestion-item');
            suggestionItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    const selectedTenant = tenantList[index];
                    showMapTooltip(selectedTenant, pinElement);
                });
            });
        }

        function hideMapTooltip() {
            const tooltip = document.getElementById('mapTooltip');
            if (tooltip) {
                // Delay hiding to allow clicking on links inside tooltip
                setTimeout(() => {
                    if (!tooltip.matches(':hover')) {
                        tooltip.classList.remove('show');
                    }
                }, 100);
            }
        }

        // ===== SIMPLE TOOLTIP FOR HOVER =====
        function showSimpleTooltip(text, pinElement) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            tooltip.className = 'map-tooltip-enhanced';
            tooltip.innerHTML = `
                <div style="padding: 15px 20px; text-align: center;">
                    <div style="font-size: 14px; font-weight: 600; color: #2c3e50; margin-bottom: 6px;">${text}</div>
                    <div style="font-size: 11px; color: #5fcfda; font-weight: 500;">Click to see details</div>
                </div>
            `;

            const pinRect = pinElement.getBoundingClientRect();
            const tooltipWidth = 220;
            let left = pinRect.left + (pinRect.width / 2) - (tooltipWidth / 2);
            let top = pinRect.top - 10;

            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }

            tooltip.style.left = (left + window.scrollX) + 'px';
            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.transform = 'translateY(-100%)';
            tooltip.style.minWidth = tooltipWidth + 'px';

            setTimeout(() => tooltip.classList.add('show'), 50);
        }

        // ===== TENANT MODAL FUNCTIONS =====
        let currentModalCarouselIndex = 0;
        let modalCarouselImages = [];
        let modalSwipeStartX = 0;
        let modalSwipeEndX = 0;

        function showTenantModal(tenant) {
            const modal = document.getElementById('tenantModal');
            if (!modal) return;

            // Hide any open tooltips
            hideMapTooltip();

            // Use dummy data if tenant data is incomplete
            const tenantData = {
                name: tenant.name || 'Sample Store',
                floor: tenant.floor || '1st Floor',
                category: tenant.category || 'Fashion & Apparel',
                hours: tenant.hours || '10:00 AM - 10:00 PM',
                unit: tenant.unit || 'A-101',
                logo: tenant.logo || 'https://via.placeholder.com/150x100?text=Store+Logo',
                images: tenant.images || [
                    'https://via.placeholder.com/800x600?text=Store+Image+1',
                    'https://via.placeholder.com/800x600?text=Store+Image+2',
                    'https://via.placeholder.com/800x600?text=Store+Image+3'
                ],
                description: tenant.description || 'Welcome to our store! We offer a wide selection of premium products and exceptional customer service. Visit us today to discover our latest collections and exclusive offers.'
            };

            // Populate modal data
            document.getElementById('modalTenantName').textContent = tenantData.name;
            document.getElementById('modalFloorBadge').textContent = tenantData.floor;
            document.getElementById('modalCategoryText').textContent = tenantData.category;
            document.getElementById('modalHours').textContent = tenantData.hours;
            document.getElementById('modalLocation').textContent = `${tenantData.floor}, Unit ${tenantData.unit}`;
            document.getElementById('modalUnit').textContent = tenantData.unit;

            // Set logo
            const modalLogo = document.getElementById('modalLogo');
            modalLogo.innerHTML = `<img src="${tenantData.logo}" alt="${tenantData.name}">`;

            // Set up carousel images
            modalCarouselImages = tenantData.images;
            currentModalCarouselIndex = 0;
            updateModalCarousel();

            // Show description
            const descContainer = document.getElementById('modalDescriptionContainer');
            const descText = document.getElementById('modalDescription');
            descText.textContent = tenantData.description;
            descContainer.style.display = 'block';

            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Set favorite button
            const modalFavBtn = document.getElementById('modalFavoriteBtn');
            if (modalFavBtn) {
                modalFavBtn.dataset.unit = tenantData.unit;
                if (isFavorite(tenantData.unit)) {
                    modalFavBtn.classList.add('active');
                } else {
                    modalFavBtn.classList.remove('active');
                }

                // Remove old listeners
                const newBtn = modalFavBtn.cloneNode(true);
                modalFavBtn.parentNode.replaceChild(newBtn, modalFavBtn);

                // Add new listener
                newBtn.addEventListener('click', () => {
                    toggleFavorite(tenantData.unit);
                    if (isFavorite(tenantData.unit)) {
                        newBtn.classList.add('active');
                    } else {
                        newBtn.classList.remove('active');
                    }
                });
            }

            // Set share button
            const modalShareBtn = document.getElementById('modalShareBtn');
            if (modalShareBtn) {
                const newShareBtn = modalShareBtn.cloneNode(true);
                modalShareBtn.parentNode.replaceChild(newShareBtn, modalShareBtn);

                newShareBtn.addEventListener('click', () => {
                    openShareMenu(tenantData);
                });
            }

            // Add status badge to hours
            const hoursElement = document.getElementById('modalHours');
            if (hoursElement && tenantData.hours) {
                // Remove existing badge if any
                const existingBadge = hoursElement.querySelector('.store-status-badge');
                if (existingBadge) existingBadge.remove();

                addStatusBadge(hoursElement, tenantData.hours);
            }

            // Show modal and prevent body scroll
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Hide swipe hint after 3 seconds
            setTimeout(() => {
                const hint = document.getElementById('carouselSwipeHint');
                if (hint) hint.classList.add('hidden');
            }, 3000);
        }

        function closeTenantModal() {
            const modal = document.getElementById('tenantModal');
            if (!modal) return;

            modal.classList.remove('active');
            document.body.style.overflow = '';

            // Reset swipe hint
            const hint = document.getElementById('carouselSwipeHint');
            if (hint) hint.classList.remove('hidden');
        }

        function updateModalCarousel() {
            const carouselContainer = document.getElementById('modalCarouselImages');
            const indicatorsContainer = document.getElementById('modalCarouselIndicators');

            // Update images
            carouselContainer.innerHTML = modalCarouselImages.map(img => `
                <div class="carousel-image">
                    <img src="${img}" alt="Tenant Image">
                </div>
            `).join('');

            // Update indicators
            if (modalCarouselImages.length > 1) {
                indicatorsContainer.innerHTML = modalCarouselImages.map((_, index) => `
                    <div class="carousel-indicator ${index === currentModalCarouselIndex ? 'active' : ''}" data-index="${index}"></div>
                `).join('');

                // Add click events to indicators
                indicatorsContainer.querySelectorAll('.carousel-indicator').forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        currentModalCarouselIndex = index;
                        updateModalCarousel();
                    });
                });
            } else {
                indicatorsContainer.innerHTML = '';
            }

            // Update transform
            const offset = -currentModalCarouselIndex * 100;
            carouselContainer.style.transform = `translateX(${offset}%)`;
        }

        function nextModalImage() {
            if (currentModalCarouselIndex < modalCarouselImages.length - 1) {
                currentModalCarouselIndex++;
            } else {
                currentModalCarouselIndex = 0; // Loop back
            }
            updateModalCarousel();
        }

        function prevModalImage() {
            if (currentModalCarouselIndex > 0) {
                currentModalCarouselIndex--;
            } else {
                currentModalCarouselIndex = modalCarouselImages.length - 1; // Loop to end
            }
            updateModalCarousel();
        }

        // ===== CLUSTER MODAL =====
        function showClusterModal(tenantList) {
            // For clusters, show the first tenant's modal
            // You could also create a special cluster view here
            if (tenantList && tenantList.length > 0) {
                showTenantModal(tenantList[0]);
            }
        }

        // ===== MODAL EVENT LISTENERS =====
        document.addEventListener('DOMContentLoaded', () => {
            const modalClose = document.getElementById('modalClose');
            const modalOverlay = document.getElementById('modalOverlay');
            const modalCarouselPrev = document.getElementById('modalCarouselPrev');
            const modalCarouselNext = document.getElementById('modalCarouselNext');
            const modalCarousel = document.querySelector('.modal-carousel');

            if (modalClose) {
                modalClose.addEventListener('click', closeTenantModal);
            }

            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeTenantModal);
            }

            if (modalCarouselPrev) {
                modalCarouselPrev.addEventListener('click', prevModalImage);
            }

            if (modalCarouselNext) {
                modalCarouselNext.addEventListener('click', nextModalImage);
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                const modal = document.getElementById('tenantModal');
                if (modal && modal.classList.contains('active')) {
                    if (e.key === 'Escape') {
                        closeTenantModal();
                    } else if (e.key === 'ArrowLeft') {
                        prevModalImage();
                    } else if (e.key === 'ArrowRight') {
                        nextModalImage();
                    }
                }
            });

            // Touch swipe support for carousel
            if (modalCarousel) {
                modalCarousel.addEventListener('touchstart', (e) => {
                    modalSwipeStartX = e.touches[0].clientX;
                }, { passive: true });

                modalCarousel.addEventListener('touchend', (e) => {
                    modalSwipeEndX = e.changedTouches[0].clientX;
                    const swipeDistance = modalSwipeStartX - modalSwipeEndX;
                    const minSwipeDistance = 50;

                    if (Math.abs(swipeDistance) > minSwipeDistance) {
                        if (swipeDistance > 0) {
                            nextModalImage();
                        } else {
                            prevModalImage();
                        }
                    }
                }, { passive: true });
            }
        });


        // Keep tooltip visible when hovering over it
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('mouseover', (e) => {
                const tooltip = document.getElementById('mapTooltip');
                if (tooltip && e.target.closest('#mapTooltip')) {
                    tooltip.classList.add('show');
                }
            });

            document.addEventListener('mouseout', (e) => {
                const tooltip = document.getElementById('mapTooltip');
                if (tooltip && e.target.closest('#mapTooltip') && !e.relatedTarget?.closest(
                        '#mapTooltip') && !e.relatedTarget?.closest('.map-pin')) {
                    tooltip.classList.remove('show');
                }
            });
        });

        let currentMobileTooltip = null;

        function toggleMobileTooltip(tenant, pinElement) {
            const tooltip = document.getElementById('mapTooltip');
            if (!tooltip) return;

            if (currentMobileTooltip === pinElement) {
                hideMapTooltip();
                currentMobileTooltip = null;
                return;
            }

            currentMobileTooltip = pinElement;
            showMapTooltip(tenant, pinElement);

            setTimeout(() => {
                if (currentMobileTooltip === pinElement) {
                    hideMapTooltip();
                    currentMobileTooltip = null;
                }
            }, 5000);
        }

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && !e.target.closest('.map-pin')) {
                hideMapTooltip();
                currentMobileTooltip = null;
            }
        });

        function showTenantDetails(tenant) {
            showToastr(tenant.name, `Unit ${tenant.unit} - ${tenant.floor}`, 3000);
        }

        // ===== COORDINATE PICKER =====
        function enableCoordinatePicker() {
            const mapImage = document.getElementById('floorMapImage');
            if (!mapImage) {
                alert('Please switch to Map View first!');
                return;
            }

            console.clear();
            console.log('%c📍 COORDINATE PICKER ENABLED',
                'background: #5fcfda; color: white; font-size: 16px; padding: 10px; font-weight: bold;');
            console.log('%cClick anywhere on the map to get coordinates', 'font-size: 14px; color: #666;');
            console.log('Image Natural Size:', mapImage.naturalWidth, 'x', mapImage.naturalHeight);
            console.log('Image Display Size:', mapImage.width, 'x', mapImage.height);

            mapImage.style.cursor = 'crosshair';

            if (mapImage._coordinateListener) {
                mapImage.removeEventListener('click', mapImage._coordinateListener);
            }

            const clickHandler = function(e) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;
                const scaleX = this.naturalWidth / this.width;
                const scaleY = this.naturalHeight / this.height;
                const originalX = Math.round(clickX * scaleX);
                const originalY = Math.round(clickY * scaleY);

                console.log('%c✓ COORDINATES', 'background: #2ecc71; color: white; padding: 8px; font-weight: bold;');
                console.log(`mapCoords: { x: ${originalX}, y: ${originalY} },`);
                console.log(`mapOriginalSize: { width: ${this.naturalWidth}, height: ${this.naturalHeight} }`);

                const marker = document.createElement('div');
                marker.style.cssText = `
                    position: absolute; left: ${clickX}px; top: ${clickY}px; width: 12px; height: 12px;
                    background: #ff4757; border: 3px solid white; border-radius: 50%;
                    transform: translate(-50%, -50%); pointer-events: none; z-index: 9999;
                    box-shadow: 0 0 0 0 rgba(255, 71, 87, 1); animation: pulse 1.5s infinite;
                `;

                const wrapper = this.parentElement;
                wrapper.style.position = 'relative';
                wrapper.appendChild(marker);
                setTimeout(() => marker.remove(), 3000);
            };

            mapImage._coordinateListener = clickHandler;
            mapImage.addEventListener('click', clickHandler);

            if (!document.getElementById('pulseAnimation')) {
                const style = document.createElement('style');
                style.id = 'pulseAnimation';
                style.textContent = `
                    @keyframes pulse {
                        0% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7); }
                        70% { box-shadow: 0 0 0 20px rgba(255, 71, 87, 0); }
                        100% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0); }
                    }
                `;
                document.head.appendChild(style);
            }

            showToastr('Coordinate Picker', 'Click on map to get coordinates. Check console!', 4000);
        }

        // ===== VIEW TOGGLE =====
        const mapViewBtn = document.getElementById('mapViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');

        function switchToMapView() {
            currentView = 'map';
            mapViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            tenantGrid.style.display = 'none';
            emptyState.style.display = 'none';
            mapView.style.display = 'block';

            document.getElementById('mapTenantList').style.display = 'block';
            showToast('Switched to Map View', 'info', 2000);

            updateMapView();
        }

        function switchToListView() {
            currentView = 'list';
            listViewBtn.classList.add('active');
            mapViewBtn.classList.remove('active');
            mapView.style.display = 'none';
            tenantGrid.style.display = 'grid';

            document.getElementById('mapTenantList').style.display = 'none';
            showToast('Switched to List View', 'info', 2000);

            filterTenants();
        }

        mapViewBtn.addEventListener('click', switchToMapView);
        listViewBtn.addEventListener('click', switchToListView);

        // ===== FLOOR BUTTONS =====
        document.querySelectorAll('.floor-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.floor-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFloorMap = this.dataset.floor;
                const floorValue = currentFloorMap === 'floor1' ? '1st Floor' : '2nd Floor';
                document.getElementById('floorFilter').value = floorValue;
                showToast(`Showing ${floorValue}`, 'info', 2000);
                updateMapView();
                filterTenants();
            });
        });

        // ===== 3D TILT EFFECT FOR CARDS =====
        function applyTiltEffect() {
            const cards = document.querySelectorAll('.tenant-card');

            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const cardRect = card.getBoundingClientRect();
                    const x = e.clientX - cardRect.left;
                    const y = e.clientY - cardRect.top;

                    const centerX = cardRect.width / 2;
                    const centerY = cardRect.height / 2;

                    const rotateY = (x - centerX) / 25; // Reduced sensitivity
                    const rotateX = (centerY - y) / 25; // Reduced sensitivity

                    card.style.transform =
                        `translateY(-12px) scale(1.03) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    card.style.transition = 'transform 0.1s ease';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(-8px) scale(1.02)';
                    card.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });
        }

        // ===== SHIMMER LOADING =====
        function showShimmerCards() {
            const tenantGrid = document.getElementById('tenantGrid');
            tenantGrid.innerHTML = '';

            // Create shimmer cards
            for (let i = 0; i < 6; i++) {
                const shimmerCard = document.createElement('div');
                shimmerCard.className = 'tenant-card shimmer';
                shimmerCard.innerHTML = `
                    <div class="tenant-logo shimmer" style="height: 200px;"></div>
                    <div class="tenant-info" style="padding: 25px;">
                        <div class="floor-badge shimmer" style="width: 80px; height: 20px; border-radius: 10px; margin-bottom: 15px;"></div>
                        <div class="shimmer" style="height: 24px; width: 70%; border-radius: 4px; margin-bottom: 10px;"></div>
                        <div class="shimmer" style="height: 16px; width: 100%; border-radius: 4px; margin-bottom: 14px;"></div>
                        <div class="tenant-meta" style="display: flex; gap: 14px; margin-bottom: 18px;">
                            <div class="meta-item shimmer" style="height: 16px; width: 60px; border-radius: 4px;"></div>
                            <div class="meta-item shimmer" style="height: 16px; width: 60px; border-radius: 4px;"></div>
                        </div>
                        <div class="see-details-btn shimmer" style="height: 40px; border-radius: 10px;"></div>
                    </div>
                `;
                tenantGrid.appendChild(shimmerCard);
            }
        }

        // ===== MOBILE SWIPE AND PULL TO REFRESH =====
        let startY = 0;
        let currentY = 0;
        let isPulling = false;

        // Pull to refresh functionality
        function initPullToRefresh() {
            const mainContent = document.querySelector('.main-content');
            if (!mainContent) return;

            // Add pull down indicator
            const pullIndicator = document.createElement('div');
            pullIndicator.className = 'pull-down-indicator';
            pullIndicator.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                </svg>
                <span style="margin-left: 8px;">Pull to refresh</span>
            `;
            mainContent.insertBefore(pullIndicator, mainContent.firstChild);

            // Touch events for pull to refresh
            mainContent.addEventListener('touchstart', (e) => {
                startY = e.touches[0].pageY;
                isPulling = true;
            }, {
                passive: true
            });

            mainContent.addEventListener('touchmove', (e) => {
                if (!isPulling) return;

                currentY = e.touches[0].pageY;
                const diffY = currentY - startY;

                // Only allow pull down if at the top of the page
                if (window.scrollY === 0 && diffY > 0) {
                    e.preventDefault();
                    pullIndicator.style.top = `${Math.min(diffY / 2, 40) - 40}px`;

                    if (diffY > 80) {
                        pullIndicator.querySelector('svg').style.transform = 'rotate(180deg)';
                        pullIndicator.innerHTML = `
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform: rotate(180deg);">
                                <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                            </svg>
                            <span style="margin-left: 8px;">Release to refresh</span>
                        `;
                    } else {
                        pullIndicator.querySelector('svg').style.transform = 'rotate(0deg)';
                        pullIndicator.innerHTML = `
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 13l3 3 3-3m0-6l-3-3-3 3"/>
                            </svg>
                            <span style="margin-left: 8px;">Pull to refresh</span>
                        `;
                    }
                }
            }, {
                passive: false
            });

            mainContent.addEventListener('touchend', () => {
                if (!isPulling) return;

                const diffY = currentY - startY;

                if (diffY > 80) {
                    // Trigger refresh
                    pullIndicator.querySelector('span').textContent = 'Refreshing...';
                    pullIndicator.querySelector('svg').style.transform = 'rotate(180deg)';
                    pullIndicator.classList.add('refreshing');

                    // Hide indicator and refresh data
                    setTimeout(() => {
                        pullIndicator.style.top = '-40px';
                        pullIndicator.classList.remove('refreshing');

                        // Re-render the page
                        showLoading();
                        showShimmerCards();
                        setTimeout(() => {
                            renderTenants(tenants);
                            setTimeout(() => {
                                applyTiltEffect();
                                hideLoading();
                            }, 100);
                        }, 800);
                    }, 1000);
                } else {
                    // Reset indicator position
                    pullIndicator.style.top = '-40px';
                }

                isPulling = false;
            }, {
                passive: true
            });
        }

        // Swipe gesture functionality for mobile
        function initSwipeGestures() {
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            document.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipeGesture();
            }, {
                passive: true
            });

            function handleSwipeGesture() {
                const minSwipeDistance = 50;
                const swipeDistance = touchStartX - touchEndX;

                if (Math.abs(swipeDistance) > minSwipeDistance) {
                    if (swipeDistance > 0) {
                        // Swipe left - could implement navigation to next page
                        console.log('Swiped left');
                    } else {
                        // Swipe right - could implement navigation to previous page
                        console.log('Swiped right');
                    }
                }
            }
        }

        // ===== INITIAL RENDER =====
        document.addEventListener('DOMContentLoaded', () => {
            // Set default floor to 1st Floor
            document.getElementById('floorFilter').value = '1st Floor';

            showLoading(); // Show loading overlay initially
            showShimmerCards(); // Show shimmer cards first
            setTimeout(() => {
                renderTenants(tenants); // Then render actual tenants
                setTimeout(() => {
                    applyTiltEffect(); // Apply tilt effect after cards are rendered
                    hideLoading(); // Hide loading overlay after everything is ready
                    initPullToRefresh(); // Initialize pull to refresh
                    initSwipeGestures(); // Initialize swipe gestures

                    // Add event listeners for search inputs
                    const searchInput = document.getElementById('searchInput');
                    const headerSearch = document.getElementById('headerSearch');
                    const sidebarSearch = document.getElementById('sidebarSearch');

                    if (searchInput) {
                        searchInput.addEventListener('input', filterTenants);
                    }
                    if (headerSearch) {
                        headerSearch.addEventListener('input', filterTenants);
                    }
                    if (sidebarSearch) {
                        sidebarSearch.addEventListener('input', filterTenants);
                    }

                    // Add event listeners for filters
                    document.getElementById('floorFilter').addEventListener('change', filterTenants);
                    document.getElementById('categoryFilter').addEventListener('change', filterTenants);

                    // Add modal close event listeners
                    const modalCloseBtn = document.getElementById('modalCloseBtn');
                    const modalOverlay = document.getElementById('modalOverlay');

                    if (modalCloseBtn) {
                        modalCloseBtn.addEventListener('click', closeTenantModal);
                    }

                    if (modalOverlay) {
                        modalOverlay.addEventListener('click', closeTenantModal);
                    }

                    // ===== INITIALIZE BATCH 1 FEATURES =====
                    // Initialize keyboard shortcuts
                    initKeyboardShortcuts();

                    // Add favorites button to sidebar
                    const filterBody = document.querySelector('.filter-body');
                    if (filterBody) {
                        const template = document.getElementById('favoritesButtonTemplate');
                        if (template) {
                            const favBtn = template.content.cloneNode(true);
                            filterBody.insertBefore(favBtn, filterBody.firstChild);

                            // Add click handler
                            setTimeout(() => {
                                const btn = document.getElementById('favoritesFilterBtn');
                                if (btn) {
                                    btn.addEventListener('click', filterFavorites);
                                }
                            }, 100);
                        }
                    }

                    // Update favorites UI
                    updateFavoritesUI();

                    // Add keyboard shortcut hint to search input
                    if (searchInput) {
                        searchInput.placeholder = 'Search stores... (Press / to focus, ? for shortcuts)';
                    }

                    // Add click handler for shortcuts hint button
                    const shortcutsHintBtn = document.getElementById('shortcutsHintBtn');
                    if (shortcutsHintBtn) {
                        shortcutsHintBtn.addEventListener('click', () => {
                            document.getElementById('shortcutsModal').classList.add('active');
                        });
                    }

                    // ===== INITIALIZE BATCH 2 FEATURES =====
                    // Initialize recent searches
                    updateRecentSearchesUI();

                    // Add search input handlers for recent searches
                    if (searchInput) {
                        searchInput.addEventListener('focus', () => {
                            const dropdown = document.getElementById('recentSearchesDropdown');
                            if (dropdown && getRecentSearches().length > 0) {
                                dropdown.classList.add('show');
                            }
                        });

                        searchInput.addEventListener('blur', () => {
                            setTimeout(() => {
                                document.getElementById('recentSearchesDropdown').classList.remove('show');
                            }, 200);
                        });

                        // Save search when user presses Enter
                        searchInput.addEventListener('keypress', (e) => {
                            if (e.key === 'Enter' && searchInput.value.trim()) {
                                addRecentSearch(searchInput.value.trim());
                            }
                        });
                    }

                    // Clear history button
                    const clearHistoryBtn = document.getElementById('clearHistoryBtn');
                    if (clearHistoryBtn) {
                        clearHistoryBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            clearRecentSearches();
                        });
                    }

                    // Share menu handlers
                    document.getElementById('shareCopyLink')?.addEventListener('click', () => shareStore('copy'));
                    document.getElementById('shareWhatsApp')?.addEventListener('click', () => shareStore('whatsapp'));
                    document.getElementById('shareFacebook')?.addEventListener('click', () => shareStore('facebook'));
                    document.getElementById('shareTwitter')?.addEventListener('click', () => shareStore('twitter'));

                    // Switch to map view by default and show 1st floor
                    switchToMapView();
                }, 100);
            }, 800); // Small delay to show shimmer effect
        });

        // ===== RIPPLE EFFECT =====
        const buttons = document.querySelectorAll('button:not(#darkModeToggle)');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute; width: ${size}px; height: ${size}px; border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5); left: ${x}px; top: ${y}px;
                    pointer-events: none; animation: ripple 0.6s ease-out;
                `;

                const currentPosition = window.getComputedStyle(this).position;
                if (currentPosition === 'static') this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                from { transform: scale(0); opacity: 1; }
                to { transform: scale(2); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // ===== PAGE LOADER =====
        const pageLoader = document.getElementById('pageLoader');

        // Ensure loader shows first
        let minLoadTime = 2500; // Minimum 2.5 seconds
        let loadStartTime = Date.now();

        window.addEventListener('load', () => {
            let loadTime = Date.now() - loadStartTime;
            let remainingTime = Math.max(0, minLoadTime - loadTime);

            // Hide loader after ensuring minimum display time
            setTimeout(() => {
                pageLoader.classList.add('hidden');
                document.body.classList.add('loaded');
            }, remainingTime);
        });
