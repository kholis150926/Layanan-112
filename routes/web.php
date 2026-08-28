<?php

use Illuminate\Support\Facades\Route;

// Import Controller Public
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PetaLayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\BeritaController;

// Import Controller Admin
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\Admin\KritikSaranController as AdminKritikSaranController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Depan - Bebas Diakses Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('beranda');

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Depan Pengguna Umum)
|--------------------------------------------------------------------------
*/

// Akses 127.0.0.1:8000 langsung menampilkan Dashboard / Beranda Pengguna
Route::get('/', function () {
    return view('dashboard');
})->name('beranda');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Route Berita Public (Gunakan BeritaController, BUKAN AdminBeritaController)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Route Laporan (Sudah Benar)
Route::get('/laporan', fn () => view('tentang.index'))->name('laporan.index');
Route::get('/laporan/buat', fn () => view('laporan.create'))->name('laporan.create');

// Route Kritik & Saran Public (Disambungkan ke name 'kritik-saran' dan 'kritik-saran.index')
Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

// Route Galery Public
Route::get('/galery', fn () => view('galery'))->name('galery');

// Route Peta Kutai Timur
Route::get('/peta/kutai-timur', [PetaLayananController::class, 'index'])->name('peta.kutai-timur');
Route::get('/peta/kutai-timur/data', [PetaLayananController::class, 'dataJson'])->name('peta.kutai-timur.data');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Auth User & Admin Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Wajib Login / Auth)
| Admin Panel Routes (Hanya Bisa Diakses Setelah Login Admin)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard & Statistik Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Dashboard Admin -> Akses: 127.0.0.1:8000/admin/dashboard
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

    // CRUD Galery Admin
    Route::get('/galery', [GaleryController::class, 'index'])->name('admin.galery.index');
    Route::post('/galery', [GaleryController::class, 'store'])->name('admin.galery.store');
    Route::put('/galery/{id}', [GaleryController::class, 'update'])->name('admin.galery.update');
    Route::delete('/galery/{id}', [GaleryController::class, 'destroy'])->name('admin.galery.destroy');

    // Riwayat Admin
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');

    // Kritik & Saran Kelola Admin
    Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('admin.kritik-saran.index');
    Route::patch('/kritik-saran/{kritikSaran}/status', [AdminKritikSaranController::class, 'updateStatus'])->name('admin.kritik-saran.update-status');
    Route::delete('/kritik-saran/{kritikSaran}', [AdminKritikSaranController::class, 'destroy'])->name('admin.kritik-saran.destroy');
    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');

    // CRUD Kritik & Saran (Di dalam grup admin)
    Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('admin.kritik-saran.index');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');
    Route::get('/kritik-saran/riwayat', [KritikSaranController::class, 'riwayat'])->name('admin.kritik-saran.riwayat');
    Route::patch('/kritik-saran/{id}/read', [KritikSaranController::class, 'markAsRead'])->name('admin.kritik-saran.read');
    Route::delete('/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('admin.kritik-saran.destroy');
});