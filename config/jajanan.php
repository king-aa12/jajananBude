<?php

return [
    // Nomor WhatsApp penjual dalam format internasional tanpa tanda + (contoh: 6289522653885)
    'wa_number' => env('WA_NUMBER', '081522861763'),
    'wa_display' => env('WA_DISPLAY', '0895-2265-3885'),
    'alamat' => env('ALAMAT_USAHA', 'Jl. Adisucipto Asrama Brimob'),
    'tagline' => 'Kue Lezat untuk Setiap Cerita',
    // Tautan peta (Google Maps) untuk halaman Kontak; kosongkan jika belum ada
    'maps_embed' => env('MAPS_EMBED', ''),
];
