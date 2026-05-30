@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="color:#1A1412;">Footage Highlight</h2>
            <p class="text-muted mb-0">Kelola footage highlight yang tampil di beranda user.</p>
        </div>
        <a href="{{ route('admin.highlights.create') }}" class="btn btn-dark">Tambah Footage</a>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($highlights as $item)
                    <tr>
                        <td>
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" width="100" class="rounded">
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->title }}</strong>
                        </td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.highlights.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.highlights.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus footage ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

