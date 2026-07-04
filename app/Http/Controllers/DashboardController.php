<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pengaturan;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Halaman Dashboard Utama (Statistik)
    public function index()
    {
        $totalProduk = \App\Models\Produk::count();
        $totalTransaksi = Transaksi::count();
        $omzet = Transaksi::sum('total_harga');

        return view('dashboard', compact('totalProduk', 'totalTransaksi', 'omzet'));
    }

    // Halaman Riwayat Penjualan (UNTUK CETAK LAPORAN)
    public function riwayat()
    {
        // 1. ATUR TIMEZONE agar jam cetaknya akurat sesuai WIB / waktu lokal kamu saat ini
        date_default_timezone_set('Asia/Jakarta');

        // 2. Ambil data transaksi terbaru (gunakan path lengkap agar dijamin terbaca)
        $transaksis = \App\Models\Transaksi::latest()->get();

        // 3. Ambil data Pengaturan Toko yang baris pertama
        $pengaturan = \App\Models\Pengaturan::first();

        // 4. Kirim semua datanya ke halaman view
        return view('riwayat', compact('transaksis', 'pengaturan'));
    }
}