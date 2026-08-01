const CACHE_NAME = 'eventama-pwa-v1';
const DYNAMIC_CACHE = 'eventama-dynamic-v1';

const FILES_TO_CACHE = [
  '/',
  '/offline',
  '/manifest.json',
  '/assets/icons/icon-192x192.png',
  '/assets/icons/icon-512x512.png'
];

self.addEventListener('install', (evt) => {
  evt.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('[ServiceWorker] Pre-caching offline page');
      return cache.addAll(FILES_TO_CACHE);
    })
  );
  self.skipWaiting();
});

self.addEventListener('activate', (evt) => {
  evt.waitUntil(
    caches.keys().then((keyList) => {
      return Promise.all(keyList.map((key) => {
        if (key !== CACHE_NAME && key !== DYNAMIC_CACHE) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
  self.clients.claim();
});

self.addEventListener('fetch', (evt) => {
  if (evt.request.method !== 'GET') {
    return;
  }

  // Handle navigation requests (e.g. HTML pages)
  if (evt.request.mode === 'navigate') {
    evt.respondWith(
      fetch(evt.request)
        .catch(() => {
          return caches.match('/offline');
        })
    );
    return;
  }

  // Handle other requests (e.g. assets) with Stale-While-Revalidate or Network First
  evt.respondWith(
    caches.match(evt.request).then((response) => {
      return response || fetch(evt.request).then((fetchRes) => {
        return caches.open(DYNAMIC_CACHE).then((cache) => {
          // Hanya cache url yang aman (http/https), hindari chrome-extension dll
          if(evt.request.url.startsWith('http')) {
             cache.put(evt.request.url, fetchRes.clone());
          }
          return fetchRes;
        });
      });
    }).catch(() => {
        // Fallback opsional jika file statis gagal dan tidak ada di cache
    })
  );
});
