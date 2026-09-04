<?php

use Illuminate\Support\Facades\Route;

// Import Controller Public (Pengguna Umum)
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PetaLayananController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;

// Import Controller Admin
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\GaleryController as AdminGaleryController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\Admin\KritikSaranController as AdminKritikSaranController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Depan Pengguna Umum)
|--------------------------------------------------------------------------
*/

// Beranda (Mengambil data berita terbaru melalui BeritaController)
Route::get('/', [BeritaController::class, 'beranda'])->name('beranda');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', fn () => view('dashboard'))->name('beranda');
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Berita Public
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Laporan Public
Route::get('/laporan', fn () => view('tentang.index'))->name('laporan.index');
Route::get('/laporan/buat', fn () => view('laporan.create'))->name('laporan.create');

// Kritik & Saran Public
Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

// Galery Public (Menggunakan GaleriController)
Route::get('/galery', [GaleriController::class, 'index'])->name('galery');

// Peta Kutai Timur
Route::get('/peta/kutai-timur', [PetaLayananController::class, 'index'])->name('peta.kutai-timur');
Route::get('/peta/kutai-timur/data', [PetaLayananController::class, 'dataJson'])->name('peta.kutai-timur.data');


/*
|--------------------------------------------------------------------------
| Auth User & Admin Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilController::class, 'destroy'])->name('profile.destroy');
});

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Hanya Bisa Diakses Setelah Login Admin)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('admin.statistik');
    Route::post('/laporan/store', [StatistikController::class, 'store'])->name('admin.laporan.store');

    // CRUD Berita Admin
    Route::resource('berita', AdminBeritaController::class)->names([
        'index'   => 'admin.berita.index',
        'create'  => 'admin.berita.create',
        'store'   => 'admin.berita.store',
        'edit'    => 'admin.berita.edit',
        'update'  => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ]);

    // Galery Admin
    Route::get('/galery', [AdminGaleryController::class, 'index'])->name('admin.galery.index');
    Route::post('/galery', [AdminGaleryController::class, 'store'])->name('admin.galery.store');
    Route::put('/galery/{id}', [AdminGaleryController::class, 'update'])->name('admin.galery.update');
    Route::delete('/galery/{id}', [AdminGaleryController::class, 'destroy'])->name('admin.galery.destroy');

    // Riwayat Umum Admin
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');

    // Kelola Kritik & Saran
    Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('admin.kritik-saran.index');
    Route::get('/kritik-saran/riwayat', [AdminKritikSaranController::class, 'riwayat'])->name('admin.kritik-saran.riwayat');
    Route::patch('/kritik-saran/{id}/read', [AdminKritikSaranController::class, 'markAsRead'])->name('admin.kritik-saran.read');
    Route::delete('/kritik-saran/{id}', [AdminKritikSaranController::class, 'destroy'])->name('admin.kritik-saran.destroy');

});