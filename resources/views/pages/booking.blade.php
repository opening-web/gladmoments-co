@extends('layouts.app')

@section('styles')
<style>
    /* Responsive custom minimal navbar for booking */
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
    .booking-section {
        padding-top: 8rem !important;
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
        <span class="section-tag">Form Booking</span>
        <h1>Booking Layanan</h1>
        <p>Isi form sesuai jenis layanan yang Anda pilih. Setelah submit, lanjutkan pembayaran DP untuk lock tanggal.</p>
    </div>
</section>

<section class="booking-section">
    <div class="booking-form-page">
        <div class="booking-type-tabs">
            <a href="{{ route('booking.index', ['type' => 'photobooth']) }}" class="booking-tab {{ $preselectedType === 'photobooth' ? 'active' : '' }}">
                📸 PhotoBooth Only
            </a>
            <a href="{{ route('booking.index', ['type' => 'audio']) }}" class="booking-tab {{ $preselectedType === 'audio' ? 'active' : '' }}">
                🎙️ Audio Guestbook Only
            </a>
            <a href="{{ route('booking.index', ['type' => 'bundle']) }}" class="booking-tab {{ $preselectedType === 'bundle' ? 'active' : '' }}">
                ✨ Bundle
            </a>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Mohon perbaiki data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($preselectedType === 'photobooth')
            @include('pages.booking.partials.photobooth')
        @elseif($preselectedType === 'audio')
            @include('pages.booking.partials.audio')
        @else
            @include('pages.booking.partials.bundle')
        @endif
    </div>
</section>
@endsection
