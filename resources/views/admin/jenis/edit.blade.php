@extends('admin.layout')
@section('judul', 'Ubah Jenis Kue')

@section('content')
<form method="POST" action="{{ route('admin.jenis.update', $jenis->id_jenis) }}" class="kartu-form">
    @csrf
    @method('PUT')
    <h2 class="judul-bagian kecil">Ubah Jenis Kue</h2>

    <label class="label" for="nama_jenis">Nama jenis kue *</label>
    <input class="input" type="text" id="nama_jenis" name="nama_jenis" maxlength="50" value="{{ old('nama_jenis', $jenis->nama_jenis) }}" required>
    @error('nama_jenis')<div class="galat tampil">{{ $message }}</div>@enderror

    <div class="baris-tombol">
        <a href="{{ route('admin.jenis.index') }}" class="tombol tombol-garis">Batal</a>
        <button type="submit" class="tombol">Simpan</button>
    </div>
</form>
@endsection
