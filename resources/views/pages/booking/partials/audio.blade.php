<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="audio">
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif

    <div class="form-section">
        <h2 class="form-section-title">Glad to Call — Booking Form (Audio Guestbook)</h2>

        <div class="form-group">
            <label>Nama Penerima Audio *</label>
            <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>No HP Penerima Audio *</label>
                <input type="tel" name="recipient_phone" value="{{ old('recipient_phone') }}" inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
            <div class="form-group">
                <label>Email Penerima Audio *</label>
                <input type="email" name="customer_email" value="{{ old('customer_email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat Penerima Audio</label>
            <textarea name="recipient_address" rows="2" placeholder="Khusus paket Premium, untuk pengiriman keepsake/bluetooth speaker">{{ old('recipient_address') }}</textarea>
        </div>

        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Bisa dikosongkan jika sama dengan penerima audio">
        </div>

        <div class="form-group">
            <label>Nama Panggilan Mempelai / Judul Acara *</label>
            <input type="text" name="event_title" value="{{ old('event_title') }}" placeholder="Feny & Fery atau Lyn's Goes To #17" required>
        </div>

        <div class="form-group">
            <label>Alamat Venue *</label>
            <textarea name="venue_maps" rows="2" placeholder="Sertakan link Google Maps" required>{{ old('venue_maps') }}</textarea>
        </div>

        <div class="form-group">
            <label>Tanggal Acara *</label>
            <input type="date" name="event_date" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Waktu Acara / Resepsi (mulai) *</label>
                <input type="time" name="event_start_time" value="{{ old('event_start_time') }}" required>
            </div>
            <div class="form-group">
                <label>s/d (selesai) *</label>
                <input type="time" name="event_end_time" value="{{ old('event_end_time') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Pilihan Signage</label>
            <input type="file" name="signage" accept="image/*,.pdf">
            <small class="field-hint">Bisa menyusul via WA admin — template: <a href="https://bit.ly/gtcsign" target="_blank" rel="noopener">bit.ly/gtcsign</a></small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Nama Penanggung Jawab *</label>
                <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Keluarga / WO" required>
            </div>
            <div class="form-group">
                <label>No HP Penanggung Jawab *</label>
                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
        </div>

        <div class="form-group">
            <label>Pilihan Paket *</label>
            <select name="package_choice" id="audioPackage" required>
                <option value="">— Pilih paket —</option>
                @foreach(array_keys($formConfig['audio_packages']) as $pkg)
                    @php $meta = $formConfig['audio_package_meta'][$pkg] ?? null; @endphp
                    <option value="{{ $pkg }}" @selected(old('package_choice') === $pkg)>
                        {{ $pkg }} — Rp {{ number_format($formConfig['audio_packages'][$pkg] ?? 0, 0, ',', '.') }}
                        @if(!empty($meta['has_discount']))
                            (Diskon {{ $meta['promo_percent'] }}%)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="audio-package-details mb-4">
            @foreach($formConfig['audio_package_details'] as $packageName => $details)
                <div class="audio-package-card card mb-3 {{ old('package_choice') === $packageName ? 'selected' : '' }}" data-package-name="{{ $packageName }}" style="cursor: pointer; border: 1px solid #ddd; border-radius: 12px;">
                    <div class="card-body p-3">
                        @php $meta = $formConfig['audio_package_meta'][$packageName] ?? null; @endphp
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
                                <div class="fw-semibold text-success" style="font-size: 1.05rem;">Rp {{ number_format($formConfig['audio_packages'][$packageName] ?? 0, 0, ',', '.') }}</div>
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
            <label>Pilihan Taplak Meja *</label>
            <select name="tablecloth" required>
                <option value="">— Pilih —</option>
                @foreach($formConfig['tablecloth_options'] as $opt)
                    <option value="{{ $opt }}" @selected(old('tablecloth') === $opt)>{{ $opt }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group premium-fields" id="premiumFields">
            <label>Khusus Paket Premium — Tema warna dekor acara</label>
            <input type="text" name="decor_theme" value="{{ old('decor_theme') }}" placeholder="Contoh: full white, maroon">
        </div>

        <div class="form-group premium-fields">
            <label>Khusus Paket Premium — Pilihan speaker bluetooth</label>
            <select name="speaker_color">
                <option value="">— Pilih —</option>
                @foreach($formConfig['speaker_options'] as $opt)
                    <option value="{{ $opt }}" @selected(old('speaker_color') === $opt)>{{ $opt }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Kenal kami dari mana?</label>
                <select name="referral_source" id="referralAudio">
                    <option value="">— Pilih —</option>
                    @foreach($formConfig['referral_sources'] as $src)
                        <option value="{{ $src }}" @selected(old('referral_source') === $src)>{{ $src }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="referralAudioOther" style="{{ old('referral_source') === 'Lainnya' ? '' : 'display:none' }}">
                <label>Lainnya</label>
                <input type="text" name="referral_other" value="{{ old('referral_other') }}">
            </div>
        </div>
    </div>

    <div class="form-submit-bar">
        <p class="dp-note">Setelah submit, lanjut bayar DP <strong>Rp {{ number_format($downPaymentAmount, 0, ',', '.') }}</strong> untuk lock tanggal.</p>
        <button type="submit" class="btn-primary btn-block">Submit &amp; Lanjut Bayar DP</button>
    </div>
</form>

<script>
document.getElementById('referralAudio')?.addEventListener('change', function() {
    document.getElementById('referralAudioOther').style.display = this.value === 'Lainnya' ? '' : 'none';
});

(function () {
    const select = document.getElementById('audioPackage');
    const cards = document.querySelectorAll('.audio-package-card');

    function updateSelectedCard() {
        cards.forEach(card => {
            const name = card.dataset.packageName;
            const selected = select.value === name;
            card.classList.toggle('selected', selected);
            card.style.borderColor = selected ? '#1A1412' : '#ddd';
            card.style.backgroundColor = selected ? 'rgba(26,20,18,0.04)' : '#fff';
        });
    }

    cards.forEach(card => {
        card.addEventListener('click', function () {
            select.value = this.dataset.packageName;
            updateSelectedCard();
        });
    });

    if (select) {
        select.addEventListener('change', updateSelectedCard);
        updateSelectedCard();
    }
})();
</script>
