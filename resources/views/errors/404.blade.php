@extends('layouts.app')
@section('judul', 'Halaman tidak ditemukan')

@section('content')
<div class="wrap narrow">
    <div class="banner banner-tengah">
        <h2>404</h2>
        <p>Halaman yang kamu cari tidak ditemukan.</p>
    </div>
    <a href="{{ route('beranda') }}" class="tombol tombol-besar">Kembali ke Beranda</a>
</div>
@endsection
