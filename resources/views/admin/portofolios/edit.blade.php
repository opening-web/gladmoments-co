@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Edit Portofolio</h4>
    <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category" class="form-control">
                <option value="" {{ old('category', $portfolio->category) === '' ? 'selected' : '' }}>Pilih kategori</option>
                <option value="wedding" {{ old('category', $portfolio->category) === 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="photobooth" {{ old('category', $portfolio->category) === 'photobooth' ? 'selected' : '' }}>Photobooth</option>
                <option value="birthday" {{ old('category', $portfolio->category) === 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="brand" {{ old('category', $portfolio->category) === 'brand' ? 'selected' : '' }}>Brand</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Baru (Biarkan kosong jika tidak diubah)</label>
            <input type="file" name="image" class="form-control">
            @if($portfolio->image_url)
                <img src="{{ $portfolio->image_url }}" width="100" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $portfolio->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
    </form>
</div>
@endsection