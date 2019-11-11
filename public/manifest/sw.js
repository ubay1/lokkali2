var dataCacheName = 'vuepwa-v1';
var cacheName = 'vuepwa-final-v1';
var filesToCache = [
  '/',
];

self.addEventListener('install', function(e) {
    console.log('install Service Worker Sukses');
    e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('activate', function(e) {
  console.log('Service Worker Telah Aktif');
  e.waitUntil
  (
    caches.keys().then(function(keyList)
    {
      return Promise.all(keyList.map(function(key)
      {
        if (key !== cacheName && key !== dataCacheName)
        {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});


// memuat jaringan jika terjadi offline
self.addEventListener('fetch', function(e) {
  console.log('[Service Worker] Fetch', e.request.url);

    e.respondWith(
      caches.open(dataCacheName).then(function(cache) {
        return fetch(e.request).then(function(response){
          cache.put(e.request.url, response.clone());
          return response;
        });
      })
    );

});


// push


