<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKue;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    private function aturan(): array
    {
        return [
            'nama_produk' => 'required|string|max:100',
            'id_jenis' => 'required|exists:jenis_kue,id_jenis',
            'harga_min' => 'required|integer|min:0|max:100000000',
            'ukuran' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function pesan(): array
    {
        return [
            'nama_produk.required' => 'Nama kue wajib diisi.',
            'id_jenis.required' => 'Jenis kue wajib dipilih.',
            'id_jenis.exists' => 'Jenis kue tidak valid.',
            'harga_min.required' => 'Harga minimum wajib diisi.',
            'harga_min.integer' => 'Harga minimum harus berupa angka bulat.',
            'harga_min.min' => 'Harga minimum tidak boleh negatif.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpg, png, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $produk = Produk::with('jenis')
            ->when($q !== '', fn ($query) => $query->where('nama_produk', 'like', '%' . $q . '%'))
            ->orderBy('id_produk')
            ->get();

        return view('admin.produk.index', compact('produk', 'q'));
    }

    public function create()
    {
        return view('admin.produk.form', [
            'produk' => new Produk(),
            'jenis' => JenisKue::orderBy('nama_jenis')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin.produk.form', [
            'produk' => Produk::findOrFail($id),
            'jenis' => JenisKue::orderBy('nama_jenis')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('foto')) {
            $this->hapusFoto($produk);
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        } else {
            unset($data['foto']);
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $this->hapusFoto($produk);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('status', 'Produk berhasil dihapus.');
    }

    /** Hapus berkas foto hasil unggahan (foto bawaan di public/images tidak dihapus). */
    private function hapusFoto(Produk $produk): void
    {
        if ($produk->foto && ! str_starts_with($produk->foto, 'images/')) {
            Storage::disk('public')->delete($produk->foto);
        }
    }
}
