@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-2 m-0"><span class="text-muted fw-light">Manajemen /</span> Data Pelanggan</h4>
    <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal"><i class="bx bx-user-plus"></i> Tambah Member</button>
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
          <th>Nama Pelanggan</th>
          <th>No. Telepon / HP</th>
          <th>Alamat</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($pelanggans as $pelanggan)
        <tr>
          <td><strong>{{ $pelanggan->nama_pelanggan }}</strong></td>
          <td><i class="bx bx-phone text-muted me-1"></i> {{ $pelanggan->telepon ?? '-' }}</td>
          <td>{{ $pelanggan->alamat ?? '-' }}</td>
          <td class="text-center">
            <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#editPelangganModal{{ $pelanggan->id }}"><i class="bx bx-edit-alt"></i> Edit</button>
            <form action="/pelanggan/hapus/{{ $pelanggan->id }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data member ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i> Hapus</button>
            </form>
          </td>
        </tr>

        <!-- MODAL EDIT PELANGGAN -->
        <div class="modal fade" id="editPelangganModal{{ $pelanggan->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/pelanggan/update/{{ $pelanggan->id }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title fw-bold">⚙️ Edit Data Pelanggan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                        <div class="modal-body">
                            <div class="mb-3"><label class="form-label">Nama Lengkap</label><input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required></div>
                            <div class="mb-3"><label class="form-label">Nomor Telepon</label><input type="text" name="telepon" class="form-control" value="{{ $pelanggan->telepon }}"></div>
                            <div class="mb-3"><label class="form-label">Alamat Rumah</label><textarea name="alamat" class="form-control" rows="2">{{ $pelanggan->alamat }}</textarea></div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning fw-bold">Simpan Perubahan</button></div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada pelanggan tetap / member terdaftar.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH PELANGGAN -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/pelanggan/tambah" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title fw-bold">👥 Daftarkan Member Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Lengkap</label><input type="text" name="nama_pelanggan" class="form-control" required placeholder="Contoh: Budi Santoso"></div>
                    <div class="mb-3"><label class="form-label">Nomor Telepon / HP</label><input type="text" name="telepon" class="form-control" placeholder="Contoh: 081234567xx"></div>
                    <div class="mb-3"><label class="form-label">Alamat Lengkap</label><textarea name="alamat" class="form-control" rows="2" placeholder="Alamat pelanggan..."></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary fw-bold">Simpan Member</button></div>
            </form>
        </div>
    </div>
</div>
@endsection