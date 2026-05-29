@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Tambah Portofolio Baru</h4>
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category" class="form-control">
                <option value="" {{ old('category') === '' ? 'selected' : '' }}>Pilih kategori</option>
                <option value="wedding" {{ old('category') === 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="photobooth" {{ old('category') === 'photobooth' ? 'selected' : '' }}>Photobooth</option>
                <option value="birthday" {{ old('category') === 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="brand" {{ old('category') === 'brand' ? 'selected' : '' }}>Brand</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
</div>
@endsection