<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\JenisKueController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PemesananController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman pelanggan (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [HalamanController::class, 'beranda'])->name('beranda');
Route::get('/ketentuan', [HalamanController::class, 'ketentuan'])->name('ketentuan');
Route::get('/tentang', [HalamanController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HalamanController::class, 'kontak'])->name('kontak');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/produk/{id}', [KatalogController::class, 'show'])->name('produk.detail');

Route::get('/pesan', [PemesananController::class, 'form'])->name('pesan');

/*
|--------------------------------------------------------------------------
| Halaman admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.produk.index'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('admin.login.post');

    Route::middleware(EnsureAdmin::class)->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
        Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
        Route::get('/produk/{id}/ubah', [ProdukController::class, 'edit'])->name('admin.produk.edit');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

        Route::get('/jenis', [JenisKueController::class, 'index'])->name('admin.jenis.index');
        Route::post('/jenis', [JenisKueController::class, 'store'])->name('admin.jenis.store');
        Route::get('/jenis/{id}/ubah', [JenisKueController::class, 'edit'])->name('admin.jenis.edit');
        Route::put('/jenis/{id}', [JenisKueController::class, 'update'])->name('admin.jenis.update');
        Route::delete('/jenis/{id}', [JenisKueController::class, 'destroy'])->name('admin.jenis.destroy');
    });
});
