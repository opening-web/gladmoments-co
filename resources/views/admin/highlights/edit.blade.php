@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Edit Highlight</h4>
    <form action="{{ route('admin.highlights.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="title" class="form-control" value="{{ old('title', $highlight->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category" class="form-control">
                <option value="" {{ old('category', $highlight->category) === '' ? 'selected' : '' }}>Pilih kategori</option>
                <option value="wedding" {{ old('category', $highlight->category) === 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="photobooth" {{ old('category', $highlight->category) === 'photobooth' ? 'selected' : '' }}>Photobooth</option>
                <option value="birthday" {{ old('category', $highlight->category) === 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="brand" {{ old('category', $highlight->category) === 'brand' ? 'selected' : '' }}>Brand</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Caption</label>
            <textarea name="caption" class="form-control" rows="3">{{ old('caption', $highlight->caption) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Baru (opsional)</label>
            <input type="file" name="image" class="form-control">
            @if($highlight->image_url)
                <img src="{{ $highlight->image_url }}" width="120" class="mt-2 rounded">
            @endif
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $highlight->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">
                Aktif
            </label>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
    </form>
</div>
@endsection

