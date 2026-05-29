@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #1A1412;">Edit Paket</h2>
        <p class="text-muted">Perbarui informasi detail paket Glad Moments & Co. di bawah ini.</p>
    </div>

    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Layanan Induk *</label>
                <select name="service_id" class="form-select" required>
                    <option value="">— Pilih Layanan —</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @selected(old('service_id', $package->service_id) == $service->id)>
                            {{ $service->name }} ({{ $service->slug }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Paket *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga Paket (Rp) *</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $package->price) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Paket *</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $package->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 8px;">Batal</a>
                <button type="submit" class="btn text-white px-4" style="background-color: #1A1412; border-radius: 8px;">Update Paket</button>
            </div>
        </form>
    </div>
</div>
@endsection
