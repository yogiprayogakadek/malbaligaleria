<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Directory - Mal Bali Galeria</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/directory/style.css')}}?v={{ time() }}">
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <div class="loader-logo-circle">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                        onerror="this.style.display='none'">
                </div>
                <h1>mal bali galeria</h1>
                <span>SHOPPING CENTER</span>
            </div>
            <div class="loader-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
            <div class="loader-progress">
                <div class="progress-bar"></div>
            </div>
            <p class="loader-text">LOADING...</p>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
        <svg class="moon-icon" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
        <svg class="sun-icon" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="5" />
            <line x1="12" y1="1" x2="12" y2="3" stroke="currentColor" stroke-width="2" />
            <line x1="12" y1="21" x2="12" y2="23" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" />
            <line x1="1" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="21" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" />
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" />
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor" stroke-width="2" />
        </svg>
    </button>

    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="header-logo-link header-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" style="height: 30px; width: auto;">
            </a>
        </div>

        <div class="logo">
            <h1>mal bali galeria<span>SHOPPING CENTER</span></h1>
        </div>

        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Toastr Notification -->
    <div class="toastr" id="toastr">
        <div class="toastr-icon">✓</div>
        <div class="toastr-content">
            <h4>Success</h4>
            <p>Action completed successfully</p>
        </div>
        <button class="toastr-close" id="toastrClose">×</button>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>mal bali galeria<span>SHOPPING CENTER</span></h2>
        </div>

        <button class="sidebar-close" id="sidebarClose">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#tenants">Tenants</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#" onclick="event.preventDefault(); enableCoordinatePicker();">📍 Get
                        Coordinates</a></li>
            </ul>
        </nav>

        <!-- Search in Sidebar for Mobile -->
        <div class="sidebar-search">
            <div class="search-bar" style="position: relative;">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Search" id="sidebarSearch">
                <div class="search-suggestions" id="sidebarSearchSuggestions"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Tenant Directory</h1>
                <p>Discover our collection of premium brands and stores</p>
            </div>

            <!-- Content Layout -->
            <div class="content-layout">
                <!-- Filter Sidebar -->
                <aside class="filter-sidebar">
                    <div class="filter-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            Filter & Search
                        </h3>
                        <p>Find your perfect store</p>
                    </div>

                    <div class="filter-body">
                        <!-- View Toggle -->
                        <div class="view-toggle">
                            <button class="view-btn" id="mapViewBtn">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z" />
                                </svg>
                                Map
                            </button>
                            <button class="view-btn active" id="listViewBtn">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="3" y="4" width="18" height="4" rx="1" />
                                    <rect x="3" y="10" width="18" height="4" rx="1" />
                                    <rect x="3" y="16" width="18" height="4" rx="1" />
                                </svg>
                                List
                            </button>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Search Filter -->
                        <div class="filter-group">
                            <label>Search Tenant</label>
                            <div class="filter-input" style="position: relative;">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                                    <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                <input type="text" placeholder="Type to search..." id="searchInput">
                                <div class="search-suggestions" id="searchInputSuggestions"></div>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Floor Filter -->
                        <div class="filter-group">
                            <label>Floor Level</label>
                            <div class="filter-input styled-select">
                                <select id="floorFilter">
                                    <option value="1st Floor">1st Floor</option>
                                    <option value="2nd Floor">2nd Floor</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Category Filter -->
                        <div class="filter-group">
                            <label>Categories</label>
                            <div class="filter-input styled-select">
                                <select id="categoryFilter">
                                    <option value="">All Categories</option>
                                    <option value="Fashion & Apparel">Fashion & Apparel</option>
                                    <option value="Fashion & Accessories">Fashion & Accessories</option>
                                    <option value="Beauty & Health">Beauty & Health</option>
                                    <option value="Jewelry & Watches">Jewelry & Watches</option>
                                    <option value="Food & Beverage">Food & Beverage</option>
                                    <option value="Home & Lifestyle">Home & Lifestyle</option>
                                    <option value="Department Store">Department Store</option>
                                    <option value="Supermarket">Supermarket</option>
                                    <option value="Books & Stationery">Books & Stationery</option>
                                </select>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="filter-stats">
                            <div class="filter-stats-number" id="tenantCount">17</div>
                            <div class="filter-stats-label">Tenants Found</div>
                        </div>

                        <!-- Tenant List in Map View -->
                        <div id="mapTenantList" style="display: none; margin-top: 25px;">
                            <div class="filter-divider"></div>
                            <label
                                style="font-size: 11px; font-weight: 700; color: #2c3e50; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 15px;">Stores
                                on Map</label>
                            <div id="tenantListItems" style="max-height: 400px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </aside>

                <!-- Tenant Content -->
                <div class="tenant-content">
                    <!-- Tenant Grid -->
                    <div class="tenant-grid" id="tenantGrid">
                        <!-- Tenants will be dynamically inserted here -->
                    </div>

                    <!-- Map View -->
                    <div id="mapView">
                        <div class="map-header">
                            <h3>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z" />
                                </svg>
                                Interactive Mall Map
                            </h3>
                            <p>Select a floor to view store locations</p>
                        </div>

                        <div class="map-body">
                            <div class="floor-selector">
                                <button class="floor-btn active" data-floor="floor1">1st Floor</button>
                                <button class="floor-btn" data-floor="floor2">2nd Floor</button>
                            </div>

                            <div class="map-container" id="mapContainer">
                                <div style="text-align: center; padding: 40px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#5fcfda" stroke-width="2"
                                        style="width: 60px; height: 60px; margin: 0 auto 20px;">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <p style="color: #666; font-size: 16px; margin: 0;">Loading mall map...</p>
                                </div>
                            </div>

                            <div class="map-legend">
                                <h4>Map Legend</h4>
                                <div class="legend-grid">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #ff6b9d;"></div>
                                        <span class="legend-text">Fashion & Apparel</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #c8a2c8;"></div>
                                        <span class="legend-text">Fashion & Accessories</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #4a90e2;"></div>
                                        <span class="legend-text">Department Store</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #f4d03f;"></div>
                                        <span class="legend-text">Supermarket</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background: #7cb342;"></div>
                                        <span class="legend-text">Food & Beverage</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div class="empty-state" id="emptyState">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" />
                        </svg>
                        <h3>No tenants found</h3>
                        <p>Try adjusting your search or filter criteria</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tenant Details Modal -->
    <div class="tenant-modal" id="tenantModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-container">
            <!-- Close Button -->
            <button class="modal-close-btn" id="modalCloseBtn" aria-label="Close Modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

            <!-- Favorite Button in Modal -->
            <button class="favorite-btn" id="modalFavoriteBtn" data-unit="">
                <svg viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>

            <!-- Share Button in Modal -->
            <button class="share-btn" id="modalShareBtn" title="Share Store">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                </svg>
            </button>

            <div class="modal-content">
                <!-- Modal Carousel -->
                <div class="modal-carousel">
                    <!-- Swipe Hint -->
                    <div class="carousel-swipe-hint" id="carouselSwipeHint">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Swipe to browse
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </div>

                    <div class="carousel-images" id="modalCarouselImages">
                        <!-- Images will be inserted here dynamically -->
                    </div>

                    <button class="carousel-nav prev" id="modalCarouselPrev">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="carousel-nav next" id="modalCarouselNext">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>

                    <div class="carousel-indicators" id="modalCarouselIndicators">
                        <!-- Indicators will be inserted here dynamically -->
                    </div>
                </div>

                <!-- Modal Details -->
                <div class="modal-details">
                    <div class="modal-header">
                        <div class="modal-logo" id="modalLogo">
                            <!-- Logo will be inserted here -->
                        </div>
                        <div class="modal-title">
                            <span class="modal-floor-badge" id="modalFloorBadge"></span>
                            <h2 id="modalTenantName"></h2>
                            <div class="modal-category" id="modalCategory">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                                </svg>
                                <span id="modalCategoryText"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-info">
                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <div>
                                <span class="info-label">Operating Hours</span>
                                <span class="info-value" id="modalHours"></span>
                            </div>
                        </div>

                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <span class="info-label">Location</span>
                                <span class="info-value" id="modalLocation"></span>
                            </div>
                        </div>

                        <div class="modal-info-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <line x1="9" y1="3" x2="9" y2="21"/>
                            </svg>
                            <div>
                                <span class="info-label">Unit Number</span>
                                <span class="info-value" id="modalUnit"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-description" id="modalDescriptionContainer" style="display: none;">
                        <p id="modalDescription"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- Keyboard Shortcuts Help Modal -->
    <div class="shortcuts-modal" id="shortcutsModal">
        <div class="shortcuts-overlay" onclick="document.getElementById('shortcutsModal').classList.remove('active')"></div>
        <div class="shortcuts-container">
            <div class="shortcuts-header">
                <h3>⌨️ Keyboard Shortcuts</h3>
                <button class="shortcuts-close" onclick="document.getElementById('shortcutsModal').classList.remove('active')">×</button>
            </div>
            <div class="shortcuts-body">
                <div class="shortcut-item">
                    <kbd>/</kbd>
                    <span>Focus search box</span>
                </div>
                <div class="shortcut-item">
                    <kbd>ESC</kbd>
                    <span>Close modal / Clear search</span>
                </div>
                <div class="shortcut-item">
                    <kbd>↑</kbd> <kbd>↓</kbd>
                    <span>Navigate tenant cards</span>
                </div>
                <div class="shortcut-item">
                    <kbd>CTRL</kbd> + <kbd>M</kbd>
                    <span>Toggle Map/List view</span>
                </div>
                <div class="shortcut-item">
                    <kbd>?</kbd>
                    <span>Show this help</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Favorites Filter Button (will be added to sidebar dynamically) -->
    <template id="favoritesButtonTemplate">
        <button class="favorites-filter-btn" id="favoritesFilterBtn" title="Show Favorites">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span class="favorites-count">0</span>
        </button>
    </template>

    <!-- Keyboard Shortcuts Hint Button (Desktop Only) -->
    <button class="shortcuts-hint-btn" id="shortcutsHintBtn" title="Keyboard Shortcuts (Press ?)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="4" width="20" height="16" rx="2"/>
            <path d="M6 8h.01M10 8h.01M14 8h.01M6 12h.01M10 12h.01M14 12h.01M6 16h.01M10 16h.01M14 16h.01"/>
        </svg>
        <span>?</span>
    </button>

    <!-- Recent Searches Dropdown -->
    <div class="recent-searches-dropdown" id="recentSearchesDropdown">
        <div class="recent-searches-header">
            <span>Recent Searches</span>
            <button class="clear-history-btn" id="clearHistoryBtn" title="Clear History">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                </svg>
            </button>
        </div>
        <div class="recent-searches-list" id="recentSearchesList">
            <!-- Recent searches will be inserted here -->
        </div>
    </div>

    <!-- Share Menu (will be added to modal dynamically) -->
    <div class="share-menu" id="shareMenu">
        <div class="share-menu-overlay" onclick="document.getElementById('shareMenu').classList.remove('active')"></div>
        <div class="share-menu-container">
            <div class="share-menu-header">
                <h4>Share Store</h4>
                <button class="share-menu-close" onclick="document.getElementById('shareMenu').classList.remove('active')">×</button>
            </div>
            <div class="share-menu-body">
                <button class="share-option" id="shareCopyLink">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                    </svg>
                    <span>Copy Link</span>
                </button>
                <button class="share-option" id="shareWhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span>WhatsApp</span>
                </button>
                <button class="share-option" id="shareFacebook">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>Facebook</span>
                </button>
                <button class="share-option" id="shareTwitter">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                    <span>Twitter</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <!-- About Column -->
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

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#tenants">Store Directory</a></li>
                        <li><a href="#experience">Experiences</a></li>
                        <li><a href="#events">Events</a></li>
                        <li><a href="#career">Careers</a></li>
                    </ul>
                </div>

                <!-- Services -->
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

                <!-- Contact -->
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

    <script src="{{ asset('assets/frontend/js/directory/directory.js') }}"></script>
</body>

</html>
