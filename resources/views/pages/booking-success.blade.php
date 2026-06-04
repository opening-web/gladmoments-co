@extends('layouts.app')

@section('styles')
<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    nav {
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(176, 141, 87, 0.12) !important;
        padding: 1.1rem 4rem !important;
        position: fixed !important;
        top: 0; left: 0; right: 0;
        z-index: 1000;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        box-sizing: border-box;
    }

    .nav-logo a {
        color: #1A1206 !important;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.3rem;
        text-decoration: none;
    }

    .nav-back a {
        font-size: 0.8rem;
        font-weight: 600;
        color: #B08D57 !important;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: color 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
    }

    .nav-back a:hover {
        color: #8a6b3f !important;
    }

    .success-section {
        background: #FDFBF7;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8rem 1.5rem 4rem;
        width: 100%;
        box-sizing: border-box;
    }

    .success-container {
        max-width: 600px;
        width: 100%;
        text-align: center;
        box-sizing: border-box;
    }

    .success-icon-wrap {
        width: 72px;
        height: 72px;
        background: rgba(176, 141, 87, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #B08D57;
        margin: 0 auto 1.5rem;
    }

    .success-container h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        color: #1A1206;
        margin-bottom: 0.75rem;
    }

    .success-container p {
        color: #6C6C6C;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 2.5rem;
    }

    .success-card {
        background: #FFFFFF;
        border: 1px solid rgba(176, 141, 87, 0.1);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(26, 18, 6, 0.02);
        margin-bottom: 2.5rem;
        text-align: left;
        width: 100%;
        box-sizing: border-box;
    }

    .success-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: #1A1206;
        margin-bottom: 1.25rem;
        border-bottom: 1px dashed rgba(176, 141, 87, 0.15);
        padding-bottom: 0.75rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.85rem;
        font-size: 0.95rem;
        gap: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .summary-row:last-child {
        margin-bottom: 0;
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px dashed rgba(176, 141, 87, 0.15);
        font-weight: 600;
    }

    .summary-label {
        color: #6C6C6C;
    }

    .summary-row span:last-child {
        text-align: right;
        color: #1A1206;
    }

    .summary-row:last-child span:last-child {
        color: #B08D57;
        font-size: 1.1rem;
    }

    .hero-btns {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
        box-sizing: border-box;
    }

    .btn-primary {
        background: #B08D57;
        color: #FFFFFF;
        padding: 0.9rem 2rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
        display: block;
        box-shadow: 0 4px 12px rgba(176, 141, 87, 0.2);
    }

    .btn-primary:hover {
        background: #8a6b3f;
        box-shadow: 0 6px 16px rgba(176, 141, 87, 0.3);
    }

    .btn-outline {
        border: 2px solid #B08D57;
        color: #B08D57 !important;
        padding: 0.9rem 2rem;
        font-weight: 700 !important;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
        display: block;
    }

    .btn-outline:hover {
        background: #B08D57;
        color: #FFFFFF !important;
    }

    @media (max-width: 992px) {
        nav {
            padding: 1rem 2rem !important;
        }
    }

    @media (max-width: 768px) {
        nav {
            padding: 1rem 1.5rem !important;
        }
        .success-section {
            padding-top: 7rem;
        }
        .success-container h1 {
            font-size: 2rem;
        }
        .success-card {
            padding: 1.5rem;
        }
        .summary-row {
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<nav>
    <div class="nav-logo">
        <a href="{{ route('home') }}">Glad Moments &amp; Co</a>
    </div>
    <div class="nav-back">
        <a href="{{ route('home') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Beranda
        </a>
    </div>
</nav>

<section class="success-section">
    <div class="success-container">
        <div class="success-icon-wrap">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11"></polyline></svg>
        </div>
        
        <h1>Booking Berhasil!</h1>
        <p>Terima kasih. Formulir reservasi Anda telah kami terima. Silakan lakukan pembayaran DP untuk mengamankan slot tanggal Anda.</p>

        <div class="success-card">
            <h3>Ringkasan Reservasi</h3>
            <div class="summary-row">
                <span class="summary-label">ID Booking</span>
                <span style="font-family:monospace; font-weight:600;">#{{ $booking->id }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Tipe Layanan</span>
                <span>
                    @if($booking->booking_type === 'photobooth') Photobooth Only
                    @elseif($booking->booking_type === 'audio') Audio Guestbook Only
                    @else Bundle Photobooth + Audio @endif
                </span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Nama</span>
                <span>{{ $booking->customer_name }}</span>
            </div>
            @if($booking->package_choice)
            <div class="summary-row">
                <span class="summary-label">Paket</span>
                <span>{{ $booking->package_choice }}</span>
            </div>
            @endif
            <div class="summary-row">
                <span class="summary-label">Acara</span>
                <span>{{ $booking->event_name ?? '—' }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Tanggal</span>
                <span>{{ $booking->event_date->translatedFormat('d F Y') }} · {{ $booking->event_time }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">DP</span>
                <span>Rp {{ number_format($booking->down_payment, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="hero-btns">
            <a class="btn-primary" href="https://wa.me/6287788991305?text={{ rawurlencode('Halo, saya sudah upload bukti DP untuk booking #' . $booking->id) }}" target="_blank" rel="noopener">Konfirmasi via WhatsApp</a>
            <a class="btn-outline" href="{{ route('home') }}">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@endsection