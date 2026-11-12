@extends('admin.layout')
@section('judul', 'Jenis Kue')

@section('content')
<form method="POST" action="{{ route('admin.jenis.store') }}" class="kartu-form baris-form">
    @csrf
    <div class="grow">
        <label class="label" for="nama_jenis">Tambah jenis kue</label>
        <input class="input" type="text" id="nama_jenis" name="nama_jenis" maxlength="50" placeholder="Contoh: Bolu" value="{{ old('nama_jenis') }}" required>
        @error('nama_jenis')<div class="galat tampil">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="tombol">Tambah</button>
</form>

@if ($jenis->isEmpty())
    <p class="kosong">Belum ada jenis kue.</p>
@else
    <div class="daftar-admin">
        @foreach ($jenis as $j)
            <article class="kartu-admin">
                <div class="kartu-admin-isi">
                    <h3>{{ $j->nama_jenis }}</h3>
                    <div class="ket">{{ $j->produk_count }} produk</div>
                </div>
                <div class="aksi">
                    <a href="{{ route('admin.jenis.edit', $j->id_jenis) }}" class="tombol tombol-sedang">Ubah</a>
                    <form method="POST" action="{{ route('admin.jenis.destroy', $j->id_jenis) }}" data-konfirmasi="Hapus jenis kue {{ $j->nama_jenis }}?">
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
