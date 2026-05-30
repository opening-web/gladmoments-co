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

    .booking-body {
        background: #FDFBF7;
        font-family: 'Poppins', sans-serif;
        color: #2A2A2A;
        min-height: 100vh;
        padding-top: 7rem;
        padding-bottom: 4rem;
        width: 100%;
        box-sizing: border-box;
    }

    .booking-container {
        max-width: 720px;
        margin: 0 auto;
        padding: 0 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .booking-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .booking-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #1A1206;
        margin-bottom: 0.5rem;
    }

    .booking-header p {
        color: #6C6C6C;
        font-size: 0.95rem;
    }

    .booking-type-tabs {
        display: flex;
        background: #FFFFFF;
        padding: 0.4rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(26, 18, 6, 0.04);
        border: 1px solid rgba(176, 141, 87, 0.1);
        margin-bottom: 2rem;
        width: 100%;
        box-sizing: border-box;
    }

    .booking-tab {
        flex: 1;
        text-align: center;
        padding: 0.8rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #6C6C6C;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .booking-tab:hover {
        color: #B08D57;
    }

    .booking-tab.active {
        background: #B08D57;
        color: #FFFFFF !important;
    }

    .booking-card {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(26, 18, 6, 0.03);
        border: 1px solid rgba(176, 141, 87, 0.08);
        width: 100%;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 1.5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
        width: 100%;
        box-sizing: border-box;
    }

    label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #1A1206;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        color: #2A2A2A;
        background: #FDFBF7;
        border: 1px solid rgba(176, 141, 87, 0.2);
        border-radius: 8px;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #B08D57;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(176, 141, 87, 0.1);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23B08D57' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/\%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 1rem) center;
        padding-right: 2.5rem;
    }

    .alert-error {
        background: #FFF5F5;
        border-left: 4px solid #FB2D5A;
        color: #D61B44;
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        width: 100%;
        box-sizing: border-box;
    }

    .alert-error ul {
        margin: 0.4rem 0 0 1.2rem;
        padding: 0;
    }

    .btn-submit {
        width: 100%;
        background: #B08D57;
        color: #FFFFFF;
        border: none;
        padding: 0.9rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(176, 141, 87, 0.2);
        margin-top: 1rem;
        box-sizing: border-box;
    }

    .btn-submit:hover {
        background: #8a6b3f;
        box-shadow: 0 6px 16px rgba(176, 141, 87, 0.3);
    }

    .promo-badge-container {
        margin-bottom: 1.5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .promo-applied-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(251, 45, 90, 0.06);
        border: 1px dashed rgba(251, 45, 90, 0.3);
        color: #FB2D5A;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        width: 100%;
        box-sizing: border-box;
    }

    .promo-remove-btn {
        background: none;
        border: none;
        color: #6C6C6C;
        cursor: pointer;
        font-weight: bold;
        padding: 0 0.2rem;
        margin-left: auto;
    }

    .promo-remove-btn:hover {
        color: #FB2D5A;
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
        .booking-body {
            padding-top: 6rem;
        }
        .booking-header h1 {
            font-size: 1.8rem;
        }
        .booking-type-tabs {
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
        }
        .booking-tab {
            width: 100%;
            text-align: center;
            white-space: normal;
        }
        .booking-card {
            padding: 1.5rem;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
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
            Kembali
        </a>
    </div>
</nav>

<div class="booking-body">
    <div class="booking-container">
        <div class="booking-header">
            <h1>Formulir Reservasi</h1>
            <p>Silakan tentukan tipe layanan dan lengkapi data acara Anda</p>
        </div>

        @if(isset($promo) && $promo)
            <div class="promo-badge-container">
                <div class="promo-applied-badge">
                    <span>🎁 Promo Aktif: <strong>{{ $promo->name }}</strong> (Potongan Rp {{ number_format($promo->discount_value, 0, ',', '.') }})</span>
                    <button type="button" class="promo-remove-btn" onclick="window.location.href='{{ route('booking.index', ['type' => $preselectedType]) }}'" title="Hapus Promo">×</button>
                </div>
            </div>
        @endif

        <div class="booking-type-tabs">
            <a href="{{ route('booking.index', array_filter(['type' => 'photobooth', 'promo_id' => $promo->id ?? null])) }}" class="booking-tab {{ $preselectedType === 'photobooth' ? 'active' : '' }}">
                📸 PhotoBooth Only
            </a>
            <a href="{{ route('booking.index', array_filter(['type' => 'audio', 'promo_id' => $promo->id ?? null])) }}" class="booking-tab {{ $preselectedType === 'audio' ? 'active' : '' }}">
                🎙️ Audio Guestbook Only
            </a>
            <a href="{{ route('booking.index', array_filter(['type' => 'bundle', 'promo_id' => $promo->id ?? null])) }}" class="booking-tab {{ $preselectedType === 'bundle' ? 'active' : '' }}">
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
</div>
@endsection