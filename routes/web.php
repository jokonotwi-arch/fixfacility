<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelaporController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - FixFacility (Frontend Views)
|--------------------------------------------------------------------------
|
| Rute frontend terstruktur dengan penamaan route ('pelapor.dashboard', dst.)
| agar tim backend mudah menyambungkan controller/model/auth sesungguhnya.
|
*/

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Portal Pelapor
Route::prefix('pelapor')->name('pelapor.')->group(function () {
    Route::get('/dashboard', [PelaporController::class, 'dashboard'])->name('dashboard');
    
    // CRUD Laporan Pelapor
    Route::get('/laporan', [PelaporController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/buat', [PelaporController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [PelaporController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{kode}', [PelaporController::class, 'show'])->name('laporan.show');
});

// Admin Panel
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Manajemen Laporan Admin
    Route::get('/laporan', [AdminController::class, 'laporanIndex'])->name('laporan.index');
    Route::get('/laporan/{kode}', [AdminController::class, 'laporanShow'])->name('laporan.show');
    Route::post('/laporan/{kode}/status', [AdminController::class, 'laporanUpdate'])->name('laporan.update');
    Route::delete('/laporan/{kode}', [AdminController::class, 'laporanDestroy'])->name('laporan.destroy');
    
    // Rekap Laporan
    Route::get('/rekap', [AdminController::class, 'rekap'])->name('rekap');
});
