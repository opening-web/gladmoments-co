@extends('layouts.admin')

@section('title', 'Edit ' . $bookingForm->name)

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2">Edit Booking Form</h1>
            <p class="text-muted">{{ $bookingForm->name }}</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.booking-forms.show', $bookingForm) }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validation errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.booking-forms.update', $bookingForm) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Form Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $bookingForm->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4">{{ old('description', $bookingForm->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                    {{ old('is_active', $bookingForm->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active / Visible
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">Uncheck this to hide the form from users</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.booking-forms.show', $bookingForm) }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                💾 Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <h5 class="card-title">ℹ️ Form Info</h5>
                    <p class="small text-muted mb-3">
                        This form is used for {{ $bookingForm->form_type }} bookings.
                    </p>
                    
                    <p><strong>Slug:</strong> <code class="small">{{ $bookingForm->slug }}</code></p>
                    <p><strong>Type:</strong> {{ ucfirst($bookingForm->form_type) }}</p>
                    
                    @if ($bookingForm->service)
                        <p><strong>Service:</strong> {{ $bookingForm->service->name }}</p>
                    @endif

                    <p><strong>Fields:</strong> {{ $bookingForm->fields->count() }} configured</p>

                    <hr>

                    <p class="small text-muted mb-0">
                        Created: {{ $bookingForm->created_at->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
