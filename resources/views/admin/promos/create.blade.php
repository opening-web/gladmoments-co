@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Tambah Promo Baru</h4>
    <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
            <label class="form-label">URL Promo</label>
            <input type="text" name="cta_url" class="form-control" value="{{ old('cta_url') }}" placeholder="Contoh: /booking atau https://shopee.co.id/..." required>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label class="form-label">Buka Target</label>
                <select name="cta_target" class="form-control">
                    <option value="_self" {{ old('cta_target') === '_self' ? 'selected' : '' }}>Tab yang sama</option>
                    <option value="_blank" {{ old('cta_target') === '_blank' ? 'selected' : '' }}>Tab baru</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Prioritas</label>
                <input type="number" name="priority" class="form-control" min="0" value="{{ old('priority', 0) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>
        <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
</div>
@endsection
