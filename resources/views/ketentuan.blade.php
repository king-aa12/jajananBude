@extends('layouts.app')
@section('judul', 'Ketentuan Pesanan')

@section('content')
<div class="wrap narrow">
    <div class="banner">
        @include('partials.ikon', ['n' => 'formulir'])
        <p>Baca ketentuan berikut sebelum membuat pesanan.</p>
    </div>

    <ol class="ketentuan">
        <li>Pemesanan dilakukan melalui formulir dan diteruskan ke WhatsApp</li>
        <li>Harga ditetapkan setelah negosiasi dengan penjual</li>
        <li>Pembayaran melalui transfer atau tunai setelah harga disepakati</li>
        <li>Ketentuan lain sesuai kebijakan penjual</li>
    </ol>

    <a href="{{ route('pesan') }}" class="tombol tombol-besar">Buat Pesanan</a>
</div>
@endsection
