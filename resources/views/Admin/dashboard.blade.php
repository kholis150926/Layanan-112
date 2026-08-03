 @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-4">

    <h2 class="fw-bold text-navy mb-0">Dashboard</h2>
    <p class="text-muted mb-4">Ringkasan aktivitas layanan 112 Kutai Timur</p>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue-soft text-primary"><i class="bi bi-file-earmark-text"></i></div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning-soft text-warning"><i class="bi bi-clock-fill"></i></div>
                <div class="stat-value text-warning">{{ $stats['menunggu'] }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-success-soft text-success"><i class="bi bi-check-circle-fill"></i></div>
                <div class="stat-value text-success">{{ $stats['disetujui'] }}</div>
                <div class="stat-label">Disetujui</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-danger-soft text-danger"><i class="bi bi-x-circle-fill"></i></div>
                <div class="stat-value text-danger">{{ $stats['ditolak'] }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>

    {{-- CHART: TREN + KATEGORI --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="chart-card h-100">
                <h5 class="fw-bold text-navy mb-3">Tren Laporan Bulanan</h5>
                <canvas id="chartTren" height="90"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-card h-100">
                <h5 class="fw-bold text-navy mb-3">Kategori Laporan</h5>
                <canvas id="chartKategori" height="180"></canvas>
            </div>
        </div>
    </div>

    {{-- CHART: PER KECAMATAN --}}
    <div class="chart-card mb-4">
        <h5 class="fw-bold text-navy mb-3">Laporan per Kecamatan (Top 8)</h5>
        <canvas id="chartKecamatan" height="70"></canvas>
    </div>

    {{-- LAPORAN TERBARU --}}
    <div class="chart-card">
        <h5 class="fw-bold text-navy mb-3">Laporan Terbaru</h5>
        <div class="list-group list-group-flush">
            @foreach ($laporanTerbaru as $lp)
                <div class="list-group-item d-flex align-items-center gap-3 px-0 py-3">
                    <div class="report-icon bg-{{ $lp['color'] }}-soft text-{{ $lp['color'] }}">
                        <i class="bi {{ $lp['icon'] }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold text-navy">
                            {{ $lp['jenis'] }} <span class="text-muted small">{{ $lp['kode'] }}</span>
                        </div>
                        <div class="text-muted small">{{ $lp['lokasi'] }}</div>
                    </div>
                    <div class="text-end">
                        <span class="badge status-{{ strtolower($lp['status']) }}">{{ $lp['status'] }}</span>
                        <div class="text-muted small mt-1">{{ $lp['tanggal'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Tren Laporan Bulanan (line chart)
    new Chart(document.getElementById('chartTren'), {
        type: 'line',
        data: {
            labels: @json($trenBulanan['labels']),
            datasets: [{
                data: @json($trenBulanan['data']),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 0,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 90 } } }
        }
    });

    // Kategori Laporan (donut chart)
    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: @json($kategori['labels']),
            datasets: [{
                data: @json($kategori['data']),
                backgroundColor: @json($kategori['colors']),
                borderWidth: 0,
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { display: false } }
        }
    });

    // Laporan per Kecamatan (bar chart)
    new Chart(document.getElementById('chartKecamatan'), {
        type: 'bar',
        data: {
            labels: @json($kecamatan['labels']),
            datasets: [{
                data: @json($kecamatan['data']),
                backgroundColor: ['#dc2626', '#ea580c', '#2563eb', '#2563eb', '#2563eb', '#2563eb', '#2563eb', '#2563eb'],
                borderRadius: 6,
                maxBarThickness: 30,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush