<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="digital_invitation">
    @if(isset($promo) && $promo)
        <input type="hidden" name="promo_id" value="{{ $promo->id }}">
    @endif

    <div class="form-section">
        <h2 class="form-section-title">Digital Invitation — Booking Form</h2>

        <!-- KONTAK PEMESAN -->
        <div style="background: #f9f7f4; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1206; margin-bottom: 15px;">📋 Kontak Pemesan</h3>
            
            <div class="form-group">
                <label>Nama Pemesan *</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama di invoice" required>
            </div>

            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="Untuk kirim file digital / invoice" required>
            </div>

            <div class="form-group">
                <label>No HP / WhatsApp *</label>
                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="0812345678" inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
        </div>

        <!-- DATA MEMPELAI WANITA -->
        <div style="background: #fff0f5; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #c41e3a; margin-bottom: 15px;">👰 Data Mempelai Wanita</h3>
            
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="bride_full_name" value="{{ old('bride_full_name') }}" placeholder="Nama lengkap mempelai wanita" required>
            </div>

            <div class="form-group">
                <label>Nama Panggilan *</label>
                <input type="text" name="bride_nickname" value="{{ old('bride_nickname') }}" placeholder="Nama panggilan / panggilan sayang" required>
            </div>

            <div class="form-group">
                <label>Nama Ayah Kandung *</label>
                <input type="text" name="bride_father_name" value="{{ old('bride_father_name') }}" placeholder="Nama ayah kandung" required>
            </div>

            <div class="form-group">
                <label>Nama Ibu Kandung *</label>
                <input type="text" name="bride_mother_name" value="{{ old('bride_mother_name') }}" placeholder="Nama ibu kandung" required>
            </div>

            <div class="form-group">
                <label>Anak ke *</label>
                <input type="number" name="bride_child_order" value="{{ old('bride_child_order') }}" placeholder="1, 2, 3, dst..." min="1" required>
            </div>

            <div class="form-group">
                <label>Foto Mempelai Wanita *</label>
                <input type="file" name="bride_photo" accept="image/*" required>
                <small class="field-hint">Format: JPG, PNG (Max. 5 MB)</small>
            </div>
        </div>

        <!-- DATA MEMPELAI PRIA -->
        <div style="background: #f0f8ff; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #003da5; margin-bottom: 15px;">🤵 Data Mempelai Pria</h3>
            
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="groom_full_name" value="{{ old('groom_full_name') }}" placeholder="Nama lengkap mempelai pria" required>
            </div>

            <div class="form-group">
                <label>Nama Panggilan *</label>
                <input type="text" name="groom_nickname" value="{{ old('groom_nickname') }}" placeholder="Nama panggilan / panggilan sayang" required>
            </div>

            <div class="form-group">
                <label>Nama Ayah Kandung *</label>
                <input type="text" name="groom_father_name" value="{{ old('groom_father_name') }}" placeholder="Nama ayah kandung" required>
            </div>

            <div class="form-group">
                <label>Nama Ibu Kandung *</label>
                <input type="text" name="groom_mother_name" value="{{ old('groom_mother_name') }}" placeholder="Nama ibu kandung" required>
            </div>

            <div class="form-group">
                <label>Anak ke *</label>
                <input type="number" name="groom_child_order" value="{{ old('groom_child_order') }}" placeholder="1, 2, 3, dst..." min="1" required>
            </div>

            <div class="form-group">
                <label>Foto Mempelai Pria *</label>
                <input type="file" name="groom_photo" accept="image/*" required>
                <small class="field-hint">Format: JPG, PNG (Max. 5 MB)</small>
            </div>
        </div>

        <!-- DATA ACARA -->
        <div style="background: #fffacd; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #8b7500; margin-bottom: 15px;">📅 Data Acara</h3>
            
            <div class="form-group">
                <label>Tanggal *</label>
                <input type="date" name="event_date" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Hari *</label>
                <select name="event_day" required>
                    <option value="">— Pilih Hari —</option>
                    <option value="Senin" @selected(old('event_day') === 'Senin')>Senin</option>
                    <option value="Selasa" @selected(old('event_day') === 'Selasa')>Selasa</option>
                    <option value="Rabu" @selected(old('event_day') === 'Rabu')>Rabu</option>
                    <option value="Kamis" @selected(old('event_day') === 'Kamis')>Kamis</option>
                    <option value="Jumat" @selected(old('event_day') === 'Jumat')>Jumat</option>
                    <option value="Sabtu" @selected(old('event_day') === 'Sabtu')>Sabtu</option>
                    <option value="Minggu" @selected(old('event_day') === 'Minggu')>Minggu</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Jam Mulai *</label>
                    <input type="time" name="event_start_time" value="{{ old('event_start_time') }}" required>
                </div>
                <div class="form-group">
                    <label>Jam Selesai *</label>
                    <input type="time" name="event_end_time" value="{{ old('event_end_time') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nama Tempat *</label>
                <input type="text" name="event_venue_name" value="{{ old('event_venue_name') }}" placeholder="Nama gedung / tempat acara" required>
            </div>

            <div class="form-group">
                <label>Alamat *</label>
                <textarea name="event_address" rows="3" placeholder="Alamat lengkap + Link Google Maps" required>{{ old('event_address') }}</textarea>
            </div>
        </div>

        <!-- LAINNYA (MEDIA & KONTEN) -->
        <div style="background: #f5f5f5; padding: 20px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1206; margin-bottom: 15px;">📸 Media & Konten</h3>
            
            <div class="form-group">
                <label>Foto Couple / Prewedding *</label>
                <input type="file" name="couple_photos[]" accept="image/*" multiple required>
                <small class="field-hint">Maksimal 14 foto. Format: JPG, PNG (Max. 5 MB per foto)</small>
            </div>

            <div class="form-group">
                <label>Quote / Ayat Pembuka *</label>
                <textarea name="opening_quote" rows="3" placeholder="Masukkan quote, ayat, atau kata-kata pembuka yang ingin ditampilkan di undangan digital" required>{{ old('opening_quote') }}</textarea>
            </div>
        </div>

        <!-- PILIHAN PAKET -->
        <div class="form-group">
            <label>Pilihan Paket *</label>
            <select name="package_choice" id="digitalInvitationPackage" required>
                <option value="">— Pilih paket —</option>
                @foreach(array_keys($formConfig['digital_invitation_packages']) as $pkg)
                    @php $meta = $formConfig['digital_invitation_package_meta'][$pkg] ?? null; @endphp
                    <option value="{{ $pkg }}" @selected(old('package_choice') === $pkg)>
                        {{ $pkg }} — Rp {{ number_format($formConfig['digital_invitation_packages'][$pkg] ?? 0, 0, ',', '.') }}
                        @if(!empty($meta['has_discount']))
                            (Diskon {{ $meta['promo_percent'] }}%)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PACKAGE DETAILS CARDS -->
        <div class="package-details mb-4">
            @foreach($formConfig['digital_invitation_package_details'] as $packageName => $details)
                <div class="package-card card mb-3 {{ old('package_choice') === $packageName ? 'selected' : '' }}" data-package-name="{{ $packageName }}" style="cursor: pointer; border: 1px solid #ddd; border-radius: 12px;">
                    <div class="card-body p-3">
                        @php $meta = $formConfig['digital_invitation_package_meta'][$packageName] ?? null; @endphp
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
                                <div style="font-size: 1.2rem; font-weight: 700; color: #1a1206;">Rp {{ number_format($meta['discounted_price'] ?? ($formConfig['digital_invitation_packages'][$packageName] ?? 0), 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <hr style="margin: 10px 0; border: none; border-top: 1px solid #e0e0e0;">
                        <ul style="margin: 0; padding-left: 20px; font-size: 0.9rem;">
                            @foreach($details as $detail)
                                <li style="margin: 5px 0;">{{ $detail }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CATATAN TAMBAHAN -->
        <div class="form-group">
            <label>Catatan / Permintaan Khusus</label>
            <textarea name="special_notes" rows="3" placeholder="Ada permintaan khusus atau catatan untuk design undangan digital?">{{ old('special_notes') }}</textarea>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; padding: 15px; font-size: 1.1rem; border-radius: 12px;">
                Lanjut ke Checkout →
            </button>
        </div>
    </div>
</form>

<style>
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .package-card {
        transition: all 0.3s ease;
        border-left: 4px solid #b08d57 !important;
    }

    .package-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .package-card.selected {
        background-color: #f9f7f4;
        border-left: 4px solid #1a1206 !important;
    }

    .field-hint {
        display: block;
        margin-top: 5px;
        color: #888;
        font-size: 0.85rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Package selection functionality
        const packageSelect = document.getElementById('digitalInvitationPackage');
        const cards = document.querySelectorAll('.package-card');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                const packageName = this.getAttribute('data-package-name');
                packageSelect.value = packageName;
                
                cards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        packageSelect.addEventListener('change', function() {
            cards.forEach(card => {
                if (card.getAttribute('data-package-name') === this.value) {
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });
        });

        // Auto-fill day based on selected date
        const eventDateInput = document.querySelector('input[name="event_date"]');
        const eventDaySelect = document.querySelector('select[name="event_day"]');

        if (eventDateInput && eventDaySelect) {
            // Mapping English day names to Indonesian
            const dayMapping = {
                'Monday': 'Senin',
                'Tuesday': 'Selasa',
                'Wednesday': 'Rabu',
                'Thursday': 'Kamis',
                'Friday': 'Jumat',
                'Saturday': 'Sabtu',
                'Sunday': 'Minggu'
            };

            // Function to update day based on date
            function updateDayFromDate() {
                if (eventDateInput.value) {
                    // Parse the date
                    const selectedDate = new Date(eventDateInput.value + 'T00:00:00');
                    
                    // Get the day name in English
                    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const englishDayName = dayNames[selectedDate.getDay()];
                    
                    // Convert to Indonesian
                    const indonesianDayName = dayMapping[englishDayName];
                    
                    // Set the select value
                    eventDaySelect.value = indonesianDayName;
                }
            }

            // Trigger on input change
            eventDateInput.addEventListener('change', updateDayFromDate);
            
            // Also trigger on input for real-time update
            eventDateInput.addEventListener('input', updateDayFromDate);

            // If there's already a date value on page load, update the day
            if (eventDateInput.value) {
                updateDayFromDate();
            }
        }
    });
</script>
