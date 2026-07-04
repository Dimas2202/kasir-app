<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom di bawah diisi secara massal
    protected $fillable = [
        'nama_pelanggan',
        'telepon',
        'alamat'
    ];
}