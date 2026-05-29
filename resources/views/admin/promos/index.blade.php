@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color:#1A1412;">Promo Management</h2>
            <p class="text-muted mb-0">Kelola promo popup yang muncul di halaman utama.</p>
        </div>
        <a href="{{ route('admin.promos.create') }}" class="btn btn-dark">Tambah Promo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 p-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Aktif</th>
                    <th>Prioritas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promos as $promo)
                    <tr>
                        <td>
                            @if($promo->image_url)
                                <img src="{{ $promo->image_url }}" width="100" class="rounded">
                            @endif
                        </td>
                        <td>
                            <strong>{{ $promo->title }}</strong>
                            @if($promo->cta_url)
                                <div class="text-muted" style="font-size:.85rem;">URL: {{ $promo->cta_url }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $promo->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>{{ $promo->priority }}</td>
                        <td>
                            <a href="{{ route('admin.promos.edit', $promo->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
