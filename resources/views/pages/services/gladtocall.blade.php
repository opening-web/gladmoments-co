@extends('layouts.app')

@section('styles')
<style>
    /* Premium Rose-Gold & Velvet Theme Variable Overrides */
    :root {
        --theme-primary: #FB2D5A;
        --theme-primary-hover: #D61B44;
        --theme-gold: #B08D57;
        --theme-cream: #FDFBF7;
        --theme-dark: #1A1206;
    }

    /* Page-Specific Styles */
    .gtc-body {
        background-color: var(--theme-cream);
        color: #2D2D2D;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Backdrops */
    .gtc-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(ellipse 60% 40% at 50% -10%, rgba(251, 45, 90, 0.08) 0%, transparent 60%),
            radial-gradient(ellipse 50% 50% at 90% 80%, rgba(176, 141, 87, 0.06) 0%, transparent 50%);
        z-index: 0;
        pointer-events: none;
    }

    /* Smooth Navbar Sticky Integration */
    nav {
        background: rgba(253, 251, 247, 0.8) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(176, 141, 87, 0.08);
    }
    nav.scrolled {
        background: rgba(253, 251, 247, 0.95) !important;
        box-shadow: 0 4px 30px rgba(251, 45, 90, 0.05);
    }
    .nav-logo a {
        color: var(--theme-dark) !important;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }
    .nav-links a {
        color: #4A4A4A !important;
        font-weight: 500;
    }
    .nav-links a:hover {
        color: var(--theme-primary) !important;
    }
    .btn-nav {
        background: var(--theme-primary) !important;
    }
    .btn-nav:hover {
        background: var(--theme-primary-hover) !important;
    }

    /* Bio-Link Hero Section */
    .gtc-hero {
        padding: 9rem 2rem 5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .gtc-profile-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 20px 50px rgba(176, 141, 87, 0.08);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        max-width: 500px;
        width: 100%;
        margin-bottom: 3rem;
        transform: translateY(0);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s;
    }
    .gtc-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(251, 45, 90, 0.12);
    }
    .gtc-avatar-wrapper {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 1.5rem;
    }
    .gtc-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-cover: cover;
        border: 3px solid #fff;
        box-shadow: 0 8px 24px rgba(251, 45, 90, 0.15);
    }
    .gtc-badge {
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--theme-primary);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(251, 45, 90, 0.2);
    }
    .gtc-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--theme-dark);
        font-weight: 700;
        margin-bottom: 0.35rem;
        letter-spacing: -0.01em;
    }
    .gtc-subtitle {
        font-size: 0.95rem;
        color: var(--theme-gold);
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }
    .gtc-bio {
        font-size: 0.88rem;
        color: #5A5A5A;
        line-height: 1.6;
        border-top: 1px solid rgba(176, 141, 87, 0.15);
        padding-top: 1.2rem;
        margin-top: 1rem;
    }
    .gtc-bio em {
        color: var(--theme-primary);
        font-style: normal;
        margin-right: 0.35rem;
    }

    /* Elegant Link-in-Bio Cards */
    .gtc-links-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
    }
    .gtc-link-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border: 1px solid rgba(176, 141, 87, 0.2);
        border-radius: 16px;
        padding: 1.1rem 1.5rem;
        text-decoration: none;
        color: var(--theme-dark);
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 12px rgba(176, 141, 87, 0.03);
    }
    .gtc-link-btn:hover {
        background: var(--theme-primary);
        color: #fff !important;
        border-color: var(--theme-primary);
        transform: scale(1.025);
        box-shadow: 0 10px 24px rgba(251, 45, 90, 0.2);
    }
    .gtc-link-btn span {
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }
    .gtc-link-icon {
        font-size: 1.3rem;
    }
    .gtc-link-arrow {
        font-size: 0.8rem;
        opacity: 0.6;
        transition: transform 0.3s;
    }
    .gtc-link-btn:hover .gtc-link-arrow {
        transform: translateX(4px);
        opacity: 1;
    }

    /* Core Content Styling */
    .gtc-section {
        padding: 6rem 2rem;
        position: relative;
        z-index: 1;
        max-width: 1100px;
        margin: 0 auto;
    }
    .gtc-section-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    .gtc-section-tag {
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--theme-primary);
        margin-bottom: 0.8rem;
        display: block;
        font-weight: 600;
    }
    .gtc-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 600;
        color: var(--theme-dark);
        line-height: 1.25;
    }
    .gtc-section-title em {
        color: var(--theme-primary);
        font-style: normal;
    }

    /* Grid layout of services */
    .gtc-service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
    }
    .gtc-service-card {
        background: #fff;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        border: 1px solid rgba(176, 141, 87, 0.12);
        transition: all 0.35s ease;
        box-shadow: 0 8px 30px rgba(0,0,0,0.01);
    }
    .gtc-service-card:hover {
        transform: translateY(-6px);
        border-color: var(--theme-primary);
        box-shadow: 0 20px 40px rgba(251, 45, 90, 0.08);
    }
    .gtc-service-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: rgba(251, 45, 90, 0.15);
        line-height: 1;
        margin-bottom: 1.2rem;
        transition: color 0.35s;
    }
    .gtc-service-card:hover .gtc-service-num {
        color: rgba(251, 45, 90, 0.4);
    }
    .gtc-service-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: var(--theme-dark);
        margin-bottom: 0.8rem;
        font-weight: 600;
    }
    .gtc-service-card p {
        font-size: 0.86rem;
        color: #666;
        line-height: 1.65;
    }

    /* Dynamic Pricing Cards */
    .gtc-price-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }
    .gtc-price-card {
        background: #fff;
        border: 1px solid rgba(176, 141, 87, 0.15);
        border-radius: 24px;
        padding: 3rem 2.2rem;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: all 0.4s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.01);
    }
    .gtc-price-card.featured {
        border: 2px solid var(--theme-primary);
        box-shadow: 0 20px 50px rgba(251, 45, 90, 0.1);
    }
    .gtc-price-card.featured::before {
        content: 'POPULAR';
        position: absolute;
        top: 24px;
        right: -32px;
        background: var(--theme-primary);
        color: #fff;
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 0.3rem 2.5rem;
        transform: rotate(45deg);
        box-shadow: 0 2px 8px rgba(251, 45, 90, 0.2);
    }
    .gtc-price-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(176, 141, 87, 0.12);
    }
    .gtc-price-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--theme-dark);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .gtc-price-amount {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--theme-primary);
        margin-bottom: 1.8rem;
        letter-spacing: -0.02em;
    }
    .gtc-price-features {
        list-style: none;
        padding: 0;
        margin: 0 0 2.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }
    .gtc-price-features li {
        font-size: 0.9rem;
        color: #555;
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }
    .gtc-price-features li::before {
        content: '✔';
        color: var(--theme-primary);
        font-weight: 900;
        font-size: 0.8rem;
    }
    .gtc-price-btn {
        margin-top: auto;
        display: block;
        text-align: center;
        background: transparent;
        border: 2px solid var(--theme-primary);
        color: var(--theme-primary);
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.88rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: all 0.3s;
        text-decoration: none;
    }
    .gtc-price-card:hover .gtc-price-btn {
        background: var(--theme-primary);
        color: #fff;
        box-shadow: 0 8px 20px rgba(251, 45, 90, 0.2);
    }
    .gtc-price-card.featured .gtc-price-btn {
        background: var(--theme-primary);
        color: #fff;
    }
    .gtc-price-card.featured:hover .gtc-price-btn {
        background: var(--theme-primary-hover);
        border-color: var(--theme-primary-hover);
    }

    /* Premium Dual Column split */
    .gtc-split {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 3rem;
        align-items: center;
        background: #fff;
        border-radius: 32px;
        border: 1px solid rgba(176, 141, 87, 0.12);
        padding: 4rem;
        box-shadow: 0 20px 60px rgba(176, 141, 87, 0.04);
        margin-bottom: 4rem;
    }
    @media(max-width:860px){
        .gtc-split {
            grid-template-columns: 1fr;
            padding: 2.5rem;
        }
    }
    .gtc-split-content h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--theme-dark);
        margin-bottom: 1.2rem;
        font-weight: 600;
    }
    .gtc-split-content p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 2rem;
    }
    .gtc-highlight-box {
        background: var(--theme-cream);
        border: 1px dashed rgba(251, 45, 90, 0.25);
        border-radius: 20px;
        padding: 2.2rem;
        position: relative;
    }
    .gtc-highlight-box h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--theme-dark);
        margin-bottom: 0.8rem;
    }
    .gtc-highlight-box p {
        font-size: 0.88rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    .gtc-action-btn {
        display: inline-block;
        background: var(--theme-primary);
        color: #fff;
        padding: 0.85rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 6px 15px rgba(251, 45, 90, 0.15);
    }
    .gtc-action-btn:hover {
        background: var(--theme-primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(251, 45, 90, 0.25);
    }

    /* Rules wrapper */
    .gtc-rules-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
    .gtc-rule-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(176, 141, 87, 0.12);
        padding: 2.5rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.01);
    }
    .gtc-rule-card h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        color: var(--theme-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .gtc-rule-card h4::before {
        content: '❖';
        color: var(--theme-primary);
        font-size: 0.9rem;
    }
    .gtc-rule-card p {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.7;
    }
    .nav-logo-arrow {
        display: inline-block;
        width: 24px;
        height: 24px;
        margin-right: 0.5rem;
        vertical-align: middle;
        animation: slideArrow 0.6s ease-in-out infinite;
        transform: scaleX(-1);
    }
    @keyframes slideArrow {
        0%, 100% { transform: translateX(0) scaleX(-1); }
        50% { transform: translateX(-4px) scaleX(-1); }
    }
</style>
@endsection

@section('navbar')
<nav id="navbar">
   <div class="nav-logo"><a href="{{ route('home') }}"><img src="https://cdn-icons-png.flaticon.com/512/271/271228.png" alt="arrow" class="nav-logo-arrow"> Glad Moments & Co</a></div>
    <ul class="nav-links">
        <li><a href="#about">Tentang</a></li>
        <li><a href="#layanan">Layanan</a></li>
        <li><a href="#pricelist">Pricelist</a></li>
        <li><a href="#rules">Aturan</a></li>
        <li><a class="btn-nav" href="{{ route('booking.index', ['type' => 'audio']) }}">Book Now</a></li>
    </ul>
</nav>
@endsection

@section('content')
<div class="gtc-body" id="home">
    <div class="gtc-bg-pattern"></div>

    <!-- Bio-Link Hero Section -->
    <header class="gtc-hero">
        <div class="gtc-profile-card">
            <div class="gtc-avatar-wrapper">
                <img class="gtc-avatar" src="https://passio-prod.s3-ap-southeast-1.amazonaws.com/passio-prod/builder/6642128b4a3054633e1568bb/profile_27_.png" alt="gladtocall avatar">
                <div class="gtc-badge">Premium</div>
            </div>
            <h1 class="gtc-title">gladtocall</h1>
            <p class="gtc-subtitle">Audio Guestbook</p>
            <p class="gtc-bio">
                <em>📍</em>Jabodetabek &amp; Bandung<br>
                PT Gladi Harmoni Sejahtera
            </p>
        </div>

        <!-- Interactive Quick Link buttons -->
        <div class="gtc-links-container">
            <a class="gtc-link-btn" href="https://www.instagram.com/gladtocall" target="_blank" rel="noopener">
                <span><span class="gtc-link-icon">📸</span> Instagram @gladtocall</span>
                <span class="gtc-link-arrow">➔</span>
            </a>
            <a class="gtc-link-btn" href="mailto:gladtocall@gmail.com">
                <span><span class="gtc-link-icon">✉</span> gladtocall@gmail.com</span>
                <span class="gtc-link-arrow">➔</span>
            </a>
            <a class="gtc-link-btn" href="https://wa.me/6287788991305?text=Halo%20Glad%20to%20Call%2C%20saya%20ingin%20menanyakan%20layanan%20audio%20guestbook" target="_blank" rel="noopener">
                <span><span class="gtc-link-icon">💬</span> WhatsApp Business</span>
                <span class="gtc-link-arrow">➔</span>
            </a>
            <a class="gtc-link-btn" href="{{ route('booking.index', ['type' => 'audio']) }}">
                <span><span class="gtc-link-icon">📅</span> Book Audio Guestbook</span>
                <span class="gtc-link-arrow">➔</span>
            </a>
        </div>
    </header>

    <!-- About Section -->
    <section class="gtc-section" id="about">
        <div class="gtc-section-header">
            <span class="gtc-section-tag">Sekilas Info</span>
            <h2 class="gtc-section-title">Temui <em>Glad to Call</em></h2>
        </div>
        
        <div class="gtc-split">
            <div class="gtc-split-content">
                <h3>Tentang Layanan Kami</h3>
                <p>Glad to Call merupakan lini eksklusif penyedia Audio Guestbook dan Retro Telephone Supply di bawah PT Gladi Harmoni Sejahtera. Kami menghadirkan telepon vintage yang diubah menjadi perekam suara tamu digital, menambahkan sentuhan retro interaktif yang intim dan membekas di hati pada acara pernikahan, ulang tahun, dan pesta eksklusif Anda di wilayah Jabodetabek &amp; Bandung.</p>
                <a class="gtc-action-btn" href="#pricelist">Cek Ketersediaan &amp; Harga</a>
            </div>
            <div class="gtc-highlight-box">
                <h3>Kenapa Memilih Kami?</h3>
                <p>Setiap ucapan dari tamu berharga. Kami menggabungkan perangkat keras telepon rotary klasik dengan sistem audio digital modern beresolusi tinggi, memastikan ucapan, tawa, dan tangis bahagia tersimpan dengan kualitas terbaik selamanya.</p>
                <a class="gtc-action-btn" style="background:var(--theme-dark);" href="{{ route('booking.index', ['type' => 'audio']) }}">Booking Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="gtc-section" id="layanan" style="background:#fff; border-top:1px solid rgba(176,141,87,0.08); border-bottom:1px solid rgba(176,141,87,0.08);">
        <div class="gtc-section-header">
            <span class="gtc-section-tag">Layanan Kami</span>
            <h2 class="gtc-section-title">Solusi Event <em>Interaktif</em></h2>
        </div>

        <div class="gtc-service-grid">
            <div class="gtc-service-card">
                <div class="gtc-service-num">01</div>
                <h3>Audio Guestbook Service</h3>
                <p>Tamu mengangkat gagang telepon retro, mendengarkan greeting rekaman Anda, dan langsung meninggalkan pesan suara spesial mereka.</p>
            </div>
            <div class="gtc-service-card">
                <div class="gtc-service-num">02</div>
                <h3>Retro Telephone Supply</h3>
                <p>Sewa unit telepon vintage estetik untuk dekorasi bertema vintage, properti photoshoot kelas premium, atau hospitality booth.</p>
            </div>
            <div class="gtc-service-card">
                <div class="gtc-service-num">03</div>
                <h3>Hospitality Equipment</h3>
                <p>Layanan aksesoris pelengkap dekorasi vintage yang disiapkan secara spesifik untuk meningkatkan atmosfer klasik di tempat Anda.</p>
            </div>
            <div class="gtc-service-card">
                <div class="gtc-service-num">04</div>
                <h3>Event Experience Solutions</h3>
                <p>Konsultasi kustom konsep audio guestbook terintegrasi agar bersinergi indah dengan tema visual desainer/dekorator acara Anda.</p>
            </div>
        </div>
    </section>

    <!-- Pricelist Section -->
    <section class="gtc-section" id="pricelist">
        <div class="gtc-section-header">
            <span class="gtc-section-tag">Investasi</span>
            <h2 class="gtc-section-title">Pilih Paket <em>Audio Guestbook</em></h2>
        </div>

        <div class="gtc-price-grid">
            <!-- Paket 1 -->
            <div class="gtc-price-card">
                <h3>Audio Guestbook (2 Jam)</h3>
                <div class="gtc-price-amount">Rp 2.500.000</div>
                <ul class="gtc-price-features">
                    <li>1 Unit Telepon Retro Vintage</li>
                    <li>Durasi sewa 2 jam operasional</li>
                    <li>Audio greeting host kustom</li>
                    <li>Semua file rekaman digital</li>
                    <li>2 Crew standby &amp; setup</li>
                </ul>
                <a class="gtc-price-btn" href="{{ route('booking.index', ['type' => 'audio']) }}">Book Now</a>
            </div>

            <!-- Paket 2 Featured -->
            <div class="gtc-price-card featured">
                <h3>Audio Guestbook (4 Jam)</h3>
                <div class="gtc-price-amount">Rp 3.500.000</div>
                <ul class="gtc-price-features">
                    <li>1 Unit Telepon Retro Vintage</li>
                    <li>Durasi sewa 4 jam operasional</li>
                    <li>Audio greeting host kustom</li>
                    <li>Semua file rekaman digital</li>
                    <li>2 Crew standby &amp; setup</li>
                    <li>Rekomendasi untuk event wedding</li>
                </ul>
                <a class="gtc-price-btn" href="{{ route('booking.index', ['type' => 'audio']) }}">Book Now</a>
            </div>

            <!-- Paket 3 -->
            <div class="gtc-price-card">
                <h3>Retro Telephone Supply</h3>
                <div class="gtc-price-amount">Rp 1.500.000</div>
                <ul class="gtc-price-features">
                    <li>1 Unit Telepon Retro Pilihan</li>
                    <li>Sewa khusus unit dekoratif</li>
                    <li>Tujuan pemotretan / display</li>
                    <li>Pengiriman &amp; penjemputan unit</li>
                    <li>Rotary &amp; soft-phone style</li>
                </ul>
                <a class="gtc-price-btn" href="{{ route('booking.index', ['type' => 'audio']) }}">Book Now</a>
            </div>
        </div>
    </section>

    <!-- Rules Section -->
    <section class="gtc-section" id="rules" style="background:#fff; border-top:1px solid rgba(176,141,87,0.08); padding-bottom:8rem;">
        <div class="gtc-section-header">
            <span class="gtc-section-tag">Ketentuan</span>
            <h2 class="gtc-section-title">Aturan &amp; <em>Pemesanan</em></h2>
        </div>

        <div class="gtc-rules-container">
            <div class="gtc-rule-card">
                <h4>Ketentuan Venue</h4>
                <p>Harap sediakan area operasional minimal 2x2 meter dengan pencahayaan yang cukup. Area disarankan bertipe indoor/semi-outdoor terlindung guna menjaga kualitas perekaman audio yang optimal serta kebersihan fisik alat vintage.</p>
            </div>
            <div class="gtc-rule-card">
                <h4>DP &amp; Pelunasan</h4>
                <p>Booking tanggal dipastikan sah setelah pembayaran DP sebesar Rp 500.000. Pelunasan sisa tagihan wajib diselesaikan selambat-lambatnya H-5 sebelum tanggal acara berlangsung melalui dashboard checkout kami.</p>
            </div>
        </div>
    </section>
</div>
@endsection

