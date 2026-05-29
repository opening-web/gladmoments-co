@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1A1412;">Dashboard Overview</h2>
            <p class="text-muted mb-0">Selamat datang kembali! Berikut ringkasan data operasional Glad Moments & Co. saat ini.</p>
        </div>
        <div>
            <span class="badge p-2 text-dark" style="background-color: #EAE5DB; border: 1px solid #D1C9BC;">
                <i class="fa-regular fa-calendar me-1"></i> Hari Ini: {{ date('d M Y') }}
            </span>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card card-custom p-4 shadow-sm border-0 position-relative overflow-hidden" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Total Bookings</span>
                        <h2 class="fw-bold mt-2 mb-0" style="color: #1A1412;">{{ $totalBookings }}</h2>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: #FDFCF7; color: #B39467; border: 1px solid #EAE5DB;">
                        <i class="fa-solid fa-calendar-check fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-4 shadow-sm border-0" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Estimasi Pendapatan</span>
                        <h2 class="fw-bold mt-2 mb-0 text-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: #E8F5E9; color: #2E7D32;">
                        <i class="fa-solid fa-wallet fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-4 shadow-sm border-0" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Layanan Aktif</span>
                        <h2 class="fw-bold mt-2 mb-0" style="color: #B39467;">{{ $activeServicesCount }} Layanan</h2>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: #FDFCF7; color: #1A1412; border: 1px solid #EAE5DB;">
                        <i class="fa-solid fa-camera-retro fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-custom p-4 border-0 shadow-sm" style="background-color: #ffffff; border-left: 5px solid #B39467 !important;">
        <div class="d-flex align-items-start">
            <i class="fa-solid fa-circle-check text-success fa-xl me-3 mt-1"></i>
            <div>
                <h5 class="fw-bold mb-1" style="color: #1A1412;">Penyatuan Sistem Monolith Berhasil!</h5>
                <p class="text-muted mb-0 small">
                    Halaman admin dan user saat ini sudah berjalan harmonis dalam satu aplikasi terpadu. 
                    Semua perubahan data paket foto/video pada menu <strong>Service Management</strong> akan langsung mengubah isi katalog di halaman depan klien secara instan tanpa perlu repot sinkronisasi lagi.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection