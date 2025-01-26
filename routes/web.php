<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
});

// Route untuk Barang Inventaris
Route::get('/barang-inventaris', [BarangInventarisController::class, 'index']);

// Login  Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::resource('/barang', BarangInventarisController::class);

Route::get('dashboard', [BarangInventarisController::class, 'dashboard'])->name ('dashboard');

//jenis
Route::resource('/jenis', JenisBarangController::class);
Route::get('/barang/jenis', [JenisBarangController::class, 'index'])->name('barang.jenis');

//peminjaman
Route::resource('/peminjaman', PeminjamanController::class);
Route::get('/peminjaman/{pb_id}/pilih-barang', [PeminjamanController::class, 'pilihBarang'])->name('peminjaman.pilihBarang');
Route::post('/peminjaman/{pb_id}/simpan-barang', [PeminjamanController::class, 'simpanBarang'])->name('peminjaman.simpanBarang');
Route::get('/peminjaman/barang-belum-kembali', [PeminjamanController::class, 'barangBelumKembali'])->name('peminjaman.barangBelumKembali');
Route::post('/peminjaman/{pb_id}/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('peminjaman.pengembalian');

//pengembalian
Route::resource('/pengembalian', PengembalianController::class);

//user
Route::resource('/users', UserController::class);




