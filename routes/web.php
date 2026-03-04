<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DokumentasiPerpusController;
use App\Http\Controllers\InternalAuthController;
use App\Http\Controllers\KelasController;
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
use App\Http\Controllers\SiswaProfileController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::middleware('siswa.redirect:siswa.dashboard')->group(function () {
    Route::get('/', [TamuController::class, 'beranda'])->name('beranda');
    Route::get('/galeri', [TamuController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{dokumentasi}', [TamuController::class, 'galeriDetail'])->name('galeri.detail');
    Route::get('/galeri-id/{dokumentasiId}', [TamuController::class, 'galeriDetailById'])->name('galeri.detail.id');
    Route::get('/katalog', [TamuController::class, 'katalog'])->name('katalog');
    Route::get('/buku/{buku}', [TamuController::class, 'detail'])->name('buku.detail');
    Route::get('/informasi', [TamuController::class, 'informasi'])->name('informasi');
    Route::get('/kontak', [TamuController::class, 'kontak'])->name('kontak');
    Route::view('/login/siswa', 'auth.login-siswa')->name('login.siswa');
});
Route::post('/login/siswa', [SiswaAuthController::class, 'login'])->name('login.siswa.post');
Route::post('/keluar-siswa', [SiswaAuthController::class, 'logout'])->name('logout.siswa');

Route::middleware('siswa.auth')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/beranda', [TamuController::class, 'beranda'])->name('beranda');
    Route::get('/galeri', [TamuController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{dokumentasi}', [TamuController::class, 'galeriDetail'])->name('galeri.detail');
    Route::get('/galeri-id/{dokumentasiId}', [TamuController::class, 'galeriDetailById'])->name('galeri.detail.id');
    Route::get('/katalog', [TamuController::class, 'katalog'])->name('katalog');
    Route::get('/buku/{buku}', [TamuController::class, 'detail'])->name('buku.detail');
    Route::get('/informasi', [TamuController::class, 'informasi'])->name('informasi');
    Route::get('/kontak', [TamuController::class, 'kontak'])->name('kontak');
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
    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');
    Route::resource('/admin/kelas', KelasController::class)->except(['show'])->names('admin.kelas');
    Route::resource('/admin/kategori-buku', KategoriBukuController::class)->except(['show'])->names('admin.kategori');
    Route::resource('/admin/rak', RakController::class)->except(['show'])->names('admin.rak');
    Route::resource('/admin/buku', BukuController::class)->names('admin.buku');
    Route::get('/admin/peminjaman', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
    Route::get('/admin/peminjaman/create', [AdminPeminjamanController::class, 'create'])->name('admin.peminjaman.create');
    Route::post('/admin/peminjaman', [AdminPeminjamanController::class, 'store'])->name('admin.peminjaman.store');
    Route::get('/admin/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'show'])->name('admin.peminjaman.show');
    Route::get('/admin/peminjaman/{peminjaman}/edit', [AdminPeminjamanController::class, 'edit'])->name('admin.peminjaman.edit');
    Route::put('/admin/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'update'])->name('admin.peminjaman.update');
    Route::delete('/admin/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');
    Route::get('/admin/dokumentasi/{dokumentasi}/detail', [DokumentasiPerpusController::class, 'show'])->name('admin.dokumentasi.show');
    Route::resource('/admin/dokumentasi', DokumentasiPerpusController::class)
        ->except(['show'])
        ->parameters(['dokumentasi' => 'dokumentasi'])
        ->names('admin.dokumentasi');
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
