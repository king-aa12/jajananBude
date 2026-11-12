<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;
    protected $fillable = ['id_jenis', 'nama_produk', 'deskripsi', 'foto', 'ukuran', 'harga_min'];

    public function jenis()
    {
        return $this->belongsTo(JenisKue::class, 'id_jenis', 'id_jenis');
    }

    /** Harga minimum dalam format rupiah, contoh: Rp 70.000 */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_min, 0, ',', '.');
    }

    /** URL foto: foto bawaan (folder public/images) atau hasil unggahan admin (storage). */
    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }
        if (str_starts_with($this->foto, 'images/')) {
            return asset($this->foto);
        }
        return asset('storage/' . $this->foto);
    }

    public function getDeskripsiSingkatAttribute(): string
    {
        return \Illuminate\Support\Str::limit((string) $this->deskripsi, 70);
    }
}
