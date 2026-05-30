@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color: #1A1412;">Booking Management</h2>
        <p class="text-muted mb-0">Kelola pesanan dari klien Glad Moments & Co. beserta status persetujuan dan bukti transfer.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-3"><div class="card p-3 border-0 shadow-sm text-center"><h6>Total Booking</h6><h3>{{ $stats['total'] }}</h3></div></div>
        <div class="col-md-3"><div class="card p-3 border-0 shadow-sm text-center text-warning"><h6>Pending</h6><h3>{{ $stats['pending'] }}</h3></div></div>
        <div class="col-md-3"><div class="card p-3 border-0 shadow-sm text-center text-success"><h6>Approved</h6><h3>{{ $stats['approved'] }}</h3></div></div>
        <div class="col-md-3"><div class="card p-3 border-0 shadow-sm text-center text-danger"><h6>Rejected</h6><h3>{{ $stats['rejected'] }}</h3></div></div>
    </div>

    <div class="d-flex justify-content-between mb-3">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.bookings.index', ['status' => '']) }}" class="btn btn-sm {{ !$status ? 'btn-dark' : 'btn-outline-dark' }}">Semua</a>
                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="btn btn-sm {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Pending</a>
                <a href="{{ route('admin.bookings.index', ['status' => 'approved']) }}" class="btn btn-sm {{ $status == 'approved' ? 'btn-success' : 'btn-outline-success' }}">Approved</a>
                <a href="{{ route('admin.bookings.index', ['status' => 'rejected']) }}" class="btn btn-sm {{ $status == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">Rejected</a>
            </div>
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="d-flex">
                <input type="hidden" name="status" value="{{ $status }}">
            <button type="submit" class="btn btn-sm btn-dark ms-1">Cari</button>
        </form>
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
                        <th class="py-3">Nama Klien</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Log Aktivitas</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $index => $booking)
                        <tr>
                            <td class="px-4 text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold" style="color: #1A1412;">{{ $booking->customer_name }}</div>
                                <small class="text-muted">{{ $booking->package->name ?? $booking->package_choice }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $booking->status == 'pending' ? 'bg-warning-subtle text-warning' : ($booking->status == 'approved' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger') }} border px-2 py-1" style="border-radius: 6px;">{{ ucfirst($booking->status) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $booking->updated_at ? \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() : '-' }}
                                    <br> Oleh: {{ session('admin_name', '-') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary py-1" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">Detail</button>
                                @if(strtolower($booking->status) == 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline f-app">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-success py-1 btn-a"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline ms-1 f-reject">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger py-1 btn-reject"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($bookings as $booking)
    <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark text-white"><h5 class="modal-title">Rincian #{{ $booking->id }}</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $booking->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $booking->customer_email ?? '-' }}</p>
                            <p><strong>Telepon:</strong> {{ $booking->customer_phone ?? '-' }}</p>
                            <p><strong>Paket:</strong> {{ $booking->package->name ?? $booking->package_choice ?? '-' }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                            <p><strong>Total Harga:</strong> Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</p>
                            <p><strong>DP:</strong> Rp {{ number_format((float) $booking->down_payment, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal Acara:</strong> {{ $booking->event_date ? $booking->event_date->format('d M Y') : '-' }}</p>
                            <p><strong>Waktu Acara:</strong> {{ $booking->event_time ?? '-' }}</p>
                            <p><strong>Nama Acara:</strong> {{ $booking->event_name ?? '-' }}</p>
                            <p><strong>Lokasi Acara:</strong> {{ $booking->event_location ?? '-' }}</p>
                            <p><strong>Catatan:</strong> {{ $booking->notes ?? '-' }}</p>
                        </div>
                    </div>

                    @if(!empty($booking->form_details))
                        <hr>
                        <h6 class="fw-semibold">Detail Form Booking</h6>
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-flush">
                                    @foreach($booking->form_details as $label => $value)
                                        @php
                                            $isFile = is_string($value) && preg_match('/\.(jpg|jpeg|png|gif|webp|pdf)$/i', $value);
                                            $url = $isFile ? url('/storage/' . ltrim($value, '/')) : null;
                                        @endphp
                                        <li class="list-group-item px-0 py-2">
                                            <strong>{{ ucwords(str_replace(['_', '-'], ' ', $label)) }}:</strong>
                                            @if($isFile)
                                                <div class="mt-2">
                                                    @if(preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $value))
                                                        <a href="{{ $url }}" target="_blank" class="d-inline-block">
                                                            <img src="{{ $url }}" alt="{{ $label }}" class="img-fluid rounded border" style="max-width: 180px; max-height: 180px; object-fit: contain;">
                                                        </a>
                                                    @else
                                                        <a href="{{ $url }}" target="_blank" class="text-decoration-none">
                                                            <span class="badge bg-info text-dark">Lihat file {{ strtoupper(pathinfo($value, PATHINFO_EXTENSION)) }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @else
                                                {{ is_array($value) ? implode(', ', $value) : ($value ?: '-') }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @php $latestPayment = $booking->payments->first(); @endphp
                    @if($latestPayment && $latestPayment->payment_proof)
                        <hr>
                        <div class="mb-3">
                            <p class="mb-2 fw-semibold">Bukti transfer dari user:</p>
                            <a href="{{ $latestPayment->payment_proof_url }}" target="_blank">
                                <img src="{{ $latestPayment->payment_proof_url }}" alt="Bukti Transfer" class="img-fluid rounded border">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-a').forEach(btn => btn.onclick = () => Swal.fire({
        title: 'Setujui pesanan?',
        icon: 'question',
        showCancelButton: true
    }).then(r => { if (r.isConfirmed) btn.closest('form').submit() }));

    document.querySelectorAll('.btn-reject').forEach(btn => btn.onclick = () => Swal.fire({
        title: 'Tolak pesanan?',
        text: 'Aksi ini akan menandai pesanan sebagai rejected.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33'
    }).then(r => { if (r.isConfirmed) btn.closest('form').submit() }));
</script>
@endsection