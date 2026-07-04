<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Kasir Pro - Sneat System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase text-primary">🏪 KASIR-PRO</span>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
  <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
  <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
    <a href="/dashboard" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div>Dashboard Utama</div>
    </a>
  </li>

  <li class="menu-header small text-uppercase"><span class="menu-header-text">Transaksi</span></li>
  <li class="menu-item {{ Request::is('kasir') ? 'active' : '' }}">
    <a href="/kasir" class="menu-link">
      <i class="menu-icon tf-icons bx bx-store-alt"></i>
      <div>Mesin Kasir</div>
    </a>
  </li>
  <li class="menu-item {{ Request::is('riwayat') ? 'active' : '' }}">
    <a href="/riwayat" class="menu-link">
      <i class="menu-icon tf-icons bx bx-receipt"></i>
      <div>Riwayat Penjualan</div>
    </a>
  </li>

  @if(auth()->check() && auth()->user()->role == 'admin')
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen</span></li>
    <li class="menu-item {{ Request::is('produk') ? 'active' : '' }}">
      <a href="/produk" class="menu-link">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div>Kelola Produk (Stok)</div>
      </a>
    </li>
    <li class="menu-item {{ Request::is('pelanggan') ? 'active' : '' }}">
      <a href="/pelanggan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div>Data Pelanggan / Member</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
    <li class="menu-item {{ Request::is('pengaturan') ? 'active' : '' }}">
      <a href="/pengaturan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div>Pengaturan Toko</div>
      </a>
    </li>
  @endif

  <li class="menu-header small text-uppercase"><span class="menu-header-text">Sesi</span></li>
  <li class="menu-item p-3">
    <form action="/logout" method="POST" id="form-logout">
      @csrf
      <button type="submit" class="btn btn-danger w-100 fw-bold shadow-sm">
        <i class="bx bx-power-off me-1"></i> KELUAR / LOGOUT
      </button>
    </form>
  </li>
</ul>
        </aside>
        <div class="layout-page">
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div class="navbar-nav align-items-center">
                <span class="fw-semibold text-muted">Selamat Datang di Sistem Kasir Pro Digital</span>
              </div>
            </div>
          </nav>
          <div class="content-wrapper">
            
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © {{ date('Y') }}, Made with ❤️ for Kasir Pro System
                </div>
              </div>
            </footer>
            <div class="content-backdrop fade"></div>
          </div>
          </div>
        </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('scripts')
  </body>
</html>