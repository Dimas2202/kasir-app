<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // 1. HALAMAN BARU: Dashboard Utama (Ringkasan statistik)
    public function dashboard()
    {
        $totalProduk = Produk::count();
        $totalTransaksi = Transaksi::count();
        $omzet = Transaksi::sum('total_harga');

        return view('dashboard', compact('totalProduk', 'totalTransaksi', 'omzet'));
    }

    public function kasir()
    {
        $produks = Produk::all();
        $pelanggans = Pelanggan::all(); // Ambil data pelanggan untuk dropdown
        return view('kasir', compact('produks', 'pelanggans'));
    }

    public function checkout(Request $request)
    {
        // Validasi input transaksi
        $request->validate([
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
            'total_harga' => 'required|numeric|min:1',
        ]);

        // 1. Simpan data transaksi utama (termasuk pelanggan_id)
        $transaksi = Transaksi::create([
            'total_harga' => $request->total_harga,
            'pelanggan_id' => $request->pelanggan_id, // Menyimpan id pelanggan
        ]);

        // 2. Kurangi stok produk
        foreach ($request->produk_id as $key => $id) {
            $produk = Produk::find($id);
            if ($produk) {
                $produk->stok -= $request->jumlah[$key];
                $produk->save();
            }
        }

        return redirect('/kasir')->with('success', 'Transaksi berhasil diproses!');
    }


    // 3. FUNGSI LAMA YANG DIUBAH: Sekarang khusus untuk halaman Kelola Produk saja
    public function index()
    {
        $produks = Produk::all();
        return view('produk', compact('produks'));
    }

    // 4. FUNGSI LAMA: Menyimpan produk baru (Tetap dipertahankan)
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Produk::create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // 5. FUNGSI LAMA: Mengupdate data produk (Tetap dipertahankan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Produk berhasil diupdate!');
    }

    // 6. FUNGSI LAMA: Menghapus produk (Tetap dipertahankan)
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

}