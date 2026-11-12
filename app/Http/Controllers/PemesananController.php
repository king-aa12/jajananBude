<?php

namespace App\Http\Controllers;

use App\Models\JenisKue;
use App\Models\Produk;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Menampilkan formulir pemesanan. Pesanan TIDAK disimpan di database:
     * detail pesanan disusun di sisi browser (public/js/pesan.js) lalu dikirim
     * ke WhatsApp penjual melalui tautan click-to-chat.
     */
    public function form(Request $request)
    {
        $jenis = JenisKue::with(['produk' => fn ($q) => $q->orderBy('nama_produk')])
            ->orderBy('nama_jenis')
            ->get()
            ->map(fn ($j) => [
                'id' => $j->id_jenis,
                'nama' => $j->nama_jenis,
                'produk' => $j->produk->map(fn ($p) => [
                    'id' => $p->id_produk,
                    'nama' => $p->nama_produk,
                    'harga' => $p->harga_format,
                ])->values(),
            ])->values();

        $awal = null;
        if ($request->filled('produk')) {
            $p = Produk::find($request->query('produk'));
            if ($p) {
                $awal = ['jenis' => $p->id_jenis, 'produk' => $p->id_produk];
            }
        }

        return view('pesan', [
            'jenis' => $jenis,
            'awal' => $awal,
            'waNumber' => config('jajanan.wa_number'),
        ]);
    }
}
