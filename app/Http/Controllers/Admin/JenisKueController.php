<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKue;
use Illuminate\Http\Request;

class JenisKueController extends Controller
{
    private function pesan(): array
    {
        return [
            'nama_jenis.required' => 'Nama jenis kue wajib diisi.',
            'nama_jenis.max' => 'Nama jenis kue maksimal 50 karakter.',
        ];
    }

    public function index()
    {
        $jenis = JenisKue::withCount('produk')->orderBy('nama_jenis')->get();

        return view('admin.jenis.index', compact('jenis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama_jenis' => 'required|string|max:50'], $this->pesan());
        JenisKue::create($data);

        return redirect()->route('admin.jenis.index')->with('status', 'Jenis kue berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin.jenis.edit', ['jenis' => JenisKue::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $jenis = JenisKue::findOrFail($id);
        $data = $request->validate(['nama_jenis' => 'required|string|max:50'], $this->pesan());
        $jenis->update($data);

        return redirect()->route('admin.jenis.index')->with('status', 'Jenis kue berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis = JenisKue::withCount('produk')->findOrFail($id);

        if ($jenis->produk_count > 0) {
            return redirect()->route('admin.jenis.index')
                ->with('gagal', 'Jenis kue tidak dapat dihapus karena masih dipakai oleh ' . $jenis->produk_count . ' produk.');
        }

        $jenis->delete();

        return redirect()->route('admin.jenis.index')->with('status', 'Jenis kue berhasil dihapus.');
    }
}
