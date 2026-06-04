@extends('layouts.admin')

@section('title', 'Booking Forms')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2">📋 Booking Forms</h1>
            <p class="text-muted">Manage all booking form types</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">View Forms</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($forms as $form)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $form->name }}</h5>
                            <span class="badge {{ $form->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $form->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        <p class="text-muted small mb-2">
                            <strong>Type:</strong> 
                            <span class="badge bg-info">{{ ucfirst($form->form_type) }}</span>
                        </p>
                        
                        <p class="text-muted small mb-3">
                            <strong>Service:</strong> {{ $form->service?->name ?? 'N/A' }}
                        </p>

                        <p class="card-text text-muted small mb-3">
                            <strong>Fields:</strong> {{ $form->fields->count() }} field(s)
                        </p>

                        @if ($form->description)
                            <p class="card-text small text-muted mb-3">
                                {{ Str::limit($form->description, 100) }}
                            </p>
                        @endif

                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.booking-forms.show', $form) }}" class="btn btn-sm btn-primary">
                                View Details
                            </a>
                            <a href="{{ route('admin.booking-forms.edit', $form) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    📭 No booking forms found.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
