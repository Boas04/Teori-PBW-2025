<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{id}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
Route::get('/tambah-berita', [NewsController::class, 'create'])->name('news.create');
Route::post('/tambah-berita', [NewsController::class, 'store'])->name('news.store');
Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::get('/kategori/{id}', [CategoryController::class, 'index'])->name('kategori.show');
