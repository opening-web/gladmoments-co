@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Tambah Testimoni Baru</h4>
    <form action="{{ route('admin.testimonials.store') }}" method="POST">
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
            <label class="form-label">Nama Klien</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Event (misal: Wedding · Bandung)</label>
            <input type="text" name="event" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan Testimoni</label>
            <textarea name="message" class="form-control" rows="3" required>{{ old('message') }}</textarea>
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
@endsection

