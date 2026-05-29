@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Layanan</h2>
        <p class="text-muted">Perbarui informasi paket layanan Anda di bawah ini.</p>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Layanan</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Teks Badge Pink</label>
                <input type="text" name="badge_label" class="form-control" value="{{ old('badge_label', $service->badge_label) }}" placeholder="Contoh: Premium Photobooth">
                <small class="text-muted">Perbarui teks badge pink yang muncul di kartu layanan.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Layanan</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($service->image_url)
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Gambar Saat Ini</label>
                        <div><img src="{{ $service->image_url }}" class="rounded" style="max-width: 240px; height: auto;"></div>
                    </div>
                @endif
                <small class="text-muted">Unggah gambar baru untuk mengganti gambar service yang ada.</small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-dark px-4">Update Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection