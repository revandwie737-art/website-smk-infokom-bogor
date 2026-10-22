/* ==========================================================
   Transisi pindah halaman — panel hitam tinggi jatuh dari atas
   File: public/js/page-transition.js
   Pasang di <head> (TANPA defer) supaya tidak ada kilatan konten.
   ========================================================== */
(function () {
  'use strict';

  var KEY = 'pt-navigating';
  var DUR_IN = 500;        // lama satu panel jatuh & mendarat (ms)
  var DUR_OUT = 540;       // lama satu panel jatuh keluar (ms)
  var STAGGER_TOTAL = 180; // total jeda dari panel pertama ke terakhir (ms)
  var HOLD_MS = 70;        // jeda singkat sebelum panel jatuh keluar
  var root = document.documentElement;

  var reduceMotion = window.matchMedia &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) return;

  var arrivedViaTransition = false;
  try { arrivedViaTransition = sessionStorage.getItem(KEY) === '1'; } catch (e) {}
  if (arrivedViaTransition) root.classList.add('pt-covered');

  var grid = null, tiles = null, navigating = false;

  function logoMarkup() {
    var img = document.querySelector('header img, nav img');
    var src = img ? (img.currentSrc || img.src) : '';
    var nameEl = document.querySelector('header a p');
    var name = nameEl ? nameEl.textContent.trim() : 'SMK Infokom Bogor';
    return '<div class="pt-logo">' +
      '<svg class="pt-ring" viewBox="0 0 120 120"><circle cx="60" cy="60" r="56"/></svg>' +
      '<div class="pt-badge">' + (src ? '<img src="' + src + '" alt="">' : '<b>SI</b>') + '</div>' +
      '<div class="pt-name">' + name.replace(/[<>&]/g, '') + '</div>' +
      '</div>';
  }

  // Bangun ulang panel sesuai lebar layar. Mengembalikan jeda terlama.
  function build() {
    if (!grid) {
      grid = document.createElement('div');
      grid.className = 'pt-grid';
      grid.setAttribute('aria-hidden', 'true');
      tiles = document.createElement('div');
      tiles.className = 'pt-tiles';
      grid.appendChild(tiles);
      grid.insertAdjacentHTML('beforeend', logoMarkup());
      document.body.appendChild(grid);
    }

    var vw = window.innerWidth;
    var cols = vw < 640 ? 5 : (vw < 1100 ? 7 : 10);
    var step = STAGGER_TOTAL / Math.max(1, cols - 1);

    tiles.style.gridTemplateColumns = 'repeat(' + cols + ', 1fr)';
    grid.style.setProperty('--dur-in', DUR_IN + 'ms');
    grid.style.setProperty('--dur-out', DUR_OUT + 'ms');

    var maxDelay = Math.round((cols - 1) * step);
    grid.style.setProperty('--logo-delay', Math.round(maxDelay + DUR_IN * .4) + 'ms');

    var html = '';
    for (var c = 0; c < cols; c++) {
      html += '<div class="pt-tile" style="--d:' + Math.round(c * step) + 'ms"></div>';
    }
    tiles.innerHTML = html;
    return maxDelay;
  }

  function reset() {
    if (!grid) return;
    grid.className = 'pt-grid';
    navigating = false;
  }

  // ---------- Halaman baru: panel jatuh keluar, membuka halaman ----------
  function reveal() {
    var maxDelay = build();
    grid.className = 'pt-grid is-active is-covered';
    root.classList.remove('pt-covered');
    void grid.offsetHeight;

    window.setTimeout(function () {
      grid.className = 'pt-grid is-active is-revealing';
      root.classList.add('pt-enter');
      window.setTimeout(function () {
        reset();
        root.classList.remove('pt-enter');
      }, maxDelay + DUR_OUT + 120);
    }, HOLD_MS);

    try { sessionStorage.removeItem(KEY); } catch (e) {}
  }

  if (arrivedViaTransition) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', reveal);
    } else {
      reveal();
    }
    // jaring pengaman: layar tidak boleh tertutup selamanya
    window.setTimeout(function () { root.classList.remove('pt-covered'); }, 4000);
  }

  // ---------- Halaman lama: panel jatuh menutup layar ----------
  function shouldHandle(e, a) {
    if (e.defaultPrevented) return false;
    if (e.button !== 0) return false;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return false;
    if (a.target && a.target !== '_self') return false;
    if (a.hasAttribute('download')) return false;
    if (a.hasAttribute('data-no-transition')) return false;
    if (a.hasAttribute('data-lightbox-src')) return false;

    var href = a.getAttribute('href');
    if (!href || href.charAt(0) === '#') return false;
    if (/^(mailto:|tel:|javascript:|wa\.me|whatsapp:)/i.test(href)) return false;

    var url;
    try { url = new URL(a.href, window.location.href); } catch (err) { return false; }
    if (url.origin !== window.location.origin) return false;
    if (url.pathname === window.location.pathname &&
        url.search === window.location.search) return false;

    if (/^\/(admin|login|logout|siswa|storage)(\/|$)/i.test(url.pathname)) return false;
    if (/\.(pdf|docx?|xlsx?|pptx?|zip|rar|png|jpe?g|gif|webp|svg|mp4|mp3)$/i.test(url.pathname)) return false;

    return true;
  }

  document.addEventListener('click', function (e) {
    if (navigating) return;
    var a = e.target.closest ? e.target.closest('a') : null;
    if (!a || !shouldHandle(e, a)) return;

    e.preventDefault();
    navigating = true;
    var target = a.href;

    var maxDelay = build();
    grid.className = 'pt-grid is-active';
    void grid.offsetHeight;
    grid.classList.add('is-covering');

    window.setTimeout(function () {
      try { sessionStorage.setItem(KEY, '1'); } catch (err) {}
      window.location.href = target;
    }, maxDelay + DUR_IN);

    // jaring pengaman kalau navigasi gagal / dibatalkan
    window.setTimeout(reset, maxDelay + DUR_IN + 5000);
  });

  // Tombol Back/Forward (bfcache): pastikan panel tidak menyangkut
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      root.classList.remove('pt-covered', 'pt-enter');
      reset();
      try { sessionStorage.removeItem(KEY); } catch (err) {}
    }
  });
})();