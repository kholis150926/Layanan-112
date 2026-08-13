@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="p-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h4 class="fw-bold text-navy mb-4">Edit Berita</h4>

        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-muted small fw-semibold">Judul *</label>
                <input type="text" name="judul" class="form-control rounded-3" value="{{ $berita->judul }}" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select rounded-3" required>
                        <option value="Pengumuman" {{ $berita->kategori == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="Kegiatan" {{ $berita->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Statistik" {{ $berita->kategori == 'Statistik' ? 'selected' : '' }}>Statistik</option>
                        <option value="Edukasi" {{ $berita->kategori == 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">URL Gambar</label>
                    <input type="url" name="gambar_url" class="form-control rounded-3" value="{{ $berita->gambar_url }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted small fw-semibold">Ringkasan *</label>
                <textarea name="ringkasan" class="form-control rounded-3" rows="2" required>{{ $berita->ringkasan }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-semibold">Konten Lengkap</label>
                <textarea name="konten" class="form-control rounded-3" rows="5" required>{{ $berita->konten }}</textarea>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                <button type="submit" class="btn btn-navy flex-fill rounded-pill py-2 text-white fw-bold" style="background-color: #0d1b2a;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection