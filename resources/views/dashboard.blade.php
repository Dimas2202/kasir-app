@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat Bekerja, Admin! 🎉</h5>
            <p class="mb-4">Sistem kasir siap digunakan. Pantau inventori produk dan kelola penjualan tokomu hari ini dengan mudah.</p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-4 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-box text-primary fs-3"></i></span>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Macam Produk</span>
        <h3 class="card-title mb-2">{{ $totalProduk }} Jenis</h3>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4 col-md-4 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <span class="badge bg-label-success p-2 rounded"><i class="bx bx-receipt text-success fs-3"></i></span>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Total Transaksi</span>
        <h3 class="card-title mb-2">{{ $totalTransaksi }} Kali</h3>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <span class="badge bg-label-warning p-2 rounded"><i class="bx bx-wallet text-warning fs-3"></i></span>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Total Omzet</span>
        <h3 class="card-title mb-2 text-warning">Rp {{ number_format($omzet, 0, ',', '.') }}</h3>
      </div>
    </div>
  </div>
</div>
@endsection