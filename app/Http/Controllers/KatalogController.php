<?php

namespace App\Http\Controllers;

use App\Models\JenisKue;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $kategori = $request->query('kategori');

        $produk = Produk::with('jenis')
            ->when($q !== '', fn ($query) => $query->where('nama_produk', 'like', '%' . $q . '%'))
            ->when($kategori, fn ($query) => $query->where('id_jenis', $kategori))
            ->orderBy('id_produk')
            ->get();

        $jenis = JenisKue::orderBy('nama_jenis')->get();

        return view('katalog', compact('produk', 'jenis', 'q', 'kategori'));
    }

    public function show($id)
    {
        $produk = Produk::with('jenis')->findOrFail($id);

        return view('detail', compact('produk'));
    }
}
