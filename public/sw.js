const CACHE_NAME = 'mbg-cache-v3';
const PRECACHE_ASSETS = [
    '/',
    '/assets/images/logo.png',
    '/assets/backend/css/styles.css',
    '/assets/backend/js/vendor.min.js',
    '/assets/backend/js/toastr.js'
];

// Install Service Worker and precache essential assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS).catch((err) => {
                console.warn('PWA Pre-cache warning:', err);
            });
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

// Fetch Strategy: Network-First with safe fallback (NEVER return null/undefined to respondWith)
self.addEventListener('fetch', (event) => {
    // 1. Only handle GET requests
    if (event.request.method !== 'GET') return;

    // 2. Filter out non-http(s) schemes (e.g. chrome-extension, data URIs)
    const url = new URL(event.request.url);
    if (!url.protocol.startsWith('http')) return;

    event.respondWith(
        fetch(event.request)
            .then((response) => {
                // Cache successful static asset responses
                if (response && response.status === 200) {
                    if (event.request.url.match(/\.(css|js|png|jpg|jpeg|svg|woff2|woff|ttf|ico)$/)) {
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, responseToCache).catch(() => {});
                        });
                    }
                }
                return response;
            })
            .catch(async () => {
                // If network fails (offline/timeout), check cache
                const cachedResponse = await caches.match(event.request);
                if (cachedResponse) {
                    return cachedResponse;
                }

                // If requesting an HTML navigation page and offline/unreachable
                const acceptHeader = event.request.headers.get('accept') || '';
                if (event.request.mode === 'navigate' || acceptHeader.includes('text/html')) {
                    const homeCache = await caches.match('/');
                    if (homeCache) {
                        return homeCache;
                    }
                    return new Response(
                        `<!DOCTYPE html>
                        <html lang="id">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Mal Bali Galeria - Offline</title>
                            <style>
                                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; margin: 0; background: #111; color: #fff; text-align: center; padding: 24px; box-sizing: border-box; }
                                .card { background: #1e1e1e; border-radius: 16px; padding: 32px 24px; max-width: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid #333; }
                                h1 { font-size: 20px; margin-top: 0; margin-bottom: 12px; font-weight: 600; color: #f5f5dc; }
                                p { font-size: 14px; color: #aaa; line-height: 1.5; margin-bottom: 24px; }
                                button { background: linear-gradient(135deg, #2c5f5d 0%, #1e4240 100%); color: #fff; border: none; padding: 12px 28px; border-radius: 50px; font-size: 14px; font-weight: 600; cursor: pointer; transition: transform 0.2s; }
                                button:active { transform: scale(0.95); }
                            </style>
                        </head>
                        <body>
                            <div class="card">
                                <h1>Koneksi Terputus</h1>
                                <p>Halaman tidak dapat dimuat karena koneksi internet Anda terputus. Silakan periksa koneksi Anda dan coba lagi.</p>
                                <button onclick="window.location.reload()">Coba Lagi</button>
                            </div>
                        </body>
                        </html>`,
                        {
                            status: 503,
                            headers: { 'Content-Type': 'text/html; charset=utf-8' }
                        }
                    );
                }

                // Default fallback response for non-HTML assets to prevent Safari "Returned response is null" crash
                return new Response('', { status: 504, statusText: 'Gateway Timeout / Offline' });
            })
    );
});
