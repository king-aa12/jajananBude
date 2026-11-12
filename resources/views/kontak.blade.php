@extends('layouts.app')
@section('judul', 'Kontak')

@section('content')
@php
    $wa = config('jajanan.wa_number');
    $pesanWa = urlencode('Halo JAJANAN BUDE, saya ingin memesan kue.');
    $alamat = config('jajanan.alamat');
@endphp
<div class="wrap narrow">
    <h2 class="judul-bagian">Hubungi Kami</h2>
    <p class="deskripsi">Jika ada pertanyaan atau ingin memesan, langsung hubungi kami melalui kontak berikut.</p>

    <div class="kartu-kontak">
        <span class="bulat hijau">@include('partials.ikon', ['n' => 'kontak'])</span>
        <div><strong>WhatsApp</strong><span>{{ config('jajanan.wa_display') }}</span></div>
    </div>
    <div class="kartu-kontak">
        <span class="bulat">@include('partials.ikon', ['n' => 'lokasi'])</span>
        <div><strong>Lokasi</strong><span>{{ $alamat }}</span></div>
    </div>

    @if (config('jajanan.maps_embed'))
        <iframe class="peta" src="{{ config('jajanan.maps_embed') }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta lokasi JAJANAN BUDE"></iframe>
    @else
        <a class="peta peta-tautan" target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($alamat) }}">
            @include('partials.ikon', ['n' => 'lokasi'])<span>Lihat lokasi di Google Maps</span>
        </a>
    @endif

    <a class="tombol tombol-besar tombol-wa" target="_blank" rel="noopener" href="https://wa.me/{{ $wa }}?text={{ $pesanWa }}">
        @include('partials.ikon', ['n' => 'wa']) Pesan Sekarang
    </a>
</div>
@endsection
