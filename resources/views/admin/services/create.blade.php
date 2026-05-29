@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Layanan Baru</h2>
        <p class="text-muted">Masukkan detail paket layanan baru untuk Glad Moments & Co.</p>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Layanan</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Wedding Package" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Contoh: 5000000" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Tulis detail deskripsi layanan di sini..." required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Teks Badge Pink</label>
                <input type="text" name="badge_label" class="form-control" value="{{ old('badge_label') }}" placeholder="Contoh: Premium Photobooth">
                <small class="text-muted">Teks ini akan ditampilkan pada label berwarna pink di kartu layanan.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Layanan</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Unggah gambar service untuk ditampilkan di homepage. File JPG, PNG, GIF, atau WebP maksimal 5 MB.</small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-dark px-4">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection