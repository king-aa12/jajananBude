(function () {
    // Menu samping (ikon garis tiga)
    var drawer = document.getElementById('drawer');
    if (drawer) {
        document.querySelectorAll('[data-buka-drawer]').forEach(function (b) {
            b.addEventListener('click', function () { drawer.hidden = false; document.body.style.overflow = 'hidden'; });
        });
        document.querySelectorAll('[data-tutup-drawer]').forEach(function (b) {
            b.addEventListener('click', function () { drawer.hidden = true; document.body.style.overflow = ''; });
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !drawer.hidden) { drawer.hidden = true; document.body.style.overflow = ''; }
        });
    }

    // Konfirmasi sebelum menghapus data (admin)
    document.querySelectorAll('form[data-konfirmasi]').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            if (!window.confirm(f.getAttribute('data-konfirmasi'))) { e.preventDefault(); }
        });
    });
})();
