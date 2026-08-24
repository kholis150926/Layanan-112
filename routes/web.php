<?php

use Illuminate\Support\Facades\Route;

// Import Controller Public
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PetaLayananController;
use App\Http\Controllers\ProfileController;

// Import Controller Admin
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\RiwayatController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Depan)
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('beranda');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Route Berita Public (Menggunakan AdminBeritaController)
Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [AdminBeritaController::class, 'show'])->name('berita.show');

Route::get('/laporan', fn () => view('tentang.index'))->name('laporan.index');
Route::get('/laporan/buat', fn () => view('laporan.create'))->name('laporan.create');
Route::get('/kritik-saran', fn () => view('kritik-saran'))->name('kritik-saran');

// Route Galery Public
Route::get('/galery', fn () => view('galery'))->name('galery');

// Route Peta Kutai Timur
Route::get('/peta/kutai-timur', [PetaLayananController::class, 'index'])->name('peta.kutai-timur');
Route::get('/peta/kutai-timur/data', [PetaLayananController::class, 'dataJson'])->name('peta.kutai-timur.data');


/*
|--------------------------------------------------------------------------
| Auth User & Admin Login
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard & Statistik
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('admin.statistik');
    Route::post('/laporan/store', [StatistikController::class, 'store'])->name('admin.laporan.store');

    // CRUD Berita / Kelola Konten
    Route::resource('berita', AdminBeritaController::class)->names([
        'index'   => 'admin.berita.index',
        'create'  => 'admin.berita.create',
        'store'   => 'admin.berita.store',
        'edit'    => 'admin.berita.edit',
        'update'  => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ]);

    // CRUD Galery Admin
    Route::get('/galery', [GaleryController::class, 'index'])->name('admin.galery.index');
    Route::post('/galery', [GaleryController::class, 'store'])->name('admin.galery.store');
    Route::delete('/galery/{id}', [GaleryController::class, 'destroy'])->name('admin.galery.destroy');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');
});