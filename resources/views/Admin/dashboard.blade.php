@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-4">

    <h2 class="fw-bold text-navy mb-0">Dashboard</h2>
    <p class="text-muted mb-4">Ringkasan aktivitas layanan 112 Kutai Timur</p>

    {{-- STAT CARDS (4 KARTU) --}}
    <div class="row g-3 mb-4">
        {{-- Kartu 1: Total Kritik & Saran --}}
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue-soft text-primary"><i class="bi bi-chat-left-text-fill"></i></div>
                <div class="stat-value">{{ $stats['total_kritik'] ?? 0 }}</div>
                <div class="stat-label">Total Kritik & Saran</div>
            </div>
        </div>

        {{-- Kartu 2: Belum Dibaca / Menunggu --}}
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning-soft text-warning"><i class="bi bi-envelope-exclamation-fill"></i></div>
                <div class="stat-value text-warning">{{ $stats['belum_dibaca'] ?? 0 }}</div>
                <div class="stat-label">Belum Dibaca</div>
            </div>
        </div>

        {{-- Kartu 3: Sudah Dibaca / Direspon --}}
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-success-soft text-success"><i class="bi bi-check-circle-fill"></i></div>
                <div class="stat-value text-success">{{ $stats['sudah_dibaca'] ?? 0 }}</div>
                <div class="stat-label">Sudah Dibaca</div>
            </div>
        </div>

        {{-- Kartu 4: Total Laporan (SUDAH DISESUAIKAN) --}}
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-danger-soft text-danger"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div class="stat-value text-danger">{{ $stats['total_laporan'] ?? 0 }}</div>
                <div class="stat-label">Total Laporan</div>
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

</div>
@endsection

@push('scripts')
<script>
    // Tren Laporan Bulanan (line chart)
    new Chart(document.getElementById('chartTren'), {
        type: 'line',
        data: {
            labels: @json($trenBulanan['labels'] ?? []),
            datasets: [{
                data: @json($trenBulanan['data'] ?? []),
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

    // Kategori Laporan (doughnut chart)
    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: @json($kategori['labels'] ?? []),
            datasets: [{
                data: @json($kategori['data'] ?? []),
                backgroundColor: @json($kategori['colors'] ?? []),
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
            labels: @json($kecamatan['labels'] ?? []),
            datasets: [{
                data: @json($kecamatan['data'] ?? []),
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