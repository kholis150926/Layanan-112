@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Kelola Galeri</h2>
            <p class="text-muted small mb-0">Manajemen foto dokumentasi kegiatan</p>
        </div>
        <button type="button" class="btn btn-dark px-3 py-2 rounded-3 text-sm fw-medium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Foto
        </button>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Grid Cards Galeri -->
    <div class="row g-4">
        @forelse($galeris as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <!-- Foto & Tombol Hapus Floating -->
                    <div class="position-relative" style="height: 190px;">
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             alt="{{ $item->judul }}" 
                             class="w-100 h-100" 
                             style="object-fit: cover;">
                        
                        <!-- Tombol Hapus Merah di Pojok Kanan Atas Foto -->
                        <form action="{{ route('admin.galery.destroy', $item->id) }}" method="POST" class="position-absolute top-0 end-0 m-3" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" title="Hapus Foto">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Judul & Tanggal -->
                    <div class="card-body p-3">
                        <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $item->judul }}">{{ $item->judul }}</h6>
                        <p class="text-muted small mb-0">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M Y') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2 text-secondary"></i>
                    Belum ada foto galeri terpasang. Klik <strong>"+ Tambah Foto"</strong> untuk mengisi galeri.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Pop-up Tambah Foto (Bootstrap 5) -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="modalTambahLabel">Tambah Foto Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.galery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Judul Kegiatan</label>
                        <input type="text" name="judul" required class="form-control rounded-3" placeholder="Contoh: Operasi Penanganan Kebakaran">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" required class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">File Foto</label>
                        <input type="file" name="foto" accept="image/*" required class="form-control rounded-3">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-3 fw-medium" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark px-4 rounded-3 fw-medium">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection