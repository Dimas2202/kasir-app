@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Sistem /</span> Pengaturan Toko</h4>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✨ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <h5 class="card-header fw-bold">⚙️ Profil & Identitas Toko</h5>
            <div class="card-body">
                <form action="/pengaturan/update" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Toko / Usaha</label>
                        <input type="text" name="nama_toko" class="form-control" value="{{ $pengaturan->nama_toko ?? 'Aplikasi Kasir POS' }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Slogan Toko (Muncul di bawah nama toko)</label>
                        <input type="text" name="slogan_toko" class="form-control" value="{{ $pengaturan->slogan_toko }}" placeholder="Contoh: Selera Bintang Lima, Harga Kaki Lima">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon / HP Toko</label>
                        <input type="text" name="telepon_toko" class="form-control" value="{{ $pengaturan->telepon_toko }}" placeholder="Contoh: 021-xxxxxx atau 08xxxxxx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap Toko</label>
                        <textarea name="alamat_toko" class="form-control" rows="3" placeholder="Tulis alamat toko yang akan tercetak di struk belanja...">{{ $pengaturan->alamat_toko }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary fw-bold px-4"><i class="bx bx-save me-1"></i> Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection