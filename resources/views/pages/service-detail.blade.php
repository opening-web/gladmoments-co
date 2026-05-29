@extends('layouts.app')

@section('content')
@php
    $waText = rawurlencode("Halo {$service->name}, saya ingin menanyakan layanan Anda.");
@endphp

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <span class="section-tag">{{ $service->icon }} {{ $service->name }}</span>
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->description }}</p>
        <div class="hero-btns">
            <a class="btn-primary" href="https://wa.me/6287788991305?text={{ $waText }}">Hubungi Sekarang</a>
            <a class="btn-outline" href="{{ route('services.index') }}">Kembali ke Layanan</a>
        </div>
    </div>
</section>

<section class="service-detail">
    <div class="services-header section-center">
        <span class="section-tag">Detail Layanan</span>
        <h2 class="section-title">{{ $service->name }}</h2>
        <p class="section-sub">{{ $service->description }}</p>
    </div>

    <div class="detail-grid">
        <div>
            <h3 class="detail-title">Paket Layanan</h3>
            @if($service->packages->isNotEmpty())
                <ul class="detail-list">
                    @foreach($service->packages as $package)
                        <li>
                            <strong>{{ $package->name }}</strong>
                            — Rp {{ number_format($package->price, 0, ',', '.') }}
                            @if($package->description)
                                <br><span class="detail-text">{{ $package->description }}</span>
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
