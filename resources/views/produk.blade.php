@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-2 m-0"><span class="text-muted fw-light">Inventori /</span> Kelola Produk</h4>
    <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="bx bx-plus"></i> Tambah Produk</button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✨ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Harga Jual</th>
          <th>Stok Gudang</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($produks as $produk)
        <tr>
          <td><strong>{{ $produk->nama_produk }}</strong></td>
          <td class="text-primary fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
          <td><span class="badge bg-label-info">{{ $produk->stok }} Pcs</span></td>
          <td class="text-center">
            <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $produk->id }}"><i class="bx bx-edit-alt"></i> Edit</button>
            <form action="/produk/hapus/{{ $produk->id }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i> Hapus</button>
            </form>
          </td>
        </tr>

        <div class="modal fade" id="editModal{{ $produk->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/produk/update/{{ $produk->id }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title fw-bold">⚙️ Edit Produk</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                        <div class="modal-body">
                            <div class="mb-3"><label class="form-label">Nama Produk</label><input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required></div>
                            <div class="mb-3"><label class="form-label">Harga (Rp)</label><input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required></div>
                            <div class="mb-3"><label class="form-label">Stok</label><input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required></div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning fw-bold">Simpan Perubahan</button></div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data produk di inventori.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/produk/tambah" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title fw-bold">➕ Tambah Produk Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Produk</label><input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Kopi Susu"></div>
                    <div class="mb-3"><label class="form-label">Harga Jual (Rp)</label><input type="number" name="harga" class="form-control" required placeholder="0"></div>
                    <div class="mb-3"><label class="form-label">Stok Awal</label><input type="number" name="stok" class="form-control" required placeholder="0"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary fw-bold">Simpan ke Gudang</button></div>
            </form>
        </div>
    </div>
</div>
@endsection