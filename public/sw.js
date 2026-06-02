const CACHE_NAME = 'mbg-admin-cache-v1';
const ASSETS_TO_CACHE = [
    '/assets/images/logo.png',
    '/assets/backend/css/styles.css',
    '/assets/backend/js/vendor.min.js',
    '/assets/backend/js/toastr.js'
];

// Install Service Worker and cache essential static assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
    self.skipWaiting();
});

// Activate Service Worker and clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch Strategy: Network First for all requests, fallback to Cache for cached static assets
self.addEventListener('fetch', (event) => {
    // Only handle GET requests
    if (event.request.method !== 'GET') return;

    event.respondWith(
        fetch(event.request)
            .then((response) => {
                // If it's a valid response and we want to cache it (e.g. static assets)
                if (response && response.status === 200 && event.request.url.match(/\.(css|js|png|jpg|jpeg|svg|woff2|woff|ttf)$/)) {
                    const responseToCache = response.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseToCache);
                    });
                }
                return response;
            })
            .catch(() => {
                // If network fails, try to return from cache
                return caches.match(event.request);
            })
    );
});
