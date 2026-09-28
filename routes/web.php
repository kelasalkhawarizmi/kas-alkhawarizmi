<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\AuthController;

// Halaman Bebas (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Kas Terproteksi (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [KasController::class, 'index'])->name('kas.index');
    Route::post('/kas/bayar-mingguan', [KasController::class, 'bayarMingguan'])->name('kas.bayarMingguan');
    Route::post('/kas/bayar-bulanan', [KasController::class, 'bayarBulanan'])->name('kas.bayarBulanan');
    Route::delete('/kas/batal-bayar/{id}', [KasController::class, 'batalBayar'])->name('kas.batalBayar');
    Route::post('/kas/pengeluaran', [KasController::class, 'storeExpense'])->name('kas.storeExpense');
    Route::delete('/kas/hapus-pengeluaran/{id}', [KasController::class, 'destroyExpense'])->name('kas.destroyExpense');
    Route::get('/kas/cetak-laporan', [KasController::class, 'cetakLaporan'])->name('kas.cetakLaporan');
    Route::get('/kas/download-pdf', [KasController::class, 'downloadPdf'])->name('kas.downloadPdf');
    Route::get('/kas/rekap-tahunan', [KasController::class, 'rekapTahunan'])->name('kas.rekapTahunan');
    Route::get('/kas/backup-data', [KasController::class, 'backupData'])->name('kas.backupData');
});