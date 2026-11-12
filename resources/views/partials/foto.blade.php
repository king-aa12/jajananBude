@if ($p->foto_url)
    <img class="foto {{ $kelas ?? '' }}" src="{{ $p->foto_url }}" alt="{{ $p->nama_produk }}" loading="lazy">
@else
    <div class="foto foto-kosong {{ $kelas ?? '' }}">@include('partials.ikon', ['n' => 'katalog'])</div>
@endif
