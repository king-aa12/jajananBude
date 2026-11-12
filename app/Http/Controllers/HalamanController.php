<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class HalamanController extends Controller
{
    public function beranda()
    {
        $pilihan = Produk::with('jenis')->orderBy('id_produk')->take(3)->get();

        return view('beranda', compact('pilihan'));
    }

    public function ketentuan()
    {
        return view('ketentuan');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function kontak()
    {
        return view('kontak');
    }
}
