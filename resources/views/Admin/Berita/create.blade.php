@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="p-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h4 class="fw-bold text-navy mb-4">Tambah Berita Baru</h4>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label text-muted small fw-semibold">Judul *</label>
                <input type="text" name="judul" class="form-control rounded-3" placeholder="Judul berita..." required>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select rounded-3" required>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Statistik">Statistik</option>
                        <option value="Edukasi">Edukasi</option>
                    </select>
                </div>

                <!-- Input Pilihan Gambar (File / Link) -->
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-semibold">Gambar Berita</label>
                    <div class="input-group">
                        <select id="pilihanGambar" class="form-select rounded-start-3" style="max-width: 100px;" onchange="toggleGambarInput()">
                            <option value="file">File</option>
                            <option value="link">Link</option>
                        </select>
                        <input type="file" name="gambar_file" id="inputGambarFile" class="form-control rounded-end-3" accept="image/*">
                        <input type="url" name="gambar_url" id="inputGambarUrl" class="form-control rounded-end-3 d-none" placeholder="https://...">
                    </div>
                </div>

                <!-- Input Tanggal Upload -->
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-semibold">Tanggal Upload</label>
                    <input type="date" name="created_at" class="form-control rounded-3" value="{{ now()->format('Y-m-d') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted small fw-semibold">Ringkasan *</label>
                <textarea name="ringkasan" class="form-control rounded-3" rows="2" placeholder="Ringkasan singkat berita..." required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-semibold">Konten Lengkap</label>
                <textarea name="konten" class="form-control rounded-3" rows="5" placeholder="Isi berita lengkap..." required></textarea>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                <button type="submit" class="btn btn-navy flex-fill rounded-pill py-2 text-white fw-bold" style="background-color: #0d1b2a;">Publikasikan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleGambarInput() {
        const tipe = document.getElementById('pilihanGambar').value;
        const inputFile = document.getElementById('inputGambarFile');
        const inputUrl = document.getElementById('inputGambarUrl');

        if (tipe === 'file') {
            inputFile.classList.remove('d-none');
            inputUrl.classList.add('d-none');
            inputUrl.value = '';
        } else {
            inputUrl.classList.remove('d-none');
            inputFile.classList.add('d-none');
            inputFile.value = '';
        }
    }
</script>
@endsection