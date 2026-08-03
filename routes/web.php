<?php

use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PetaLayananController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
require __DIR__.'/auth.php';

// Gabungkan semua route admin di sini
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('admin.statistik');
    
    // BARIS TAMBAHAN UNTUK SIMPAN LAPORAN
    Route::post('/laporan/store', [StatistikController::class, 'store'])->name('admin.laporan.store');
});
/*
|--------------------------------------------------------------------------
| Routes untuk Dashboard SAAT 112
|--------------------------------------------------------------------------
| Sesuaikan controller/action lain (profil, berita, laporan, dst) dengan
| controller yang sudah kamu buat di project Laravel-mu masing-masing.
*/

Route::get('/', [DashboardController::class, 'index'])->name('beranda');

// Contoh route lain yang dipanggil dari view (sesuaikan dengan controllermu)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/laporan', fn () => view('laporan.index'))->name('laporan.index');
Route::get('/laporan/buat', fn () => view('laporan.create'))->name('laporan.create');
Route::get('/galeri', fn () => view('galeri'))->name('galeri');
Route::get('/kritik-saran', fn () => view('kritik-saran'))->name('kritik-saran');
Route::get('/peta/kutai-timur', [PetaLayananController::class, 'index'])->name('peta.kutai-timur');
Route::get('/peta/kutai-timur/data', [PetaLayananController::class, 'dataJson'])->name('peta.kutai-timur.data');
