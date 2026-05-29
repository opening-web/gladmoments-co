@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Package Management</h2>
            <p class="text-muted mb-0">Kelola daftar paket di bawah masing-masing layanan Glad Moments & Co.</p>
        </div>
        <div>
            <a href="{{ route('admin.packages.create') }}" class="btn btn-sm px-3 py-2 text-white" style="background-color: #B39467; font-weight: 500; border-radius: 8px;">
                <i class="fa-solid fa-plus me-1"></i> Tambah Paket Baru
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
            <table class="table table-hover align-middle mb-0 compact-admin-table" style="font-size: 14px;">
                <thead style="background-color: #1A1412; color: #E6E1DA;">
                    <tr>
                        <th class="py-3 px-4" style="width: 60px;">No</th>
                        <th class="py-3">Layanan Induk</th>
                        <th class="py-3">Nama Paket</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3">Deskripsi</th>
                        <th class="py-3 text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $index => $package)
                        <tr>
                            <td class="px-4 text-muted">{{ $index + 1 }}</td>
                            <td>
                                <span class="badge" style="background-color: #EAE5DB; color: #1A1412;">
                                    {{ $package->service->name ?? '-' }}
                                </span>
                            </td>
                            <td class="fw-bold" style="color: #1A1412;">{{ $package->name }}</td>
                            <td class="text-success fw-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td class="text-muted text-truncate" style="max-width: 220px;">
                                <a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#descModal{{ $package->id }}">
                                    {{ Str::limit($package->description, 50) }}
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
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
                                <i class="fa-solid fa-box-open fa-2xl mb-3 d-block" style="color: #D1C9BC;"></i>
                                Belum ada data paket. Klik tombol <strong>Tambah Paket Baru</strong> untuk mengisi data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($packages as $package)
<div class="modal fade" id="descModal{{ $package->id }}" tabindex="-1" aria-labelledby="descModalLabel{{ $package->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="descModalLabel{{ $package->id }}">{{ $package->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="white-space: pre-line;">{{ $package->description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
