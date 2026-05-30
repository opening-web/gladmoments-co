<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="photobooth">
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif

    <div class="form-section">
        <h2 class="form-section-title">Glad Moments — Booking Form (Photobooth)</h2>

        <div class="form-group">
            <label>Nama Pemesan *</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama di invoice" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="Untuk kirim file digital / invoice" required>
        </div>

        <div class="form-group">
            <label>Nama Event / Judul Acara *</label>
            <input type="text" name="event_title" value="{{ old('event_title') }}" placeholder="Feny & Fery atau Lyn's Goes To #17" required>
        </div>

        <div class="form-group">
            <label>Hashtag</label>
            <input type="text" name="hashtag" value="{{ old('hashtag') }}" placeholder="#HAppyWIthYou">
        </div>

        <div class="form-group">
            <label>Alamat Venue *</label>
            <textarea name="venue_maps" rows="2" placeholder="Sertakan link Google Maps agar lebih akurat" required>{{ old('venue_maps') }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Acara *</label>
                <input type="date" name="event_date" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label>Jam Mulai Acara *</label>
                <input type="time" name="event_start_time" value="{{ old('event_start_time') }}" required>
                <small class="field-hint">Jam acara dimulai</small>
            </div>
            <div class="form-group">
                <label>Jam Photobooth Beroperasi *</label>
                <input type="time" name="photobooth_start_time" value="{{ old('photobooth_start_time') }}" required>
                <small class="field-hint">Jam mulai photobooth</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Nama PIC Saat Acara *</label>
                <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Nama WO/keluarga" required>
            </div>
            <div class="form-group">
                <label>No HP PIC Saat Acara *</label>
                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="Contact WO/keluarga" inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
        </div>

        <div class="form-group">
            <label>Pilihan Paket *</label>
            <select name="package_choice" id="photoboothPackage" required>
                <option value="">— Pilih paket —</option>
                @foreach(array_keys($formConfig['photobooth_packages']) as $pkg)
                    @php $meta = $formConfig['photobooth_package_meta'][$pkg] ?? null; @endphp
                    <option value="{{ $pkg }}" @selected(old('package_choice') === $pkg)>
                        {{ $pkg }} — Rp {{ number_format($formConfig['photobooth_packages'][$pkg] ?? 0, 0, ',', '.') }}
                        @if(!empty($meta['has_discount']))
                            (Diskon {{ $meta['promo_percent'] }}%)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="photobooth-package-details mb-4">
            @foreach($formConfig['photobooth_package_details'] as $packageName => $details)
                <div class="photobooth-package-card card mb-3 {{ old('package_choice') === $packageName ? 'selected' : '' }}" data-package-name="{{ $packageName }}" style="cursor: pointer; border: 1px solid #ddd; border-radius: 12px;">
                    <div class="card-body p-3">
                        @php $meta = $formConfig['photobooth_package_meta'][$packageName] ?? null; @endphp
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-1" style="font-size: 1rem; font-weight: 700;">{{ $packageName }}</h5>
                                @if(!empty($meta['has_discount']))
                                    <small class="text-success" style="font-weight: 600;">Diskon {{ $meta['promo_percent'] }}% — Hemat Rp {{ number_format($meta['savings'], 0, ',', '.') }}</small>
                                @else
                                    <small class="text-muted">Harga paket</small>
                                @endif
                            </div>
                            <div class="text-end">
                                @if(!empty($meta['has_discount']))
                                    <div style="font-size:0.85rem; color:#8b8b8b; text-decoration: line-through;">Rp {{ number_format($meta['price'], 0, ',', '.') }}</div>
                                @endif
                                <div class="fw-semibold text-success" style="font-size: 1.05rem;">Rp {{ number_format($formConfig['photobooth_packages'][$packageName] ?? 0, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="package-detail-list" style="font-size: 0.92rem; color: #4d4b47;">
                            @if(is_array($details))
                                <ul class="mb-0" style="padding-left: 1.2rem;">
                                    @foreach($details as $detail)
                                        @if(trim($detail) !== '')
                                            <li>{{ $detail }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <p class="mb-0">{{ $details }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Template Frame</label>
            <input type="file" name="template_frame" accept="image/*,.pdf">
            <small class="field-hint">Bisa upload design sendiri atau screenshot design dari kami</small>
        </div>

        <div class="form-group">
            <label>Backdrop (opsional)</label>
            <input type="text" name="backdrop" value="{{ old('backdrop') }}" placeholder="Contoh: white, maroon, hijau emerald / bawaan dekor">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Kenal kami dari mana?</label>
                <select name="referral_source" id="referralPhotobooth">
                    <option value="">— Pilih —</option>
                    @foreach($formConfig['referral_sources'] as $src)
                        <option value="{{ $src }}" @selected(old('referral_source') === $src)>{{ $src }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="referralOtherWrap" style="{{ old('referral_source') === 'Lainnya' ? '' : 'display:none' }}">
                <label>Lainnya</label>
                <input type="text" name="referral_other" value="{{ old('referral_other') }}">
            </div>
        </div>
    </div>

    <div class="form-submit-bar">
        <p class="dp-note">Setelah submit, Anda akan diarahkan ke halaman pembayaran DP <strong>Rp {{ number_format($downPaymentAmount, 0, ',', '.') }}</strong> untuk lock tanggal.</p>
        <button type="submit" class="btn-primary btn-block">Submit &amp; Lanjut Bayar DP</button>
    </div>
</form>

<script>
    document.getElementById('referralPhotobooth')?.addEventListener('change', function() {
        document.getElementById('referralOtherWrap').style.display = this.value === 'Lainnya' ? '' : 'none';
    });

    document.addEventListener('DOMContentLoaded', function () {
        const photoSelect = document.querySelector('#photoboothPackage');
        const photoCards = document.querySelectorAll('.photobooth-package-card');

        if (!photoSelect || !photoCards.length) {
            return;
        }

        photoCards.forEach((card) => {
            card.addEventListener('click', function () {
                const name = this.dataset.packageName;
                photoSelect.value = name;
                photoCards.forEach((c) => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        function markSelectedPhotoCard() {
            const selectedValue = photoSelect.value;
            photoCards.forEach((card) => {
                card.classList.toggle('selected', card.dataset.packageName === selectedValue);
            });
        }

        photoSelect.addEventListener('change', markSelectedPhotoCard);
        markSelectedPhotoCard();
    });
</script>
