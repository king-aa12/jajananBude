<div class="drawer" id="drawer" hidden>
    <div class="wrap">
        <div class="drawer-atas">
            <div class="brand">JAJANAN<br>BUDE</div>
            <button type="button" class="ikon-btn" data-tutup-drawer aria-label="Tutup menu">@include('partials.ikon', ['n' => 'tutup'])</button>
        </div>
        <div class="drawer-judul">Menu</div>
        <nav class="drawer-menu">
            <a href="{{ route('katalog') }}">@include('partials.ikon', ['n' => 'katalog'])<span>Katalog Kue</span>@include('partials.ikon', ['n' => 'panah', 'kelas' => 'panah'])</a>
            <a href="{{ route('ketentuan') }}">@include('partials.ikon', ['n' => 'ketentuan'])<span>Ketentuan Pesanan</span>@include('partials.ikon', ['n' => 'panah', 'kelas' => 'panah'])</a>
            <a href="{{ route('pesan') }}">@include('partials.ikon', ['n' => 'formulir'])<span>Formulir Pemesanan</span>@include('partials.ikon', ['n' => 'panah', 'kelas' => 'panah'])</a>
            <a href="{{ route('tentang') }}">@include('partials.ikon', ['n' => 'tentang'])<span>Tentang Kami</span>@include('partials.ikon', ['n' => 'panah', 'kelas' => 'panah'])</a>
            <a href="{{ route('kontak') }}">@include('partials.ikon', ['n' => 'kontak'])<span>Kontak</span>@include('partials.ikon', ['n' => 'panah', 'kelas' => 'panah'])</a>
        </nav>
    </div>
</div>
