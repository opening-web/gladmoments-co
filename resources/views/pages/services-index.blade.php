@extends('layouts.app')

@section('styles')
<style>
    /* Premium Unified Palette for Services Index */
    :root {
        --si-rose: #FB2D5A;
        --si-rose-hover: #D61B44;
        --si-gold: #B08D57;
        --si-gold-hover: #8a6b3f;
        --si-dark: #1A1206;
        --si-bg: #FDFBF7;
        --si-card-bg: #FFFFFF;
    }

    .si-body {
        background-color: var(--si-bg);
        color: #2D2D2D;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }

    /* Elegant Radial Background Patterns & Glowing Orbs */
    .si-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(ellipse 60% 40% at 50% -10%, rgba(251, 45, 90, 0.05) 0%, transparent 60%),
            radial-gradient(ellipse 50% 50% at 90% 80%, rgba(176, 141, 87, 0.04) 0%, transparent 50%),
            radial-gradient(ellipse 40% 40% at 10% 40%, rgba(26, 26, 26, 0.01) 0%, transparent 40%);
        z-index: 0;
        pointer-events: none;
    }

    .si-glow-orb {
        position: absolute;
        width: 450px;
        height: 450px;
        border-radius: 50%;
        filter: blur(140px);
        z-index: 0;
        opacity: 0.35;
        pointer-events: none;
        mix-blend-mode: multiply;
    }
    .orb-1 {
        background: rgba(251, 45, 90, 0.15); /* Soft Rose Orb */
        top: 15%;
        left: -15%;
        animation: float-orb 18s infinite alternate;
    }
    .orb-2 {
        background: rgba(176, 141, 87, 0.12); /* Soft Gold Orb */
        bottom: 30%;
        right: -15%;
        animation: float-orb 22s infinite alternate-reverse;
    }
    @keyframes float-orb {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(60px, 90px) scale(1.15); }
    }

    /* Page-Specific Hero Refinements */
    .si-hero {
        padding: 10rem 2rem 5.5rem;
        text-align: center;
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }
    .si-hero-tag {
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--si-gold);
        font-weight: 600;
        border: 1px solid rgba(176, 141, 87, 0.3);
        padding: 0.4rem 1.35rem;
        border-radius: 30px;
        display: inline-block;
        margin-bottom: 1.75rem;
        background: rgba(176, 141, 87, 0.03);
        box-shadow: 0 4px 12px rgba(176, 141, 87, 0.02);
    }
    .si-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 6vw, 4.2rem);
        font-weight: 700;
        color: var(--si-dark);
        line-height: 1.15;
        margin-bottom: 1.5rem;
        letter-spacing: -0.01em;
    }
    .si-hero h1 span {
        color: var(--si-rose);
        font-style: italic;
        font-weight: 400;
    }
    .si-hero p {
        font-size: 1.05rem;
        color: #555555;
        line-height: 1.85;
        max-width: 720px;
        margin: 0 auto 3rem;
        font-weight: 300;
    }
    .si-hero-btns {
        display: flex;
        justify-content: center;
        gap: 1.2rem;
        flex-wrap: wrap;
    }
    .si-hero-btns .btn-primary {
        background: linear-gradient(135deg, var(--si-rose) 0%, #FF6080 100%);
        border: none;
        color: #FFFFFF !important;
        padding: 1rem 2.2rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(251, 45, 90, 0.25);
        transition: all 0.3s;
    }
    .si-hero-btns .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(251, 45, 90, 0.4);
    }
    .si-hero-btns .btn-outline {
        border: 2px solid rgba(26, 18, 6, 0.15);
        background: transparent;
        color: var(--si-dark);
        padding: 1rem 2.2rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-decoration: none;
        transition: all 0.25s;
    }
    .si-hero-btns .btn-outline:hover {
        background: var(--si-dark);
        color: #FFFFFF;
        border-color: var(--si-dark);
    }

    /* Standardized premium section layout */
    .si-section {
        padding: 6rem 2rem;
        position: relative;
        z-index: 1;
        max-width: 1240px;
        margin: 0 auto;
    }
    .si-section-header {
        text-align: center;
        margin-bottom: 4.5rem;
    }
    .si-section-tag {
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--si-rose);
        margin-bottom: 0.85rem;
        display: block;
        font-weight: 600;
    }
    .si-section-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4.5vw, 2.6rem);
        font-weight: 600;
        color: var(--si-dark);
        line-height: 1.25;
    }
    .si-section-title em {
        color: var(--si-gold);
        font-style: normal;
    }
    .si-section-sub {
        font-size: 1rem;
        color: #666;
        line-height: 1.8;
        max-width: 580px;
        margin: 0.9rem auto 0;
        font-weight: 300;
    }

    /* Beautiful Cards Grid */
    .si-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 3rem;
        margin-bottom: 5rem;
    }
    .si-card {
        background: var(--si-card-bg);
        border-radius: 32px;
        border: 1px solid rgba(176, 141, 87, 0.14);
        padding: 3rem;
        position: relative;
        overflow: hidden;
        transition: all 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 15px 45px rgba(176, 141, 87, 0.02);
        display: flex;
        flex-direction: column;
    }
    .si-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 65px rgba(176, 141, 87, 0.12);
        border-color: var(--si-gold);
    }
    .si-card.bundle-card {
        border: 2px solid var(--si-rose);
        box-shadow: 0 18px 50px rgba(251, 45, 90, 0.07);
        background: linear-gradient(to bottom, #FFFFFF 0%, #FFFDFB 100%);
    }
    .si-card.bundle-card:hover {
        box-shadow: 0 30px 75px rgba(251, 45, 90, 0.16);
    }

    /* Elegant Card Image Cover with Ken Burns Zoom */
    .si-card-img-wrap {
        position: relative;
        height: 210px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 2.2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }
    .si-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .si-card:hover .si-card-img {
        transform: scale(1.1);
    }
    .si-card-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(26, 18, 6, 0.4) 0%, transparent 60%);
        z-index: 1;
    }
    
    /* Elegant Glowing Badges Floating on Image */
    .si-card-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 0.45rem 1rem;
        border-radius: 30px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.06);
        z-index: 2;
        backdrop-filter: blur(8px);
    }
    .si-badge-gold {
        background: rgba(26, 18, 6, 0.75);
        border: 1px solid rgba(176, 141, 87, 0.4);
        color: #E2C99D;
    }
    .si-badge-rose {
        background: rgba(251, 45, 90, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #FFFFFF;
    }
    .si-badge-bundle {
        background: linear-gradient(135deg, var(--si-rose) 0%, var(--si-gold) 100%);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        box-shadow: 0 6px 20px rgba(251, 45, 90, 0.35);
        animation: pulse-badge 2.5s infinite;
    }
    @keyframes pulse-badge {
        0% { transform: scale(1); }
        50% { transform: scale(1.04); }
        100% { transform: scale(1); }
    }

    .si-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--si-dark);
        font-weight: 600;
        margin-bottom: 0.85rem;
    }
    .si-card p {
        font-size: 0.92rem;
        color: #555555;
        line-height: 1.75;
        margin-bottom: 1.8rem;
    }

    /* Structured Feature List */
    .si-feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 2.8rem 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .si-feature-item {
        font-size: 0.88rem;
        color: #444444;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-weight: 400;
    }
    .si-feature-icon {
        color: var(--si-gold);
        font-weight: bold;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .si-card.bundle-card .si-feature-icon {
        color: var(--si-rose);
    }

    /* Stylized action buttons inside cards */
    .si-btn-wrap {
        margin-top: auto;
        display: flex;
        gap: 1rem;
    }
    .si-btn-solid {
        flex: 1.3;
        text-align: center;
        background: var(--si-gold);
        color: #FFFFFF !important;
        border: 1px solid var(--si-gold);
        padding: 0.95rem 1rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 6px 16px rgba(176, 141, 87, 0.18);
    }
    .si-btn-solid:hover {
        background: var(--si-gold-hover);
        border-color: var(--si-gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(176, 141, 87, 0.35);
    }
    .si-btn-solid-rose {
        background: var(--si-rose);
        border-color: var(--si-rose);
        box-shadow: 0 6px 16px rgba(251, 45, 90, 0.18);
    }
    .si-btn-solid-rose:hover {
        background: var(--si-rose-hover);
        border-color: var(--si-rose-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(251, 45, 90, 0.35);
    }
    .si-btn-outline {
        flex: 1;
        text-align: center;
        border: 2px solid rgba(26, 26, 26, 0.12);
        color: var(--si-dark);
        padding: 0.95rem 1rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.25s;
        background: transparent;
    }
    .si-btn-outline:hover {
        background: var(--si-dark);
        color: #FFFFFF !important;
        border-color: var(--si-dark);
    }

    /* Comparison Section Styles */
    .si-compare-section {
        background: linear-gradient(180deg, transparent 0%, rgba(176, 141, 87, 0.03) 50%, transparent 100%);
        padding: 6rem 0;
    }
    .si-comparison-table-wrap {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(176, 141, 87, 0.12);
        border-radius: 36px;
        padding: 3.5rem;
        box-shadow: 0 25px 65px rgba(176, 141, 87, 0.03);
        overflow-x: auto;
    }
    .si-compare-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.92rem;
        min-width: 700px;
    }
    .si-compare-table th {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--si-dark);
        padding: 1.5rem 1.25rem;
        border-bottom: 2px solid rgba(176, 141, 87, 0.15);
    }
    .si-compare-table td {
        padding: 1.35rem 1.25rem;
        border-bottom: 1px solid rgba(176, 141, 87, 0.08);
        color: #4A4A4A;
    }
    .si-compare-table tr:last-child td {
        border-bottom: none;
    }
    .si-compare-table tr:hover td {
        background: rgba(176, 141, 87, 0.015);
    }
    .si-compare-table .highlight-col {
        background: rgba(251, 45, 90, 0.02);
        font-weight: 600;
    }
    .si-compare-table tr:hover .highlight-col {
        background: rgba(251, 45, 90, 0.04);
    }
    .si-check-ok {
        color: #2ECC71;
        font-weight: bold;
        font-size: 1.1rem;
    }
    .si-check-no {
        color: #CCCCCC;
        font-size: 1rem;
    }
    .si-text-price {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--si-dark);
    }
    .si-text-price-rose {
        color: var(--si-rose);
    }

    /* Timeline Process Design */
    .si-timeline-card {
        background: #FFFFFF;
        border-radius: 36px;
        border: 1px solid rgba(176, 141, 87, 0.14);
        padding: 4.5rem;
        box-shadow: 0 25px 65px rgba(176, 141, 87, 0.03);
    }
    @media(max-width: 640px) {
        .si-timeline-card {
            padding: 3rem 1.75rem;
        }
    }
    .si-timeline-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 3rem;
        margin-top: 4rem;
    }
    .si-time-item {
        position: relative;
        padding-top: 1rem;
        transition: all 0.3s;
    }
    .si-time-num {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: rgba(251, 45, 90, 0.12);
        line-height: 1;
        margin-bottom: 1.2rem;
        transition: all 0.3s;
        display: inline-block;
    }
    .si-time-item:hover .si-time-num {
        color: var(--si-rose);
        transform: translateY(-4px) scale(1.05);
    }
    .si-time-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--si-dark);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    .si-time-item p {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.7;
    }

    /* FAQ Section Styles */
    .si-faq-section {
        padding: 6rem 2rem 4rem;
        max-width: 900px;
        margin: 0 auto;
    }
    .si-faq-container {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        margin-top: 3.5rem;
    }
    .si-faq-item {
        background: #FFFFFF;
        border: 1px solid rgba(176, 141, 87, 0.12);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(176, 141, 87, 0.01);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .si-faq-item.active {
        border-color: var(--si-rose);
        box-shadow: 0 12px 32px rgba(251, 45, 90, 0.05);
    }
    .si-faq-trigger {
        padding: 1.6rem 2.2rem;
        width: 100%;
        background: transparent;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--si-dark);
        cursor: pointer;
        outline: none;
        transition: all 0.25s;
    }
    .si-faq-trigger:hover {
        color: var(--si-rose);
    }
    .si-faq-icon {
        font-size: 0.9rem;
        transition: transform 0.3s ease;
        color: var(--si-gold);
    }
    .si-faq-item.active .si-faq-icon {
        transform: rotate(180deg);
        color: var(--si-rose);
    }
    .si-faq-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), padding 0.4s;
        padding: 0 2.2rem;
        font-size: 0.92rem;
        color: #555555;
        line-height: 1.75;
    }
    .si-faq-item.active .si-faq-content {
        padding: 0 2.2rem 1.8rem;
    }

    /* Ticket-Stub Call To Action Banner */
    .si-ticket-banner {
        background: linear-gradient(135deg, #1A1206 0%, #2E200C 100%);
        border: 1px solid rgba(176, 141, 87, 0.35);
        border-radius: 40px;
        padding: 4.5rem 5.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 30px 75px rgba(26, 18, 6, 0.35);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 3.5rem;
    }
    @media(max-width: 900px) {
        .si-ticket-banner {
            flex-direction: column;
            padding: 4rem 2.2rem;
            text-align: center;
        }
    }
    .si-ticket-left {
        flex: 1;
        position: relative;
        z-index: 2;
    }
    .si-ticket-left h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.85rem, 4.5vw, 2.6rem);
        color: #FFFFFF;
        margin-bottom: 1rem;
        font-weight: 600;
        line-height: 1.25;
    }
    .si-ticket-left h2 span {
        color: var(--si-gold);
        font-style: italic;
        font-weight: 400;
    }
    .si-ticket-left p {
        color: rgba(255, 255, 255, 0.72);
        font-size: 0.96rem;
        max-width: 580px;
        line-height: 1.8;
        font-weight: 300;
    }
    .si-ticket-right {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }
    .si-ticket-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.85rem;
        background: linear-gradient(135deg, var(--si-rose) 0%, #FF6080 100%);
        color: #FFFFFF !important;
        padding: 1.2rem 2.5rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        text-decoration: none;
        box-shadow: 0 10px 28px rgba(251, 45, 90, 0.4);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .si-ticket-btn:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 15px 35px rgba(251, 45, 90, 0.65);
    }
    .si-ticket-btn svg {
        transition: transform 0.3s;
    }
    .si-ticket-btn:hover svg {
        transform: translateX(6px);
    }
    
    /* Ticket Punch Hole Cutouts */
    .si-ticket-cutout-left, .si-ticket-cutout-right {
        position: absolute;
        width: 44px;
        height: 44px;
        background: var(--si-bg);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
    }
    .si-ticket-cutout-left {
        left: -22px;
        box-shadow: inset -4px 0 10px rgba(0,0,0,0.15);
        border-right: 1px solid rgba(176, 141, 87, 0.2);
    }
    .si-ticket-cutout-right {
        right: -22px;
        box-shadow: inset 4px 0 10px rgba(0,0,0,0.15);
        border-left: 1px solid rgba(176, 141, 87, 0.2);
    }
    .si-ticket-divider {
        position: absolute;
        top: 8%;
        bottom: 8%;
        left: 70%;
        width: 0;
        border-left: 2px dashed rgba(176, 141, 87, 0.3);
        z-index: 1;
    }
    @media(max-width: 900px) {
        .si-ticket-divider, .si-ticket-cutout-left, .si-ticket-cutout-right {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="si-body">
    <div class="si-bg-pattern"></div>
    <div class="si-glow-orb orb-1"></div>
    <div class="si-glow-orb orb-2"></div>

    <!-- Customized Premium Hero -->
    <header class="si-hero">
        <span class="si-hero-tag">Glad Moments &amp; Co</span>
        <h1>Dua Layanan <span>Unggulan</span><br>Untuk Momen Terbaik Anda</h1>
        <p>Pilih layanan signature kami yang dirancang secara profesional — dari audio guestbook retro vintage hingga instalasi photobooth premium yang aesthetic dan interaktif.</p>
        <div class="si-hero-btns">
            <a class="btn-primary" href="#services-list">Jelajahi Layanan</a>
            <a class="btn-outline" href="{{ route('booking.index') }}">Mulai Booking</a>
        </div>
    </header>

    <!-- Pilihan Layanan Section -->
    <section class="si-section" id="services-list" style="padding-top:2rem;">
        <div class="si-section-header">
            <span class="si-section-tag">Signature Services</span>
            <h2 class="si-section-title">Pilihan Layanan <em>Terbaik</em></h2>
            <p class="si-section-sub">Klik detail layanan untuk melihat rincian paket eksklusif atau langsung pesan tanggal acara Anda.</p>
        </div>

        <div class="si-grid">
            @foreach($services as $service)
                @php
                    $isBundle = $service->slug === 'bundle';
                    $isAudio = $service->slug === 'gladtocall';
                    $isPhoto = $service->slug === 'gladmoments';
                @endphp
                <div class="si-card {{ $isBundle ? 'bundle-card' : '' }}">
                    <div class="si-card-img-wrap">
                        @if($isBundle)
                            <span class="si-card-badge si-badge-bundle">Best Value</span>
                            <div class="si-card-img-overlay"></div>
                            <img class="si-card-img" src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=800&auto=format&fit=crop" alt="Luxury Wedding Reception Gathering">
                        @elseif($isAudio)
                            <span class="si-card-badge si-badge-gold">Vintage Experience</span>
                            <div class="si-card-img-overlay"></div>
                            <img class="si-card-img" src="https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?q=80&w=800&auto=format&fit=crop" alt="Glad to Call Vintage Telephone">
                        @else
                            <span class="si-card-badge si-badge-rose">Instagrammable</span>
                            <div class="si-card-img-overlay"></div>
                            <img class="si-card-img" src="https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?q=80&w=800&auto=format&fit=crop" alt="Glad Moments Photobooth Strips">
                        @endif
                    </div>
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->description }}</p>
                    
                    <ul class="si-feature-list">
                        @foreach($service->packages as $pkg)
                            <li class="si-feature-item">
                                <span class="si-feature-icon">{{ $isBundle ? '★' : '✓' }}</span>
                                <span>{{ $pkg->name }} - <strong>Rp {{ number_format($pkg->price, 0, ',', '.') }}</strong></span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="si-btn-wrap">
                        @if($isBundle)
                            <a href="{{ route('booking.index', ['type' => 'bundle']) }}" class="si-btn-outline" style="border-color: rgba(251, 45, 90, 0.3);">Paket</a>
                            <a href="{{ route('booking.index', ['type' => 'bundle']) }}" class="si-btn-solid si-btn-solid-rose">Booking</a>
                        @else
                            <a href="{{ route('services.show', $service->slug) }}" class="si-btn-outline">Detail</a>
                            <a href="{{ route('booking.index', ['type' => $isAudio ? 'audio' : 'photobooth']) }}" class="si-btn-solid {{ $isPhoto ? 'si-btn-solid-rose' : '' }}">Booking</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Comparison Grid Section -->
    <section class="si-compare-section">
        <div class="si-section" style="padding-top: 0; padding-bottom: 2rem;">
            <div class="si-section-header">
                <span class="si-section-tag">Comparison Guide</span>
                <h2 class="si-section-title">Bandingkan <em>Keunggulan</em> Fitur</h2>
                <p class="si-section-sub">Bandingkan setiap detail fitur layanan kami untuk menemukan kecocokan sempurna bagi perayaan impian Anda.</p>
            </div>

            <div class="si-comparison-table-wrap">
                <table class="si-compare-table">
                    <thead>
                        <tr>
                            <th>Fitur Utama</th>
                            <th>Glad to Call</th>
                            <th>Glad Moments</th>
                            <th class="highlight-col" style="border-top-left-radius: 12px; border-top-right-radius: 12px; text-align: center; color: var(--si-rose);">Bundling Pack ✨</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Jenis Layanan</strong></td>
                            <td>Audio Guestbook (Pesan Suara)</td>
                            <td>Photobooth (Foto Cetak)</td>
                            <td class="highlight-col" style="text-align: center;">Audio Guestbook + Photobooth</td>
                        </tr>
                        <tr>
                            <td><strong>Output Utama</strong></td>
                            <td>File Audio (.mp3 / Google Drive)</td>
                            <td>Foto Cetak Fisik &amp; QR Digital</td>
                            <td class="highlight-col" style="text-align: center;">Fisik &amp; Digital (Audio + Foto)</td>
                        </tr>
                        <tr>
                            <td><strong>Custom Tampilan</strong></td>
                            <td>Desain Buku Petunjuk Klasik</td>
                            <td>Custom Border / Cover Majalah</td>
                            <td class="highlight-col" style="text-align: center;">Custom Border &amp; Meja Display Khusus</td>
                        </tr>
                        <tr>
                            <td><strong>Durasi Standard</strong></td>
                            <td>Selama Acara Selesai</td>
                            <td>3 - 4 Jam Pemakaian</td>
                            <td class="highlight-col" style="text-align: center;">Durasi Maksimal Sesuai Event</td>
                        </tr>
                        <tr>
                            <td><strong>Buku Tamu Fisik</strong></td>
                            <td><span class="si-check-no">✕</span> (Digital)</td>
                            <td><span class="si-check-ok">✓</span> Tergantung Paket</td>
                            <td class="highlight-col" style="text-align: center; color: #2ECC71;"><span class="si-check-ok">✓</span> Termasuk Premium Book</td>
                        </tr>
                        <tr>
                            <td><strong>Ketersediaan Props</strong></td>
                            <td>Meja display vintage aesthetic</td>
                            <td>Props Lucu, Kacamata, dll.</td>
                            <td class="highlight-col" style="text-align: center; color: #2ECC71;"><span class="si-check-ok">✓</span> Full set premium props</td>
                        </tr>
                        <tr>
                            <td><strong>Kisaran Harga</strong></td>
                            <td><span class="si-text-price">Mulai Rp 1.5M</span></td>
                            <td><span class="si-text-price">Mulai Rp 2.2M</span></td>
                            <td class="highlight-col style-price" style="text-align: center; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                <span class="si-text-price si-text-price-rose">Lebih Hemat Up to 20%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Timeline Cara Booking Section -->
    <section class="si-section" style="padding-top:4rem; padding-bottom:4rem;">
        <div class="si-timeline-card">
            <div class="si-section-header" style="margin-bottom:2rem;">
                <span class="si-section-tag" style="text-align:center;">Simple Steps</span>
                <h2 class="si-section-title" style="font-size:2.1rem;">Bagaimana Alur Pemesanan Kami?</h2>
            </div>
            
            <div class="si-timeline-grid">
                <div class="si-time-item">
                    <div class="si-time-num">01</div>
                    <h4>Pilih Layanan Anda</h4>
                    <p>Tentukan tipe layanan signature yang paling cocok dengan konsep dan kebutuhan event spesial Anda.</p>
                </div>
                <div class="si-time-item">
                    <div class="si-time-num">02</div>
                    <h4>Tentukan Tanggal</h4>
                    <p>Cek ketersediaan jadwal kosong melalui kalender tanpa login, lalu isi form data acara secara lengkap.</p>
                </div>
                <div class="si-time-item">
                    <div class="si-time-num">03</div>
                    <h4>Bayar DP &amp; Lock</h4>
                    <p>Bayar DP Rp 500.000 untuk mengunci tanggal. Unggah bukti transfer di dashboard pelunasan H-5.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section class="si-faq-section">
        <div class="si-section-header">
            <span class="si-section-tag">Frequently Asked Questions</span>
            <h2 class="si-section-title">Mungkin Anda <em>Bertanya</em>?</h2>
            <p class="si-section-sub">Berikut beberapa informasi penting mengenai layanan, operasional, dan teknis pelaksanaan booking.</p>
        </div>

        <div class="si-faq-container">
            <!-- FAQ 1 -->
            <div class="si-faq-item">
                <button class="si-faq-trigger">
                    <span>Apakah saya bisa mengecek tanggal kosong sebelum memesan?</span>
                    <span class="si-faq-icon">▼</span>
                </button>
                <div class="si-faq-content">
                    <p>Ya, tentu saja! Anda bisa langsung mengunjungi halaman booking kami. Di sana, kalender interaktif kami menampilkan status ketersediaan slot kosong secara real-time tanpa perlu melakukan login terlebih dahulu.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="si-faq-item">
                <button class="si-faq-trigger">
                    <span>Berapa lama durasi pemakaian standard untuk photobooth?</span>
                    <span class="si-faq-icon">▼</span>
                </button>
                <div class="si-faq-content">
                    <p>Durasi standard pemakaian photobooth adalah 3 hingga 4 jam pemakaian aktif selama acara. Namun, jika Anda memerlukan penambahan waktu di lokasi, kami menyediakan opsi add-on overtime dengan biaya terjangkau.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="si-faq-item">
                <button class="si-faq-trigger">
                    <span>Apakah ada tambahan biaya untuk acara di luar kota?</span>
                    <span class="si-faq-icon">▼</span>
                </button>
                <div class="si-faq-content">
                    <p>Layanan kami mencakup area dalam kota secara gratis biaya transportasi. Untuk acara di luar area operasional utama kami, akan ada biaya akomodasi dan transportasi tambahan yang disesuaikan secara transparan sebelum pembayaran DP.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="si-faq-item">
                <button class="si-faq-trigger">
                    <span>Kapan saya akan menerima hasil foto digital dan rekaman suaranya?</span>
                    <span class="si-faq-icon">▼</span>
                </button>
                <div class="si-faq-content">
                    <p>Untuk photobooth, foto fisik akan langsung dicetak di tempat (hanya dalam 3 detik setelah pemotretan), dan tamu bisa langsung mendownload file digitalnya lewat scan QR code. Untuk kompilasi lengkap foto digital serta seluruh rekaman pesan suara Glad to Call, kami akan mengirimkan tautan Google Drive beresolusi tinggi maksimal H+2 setelah acara selesai.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ticket-Stub CTA Section -->
    <section class="si-section" style="padding-bottom:8rem; padding-top:4rem;">
        <div class="si-ticket-banner">
            <div class="si-ticket-cutout-left"></div>
            <div class="si-ticket-cutout-right"></div>
            <div class="si-ticket-divider"></div>
            
            <div class="si-ticket-left">
                <h2>Siap Mengabadikan Momen <span>Terbaik</span> Anda?</h2>
                <p>Kunci tanggal perayaan spesial Anda hari ini. Amankan slot jadwal sebelum kehabisan, dapatkan harga promo terbaik, dan biarkan kami membuat event Anda semakin berkesan.</p>
            </div>
            
            <div class="si-ticket-right">
                <a href="{{ route('booking.index') }}" class="si-ticket-btn">
                    <span>Mulai Booking</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Simple Accordion Vanilla JS Handler -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.si-faq-item');
        
        faqItems.forEach(item => {
            const trigger = item.querySelector('.si-faq-trigger');
            const content = item.querySelector('.si-faq-content');
            
            trigger.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close all other active items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.si-faq-content').style.maxHeight = null;
                    }
                });
                
                // Toggle current item
                if (isActive) {
                    item.classList.remove('active');
                    content.style.maxHeight = null;
                } else {
                    item.classList.add('active');
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    });
</script>
@endsection
