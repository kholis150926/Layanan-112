@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Kritik & Saran Masuk</h2>
            <p class="text-muted small mb-0">Daftar laporan aktif yang membutuhkan tindakan operator</p>
        </div>
        <a href="{{ route('admin.kritik-saran.riwayat') }}" class="btn btn-outline-dark rounded-3 px-3">
            <i class="bi bi-clock-history me-1"></i> Lihat Semua Riwayat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Laporan Aktif -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3">Pelapor</th>
                            <th>Kontak (No. HP/WA)</th>
                            <th>Jenis</th>
                            <th>Cuplikan Laporan</th>
                            <th>Waktu Masuk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanMasuk as $item)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">
                                    {{ $item->is_anonymous ? 'Anonim' : ($item->pelapor ?? 'Tanpa Nama') }}
                                </td>
                                <td><span class="text-muted small">{{ $item->kontak ?? '-' }}</span></td>
                                <td>
                                    <span class="badge {{ $item->jenis == 'kritik' ? 'bg-danger' : 'bg-info' }} rounded-pill text-capitalize">
                                        {{ $item->jenis ?? 'Saran' }}
                                    </span>
                                </td>
                                <td class="text-truncate" style="max-width: 250px;">{{ $item->pesan }}</td>
                                <td class="text-muted small">{{ $item->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-dark btn-sm px-3 rounded-3" data-bs-toggle="modal" data-bs-target="#modalStruk{{ $item->id }}">
                                        <i class="bi bi-receipt me-1"></i> Buka Struk Laporan
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Struk / Receipt Card -->
                            <div class="modal fade" id="modalStruk{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                        <!-- Header Struk -->
                                        <div class="bg-dark text-white p-4 text-center position-relative">
                                            <h5 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>STRUK LAPORAN WARGA</h5>
                                            <p class="small text-white-50 mb-0">Layanan Darurat SAAT 112</p>
                                            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Body Struk -->
                                        <div class="modal-body p-4 bg-light">
                                            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white mb-3">
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <span class="text-muted small">ID Laporan</span>
                                                    <span class="fw-bold small text-dark">#SRK-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <span class="text-muted small">Nama Pelapor</span>
                                                    <span class="fw-semibold text-dark">
                                                        {{ $item->is_anonymous ? 'Anonim' : ($item->pelapor ?? 'Tanpa Nama') }}
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <span class="text-muted small">Kontak</span>
                                                    <span class="fw-semibold text-dark">{{ $item->kontak ?? '-' }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <span class="text-muted small">Jenis Pesan</span>
                                                    <span class="fw-semibold text-capitalize text-dark">{{ $item->jenis ?? 'Saran' }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-muted small">Waktu Kirim</span>
                                                    <span class="fw-semibold text-dark">{{ $item->created_at->translatedFormat('d M Y, H:i') }} WITA</span>
                                                </div>
                                            </div>

                                            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                                                <label class="fw-bold text-dark small mb-2"><i class="bi bi-chat-left-text me-1"></i> ISI LAPORAN / PESAN:</label>
                                                <p class="text-secondary mb-0 small" style="white-space: pre-line; line-height: 1.6;">{{ $item->pesan }}</p>
                                            </div>
                                        </div>

                                        <!-- Footer Action -->
                                        <div class="modal-footer bg-white border-0 p-3 justify-content-center">
                                            <form action="{{ route('admin.kritik-saran.read', $item->id) }}" method="POST" class="w-100 text-center">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success rounded-3 fw-medium btn-sm px-4">
                                                    <i class="bi bi-check2-circle me-1"></i> Selesai 
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Tidak ada laporan baru. Semua laporan telah ditindaklanjuti!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection