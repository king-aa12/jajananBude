@extends('layouts.app')
@section('judul', 'Detail Produk')
@section('kembali', route('katalog'))

@section('content')
<div class="wrap narrow">
    @include('partials.foto', ['p' => $produk, 'kelas' => 'foto-besar'])
    <h2 class="detail-nama">{{ $produk->nama_produk }}</h2>
    <div class="harga harga-besar">{{ $produk->harga_format }}</div>
    <p class="deskripsi">{{ $produk->deskripsi ?: 'Belum ada deskripsi.' }}</p>
    <p class="catatan-harga">Harga yang ditampilkan adalah harga minimum (harga mulai dari). Harga akhir ditetapkan setelah negosiasi dengan penjual sesuai spesifikasi pesanan.</p>

    <div class="info-dua">
        <div class="info">@include('partials.ikon', ['n' => 'jam'])<div><small>Ukuran</small><strong>{{ $produk->ukuran ?: '-' }}</strong></div></div>
        <div class="info">@include('partials.ikon', ['n' => 'katalog'])<div><small>Jenis</small><strong>{{ $produk->jenis->nama_jenis ?? '-' }}</strong></div></div>
    </div>

    <a href="{{ route('pesan', ['produk' => $produk->id_produk]) }}" class="tombol tombol-besar">Pesan Sekarang</a>
</div>
@endsection
