@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Tambah Footage Highlight Baru</h4>
    <form action="{{ route('admin.highlights.store') }}" method="POST" enctype="multipart/form-data">
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
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" id="image" class="form-control" required accept="image/*">
            <img id="imagePreview" src="" alt="Preview Gambar" class="mt-2 rounded d-none" width="120">
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">
                Aktif
            </label>
        </div>
        <button type="submit" class="btn btn-dark">Simpan</button>
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
                imagePreview.src = '';
                imagePreview.classList.add('d-none');
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

