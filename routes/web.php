<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Database\Capsule\Manager;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

Route::get('/', function () {
    return view('dashboard.main');
});


Route::get('/anggota', function () {
    return view('dashboard.table');
})->name('dashboard.table');


//route manager tambah,edit,delete data anggota
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota', [AnggotaController::class, 'index'])->name('dashboard.table');
Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');


//route surat
Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('suratMasuk.index');
Route::post('/surat-masuk', [SuratMasukController::class, 'store'])->name('suratMasuk.store');
Route::get('/surat-masuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('suratMasuk.edit');
Route::put('/surat-masuk/{id}', [SuratMasukController::class, 'update'])->name('suratMasuk.update');
Route::delete('/surat-masuk/{id}', [SuratMasukController::class, 'destroy'])->name('suratMasuk.destroy');

Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('suratKeluar.index');
Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('suratKeluar.store');
Route::get('/surat-keluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('suratKeluar.edit');
Route::put('/surat-keluar/{id}', [SuratKeluarController::class, 'update'])->name('suratKeluar.update');
Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratKeluar.destroy');
