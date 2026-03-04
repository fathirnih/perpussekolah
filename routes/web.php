<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\InternalAuthController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\PetugasLaporanController;
use App\Http\Controllers\PetugasPeminjamanController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaPeminjamanController;
use App\Http\Controllers\SiswaPortalController;
use App\Http\Controllers\SiswaProfileController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::middleware('siswa.redirect:siswa.dashboard')->group(function () {
    Route::get('/', [TamuController::class, 'beranda'])->name('beranda');
    Route::get('/katalog', [TamuController::class, 'katalog'])->name('katalog');
    Route::get('/informasi', [TamuController::class, 'informasi'])->name('informasi');
    Route::get('/kontak', [TamuController::class, 'kontak'])->name('kontak');
    Route::view('/login/siswa', 'auth.login-siswa')->name('login.siswa');
});
Route::post('/login/siswa', [SiswaAuthController::class, 'login'])->name('login.siswa.post');
Route::post('/keluar-siswa', [SiswaAuthController::class, 'logout'])->name('logout.siswa');

Route::middleware('siswa.auth')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/beranda', [SiswaPortalController::class, 'beranda'])->name('beranda');
    Route::get('/katalog', [SiswaPortalController::class, 'katalog'])->name('katalog');
    Route::get('/informasi', [SiswaPortalController::class, 'informasi'])->name('informasi');
    Route::get('/kontak', [SiswaPortalController::class, 'kontak'])->name('kontak');
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/peminjaman', [SiswaPeminjamanController::class, 'indexPeminjaman'])->name('peminjaman.index');
    Route::post('/peminjaman', [SiswaPeminjamanController::class, 'storePeminjaman'])->name('peminjaman.store');
    Route::get('/pengembalian', [SiswaPeminjamanController::class, 'indexPengembalian'])->name('pengembalian.index');
    Route::post('/pengembalian/{peminjaman}/ajukan', [SiswaPeminjamanController::class, 'ajukanPengembalian'])->name('pengembalian.ajukan');
    Route::get('/profil', [SiswaProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [SiswaProfileController::class, 'update'])->name('profil.update');
});

Route::view('/masuk-internal', 'auth.login-internal')->name('login.internal');
Route::view('/login-internal', 'auth.login-internal');
Route::post('/masuk-internal', [InternalAuthController::class, 'login'])->name('login.internal.post');
Route::post('/login-internal', [InternalAuthController::class, 'login']);
Route::post('/keluar-internal', [InternalAuthController::class, 'logout'])->name('logout.internal');

Route::middleware('internal.role:admin')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/admin-user', AdminUserController::class)->except(['show'])->names('admin.user');
    Route::resource('/admin/petugas', PetugasController::class)
        ->except(['show'])
        ->parameters(['petugas' => 'petugas'])
        ->names('admin.petugas');
    Route::resource('/admin/siswa', SiswaController::class)->except(['show'])->names('admin.siswa');
    Route::resource('/admin/kategori-buku', KategoriBukuController::class)->except(['show'])->names('admin.kategori');
    Route::resource('/admin/rak', RakController::class)->except(['show'])->names('admin.rak');
    Route::resource('/admin/buku', BukuController::class)->names('admin.buku');
});

Route::middleware('internal.role:petugas,admin')->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{peminjaman}/proses', [PetugasPeminjamanController::class, 'proses'])->name('peminjaman.proses');
    Route::post('/peminjaman/{peminjaman}/kembalikan', [PetugasPeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/laporan', [PetugasLaporanController::class, 'index'])->name('laporan.index');
});

Route::redirect('/home', '/');
Route::redirect('/dashboard', '/');

Route::fallback(function () {
    return redirect('/');
});
