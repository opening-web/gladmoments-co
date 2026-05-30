<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Glad Moments & Co | Wedding, Photobooth & Events</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&amp;family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet"/>

    <style>
        /* Premium Custom Overrides for Home Page */
        :root {
            --primary-color: #F5F1EB;
            --secondary-color: #D6C7B2;
            --accent-color: #B08D57;
            --accent-hover: #8a6b3f;
            --dark-color: #1A1206;
            --text-color: #2A2A2A;
        }

        body {
            background-color: #FFFFFF;
            overflow-x: hidden;
        }

        /* Navbar transitions */
        nav {
            padding: 1.2rem 4rem;
            transition: all 0.4s ease;
        }
        nav.scrolled {
            background: rgba(255, 255, 255, 0.96) !important;
            box-shadow: 0 10px 30px rgba(176, 141, 87, 0.08) !important;
            border-bottom: 1px solid rgba(176, 141, 87, 0.08);
        }
        nav.scrolled .nav-logo {
            color: var(--text-color) !important;
        }
        nav.scrolled .nav-links a {
            color: var(--text-color) !important;
        }

        /* Hero design tweaks */
        .hero {
            background: linear-gradient(135deg, #120b03 0%, #241808 50%, #120b03 100%) !important;
        }
        .hero-tag {
            border-color: rgba(176, 141, 87, 0.3) !important;
            border-radius: 4px;
            font-weight: 500;
            background: rgba(176, 141, 87, 0.05);
        }

        /* Styled Premium Glassmorphic Service Cards */
        .services {
            position: relative;
            background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F5 100%);
            padding: 6rem 2rem !important;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 3rem;
            max-width: 1050px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        @media(max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
                max-width: 480px;
            }
        }
        .service-card {
            background: #FFFFFF !important;
            border: 1px solid rgba(176, 141, 87, 0.14) !important;
            border-radius: 30px !important;
            padding: 2rem !important;
            box-shadow: 0 15px 45px rgba(176, 141, 87, 0.02) !important;
            transition: all 0.45s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            text-decoration: none !important;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            text-align: left !important;
        }
        .service-card:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 30px 65px rgba(176, 141, 87, 0.12) !important;
            border-color: var(--accent-color) !important;
        }
        .service-card-img-wrap {
            position: relative;
            height: 220px;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.03);
        }
        .service-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .service-card:hover .service-card-img {
            transform: scale(1.1);
        }
        .service-card-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 18, 6, 0.45) 0%, transparent 60%);
            z-index: 1;
        }
        .service-card-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 2;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.1rem;
            text-transform: uppercase;
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .badge-gold {
            background: rgba(26, 18, 6, 0.8);
            border: 1px solid rgba(176, 141, 87, 0.35);
            color: #E2C99D;
        }
        .badge-rose {
            background: rgba(214, 27, 68, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #FFFFFF;
        }
        .service-card-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .service-card-cta {
            margin-top: auto;
            font-size: 0.82rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s;
        }
        .service-card-cta .arrow {
            transition: transform 0.3s;
        }
        .service-card:hover .service-card-cta {
            color: var(--accent-hover);
        }
        .service-card:hover .service-card-cta .arrow {
            transform: translateX(5px);
        }

        /* Portfolio cards */
        .portfolio-item {
            border-radius: 16px !important;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: transform 0.4s, box-shadow 0.4s;
        }
        .portfolio-item:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(176, 141, 87, 0.15);
        }
        .portfolio-item-img {
            transition: transform 0.5s ease;
        }
        .portfolio-item-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent 50%);
            opacity: 0;
            transition: opacity 0.35s;
            display: flex;
            align-items: flex-end;
            padding: 1.2rem;
        }
        .portfolio-item:hover .portfolio-item-overlay {
            opacity: 1;
        }
        .portfolio-item-label {
            margin: 0 0 0.5rem;
            font-size: 1rem;
            font-weight: 700;
        }
        .portfolio-item-desc {
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
            white-space: normal;
            word-break: break-word;
        }

        @media(max-width: 768px) {
            .portfolio-item-overlay {
                padding: 1rem;
            }
            .portfolio-item-desc {
                font-size: 0.88rem;
            }
        }

      /* ===== HIGHLIGHT SECTION - MODERN CARD LAYOUT ===== */
.highlight {
    position: relative;
    background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F5 100%);
    padding: 6rem 2rem 10rem !important;
}

.highlight-inner {
    max-width: 1200px;
    margin: 0 auto;
}

.highlight-header {
    text-align: center;
    margin-bottom: 3rem;
}
.highlight-header .section-sub {
    max-width: 760px;
    margin: 0.6rem auto 0;
    color: #6b6b6b;
    line-height: 1.8;
    font-size: 1rem;
}

.highlight-grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2.5rem;
    margin-bottom: 4rem;
}

/* Highlight Card */
.highlight-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    height: 380px;
    background: #FFFFFF;
    border: 1px solid rgba(176, 141, 87, 0.1);
    box-shadow: 0 10px 35px rgba(176, 141, 87, 0.05);
    transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s;
    cursor: pointer;
    opacity: 0;
    transform: translateY(12px);
    animation: highlightFade 560ms cubic-bezier(0.22, 0.9, 0.35, 1) forwards;
}

.highlight-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(176, 141, 87, 0.15);
    border-color: rgba(176, 141, 87, 0.25);
}

.highlight-card-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    transition: transform 0.6s ease, opacity 0.6s ease;
    z-index: 1;
}

.highlight-card:hover .highlight-card-image {
    transform: scale(1.08);
}

/* Fade-in animation for cards */
@keyframes highlightFade {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

.highlight-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(26, 18, 6, 0) 0%,
        rgba(26, 18, 6, 0.3) 50%,
        rgba(26, 18, 6, 0.95) 100%
    );
    z-index: 2;
    transition: background 0.4s ease;
}

.highlight-card:hover .highlight-card-overlay {
    background: linear-gradient(
        180deg,
        rgba(26, 18, 6, 0.1) 0%,
        rgba(26, 18, 6, 0.4) 50%,
        rgba(26, 18, 6, 0.98) 100%
    );
}

.highlight-card-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 2rem;
    z-index: 3;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    height: 100%;
    transform: translateY(20px);
    transition: transform 0.4s ease;
}

.highlight-card:hover .highlight-card-content {
    transform: translateY(0);
}

.highlight-card-cat {
    font-size: 0.65rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #D6C7B2;
    margin-bottom: 0.5rem;
    display: block;
    font-weight: 700;
    opacity: 0.9;
}

.highlight-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0 0 0.5rem 0;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.highlight-card:hover .highlight-card-title {
    color: #FFF9F0;
}

.highlight-card-desc {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.5;
    margin: 0;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.highlight-card:hover .highlight-card-desc {
    opacity: 1;
}

/* Highlight slider card layout for laptop screens */
.highlight-hero {
    display: grid;
    grid-template-columns: minmax(320px, 1fr) minmax(320px, 380px);
    align-items: center;
    gap: 2rem;
    padding: 1.5rem 0;
}

.highlight-slider {
    position: relative;
    width: 100%;
    max-width: 520px;
    min-height: 520px;
    border-radius: 36px;
    overflow: hidden;
    background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.12), transparent 24%), linear-gradient(180deg, rgba(14, 10, 4, 0.08), rgba(11, 7, 4, 0.62));
    border: 1px solid rgba(255, 255, 255, 0.16);
    box-shadow: 0 35px 90px rgba(0, 0, 0, 0.18);
}

.highlight-slider::before {
    content: 'Glad Moments & Co';
    position: absolute;
    top: 48%;
    left: 12%;
    transform: translate(-10%, -50%);
    font-family: 'Playfair Display', serif;
    font-size: clamp(4.5rem, 6vw, 7rem);
    color: rgba(255, 255, 255, 0.08);
    letter-spacing: 0.38em;
    text-transform: uppercase;
    pointer-events: none;
    z-index: 0;
}

.highlight-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.9s ease, visibility 0.9s ease;
}

.highlight-slide.active {
    opacity: 1;
    visibility: visible;
}

.highlight-slide::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(12, 9, 5, 0.12), rgba(7, 4, 2, 0.7));
    z-index: 1;
}

.highlight-slide-inner {
    position: relative;
    z-index: 2;
    height: 100%;
    display: grid;
    place-items: center;
    padding: 2rem 1.5rem;
}

.highlight-slide-frame {
    width: 100%;
    max-width: 430px;
    aspect-ratio: 1 / 1;
    padding: 1.5rem;
    border-radius: 34px;
    background: rgba(255, 255, 255, 0.98);
    border: 1px solid rgba(176, 141, 87, 0.16);
    box-shadow: 0 35px 70px rgba(0, 0, 0, 0.12);
    display: grid;
    place-items: center;
}

.highlight-slide-photo {
    width: 100%;
    height: 100%;
    border-radius: 28px;
    background-size: cover;
    background-position: center;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.14);
}

.highlight-slide-photo-caption {
    margin: 1rem 0 0;
    color: #5B5B5B;
    font-size: 0.95rem;
    line-height: 1.75;
    text-align: center;
    max-width: 420px;
}

.highlight-aside {
    position: relative;
    display: grid;
    gap: 1rem;
    padding: 2rem 1.75rem;
    background: rgba(255, 255, 255, 0.92);
    border: 1px solid rgba(176, 141, 87, 0.12);
    border-radius: 32px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(20px);
}

.highlight-aside::before {
    content: 'Glad';
    position: absolute;
    top: 12px;
    right: 14px;
    font-family: 'Playfair Display', serif;
    font-size: 4.5rem;
    color: rgba(176, 141, 87, 0.08);
    letter-spacing: 0.22em;
    text-transform: uppercase;
    z-index: 0;
}

.highlight-aside-tag {
    font-size: 0.75rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: #B08D57;
    font-weight: 700;
    z-index: 1;
}

.highlight-aside-brand {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.7rem, 4vw, 4.4rem);
    line-height: 0.95;
    color: #1A1206;
    letter-spacing: 0.04em;
    margin: 0;
    z-index: 1;
}

.highlight-aside-title {
    font-size: 1.05rem;
    color: #4F4F4F;
    line-height: 1.75;
    margin: 0;
    z-index: 1;
}

.highlight-aside-text {
    margin: 0;
    color: #5B5B5B;
    font-size: 0.98rem;
    line-height: 1.8;
    z-index: 1;
}

.highlight-aside-features {
    list-style: none;
    margin: 0;
    padding: 0;
    display: grid;
    gap: 0.75rem;
    z-index: 1;
}

.highlight-aside-features li {
    position: relative;
    padding-left: 1.7rem;
    color: #5B5B5B;
    font-size: 0.95rem;
    line-height: 1.75;
}

.highlight-aside-features li::before {
    content: '—';
    position: absolute;
    left: 0;
    top: 0;
    color: #B08D57;
    font-size: 1rem;
}

.highlight-pager {
    margin-top: 1.5rem;
}

@media(max-width: 1024px) {
    .highlight-hero {
        grid-template-columns: 1fr;
    }

    .highlight-slider {
        max-width: 100%;
        min-height: 480px;
    }
}

@media(max-width: 768px) {
    .highlight-slider {
        min-height: 420px;
    }

    .highlight-slide-inner {
        padding: 1rem;
    }

    .highlight-slide-frame {
        max-width: 100%;
        padding: 1rem;
    }

    .highlight-aside {
        padding: 1.5rem 1rem;
    }

    .highlight-aside-brand {
        font-size: 2.5rem;
    }

    .highlight-aside::before {
        font-size: 3rem;
        right: 12px;
    }
}


@media(max-width: 1024px) {
    .highlight-slide-card {
        grid-template-columns: 1fr;
    }

    .highlight-slide-card-image {
        max-width: 420px;
        margin: 0 auto;
    }

    .highlight-slide-inner {
        padding: 2rem 1.5rem;
    }
}

@media(max-width: 768px) {
    .highlight-slider {
        min-height: auto;
    }

    .highlight-slide-inner {
        padding: 1.5rem 1rem;
    }

    .highlight-slide-card {
        padding: 1.5rem;
    }

    .highlight-slide-card-title {
        font-size: 2rem;
    }

    .highlight-slide-card-image {
        width: 100%;
    }

    .highlight-nav {
        width: 2.8rem;
        height: 2.8rem;
    }
}

/* Featured Section */
.highlight-featured-section {
    background: linear-gradient(135deg, rgba(176, 141, 87, 0.08) 0%, rgba(176, 141, 87, 0.03) 100%);
    border: 1px solid rgba(176, 141, 87, 0.12);
    border-radius: 32px;
    padding: 4rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    margin-top: 3rem;
}

.highlight-featured-image {
    position: relative;
    height: 420px;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(176, 141, 87, 0.15);
    border: 2px solid #FFFFFF;
    outline: 1px solid rgba(176, 141, 87, 0.2);
}

.highlight-featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}

.highlight-featured-image:hover img {
    transform: scale(1.05);
}

.highlight-featured-content h3 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 600;
    color: var(--dark-color);
    margin: 1rem 0;
    line-height: 1.3;
}

.highlight-featured-content p {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

@media(max-width: 1024px) {
    .highlight-featured-section {
        grid-template-columns: 1fr;
        gap: 3rem;
        padding: 3rem;
    }
    
    .highlight-featured-image {
        height: 350px;
    }
}

@media(max-width: 768px) {
    .highlight-grid-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .highlight-card {
        height: 320px;
    }
    
    .highlight-featured-section {
        padding: 2rem;
    }
    
    .highlight-featured-image {
        height: 280px;
    }
    
    .highlight-featured-content h3 {
        font-size: 1.6rem;
    }
}

        /* Testimonials standard viewport styling */
        .testimonials {
            background: var(--primary-color) !important;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem 2rem !important;
            box-sizing: border-box;
        }
        .testimonials-header {
            margin-bottom: 2rem !important;
        }
        .testi-slider {
            max-width: 800px;
            background: #FFFFFF;
            border: 1px solid rgba(176, 141, 87, 0.12);
            border-radius: 28px;
            padding: 2.5rem 3.5rem !important;
            box-shadow: 0 15px 40px rgba(176, 141, 87, 0.03);
            margin: 0 auto;
            width: 100%;
        }
        @media(max-width: 640px) {
            .testimonials {
                min-height: auto;
            }
            .testi-slider {
                padding: 2.2rem 1.8rem !important;
            }
        }

        /* Availability standard viewport styling */
        .avail-section {
            background: #FFFFFF !important;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem 2rem !important;
            box-sizing: border-box;
        }
        .avail-header {
            margin-bottom: 2.2rem !important;
        }
        .avail-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem !important;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }
        .calendar-wrap {
            background: #FFFFFF !important;
            border: 1px solid rgba(176, 141, 87, 0.12) !important;
            border-radius: 24px !important;
            padding: 1.5rem 2rem !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.01) !important;
            transition: all 0.3s;
        }
        .calendar-wrap:hover {
            box-shadow: 0 20px 40px rgba(176, 141, 87, 0.06) !important;
            border-color: rgba(176, 141, 87, 0.3) !important;
        }
        @media(max-width: 640px) {
            .avail-section {
                min-height: auto;
            }
            .avail-grid-container {
                grid-template-columns: 1fr;
            }
            .calendar-wrap {
                padding: 1.25rem 1rem !important;
            }
        }

        /* Footer brand layout */
        footer {
            background: #0F0D08 !important;
            border-top: 1px solid rgba(176, 141, 87, 0.15);
            padding: 4rem 4rem 2rem !important;
        }
        .footer-col h4 {
            color: var(--accent-color) !important;
            font-weight: 600;
        }
        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.5) !important;
            transition: color 0.3s;
        }
        .footer-col ul li a:hover {
            color: var(--accent-color) !important;
        }
        
        @media(max-width: 640px) {
            nav {
                padding: 1.2rem 1.5rem;
            }
            .portfolio-grid {
                columns: 1 !important;
            }
        }

        /* Premium Organic Wave Shape Dividers */
        .wave-divider {
            position: absolute;
            width: 100%;
            left: 0;
            line-height: 0;
            z-index: 5;
            pointer-events: none;
        }
        .wave-divider-top {
            top: -1px;
        }
        .wave-divider-bottom {
            bottom: -1px;
        }
        .wave-divider svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        /* Ensure sections have correct position relative for absolute dividers */
        .portfolio {
            position: relative !important;
            padding-bottom: 9rem !important; /* Extra bottom padding for the wave shape */
        }
        .testimonials {
            position: relative !important;
            padding-top: 7rem !important; /* Extra top padding for the wave shape */
            padding-bottom: 7rem !important; /* Extra bottom padding for the wave shape */
        }
        .avail-section {
            position: relative !important;
            padding-top: 7rem !important;
            padding-bottom: 7rem !important;
        }
        .cta-banner {
            position: relative !important;
            padding-top: 9rem !important; /* Extra top padding for the wave shape */
        }
    </style>
</head>
<body>
    <!-- Global Liquid Gradient Page Transition curtains -->
    <div class="page-transition-overlay-container">
        <div class="transition-curtain curtain-1"></div>
        <div class="transition-curtain curtain-2"></div>
    </div>

    <!-- Header Navigation -->
    <nav id="navbar">
        <div class="nav-logo">Glad Moments &amp; Co</div>
        <ul class="nav-links">
            <li><a href="#portfolio">Portofolio</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#availability">Availability</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a class="btn-nav" href="{{ route('booking.index') }}">Book Now</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-pattern"></div>
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-tag">Wedding · Photobooth · Events</div>
            <h1>Creating <em>Unforgettable</em><br/>Moments for Your<br/>Special Events</h1>
            <p>Kami hadir untuk mengabadikan setiap detail berharga dalam hidup Anda — dari senyum hangat hingga tawa yang meledak-ledak.</p>
            <div class="hero-btns">
                <a class="btn-primary" href="#portfolio">Explore Portfolio</a>
                <a class="btn-outline" href="{{ route('booking.index') }}">Book Now</a>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio" id="portfolio">
        <div class="portfolio-header">
            <span class="section-tag" style="color:var(--accent)">Our Work</span>
            <h2 class="section-title">Portfolio</h2>
            <p class="section-sub">Koleksi karya terbaik kami dari berbagai momen spesial.</p>
        </div>
        
        <div class="portfolio-filters">
            <button class="filter-btn active" onclick="filterPortfolio(this,'all')">Semua</button>
            <button class="filter-btn" onclick="filterPortfolio(this,'wedding')">Wedding</button>
            <button class="filter-btn" onclick="filterPortfolio(this,'photobooth')">Photobooth</button>
            <button class="filter-btn" onclick="filterPortfolio(this,'birthday')">Birthday</button>
            <button class="filter-btn" onclick="filterPortfolio(this,'brand')">Brand</button>
        </div>
        
        <div class="portfolio-grid" id="portfolioGrid">
            @foreach($portfolios ?? [] as $portfolio)
                <div class="portfolio-item" data-cat="{{ $portfolio->category ? \Illuminate\Support\Str::slug($portfolio->category) : 'uncategorized' }}">
                    <div class="portfolio-item-img ph-medium" style="background-image:url('{{ $portfolio->image_url }}');background-size:cover;background-position:center;"></div>
                    <div class="portfolio-item-overlay">
                        <div>
                            <span class="port-cat-badge">{{ $portfolio->category ?: 'Portfolio' }}</span>
                            <p class="portfolio-item-label">{{ $portfolio->title }}</p>
                            <p class="portfolio-item-desc">{{ $portfolio->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Wave 1: Portfolio (Dark) to Services (Light) -->
        <div class="wave-divider wave-divider-bottom" style="height: 60px;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" fill="#FFFFFF">
                <path d="M0,32 C320,120 720,0 1120,80 C1280,112 1380,64 1440,48 L1440,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="services-header section-center">
            <span class="section-tag">What We Offer</span>
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-sub">Dari momen intim hingga perayaan megah — kami menyentuh setiap detail dengan penuh kasih dan profesionalisme.</p>
        </div>
        <div class="services-grid">
            @foreach($services as $service)
                @if($service->slug !== 'bundle')
                    <a class="service-card service-card-link" href="{{ route('services.show', $service->slug) }}">
                        <div class="service-card-img-wrap">
                            @php
                                $defaultImage = $service->slug === 'gladtocall'
                                    ? 'https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?q=80&w=800&auto=format&fit=crop'
                                    : 'https://images.unsplash.com/photo-1531747118685-ca8fa6e08806?q=80&w=800&auto=format&fit=crop';
                                $imageUrl = $service->image_url ?? $defaultImage;
                            @endphp
                            <span class="service-card-badge {{ $service->slug === 'gladtocall' ? 'badge-gold' : 'badge-rose' }}">
                                {{ $service->badge_label ?? ($service->slug === 'gladtocall' ? 'Vintage Audio' : 'Premium Photobooth') }}
                            </span>
                            <div class="service-card-img-overlay"></div>
                            <img class="service-card-img" src="{{ $imageUrl }}" alt="{{ $service->name }}">
                        </div>
                        <div class="service-card-content">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                                <span style="font-size: 1.5rem;">{{ $service->icon ?? ($service->slug === 'gladtocall' ? '🎙️' : '📸') }}</span>
                                <h3 style="margin: 0; font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 600; color: var(--dark-color);">{{ $service->name }}</h3>
                            </div>
                            <p style="font-size: 0.9rem; color: #555; line-height: 1.7; margin-bottom: 1.5rem;">{{ $service->description }}</p>
                            <span class="service-card-cta">Lihat Selengkapnya <span class="arrow">→</span></span>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

                <div class="services-wave" style="position:absolute; bottom:-1px; left:0; width:100%; height:90px; overflow:hidden; pointer-events:none; z-index:0;">
                    <svg viewBox="0 0 1440 120" preserveAspectRatio="none" width="100%" height="100%" fill="#FAF8F5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,32 C240,96 480,96 720,64 C960,32 1200,16 1440,48 L1440,120 L0,120 Z"></path>
                    </svg>
                </div>
            </section>

          <!-- Highlight Section -->
        <section class="highlight" id="highlight">
    <div class="highlight-inner">
        <div class="highlight-header section-center">
            <span class="section-tag">Featured Event</span>
            <h2 class="section-title">Setiap Momen<br/>Layak Diabadikan</h2>
            <p class="section-sub">Kami percaya bahwa setiap cerita layak dipresentasikan dalam format yang anggun, berkelas, dan tak lekang waktu.</p>
        </div>

        @php
            $filteredHighlights = ($highlights ?? collect())->reject(function($h) {
                $cat = strtolower(trim($h->category ?? ''));
                return str_contains($cat, 'photobooth') || str_contains($cat, 'photoboothevent');
            })->values();
        @endphp

        @if($filteredHighlights->count())
            <div class="highlight-hero">
                <div class="highlight-slider" id="highlightSlider">
                    @foreach($filteredHighlights as $slide)
                        <div class="highlight-slide{{ $loop->first ? ' active' : '' }}">
                            <div class="highlight-slide-inner">
                                <div class="highlight-slide-frame">
                                    <div class="highlight-slide-photo" style="background-image: url('{{ $slide->image_url }}');"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button class="highlight-nav highlight-prev" type="button" aria-label="Sebelumnya">‹</button>
                    <button class="highlight-nav highlight-next" type="button" aria-label="Berikutnya">›</button>
                    <div class="highlight-pager" id="highlightPager">
                        @foreach($filteredHighlights as $slide)
                            <button class="highlight-dot{{ $loop->first ? ' active' : '' }}" type="button" data-index="{{ $loop->index }}"></button>
                        @endforeach
                    </div>
                </div>
                <div class="highlight-aside">
                    <span class="highlight-aside-tag">Signature Story</span>
                    <div class="highlight-aside-brand">Glad Moments &amp; Co</div>
                </div>
        @else
            <p class="section-sub" style="text-align:center;">Tidak ada highlight yang tersedia saat ini.</p>
        @endif

        <div class="wave-divider wave-divider-bottom" style="height: 90px;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" fill="var(--primary-color)">
                <path d="M0,48 C240,18 480,88 720,56 C960,24 1200,16 1440,56 L1440,120 L0,120 Z"></path>
            </svg>
        </div>
    </div>
</section>
    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="testimonials-header section-center">
            <span class="section-tag">Kata Mereka</span>
            <h2 class="section-title">Testimoni Klien</h2>
            <p class="section-sub">Kepercayaan klien adalah kebanggaan terbesar kami.</p>
        </div>
        
        <div class="testi-slider">
            @php $ts = ($testimonials ?? collect())->take(3); @endphp
            @foreach($ts as $i => $t)
                <div class="testi-card {{ $i === 0 ? 'active' : '' }}">
                    <div class="testi-quote">"</div>
                    <p class="testi-text">{{ $t->message }}</p>
                    <p class="testi-name">{{ $t->name }}</p>
                    <p class="testi-event">{{ $t->event }}</p>
                </div>
            @endforeach
            
            <div class="testi-dots" id="testiDots">
                @foreach($ts as $i => $t)
                    <button class="testi-dot {{ $i === 0 ? 'active' : '' }}" onclick="goTesti({{ $i }})"></button>
                @endforeach
            </div>
        </div>

        <!-- Wave 3: Testimonials (Cream) to Availability (White) -->
        <div class="wave-divider wave-divider-bottom" style="height: 60px;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" fill="#FFFFFF">
                <path d="M0,64 C288,120 576,16 864,80 C1152,144 1440,64 1440,64 L1440,120 L0,120 Z"></path>
            </svg>
        </div>
    </section>

    <!-- Availability Section -->
    <section class="avail-section" id="availability">
        <div class="avail-header section-center">
            <span class="section-tag">Schedule</span>
            <h2 class="section-title">Cek Ketersediaan</h2>
            <p class="section-sub">Pilih tanggal yang Anda inginkan dan pastikan jadwal kami tersedia untuk hari spesial Anda.</p>
        </div>
        
        <div class="avail-grid-container">
            <!-- Calendar for Glad to Call -->
            <div class="calendar-wrap">
                <h3 style="font-family:'Playfair Display',serif;font-weight:600;color:var(--accent-color);margin-bottom:1.5rem;font-size:1.25rem;">Glad to Call</h3>
                <div class="cal-header">
                    <button class="cal-nav" onclick="changeMonthService(-1, 'gladtocall')">←</button>
                    <div class="cal-month" id="calMonth-gladtocall">Juni 2025</div>
                    <button class="cal-nav" onclick="changeMonthService(1, 'gladtocall')">→</button>
                </div>
                <div class="cal-grid" id="calGrid-gladtocall"></div>
            </div>

            <!-- Calendar for Glad Moments -->
            <div class="calendar-wrap">
                <h3 style="font-family:'Playfair Display',serif;font-weight:600;color:var(--accent-color);margin-bottom:1.5rem;font-size:1.25rem;">Glad Moments</h3>
                <div class="cal-header">
                    <button class="cal-nav" onclick="changeMonthService(-1, 'gladmoments')">←</button>
                    <div class="cal-month" id="calMonth-gladmoments">Juni 2025</div>
                    <button class="cal-nav" onclick="changeMonthService(1, 'gladmoments')">→</button>
                </div>
                <div class="cal-grid" id="calGrid-gladmoments"></div>
            </div>
        </div>

        <div class="cal-legend" style="margin-top:2rem;">
            <div class="leg-item"><div class="leg-dot available"></div> Tersedia</div>
            <div class="leg-item"><div class="leg-dot booked"></div> Sudah Dipesan</div>
            <div class="leg-item"><div class="leg-dot today-d"></div> Hari Ini</div>
        </div>
        <br/><br/>
        <a class="btn-primary" href="{{ route('booking.index') }}" style="margin:0 auto;display:inline-block">Pesan Tanggal Ini</a>
    </section>

    <!-- Booking CTA Banner -->
    <section class="cta-banner" id="booking">
        <!-- Wave 4: Availability (White) to Booking CTA (Dark) -->
        <div class="wave-divider wave-divider-top" style="height: 60px;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" fill="#FFFFFF">
                <path d="M0,0 L1440,0 L1440,48 C1200,96 960,16 720,80 C480,144 240,32 0,64 Z"></path>
            </svg>
        </div>

        <div class="cta-banner-content">
            <span class="section-tag" style="display:block;text-align:center">Ready?</span>
            <h2 class="section-title">Siap Membuat Event Anda<br/>Tak Terlupakan?</h2>
            <p>Jangan biarkan momen berharga berlalu begitu saja. Hubungi kami sekarang dan wujudkan event impian Anda bersama Glad Moments &amp; Co.</p>
            <a class="btn-primary" href="{{ route('booking.index') }}">Book Your Date</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-brand">
            <span class="nav-logo">Glad Moments &amp; Co</span>
            <p>Kami mengabadikan setiap momen spesial dengan sentuhan keanggunan dan profesionalisme terbaik.</p>
            <div class="footer-social"></div>
        </div>
        <div class="footer-col">
            <h4>Layanan</h4>
            <ul>
                <li><a href="{{ route('services.show', 'gladtocall') }}">Glad To Call</a></li>
                <li><a href="{{ route('services.show', 'gladmoments') }}">Glad Moments</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#services">Layanan</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#availability">Kalender</a></li>
                <li><a href="{{ route('booking.index') }}">Booking</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <ul>
                <li><a href="#">📍 Bandung, Jabodetabek</a></li>
                <li><a href="https://wa.me/6287788991305">💬 WhatsApp</a></li>
                <li><a href="mailto:gladtocall@gmail.com">✉️ Email Kami</a></li>
                <li><a href="https://www.instagram.com/glad_moments.id">📸 Instagram</a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Glad Moments &amp; Co. All rights reserved.</p>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a class="wa-float" href="https://wa.me/6287788991305" title="Chat WhatsApp">
        <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"></path>
            <path d="M11.999 2C6.479 2 2 6.479 2 12c0 1.924.524 3.724 1.433 5.274L2 22l4.883-1.408A9.95 9.95 0 0 0 12 22c5.52 0 10-4.479 10-10S17.52 2 11.999 2zm.001 18c-1.704 0-3.29-.483-4.634-1.316l-.327-.196-3.432.99.955-3.35-.22-.341A7.944 7.944 0 0 1 4 12c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z"></path>
        </svg>
    </a>

    @if(isset($popupPromo) && $popupPromo)
        <div id="promoPopup" class="promo-popup-overlay" data-booking-url="{{ $popupPromo->cta_url }}">
            <div class="promo-popup-card">
                <button id="promoPopupClose" class="promo-popup-close" type="button" aria-label="Tutup">×</button>
                <a class="promo-popup-link" href="{{ $popupPromo->cta_url }}">
                    <img class="promo-popup-image" src="{{ $popupPromo->image_url }}" alt="{{ $popupPromo->title }}">
                </a>
            </div>
        </div>
    @endif

    <script>
        window.bookedDates = @json($bookedCalendar ?? []);
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        function filterPortfolio(button, category) {
            document.querySelectorAll('.portfolio-filters .filter-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            document.querySelectorAll('#portfolioGrid .portfolio-item').forEach(item => {
                item.style.display = category === 'all' || item.dataset.cat === category ? '' : 'none';
            });
        }
    </script>
</body>
</html>
