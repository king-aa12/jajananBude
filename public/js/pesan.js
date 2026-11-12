/*
 * Formulir pemesanan JAJANAN BUDE.
 * Pesanan TIDAK dikirim ke server dan TIDAK disimpan. Detail pesanan disusun
 * menjadi teks, lalu dibuka di WhatsApp penjual melalui tautan click-to-chat.
 */
(function () {
    var cfg = window.PESAN || { jenis: [], awal: null, wa: '' };
    var daftar = document.getElementById('daftar-item');
    var form = document.getElementById('form-pesan');
    var ringkasan = document.getElementById('ringkasan-galat');
    var items = [];

    function el(tag, attrs, children) {
        var e = document.createElement(tag);
        Object.keys(attrs || {}).forEach(function (k) {
            if (k === 'class') e.className = attrs[k];
            else if (k === 'text') e.textContent = attrs[k];
            else e.setAttribute(k, attrs[k]);
        });
        (children || []).forEach(function (c) { e.appendChild(c); });
        return e;
    }

    function jenisById(id) {
        for (var i = 0; i < cfg.jenis.length; i++) { if (String(cfg.jenis[i].id) === String(id)) return cfg.jenis[i]; }
        return null;
    }
    function produkById(jenis, id) {
        if (!jenis) return null;
        for (var i = 0; i < jenis.produk.length; i++) { if (String(jenis.produk[i].id) === String(id)) return jenis.produk[i]; }
        return null;
    }

    function itemBaru(awal) {
        return { jenis: awal ? String(awal.jenis) : '', produk: awal ? String(awal.produk) : '', jumlah: 1, catatan: '' };
    }

    function render() {
        daftar.innerHTML = '';
        items.forEach(function (it, idx) {
            var kotak = el('div', { 'class': 'item-pesanan' });
            var kepala = el('div', { 'class': 'item-kepala' }, [el('strong', { text: 'Kue ' + (idx + 1) })]);
            if (items.length > 1) {
                var hapus = el('button', { type: 'button', 'class': 'hapus-item', text: 'Hapus' });
                hapus.addEventListener('click', function () { items.splice(idx, 1); render(); });
                kepala.appendChild(hapus);
            }
            kotak.appendChild(kepala);

            // Jenis kue
            var selJenis = el('select', { 'class': 'input', id: 'jenis-' + idx, 'aria-label': 'Jenis kue' });
            selJenis.appendChild(el('option', { value: '', text: 'Pilih jenis kue' }));
            cfg.jenis.forEach(function (j) {
                var o = el('option', { value: j.id, text: j.nama });
                if (String(j.id) === String(it.jenis)) o.selected = true;
                selJenis.appendChild(o);
            });

            // Produk kue
            var selProduk = el('select', { 'class': 'input', id: 'produk-' + idx, 'aria-label': 'Produk kue' });
            function isiProduk() {
                selProduk.innerHTML = '';
                var j = jenisById(it.jenis);
                selProduk.appendChild(el('option', { value: '', text: j ? 'Pilih produk ' + j.nama.toLowerCase() : 'Pilih jenis kue dahulu' }));
                if (j) {
                    j.produk.forEach(function (p) {
                        var o = el('option', { value: p.id, text: p.nama + ' (mulai ' + p.harga + ')' });
                        if (String(p.id) === String(it.produk)) o.selected = true;
                        selProduk.appendChild(o);
                    });
                }
            }
            isiProduk();
            selJenis.addEventListener('change', function () { it.jenis = selJenis.value; it.produk = ''; isiProduk(); });
            selProduk.addEventListener('change', function () { it.produk = selProduk.value; });

            // Jumlah
            var jml = el('input', { 'class': 'input', type: 'number', min: '1', max: '999', step: '1', id: 'jumlah-' + idx, 'aria-label': 'Jumlah' });
            jml.value = it.jumlah;
            jml.addEventListener('input', function () { it.jumlah = jml.value; });

            // Catatan
            var cat = el('input', { 'class': 'input', type: 'text', maxlength: '200', id: 'catatan-' + idx, placeholder: 'Contoh: rasa cokelat, ukuran besar', 'aria-label': 'Catatan atau permintaan khusus' });
            cat.value = it.catatan;
            cat.addEventListener('input', function () { it.catatan = cat.value; });

            var barisAtas = el('div', { 'class': 'dua-kolom' }, [
                el('div', {}, [el('label', { 'class': 'label', 'for': 'jenis-' + idx, text: 'Jenis kue *' }), selJenis]),
                el('div', {}, [el('label', { 'class': 'label', 'for': 'jumlah-' + idx, text: 'Jumlah *' }), jml])
            ]);
            kotak.appendChild(barisAtas);
            kotak.appendChild(el('label', { 'class': 'label', 'for': 'produk-' + idx, text: 'Produk kue *' }));
            kotak.appendChild(selProduk);
            kotak.appendChild(el('label', { 'class': 'label', 'for': 'catatan-' + idx, text: 'Catatan atau permintaan khusus' }));
            kotak.appendChild(cat);
            kotak.appendChild(el('div', { 'class': 'galat', 'data-galat': 'item-' + idx }));
            daftar.appendChild(kotak);
        });
    }

    function hariIniISO() {
        var d = new Date();
        d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
        return d.toISOString().slice(0, 10);
    }

    function setGalat(nama, pesan) {
        var e = form.querySelector('[data-galat="' + nama + '"]');
        if (!e) return;
        e.textContent = pesan || '';
        e.classList.toggle('tampil', !!pesan);
    }

    function validasi() {
        var daftarGalat = [];
        var nama = document.getElementById('nama').value.trim();
        var tgl = document.getElementById('tanggal').value;

        setGalat('nama', ''); setGalat('tanggal', '');
        if (!nama) { setGalat('nama', 'Nama pemesan wajib diisi.'); daftarGalat.push('Nama pemesan wajib diisi.'); }
        if (!tgl) { setGalat('tanggal', 'Tanggal pesanan wajib dipilih.'); daftarGalat.push('Tanggal pesanan wajib dipilih.'); }
        else if (tgl < hariIniISO()) { setGalat('tanggal', 'Tanggal pesanan tidak boleh tanggal yang sudah lewat.'); daftarGalat.push('Tanggal pesanan tidak boleh tanggal yang sudah lewat.'); }

        items.forEach(function (it, idx) {
            var pesan = '';
            var j = jenisById(it.jenis);
            var n = parseInt(it.jumlah, 10);
            if (!it.jenis) pesan = 'Jenis kue wajib dipilih.';
            else if (!it.produk || !produkById(j, it.produk)) pesan = 'Produk kue wajib dipilih.';
            else if (isNaN(n) || n < 1) pesan = 'Jumlah harus berupa angka minimal 1.';
            setGalat('item-' + idx, pesan);
            if (pesan) daftarGalat.push('Kue ' + (idx + 1) + ': ' + pesan);
        });
        return daftarGalat;
    }

    function susunPesan() {
        var nama = document.getElementById('nama').value.trim();
        var tgl = document.getElementById('tanggal').value;

        var tglIndo = new Date(tgl + 'T00:00:00').toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        var baris = [];

        baris.push('HALO JAJANAN BUDE');
        baris.push('');
        baris.push('Saya ingin melakukan pemesanan kue dengan detail berikut:');
        baris.push('');

        // Data pemesan
        baris.push('DATA PEMESAN');
        baris.push('Nama: ' + nama);
        baris.push('');

        // Daftar pesanan
        baris.push('DAFTAR PESANAN');

        items.forEach(function (it, idx) {
            var j = jenisById(it.jenis);
            var p = produkById(j, it.produk);

            baris.push('');
            baris.push((idx + 1) + '. ' + p.nama);
            baris.push('   Kategori: ' + j.nama);
            baris.push('   Jumlah: ' + parseInt(it.jumlah, 10));

            if (it.catatan.trim()) {
                baris.push('   Catatan: ' + it.catatan.trim());
            }
        });

        baris.push('');
        baris.push('TANGGAL PENGAMBILAN');
        baris.push(tglIndo);

        baris.push('');
        baris.push('KONFIRMASI');
        baris.push('Mohon konfirmasi:');
        baris.push('1. Harga total pesanan.');
        baris.push('2. Ketersediaan pesanan pada tanggal tersebut.');

        baris.push('');
        baris.push('Terima kasih.');

        return baris.join('\n');
    }

    document.getElementById('tambah-item').addEventListener('click', function () {
        items.push(itemBaru(null));
        render();
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var galat = validasi();
        if (galat.length) {
            ringkasan.hidden = false;
            ringkasan.textContent = 'Periksa kembali isian formulir (' + galat.length + ' bagian perlu diperbaiki).';
            ringkasan.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        }
        ringkasan.hidden = true;
        var url = 'https://wa.me/' + cfg.wa + '?text=' + encodeURIComponent(susunPesan());
        var w = window.open(url, '_blank', 'noopener');
        if (!w) { window.location.href = url; }
    });

    document.getElementById('tanggal').setAttribute('min', hariIniISO());
    items.push(itemBaru(cfg.awal));
    render();
})();
