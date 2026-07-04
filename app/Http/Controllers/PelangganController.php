<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Tampil data pelanggan
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        return view('pelanggan', compact('pelanggans'));
    }

    // Tambah pelanggan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
        ]);

        Pelanggan::create($request->all());
        return redirect()->back()->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    // Update data pelanggan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());
        return redirect()->back()->with('success', 'Data Pelanggan berhasil diperbarui!');
    }

    // Hapus pelanggan
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->back()->with('success', 'Data Pelanggan berhasil dihapus!');
    }
}