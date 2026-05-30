@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Portfolio Management</h2>
            <p class="text-muted">Kelola koleksi portofolio Glad Moments & Co.</p>
        </div>
        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-dark">Tambah Portofolio</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($portfolios as $item)
                    <tr>
                        <td style="min-width: 120px;">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" width="100" class="rounded">
                            @endif
                        </td>
                        <td style="white-space: normal; max-width: 180px;">{{ $item->title }}</td>
                        <td style="white-space: normal; max-width: 120px;">{{ $item->category ?? '-' }}</td>
                        <td style="white-space: normal; max-width: 260px;">{{ \Illuminate\Support\Str::limit($item->description, 60) }}</td>
                        <td style="white-space: normal; min-width: 170px;">
                            <a href="{{ route('admin.portfolios.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.portfolios.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection