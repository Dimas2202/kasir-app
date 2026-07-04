@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Transaksi /</span> Mesin Kasir</h4>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">✨ {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">❌ {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="row">
    <!-- KIRI: Daftar Menu Produk -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <h5 class="card-header fw-bold">📦 Pilih Menu Produk</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produks as $produk)
                        <tr>
                            <td><strong>{{ $produk->nama_produk }}</strong></td>
                            <td class="text-primary fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td><span class="badge bg-label-secondary">{{ $produk->stok }} Pcs</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success rounded-pill px-3" onclick="tambahKeKeranjang({{ $produk->id }}, '{{ $produk->nama_produk }}', {{ $produk->harga }}, {{ $produk->stok }})"><i class="bx bx-plus"></i> Pilih</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KANAN: Struk Belanja & Tombol Checkout -->
    <div class="col-lg-5">
        <div class="card border-top border-success border-3">
            <div class="card-body p-4">
                <h5 class="fw-bold text-success mb-3"><i class="bx bx-receipt"></i> Struk Belanja</h5>
                
                <form action="/checkout" method="POST">
                    @csrf
                    
                    <!-- Dropdown Pilihan Member -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">👤 Pilih Pelanggan / Member</label>
                        <select name="pelanggan_id" class="form-select border-success">
                            <option value="">-- Pembeli Umum (Non-Member) --</option>
                            @foreach($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->telepon ?? '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="hidden" name="total_harga" id="input-total-harga" value="0">
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr class="border-bottom">
                                    <th>Nama</th>
                                    <th width="80px">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang-list-db"></tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                        <h5 class="m-0 fw-bold">Total Tagihan:</h5>
                        <h3 id="total-harga-display" class="text-danger fw-bold m-0">Rp 0</h3>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 mt-4 fw-bold py-2 shadow-sm btn-lg"><i class="bx bx-check-shield"></i> PROSES TRANSAKSI</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let total = 0;
    function tambahKeKeranjang(id, nama, harga, stok) {
        let list = document.getElementById('keranjang-list-db');
        let produkAda = document.querySelector(`input[name="produk_id[]"][value="${id}"]`);
        
        if (produkAda) {
            let row = produkAda.closest('tr');
            let inputJumlah = row.querySelector('.input-jumlah');
            let jumlahBaru = parseInt(inputJumlah.value) + 1;
            if (jumlahBaru > stok) { alert(`Stok maksimum hanya ${stok} Pcs.`); return; }
            inputJumlah.value = jumlahBaru;
        } else {
            if (stok < 1) { alert(`Stok habis!`); return; }
            let row = document.createElement('tr');
            row.innerHTML = `
                <td><span class="small">🛍️ ${nama}</span><input type="hidden" name="produk_id[]" value="${id}"></td>
                <td><input type="number" name="jumlah[]" class="form-control form-control-sm text-center input-jumlah" value="1" min="1" max="${stok}" oninput="hitungUlangTotal()"><input type="hidden" class="harga-satuan" value="${harga}"></td>
                <td class="text-end fw-bold subtotal-cell small">Rp ${harga.toLocaleString('id-ID')}</td>
            `;
            list.appendChild(row);
        }
        hitungUlangTotal();
    }

    function hitungUlangTotal() {
        total = 0;
        let rows = document.querySelectorAll('#keranjang-list-db tr');
        rows.forEach(row => {
            let qty = parseInt(row.querySelector('.input-jumlah').value) || 0;
            let harga = parseInt(row.querySelector('.harga-satuan').value);
            let subtotal = qty * harga;
            row.querySelector('.subtotal-cell').innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
            total += subtotal;
        });
        document.getElementById('total-harga-display').innerText = `Rp ${total.toLocaleString('id-ID')}`;
        document.getElementById('input-total-harga').value = total;
    }
</script>
@endsection