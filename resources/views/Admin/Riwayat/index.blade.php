@extends('layouts.admin')

@section('title', 'Riwayat Laporan 112')

@section('content')
<div class="p-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-navy mb-0">Riwayat & Rekap Laporan 112</h2>
            <p class="text-muted mb-0">Arsip seluruh aktivitas laporan darurat yang diinput oleh admin</p>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-danger me-2">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Cetak / PDF
            </button>
        </div>
    </div>

    {{-- CARD FILTER DATA --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-bold text-navy mb-3"><i class="bi bi-funnel-fill me-1"></i> Filter Data Laporan</h6>
            <form method="GET" action="{{ route('admin.riwayat.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-bold">Kecamatan</label>
                    <select name="kecamatan" class="form-select">
                        <option value="">-- Semua Kecamatan --</option>
                        @foreach($daftarKecamatan as $kec)
                            <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>
                                {{ $kec }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold">Dari Tanggal</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold">Sampai Tanggal</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.riwayat.index') }}" class="btn btn-light border" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

{{-- TABEL RIWAYAT LAPORAN --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Tanggal & Waktu Input</th>
                            <th>Kecamatan</th>
                            <th>Kategori Kejadian</th>
                            <th class="pe-4">Lokasi Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $index => $item)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $laporans->firstItem() + $index }}</td>
                            <td>
                                <div>{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}</div>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $item->created_at ? $item->created_at->format('H:i') : '' }} WITA</small>
                            </td>
                            <td>
                                <span class="badge bg-blue-soft text-primary px-2 py-1">
                                    <i class="bi bi-geo-alt-fill me-1"></i>{{ $item->kecamatan ?? '-' }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $item->kategori ?? '-' }}</td>
                            <td class="pe-4">
                                {{-- Menampilkan data kolom lokasi_detail dari database --}}
                                {{ $item->lokasi_detail ?? $item->lokasi ?? 'Lokasi tidak diisi' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Belum ada riwayat laporan yang sesuai dengan filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($laporans->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $laporans->links() }}
        </div>
        @endif
    </div>

</div>

{{-- STYLE HUSUS CETAK LAPORAN --}}
<style>
@media print {
    /* Sembunyikan Sidebar, Nav, dan Tombol Filter saat dicetak */
    .sidebar, nav, .btn, .card-body form, .pagination, footer {
        display: none !important;
    }
    body {
        background-color: #fff !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection