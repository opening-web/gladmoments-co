<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="bundle">

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
