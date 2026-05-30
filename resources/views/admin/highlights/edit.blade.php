@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Edit Footage Highlight</h4>
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
            <label class="form-label">Gambar Baru (opsional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <img id="imagePreview" src="{{ $highlight->image_url ?? '' }}" width="120" class="mt-2 rounded{{ $highlight->image_url ? '' : ' d-none' }}" alt="Preview Gambar">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');

        if (!imageInput || !imagePreview) {
            return;
        }

        imageInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) {
                if (!imagePreview.src) {
                    imagePreview.classList.add('d-none');
                }
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection

