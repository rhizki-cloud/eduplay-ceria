const CACHE='eduplay-ceria-v4';
const STATIC_CORE=[
  './assets/css/style.css','./assets/css/responsive.css','./assets/css/admin.css',
  './assets/js/app.js','./assets/icon/app-icon.svg','./manifest.json'
];

self.addEventListener('install',event=>{
  event.waitUntil(caches.open(CACHE).then(cache=>cache.addAll(STATIC_CORE)).then(()=>self.skipWaiting()));
});

self.addEventListener('activate',event=>{
  event.waitUntil(
    caches.keys().then(keys=>Promise.all(keys.filter(key=>key!==CACHE).map(key=>caches.delete(key))))
      .then(()=>self.clients.claim())
  );
});

self.addEventListener('fetch',event=>{
  if(event.request.method!=='GET') return;
  const url=new URL(event.request.url);
  if(url.origin!==self.location.origin) return;

  // Halaman PHP bersifat pribadi/dinamis. Selalu ambil dari jaringan agar sesi
  // login, data siswa, dan panel admin tidak tersimpan sebagai halaman cache lama.
  if(event.request.mode==='navigate' || url.pathname.endsWith('.php') || url.pathname.includes('/admin/')){
    event.respondWith(fetch(event.request));
    return;
  }

  event.respondWith(
    caches.match(event.request).then(cached=>cached||fetch(event.request).then(response=>{
      if(response&&response.status===200&&response.type==='basic'){
        const copy=response.clone();
        caches.open(CACHE).then(cache=>cache.put(event.request,copy));
      }
      return response;
    }))
  );
});
