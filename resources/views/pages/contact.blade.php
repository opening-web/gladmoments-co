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
<h1>Contact Page</h1>
@endsection