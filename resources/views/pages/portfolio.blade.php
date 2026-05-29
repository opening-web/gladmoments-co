@extends('layouts.app')

@section('content')
<section class="hero hero-compact">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <span class="section-tag">Portfolio</span>
        <h1>Glad Moments &amp; Glad to Call</h1>
        <p>Beberapa dokumentasi event dan setup Photobooth &amp; Audio Guestbook yang pernah kami kerjakan.</p>
    </div>
</section>

<section class="booking-section" style="background:var(--primary);">
    <div class="section-center" style="max-width:1100px;margin:0 auto;padding:0 1.5rem 4rem;">
        @if(isset($portfolios) && $portfolios->count())
        <div class="pricelist-block" style="margin-top:0;">
            <h2 class="pricelist-heading">Portfolio Terbaru</h2>
            <p class="section-sub" style="max-width:640px;margin:0 auto 2rem;">
                Data ini dikelola langsung dari dashboard admin.
            </p>
            <div class="portfolio-filters" style="margin-bottom:1.5rem;display:flex;flex-wrap:wrap;gap:0.75rem;">
                <button class="filter-btn active" onclick="filterPortfolio(this,'all')">Semua</button>
                <button class="filter-btn" onclick="filterPortfolio(this,'wedding')">Wedding</button>
                <button class="filter-btn" onclick="filterPortfolio(this,'photobooth')">Photobooth</button>
                <button class="filter-btn" onclick="filterPortfolio(this,'birthday')">Birthday</button>
                <button class="filter-btn" onclick="filterPortfolio(this,'brand')">Brand</button>
            </div>
            <div class="pricelist-grid" id="portfolioGrid">
                @foreach($portfolios as $item)
                <article class="pricelist-card portfolio-item" data-cat="{{ $item->category ? \Illuminate\Support\Str::slug($item->category) : 'uncategorized' }}">
                    <h3>{{ $item->title }}</h3>
                    @if($item->category)
                        <p style="font-size:0.9rem;color:#7b6e5e;margin:0.4rem 0 1rem;">{{ $item->category }}</p>
                    @endif
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:12px;margin:0.8rem 0 1rem;">
                    @endif
                    <p class="pricelist-note">{{ $item->description }}</p>
                </article>
                @endforeach
            </div>
        </div>
        @endif

        <div class="pricelist-block" style="margin-top:0;">
            <h2 class="pricelist-heading">Glad Moments — Photobooth</h2>
            <p class="section-sub" style="max-width:640px;margin:0 auto 2rem;">
                Dari classic photobooth hingga magazine-style, berikut beberapa contoh setup dan mood dari Glad Moments.
            </p>
            <div class="pricelist-grid">
                <article class="pricelist-card">
                    <h3>Classic Photobooth</h3>
                    <p class="pricelist-duration">Unlimited photo + print, lighting profesional, QR share</p>
                    <p class="pricelist-note">
                        Lihat detail paket lengkap di halaman layanan Glad Moments.
                    </p>
                    <a href="{{ route('services.show', 'gladmoments') }}" class="btn-accent-outline" style="margin-top:auto;text-align:center;">Lihat Layanan</a>
                </article>
                <article class="pricelist-card">
                    <h3>Magazine Photobooth</h3>
                    <p class="pricelist-duration">4-sided &amp; 1-sided layout, cocok untuk wedding &amp; corporate</p>
                    <p class="pricelist-note">
                        Setup magazine-style dengan custom overlay nama &amp; tanggal acara.
                    </p>
                    <a href="{{ route('services.show', 'gladmoments') }}" class="btn-accent-outline" style="margin-top:auto;text-align:center;">Lihat Pricelist</a>
                </article>
            </div>
        </div>

        <div class="pricelist-block">
            <h2 class="pricelist-heading">Glad to Call — Audio Guestbook</h2>
            <p class="section-sub" style="max-width:640px;margin:0 auto 2rem;">
                Telepon retro sebagai media audio guestbook, tamu meninggalkan pesan yang bisa diputar kembali setelah acara.
            </p>
            <div class="pricelist-grid">
                <article class="pricelist-card">
                    <h3>Wedding &amp; Intimate Event</h3>
                    <p class="pricelist-duration">Audio guestbook + retro telephone, 2 crew standby</p>
                    <p class="pricelist-note">
                        Cocok untuk wedding, lamaran, dan intimate celebration yang ingin menyimpan pesan suara tamu.
                    </p>
                    <a href="{{ route('services.show', 'gladtocall') }}" class="btn-accent-outline" style="margin-top:auto;text-align:center;">Lihat Layanan</a>
                </article>
                <article class="pricelist-card">
                    <h3>Hospitality &amp; Commercial Space</h3>
                    <p class="pricelist-duration">Retro Telephone Supply untuk hotel, café, dan venue</p>
                    <p class="pricelist-note">
                        Menambah experience di lobby, lounge, atau corner khusus dengan telepon vintage yang bisa digunakan pengunjung.
                    </p>
                    <a href="{{ route('services.show', 'gladtocall') }}" class="btn-accent-outline" style="margin-top:auto;text-align:center;">Explore Setup</a>
                </article>
            </div>
        </div>

        <div class="pricelist-block">
            <h2 class="pricelist-heading">Ingin lihat lebih banyak?</h2>
            <p class="section-sub" style="max-width:640px;margin:0 auto 2rem;">
                Dokumentasi terbaru dan behind the scene bisa dilihat di Instagram kami.
            </p>
            <div class="bio-links">
                <a class="bio-link-card" href="https://gladmomentspl.carrd.co/" target="_blank" rel="noopener">
                    <span class="bio-link-icon">📸</span>
                    <span>Glad Moments — Pricelist &amp; Portfolio</span>
                </a>
                <a class="bio-link-card" href="https://gladtocall.passio.eco/" target="_blank" rel="noopener">
                    <span class="bio-link-icon">🎙️</span>
                    <span>Glad to Call — Bio &amp; Links</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function filterPortfolio(button, category) {
        document.querySelectorAll('.portfolio-filters .filter-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        document.querySelectorAll('#portfolioGrid .portfolio-item').forEach(item => {
            item.style.display = category === 'all' || item.dataset.cat === category ? '' : 'none';
        });
    }
</script>
@endsection
