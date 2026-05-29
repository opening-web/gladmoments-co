@extends('layouts.app')

@section('styles')
<style>
    /* Checkout Specific Theme Variable Overrides */
    :root {
        --checkout-primary: #B08D57;
        --checkout-primary-hover: #8a6b3f;
        --checkout-accent: #FB2D5A;
        --checkout-bg: #FDFBF7;
        --checkout-card-bg: #FFFFFF;
        --checkout-text: #2A2A2A;
        --checkout-text-muted: #6C6C6C;
    }

    .co-body {
        background-color: var(--checkout-bg);
        color: var(--checkout-text);
        font-family: 'Poppins', sans-serif;
        position: relative;
        min-height: 100vh;
        padding-top: 8rem;
    }

    .co-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(ellipse 50% 40% at 50% -10%, rgba(176, 141, 87, 0.08) 0%, transparent 60%),
            radial-gradient(ellipse 40% 40% at 80% 80%, rgba(251, 45, 90, 0.04) 0%, transparent 50%);
        z-index: 0;
        pointer-events: none;
    }

    /* Minimalist Navbar for Checkout */
    nav {
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(176, 141, 87, 0.12) !important;
        padding: 1.1rem 4rem !important;
        position: fixed !important;
        top: 0; left: 0; right: 0;
        z-index: 1000;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    .nav-logo a {
        color: #1A1206 !important;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.3rem;
    }
    .nav-back a {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--checkout-primary) !important;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: color 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
    }
    .nav-back a:hover {
        color: var(--checkout-primary-hover) !important;
    }
    @media(max-width: 640px) {
        nav {
            padding: 1.1rem 1.5rem !important;
        }
        .nav-logo a {
            font-size: 1.1rem;
        }
        .nav-back a {
            font-size: 0.72rem;
        }
    }

    /* Page Header */
    .co-header {
        text-align: center;
        margin-bottom: 4rem;
        padding: 0 1.5rem;
        position: relative;
        z-index: 1;
    }
    .co-header span {
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--checkout-primary);
        font-weight: 600;
        margin-bottom: 0.6rem;
        display: block;
    }
    .co-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--checkout-text);
    }

    /* Grid Layout Split */
    .co-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 6rem;
        position: relative;
        z-index: 1;
    }
    @media(max-width: 960px) {
        .co-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
    }

    /* Left Payment Section */
    .co-main-flow {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Step Cards */
    .co-step-card {
        background: var(--checkout-card-bg);
        border-radius: 24px;
        border: 1px solid rgba(176, 141, 87, 0.12);
        padding: 3rem;
        box-shadow: 0 12px 40px rgba(176, 141, 87, 0.03);
        position: relative;
    }
    @media(max-width: 640px) {
        .co-step-card {
            padding: 2rem 1.5rem;
        }
    }
    .co-step-num {
        position: absolute;
        top: -16px;
        left: 32px;
        background: var(--checkout-primary);
        color: #FFFFFF;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 0.85rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(176, 141, 87, 0.3);
    }
    .co-step-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--checkout-text);
        margin-bottom: 1.25rem;
        font-weight: 600;
    }

    /* Bank Account Display Card */
    .co-bank-display {
        background: linear-gradient(135deg, #1A1206 0%, #2A1D0B 100%);
        border-radius: 20px;
        padding: 2rem;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(242, 178, 102, 0.15);
        box-shadow: 0 15px 30px rgba(26, 18, 6, 0.15);
        margin-bottom: 1.5rem;
    }
    .co-bank-display::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(176, 141, 87, 0.25) 0%, transparent 60%);
    }
    .co-bank-logo {
        font-size: 0.72rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--checkout-primary);
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    .co-bank-number-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .co-bank-number {
        font-family: 'Courier New', Courier, monospace;
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #FDFBF7;
    }
    @media(max-width: 480px) {
        .co-bank-number {
            font-size: 1.4rem;
        }
    }
    .co-copy-btn {
        background: rgba(176, 141, 87, 0.15);
        border: 1px solid rgba(176, 141, 87, 0.3);
        color: var(--checkout-primary);
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    .co-copy-btn:hover {
        background: var(--checkout-primary);
        color: #FFFFFF;
        border-color: var(--checkout-primary);
    }
    .co-bank-holder {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.7);
    }
    .co-bank-holder strong {
        color: #FFFFFF;
        display: block;
        font-size: 1.05rem;
        margin-top: 0.2rem;
    }

    /* Uploader Dropzone */
    .co-dropzone {
        border: 2px dashed rgba(176, 141, 87, 0.3);
        background: var(--checkout-bg);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    .co-dropzone:hover {
        border-color: var(--checkout-accent);
        background: rgba(251, 45, 90, 0.02);
    }
    .co-upload-icon {
        font-size: 3rem;
        color: var(--checkout-primary);
        line-height: 1;
        transition: transform 0.3s;
    }
    .co-dropzone:hover .co-upload-icon {
        transform: translateY(-4px);
        color: var(--checkout-accent);
    }
    .co-dropzone input {
        display: none;
    }
    .co-dropzone span {
        font-size: 0.9rem;
        color: var(--checkout-text);
        font-weight: 600;
    }
    .co-dropzone p {
        font-size: 0.78rem;
        color: var(--checkout-text-muted);
        margin: 0;
    }
    .co-filename-badge {
        display: none;
        background: rgba(176, 141, 87, 0.1);
        border: 1px solid rgba(176, 141, 87, 0.2);
        color: var(--checkout-primary);
        padding: 0.45rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        align-items: center;
        gap: 0.5rem;
        word-break: break-all;
    }

    .co-submit-btn {
        background: var(--checkout-accent);
        color: #FFFFFF;
        width: 100%;
        border: none;
        padding: 1.1rem;
        border-radius: 14px;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(251, 45, 90, 0.2);
    }
    .co-submit-btn:hover {
        background: #D61B44;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(251, 45, 90, 0.3);
    }

    /* Right Checkout Summary Sidebar */
    .co-sidebar {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    .co-summary-card {
        background: #FFFFFF;
        border-radius: 24px;
        border: 1px solid rgba(176, 141, 87, 0.12);
        padding: 2.5rem;
        box-shadow: 0 12px 40px rgba(176, 141, 87, 0.03);
    }
    .co-summary-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--checkout-text);
        margin-bottom: 1.8rem;
        border-bottom: 1px solid rgba(176, 141, 87, 0.15);
        padding-bottom: 0.75rem;
    }
    .co-summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.85rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        font-size: 0.9rem;
    }
    .co-summary-row:last-of-type {
        border-bottom: none;
    }
    .co-summary-label {
        color: var(--checkout-text-muted);
    }
    .co-summary-val {
        color: var(--checkout-text);
        font-weight: 600;
        text-align: right;
    }
    .co-summary-total-box {
        background: var(--checkout-bg);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid rgba(176, 141, 87, 0.08);
    }
    .co-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .co-total-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--checkout-text);
    }
    .co-total-val {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--checkout-accent);
    }
    .co-total-note {
        font-size: 0.78rem;
        color: var(--checkout-text-muted);
        text-align: center;
        margin-top: 0.85rem;
        line-height: 1.5;
    }

    /* Alert Styling */
    .co-alert {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-radius: 12px;
        padding: 1.25rem;
        color: #991B1B;
        font-size: 0.85rem;
        margin-bottom: 2rem;
    }
    .co-alert ul {
        margin: 0.5rem 0 0 1.2rem;
    }
</style>
@endsection

@section('navbar')
<nav id="navbar">
    <div class="nav-logo">
        <a href="{{ route('home') }}">Glad Moments & Co</a>
    </div>
    <div class="nav-back">
        <a href="{{ route('home') }}">
            ← Kembali ke Home
        </a>
    </div>
</nav>
@endsection

@section('content')
<div class="co-body">
    <div class="co-bg-pattern"></div>

    <header class="co-header">
        <span>Payment Gateway</span>
        <h1>Penyelesaian Booking</h1>
    </header>

    <div class="co-grid">
        <!-- Left Payment Flow -->
        <div class="co-main-flow">
            @if ($errors->any())
                <div class="co-alert">
                    <strong>Mohon koreksi data berikut:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step 1: Transfer -->
            <div class="co-step-card">
                <div class="co-step-num">1</div>
                <h3>Lakukan Transfer Uang Muka (DP)</h3>
                
                <div class="co-bank-display">
                    <div class="co-bank-logo">Corporate Virtual Card</div>
                    
                    <div class="co-bank-number-row">
                        <span class="co-bank-number" id="bankNumber">{{ $bank['account_number'] }}</span>
                        <button class="co-copy-btn" onclick="copyNumber()">Salin No. Rekening</button>
                    </div>

                    <div class="co-bank-holder">
                        Bank Penerima
                        <strong>{{ $bank['bank_name'] }}</strong>
                        <div style="margin-top:0.85rem;">Nama Pemilik Rekening</div>
                        <strong>a.n. {{ $bank['account_name'] }}</strong>
                    </div>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; background:rgba(176,141,87,0.06); padding:1rem 1.5rem; border-radius:12px; border:1px solid rgba(176,141,87,0.12);">
                    <span style="font-size:0.88rem; color:var(--checkout-text-muted); font-weight:500;">Nominal Transfer DP:</span>
                    <strong style="font-size:1.15rem; color:var(--checkout-accent); font-weight:700;">Rp {{ number_format($downPayment, 0, ',', '.') }}</strong>
                </div>
                <p style="font-size:0.78rem; color:var(--checkout-text-muted); text-align:center; margin-top:0.85rem; line-height:1.5;">
                    💡 Mohon cantumkan nama pemesan <strong>({{ $booking->customer_name }})</strong> pada kolom berita acara transfer.
                </p>
            </div>

            <!-- Step 2: Upload -->
            <div class="co-step-card">
                <div class="co-step-num">2</div>
                <h3>Unggah Bukti Transfer</h3>
                
                <form action="{{ route('booking.pay', $booking) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group" style="margin-bottom:1.5rem;">
                        <label class="co-dropzone" id="dropzone">
                            <input type="file" name="payment_proof" id="paymentProof" accept="image/*" required onchange="handleFileSelected()">
                            <div class="co-upload-icon">📤</div>
                            <span id="dropzoneText">Pilih File Bukti Pembayaran</span>
                            <p>Mendukung format JPG, JPEG, PNG hingga ukuran maksimal 5MB</p>
                            
                            <div class="co-filename-badge" id="fileBadge">
                                📄 <span id="fileName">Namafile.png</span>
                            </div>
                        </label>
                    </div>

                    <button type="submit" class="co-submit-btn">Kirim Bukti &amp; Selesaikan Booking</button>
                </form>
            </div>
        </div>

        <!-- Right Summary Sidebar -->
        <aside class="co-sidebar">
            <div class="co-summary-card">
                <h3>Ringkasan Booking</h3>
                
                <div class="co-summary-row">
                    <span class="co-summary-label">Nama Pemesan</span>
                    <span class="co-summary-val">{{ $booking->customer_name }}</span>
                </div>
                <div class="co-summary-row">
                    <span class="co-summary-label">Layanan</span>
                    <span class="co-summary-val" style="color:var(--checkout-primary); text-transform:uppercase;">
                        @if($booking->booking_type === 'photobooth') PhotoBooth Only
                        @elseif($booking->booking_type === 'audio') Audio Guestbook Only
                        @else Bundle @endif
                    </span>
                </div>
                @if($booking->package_choice)
                <div class="co-summary-row">
                    <span class="co-summary-label">Pilihan Paket</span>
                    <span class="co-summary-val">{{ $booking->package_choice }}</span>
                </div>
                @endif
                <div class="co-summary-row">
                    <span class="co-summary-label">Nama Acara</span>
                    <span class="co-summary-val">{{ $booking->event_name ?? '—' }}</span>
                </div>
                <div class="co-summary-row">
                    <span class="co-summary-label">Tanggal Acara</span>
                    <span class="co-summary-val">{{ $booking->event_date->translatedFormat('d F Y') }}</span>
                </div>
                <div class="co-summary-row">
                    <span class="co-summary-label">Waktu Acara</span>
                    <span class="co-summary-val">{{ $booking->event_time }}</span>
                </div>

                <div class="co-summary-total-box">
                    <div class="co-total-row">
                        <span class="co-total-label">Down Payment (DP)</span>
                        <span class="co-total-val">Rp {{ number_format($downPayment, 0, ',', '.') }}</span>
                    </div>
                    <div class="co-total-note">
                        Estimasi Total Investasi: Rp {{ number_format($booking->total_price, 0, ',', '.') }}<br>
                        Sisa pelunasan wajib dibayarkan maksimal H-5 acara.
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyNumber() {
        const text = document.getElementById('bankNumber').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.querySelector('.co-copy-btn');
            btn.innerText = 'Tersalin!';
            btn.style.background = '#25D366';
            btn.style.color = '#fff';
            btn.style.borderColor = '#25D366';
            setTimeout(() => {
                btn.innerText = 'Salin No. Rekening';
                btn.style.background = '';
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 2000);
        });
    }

    function handleFileSelected() {
        const fileInput = document.getElementById('paymentProof');
        const badge = document.getElementById('fileBadge');
        const nameSpan = document.getElementById('fileName');
        const textSpan = document.getElementById('dropzoneText');
        
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            nameSpan.innerText = file.name;
            badge.style.display = 'inline-flex';
            textSpan.innerText = 'Ganti File Pilihan';
        } else {
            badge.style.display = 'none';
            textSpan.innerText = 'Pilih File Bukti Pembayaran';
        }
    }
</script>
@endsection

