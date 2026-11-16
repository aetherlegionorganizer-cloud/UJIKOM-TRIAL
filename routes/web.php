<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // KHUSUS ADMIN (User, Kategori, Alat, Hapus Transaksi)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/simpan', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/hapus/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/simpan', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        Route::get('/alat', [AlatController::class, 'index'])->name('alat.index');
        Route::get('/alat/tambah', [AlatController::class, 'create'])->name('alat.create');
        Route::post('/alat/simpan', [AlatController::class, 'store'])->name('alat.store');
        Route::get('/alat/edit/{id}', [AlatController::class, 'edit'])->name('alat.edit');
        Route::post('/alat/update/{id}', [AlatController::class, 'update'])->name('alat.update');
        Route::get('/alat/hapus/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');

        Route::get('/peminjaman/hapus/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
        Route::get('/pengembalian/hapus/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
    });

    // PETUGAS & ADMIN (Setujui Peminjaman, Pengembalian, Laporan)
    Route::middleware(['role:petugas,admin'])->group(function () {
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman/setujui/{id}', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/pengembalian/pantau', [PengembalianController::class, 'pantau'])->name('pengembalian.pantau');
        Route::post('/pengembalian/simpan', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    });

    // KHUSUS PEMINJAM (Lihat Alat, Ajukan Pinjam, Kembalikan Alat)
    Route::middleware(['role:peminjam'])->group(function () {
        Route::get('/katalog-alat', [PeminjamanController::class, 'katalog'])->name('peminjaman.katalog');
        Route::post('/ajukan-pinjam', [PeminjamanController::class, 'ajukanStore'])->name('peminjaman.ajukan.store');
        Route::get('/peminjaman-saya', [PeminjamanController::class, 'riwayatSaya'])->name('peminjaman.saya');
        Route::post('/kembalikan-alat/{id}', [PengembalianController::class, 'peminjamKembalikan'])->name('peminjaman.kembalikan');
    });
});
