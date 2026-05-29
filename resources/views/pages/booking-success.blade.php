@extends('layouts.app')

@section('styles')
<style>
    /* Responsive custom minimal navbar for booking success */
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
    }
    .nav-logo a {
        color: #1A1206 !important;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.3rem;
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
    @media(max-width: 640px) {
        nav {
            padding: 1.1rem 1.5rem !important;
        }
        .nav-logo a {
            font-size: 1.1rem;
        }
        .nav-back a {
            font-size: 0.72rem;
        }
    }
</style>
@endsection

@section('navbar')
<nav id="navbar">
    <div class="nav-logo">
        <a href="{{ route('home') }}">Glad Moments & Co</a>
    </div>
    <div class="nav-back">
        <a href="{{ route('home') }}">
            ← Kembali ke Home
        </a>
    </div>
</nav>
@endsection

@section('content')
<section class="hero hero-compact">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <span class="section-tag">Berhasil</span>
        <h1>Booking Terkirim!</h1>
        <p>Terima kasih — tim kami akan verifikasi bukti DP Anda segera.</p>
    </div>
</section>

<section class="booking-section">
    <div class="success-card">
        <div class="success-icon">✓</div>
        <h2>Booking #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</h2>
        <p class="success-status">Status: <strong>{{ $booking->status === 'pending' ? 'Menunggu verifikasi DP' : ucfirst($booking->status) }}</strong></p>

        <div class="success-details">
            <div class="summary-row">
                <span class="summary-label">Jenis booking</span>
                <span>
                    @if($booking->booking_type === 'photobooth') PhotoBooth Only
                    @elseif($booking->booking_type === 'audio') Audio Guestbook Only
                    @else Bundle PhotoBooth + Audio @endif
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

        <div class="hero-btns" style="margin-top:2rem;">
            <a class="btn-primary" href="https://wa.me/6287788991305?text={{ rawurlencode('Halo, saya sudah upload bukti DP untuk booking #' . $booking->id) }}" target="_blank" rel="noopener">Konfirmasi via WhatsApp</a>
            <a class="btn-outline" href="{{ route('home') }}">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@endsection
