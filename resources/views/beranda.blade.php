@extends('layouts.app')
@section('judul', 'Beranda')
@section('beranda', '1')

@section('content')
<div class="wrap">
    <section class="hero">
        <div>
            <h2>Katalog &amp;<br>Pemesanan<br>Kue Online</h2>
            <p>Kue lezat, dibuat dengan bahan terbaik untuk momen spesialmu.</p>
        </div>
        @include('partials.ikon', ['n' => 'mangkuk', 'kelas' => 'hero-ikon'])
    </section>

    <nav class="menu-grid" aria-label="Menu utama">
        <a href="{{ route('katalog') }}" class="menu-item aktif">@include('partials.ikon', ['n' => 'katalog'])<span>Katalog Kue</span></a>
        <a href="{{ route('ketentuan') }}" class="menu-item">@include('partials.ikon', ['n' => 'ketentuan'])<span>Ketentuan Pesanan</span></a>
        <a href="{{ route('pesan') }}" class="menu-item">@include('partials.ikon', ['n' => 'formulir'])<span>Formulir Pemesanan</span></a>
        <a href="{{ route('tentang') }}" class="menu-item">@include('partials.ikon', ['n' => 'tentang'])<span>Tentang Kami</span></a>
        <a href="{{ route('kontak') }}" class="menu-item">@include('partials.ikon', ['n' => 'kontak'])<span>Kontak</span></a>
    </nav>

    <section>
        <div class="bagian-judul">
            <h3>Produk Pilihan</h3>
            <a href="{{ route('katalog') }}" class="tautan-kecil">Lihat Semua &rsaquo;</a>
        </div>
        @if ($pilihan->isEmpty())
            <p class="kosong">Belum ada produk. Silakan tambahkan melalui halaman admin.</p>
        @else
            <div class="pilihan">
                @foreach ($pilihan as $p)
                    <a href="{{ route('produk.detail', $p->id_produk) }}" class="kartu-mini">
                        @include('partials.foto', ['p' => $p])
                        <div class="kartu-mini-isi">
                            <div class="nama">{{ $p->nama_produk }}</div>
                            <div class="harga">{{ $p->harga_format }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
