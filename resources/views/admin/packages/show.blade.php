@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-start flex-column flex-md-row gap-3">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Detail Paket</h2>
            <p class="text-muted mb-0">Lihat informasi lengkap paket dan kelola data paket Glad to Call, Glad Moments, atau Bundle.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Paket
            </a>
            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                    <i class="fa-solid fa-trash me-1"></i> Hapus Paket
                </button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm bg-white p-4" style="border-radius: 14px;">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="mb-4">
                    <span class="badge bg-dark text-white">{{ $package->service->name ?? '—' }}</span>
                    <h3 class="mt-3 mb-2" style="color: #1A1412;">{{ $package->name }}</h3>
                    <p class="text-muted">{{ $package->service->description ?? 'Paket booking yang dapat dipilih oleh pelanggan.' }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Rincian Paket</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted">Harga Dasar</div>
                            <div class="fw-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted">Promo Diskon</div>
                            <div class="fw-semibold">{{ $package->promo_percent ? $package->promo_percent . '%' : 'Tidak ada' }}</div>
                        </div>
                        @if($package->discounted_price)
                            <div class="col-md-12 mb-3">
                                <div class="small text-muted">Harga Setelah Diskon</div>
                                <div class="fw-semibold text-success">Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h5 class="mb-3">Deskripsi Paket</h5>
                    <p style="white-space: pre-line; color: #4D4B47;">{{ $package->description }}</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-1 shadow-sm p-4" style="border-radius: 14px;">
                    <h5 class="mb-3">Informasi Tambahan</h5>
                    <ul class="list-unstyled mb-0" style="line-height: 1.85;">
                        <li><strong>Layanan:</strong> {{ $package->service->name ?? '-' }}</li>
                        <li><strong>Slug Layanan:</strong> {{ $package->service->slug ?? '-' }}</li>
                        <li><strong>ID Paket:</strong> {{ $package->id }}</li>
                        <li><strong>Dibuat:</strong> {{ $package->created_at->format('d M Y H:i') }}</li>
                        <li><strong>Diubah:</strong> {{ $package->updated_at->format('d M Y H:i') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection