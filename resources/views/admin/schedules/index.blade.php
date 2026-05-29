@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Schedule Management</h2>
            <p class="text-muted mb-0">Kelola jadwal layanan Glad Moments & Co.</p>
        </div>
        <div>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-sm px-3 py-2 text-white" style="background-color: #B39467; font-weight: 500; border-radius: 8px;">
                <i class="fa-solid fa-plus me-1"></i> Tambah Jadwal
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
                        <th class="py-3 px-4">No</th>
                        <th class="py-3">Layanan</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Waktu</th>
                        <th class="py-3">Lokasi</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $index => $schedule)
                        <tr>
                            <td class="px-4 text-muted">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $schedule->service->name }}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>{{ $schedule->location }}</td>
                            <td>
                                <span class="badge {{ $schedule->status == 'Available' ? 'bg-success' : ($schedule->status == 'Booked' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $schedule->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada data jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection