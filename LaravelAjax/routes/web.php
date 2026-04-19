<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

// Route AJAX untuk mengambil data JSON
Route::get('/mahasiswa/data', [MahasiswaController::class, 'getData'])->name('mahasiswa.data');