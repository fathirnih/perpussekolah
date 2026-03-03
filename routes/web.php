<?php

use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TamuController::class, 'beranda'])->name('beranda');
Route::get('/katalog', [TamuController::class, 'katalog'])->name('katalog');
Route::get('/informasi', [TamuController::class, 'informasi'])->name('informasi');
Route::get('/kontak', [TamuController::class, 'kontak'])->name('kontak');

Route::view('/login/siswa', 'auth.login-siswa')->name('login.siswa');
Route::view('/masuk-internal', 'auth.login-internal')->name('login.internal');

Route::redirect('/home', '/');
Route::redirect('/dashboard', '/');

Route::fallback(function () {
    return redirect('/');
});
