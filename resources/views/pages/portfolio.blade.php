@extends('layouts.app')
@section('styles')
<style>
html, body {
    max-width: 100%;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
}
@media (max-width: 992px) {
    .co-grid, .si-hero-grid, .si-services-split, .detail-grid {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
    .si-hero-image-wrap {
        max-width: 400px;
        margin: 0 auto;
    }
    .co-body {
        padding-top: 6rem;
    }
}
@media (max-width: 768px) {
    nav {
        padding: 1rem 1.5rem !important;
    }
    .booking-type-tabs, .hero-btns {
        flex-direction: column;
        gap: 0.5rem;
        padding: 0 1rem;
    }
    .booking-tab, .btn-primary, .btn-outline {
        width: 100%;
        text-align: center;
        font-size: 0.9rem;
    }
    .co-card, .co-summary-aside, .si-service-section-card, .success-card {
        padding: 1.5rem !important;
    }
    .si-body {
        padding-top: 5rem;
    }
    .si-faq-trigger {
        padding: 1rem !important;
        font-size: 1rem;
    }
    .portfolio-filters {
        justify-content: center;
        gap: 0.5rem;
    }
    .filter-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
    }
    .bio-links {
        padding: 0 1rem;
    }
    .bio-link-card, .service-detail, .detail-list li {
        padding: 1rem !important;
    }
}
</style>
@endsection
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
                <button class="filter-btn" onclick="filterPortfolio(this,'birthday')">Birthday / Private Party</button>\n                <button class="filter-btn" onclick="filterPortfolio(this,'corporate')">Corporate Event</button>
            </div>
            <div class="portfolio-grid" id="portfolioGrid">
                @foreach($portfolios as $item)
                <article class="portfolio-item" data-cat="{{ Str::lower($item->category) }}">
                    <div class="portfolio-image-box">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                        @else
                            <div style="background:#e8dfd3;height:100%;width:100%;display:flex;align-items:center;justify-content:center;color:#8a6b3f;">No Image</div>
                        @endif
                        <span class="portfolio-tag-badge">{{ $item->category }}</span>
                    </div>
                    <h3 class="portfolio-title-text">{{ $item->title }}</h3>
                    <p class="portfolio-desc-text">{{ $item->description }}</p>
                    <a href="{{ $item->link_url ?? '#' }}" target="_blank" rel="noopener" class="btn-accent-outline" style="display:inline-block;padding:0.5rem 1rem;font-size:0.8rem;margin-top:auto;text-align:center;">Explore Setup</a>
                </article>
                @endforeach
            </div>
        </div>
        @endif
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
            item.style.display = category === 'all' || item.dataset.cat === category ? 'flex' : 'none';
        });
    }
</script>
@endsection