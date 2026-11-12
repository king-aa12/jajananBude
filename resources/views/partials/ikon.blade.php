@php
    $paths = [
        'katalog'  => '<path d="M4 13h16l-1.2 6.2a1 1 0 0 1-1 .8H6.2a1 1 0 0 1-1-.8L4 13z"/><path d="M6 13a6 5 0 0 1 12 0"/><path d="M12 6V4"/>',
        'ketentuan'=> '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
        'formulir' => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/>',
        'tentang'  => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7"/>',
        'kontak'   => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A15 15 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
        'cari'     => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.5-4.5"/>',
        'jam'      => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'lokasi'   => '<path d="M12 21s7-6.2 7-11a7 7 0 0 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
        'keluar'   => '<path d="M9 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4"/><path d="M16 17l5-5-5-5M21 12H9"/>',
        'mangkuk'  => '<path d="M3 12h18a9 8 0 0 1-18 0z"/><path d="M14 11L18 3M11 11l2-8M16 11l4-6"/>',
        'hati'     => '<path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/>',
        'senyum'   => '<circle cx="12" cy="12" r="9"/><path d="M8.5 14a4.5 4 0 0 0 7 0M9 9.5h.01M15 9.5h.01"/>',
        'panah'    => '<path d="M9 5l7 7-7 7"/>',
        'tutup'    => '<path d="M5 5l14 14M19 5L5 19"/>',
        'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'wa'       => '<path d="M20 12a8 8 0 0 1-11.8 7L4 20l1.1-4A8 8 0 1 1 20 12z"/><path d="M9 8.5c.3 2.3 2.7 4.7 5.5 5.5l1.2-1.4-2-1-.8.8c-.9-.4-1.8-1.3-2.2-2.2l.8-.8-1-2L9 8.5z"/>',
    ];
@endphp
<svg class="ikon {{ $kelas ?? '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $paths[$n] ?? '' !!}</svg>
