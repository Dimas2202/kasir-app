<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User; // Tambahkan ini agar pemanggilan User lebih rapi

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. ISI DATA AKUN LOGIN (Wajib di dalam fungsi run)
        User::create([
            'name' => 'CEO Admin',
            'email' => 'admin@toko.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siti Kasir',
            'email' => 'kasir@toko.com',
            'password' => bcrypt('password123'),
            'role' => 'kasir',
        ]);

        // 1. ISI DATA DUMMY PRODUK
        $produkData = [
            ['nama_produk' => 'Kopi Susu Gula Aren', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Matcha Latte Premium', 'harga' => 22000, 'stok' => 35],
            ['nama_produk' => 'Croissant Cokelat XL', 'harga' => 25000, 'stok' => 20],
            ['nama_produk' => 'Americano Ice', 'harga' => 15000, 'stok' => 60],
            ['nama_produk' => 'Red Velvet Cake', 'harga' => 28000, 'stok' => 15],
            ['nama_produk' => 'Indomie Goreng Double', 'harga' => 12000, 'stok' => 100],
            ['nama_produk' => 'Es Teh Manis Jumbo', 'harga' => 5000, 'stok' => 200],
            ['nama_produk' => 'Kentang Goreng Keju', 'harga' => 17000, 'stok' => 40],
        ];

        foreach ($produkData as $p) {
            Produk::create($p);
        }

        // 2. ISI DATA DUMMY PELANGGAN / MEMBER
        $pelangganData = [
            ['nama_pelanggan' => 'Rian Hidayat', 'telepon' => '081234567890', 'alamat' => 'Jl. Merdeka No. 12'],
            ['nama_pelanggan' => 'Siti Aminah', 'telepon' => '085712345678', 'alamat' => 'Perum Indah Permai Blok C'],
            ['nama_pelanggan' => 'Budi Santoso', 'telepon' => '081987654321', 'alamat' => 'Kos Hijau, Gang Kelinci'],
            ['nama_pelanggan' => 'Amanda Putri', 'telepon' => '082133445566', 'alamat' => 'Apartemen Gading Lantai 5'],
        ];

        foreach ($pelangganData as $plg) {
            Pelanggan::create($plg);
        }

        // 3. ISI DATA DUMMY RIWAYAT TRANSAKSI
        $transaksiData = [
            ['total_harga' => 35000, 'created_at' => now()->subDays(2)],
            ['total_harga' => 68000, 'created_at' => now()->subDays(1)->subHours(3)],
            ['total_harga' => 15000, 'created_at' => now()->subHours(5)],
            ['total_harga' => 92000, 'created_at' => now()->subHours(2)],
            ['total_harga' => 43000, 'created_at' => now()->subMinutes(15)],
        ];

        foreach ($transaksiData as $trx) {
            Transaksi::create($trx);
        }
    }
}