<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKue extends Model
{
    protected $table = 'jenis_kue';
    protected $primaryKey = 'id_jenis';
    public $timestamps = false;
    protected $fillable = ['nama_jenis'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_jenis', 'id_jenis');
    }
}
