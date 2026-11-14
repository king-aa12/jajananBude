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

    // Pembantu: tampilkan konfirmasi SweetAlert2, lalu kirim form jika disetujui.
    // Cadangan: confirm bawaan browser jika SweetAlert2 gagal dimuat.
    function konfirmasi(form, opsi) {
        if (typeof Swal === 'undefined') {
            if (window.confirm(opsi.text)) { form.submit(); }
            return;
        }
        Swal.fire({
            title: opsi.title,
            text: opsi.text,
            icon: opsi.icon,
            showCancelButton: true,
            confirmButtonText: opsi.ya,
            cancelButtonText: 'Batal',
            confirmButtonColor: opsi.warna,
            cancelButtonColor: '#7A6350',
            reverseButtons: true,
            focusCancel: opsi.fokusBatal
        }).then(function (hasil) {
            if (hasil.isConfirmed) { form.submit(); }
        });
    }

    // Konfirmasi HAPUS
    document.querySelectorAll('form[data-konfirmasi]').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            e.preventDefault();
            konfirmasi(f, {
                title: 'Hapus data?', text: f.getAttribute('data-konfirmasi'),
                icon: 'warning', ya: 'Ya, hapus', warna: '#B4372A', fokusBatal: true
            });
        });
    });

    // Konfirmasi SIMPAN (tambah / ubah). Pemeriksaan isian wajib oleh browser tetap berjalan lebih dulu.
    document.querySelectorAll('form[data-simpan]').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            e.preventDefault();
            konfirmasi(f, {
                title: 'Simpan data?', text: f.getAttribute('data-simpan'),
                icon: 'question', ya: 'Ya, simpan', warna: '#A9561A', fokusBatal: false
            });
        });
    });
})();