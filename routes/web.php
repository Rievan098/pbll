<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Http;

// -------------------- LANDING --------------------
Route::get('/', [LandingController::class, 'showLanding'])->name('landing');

// -------------------- USER --------------------
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    // Tampilkan form peminjaman
    Route::get('/pinjam/form', [PeminjamanController::class, 'create'])->name('pinjam.form');

    // Proses peminjaman
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.barang.store');

    // Daftar peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    // Kembalikan barang
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

    // Return item khusus untuk user
    Route::get('/return/{id}', [BorrowController::class, 'returnItem'])->name('return.item');
});

// -------------------- ADMIN --------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD barang & peminjaman
    Route::resource('barang', BarangController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    // ✅ Route tambahan untuk return peminjaman dari admin
    Route::get('/peminjaman/{id}/return', [PeminjamanController::class, 'return'])->name('peminjaman.return');
});

// -------------------- AUTH --------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::patch('/admin/peminjaman/{id}/return', [PeminjamanController::class, 'kembalikan'])->name('admin.peminjaman.return');