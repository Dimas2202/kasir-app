<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// ==================== 1. JALUR UTAMA (Halaman Depan) ====================
// Ketika orang membuka http://127.0.0.1:8000
Route::get('/', function () {
    // Jika dia sudah login, langsung lempar ke /dashboard
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    // Jika belum login, langsung hadang dan lempar ke /login
    return redirect('/login');
});

// ==================== 2. JALUR KHUSUS LOGIN & LOGOUT ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==================== 3. ZONA AMAN (WAJIB LOGIN) ====================
Route::middleware(['auth'])->group(function () {
    
    // 🔓 BISA DIAKSES OLEH ADMIN & KASIR SETELAH LOGIN
    // PERBAIKAN DI SINI: Dashboard dialihkan ke DashboardController agar datanya muncul sempurna
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/kasir', [ProdukController::class, 'kasir']);
    Route::post('/checkout', [ProdukController::class, 'checkout']);
    Route::get('/riwayat', [DashboardController::class, 'riwayat']); 

    // 🔒 HANYA BISA DIAKSES OLEH ADMIN (ROLE == ADMIN)
    Route::middleware(['can:access-admin'])->group(function () {
        // Kelola Produk
        Route::get('/produk', [ProdukController::class, 'index']);

        // Data Pelanggan / Member
        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::post('/pelanggan/tambah', [PelangganController::class, 'store']);
        Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);
        Route::delete('/pelanggan/hapus/{id}', [PelangganController::class, 'destroy']);

        // Pengaturan Toko
        Route::get('/pengaturan', [PengaturanController::class, 'index']);
        Route::post('/pengaturan/update', [PengaturanController::class, 'update']);
    });
});