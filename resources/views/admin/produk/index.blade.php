@extends('admin.layout')
@section('judul', 'Produk')

@section('content')
<form method="GET" action="{{ route('admin.produk.index') }}" class="cari">
    @include('partials.ikon', ['n' => 'cari'])
    <input type="search" name="q" value="{{ $q }}" placeholder="Cari kue..." aria-label="Cari kue">
</form>

<a href="{{ route('admin.produk.create') }}" class="tombol tombol-besar">+ Tambah Produk</a>

@if ($produk->isEmpty())
    <p class="kosong">Belum ada produk{{ $q !== '' ? ' yang cocok dengan pencarian' : '' }}.</p>
@else
    <div class="daftar-admin">
        @foreach ($produk as $p)
            <article class="kartu-admin">
                @include('partials.foto', ['p' => $p, 'kelas' => 'foto-kecil'])
                <div class="kartu-admin-isi">
                    <h3>{{ $p->nama_produk }}</h3>
                    <div class="ket">Jenis: {{ $p->jenis->nama_jenis ?? '-' }}@if ($p->ukuran) &middot; {{ $p->ukuran }}@endif</div>
                    <div class="harga">{{ $p->harga_format }}</div>
                </div>
                <div class="aksi">
                    <a href="{{ route('admin.produk.edit', $p->id_produk) }}" class="tombol tombol-sedang">Ubah</a>
                    <form method="POST" action="{{ route('admin.produk.destroy', $p->id_produk) }}" data-konfirmasi="Hapus produk {{ $p->nama_produk }}?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="tombol tombol-sedang tombol-bahaya">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endif
@endsection
