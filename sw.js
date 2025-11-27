/* sw.js - Service Worker Optimizado y Corregido (Final) */

const CACHE_NAME = 'isaac-forum-v1';
const DYNAMIC_CACHE = 'isaac-forum-dynamic-v3 fix';

const urlsToCache = [
    './',
    './index.php',
    './info.php',
    './foro.php',
    './login.php',
    './register.php',
    './CSS/styles.css',
    './JSON/isaac_data.json',
    './JSON/manifest.json',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'
];

// ------------------------------------------------------
// 1. INSTALACIÓN
// ------------------------------------------------------
self.addEventListener('install', event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('Abriendo caché estática...');
            return cache.addAll(urlsToCache);
        })
    );
});

// ------------------------------------------------------
// 2. ACTIVACIÓN
// ------------------------------------------------------
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== CACHE_NAME && cache !== DYNAMIC_CACHE) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// ------------------------------------------------------
// 3. FETCH – Interceptar peticiones
// ------------------------------------------------------
self.addEventListener('fetch', event => {
    const request = event.request;
    const requestUrl = new URL(request.url);

    // ---------------------------------------------
    // A) JSON (Stale-While-Revalidate)
    // ---------------------------------------------
    if (requestUrl.pathname.endsWith('isaac_data.json')) {
        event.respondWith(
            caches.open(CACHE_NAME).then(cache => {
                return cache.match(request).then(cached => {
                    const networkFetch = fetch(request)
                        .then(networkResponse => {
                            if (networkResponse.ok) {
                                // CORRECCIÓN 1: Usamos networkResponse.clone() directamente
                                cache.put(request, networkResponse.clone());
                            }
                            return networkResponse;
                        });
                    return cached || networkFetch;
                });
            })
        );
        return;
    }

    // ---------------------------------------------
    // B) HTML/PHP (Network First)
    // ---------------------------------------------
    if (request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(
            fetch(request)
                .then(networkResponse => {
                    if (!networkResponse || !networkResponse.ok) {
                        return caches.match(request);
                    }
                    
                    // Aquí sí habías definido la variable 'clone', así que esto estaba bien
                    const responseToCache = networkResponse.clone();

                    caches.open(DYNAMIC_CACHE).then(cache => {
                        cache.put(request, responseToCache);
                    });

                    return networkResponse;
                })
                .catch(() => caches.match(request))
        );
        return;
    }

   // ---------------------------------------------
    // C) Archivos Estáticos (CSS, JS, Imágenes) - Stale-While-Revalidate
    // ---------------------------------------------
    event.respondWith(
        caches.match(request).then(cached => {
            
            // Creamos la petición de red para actualizar la caché en segundo plano
            const networkFetch = fetch(request)
                .then(networkResponse => {
                    // Verificamos que la respuesta sea válida antes de guardar nada
                    if (networkResponse && networkResponse.ok) {
                        
                        // Clonamos la respuesta INMEDIATAMENTE
                        const responseToCache = networkResponse.clone();

                        // LÓGICA DE CACHEO:
                        if (requestUrl.pathname.includes('/uploads/')) {
                            // 1. Si es una imagen subida -> Caché Dinámica
                            caches.open(DYNAMIC_CACHE).then(cache => {
                                cache.put(request, responseToCache);
                            });
                        } else {
                            // 2. Si es CSS, JS o Bootstrap -> Caché Estática
                            // (Esto asegura que tus estilos se actualicen si los cambias)
                            caches.open(CACHE_NAME).then(cache => {
                                cache.put(request, responseToCache);
                            });
                        }
                    }
                    return networkResponse;
                })
                .catch(err => {
                    // Si falla la red (offline), no hacemos nada; el return de abajo usará 'cached'
                });

            // Retornamos la caché (velocidad) si existe, o esperamos a la red si no hay caché
            return cached || networkFetch;
        })
    );
});