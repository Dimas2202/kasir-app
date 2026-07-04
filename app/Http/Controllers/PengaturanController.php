<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Ambil data pengaturan pertama, jika belum ada kita buatkan data default kosong
        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        return view('pengaturan', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
        ]);

        // Cari data pertama, jika tidak ada maka buat baru
        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        $pengaturan->nama_toko = $request->nama_toko;
        $pengaturan->telepon_toko = $request->telepon_toko;
        $pengaturan->alamat_toko = $request->alamat_toko;
        $pengaturan->slogan_toko = $request->slogan_toko;
        $pengaturan->save();

        return redirect()->back()->with('success', '⚙️ Pengaturan Toko berhasil diperbarui!');
    }
}