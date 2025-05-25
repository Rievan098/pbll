<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BorrowController; // Pindahkan ke atas bersama yang lain
use App\Models\Barang;


// -------------------- LANDING --------------------
Route::get('/', function () {
    return view('landing');
});

// -------------------- USER --------------------

// Dashboard User
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // List Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    // Peminjaman
    Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])->name('pinjam.form');
    Route::post('/pinjam/{id}', [PeminjamanController::class, 'store'])->name('pinjam.barang');

    // Riwayat Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    // Proses Pengembalian
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/return/{id}', [BorrowController::class, 'returnItem'])->name('return.item');
});

// -------------------- ADMIN --------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Barang CRUD
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});

// -------------------- AUTH --------------------

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::middleware(['auth'])->group(function () {
    // Daftar peminjaman user/admin
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    // Proses pengembalian barang oleh admin
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
});

Route::patch('/admin/peminjaman/{id}/return', [App\Http\Controllers\PeminjamanController::class, 'return'])->name('admin.peminjaman.return');

Route::get('/', function () {
    $barangs = Barang::where('stok', '>', 0)->get(); // Ambil hanya barang yang tersedia
    return view('landing', compact('barangs')); // Kirim ke landing.blade.php
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('barang', BarangController::class);
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
});
