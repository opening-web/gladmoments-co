<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="jotform-style checkout-form">
    @csrf
    <input type="hidden" name="booking_type" value="audio">

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
                    <option value="{{ $pkg }}" @selected(old('package_choice') === $pkg)>{{ $pkg }}</option>
                @endforeach
            </select>
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
</script>
