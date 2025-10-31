<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kamu bisa mendefinisikan semua rute web untuk aplikasi kamu.
| Rute ini dimuat oleh RouteServiceProvider dan semuanya akan 
| mendapat grup middleware "web".
|
*/

// Halaman utama: langsung arahkan ke halaman daftar mahasiswa
Route::get('/', function () {
    return redirect('/mahasiswa');
});

// Rute resource untuk CRUD Mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);

// Rute untuk mencetak data Mahasiswa ke PDF
Route::get('/mahasiswa/cetak/pdf', [MahasiswaController::class, 'cetakPDF'])
    ->name('mahasiswa.cetak');

// Rute untuk mengekspor data Mahasiswa ke Excel
Route::get('/mahasiswa/export/excel', [MahasiswaController::class, 'exportExcel'])
    ->name('mahasiswa.exportExcel');
