@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Riwayat Kritik & Saran</h2>
            <p class="text-muted small mb-0">Daftar semua masukan yang telah diterima</p>
        </div>
        <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Pesan Masuk
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
                            <th>Jenis</th>
                            <th>Pesan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PASTIKAN MENGGUNAKAN $kritikSaran -->
                        @forelse($kritikSaran as $item)
                            <tr>
                                <td class="ps-4 text-muted small">
                                    {{ $item->created_at ? $item->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                </td>
                                <td class="fw-semibold text-dark">
                                    {{ $item->is_anonymous ? 'Anonim' : ($item->pelapor ?? 'Tanpa Nama') }}
                                </td>
                                <td><span class="text-muted small">{{ $item->kontak ?? '-' }}</span></td>
                                <td>
                                    <span class="badge {{ $item->jenis == 'kritik' ? 'bg-danger' : 'bg-info' }} text-capitalize">
                                        {{ $item->jenis ?? 'Saran' }}
                                    </span>
                                </td>
                                <td class="text-truncate" style="max-width: 300px;">{{ $item->pesan }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'sudah_dibaca' ? 'bg-success' : 'bg-warning' }} text-capitalize">
                                        {{ str_replace('_', ' ', $item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Belum ada data riwayat kritik dan saran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PASTIKAN PAGINATION MENGGUNAKAN $kritikSaran -->
            @if($kritikSaran->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $kritikSaran->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection