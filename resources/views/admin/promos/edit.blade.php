@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Edit Promo</h4>
    <form action="{{ route('admin.promos.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $promo->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Caption</label>
            <textarea name="caption" class="form-control" rows="3">{{ old('caption', $promo->caption) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">URL Promo</label>
            <input type="text" name="cta_url" class="form-control" value="{{ old('cta_url', $promo->cta_url) }}" placeholder="Contoh: /booking atau https://shopee.co.id/...">
        </div>
        <div class="mb-3">
            <label class="form-label">Teks Tombol</label>
            <input type="text" name="cta_text" class="form-control" value="{{ old('cta_text', $promo->cta_text) }}" placeholder="Lihat Promo">
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label class="form-label">Buka Target</label>
                <select name="cta_target" class="form-control">
                    <option value="_self" {{ old('cta_target', $promo->cta_target) === '_self' ? 'selected' : '' }}>Tab yang sama</option>
                    <option value="_blank" {{ old('cta_target', $promo->cta_target) === '_blank' ? 'selected' : '' }}>Tab baru</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Prioritas</label>
                <input type="number" name="priority" class="form-control" min="0" value="{{ old('priority', $promo->priority) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Baru (opsional)</label>
            <input type="file" name="image" class="form-control">
            @if($promo->image_url)
                <img src="{{ $promo->image_url }}" width="120" class="mt-2 rounded">
            @endif
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $promo->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
    </form>
</div>
@endsection
