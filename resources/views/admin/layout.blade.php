<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Kelola Katalog') | Admin JAJANAN BUDE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="admin">
    <header class="topbar">
        <div class="wrap topbar-isi topbar-dalam">
            <a href="{{ route('beranda') }}" class="ikon-btn" aria-label="Ke website" title="Ke website">&lsaquo;</a>
            <h1 class="topbar-judul">Kelola Katalog</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="tombol tombol-kecil tombol-garis">@include('partials.ikon', ['n' => 'keluar']) Keluar</button>
            </form>
        </div>
    </header>

    <main class="isi">
        <div class="wrap">
            <div class="chips">
                <a href="{{ route('admin.produk.index') }}" class="chip {{ request()->routeIs('admin.produk.*') ? 'aktif' : '' }}">Produk</a>
                <a href="{{ route('admin.jenis.index') }}" class="chip {{ request()->routeIs('admin.jenis.*') ? 'aktif' : '' }}">Jenis Kue</a>
            </div>

            @yield('content')
        </div>
    </main>

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('partials.notifikasi')
    @stack('scripts')
</body>
</html>