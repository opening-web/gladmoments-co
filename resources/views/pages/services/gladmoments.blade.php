@extends('layouts.app')

@section('styles')
<style>
    /* Premium Amber & Warm Gold Variable Theme Overrides */
    :root {
        --theme-amber: #F2B266;
        --theme-amber-dark: #D49042;
        --theme-charcoal: #1A1A1A;
        --theme-gray-light: #F4F4F4;
        --theme-gray-muted: #8E8E8E;
    }

    /* Page container */
    .gm-body {
        background-color: var(--theme-gray-light);
        color: #333333;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }

    /* Elegant Grid Pattern overlay */
    .gm-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(ellipse 60% 40% at 50% -10%, rgba(242, 178, 102, 0.08) 0%, transparent 60%),
            radial-gradient(ellipse 50% 50% at 10% 80%, rgba(26, 26, 26, 0.03) 0%, transparent 50%);
        z-index: 0;
        pointer-events: none;
    }

    /* Custom Premium Navbar Styles */
    nav {
        background: rgba(26, 26, 26, 0.95) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(242, 178, 102, 0.15);
    }
    nav.scrolled {
        background: #1A1A1A !important;
        box-shadow: 0 4px 30px rgba(242, 178, 102, 0.08);
    }
    .nav-logo a {
        color: #FFFFFF !important;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        letter-spacing: 0.04em;
    }
    .nav-links a {
        color: rgba(255, 255, 255, 0.8) !important;
        font-size: 0.8rem !important;
    }
    .nav-links a:hover {
        color: var(--theme-amber) !important;
    }
    .btn-nav {
        background: var(--theme-amber) !important;
        color: #1A1A1A !important;
        font-weight: 600 !important;
    }
    .btn-nav:hover {
        background: var(--theme-amber-dark) !important;
        color: #FFFFFF !important;
    }

    /* Hero / Header Section */
    .gm-hero {
        padding: 10rem 2rem 5rem;
        text-align: center;
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }
    .gm-hero-tag {
        font-size: 0.72rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--theme-amber);
        margin-bottom: 1rem;
        display: inline-block;
        font-weight: 600;
        border: 1px solid rgba(242, 178, 102, 0.3);
        padding: 0.3rem 1.1rem;
        border-radius: 4px;
        background: rgba(242, 178, 102, 0.03);
    }
    .gm-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        color: var(--theme-charcoal);
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 1.5rem;
    }
    .gm-hero h1 span {
        color: var(--theme-amber);
        font-style: italic;
        font-weight: 400;
    }
    .gm-hero p {
        font-size: 1rem;
        color: #555555;
        line-height: 1.8;
        max-width: 720px;
        margin: 0 auto 3rem;
        font-weight: 300;
    }

    /* Anchor Quick Links */
    .gm-anchor-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.85rem;
        max-width: 800px;
        margin: 0 auto 3rem;
    }
    .gm-anchor-btn {
        background: #FFFFFF;
        border: 1px solid rgba(26, 26, 26, 0.1);
        padding: 1rem 0.5rem;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        text-decoration: none;
        color: var(--theme-charcoal);
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }
    .gm-anchor-btn:hover {
        border-color: var(--theme-amber);
        color: var(--theme-amber);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(242, 178, 102, 0.15);
    }

    /* Social Pills */
    .gm-social-container {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .gm-social-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(26, 26, 26, 0.05);
        border: 1px solid transparent;
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--theme-charcoal);
        text-decoration: none;
        transition: all 0.3s;
    }
    .gm-social-btn:hover {
        background: #1A1A1A;
        color: #FFFFFF !important;
        transform: translateY(-2px);
    }

    /* Standardized premium section layout */
    .gm-section {
        padding: 5rem 2rem;
        position: relative;
        z-index: 1;
        max-width: 1100px;
        margin: 0 auto;
    }
    .gm-section-header {
        text-align: center;
        margin-bottom: 3.5rem;
    }
    .gm-section-tag {
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--theme-amber);
        margin-bottom: 0.6rem;
        display: block;
        font-weight: 600;
    }
    .gm-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: var(--theme-charcoal);
        line-height: 1.3;
    }
    .gm-section-title em {
        color: var(--theme-amber);
        font-style: normal;
    }

    /* Package presentation block */
    .gm-pkg-block {
        background: #FFFFFF;
        border-radius: 28px;
        border: 1px solid rgba(26, 26, 26, 0.08);
        box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        padding: 3.5rem;
        margin-bottom: 3rem;
        scroll-margin-top: 110px;
        transition: box-shadow 0.35s, transform 0.35s;
    }
    .gm-pkg-block:hover {
        box-shadow: 0 20px 50px rgba(242, 178, 102, 0.08);
        transform: translateY(-2px);
    }
    .gm-pkg-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }
    @media(max-width:860px){
        .gm-pkg-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        .gm-pkg-block {
            padding: 2.2rem;
        }
    }
    .gm-pkg-details h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--theme-charcoal);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .gm-pkg-details h3::before {
        content: '■';
        color: var(--theme-amber);
        font-size: 1.1rem;
    }
    .gm-pkg-price-list {
        background: var(--theme-gray-light);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }
    .gm-pkg-price-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.95rem;
        color: #444;
    }
    .gm-pkg-price-row strong {
        color: var(--theme-amber-dark);
        font-weight: 700;
    }
    .gm-pkg-desc {
        font-size: 0.88rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    .gm-pkg-btn-group {
        display: flex;
        gap: 0.85rem;
    }
    .gm-pkg-btn-group a {
        flex: 1;
        text-align: center;
        padding: 0.85rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.25s;
    }
    .gm-btn-solid {
        background: var(--theme-amber);
        color: var(--theme-charcoal) !important;
        border: 1px solid var(--theme-amber);
        box-shadow: 0 4px 12px rgba(242, 178, 102, 0.25);
    }
    .gm-btn-solid:hover {
        background: var(--theme-amber-dark);
        border-color: var(--theme-amber-dark);
        color: #FFFFFF !important;
    }
    .gm-btn-outline {
        border: 1px solid rgba(26,26,26,0.15);
        color: var(--theme-charcoal);
        background: transparent;
    }
    .gm-btn-outline:hover {
        background: var(--theme-charcoal);
        border-color: var(--theme-charcoal);
        color: #FFFFFF !important;
    }

    /* What you get checks */
    .gm-pkg-checklist-wrapper h4 {
        font-size: 0.9rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--theme-charcoal);
        font-weight: 700;
        margin-bottom: 1.2rem;
    }
    .gm-pkg-checklist {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    .gm-pkg-checklist.two-col {
        grid-template-columns: 1fr 1fr;
    }
    @media(max-width:540px){
        .gm-pkg-checklist.two-col {
            grid-template-columns: 1fr;
        }
    }
    .gm-pkg-checklist li {
        font-size: 0.85rem;
        color: #555555;
        display: flex;
        align-items: center;
        gap: 0.55rem;
        line-height: 1.4;
    }
    .gm-pkg-checklist li::before {
        content: '✓';
        color: var(--theme-amber-dark);
        font-weight: 900;
        font-size: 0.95rem;
    }

    /* T&C details */
    .gm-pkg-tc {
        border-top: 1px solid rgba(0,0,0,0.06);
        margin-top: 1.8rem;
        padding-top: 1.2rem;
    }
    .gm-pkg-tc p {
        font-size: 0.76rem;
        color: var(--theme-gray-muted);
        line-height: 1.6;
    }
    .gm-pkg-tc strong {
        color: var(--theme-charcoal);
        font-weight: 600;
    }

    /* Terms Accordion styles */
    .gm-terms-wrap {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        scroll-margin-top: 110px;
    }
    .gm-term-card {
        background: #FFFFFF;
        border-radius: 20px;
        border: 1px solid rgba(26,26,26,0.08);
        padding: 2.8rem 2.2rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.02);
    }
    .gm-term-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--theme-charcoal);
        margin-bottom: 1.5rem;
        border-bottom: 1px solid rgba(242, 178, 102, 0.25);
        padding-bottom: 0.65rem;
    }
    .gm-term-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }
    .gm-term-list li {
        font-size: 0.86rem;
        color: #555;
        line-height: 1.7;
        padding-left: 1.2rem;
        position: relative;
    }
    .gm-term-list li::before {
        content: '✦';
        position: absolute;
        left: 0;
        color: var(--theme-amber);
        font-size: 0.75rem;
    }
    .gm-term-list strong {
        color: var(--theme-charcoal);
        font-weight: 600;
    }
    .nav-logo-arrow {
        display: inline-block;
        width: 24px;
        height: 24px;
        margin-right: 0.5rem;
        vertical-align: middle;
        animation: slideArrow 0.6s ease-in-out infinite;
        transform: scaleX(-1);
        filter: invert(1); brightness(1.2);
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
        <li><a href="#classic">Classic</a></li>
        <li><a href="#magazine">Magazine</a></li>
        <li><a href="#lite">Magazine Lite</a></li>
        <li><a href="#booth-only">Booth Only</a></li>
        <li><a href="#rules">Terms</a></li>
        <li><a class="btn-nav" href="{{ route('booking.index', ['type' => 'photobooth']) }}">Book Now</a></li>
    </ul>
</nav>
@endsection

@section('content')
<div class="gm-body" id="home">
    <div class="gm-bg-pattern"></div>

    <!-- Carrd Inspired Hero Section -->
    <header class="gm-hero">
        <span class="gm-hero-tag">Glad Moments</span>
        <h1>Elevate Your Celebration with <span>photobooth</span></h1>
        <p>From timeless photobooths to iconic magazine-style setups, Glad in Booth turns your celebration into a keepsake. Choose your vibe, strike a pose, and let every photo speak your story.</p>
        
        <!-- Fast Scroll anchors -->
        <div class="gm-anchor-grid">
            <a class="gm-anchor-btn" href="#classic">Classic Photobooth</a>
            <a class="gm-anchor-btn" href="#magazine">Magazine Photobooth</a>
            <a class="gm-anchor-btn" href="#lite">Magazine Lite</a>
            <a class="gm-anchor-btn" href="#booth-only">Booth Only</a>
        </div>

        <!-- Social Icons -->
        <div class="gm-social-container">
            <a class="gm-social-btn" href="https://www.instagram.com/gladmomentspl" target="_blank" rel="noopener">
                <span>📸 Instagram</span>
            </a>
            <a class="gm-social-btn" href="https://www.tiktok.com/@gladmomentspl" target="_blank" rel="noopener">
                <span>🎵 TikTok</span>
            </a>
            <a class="gm-social-btn" href="https://wa.me/6287788991305?text=Halo%20Glad%20Moments%2C%20saya%20ingin%20membooking%20photobooth" target="_blank" rel="noopener">
                <span>💬 WhatsApp Business</span>
            </a>
        </div>
    </header>

    <!-- Packages Section -->
    <section class="gm-section">
        
        <!-- 1. Classic Photobooth -->
        <div class="gm-pkg-block" id="classic">
            <div class="gm-pkg-grid">
                <div class="gm-pkg-details">
                    <h3>Classic Photobooth</h3>
                    <div class="gm-pkg-price-list">
                        <div class="gm-pkg-price-row"><span>Sewa 1 Jam</span> <strong>Rp 1.500.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Sewa 3 Jam</span> <strong>Rp 2.600.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Extend per Jam</span> <span>Rp 600.000</span></div>
                    </div>
                    <p class="gm-pkg-desc">Layanan photobooth klasik yang cocok untuk segala jenis pesta dan perayaan. Pilihan latar belakang yang bervariasi dengan mesin selfie interaktif yang mudah dioperasikan.</p>
                    
                    <div class="gm-pkg-btn-group">
                        <a class="gm-btn-solid" href="{{ route('booking.index', ['type' => 'photobooth']) }}">Book Now</a>
                        <a class="gm-btn-outline" href="https://wa.me/6287788991305?text=Halo%20saya%20tertarik%20dengan%20Classic%20Photobooth" target="_blank" rel="noopener">WhatsApp</a>
                    </div>
                </div>

                <div class="gm-pkg-checklist-wrapper">
                    <h4>What you get:</h4>
                    <ul class="gm-pkg-checklist">
                        <li>Unlimited photo + cetak instan</li>
                        <li>Mesin selfie modern (photobooth selfie machine)</li>
                        <li>File format GIF beresolusi tinggi</li>
                        <li>Setup pencahayaan studio profesional</li>
                        <li>QR Code instan untuk unduh/share copy foto</li>
                        <li>Pilihan photostrip cover eksklusif</li>
                        <li>Backdrop kain standar gratis (opsional)</li>
                        <li>2 Crew berpengalaman standby</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2. Magazine Photobooth (4-sided) -->
        <div class="gm-pkg-block" id="magazine">
            <div class="gm-pkg-grid">
                <div class="gm-pkg-details">
                    <h3>Magazine Photobooth (4-Sided)</h3>
                    <div class="gm-pkg-price-list">
                        <div class="gm-pkg-price-row"><span>Sewa 1 Jam</span> <strong>Rp 2.000.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Sewa 3 Jam</span> <strong>Rp 3.000.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Extend per Jam</span> <span>Rp 600.000</span></div>
                    </div>
                    <p class="gm-pkg-desc">Sebuah booth photobooth ikonik dengan rancangan layout 3 dimensi layaknya model cover majalah 4-sisi. Memberikan sensasi megah dan eksklusif bagi setiap tamu yang hadir.</p>
                    
                    <div class="gm-pkg-btn-group">
                        <a class="gm-btn-solid" href="{{ route('booking.index', ['type' => 'photobooth']) }}">Book Now</a>
                        <a class="gm-btn-outline" href="https://wa.me/6287788991305?text=Halo%20saya%20tertarik%20dengan%20Magazine%20Photobooth%204-sided" target="_blank" rel="noopener">WhatsApp</a>
                    </div>

                    <div class="gm-pkg-tc">
                        <p><strong>T&amp;C:</strong> Teks kecil overlay bisa dipersonalisasi (Nama &amp; Tanggal Acara). Teks majalah besar "Wedding" permanen (custom teks besar dikenakan tambahan +300k). Branding "Glad in Booth" tidak dapat dihapus.</p>
                    </div>
                </div>

                <div class="gm-pkg-checklist-wrapper">
                    <h4>What you get:</h4>
                    <ul class="gm-pkg-checklist">
                        <li>Magazine-style layout (230 x 200 x 200 cm)</li>
                        <li>Kustom magazine overlay (Nama &amp; Tanggal)</li>
                        <li>Unlimited photo + cetak instan</li>
                        <li>Mesin selfie modern (photobooth selfie machine)</li>
                        <li>File format GIF + file video Boomerang</li>
                        <li>Setup pencahayaan studio profesional</li>
                        <li>QR Code instan untuk unduh/share copy foto</li>
                        <li>Paper frame majalah premium</li>
                        <li>Semua file foto mentah dikirim via flashdisk</li>
                        <li>Backdrop khusus gratis (opsional)</li>
                        <li>2 Crew berpengalaman standby</li>
                        <li>Gratis biaya transportasi untuk area Bandung</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 3. Magazine Photobooth Lite (1-sided) -->
        <div class="gm-pkg-block" id="lite">
            <div class="gm-pkg-grid">
                <div class="gm-pkg-details">
                    <h3>Magazine Photobooth Lite (1-Sided)</h3>
                    <div class="gm-pkg-price-list">
                        <div class="gm-pkg-price-row"><span>Sewa 1 Jam</span> <strong>Rp 1.650.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Sewa 3 Jam</span> <strong>Rp 2.700.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Extend per Jam</span> <span>Rp 600.000</span></div>
                    </div>
                    <p class="gm-pkg-desc">Versi minimalis dari Magazine Photobooth, menggunakan panel majalah satu sisi yang modern dan hemat ruang, namun tetap memberikan keanggunan layout cover majalah yang berkelas.</p>
                    
                    <div class="gm-pkg-btn-group">
                        <a class="gm-btn-solid" href="{{ route('booking.index', ['type' => 'photobooth']) }}">Book Now</a>
                        <a class="gm-btn-outline" href="https://wa.me/6287788991305?text=Halo%20saya%20tertarik%20dengan%20Magazine%20Photobooth%20Lite" target="_blank" rel="noopener">WhatsApp</a>
                    </div>

                    <div class="gm-pkg-tc">
                        <p><strong>T&amp;C:</strong> Teks kecil overlay bisa dipersonalisasi (Nama &amp; Tanggal Acara). Teks majalah besar "Vogue" permanen (custom teks besar dikenakan tambahan +300k). Branding "Glad in Booth" tidak dapat dihapus.</p>
                    </div>
                </div>

                <div class="gm-pkg-checklist-wrapper">
                    <h4>What you get:</h4>
                    <ul class="gm-pkg-checklist">
                        <li>Magazine-style one-sided layout (160 x 200 cm)</li>
                        <li>Kustom magazine overlay (Nama &amp; Tanggal)</li>
                        <li>Unlimited photo + cetak instan</li>
                        <li>Mesin selfie modern (photobooth selfie machine)</li>
                        <li>File format GIF + file video Boomerang</li>
                        <li>Setup pencahayaan studio profesional</li>
                        <li>QR Code instan untuk unduh/share copy foto</li>
                        <li>Paper frame majalah premium</li>
                        <li>Semua file foto mentah dikirim via flashdisk</li>
                        <li>Backdrop khusus gratis (opsional)</li>
                        <li>2 Crew berpengalaman standby</li>
                        <li>Gratis biaya transportasi untuk area Bandung</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 4. Magazine Booth-Only -->
        <div class="gm-pkg-block" id="booth-only">
            <div class="gm-pkg-grid">
                <div class="gm-pkg-details">
                    <h3>Magazine Booth-Only (Tanpa Mesin)</h3>
                    <div class="gm-pkg-price-list">
                        <div class="gm-pkg-price-row"><span>Panel 1-Sided (160x200cm)</span> <strong>Rp 1.000.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Panel 4-Sided (230x200cm)</span> <strong>Rp 1.800.000</strong></div>
                        <div class="gm-pkg-price-row"><span>Durasi Maksimal Sewa</span> <span>6 Jam</span></div>
                        <div class="gm-pkg-price-row"><span>Uang Deposit</span> <span>Rp 600.000</span></div>
                    </div>
                    <p class="gm-pkg-desc">Hanya menyewa instalasi fisik panel majalah estetik tanpa kelengkapan unit photobooth, kamera, pencetakan foto, maupun crew standby. Cocok untuk dijadikan instalasi dekoratif murni.</p>
                    
                    <div class="gm-pkg-btn-group">
                        <a class="gm-btn-solid" href="{{ route('booking.index', ['type' => 'photobooth']) }}">Book Now</a>
                        <a class="gm-btn-outline" href="https://wa.me/6287788991305?text=Halo%20saya%20tertarik%20dengan%20Magazine%20Booth%20Only" target="_blank" rel="noopener">WhatsApp</a>
                    </div>

                    <div class="gm-pkg-tc">
                        <p><strong>T&amp;C:</strong> Loading dilakukan H-1 atau pada Hari H. Pembongkaran maksimal pukul 23.00 di Hari H. <strong>Tidak ada crew standby</strong> (mohon kirimkan foto detail spot lokasi pemasangan sebelum pemasangan). Siapkan surat izin loading jika diperlukan oleh pihak venue. Konsumsi daya listrik: 100W. Dekorasi tambahan luar boleh ditempel selama tidak merusak dinding magazine (deposit hangus jika ada kerusakan). Magazine yang sudah terpasang tidak dapat dipindahkan.</p>
                    </div>
                </div>

                <div class="gm-pkg-checklist-wrapper">
                    <h4>What you get:</h4>
                    <ul class="gm-pkg-checklist">
                        <li>Fisik magazine-style layout panel pilihan</li>
                        <li>Kustom magazine overlay dengan nama/tanggal acara Anda</li>
                        <li>Instalasi kokoh &amp; presisi oleh tim logistik kami</li>
                        <li>Kesempatan dekorasi mandiri berlisensi</li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="text-align:center; margin: 4rem 0 2rem;">
            <a class="gm-btn-solid" style="padding: 1.1rem 3rem; font-size: 0.9rem;" href="{{ route('booking.index', ['type' => 'bundle']) }}">Lihat Promo Paket Bundling (+ Audio Guestbook)</a>
        </div>
    </section>

    <!-- Terms & Conditions Section -->
    <section class="gm-section" id="rules" style="border-top: 1px solid rgba(26,26,26,0.08); padding-bottom: 8rem;">
        <div class="gm-section-header">
            <span class="gm-section-tag">Syarat &amp; Ketentuan</span>
            <h2 class="gm-section-title">Kebijakan Layanan <em>Photobooth</em></h2>
        </div>

        <div class="gm-terms-wrap">
            <!-- 1. Teknis Pemesanan -->
            <div class="gm-term-card">
                <h3>Teknis Pemesanan</h3>
                <ul class="gm-term-list">
                    <li>Booking tanggal resmi wajib disertai dengan pembayaran uang muka (DP) sebesar <strong>Rp 500.000</strong>.</li>
                    <li>Pelunasan pembayaran wajib diselesaikan maksimal <strong>H-5 sebelum acara</strong>.</li>
                    <li>Reschedule tanggal dapat dilakukan maksimal 1x dan harus diberitahukan minimal 2 minggu sebelumnya, dengan syarat ketersediaan slot masih ada.</li>
                    <li>DP hangus dan tidak dapat dikembalikan apabila pembatalan sepihak dilakukan oleh pihak pemesan.</li>
                    <li>Tiket masuk berbayar untuk area/lokasi khusus (seperti Ancol, Taman Safari, dll) ditanggung penuh oleh pihak pemesan.</li>
                    <li>Tamu dibebaskan untuk berfoto dan mencetak hasil foto sepuasnya selama jam sewa berlangsung (tidak berlaku cetak ganda).</li>
                    <li>Kehadiran crew kami hanya pada hari-H acara saja, tanpa survei lokasi maupun kehadiran technical meeting fisik sebelumnya.</li>
                    <li>Kondisi force majeure (mati lampu, hujan deras, arus listrik tidak memadai, dll) berada di luar tanggung jawab kami.</li>
                    <li>Pemesan berkewajiban memberikan kontak panitia/WO yang aktif dan dapat dihubungi di hari-H acara.</li>
                </ul>
            </div>

            <!-- 2. Venue Indoor -->
            <div class="gm-term-card">
                <h3>Untuk Venue Indoor</h3>
                <ul class="gm-term-list">
                    <li>Dibutuhkan alokasi ruang kosong minimal ukuran <strong>2.5m x 2.5m</strong> untuk area setup photobooth.</li>
                    <li>Client wajib menyediakan <strong>1 buah meja, 3 buah kursi</strong>, serta akses stopkontak listrik dekat lokasi setup (panjang kabel tim kami 10 meter).</li>
                    <li>2 orang crew kami akan standby dan memulai proses persiapan setup alat 1 jam sebelum sesi photobooth resmi dibuka.</li>
                    <li>Peralatan photobooth membutuhkan daya listrik minimal sebesar <strong>600 Watt</strong>.</li>
                    <li>Penyelenggara wajib memberikan waktu 10 menit sebelum sesi tutup bagi pengantin apabila ingin berfoto di photobooth.</li>
                    <li>Sesi photobooth akan diselesaikan tepat waktu sesuai paket sewa (antrean terakhir dilayani 5 menit sebelum jam tutup).</li>
                    <li>Instalasi alat yang telah terpasang tidak dapat dipindahkan kembali.</li>
                </ul>
            </div>

            <!-- 3. Venue Outdoor -->
            <div class="gm-term-card">
                <h3>Untuk Venue Outdoor</h3>
                <ul class="gm-term-list">
                    <li>Photobooth tidak diizinkan dipasang pada tempat/area yang terpapar sinar matahari langsung guna mencegah overheat pada sensor kamera dan printer.</li>
                    <li>Untuk acara di area terbuka penuh (full outdoor), client <strong>wajib menyediakan tenda pelindung kokoh</strong>.</li>
                    <li>Apabila terjadi hujan di area luar, pengoperasian photobooth dihentikan sementara demi keamanan kelistrikan, namun durasi sewa tetap dihitung berjalan.</li>
                    <li>Proses relokasi ke tempat alternatif di tengah acara tetap dihitung masuk ke dalam durasi sewa berjalan.</li>
                    <li>Backdrop berbahan kain sequin tidak disarankan untuk area luar ruangan karena rentan tertiup angin dan merusak estetika latar.</li>
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection

