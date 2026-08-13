@extends('layouts.admin')

@section('title', 'Kelola Konten')

@section('content')
<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-navy mb-0">Kelola Konten</h2>
            <p class="text-muted mb-0">Manajemen berita dan informasi publik</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-navy d-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="background-color: #0d1b2a; color: white; border-radius: 20px;">
            <i class="bi bi-plus-lg"></i> Tambah Berita
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex flex-column gap-3">
        @forelse($beritaList as $item)
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $item->gambar_url }}" alt="Thumbnail" class="rounded-3" style="width: 100px; height: 60px; object-fit: cover;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-2 py-1 small">{{ $item->kategori }}</span>
                            <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 small">{{ $item->status }}</span>
                        </div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-light btn-sm rounded-circle text-muted" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted card border-0 rounded-4 shadow-sm">
                Belum ada berita. Klik tombol <strong>Tambah Berita</strong> di atas.
            </div>
        @endforelse
    </div>
</div>
@endsection