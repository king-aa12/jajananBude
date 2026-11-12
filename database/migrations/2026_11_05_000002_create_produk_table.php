<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_jenis');
            $table->string('nama_produk', 100);
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('ukuran', 50)->nullable();
            $table->unsignedInteger('harga_min')->default(0);

            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_kue')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
