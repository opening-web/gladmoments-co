@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Service Management</h2>
            <p class="text-muted mb-0">Kelola semua paket layanan dokumentasi foto dan video Glad Moments & Co.</p>
        </div>
        <div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-sm px-3 py-2 text-white" style="background-color: #B39467; font-weight: 500; border-radius: 8px;">
                <i class="fa-solid fa-plus me-1"></i> Tambah Layanan Baru
            </a>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-left: 4px solid #2e7d32 !important;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card card-custom shadow-sm border-0 bg-white overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                <thead style="background-color: #1A1412; color: #E6E1DA;">
                    <tr>
                        <th class="py-3 px-4" style="width: 60px;">No</th>
                        <th class="py-3">Nama Layanan</th>
                        <th class="py-3">Gambar</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3">Deskripsi</th>
                        <th class="py-3 text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $service)
                        <tr>
                            <td class="px-4 text-muted">{{ $index + 1 }}</td>
                            <td class="fw-bold" style="color: #1A1412;">{{ $service->name }}</td>
                        <td>
                            @if($service->image_url)
                                <img src="{{ $service->image_url }}" width="80" class="rounded" alt="{{ $service->name }}">
                            @else
                                <span class="text-muted small">Belum ada gambar</span>
                            @endif
                        </td>
                        <td class="text-success fw-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="text-muted text-truncate" style="max-width: 300px;">
                                <a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#descModal{{ $service->id }}">
                                    {{ Str::limit($service->description, 50) }}
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-camera-retro fa-2xl mb-3 d-block" style="color: #D1C9BC;"></i>
                                Belum ada data layanan. Klik tombol <strong>Tambah Layanan Baru</strong> untuk mengisi data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($services as $service)
<div class="modal fade" id="descModal{{ $service->id }}" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="descModalLabel">{{ $service->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="white-space: pre-line;">{{ $service->description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection