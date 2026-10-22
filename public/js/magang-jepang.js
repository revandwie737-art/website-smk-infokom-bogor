/* ==========================================================================
   MAGANG JEPANG — public/js/magang-jepang.js
   Tidak bergantung pada layout apa pun. Hanya bekerja lewat atribut:
     [data-mj-petals]  → wadah kelopak sakura jatuh; JS mengisinya sesuai tinggi wadah
     [data-mj-reveal]  → tambah .is-visible saat masuk layar (opsional data-mj-delay="200")
     [data-mj-item]    → wadah kartu (untuk tombol deskripsi di layar sentuh)
     [data-mj-toggle]  → tombol yang membuka/menutup deskripsi di dalam [data-mj-item]
   ========================================================================== */
(function () {
  'use strict';

  function init() {
    // ---- Reveal saat masuk layar ----
    var els = document.querySelectorAll('[data-mj-reveal]');
    els.forEach(function (el) {
      var d = el.getAttribute('data-mj-delay');
      if (d) el.style.setProperty('--mj-delay', d + 'ms');
    });

    // Elemen ber-clip-path (.mj-wipe) tersembunyi sebelum terbuka, sehingga IntersectionObserver
    // menganggapnya "tidak terlihat" dan tidak pernah memicu. Jadi untuk elemen itu, yang diamati
    // adalah induknya, lalu .is-visible dipasang ke elemen aslinya.
    function observed(el) {
      return el.classList.contains('mj-wipe') && el.parentElement ? el.parentElement : el;
    }

    var map = new Map();   // elemen yang diamati -> daftar elemen yang harus diberi .is-visible
    els.forEach(function (el) {
      var t = observed(el);
      if (!map.has(t)) map.set(t, []);
      map.get(t).push(el);
    });

    function show(target) {
      (map.get(target) || []).forEach(function (el) { el.classList.add('is-visible'); });
    }

    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            show(entry.target);
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
      map.forEach(function (_, target) { io.observe(target); });
    } else {
      els.forEach(function (el) { el.classList.add('is-visible'); });
    }

    // Jaring pengaman: elemen yang sudah jelas terlihat di layar tapi belum terpicu
    window.setTimeout(function () {
      var vh = window.innerHeight || document.documentElement.clientHeight;
      map.forEach(function (_, target) {
        var r = target.getBoundingClientRect();
        if (r.top < vh && r.bottom > 0) show(target);
      });
    }, 1500);

    // ---- Buka/tutup deskripsi (layar sentuh) ----
    document.addEventListener('click', function (e) {
      var btn = e.target.closest ? e.target.closest('[data-mj-toggle]') : null;
      if (!btn) return;
      var item = btn.closest('[data-mj-item]');
      if (!item) return;
      var open = item.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // ---- Kelopak sakura: jatuh dari atas sampai dasar wadah (seluruh tinggi halaman) ----
  function petals() {
    var box = document.querySelector('[data-mj-petals]');
    if (!box) return;
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var lastH = 0;
    function build() {
      var h = box.clientHeight;
      if (!h || Math.abs(h - lastH) < 40) return;   // abaikan perubahan kecil
      lastH = h;
      box.style.setProperty('--mj-h', h + 'px');

      var count = Math.min(46, Math.max(16, Math.round(h / 120)));
      var frag = document.createDocumentFragment();
      for (var i = 0; i < count; i++) {
        var size = 8 + Math.random() * 9;
        var speed = 48 + Math.random() * 42;          // px per detik
        var dur = h / speed;
        var p = document.createElement('i');
        p.className = 'mj-petal';
        p.style.cssText =
          'left:' + (Math.random() * 100).toFixed(1) + '%;' +
          'width:' + size.toFixed(1) + 'px;height:' + (size * 0.72).toFixed(1) + 'px;' +
          'animation-duration:' + dur.toFixed(1) + 's;' +
          'animation-delay:-' + (Math.random() * dur).toFixed(1) + 's;' +
          '--sway:' + (24 + Math.random() * 56).toFixed(0) + 'px;' +
          '--spin:' + (360 + Math.random() * 540).toFixed(0) + 'deg';
        frag.appendChild(p);
      }
      box.innerHTML = '';
      box.appendChild(frag);
    }

    build();
    window.addEventListener('load', build);
    if ('ResizeObserver' in window) {
      var t;
      new ResizeObserver(function () { clearTimeout(t); t = setTimeout(build, 250); }).observe(box);
    } else {
      window.addEventListener('resize', build);
    }
  }

  function start() { init(); petals(); }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
  else start();
})();