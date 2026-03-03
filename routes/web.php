<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\InternalAuthController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TamuController::class, 'beranda'])->name('beranda');
Route::get('/katalog', [TamuController::class, 'katalog'])->name('katalog');
Route::get('/informasi', [TamuController::class, 'informasi'])->name('informasi');
Route::get('/kontak', [TamuController::class, 'kontak'])->name('kontak');

Route::view('/login/siswa', 'auth.login-siswa')->name('login.siswa');
Route::view('/masuk-internal', 'auth.login-internal')->name('login.internal');
Route::view('/login-internal', 'auth.login-internal');
Route::post('/masuk-internal', [InternalAuthController::class, 'login'])->name('login.internal.post');
Route::post('/login-internal', [InternalAuthController::class, 'login']);
Route::post('/keluar-internal', [InternalAuthController::class, 'logout'])->name('logout.internal');
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

Route::redirect('/home', '/');
Route::redirect('/dashboard', '/');

Route::fallback(function () {
    return redirect('/');
});
