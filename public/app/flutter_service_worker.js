'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"favicon.png": "3dd3ce0e9fa2c6c667c051ab05c413a4",
"main.dart.js": "852d54875b08ec883eda4dcfe392ff55",
"canvaskit/canvaskit.wasm": "1f237a213d7370cf95f443d896176460",
"canvaskit/chromium/canvaskit.wasm": "b1ac05b29c127d86df4bcfbf50dd902a",
"canvaskit/chromium/canvaskit.js.symbols": "a012ed99ccba193cf96bb2643003f6fc",
"canvaskit/chromium/canvaskit.js": "671c6b4f8fcc199dcc551c7bb125f239",
"canvaskit/skwasm.wasm": "9f0c0c02b82a910d12ce0543ec130e60",
"canvaskit/canvaskit.js.symbols": "48c83a2ce573d9692e8d970e288d75f7",
"canvaskit/canvaskit.js": "66177750aff65a66cb07bb44b8c6422b",
"canvaskit/skwasm.js": "694fda5704053957c2594de355805228",
"canvaskit/skwasm.worker.js": "89990e8c92bcb123999aa81f7e203b1c",
"canvaskit/skwasm.js.symbols": "262f4827a1317abb59d71d6c587a93e2",
"assets/FontManifest.json": "7b2a36307916a9721811788013e65289",
"assets/AssetManifest.json": "b5fa186d7500447f0592f1ea5089c6cf",
"assets/assets/images/icons/facebook.png": "92e68411b22da5b1da4f27728a28f296",
"assets/assets/images/icons/google.png": "d99e08d240417337e035536ace0af96c",
"assets/assets/images/icons/app_icon.png": "e2625ef764a24846b9de5dc13273f4fe",
"assets/assets/images/icons/playstore.png": "4a0332d8ecef01f01ab6dd88600d3a3b",
"assets/assets/images/icons/appstore.png": "d9f5320d7ca9fd137d9c9ef87a4111c2",
"assets/assets/images/icons/web.png": "128c7e8511acbeb83ddf9f4385b12a27",
"assets/assets/images/flags/flag_en_us.png": "baaea16efa636db43e795cf16ba64491",
"assets/assets/images/flags/flag_pt_pt.png": "919e0c29b4a4dc9f66b9a5330842646e",
"assets/assets/images/tchissola/tchissola1.png": "80bdc48dcb6a6aceb8135e2ff2b18820",
"assets/assets/images/tchissola/tchissola6.png": "7edda1a8c97abde558ce35adddddb53b",
"assets/assets/images/tchissola/tchissola2.png": "c51227cea2cbfb1c19c8bf7dbc8f2271",
"assets/assets/images/tchissola/tchissola4.png": "2d3a70ca78f3eba731056a8e471a4bff",
"assets/assets/images/tchissola/tchissola8.png": "2f3badff9c1ecaab0172fca5394443ec",
"assets/assets/images/tchissola/tchissola5.png": "657fd5f9681645c730390df21f9b7e01",
"assets/assets/images/tchissola/tchissola7.png": "ea6ed03a41888f89b867f5527edc1099",
"assets/assets/images/tchissola/tchissola3.png": "391723dd8c173d73a3c9cff409769946",
"assets/assets/images/landing/image2.png": "bcb52a1303cf02716daa67a9d1bc220e",
"assets/assets/images/landing/image1.png": "39645372b1b1b2e96e6a16b894f977c8",
"assets/assets/images/landing/image3.png": "2f9355352fbc7bbf5cce2f4b9a62df53",
"assets/assets/images/landing/image4.png": "ce5b2664e0dfcc80f13d696e03a5c9d8",
"assets/assets/languages/en-US.json": "5df8e6f6eca63d00c7eb54636a714261",
"assets/assets/languages/pt-PT.json": "cfebce67f8c3b3fd8232073d365e2915",
"assets/fonts/MaterialIcons-Regular.otf": "ed74bac54478d07433df55a5e0a1f660",
"assets/shaders/ink_sparkle.frag": "ecc85a2e95f5e9f53123dcaf8cb9b6ce",
"assets/NOTICES": "9aa71e540fd3793251585d1e23a58ed3",
"assets/AssetManifest.bin.json": "65873c0dfb27d8dc75dbb523b40f495f",
"assets/AssetManifest.bin": "0bb2bf47b226534d8645a8b7dc0bce7a",
"manifest.json": "acac0c350cb5d4a1e09d4f8a2635ff3c",
"icons/Icon-512.png": "e2625ef764a24846b9de5dc13273f4fe",
"icons/Icon-maskable-192.png": "1de94885ec478da60715de097cc18fb0",
"icons/Icon-192.png": "1de94885ec478da60715de097cc18fb0",
"icons/Icon-maskable-512.png": "e2625ef764a24846b9de5dc13273f4fe",
"index.html": "657a47d97b56938d6f650de8e5759011",
"/": "657a47d97b56938d6f650de8e5759011",
"flutter_bootstrap.js": "82c2651bb9419ca15cdd644ff772e592",
"flutter.js": "f393d3c16b631f36852323de8e583132",
"version.json": "f90ab1680553b550bb28dbd542ed15bc"};
// The application shell files that are downloaded before a service worker can
// start.
const CORE = ["main.dart.js",
"index.html",
"flutter_bootstrap.js",
"assets/AssetManifest.bin.json",
"assets/FontManifest.json"];

// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value, {'cache': 'reload'})));
    })
  );
});
// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        // Claim client to enable caching on first launch
        self.clients.claim();
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      // Claim client to enable caching on first launch
      self.clients.claim();
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});
// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache only if the resource was successfully fetched.
        return response || fetch(event.request).then((response) => {
          if (response && Boolean(response.ok)) {
            cache.put(event.request, response.clone());
          }
          return response;
        });
      })
    })
  );
});
self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});
// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}
// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
