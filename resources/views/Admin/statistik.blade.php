@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')
<div class="p-4">

    <!-- HEADER & TOMBOL TAMBAH LAPORAN -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-navy mb-0">Statistik Kecamatan</h2>
            <p class="text-muted mb-0">Pilih kecamatan untuk melihat analisis detail laporan</p>
        </div>
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahLaporan">
            <i class="bi bi-plus-circle-fill"></i> Tambah Laporan
        </button>
    </div>

    <!-- ALERT JIKA BERHASIL TAMBAH DATA -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- GRID PILIH KECAMATAN --}}
    <div class="chart-card mb-4">
        <h5 class="fw-bold text-navy mb-3">Pilih Kecamatan</h5>

        <div class="row g-3">
            @foreach ($kecamatan as $k)
                @php
                    $isSelected = ($k['nama'] === $selectedKecamatan);

                    if ($isSelected) {
                        $cardStyle = 'bg-primary text-white border-primary shadow-sm';
                        $valColor = 'text-white';
                        $nameColor = 'text-white-50';
                    } else {
                        $cardStyle = 'bg-white border text-dark';
                        if ($k['total'] >= 40) {
                            $valColor = 'text-danger';
                        } elseif ($k['total'] >= 20) {
                            $valColor = 'text-warning';
                        } else {
                            $valColor = 'text-primary';
                        }
                        $nameColor = 'text-muted';
                    }
                @endphp

                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('admin.statistik', ['kecamatan' => $k['nama']]) }}" class="kecamatan-card d-block text-decoration-none p-3 text-center rounded-3 {{ $cardStyle }}">
                        <div class="kecamatan-value fs-4 fw-bold {{ $valColor }}">{{ $k['total'] }}</div>
                        <div class="kecamatan-name small {{ $nameColor }}">{{ $k['nama'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- DETAIL KECAMATAN YANG DIPILIH --}}
    <div class="chart-card mb-4 bg-light p-3 rounded-3 border-start border-4 border-primary">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
            <div>
                <h4 class="fw-bold text-navy mb-0">Kec. {{ $selectedKecamatan }}</h4>
                <p class="text-muted small mb-0">{{ $totalSelected }} Total Laporan Terdaftar</p>
            </div>
        </div>
    </div>

    {{-- GRAFIK KATEGORI & TREN KHUSUS KECAMATAN YANG DIKLIK --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="chart-card h-100">
                <h5 class="fw-bold text-navy mb-3">Distribusi Kategori (Kec. {{ $selectedKecamatan }})</h5>
                <div style="height: 250px;" class="d-flex justify-content-center">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-card h-100">
                <h5 class="fw-bold text-navy mb-3">Ringkasan Laporan</h5>
                <div class="row g-2 text-center pt-3">
                    @php
                        $colors = ['danger', 'primary', 'warning', 'info', 'secondary'];
                    @endphp
                    @foreach($kategoriLabels as $index => $label)
                        <div class="col-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="fw-bold fs-4 text-{{ $colors[$index % count($colors)] }}">{{ $kategoriData[$index] }}</div>
                                <div class="small text-muted text-truncate">{{ $label }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- BAR CHART PERBANDINGAN SELURUH KECAMATAN --}}
    <div class="chart-card">
        <h5 class="fw-bold text-navy mb-3">Perbandingan Seluruh Kecamatan</h5>
        <canvas id="chartKecamatanAll" height="80"></canvas>
    </div>

</div>

<!-- MODAL FORM TAMBAH LAPORAN -->
<div class="modal fade" id="modalTambahLaporan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-navy">Tambah Laporan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.laporan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kecamatan</label>
                        <select name="kecamatan" class="form-select" required>
                            @foreach($kecamatan as $k)
                                <option value="{{ $k['nama'] }}" {{ $k['nama'] == $selectedKecamatan ? 'selected' : '' }}>
                                    Kec. {{ $k['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Laporan</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Darurat Medis">Darurat Medis</option>
                            <option value="Kebakaran">Kebakaran</option>
                            <option value="Kriminal">Kriminal</option>
                            <option value="Laka Lantas">Laka Lantas</option>
                            <option value="Bencana Alam">Bencana Alam</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Lokasi Detail</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Jl. Yos Sudarso No. 10..." required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-semibold px-4">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // 1. Chart Donat Kategori Per Kecamatan
    const kategoriLabels = @json($kategoriLabels);
    const kategoriData = @json($kategoriData);

    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: kategoriLabels,
            datasets: [{
                data: kategoriData,
                backgroundColor: ['#ef4444', '#3b82f6', '#f59e0b', '#06b6d4', '#8b5cf6', '#6b7280'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // 2. Bar Chart Perbandingan Seluruh Kecamatan
    const dataKecamatan = @json($chartData);
    const maxVal = Math.max(...dataKecamatan, 1);

    const barColors = dataKecamatan.map(v => {
        const ratio = v / maxVal;
        if (ratio > 0.8) return '#1e40af';
        if (ratio > 0.6) return '#2563eb';
        return '#60a5fa';
    });

    new Chart(document.getElementById('chartKecamatanAll'), {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                data: dataKecamatan,
                backgroundColor: barColors,
                borderRadius: 6,
                maxBarThickness: 34,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { ticks: { autoSkip: false, maxRotation: 0, font: { size: 11 } } }
            }
        }
    });
</script>
@endpush