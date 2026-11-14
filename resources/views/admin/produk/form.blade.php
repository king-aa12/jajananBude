@extends('admin.layout')
@php $ubah = $produk->exists; @endphp
@section('judul', $ubah ? 'Ubah Produk' : 'Tambah Produk')

@section('content')
<form method="POST" enctype="multipart/form-data" class="kartu-form"
      data-simpan="{{ $ubah ? 'Simpan perubahan produk ini?' : 'Tambahkan produk ini ke katalog?' }}"
      action="{{ $ubah ? route('admin.produk.update', $produk->id_produk) : route('admin.produk.store') }}">
    @csrf
    @if ($ubah) @method('PUT') @endif

    <h2 class="judul-bagian kecil">{{ $ubah ? 'Ubah Produk' : 'Tambah Produk' }}</h2>

    <label class="label" for="nama_produk">Nama kue *</label>
    <input class="input" type="text" id="nama_produk" name="nama_produk" maxlength="100" value="{{ old('nama_produk', $produk->nama_produk) }}" required>

    <label class="label" for="id_jenis">Jenis kue *</label>
    <select class="input" id="id_jenis" name="id_jenis" required>
        <option value="">Pilih jenis kue</option>
        @foreach ($jenis as $j)
            <option value="{{ $j->id_jenis }}" {{ (string) old('id_jenis', $produk->id_jenis) === (string) $j->id_jenis ? 'selected' : '' }}>{{ $j->nama_jenis }}</option>
        @endforeach
    </select>

    <label class="label" for="harga_min">Harga minimum (Rp) *</label>
    <input class="input" type="number" id="harga_min" name="harga_min" min="0" step="500" value="{{ old('harga_min', $produk->harga_min) }}" required>
    <small class="bantuan">Harga mulai dari. Harga akhir ditetapkan setelah negosiasi dengan pembeli.</small>

    <label class="label" for="ukuran">Ukuran</label>
    <input class="input" type="text" id="ukuran" name="ukuran" maxlength="50" placeholder="Contoh: 25 cm" value="{{ old('ukuran', $produk->ukuran) }}">

    <label class="label" for="deskripsi">Deskripsi</label>
    <textarea class="input" id="deskripsi" name="deskripsi" rows="5" maxlength="1000" placeholder="Deskripsi singkat kue">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

    <label class="label" for="foto">Foto</label>
    @if ($ubah && $produk->foto_url)
        <img class="foto foto-kecil pratinjau" src="{{ $produk->foto_url }}" alt="Foto saat ini">
    @endif
    <input class="input" type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
    <small class="bantuan">Format JPG, PNG, atau WEBP. Maksimal 2 MB.{{ $ubah ? ' Kosongkan jika tidak ingin mengganti foto.' : '' }}</small>

    <div class="baris-tombol">
        <a href="{{ route('admin.produk.index') }}" class="tombol tombol-garis">Batal</a>
        <button type="submit" class="tombol">Simpan</button>
    </div>
</form>
@endsection