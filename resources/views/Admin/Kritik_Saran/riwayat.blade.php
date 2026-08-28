@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Riwayat Seluruh Pesan</h2>
            <p class="text-muted small mb-0">Arsip pesan yang sudah dibaca maupun yang terlewatkan</p>
        </div>
        <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-dark rounded-3 px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Pesan Aktif
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3">Waktu</th>
                            <th>Pelapor</th>
                            <th>Kontak</th>
                            <th>Pesan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPesan as $item)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</td>
                                <td class="fw-semibold text-dark">{{ $item->nama }}</td>
                                <td class="text-muted small">{{ $item->no_hp }}</td>
                                <td class="text-truncate" style="max-width: 300px;">{{ $item->pesan }}</td>
                                <td>
                                    @if($item->status == 'sudah_dibaca')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Selesai/Dibaca</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Belum Dibaca</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat pesan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($riwayatPesan->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $riwayatPesan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection