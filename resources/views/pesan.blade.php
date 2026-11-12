@extends('layouts.app')
@section('judul', 'Formulir Pemesanan')

@section('content')
<div class="wrap narrow">
    <div id="ringkasan-galat" class="peringatan" role="alert" hidden></div>

    <form id="form-pesan" novalidate>
        <label class="label" for="nama">Nama pemesan</label>
        <input class="input" type="text" id="nama" name="nama" maxlength="60" placeholder="Nama kamu" autocomplete="name">
        <div class="galat" data-galat="nama"></div>

        <label class="label" for="tanggal">Tanggal Pengambilan</label>
        <input class="input" type="date" id="tanggal" name="tanggal">
        <div class="galat" data-galat="tanggal"></div>

        <h2 class="judul-bagian kecil">Pesanan Kue</h2>
        <div id="daftar-item"></div>

        <button type="button" class="tombol tombol-garis" id="tambah-item">+ Tambah Jenis Kue</button>
        <button type="submit" class="tombol tombol-besar">Kirim Pesanan ke WhatsApp</button>
        <p class="catatan-harga">Pesanan tidak disimpan di website. Detail pesanan dikirim melalui WhatsApp, lalu harga dan kesepakatan dikonfirmasi langsung dengan penjual. Baca <a href="{{ route('ketentuan') }}">ketentuan pesanan</a>.</p>
    </form>
</div>
@endsection

@push('scripts')
<script>
    window.PESAN = {
        jenis: @json($jenis),
        awal: @json($awal),
        wa: @json($waNumber)
    };
</script>
<script src="{{ asset('js/pesan.js') }}"></script>
@endpush
