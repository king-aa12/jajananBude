@extends('layouts.app')
@section('judul', 'Katalog Kue')

@section('content')
<div class="wrap">
    <form method="GET" action="{{ route('katalog') }}" class="cari">
        @include('partials.ikon', ['n' => 'cari'])
        <input type="search" name="q" value="{{ $q }}" placeholder="Cari kue..." aria-label="Cari kue">
        @if ($kategori)<input type="hidden" name="kategori" value="{{ $kategori }}">@endif
    </form>

    <div class="chips">
        <a href="{{ route('katalog', array_filter(['q' => $q])) }}" class="chip {{ $kategori ? '' : 'aktif' }}">Semua</a>
        @foreach ($jenis as $j)
            <a href="{{ route('katalog', array_filter(['q' => $q, 'kategori' => $j->id_jenis])) }}"
               class="chip {{ (string) $kategori === (string) $j->id_jenis ? 'aktif' : '' }}">{{ $j->nama_jenis }}</a>
        @endforeach
    </div>

    @if ($produk->isEmpty())
        <p class="kosong">Kue tidak ditemukan. Coba kata kunci atau kategori lain.</p>
    @else
        <div class="grid-produk">
            @foreach ($produk as $p)
                <article class="kartu">
                    @include('partials.foto', ['p' => $p])
                    <div class="kartu-isi">
                        <h3>{{ $p->nama_produk }}</h3>
                        <div class="harga">{{ $p->harga_format }}</div>
                        <p class="ket">{{ $p->deskripsi_singkat }}</p>
                        <a href="{{ route('produk.detail', $p->id_produk) }}" class="tombol">Detail Produk</a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
