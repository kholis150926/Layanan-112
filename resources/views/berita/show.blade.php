@extends('layouts.app') {{-- Sesuaikan nama layout utama kamu (misal: layouts.frontend / layouts.main) --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tombol Kembali -->
            <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary mb-4">← Kembali ke Berita</a>

            <!-- Badge Kategori -->
            <span class="badge bg-primary text-capitalize mb-2 d-inline-block">{{ $berita->kategori }}</span>

            <!-- Judul Berita -->
            <h1 class="fw-bold mb-3">{{ $berita->judul }}</h1>

            <!-- Tanggal -->
            <p class="text-muted small mb-4">
                Dipublikasikan pada {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y, H:i') }} WITA
            </p>

            <!-- Gambar Utama -->
            @if($berita->gambar_url)
                <img src="{{ $berita->gambar_url }}" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $berita->judul }}">
            @endif

            <!-- Ringkasan / Highlight -->
            @if($berita->ringkasan)
                <div class="lead fw-bold mb-4 text-secondary">
                    {{ $berita->ringkasan }}
                </div>
            @endif

            <!-- Isi Konten Lengkap -->
            <div class="content lh-lg">
                {!! nl2br(e($berita->konten)) !!}
            </div>
        </div>
    </div>
</div>
@endsection