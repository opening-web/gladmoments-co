@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h4 class="mb-4">Edit Testimoni</h4>
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
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
            <label class="form-label">Nama Klien</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Event</label>
            <input type="text" name="event" class="form-control" value="{{ $testimonial->event }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan Testimoni</label>
            <textarea name="message" class="form-control" rows="3" required>{{ old('message', $testimonial->message) }}</textarea>
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">
                Aktif
            </label>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
    </form>
</div>
@endsection

