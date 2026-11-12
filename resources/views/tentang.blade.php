@extends('layouts.app')
@section('judul', 'Tentang Kami')

@section('content')
<div class="wrap narrow">
    <div class="banner banner-tengah">
        @include('partials.ikon', ['n' => 'katalog', 'kelas' => 'banner-ikon'])
        <div class="brand brand-besar">JAJANAN BUDE</div>
        <p>{{ config('jajanan.tagline') }}</p>
    </div>

    <h2 class="judul-bagian">Tentang Kami</h2>
    <p class="deskripsi">Jajanan Bude adalah usaha rumahan yang menyediakan berbagai kue lezat dengan rasa yang selalu terjaga. Kami menggunakan bahan-bahan berkualitas dan dibuat dengan penuh cinta, agar setiap gigitan menjadi momen yang istimewa.</p>

    <div class="tiga">
        <div class="kotak">@include('partials.ikon', ['n' => 'mangkuk'])<span>Bahan Berkualitas</span></div>
        <div class="kotak">@include('partials.ikon', ['n' => 'hati'])<span>Pelayanan Ramah</span></div>
        <div class="kotak">@include('partials.ikon', ['n' => 'senyum'])<span>Rasa Lezat</span></div>
    </div>

    <p class="kutipan">&ldquo;Karena kebahagiaan bisa dimulai dari sepotong kue&rdquo;</p>
</div>
@endsection
