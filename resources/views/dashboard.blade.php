<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAAT 112 - Sistem Darurat Kutai Timur</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --brand-blue: #2f6fed;
            --brand-blue-dark: #1e3a8a;
            --brand-red: #e53935;
            --bg-soft: #f4f6fb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-soft);
            color: #1f2937;
        }

        a { text-decoration: none; }

        /* ===== Navbar ===== */
        .navbar-saat {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: .75rem 0;
        }
        .navbar-saat .brand-icon {
            width: 38px; height: 38px;
            background: var(--brand-blue);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.1rem;
        }
        .navbar-saat .brand-title { font-weight: 700; font-size: 1.05rem; line-height: 1.1; color: #111827; }
        .navbar-saat .brand-sub { font-size: .72rem; color: #9ca3af; }
        .navbar-saat .nav-link {
            color: #374151; font-weight: 500; font-size: .92rem; padding: .4rem .9rem;
        }
        .navbar-saat .nav-link.active { color: var(--brand-blue); font-weight: 600; }
        .btn-darurat-nav {
            background: var(--brand-red);
            color: #fff; font-weight: 600; font-size: .88rem;
            border-radius: 50px; padding: .5rem 1.2rem;
            border: none;
        }
        .btn-darurat-nav:hover { color: #fff; opacity: .92; }
        .admin-link { color: #6b7280; font-size: .88rem; }

        /* ===== Hero ===== */
        .hero-card {
            background: linear-gradient(135deg, #3b6df0 0%, #2f5fe0 55%, #274edc 100%);
            border-radius: 24px;
            color: #fff;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .badge-soft {
            background: rgba(255,255,255,.18);
            color: #fff;
            font-weight: 500;
            font-size: .78rem;
            padding: .4rem .9rem;
            border-radius: 50px;
        }
        .badge-soft.live { background: rgba(255,255,255,.18); }
        .badge-soft .dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #4ade80; display: inline-block; margin-right: 6px;
        }
        .hero-card h1 { font-weight: 800; font-size: 2.1rem; }
        .hero-card p { color: rgba(255,255,255,.85); max-width: 480px; }
        .btn-hero {
            background: #fff; color: var(--brand-blue);
            font-weight: 600; border-radius: 50px;
            padding: .65rem 1.4rem; font-size: .92rem;
            border: none;
        }
        .btn-hero:hover { color: var(--brand-blue); opacity: .9; }

        .hotline-card {
            background: rgba(0,0,0,.18);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 20px;
            padding: 1.6rem;
            text-align: center;
            backdrop-filter: blur(2px);
        }
        .hotline-card .label { font-size: .72rem; letter-spacing: .06em; color: rgba(255,255,255,.75); text-transform: uppercase; }
        .hotline-card .number { font-size: 3.2rem; font-weight: 800; line-height: 1; margin: .3rem 0; }
        .hotline-card .sub { font-size: .8rem; color: rgba(255,255,255,.75); margin-bottom: 1.1rem; }
        .hotline-stats { border-top: 1px solid rgba(255,255,255,.18); padding-top: 1rem; }
        .hotline-stats .stat-num { font-weight: 700; font-size: 1.15rem; }
        .hotline-stats .stat-label { font-size: .68rem; color: rgba(255,255,255,.7); }

        /* ===== Section titles ===== */
        .section-title { font-weight: 700; font-size: 1.15rem; color: #111827; }

        /* ===== Map card ===== */
        .map-card {
            background: linear-gradient(160deg, #4f7bf0, #2f5fe0);
            border-radius: 20px;
            min-height: 340px;
            position: relative;
            color: #fff;
            overflow: hidden;
        }
        #dashboardMap {
            position: absolute; inset: 0;
            border-radius: 20px;
            z-index: 1;
        }
        .map-legend {
            position: absolute; bottom: 14px; left: 14px;
            display: flex; gap: .6rem; font-size: .72rem;
            background: rgba(0,0,0,.5);
            padding: .4rem .8rem; border-radius: 50px;
            z-index: 400;
            flex-wrap: wrap;
            max-width: calc(100% - 28px);
        }
        .map-legend span { display: flex; align-items: center; gap: 5px; white-space: nowrap; }
        .legend-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }

        /* ===== Kecamatan panel ===== */
        .panel-card {
            background: #fff; border-radius: 18px; padding: 1.4rem;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
            height: 100%;
        }
        .panel-card h6 { font-weight: 700; }
        .search-locate {
            background: #eef2ff; border-radius: 14px;
            padding: 1rem; text-align: center; margin-bottom: 1rem;
        }
        .search-locate .icon-circle {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--brand-blue); color: #fff;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto .5rem;
        }
        .search-locate small { color: #6b7280; font-size: .78rem; }

        .kec-list-title { font-size: .8rem; font-weight: 600; color: #6b7280; margin-bottom: .6rem; }
        .kec-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: .55rem 0; border-bottom: 1px solid #f1f3f6;
            font-size: .88rem;
        }
        .kec-item:last-child { border-bottom: none; }
        .kec-rank {
            width: 22px; height: 22px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .72rem; font-weight: 700; color: #fff; margin-right: .6rem;
        }
        .rank-1 { background: #f59e0b; }
        .rank-2 { background: #fbbf24; }
        .rank-3 { background: #9ca3af; }
        .rank-4 { background: #3b82f6; }
        .rank-5 { background: #6b7280; }
        .kec-count { font-weight: 600; color: #374151; }

        /* ===== Berita cards ===== */
        .news-card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,.05); height: 100%; }
        .news-card img { height: 170px; object-fit: cover; }
        .news-card .card-body { padding: 1.1rem; }
        .news-badge { font-size: .7rem; font-weight: 600; padding: .3rem .7rem; border-radius: 50px; }
        .news-badge.pengumuman { background: #e0edff; color: var(--brand-blue); }
        .news-badge.sosialisasi { background: #e0edff; color: var(--brand-blue); }
        .news-badge.rilis { background: #fde8e8; color: var(--brand-red); }
        .news-card h6 { font-weight: 700; margin-top: .7rem; font-size: .95rem; }
        .news-card p { font-size: .82rem; color: #6b7280; }
        .news-date { font-size: .75rem; color: #9ca3af; }
        .lihat-semua { font-size: .85rem; font-weight: 600; color: var(--brand-blue); }

        /* ===== Footer ===== */
        .footer-saat { background: #10182b; color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 3rem; }
        .footer-saat h6 { color: #fff; font-weight: 700; }
        .footer-saat a { color: #9aa5b8; font-size: .88rem; }
        .footer-saat a:hover { color: #fff; }
        .footer-saat .footer-brand { display: flex; align-items: center; gap: .6rem; margin-bottom: .8rem; }
        .footer-saat p.small-text { font-size: .85rem; color: #9aa5b8; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 2rem; padding-top: 1.2rem; font-size: .78rem; color: #6b7280; text-align: center; }
        .footer-emergency-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #fff; }
    </style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg navbar-saat sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <span class="brand-icon"><i class="bi bi-shield-fill-check"></i></span>
            <span>
                <span class="d-block brand-title">SAAT 112</span>
                <span class="d-block brand-sub">Kutai Timur</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSaat">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navSaat">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporanindex') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kritik-saran') ? 'active' : '' }}" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">

    <!-- ===== Hero Section ===== -->
    <div class="hero-card mb-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <span class="badge-soft"><i class="bi bi-house-door-fill me-1"></i> Beranda</span>
                    <span class="badge-soft live"><span class="dot"></span>Laporan 24/7 Aktif</span>
                </div>
                <h1>Sistem Darurat<br>SAAT 112</h1>
                <p class="mb-4">
                    Laporkan kejadian darurat di Kutai Timur. Bantuan siap menjangkau anda
                    dengan cepat untuk keselamatan anda.
                </p>
                <a href="{{ route('profil') }}" class="btn btn-hero">
                    Tentang Layanan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="hotline-card">
                    <div class="label">Hubungi Darurat</div>
                    <div class="number">112</div>
                    <div class="sub">Bebas Pulsa 24 Jam</div>
                    <div class="row hotline-stats g-2">
                        <div class="col-4">
                            <div class="stat-num">{{ $totalPetugas ?? 2 }}</div>
                            <div class="stat-label">Petugas</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-num">{{ $totalKecamatan ?? 18 }}</div>
                            <div class="stat-label">Kecamatan</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-num">24/7</div>
                            <div class="stat-label">Operasional</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
</x-app-layout>
=======

    <!-- ===== Peta & Kecamatan ===== -->
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <h5 class="section-title mb-3">Peta Kabupaten Kutai Timur</h5>
            <p class="text-muted mb-3" style="font-size:.88rem;">Pilih kecamatan untuk melihat informasi wilayah</p>
            <div class="map-card">
                <div id="dashboardMap"></div>
                <div class="map-legend" id="dashboardMapLegend"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel-card">
                <h6 class="mb-3">Pilih Kecamatan</h6>
                <div class="search-locate">
                    <div class="icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
                    <small>Klik wilayah pada peta untuk melihat informasi laporan</small>
                </div>

                <div class="kec-list-title">Kecamatan Teratas</div>
                <div class="kec-list">
                    @php
                        $kecamatanTeratas = $kecamatanTeratas ?? [
                            ['nama' => 'Sangatta Utara', 'jumlah' => 58, 'rank' => 1],
                            ['nama' => 'Sangatta Selatan', 'jumlah' => 45, 'rank' => 2],
                            ['nama' => 'Kaliorang', 'jumlah' => 26, 'rank' => 3],
                            ['nama' => 'Bengalon', 'jumlah' => 21, 'rank' => 4],
                            ['nama' => 'Kaubun', 'jumlah' => 21, 'rank' => 5],
                        ];
                    @endphp

                    @foreach($kecamatanTeratas as $kec)
                        <div class="kec-item">
                            <span class="d-flex align-items-center">
                                <span class="kec-rank rank-{{ $kec['rank'] }}">{{ $kec['rank'] }}</span>
                                {{ $kec['nama'] }}
                            </span>
                            <span class="kec-count">{{ $kec['jumlah'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Berita Terbaru ===== -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="section-title mb-0">Berita Terbaru</h5>
        <a href="{{ route('berita.index') }}" class="lihat-semua">Lihat semua &rarr;</a>
    </div>

    <div class="row g-4 mb-4">
        @php
            $beritaList = $beritaList ?? [
                [
                    'badge' => 'Pengumuman', 'badge_class' => 'pengumuman',
                    'gambar' => 'https://images.unsplash.com/photo-1521302080334-4bebac2763a6?w=500',
                    'judul' => 'Perupsov Kaltim Perluas Layanan Darurat 112 di Kutai Timur',
                    'ringkasan' => 'Pemerintah Provinsi Kalimantan Timur bekerjasama mempercepat layanan darurat 112 untuk masyarakat Kutai Timur...',
                    'tanggal' => '27 Jan 2026',
                ],
                [
                    'badge' => 'Sosialisasi', 'badge_class' => 'sosialisasi',
                    'gambar' => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?w=500',
                    'judul' => 'Sosialisasi Penggunaan Layanan 112 di Kecamatan Sangatta Utara',
                    'ringkasan' => 'Tim Diskominfo Kutai Timur melakukan sosialisasi tentang cara penggunaan layanan 112 kepada...',
                    'tanggal' => '18 Jan 2026',
                ],
                [
                    'badge' => 'Rilis', 'badge_class' => 'rilis',
                    'gambar' => 'https://images.unsplash.com/photo-1541864890574-2c9fb28b30c7?w=500',
                    'judul' => 'Layanan 112 Berhasil Tangani 50 Kasus Darurat di Bulan Januari 2024',
                    'ringkasan' => 'Sepanjang Januari 2024, layanan 112 Kutai Timur berhasil menangani 50 kasus darurat yang timbul karena...',
                    'tanggal' => '15 Jan 2026',
                ],
            ];
        @endphp

        @foreach($beritaList as $berita)
            <div class="col-md-4">
                <div class="card news-card">
                    <img src="{{ $berita['gambar'] }}" class="card-img-top" alt="{{ $berita['judul'] }}">
                    <div class="card-body">
                        <span class="news-badge {{ $berita['badge_class'] }}">{{ $berita['badge'] }}</span>
                        <h6>{{ $berita['judul'] }}</h6>
                        <p class="mb-2">{{ $berita['ringkasan'] }}</p>
                        <span class="news-date">{{ $berita['tanggal'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- ===== Footer ===== -->
<footer class="footer-saat">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand">
                    <span class="footer-emergency-icon"><i class="bi bi-shield-fill-check"></i></span>
                    <h6 class="mb-0">SAAT 112</h6>
                </div>
                <p class="small-text">
                    Layanan darurat terpadu untuk masyarakat Kabupaten Kutai Timur, Kalimantan Timur.
                </p>
                <p class="small-text mb-0">&copy; Diskominfo Kabupaten Kutai Timur 2026</p>
            </div>
            <div class="col-md-4">
                <h6>Navigasi Cepat</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mt-3">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('laporan.index') }}">Laporan</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                    <li><a href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Kontak Darurat</h6>
                <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                    <i class="bi bi-telephone-fill text-danger"></i>
                    <div>
                        <div class="fw-semibold text-white">112</div>
                        <div class="small-text">Bebas Pulsa 24 Jam</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="small-text">saat112@kutaitimurkab.go.id</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="small-text">Jl. Soekarno-Hatta, Sangatta</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            Diskominfo Kabupaten Kutai Timur &mdash; Sistem Informasi Darurat Kabupaten Kutai Timur
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusColor = {
        launching:  '#2e9e4f',
        uji_coba:   '#f59e0b',
        verifikasi: '#3b82f6',
        pengajuan:  '#5bc0c0',
        belum:      '#9ca3af',
    };
    const statusLabel = {
        launching: 'Sudah Launching',
        uji_coba: 'Uji Coba',
        verifikasi: 'Verifikasi',
        pengajuan: 'Dalam Pengajuan',
        belum: 'Belum Permohonan',
    };

    const dashMap = L.map('dashboardMap', {
        zoomControl: false,
        attributionControl: false,
    }).setView([1.35, 117.4], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(dashMap);

    fetch("{{ route('peta.kutai-timur.data') }}")
        .then(res => res.json())
        .then(geojson => {
            const layer = L.geoJSON(geojson, {
                style: f => ({
                    fillColor: statusColor[f.properties.status] || '#ccc',
                    fillOpacity: 0.8,
                    color: '#fff',
                    weight: 1,
                }),
                onEachFeature: (feature, lyr) => {
                    lyr.bindPopup(`<b>${feature.properties.kecamatan}</b><br>Status: ${statusLabel[feature.properties.status]}`);
                }
            }).addTo(dashMap);

            dashMap.fitBounds(layer.getBounds());

            document.getElementById('dashboardMapLegend').innerHTML =
                Object.keys(statusLabel).map(k =>
                    `<span><i class="legend-dot" style="background:${statusColor[k]}"></i>${statusLabel[k]}</span>`
                ).join('');
        });
});
</script>
</body>
</html>
>>>>>>> Stashed changes
