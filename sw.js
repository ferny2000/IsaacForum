/* sw.js - Versión Final Corregida (Sin errores de Logout) */

const CACHE_NAME = 'isaac-forum-v1';
const DYNAMIC_CACHE = 'isaac-forum-dynamic-v7-stable';

const urlsToCache = [
    // --- Archivos Esenciales ---
    './',
    './index.php',
    './info.php',
    
    // Quitamos logout.php y register.php de aquí para evitar errores rojos
    './foro.php', 
    './login.php', 

    // --- Estilos ---
    './CSS/styles.css',

    // --- JSON ---
    './JSON/isaac_data.json',
    './JSON/manifest.json',

    // --- Scripts PHP auxiliares ---
    // Solo cacheamos los que muestran contenido, no los que hacen acciones (como upload o delete)
    './PHP/foro.php',
    './PHP/login.php', 

    // --- CDNs ---
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'
];

// 1. INSTALACIÓN
self.addEventListener('install', event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then(async cache => {
            console.log('--- INICIANDO INSTALACIÓN LIMPIA ---');
            for (const url of urlsToCache) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error(`Status ${response.status}`);
                    await cache.put(url, response);
                } catch (error) {
                    console.warn(`⚠️ No se pudo cachear ${url} (No es crítico)`);
                }
            }
            console.log('--- INSTALACIÓN COMPLETADA ---');
        })
    );
});

// 2. ACTIVACIÓN
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

// 3. FETCH (¡AQUI ESTA LA MAGIA!)
self.addEventListener('fetch', event => {
    const request = event.request;
    const url = new URL(request.url);

    // --- REGLA DE ORO: IGNORAR LOGOUT Y ADMIN ---
    // Si la URL contiene 'logout.php' o 'admin', el Service Worker NO HACE NADA.
    // Deja que el navegador maneje la redirección normalmente.
    if (url.pathname.includes('logout.php') || url.pathname.includes('admin_panel.php')) {
        return; 
    }

    // Ignorar métodos POST
    if (request.method !== 'GET') {
        return; 
    }

    // Estrategia HTML (Network First)
    if (request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(
            fetch(request)
                .then(networkResponse => {
                    // Si el servidor responde con redirección (302/301), NO cacheamos, solo devolvemos
                    if (networkResponse.redirected) {
                        return networkResponse;
                    }
                    if (!networkResponse || !networkResponse.ok) {
                        return caches.match(request);
                    }
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

    // Estrategia Cache First (Estáticos)
    event.respondWith(
        caches.match(request).then(cached => {
            return cached || fetch(request);
        })
    );
});