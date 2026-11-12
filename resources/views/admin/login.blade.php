@extends('layouts.app')
@section('judul', 'Login Admin')

@section('content')
<div class="wrap narrow">
    <div class="banner banner-brand">
        <div>
            <div class="brand brand-besar">JAJANAN<br>BUDE</div>
            <p>Masuk untuk mengelola katalog kue.</p>
        </div>
        @include('partials.ikon', ['n' => 'mangkuk', 'kelas' => 'hero-ikon'])
    </div>

    <form method="POST" action="{{ route('admin.login.post') }}" class="kartu-form">
        @csrf
        <label class="label" for="username">Username</label>
        <input class="input" type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" autofocus>

        <label class="label" for="password">Kata sandi</label>
        <input class="input" type="password" id="password" name="password" placeholder="Masukkan kata sandi" autocomplete="current-password">

        @if (session('gagal'))
            <div class="peringatan" role="alert">{{ session('gagal') }}</div>
        @elseif ($errors->any())
            <div class="peringatan" role="alert">{{ $errors->first() }}</div>
        @endif

        <button type="submit" class="tombol tombol-besar">Masuk</button>
    </form>
</div>
@endsection
