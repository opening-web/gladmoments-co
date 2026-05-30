@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #1A1412;">Edit Paket</h2>
        <p class="text-muted">Perbarui informasi detail paket Glad Moments & Co. di bawah ini.</p>
    </div>

    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Layanan Induk *</label>
                <select name="service_id" class="form-select" required>
                    <option value="">— Pilih Layanan —</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @selected(old('service_id', $package->service_id) == $service->id)>
                            {{ $service->name }} ({{ $service->slug }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Paket *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga Paket (Rp) *</label>
                <input type="number" name="price" id="packagePriceInput" class="form-control" value="{{ old('price', $package->price) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Promo Diskon (%)</label>
                <input type="number" name="promo_percent" id="promoPercentInput" class="form-control" value="{{ old('promo_percent', $package->promo_percent) }}" min="0" max="100" placeholder="Contoh: 10">
                <div class="form-text">Masukkan persentase diskon paket. Biarkan kosong jika tidak ada promo.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga Setelah Diskon</label>
                <input type="text" id="discountedPricePreview" class="form-control" disabled value="{{ $package->discounted_price ? 'Rp '.number_format($package->discounted_price, 0, ',', '.') : 'Rp '.number_format($package->price, 0, ',', '.') }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Paket *</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $package->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 8px;">Batal</a>
                <button type="submit" class="btn text-white px-4" style="background-color: #1A1412; border-radius: 8px;">Update Paket</button>
            </div>
        </form>
    </div>
</div>

<script>
    function formatPrice(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateDiscountPreview() {
        const priceInput = document.getElementById('packagePriceInput');
        const promoInput = document.getElementById('promoPercentInput');
        const previewInput = document.getElementById('discountedPricePreview');

        const price = parseFloat(priceInput.value) || 0;
        const percent = parseFloat(promoInput.value);
        if (price > 0 && !Number.isNaN(percent) && percent > 0) {
            const discount = Math.min(Math.max(percent, 0), 100);
            const discounted = price * (1 - discount / 100);
            previewInput.value = formatPrice(Math.round(discounted));
        } else if (price > 0) {
            previewInput.value = formatPrice(Math.round(price));
        } else {
            previewInput.value = 'Rp 0';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const priceInput = document.getElementById('packagePriceInput');
        const promoInput = document.getElementById('promoPercentInput');
        if (priceInput && promoInput) {
            priceInput.addEventListener('input', updateDiscountPreview);
            promoInput.addEventListener('input', updateDiscountPreview);
            updateDiscountPreview();
        }
    });
</script>
@endsection
