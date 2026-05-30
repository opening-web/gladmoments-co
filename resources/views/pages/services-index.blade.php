@extends('layouts.app')

@section('styles')
<style>
    :root {
        --si-rose: #FB2D5A;
        --si-rose-hover: #D61B44;
        --si-gold: #B08D57;
        --si-gold-hover: #8a6b3f;
        --si-dark: #1A1206;
        --si-bg: #FDFBF7;
        --si-card-bg: #FFFFFF;
    }

    html, body {
        max-width: 100%;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    .si-body {
        background-color: var(--si-bg);
        color: #2D2D2D;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
        width: 100%;
        box-sizing: border-box;
    }

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

    .si-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 8rem 1.5rem 6rem;
        position: relative;
        z-index: 1;
        width: 100%;
        box-sizing: border-box;
    }

    .si-hero-header {
        text-align: center;
        margin-bottom: 5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .si-tag {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--si-gold);
        background: rgba(176, 141, 87, 0.08);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        margin-bottom: 1.2rem;
    }

    .si-hero-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        color: var(--si-dark);
        line-height: 1.2;
        margin-bottom: 1.2rem;
        letter-spacing: -0.01em;
    }

    .si-hero-header p {
        font-size: 1.05rem;
        color: #6C6C6C;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .si-services-split {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 5rem;
        align-items: center;
        margin-bottom: 8rem;
        width: 100%;
        box-sizing: border-box;
    }

    .si-services-split.reverse {
        grid-template-columns: 0.9fr 1.1fr;
    }

    .si-services-split.reverse .si-service-info-block {
        grid-column: 2;
    }

    .si-services-split.reverse .si-hero-image-wrap {
        grid-column: 1;
        grid-row: 1;
    }

    .si-service-info-block {
        width: 100%;
        box-sizing: border-box;
    }

    .si-service-info-block .si-service-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--si-dark);
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .si-service-info-block .si-service-desc {
        font-size: 1rem;
        color: #555555;
        line-height: 1.7;
        margin-bottom: 2.2rem;
    }

    .si-feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 2.5rem 0;
        width: 100%;
        box-sizing: border-box;
    }

    .si-feature-list li {
        font-size: 0.95rem;
        color: #333333;
        margin-bottom: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .si-feature-list li svg {
        color: var(--si-rose);
        flex-shrink: 0;
    }

    .si-actions-group {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        width: 100%;
        box-sizing: border-box;
    }

    .si-btn-rose {
        background-color: var(--si-rose);
        color: #FFFFFF;
        padding: 0.85rem 2rem;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(251, 45, 90, 0.2);
        display: inline-block;
    }

    .si-btn-rose:hover {
        background-color: var(--si-rose-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251, 45, 90, 0.3);
    }

    .si-link-gold {
        color: var(--si-gold);
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: color 0.3s ease;
    }

    .si-link-gold:hover {
        color: var(--si-gold-hover);
    }

    .si-link-gold svg {
        transition: transform 0.3s ease;
    }

    .si-link-gold:hover svg {
        transform: translateX(4px);
    }

    .si-hero-image-wrap {
        position: relative;
        width: 100%;
        box-sizing: border-box;
    }

    .si-image-backdrop {
        position: absolute;
        inset: -15px;
        border: 1px solid rgba(176, 141, 87, 0.15);
        border-radius: 20px;
        z-index: 1;
        pointer-events: none;
    }

    .si-image-backdrop-filled {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #F4EFE6;
        border-radius: 16px;
        bottom: -20px;
        right: -20px;
        z-index: 0;
    }

    .si-showcase-img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        border-radius: 16px;
        position: relative;
        z-index: 2;
        box-shadow: 0 15px 35px rgba(26, 18, 6, 0.08);
    }

    .si-faq-section {
        max-width: 760px;
        margin: 6rem auto 2rem;
        border-top: 1px solid rgba(176, 141, 87, 0.15);
        padding-top: 5rem;
        width: 100%;
        box-sizing: border-box;
    }

    .si-faq-header {
        text-align: center;
        margin-bottom: 3.5rem;
    }

    .si-faq-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: var(--si-dark);
        margin-bottom: 0.8rem;
    }

    .si-faq-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .si-faq-item {
        background: var(--si-card-bg);
        border: 1px solid rgba(176, 141, 87, 0.08);
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(26, 18, 6, 0.01);
        overflow: hidden;
        transition: all 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .si-faq-trigger {
        width: 100%;
        background: none;
        border: none;
        padding: 1.4rem 2rem;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        outline: none;
        box-sizing: border-box;
    }

    .si-faq-trigger span {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--si-dark);
        transition: color 0.3s;
        padding-right: 1rem;
    }

    .si-faq-icon-box {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #FDFBF7;
        border: 1px solid rgba(176, 141, 87, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--si-gold);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .si-faq-icon-box svg {
        transition: transform 0.3s ease;
    }

    .si-faq-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        box-sizing: border-box;
    }

    .si-faq-inner {
        padding: 0 2rem 1.5rem 2rem;
        color: #555555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .si-faq-item.active {
        border-color: rgba(176, 141, 87, 0.25);
        box-shadow: 0 10px 25px rgba(176, 141, 87, 0.04);
    }

    .si-faq-item.active .si-faq-trigger span {
        color: var(--si-gold);
    }

    .si-faq-item.active .si-faq-icon-box {
        background: var(--si-gold);
        color: #FFFFFF;
        border-color: var(--si-gold);
    }

    .si-faq-item.active .si-faq-icon-box svg {
        transform: rotate(45deg);
    }

    .si-cta-section-card {
        background: var(--si-dark);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-top: 6rem;
        box-shadow: 0 20px 40px rgba(26, 18, 6, 0.12);
        width: 100%;
        box-sizing: border-box;
    }

    .si-cta-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 80% 20%, rgba(251, 45, 90, 0.08) 0%, transparent 50%);
    }

    .si-cta-section-card h2 {
        font-family: 'Playfair Display', serif;
        color: #FFFFFF;
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .si-cta-section-card p {
        color: #CBC5BA;
        font-size: 1.05rem;
        max-width: 520px;
        margin: 0 auto 2.5rem;
        position: relative;
        z-index: 1;
    }

    .si-btn-gold-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--si-gold);
        color: #FFFFFF;
        text-decoration: none;
        padding: 0.9rem 2.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(176, 141, 87, 0.3);
        position: relative;
        z-index: 1;
        box-sizing: border-box;
    }

    .si-btn-gold-cta:hover {
        background: var(--si-gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 22px rgba(176, 141, 87, 0.4);
    }

    @media (max-width: 992px) {
        .si-container {
            padding-top: 7rem;
        }
        .si-services-split {
            grid-template-columns: 1fr;
            gap: 3rem;
            margin-bottom: 6rem;
        }
        .si-services-split.reverse {
            grid-template-columns: 1fr;
        }
        .si-services-split.reverse .si-service-info-block {
            grid-column: 1;
        }
        .si-services-split.reverse .si-hero-image-wrap {
            grid-column: 1;
            grid-row: auto;
        }
        .si-showcase-img {
            height: 380px;
        }
        .si-image-backdrop-filled {
            bottom: -15px;
            right: -15px;
        }
        .si-services-split.reverse .si-image-backdrop-filled {
            left: -15px;
        }
    }

    @media (max-width: 768px) {
        .si-hero-header h1 {
            font-size: 2.2rem;
        }
        .si-service-info-block .si-service-title {
            font-size: 1.8rem;
        }
        .si-actions-group {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .si-btn-rose {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
        .si-faq-trigger {
            padding: 1.25rem 1.25rem;
        }
        .si-faq-inner {
            padding: 0 1.25rem 1.25rem 1.25rem;
        }
        .si-cta-section-card h2 {
            font-size: 1.8rem;
        }
        .si-btn-gold-cta {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="si-body">
    <div class="si-bg-pattern"></div>
    
    <section class="si-container">
        <header class="si-hero-header">
            <span class="si-tag">Our Services</span>
            <h1>Layanan Premium Kami</h1>
            <p>Sediakan pengalaman visual berkelas tinggi & perekaman memori autentik untuk momen paling bermakna dalam hidup Anda.</p>
        </header>

        <article class="si-services-split">
            <div class="si-service-info-block">
                <h2 class="si-service-title">PhotoBooth Premium Experience</h2>
                <p class="si-service-desc">
                    Hadirkan kemeriahan instan di acara pernikahan, pesta ulang tahun, maupun gathering perusahaan Anda. Dilengkapi dengan pencahayaan studio profesional, kamera DSLR resolusi tinggi, serta cetak foto super cepat dengan hasil premium yang tahan lama.
                </p>
                <ul class="si-feature-list">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Studio Lighting & Pilihan Backdrop Elegan
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Cetak Unlimited High-Glossy Card & Digital QR Download
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Fun & Exclusive Wedding Props/Aksesoris Lucu
                    </li>
                </ul>
                <div class="si-actions-group">
                    <a href="{{ route('booking.index', ['type' => 'photobooth']) }}" class="si-btn-rose">Pesan Sekarang</a>
                    @if(isset($services) && $services->where('slug', 'photobooth')->first())
                        <a href="{{ route('services.show', 'photobooth') }}" class="si-link-gold">
                            Detail Paket
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    @endif
                </div>
            </div>
            <div class="si-hero-image-wrap">
                <div class="si-image-backdrop"></div>
                <div class="si-image-backdrop-filled"></div>
                <img src="{{ asset('images/photobooth-service.jpg') }}" alt="PhotoBooth Premium Experience" class="si-showcase-img" onerror="this.src='https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop'">
            </div>
        </article>

        <article class="si-services-split reverse">
            <div class="si-service-info-block">
                <h2 class="si-service-title">Glad to Call — Audio Guestbook</h2>
                <p class="si-service-desc">
                    Tinggalkan buku tamu konvensional yang membosankan. Izinkan para tamu membisikkan doa, tawa, pesan haru, maupun ucapan selamat melalui telepon vintage estetik kami. Setiap rekaman suara disimpan utuh sebagai kapsul waktu berharga.
                </p>
                <ul class="si-feature-list">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Telepon Vintage Klasik Pilihan Aneka Warna
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Custom Audio Greeting (Pesan Sambutan dari Tuan Rumah)
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Penyerahan Seluruh File Audio (.wav) Pasca Event Selesai
                    </li>
                </ul>
                <div class="si-actions-group">
                    <a href="{{ route('booking.index', ['type' => 'audio']) }}" class="si-btn-rose">Pesan Sekarang</a>
                    @if(isset($services) && $services->where('slug', 'audio-guestbook')->first())
                        <a href="{{ route('services.show', 'audio-guestbook') }}" class="si-link-gold">
                            Detail Paket
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    @endif
                </div>
            </div>
            <div class="si-hero-image-wrap">
                <div class="si-image-backdrop"></div>
                <div class="si-image-backdrop-filled" style="background:#EBE7DF; left:-20px; right:auto;"></div>
                <img src="{{ asset('images/audio-service.jpg') }}" alt="Audio Guestbook Service" class="si-showcase-img" onerror="this.src='https://images.unsplash.com/photo-1520854221256-17451cc359df?q=80&w=600&auto=format&fit=crop'">
            </div>
        </article>

        <article class="si-services-split">
            <div class="si-service-info-block">
                <h2 class="si-service-title">Exclusive Bundle: Photo & Voice</h2>
                <p class="si-service-desc">
                    Pilihan terlengkap untuk dokumentasi memori yang sempurna. Gabungkan keseruan cetak visual instan PhotoBooth dengan keintiman pesan suara dari Audio Guestbook dalam satu penawaran eksklusif dengan harga yang jauh lebih hemat.
                </p>
                <ul class="si-feature-list">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Layanan Penuh PhotoBooth & Audio Guestbook Gabungan
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Dua Crew Standby Profesional Sepanjang Durasi Acara
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Bundling Harga Spesial Menarik & Prioritas Booking Utama
                    </li>
                </ul>
                <div class="si-actions-group">
                    <a href="{{ route('booking.index', ['type' => 'bundle']) }}" class="si-btn-rose">Ambil Paket Bundle</a>
                    @if(isset($services) && $services->where('slug', 'bundle')->first())
                        <a href="{{ route('services.show', 'bundle') }}" class="si-link-gold">
                            Detail Paket
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    @endif
                </div>
            </div>
            <div class="si-hero-image-wrap">
                <div class="si-image-backdrop"></div>
                <div class="si-image-backdrop-filled"></div>
                <img src="{{ asset('images/bundle-service.jpg') }}" alt="Exclusive Bundle Package" class="si-showcase-img" onerror="this.src='https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600&auto=format&fit=crop'">
            </div>
        </article>

        <div class="si-faq-section">
            <div class="si-faq-header">
                <h2>Pertanyaan Umum (FAQ)</h2>
                <p>Informasi mendasar seputar alur pemesanan dan eksekusi layanan kami di lapangan.</p>
            </div>
            <div class="si-faq-wrapper">
                <div class="si-faq-item">
                    <button type="button" class="si-faq-trigger">
                        <span>Kapan waktu paling lambat untuk memesan layanan?</span>
                        <div class="si-faq-icon-box">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                    </button>
                    <div class="si-faq-content">
                        <div class="si-faq-inner">
                            Kami menyarankan pemesanan dilakukan minimal 1 hingga 2 bulan sebelum tanggal acara untuk memastikan ketersediaan kuota slot tanggal dan kesiapan kustomisasi desain template foto/audio.
                        </div>
                    </div>
                </div>

                <div class="si-faq-item">
                    <button type="button" class="si-faq-trigger">
                        <span>Apakah harga tertera sudah termasuk biaya transportasi crew?</span>
                        <div class="si-faq-icon-box">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                    </button>
                    <div class="si-faq-content">
                        <div class="si-faq-inner">
                            Untuk area operasional utama kota, ongkos kirim dan transportasi crew sudah gratis/termasuk. Namun, untuk lokasi luar jangkauan wilayah kota utama, akan dikenakan biaya akomodasi tambahan yang disesuaikan secara transparan.
                        </div>
                    </div>
                </div>

                <div class="si-faq-item">
                    <button type="button" class="si-faq-trigger">
                        <span>Bagaimana cara saya menerima hasil rekaman Audio Guestbook?</span>
                        <div class="si-faq-icon-box">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                    </button>
                    <div class="si-faq-content">
                        <div class="si-faq-inner">
                            Semua kompilasi pesan rekaman suara tamu Anda akan kami bersihkan dari noise dasar secara digital, lalu dikirim dalam format Google Drive Link (.wav) paling lambat 3 hari kerja setelah perhelatan selesai.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="si-cta-section-card">
            <div class="si-cta-pattern"></div>
            <h2>Siap Mengabadikan Momen Berharga Anda?</h2>
            <p>Amankan tanggal kebahagiaan Anda hari ini dan bagikan keseruan tanpa batas bersama keluarga tercinta.</p>
            <a href="{{ route('booking.index') }}" class="si-btn-gold-cta">
                Mulai Reservasi Tanggal
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.si-faq-item');
        
        faqItems.forEach(item => {
            const trigger = item.querySelector('.si-faq-trigger');
            const content = item.querySelector('.si-faq-content');
            
            trigger.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.si-faq-content').style.maxHeight = null;
                    }
                });
                
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