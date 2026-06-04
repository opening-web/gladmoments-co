@extends('layouts.admin')

@section('title', $bookingForm->name)

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2">{{ $bookingForm->name }}</h1>
            <p class="text-muted">
                Type: <span class="badge bg-info">{{ ucfirst($bookingForm->form_type) }}</span>
                Status: <span class="badge {{ $bookingForm->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $bookingForm->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.booking-forms.edit', $bookingForm) }}" class="btn btn-warning">Edit Form</a>
            <a href="{{ route('admin.booking-forms.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Info -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">📝 Form Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $bookingForm->name }}</p>
                    <p><strong>Slug:</strong> <code>{{ $bookingForm->slug }}</code></p>
                    <p><strong>Type:</strong> {{ ucfirst($bookingForm->form_type) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Service:</strong> {{ $bookingForm->service?->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $bookingForm->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $bookingForm->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
            </div>
            @if ($bookingForm->description)
                <div class="mt-3">
                    <p><strong>Description:</strong></p>
                    <p class="text-muted">{{ $bookingForm->description }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Form Fields -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">📋 Form Fields ({{ $bookingForm->fields->count() }})</h5>
        </div>
        <div class="card-body">
            @if ($bookingForm->fields->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Field Name</th>
                                <th>Label</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingForm->fields as $field)
                                <tr>
                                    <td>{{ $field->order }}</td>
                                    <td><code>{{ $field->field_name }}</code></td>
                                    <td>{{ $field->field_label }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $field->field_type }}</span>
                                    </td>
                                    <td>
                                        @if ($field->required)
                                            <span class="badge bg-danger">Required</span>
                                        @else
                                            <span class="text-muted">Optional</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $field->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $field->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <strong>ℹ️ No fields configured yet.</strong> This form doesn't have any fields defined. Add fields to enable this booking form.
                </div>
            @endif
        </div>
    </div>

    <!-- Bookings using this form -->
    <div class="card mt-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">📦 Bookings using this form</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-0">
                This form has been used in {{ $bookingForm->bookings()->count() }} booking(s).
            </p>
            @if ($bookingForm->bookings()->count() > 0)
                <a href="{{ route('admin.bookings.index', ['booking_form_id' => $bookingForm->id]) }}" class="btn btn-sm btn-primary mt-3">
                    View Bookings
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
