async function loadPromotions()
{
    try {
        promotionData = await $.get("/promotion/load-promotion");
        return promotionData;
    } catch (error) {
        console.error("Failed to load data", error);
    }
}

// ===== STATE MANAGEMENT =====
let currentFilter = 'all';
let currentCategoryFilter = 'all';
let displayedPromotions = [];
let itemsPerPage = 6;
let currentPage = 1;
let favorites = JSON.parse(localStorage.getItem('promoFavorites')) || [];
let currentSort = 'newest';
let currentView = 'grid';

// ===== MODAL STATE =====
let currentModalCarouselIndex = 0;
let modalCarouselImages = [];
let modalSwipeStartX = 0;
let modalSwipeEndX = 0;

// ===== HELPER FUNCTIONS =====
function saveFavorites() {
    localStorage.setItem('promoFavorites', JSON.stringify(favorites));
    updateFavoritesCount();
}

function updateFavoritesCount() {
    const countEl = document.getElementById('favoritesCount');
    if (countEl) {
        countEl.textContent = `${favorites.length} items`;
    }
}

function isFavorite(id) {
    return favorites.includes(id);
}

function toggleFavorite(id) {
    if (favorites.includes(id)) {
        favorites = favorites.filter(favId => favId !== id);
        showToast('Removed from favorites', 'info');
    } else {
        favorites.push(id);
        showToast('Added to favorites', 'success');
    }
    saveFavorites();

    // Re-render if currently viewing favorites to remove the item immediately
    if (currentCategoryFilter === 'favorites' || document.querySelector('.tenant-filter-item[data-filter-type="favorites"].active')) {
        renderPromotions(currentFilter, 'favorites');
    } else {
        // Just update the button state in the current view
        updateFavoriteButtonState(id);
    }
}

function updateFavoriteButtonState(id) {
    const btn = document.querySelector(`.bookmark-btn[data-promo-id="${id}"]`);
    if (btn) {
        if (isFavorite(id)) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    }
}

// ===== HELPER FUNCTIONS =====
function isNewPromotion(createdAt) {
    const created = new Date(createdAt);
    const now = new Date();
    const daysDiff = (now - created) / (1000 * 60 * 60 * 24);
    return daysDiff <= 7;
}

function isEndingSoon(validUntil) {
    const endDate = new Date(validUntil);
    const now = new Date();
    const daysDiff = (endDate - now) / (1000 * 60 * 60 * 24);
    return daysDiff > 0 && daysDiff <= 7;
}

function getPromotionBadges(promo) {
    const badges = [];
    if (isNewPromotion(promo.createdAt)) {
        badges.push({ type: 'new', label: 'New' });
    }
    if (isEndingSoon(promo.validUntil)) {
        badges.push({ type: 'ending-soon', label: 'Ending Soon' });
    }
    return badges;
}

// ===== PAGE LOADER =====
const pageLoader = document.getElementById("pageLoader");
let minLoadTime = 1500;
let loadStartTime = Date.now();

window.addEventListener("load", () => {
    let loadTime = Date.now() - loadStartTime;
    let remainingTime = Math.max(0, minLoadTime - loadTime);

    setTimeout(() => {
        if (pageLoader) {
            pageLoader.classList.add("hidden");
            document.body.classList.add("loaded");
            setTimeout(() => {
                pageLoader.style.display = "none";
            }, 500);
        }
    }, remainingTime);
});

// Fallback
setTimeout(() => {
    if (!document.body.classList.contains("loaded")) {
        if (pageLoader) {
            pageLoader.classList.add("hidden");
            document.body.classList.add("loaded");
            setTimeout(() => {
                pageLoader.style.display = "none";
            }, 500);
        }
    }
}, 3000);

// ===== MENU TOGGLE =====
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const sidebarClose = document.getElementById("sidebarClose");

if (menuBtn && sidebar) {
    menuBtn.addEventListener("click", () => {
        menuBtn.classList.toggle("active");
        sidebar.classList.toggle("active");
        document.body.classList.toggle("menu-open");
    });
}

if (sidebarClose && sidebar) {
    sidebarClose.addEventListener("click", () => {
        if (menuBtn) menuBtn.classList.remove("active");
        sidebar.classList.remove("active");
        document.body.classList.remove("menu-open");
    });
}

// Close sidebar when clicking on a link
if (sidebar) {
    const sidebarLinks = sidebar.querySelectorAll("a");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", () => {
            if (menuBtn) menuBtn.classList.remove("active");
            sidebar.classList.remove("active");
            document.body.classList.remove("menu-open");
        });
    });
}

// ===== DARK MODE TOGGLE =====
const darkModeToggle = document.getElementById("darkModeToggle");

if (localStorage.getItem("darkMode") === "enabled") {
    document.body.classList.add("dark-mode");
}

if (darkModeToggle) {
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
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    initializePage();
    setupEventListeners();
});

function initializePage() {
    showShimmerCards();
    updateFavoritesCount();

    setTimeout(() => {
        populateCategoryFilter();
        populateTenantFilter();
        renderPromotions('all');
        setupScrollToTop();
    }, 800);
}

// ===== CATEGORY FILTER =====
async function populateCategoryFilter() {
    const promoData = await loadPromotions();
    const categoryChips = document.getElementById('categoryFilterChips');
    if (!categoryChips) return;

    const categoryMap = new Map();
    promoData.forEach(promo => {
        if (categoryMap.has(promo.category)) {
            categoryMap.get(promo.category).count++;
        } else {
            categoryMap.set(promo.category, { count: 1 });
        }
    });

    let html = `
        <div class="category-chip active" data-category="all">
            All <span class="category-chip-count">${promoData.length}</span>
        </div>
    `;

    categoryMap.forEach((data, category) => {
        html += `
            <div class="category-chip" data-category="${category}">
                ${category} <span class="category-chip-count">${data.count}</span>
            </div>
        `;
    });

    categoryChips.innerHTML = html;
}

// ===== TENANT FILTER =====
async function populateTenantFilter() {
    const tenantList = document.getElementById('tenantFilterList');
    const promoData = await loadPromotions();
    if (!tenantList) return;

    const tenantMap = new Map();
    promoData.forEach(promo => {
        if (tenantMap.has(promo.tenant)) {
            tenantMap.get(promo.tenant).count++;
        } else {
            tenantMap.set(promo.tenant, {
                name: promo.tenant,
                logo: promo.tenantLogo,
                count: 1
            });
        }
    });

    const allPromoCount = document.getElementById('allPromoCount');
    if (allPromoCount) {
        allPromoCount.textContent = `${promoData.length} promos`;
    }

    let html = '';
    tenantMap.forEach((data, tenant) => {
        html += `
            <div class="tenant-filter-item" data-tenant="${tenant}">
                <div class="tenant-filter-icon">
                    <img src="${data.logo}" alt="${data.name}">
                </div>
                <div class="tenant-filter-info">
                    <h4>${data.name}</h4>
                    <span class="promo-count">${data.count} promo${data.count > 1 ? 's' : ''}</span>
                </div>
            </div>
        `;
    });

    tenantList.innerHTML = html;
}

// ===== RENDER PROMOTIONS =====
async function renderPromotions(filter = 'all', category = 'all') {
    // If selecting favorites, force reset tenant filter to 'all' for logic
    const promoData = await loadPromotions();
    if (category === 'favorites') {
        currentCategoryFilter = 'favorites';
        currentFilter = 'all'; // Reset tenant filter internally
    } else {
        currentFilter = filter;
        if (category !== undefined) {
            currentCategoryFilter = category;
        }
    }

    currentPage = 1;

    let filtered = promoData;

    // Apply category & favorites filter first
    if (currentCategoryFilter === 'favorites') {
        filtered = filtered.filter(p => isFavorite(p.id));
        updateActiveCategoryOrFavorite('favorites');
    } else {
        // Apply tenant filter if not in favorites mode
        if (currentFilter !== 'all') {
            filtered = filtered.filter(p => p.tenant === currentFilter);
        }

        if (currentCategoryFilter !== 'all') {
            filtered = filtered.filter(p => p.category === currentCategoryFilter);
            updateActiveCategoryOrFavorite(currentCategoryFilter);
        } else {
            updateActiveCategoryOrFavorite('all');
        }
    }

    // Apply Sorting
    filtered.sort((a, b) => {
        if (currentSort === 'newest') {
            return new Date(b.createdAt) - new Date(a.createdAt);
        } else if (currentSort === 'ending_soon') {
            return new Date(a.validUntil) - new Date(b.validUntil);
        } else if (currentSort === 'title_asc') {
            return a.title.localeCompare(b.title);
        }
        return 0;
    });

    displayedPromotions = filtered;

    updateActiveFilter(filter);
    displayPromotions();
}

function updateActiveCategoryOrFavorite(activeId) {
    // Categories
    document.querySelectorAll('.category-chip').forEach(chip => {
        if (chip.dataset.category === activeId) {
            chip.classList.add('active');
        } else {
            chip.classList.remove('active');
        }
    });

    // Favorites Filter Item
    const favFilter = document.getElementById('favoritesFilter');
    if (favFilter) {
        if (activeId === 'favorites') {
            favFilter.classList.add('active');
            // Deactivate tenant filters visually if favorites selected
            document.querySelectorAll('.tenant-filter-item').forEach(i => i.classList.remove('active'));
            favFilter.classList.add('active');
        } else {
            favFilter.classList.remove('active');
        }
    }
}

function updateActiveFilter(filter) {
    document.querySelectorAll('.tenant-filter-item').forEach(item => {
        if (item.dataset.tenant === filter) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

async function displayPromotions() {
    const grid = document.getElementById('promotionGrid');
    const emptyState = document.getElementById('emptyState');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const promoData = await loadPromotions();

    if (!grid) return;

    const itemsToShow = currentPage * itemsPerPage;
    const visiblePromotions = displayedPromotions.slice(0, itemsToShow);

    if (visiblePromotions.length === 0) {
        grid.innerHTML = '';
        if (emptyState) emptyState.style.display = 'block';
        if (loadMoreContainer) loadMoreContainer.style.display = 'none';
        return;
    }

    if (emptyState) emptyState.style.display = 'none';

    // Apply view mode class
    if (currentView === 'list') {
        grid.classList.add('list-view');
    } else {
        grid.classList.remove('list-view');
    }

    grid.innerHTML = visiblePromotions.map((promo, index) => {
        const badges = getPromotionBadges(promo);
        const badgesHTML = badges.length > 0 ? `
            <div class="status-badges">
                ${badges.map(badge => `
                    <span class="status-badge ${badge.type}">${badge.label}</span>
                `).join('')}
            </div>
        ` : '';

        const isFav = isFavorite(promo.id);

        return `
        <div class="promotion-card" data-promo-id="${promo.id}" style="animation-delay: ${index * 0.1}s">
            <div class="promotion-image" style="background-image: url('${promo.images[0]}')">
                ${badgesHTML}
                <button class="bookmark-btn ${isFav ? 'active' : ''}" data-promo-id="${promo.id}" aria-label="Bookmark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                    </svg>
                </button>
                <button class="share-btn" data-promo-id="${promo.id}" data-promo-title="${promo.title}" aria-label="Share">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="18" cy="5" r="3"/>
                        <circle cx="6" cy="12" r="3"/>
                        <circle cx="18" cy="19" r="3"/>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                    </svg>
                </button>
                <span class="promotion-badge">PROMO</span>
                <div class="tenant-logo-badge">
                    <img src="${promo.tenantLogo}" alt="${promo.tenant}">
                </div>
            </div>
            <div class="promotion-info">
                <h3>${promo.title}</h3>
                <p class="promotion-tenant">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4zm10 15H4V9h16v10z"/>
                    </svg>
                    ${promo.tenant}
                </p>
                <div class="promotion-validity">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Valid until ${formatDate(promo.validUntil)}
                </div>
                <p class="promotion-description">${promo.description}</p>
                <button class="view-details-btn">
                    View Details
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    `}).join('');

    if (loadMoreContainer) {
        if (visiblePromotions.length < displayedPromotions.length) {
            loadMoreContainer.style.display = 'block';
        } else {
            loadMoreContainer.style.display = 'none';
        }
    }

    setTimeout(() => {
        document.querySelectorAll('.promotion-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.share-btn') && !e.target.closest('.bookmark-btn')) {
                    const promoId = parseInt(card.dataset.promoId);
                    const promo = promoData.find(p => p.id === promoId);
                    if (promo) showPromotionModal(promo);
                }
            });
        });

        // Share button event listeners
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const promoId = parseInt(btn.dataset.promoId);
                const promoTitle = btn.dataset.promoTitle;
                sharePromotion(promoId, promoTitle);
            });
        });

        // Bookmark button event listeners
        document.querySelectorAll('.bookmark-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const promoId = parseInt(btn.dataset.promoId);
                toggleFavorite(promoId);
            });
        });
    }, 100);
}

// ===== SCROLL TO TOP =====
function setupScrollToTop() {
    const scrollBtn = document.getElementById('scrollToTop');
    if (!scrollBtn) return;

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ===== SHARE FUNCTION =====
function sharePromotion(promoId, promoTitle) {
    const url = `${window.location.origin}${window.location.pathname}?promo=${promoId}`;

    if (navigator.share) {
        navigator.share({
            title: promoTitle,
            text: `Check out this promotion: ${promoTitle}`,
            url: url
        }).catch(() => {
            copyToClipboard(url);
        });
    } else {
        copyToClipboard(url);
    }
}

function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('Link copied to clipboard!', 'success');
        });
    } else {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        showToast('Link copied to clipboard!', 'success');
    }
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;

    // Icon based on type
    let icon = '';
    if (type === 'success') {
        icon = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>';
    } else if (type === 'error') {
        icon = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';
    } else {
        icon = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';
    }

    toast.innerHTML = `${icon}<span>${message}</span>`;
    document.body.appendChild(toast);

    // Trigger reflow
    toast.offsetHeight;

    toast.classList.add('active');

    setTimeout(() => {
        toast.classList.remove('active');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

function loadMorePromotions() {
    currentPage++;
    displayPromotions();
}

// ===== SHIMMER LOADING =====
function showShimmerCards() {
    const grid = document.getElementById('promotionGrid');
    if (!grid) return;

    grid.innerHTML = '';
    for (let i = 0; i < 6; i++) {
        const shimmerCard = document.createElement('div');
        shimmerCard.className = 'promotion-card shimmer';
        shimmerCard.innerHTML = `
            <div class="promotion-image shimmer" style="height: 250px;"></div>
            <div class="promotion-info" style="padding: 25px;">
                <div class="shimmer" style="height: 24px; width: 80%; border-radius: 4px; margin-bottom: 10px;"></div>
                <div class="shimmer" style="height: 16px; width: 50%; border-radius: 4px; margin-bottom: 12px;"></div>
                <div class="shimmer" style="height: 14px; width: 40%; border-radius: 4px; margin-bottom: 15px;"></div>
                <div class="shimmer" style="height: 60px; width: 100%; border-radius: 4px; margin-bottom: 18px;"></div>
                <div class="shimmer" style="height: 40px; border-radius: 10px;"></div>
            </div>
        `;
        grid.appendChild(shimmerCard);
    }
}

// ===== MODAL FUNCTIONS =====
function showPromotionModal(promo) {
    const modal = document.getElementById('promotionModal');
    if (!modal) return;

    document.getElementById('modalPromoTitle').textContent = promo.title;
    document.getElementById('modalTenantName').textContent = promo.tenant;
    document.getElementById('modalValidPeriod').textContent = `${formatDate(promo.validFrom)} - ${formatDate(promo.validUntil)}`;
    document.getElementById('modalLocation').textContent = `${promo.floor}, Unit ${promo.unit}`;

    const modalLogo = document.getElementById('modalLogo');
    modalLogo.innerHTML = `<img src="${promo.tenantLogo}" alt="${promo.tenant}">`;

    const modalDescription = document.getElementById('modalDescription');
    modalDescription.innerHTML = `<p>${promo.description}</p>`;

    modalCarouselImages = promo.images;
    currentModalCarouselIndex = 0;
    updateModalCarousel();

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
        const hint = document.getElementById('carouselSwipeHint');
        if (hint) hint.classList.add('hidden');
    }, 3000);
}

function closePromotionModal() {
    const modal = document.getElementById('promotionModal');
    if (!modal) return;

    modal.classList.remove('active');
    document.body.style.overflow = '';

    const hint = document.getElementById('carouselSwipeHint');
    if (hint) hint.classList.remove('hidden');
}

function updateModalCarousel() {
    const carouselContainer = document.getElementById('modalCarouselImages');
    const indicatorsContainer = document.getElementById('modalCarouselIndicators');

    if (!carouselContainer || !indicatorsContainer) return;

    carouselContainer.innerHTML = modalCarouselImages.map(img => `
        <div class="carousel-image">
            <img src="${img}" alt="Promotion Image">
        </div>
    `).join('');

    if (modalCarouselImages.length > 1) {
        indicatorsContainer.innerHTML = modalCarouselImages.map((_, index) => `
            <div class="carousel-indicator ${index === currentModalCarouselIndex ? 'active' : ''}" data-index="${index}"></div>
        `).join('');

        indicatorsContainer.querySelectorAll('.carousel-indicator').forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentModalCarouselIndex = index;
                updateModalCarousel();
            });
        });
    } else {
        indicatorsContainer.innerHTML = '';
    }

    const offset = -currentModalCarouselIndex * 100;
    carouselContainer.style.transform = `translateX(${offset}%)`;
}

function nextModalImage() {
    if (currentModalCarouselIndex < modalCarouselImages.length - 1) {
        currentModalCarouselIndex++;
    } else {
        currentModalCarouselIndex = 0;
    }
    updateModalCarousel();
}

function prevModalImage() {
    if (currentModalCarouselIndex > 0) {
        currentModalCarouselIndex--;
    } else {
        currentModalCarouselIndex = modalCarouselImages.length - 1;
    }
    updateModalCarousel();
}

// ===== EVENT LISTENERS =====
function setupEventListeners() {
    // Tenant search
    const tenantSearchInput = document.getElementById('tenantSearchInput');
    if (tenantSearchInput) {
        tenantSearchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();
            const tenantItems = document.querySelectorAll('#tenantFilterList .tenant-filter-item');

            tenantItems.forEach(item => {
                const tenantName = item.querySelector('h4').textContent.toLowerCase();
                if (tenantName.includes(searchTerm)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    }

    // Tenant filter clicks
    document.addEventListener('click', (e) => {
        const filterItem = e.target.closest('.tenant-filter-item');
        // Ignore if it is the favorites filter to avoid conflict
        if (filterItem && filterItem.id !== 'favoritesFilter') {
            const tenant = filterItem.dataset.tenant;
            renderPromotions(tenant);
        }
    });

    // Category filter clicks
    document.addEventListener('click', (e) => {
        const categoryItem = e.target.closest('.category-chip');
        if (categoryItem) {
            const category = categoryItem.dataset.category;
            renderPromotions(currentFilter, category);

            // Update active state
            document.querySelectorAll('.category-chip').forEach(chip => {
                if (chip.dataset.category === category) {
                    chip.classList.add('active');
                } else {
                    chip.classList.remove('active');
                }
            });
        }
    });

    // Favorites filter click
    const favFilter = document.getElementById('favoritesFilter');
    if (favFilter) {
        favFilter.addEventListener('click', () => {
            renderPromotions(currentFilter, 'favorites');
        });
    }

    // Sort Dropdown
    const sortSelect = document.getElementById('sortPromotions');
    if (sortSelect) {
        sortSelect.addEventListener('change', (e) => {
            currentSort = e.target.value;
            renderPromotions(currentFilter, currentCategoryFilter);
        });
    }

    // View Toggle
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const view = btn.dataset.view;
            currentView = view;

            // Update active state
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            renderPromotions(currentFilter, currentCategoryFilter);
        });
    });

    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMorePromotions);
    }

    // ===== MOBILE FILTER EVENTS =====
    const mobileFilterToggle = document.getElementById('mobileFilterToggle');
    const tenantFilterSidebar = document.querySelector('.tenant-filter-sidebar');
    const mobileFilterOverlay = document.getElementById('mobileFilterOverlay');

    if (mobileFilterToggle && tenantFilterSidebar && mobileFilterOverlay) {
        function openMobileFilter() {
            tenantFilterSidebar.classList.add('active');
            mobileFilterOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileFilter() {
            tenantFilterSidebar.classList.remove('active');
            mobileFilterOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        mobileFilterToggle.addEventListener('click', openMobileFilter);
        mobileFilterOverlay.addEventListener('click', closeMobileFilter);

        const mobileFilterCloseBtn = document.getElementById('mobileFilterCloseBtn');
        if (mobileFilterCloseBtn) {
            mobileFilterCloseBtn.addEventListener('click', closeMobileFilter);
        }
    }

    // ===== CLEAR FILTERS =====
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', () => {
             // Reset all states
             currentFilter = 'all';
             currentCategoryFilter = 'all';
             const searchInput = document.getElementById('tenantSearchInput');
             if (searchInput) searchInput.value = '';

             // Reset UI Active States
             document.querySelectorAll('.tenant-filter-item').forEach(i => i.classList.remove('active'));
             const allFilter = document.querySelector('.tenant-filter-item[data-tenant="all"]');
             if (allFilter) allFilter.classList.add('active');

             document.querySelectorAll('.category-chip').forEach(c => c.classList.remove('active'));
             const allCategory = document.querySelector('.category-chip[data-category="all"]');
             if (allCategory) allCategory.classList.add('active');

             // Render
             renderPromotions('all', 'all');
        });
    }

    const modalClose = document.getElementById('modalClose');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalCarouselPrev = document.getElementById('modalCarouselPrev');
    const modalCarouselNext = document.getElementById('modalCarouselNext');
    const modalCarousel = document.querySelector('.modal-carousel');

    if (modalClose) {
        modalClose.addEventListener('click', closePromotionModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closePromotionModal);
    }

    if (modalCarouselPrev) {
        modalCarouselPrev.addEventListener('click', prevModalImage);
    }

    if (modalCarouselNext) {
        modalCarouselNext.addEventListener('click', nextModalImage);
    }

    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('promotionModal');
        if (modal && modal.classList.contains('active')) {
            if (e.key === 'Escape') {
                closePromotionModal();
            } else if (e.key === 'ArrowLeft') {
                prevModalImage();
            } else if (e.key === 'ArrowRight') {
                nextModalImage();
            }
        }
    });

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
}

// ===== UTILITY FUNCTIONS =====
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { day: 'numeric', month: 'short', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}
