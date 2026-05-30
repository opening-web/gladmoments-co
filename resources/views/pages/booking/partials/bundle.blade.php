<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="bundle">
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif

    <div class="form-section">
        <h2 class="form-section-title">Booking Form — Bundle PhotoBooth + Audio Guestbook</h2>

        <div class="form-group">
            <label>Nama Pemesan *</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama di invoice" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="Untuk kirim digital file" required>
        </div>

        <div class="form-group">
            <label>Venue *</label>
            <textarea name="venue_maps" rows="2" placeholder="Copas Google maps link" required>{{ old('venue_maps') }}</textarea>
        </div>

        <div class="form-group">
            <label>Nama Event / Judul Acara *</label>
            <input type="text" name="event_title" value="{{ old('event_title') }}" placeholder="Rizky & Syifa, Nakeisya goes to 17, etc" required>
        </div>

        <div class="form-group">
            <label>Booking / Reservation Date *</label>
            <input type="date" name="event_date" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Jam Acara Dimulai *</label>
                <input type="time" name="event_start_time" value="{{ old('event_start_time') }}" required>
                <small class="field-hint">Untuk wedding: jam resepsi dimulai</small>
            </div>
            <div class="form-group">
                <label>Jam Photobooth Dibuka *</label>
                <input type="time" name="photobooth_start_time" value="{{ old('photobooth_start_time') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Pilihan Paket *</label>
            <select name="package_choice" id="bundlePackage" required>
                <option value="">— Pilih paket —</option>
                @foreach(array_keys($formConfig['bundle_packages']) as $pkg)
                    @php $meta = $formConfig['bundle_package_meta'][$pkg] ?? null; @endphp
                    <option value="{{ $pkg }}" @selected(old('package_choice') === $pkg)>
                        {{ $pkg }} — Rp {{ number_format($formConfig['bundle_packages'][$pkg] ?? 0, 0, ',', '.') }}
                        @if(!empty($meta['has_discount']))
                            (Diskon {{ $meta['promo_percent'] }}%)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="bundle-package-details mb-4">
            @foreach($formConfig['bundle_package_details'] as $packageName => $details)
                <div class="bundle-package-card card mb-3 {{ old('package_choice') === $packageName ? 'selected' : '' }}" data-package-name="{{ $packageName }}" style="cursor: pointer; border: 1px solid #ddd; border-radius: 12px;">
                    <div class="card-body p-3">
                        @php $meta = $formConfig['bundle_package_meta'][$packageName] ?? null; @endphp
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
                                <div class="fw-semibold text-success" style="font-size: 1.05rem;">Rp {{ number_format($formConfig['bundle_packages'][$packageName] ?? 0, 0, ',', '.') }}</div>
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

        <div class="form-row">
            <div class="form-group">
                <label>Tone Warna Foto *</label>
                <select name="photo_tone" required>
                    <option value="">— Pilih —</option>
                    <option value="BW" @selected(old('photo_tone') === 'BW')>BW</option>
                    <option value="Full color" @selected(old('photo_tone') === 'Full color')>Full color</option>
                    <option value="Sepia" @selected(old('photo_tone') === 'Sepia')>Sepia</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ukuran Print dan Frame *</label>
                <select name="print_size" required>
                    <option value="">— Pilih —</option>
                    <option value="4R - 1 foto" @selected(old('print_size') === '4R - 1 foto')>4R - 1 foto</option>
                    <option value="4R - 2 foto" @selected(old('print_size') === '4R - 2 foto')>4R - 2 foto</option>
                    <option value="2R - 2 foto" @selected(old('print_size') === '2R - 2 foto')>2R - 2 foto</option>
                    <option value="2R - 3 foto" @selected(old('print_size') === '2R - 3 foto')>2R - 3 foto</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Placement Foto di Guestbook *</label>
            <select name="guestbook_placement" required>
                <option value="">— Pilih —</option>
                @foreach($formConfig['guestbook_placement'] as $opt)
                    <option value="{{ $opt }}" @selected(old('guestbook_placement') === $opt)>{{ $opt }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Backdrop Photobooth *</label>
                <select name="backdrop" required>
                    <option value="">— Pilih —</option>
                    @foreach($formConfig['backdrop_options'] as $opt)
                        <option value="{{ $opt }}" @selected(old('backdrop') === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Taplak meja audio guesbook *</label>
                <select name="tablecloth" required>
                    <option value="">— Pilih —</option>
                    <option value="Putih" @selected(old('tablecloth') === 'Putih')>Putih</option>
                    <option value="Hitam" @selected(old('tablecloth') === 'Hitam')>Hitam</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Tema warna dekor acara *</label>
            <input type="text" name="decor_theme" value="{{ old('decor_theme') }}" required>
        </div>

        <div class="form-group">
            <label>Signage</label>
            <input type="file" name="signage" accept="image/*,.pdf">
            <small class="field-hint">SS dari template Canva boleh custom — <a href="https://canva.link/fuh1fphq69b82b6" target="_blank" rel="noopener">lihat template</a></small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Nama PIC Saat Acara *</label>
                <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Bisa keluarga/WO" required>
            </div>
            <div class="form-group">
                <label>No HP PIC Saat Acara *</label>
                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
        </div>
    </div>

    <div class="form-submit-bar">
        <p class="dp-note">Bundle PhotoBooth + Audio Guestbook · DP <strong>Rp {{ number_format($downPaymentAmount, 0, ',', '.') }}</strong> untuk lock tanggal.</p>
        <button type="submit" class="btn-primary btn-block">Submit &amp; Lanjut Bayar DP</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bundleSelect = document.querySelector('#bundlePackage');
        const bundleCards = document.querySelectorAll('.bundle-package-card');

        if (!bundleSelect || !bundleCards.length) {
            return;
        }

        bundleCards.forEach((card) => {
            card.addEventListener('click', function () {
                const name = this.dataset.packageName;
                bundleSelect.value = name;
                bundleCards.forEach((c) => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        function markSelectedCard() {
            const selectedValue = bundleSelect.value;
            bundleCards.forEach((card) => {
                card.classList.toggle('selected', card.dataset.packageName === selectedValue);
            });
        }

        bundleSelect.addEventListener('change', markSelectedCard);
        markSelectedCard();
    });
</script>
