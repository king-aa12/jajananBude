<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Katalog Kue') | JAJANAN BUDE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css', true) }}">
    @stack('head')
</head>
<body>
    @hasSection('beranda')
        <header class="topbar topbar-beranda">
            <div class="wrap topbar-isi">
                <a href="{{ route('beranda') }}" class="brand">JAJANAN<br>BUDE</a>
                <button type="button" class="ikon-btn" data-buka-drawer aria-label="Buka menu">@include('partials.ikon', ['n' => 'menu'])</button>
            </div>
        </header>
    @else
        <header class="topbar">
            <div class="wrap topbar-isi topbar-dalam">
                <a href="@yield('kembali', route('beranda'))" class="ikon-btn" aria-label="Kembali">&lsaquo;</a>
                <h1 class="topbar-judul">@yield('judul')</h1>
                <span class="topbar-kosong"></span>
            </div>
        </header>
    @endif

    <main class="isi">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.drawer')
    <script src="{{ asset('js/app.js', true) }}"></script>
    @stack('scripts')
</body>
</html>
