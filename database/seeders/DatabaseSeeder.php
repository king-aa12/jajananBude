<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\JenisKue;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin awal. Segera ganti kata sandi setelah login pertama
        // (atau atur ADMIN_PASSWORD di file .env sebelum menjalankan seeder).
        Admin::updateOrCreate(
            ['username' => env('ADMIN_USERNAME', 'admin')],
            ['password' => Hash::make(env('ADMIN_PASSWORD', 'admin12345'))]
        );

        $bolu = JenisKue::firstOrCreate(['nama_jenis' => 'Bolu']);
        $puding = JenisKue::firstOrCreate(['nama_jenis' => 'Puding']);
        $basah = JenisKue::firstOrCreate(['nama_jenis' => 'Kue Basah']);

        // Data contoh (sesuai desain). Silakan ubah melalui halaman admin.
        $contoh = [
            ['id_jenis' => $bolu->id_jenis, 'nama_produk' => 'Bolu Caramel', 'harga_min' => 70000, 'ukuran' => '25 cm',
                'foto' => 'images/produk/bolu-caramel.jpg',
                'deskripsi' => 'Bolu caramel dengan warna cokelat khas dan tekstur bersarang yang lembut. Memiliki rasa manis karamel dengan aroma harum dan cita rasa yang khas, cocok untuk teman minum teh atau kopi.'],
            ['id_jenis' => $puding->id_jenis, 'nama_produk' => 'Puding Fla', 'harga_min' => 3000, 'ukuran' => null,
                'foto' => 'images/produk/puding-fla.jpg',
                'deskripsi' => 'Puding lembut dengan saus fla creamy yang manis dan lezat.'],
            ['id_jenis' => $basah->id_jenis, 'nama_produk' => 'Lemper', 'harga_min' => 3000, 'ukuran' => null,
                'foto' => 'images/produk/lemper.jpg',
                'deskripsi' => 'Ketan pulen berisi ayam berbumbu yang gurih dan dibungkus daun pisang.'],
            ['id_jenis' => $bolu->id_jenis, 'nama_produk' => 'Bolu Tape', 'harga_min' => 70000, 'ukuran' => null,
                'foto' => 'images/produk/bolu-tape.jpg',
                'deskripsi' => 'Bolu empuk dengan rasa manis dan aroma khas tape singkong.'],
        ];

        foreach ($contoh as $row) {
            Produk::firstOrCreate(['nama_produk' => $row['nama_produk']], $row);
        }
    }
}
