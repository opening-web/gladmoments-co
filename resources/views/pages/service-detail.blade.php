@extends('layouts.app')

@section('content')
@php
    $waText = rawurlencode("Halo {$service->name}, saya ingin menanyakan layanan Anda.");
@endphp

<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    .hero {
        position: relative;
        width: 100%;
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1A1206;
        color: #FFFFFF;
        padding: 6rem 1.5rem 4rem;
        box-sizing: border-box;
        text-align: center;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(26, 18, 6, 0.4), #1A1206);
        z-index: 1;
    }

    .hero-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(176, 141, 87, 0.15) 1px, transparent 0);
        background-size: 24px 24px;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        width: 100%;
        box-sizing: border-box;
    }

    .section-tag {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #B08D57;
        background: rgba(176, 141, 87, 0.12);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        margin-bottom: 1.2rem;
    }

    .hero-content h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .hero-content p {
        font-size: 1.05rem;
        color: #CBC5BA;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .hero-btns {
        display: flex;
        justify-content: center;
        gap: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .btn-primary {
        background: #B08D57;
        color: #FFFFFF;
        padding: 0.8rem 2rem;
        font-weight: 500;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-primary:hover {
        background: #8a6b3f;
    }

    .btn-outline {
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #FFFFFF;
        padding: 0.8rem 2rem;
        font-weight: 500;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .service-detail {
        background: #FDFBF7;
        padding: 5rem 1.5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .section-center {
        text-align: center;
        margin-bottom: 3.5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        color: #1A1206;
        margin-top: 0.5rem;
    }

    .section-sub {
        color: #6C6C6C;
        max-width: 600px;
        margin: 0.5rem auto 0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 3rem;
        max-width: 1100px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box;
    }

    .detail-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: #1A1206;
        margin-bottom: 1.5rem;
    }

    .detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        box-sizing: border-box;
    }

    .detail-list li {
        background: #FFFFFF;
        border: 1px solid rgba(176, 141, 87, 0.08);
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(26, 18, 6, 0.01);
        width: 100%;
        box-sizing: border-box;
    }

    .detail-text {
        color: #555555;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .service-copy-card {
        background: #FFFFFF;
        border: 1px solid rgba(176, 141, 87, 0.1);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(26, 18, 6, 0.02);
        height: fit-content;
        width: 100%;
        box-sizing: border-box;
    }

    .service-copy-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        color: #1A1206;
        margin-bottom: 0.75rem;
    }

    .service-copy-card p {
        color: #6C6C6C;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .service-copy-card .btn-primary {
        display: block;
        text-align: center;
        margin-bottom: 0.75rem;
    }

    .btn-accent-outline {
        border: 1px solid rgba(176, 141, 87, 0.3);
        color: #B08D57;
        padding: 0.8rem 2rem;
        font-weight: 500;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-accent-outline:hover {
        background: rgba(176, 141, 87, 0.05);
        border-color: #B08D57;
    }

    @media (max-width: 768px) {
        .hero {
            padding-top: 7rem;
        }
        .hero-content h1 {
            font-size: 2.2rem;
        }
        .hero-btns {
            flex-direction: column;
            gap: 0.75rem;
        }
        .btn-primary, .btn-outline {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <span class="section-tag">{{ $service->icon }} {{ $service->name }}</span>
        <h1>{{ $service->name }}</h1>
        <p>{!! nl2br(e($service->description)) !!}</p>
        <div class="hero-btns">
            <a class="btn-primary" href="https://wa.me/6287788991305?text={{ $waText }}">Hubungi Sekarang</a>
            <a class="btn-outline" href="{{ route('home') }}">Kembali ke Home</a>
        </div>
    </div>
</section>

<section class="service-detail">
    <div class="services-header section-center">
        <span class="section-tag">Detail Layanan</span>
        <h2 class="section-title">{{ $service->name }}</h2>
        <p class="section-sub" style="white-space: pre-wrap;">{!! nl2br(e($service->description)) !!}</p>
    </div>

    <div class="detail-grid">
        <div>
            <h3 class="detail-title">Paket Layanan</h3>
            @if($service->packages->isNotEmpty())
                <ul class="detail-list">
                    @foreach($service->packages as $package)
                        <li>
                            <strong>{{ $package->name }}</strong>
                            — 
                            @if($package->discounted_price)
                                <span style="text-decoration: line-through; color: #777;">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                <strong>Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</strong>
                                <span class="detail-text" style="font-size: .85rem; color: #b6316f;">({{ $package->promo_percent }}% off)</span>
                            @else
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            @endif
                            @if($package->description)
                                <br><span class="detail-text" style="white-space: pre-wrap;">{!! nl2br(e($package->description)) !!}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="detail-text">Paket akan segera tersedia. Hubungi kami untuk informasi lebih lanjut.</p>
            @endif
        </div>
        <div class="service-copy-card">
            <h3>Booking {{ $service->name }}</h3>
            <p>Pesan layanan untuk wedding, birthday, launching, atau corporate event Anda.</p>
            <a class="btn-primary" href="{{ route('booking.index') }}">Booking Sekarang</a>
            <a class="btn-accent-outline" style="display:block;margin-top:.8rem;text-align:center;" href="https://wa.me/6287788991305?text={{ $waText }}">WhatsApp</a>
        </div>
    </div>
</section>
@endsection