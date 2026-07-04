<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Tambahkan 'pelanggan_id' di sini agar bisa disimpan saat checkout
    protected $fillable = ['total_harga', 'pelanggan_id'];

    // Hubungkan transaksi ke model Pelanggan (Relasi belongsTo)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}