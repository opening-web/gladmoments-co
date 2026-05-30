@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Package Management</h2>
            <p class="text-muted mb-0">Kelola paket Glad to Call, Glad Moments, dan Bundle dari satu halaman admin.</p>
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

    @foreach($services as $service)
        <div class="card card-custom shadow-sm border-0 bg-white overflow-hidden mb-4">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3" style="background-color: #F7F3EE;">
                <div>
                    <h4 class="mb-1" style="color: #1A1412;">{{ $service->name }}</h4>
                    <div class="text-muted" style="font-size: 0.95rem;">
                        <span class="badge bg-secondary text-white me-2">{{ $service->slug }}</span>
                        {{ $service->packages->count() }} paket
                    </div>
                </div>
                <a href="{{ route('admin.packages.create') }}?service_id={{ $service->id }}" class="btn btn-sm btn-outline-dark" style="border-radius: 8px;">
                    <i class="fa-solid fa-plus me-1"></i> Tambah paket {{ $service->name }}
                </a>
            </div>
            <div class="card-body p-0">
                @if($service->packages->isEmpty())
                    <div class="p-4 text-center text-muted">
                        Tidak ada paket untuk <strong>{{ $service->name }}</strong>. Tambahkan paket baru untuk mengisi form booking.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 compact-admin-table" style="font-size: 14px;">
                            <thead style="background-color: #1A1412; color: #E6E1DA;">
                                <tr>
                                    <th class="py-3 px-4" style="width: 60px;">No</th>
                                    <th class="py-3">Nama Paket</th>
                                    <th class="py-3">Harga</th>
                                    <th class="py-3">Deskripsi</th>
                                    <th class="py-3 text-center" style="width: 190px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service->packages as $index => $package)
                                    <tr>
                                        <td class="px-4 text-muted">{{ $index + 1 }}</td>
                                        <td class="fw-bold" style="color: #1A1412;">
                                            <a href="{{ route('admin.packages.show', $package->id) }}" class="text-decoration-none text-dark">{{ $package->name }}</a>
                                        </td>
                                        <td>
                                            <div class="text-success fw-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                                            @if($package->discounted_price)
                                                <div class="text-muted small">Diskon {{ $package->promo_percent }}% → Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</div>
                                            @endif
                                        </td>
                                        <td class="text-muted text-truncate" style="max-width: 220px;">
                                            <a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#descModal{{ $package->id }}">
                                                {{ Str::limit($package->description, 50) }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                                    <i class="fa-solid fa-info-circle"></i>
                                                </a>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

@foreach($services as $service)
    @foreach($service->packages as $package)
        <div class="modal fade" id="descModal{{ $package->id }}" tabindex="-1" aria-labelledby="descModalLabel{{ $package->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="descModalLabel{{ $package->id }}">{{ $package->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2"><strong>Layanan:</strong> {{ $package->service->name ?? '-' }}</p>
                        <p class="mb-2"><strong>Harga:</strong> Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        @if($package->discounted_price)
                            <p class="mb-2 text-success"><strong>Harga Diskon:</strong> Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</p>
                        @endif
                        <hr>
                        <p style="white-space: pre-line;">{{ $package->description }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-outline-secondary">Edit Paket</a>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endsection
