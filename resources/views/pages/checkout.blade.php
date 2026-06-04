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
<style>
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
            radial-gradient(ellipse 50% 40% at 50% -10%, rgba(176, 141, 87, 0.08) 0%, transparent 60%),\n            radial-gradient(ellipse 40% 40% at 80% 80%, rgba(251, 45, 90, 0.04) 0%, transparent 50%);
        z-index: 1;
        pointer-events: none;
    }
    .co-container {
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 1.5rem 5rem;
    }
    .co-header {
        margin-bottom: 3rem;
    }
    .co-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #1A1206;
        margin-bottom: 0.5rem;
    }
    .co-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 2.5rem;
        align-items: start;
    }
    .co-card {
        background: var(--checkout-card-bg);
        border-radius: 16px;
        padding: 2.5rem;
        border: 1px solid rgba(176, 141, 87, 0.08);
        box-shadow: 0 10px 35px rgba(26, 18, 6, 0.02);
        margin-bottom: 2rem;
    }
    .co-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: #1A1206;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .co-bank-box {
        background: #FDFBF7;
        border: 1px dashed rgba(176, 141, 87, 0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .co-bank-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .co-bank-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--checkout-primary);
        letter-spacing: 0.05em;
    }
    .co-account-num {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1A1206;
        letter-spacing: 0.02em;
        margin-bottom: 0.25rem;
    }
    .co-account-holder {
        font-size: 0.9rem;
        color: var(--checkout-text-muted);
    }
    .co-copy-btn {
        background: transparent;
        border: 1px solid rgba(176, 141, 87, 0.4);
        color: var(--checkout-primary);
        padding: 0.4rem 1rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .co-copy-btn:hover {
        background: var(--checkout-primary);
        color: #fff;
    }
    .co-dropzone {
        border: 2px dashed rgba(176, 141, 87, 0.25);
        background: #FDFBF7;
        border-radius: 12px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }
    .co-dropzone:hover {
        border-color: var(--checkout-primary);
        background: rgba(176, 141, 87, 0.02);
    }
    .co-dropzone-icon {
        color: var(--checkout-primary);
        margin-bottom: 0.75rem;
    }
    .co-dropzone-text {
        font-size: 0.9rem;
        font-weight: 500;
        color: #1A1206;
    }
    .co-dropzone-hint {
        font-size: 0.8rem;
        color: var(--checkout-text-muted);
        margin-top: 0.25rem;
    }
    .co-file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }
    .co-file-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(37, 211, 102, 0.1);
        color: #128C7E;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 1rem;
    }
    .co-summary-aside {
        background: var(--checkout-card-bg);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(176, 141, 87, 0.08);
        box-shadow: 0 10px 35px rgba(26, 18, 6, 0.02);
        position: sticky;
        top: 7.5rem;
    }
    .co-summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: #1A1206;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(176, 141, 87, 0.1);
        margin-bottom: 1.25rem;
    }
    .co-summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }
    .co-summary-row.co-total {
        border-top: 1px solid rgba(176, 141, 87, 0.1);
        padding-top: 1rem;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
    }
    .co-summary-row.co-total span:last-child {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1A1206;
    }
    .co-btn-submit {
        width: 100%;
        background: var(--checkout-primary);
        color: #FFFFFF;
        border: none;
        padding: 0.9rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(176, 141, 87, 0.15);
    }
    .co-btn-submit:hover {
        background: var(--checkout-primary-hover);
    }
</style>
@endsection
@section('content')
<div class="co-body">
    <div class="co-bg-pattern"></div>
    <div class="co-container">
        <div class="co-header">
            <span style="font-size:0.8rem; font-weight:600; color:var(--checkout-primary); text-transform:uppercase; letter-spacing:0.05em;">Langkah Terakhir</span>
            <h1>Verifikasi &amp; Pembayaran DP</h1>
        </div>
        <div class="co-grid">
            <main>
                <div class="co-card">
                    <h2 class="co-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--checkout-primary);"><rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                        Rekening Pembayaran Resmi
                    </h2>
                    <p style="font-size:0.9rem; color:var(--checkout-text-muted); margin-bottom:1.5rem; line-height:1.5;">Silakan transfer pembayaran Down Payment (DP) ke rekening bank berwenang di bawah ini sebesar nominal yang tertera pada ikhtisar ringkasan.</p>
                    <div class="co-bank-box">
                        <div class="co-bank-header">
                            <span class="co-bank-name">BANK CENTRAL ASIA</span>
                            <button type="button" class="co-copy-btn" onclick="copyNumber()">Salin No. Rekening</button>
                        </div>
                        <div class="co-account-num" id="bankNumber">5271819201</div>
                        <div class="co-account-holder">a.n. Glad Moments &amp; Co</div>
                    </div>
                </div>
                <form action="{{ route('booking.pay', $booking) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="co-card">
                        <h2 class="co-card-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--checkout-primary);"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            Unggah Bukti Transfer
                        </h2>
                        <div class="co-dropzone">
                            <div class="co-dropzone-icon">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                            <span class="co-dropzone-text" id="dropzoneText">Pilih berkas struk atau screenshot bukti transfer</span>
                            <p class="co-dropzone-hint">Format yang didukung: JPG, PNG, PDF (Maks. 5MB)</p>
                            <input type="file" name="payment_proof" id="paymentProof" class="co-file-input" required onchange="handleFileSelected()">
                        </div>
                        <div class="co-file-badge" id="fileBadge" style="display: none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span id="fileName"></span>
                        </div>
                        @error('payment_proof')
                            <p style="color:var(--checkout-accent); font-size:0.85rem; margin-top:0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
            </main>
            <aside>
                <div class="co-summary-aside">
                    <h3 class="co-summary-title">Ringkasan Pesanan</h3>
                    <div class="co-summary-row">
                        <span style="color:var(--checkout-text-muted);">Nama Layanan</span>
                        <span style="font-weight:500;">{{ $booking->package->name ?? $booking->package_choice ?? 'Layanan' }}</span>
                    </div>
                    <div class="co-summary-row">
                        <span style="color:var(--checkout-text-muted);">Tanggal Acara</span>
                        <span style="font-weight:500;">{{ $booking->event_date?->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="co-summary-row">
                        <span style="color:var(--checkout-text-muted);">Waktu Operasional</span>
                        <span style="font-weight:500;">{{ $booking->event_time ?? '-' }}</span>
                    </div>
                    <div class="co-summary-row">
                        <span style="color:var(--checkout-text-muted);">Total Harga</span>
                        <span style="font-weight:500;">Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="co-summary-row co-total">
                        <span style="font-weight:500; color:#1A1206;">Wajib Bayar DP</span>
                        <span>Rp {{ number_format((float) $downPayment, 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" class="co-btn-submit">Selesaikan &amp; Konfirmasi</button>
                </div>
            </aside>
            </form>
        </div>
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
        }
    }
</script>
@endsection