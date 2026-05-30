@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Jadwal Baru</h2>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Layanan</label>
                <select name="service_id" class="form-select" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Waktu</label>
                        <input type="time" name="time" class="form-control" value="{{ old('time') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="location" class="form-control" placeholder="Contoh: Studio Utama / Outdoor" value="{{ old('location') }}" required>
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Available" {{ old('status') === 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Booked" {{ old('status') === 'Booked' ? 'selected' : '' }}>Booked</option>
                    <option value="Maintenance" {{ old('status') === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                <div class="form-text">Pilih "Booked" untuk menandai jadwal sebagai sudah terisi. Tanggal ini akan muncul sebagai tidak tersedia di kalender ketersediaan depan.</div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-dark px-4">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>
@endsection