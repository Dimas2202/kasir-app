@extends('layouts.app')

@section('content')
<div class="print-only-header text-center mb-4 d-none">
    <h2>{{ $pengaturan->nama_toko ?? 'Aplikasi Kasir Dimsly' }}</h2>
    <p class="mb-1"><em>"{{ $pengaturan->slogan_toko ?? 'Menyediakan Kebutuhan Anda' }}"</em></p>
    <p class="mb-1">Alamat: {{ $pengaturan->alamat_toko ?? '-' }} | Telp: {{ $pengaturan->telepon_toko ?? '-' }}</p>
    <hr style="border: 2px solid #000; opacity: 1;">
    <h3 class="text-uppercase mt-4 fw-bold">LAPORAN RIWAYAT PENJUALAN</h3>
    <p class="text-muted small">Dicetak pada: {{ date('d F Y H:i') }} WIB</p>
</div>

<div class="card p-3" id="area-tabel-laporan">
  <div class="card-header d-flex justify-content-between align-items-center no-print px-0">
    <h5 class="m-0 fw-bold">Riwayat Transaksi Penjualan</h5>
    <button onclick="window.print()" class="btn btn-success fw-bold">
        <i class="bx bx-printer me-1"></i> CETAK LAPORAN
    </button>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table table-striped table-hover m-0" id="tabel-print-spek">
      <thead>
        <tr>
          <th>No. Nota</th>
          <th>Tanggal & Waktu</th>
          <th>Pelanggan</th>
          <th>Total Pembayaran</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($transaksis as $transaksi)
        <tr>
          <td><strong class="text-primary">#TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
          <td>{{ $transaksi->created_at->format('d M Y, H:i') }} WIB</td>
          <td>
            <i class="bx bx-user me-1 text-muted"></i> 
            {{ $transaksi->pelanggan ? $transaksi->pelanggan->nama_pelanggan : 'Pembeli Umum' }}
          </td>
          <td class="fw-bold text-success">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
          <td class="text-center"><span class="badge bg-label-success text-dark">Selesai / Lunas</span></td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat transaksi masuk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<style>
@media print {
    /* 1. Sembunyikan semua elemen layouting web bawaan template */
    .layout-menu, .layout-navbar, .no-print, footer, .content-footer, .btn, .navbar, .menu-inner {
        display: none !important;
    }
    
    /* 2. Nol-kan margin container pembungkus agar cetakan penuh di kertas */
    .layout-page, .content-wrapper, .container-xxl {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* 3. Munculkan Kop Toko yang tadinya kita sembunyikan */
    .print-only-header {
        display: block !important;
    }
    
    /* 4. Amankan area pembungkus tabel agar tidak ikut tersembunyi */
    #area-tabel-laporan {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        background: transparent !important;
    }
    
    /* 5. Paksa tabel agar membuat garis hitam tegas saat diprint */
    #tabel-print-spek {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }
    #tabel-print-spek th, #tabel-print-spek td {
        border: 1px solid #000 !important;
        color: #000 !important;
        padding: 8px !important;
        white-space: normal !important;
    }
}
</style>
@endsection