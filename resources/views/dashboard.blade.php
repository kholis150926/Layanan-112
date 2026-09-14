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
            .navbar-saat .nav-link.active {
                color: #fff;
                font-weight: 600;
                background: var(--brand-blue);
                border-radius: 50px;
            }
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
                <!-- Sekalian ku rapikan ini 'laporanindex' jadi 'laporan.index' biar active state-nya fungsi -->
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galery') ? 'active' : '' }}" href="{{ route('galery') }}">Galeri</a></li>
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
                    <a href="{{ route('laporan.index') }}" class="btn btn-hero">
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
                    <h6 class="mb-3" id="panelTitle">Informasi Wilayah</h6>

                    <!-- Tampilan Default (Muncul saat belum mengklik peta) -->
                    <div id="defaultPanel">
                        <div class="search-locate">
                            <div class="icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
                            <small>Klik wilayah pada peta untuk melihat grafik laporan</small>
                        </div>

                        <div class="kec-list-title">Kecamatan Teratas</div>
                        <div class="kec-list">
                            @forelse($kecamatanTeratas as $index => $kec)
                                <div class="kec-item">
                                    <span class="d-flex align-items-center">
                                        <span class="kec-rank rank-{{ $index + 1 }}">{{ $index + 1 }}</span>
                                        {{ $kec->kecamatan }}
                                    </span>
                                    <span class="kec-count">{{ $kec->jumlah }}</span>
                                </div>
                            @empty
                                <div class="text-muted small py-2">Belum ada data laporan per kecamatan.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tampilan Grafik (Muncul setelah peta diklik) -->
                    <div id="detailPanel" style="display: none;">
                        <button id="btnResetMap" class="btn btn-sm btn-outline-secondary mb-3 w-100">
                            <i class="bi bi-arrow-left"></i> Kembali ke Statistik Umum
                        </button>
                        <div style="position: relative; height: 220px;">
                            <canvas id="chartKecamatan"></canvas>
                        </div>
                        <div id="infoLaporanKecamatan" class="mt-3 text-center small text-muted"></div>
                    </div>
                </div>
            </div>
        </div>

<!-- ===== Berita Terbaru ===== -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="section-title mb-0">Berita Terbaru</h5>
            <a href="{{ route('berita.index') }}" class="lihat-semua">Lihat semua &rarr;</a>
        </div>

        <div class="row">
            @forelse($beritaTerbaru as $berita)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <!-- Gambar Berita -->
                        <img src="{{ filter_var($berita->gambar_url, FILTER_VALIDATE_URL) ? $berita->gambar_url : asset('storage/' . $berita->gambar_url) }}" 
                        class="card-img-top rounded-top-3" 
                        alt="{{ $berita->judul }}"
                        style="aspect-ratio: 16/9; object-fit: cover; width: 100%;">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text text-muted">
                                <small>{{ $berita->created_at->format('d M Y') }}</small>
                            </p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($berita->isi), 100) }}
                            </p>
                            <a href="{{ route('berita.show', $berita->slug ?? $berita->id) }}" class="btn btn-primary btn-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada berita terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- ===== Footer ===== -->
    <footer class="footer-saat">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="footer-brand">
                        <span class="footer-emergency-icon"><i class="bi bi-shield-fill-check"></i></span>
                        <h6 class="mb-0">SAAT 112</h6>
                    </div>
                    <p class="small-text">
                        Layanan darurat terpadu untuk masyarakat Kabupaten Kutai Timur, Kalimantan Timur.
                    </p>
                    <p class="small-text mb-0">&copy; Diskominfo Kabupaten Kutai Timur 2026</p>
                </div>
                <div class="col-md-3">
                    <h6>Navigasi Cepat</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mt-3">
                        <li><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a href="{{ route('profil') }}">Profil</a></li>
                        <li><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li><a href="{{ route('laporan.index') }}">Tentang</a></li>
                        <li><a href="{{ route('galery') }}">Galeri</a></li>
                        <li><a href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
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
                        <span class="small-text">112@kutaitimurkab.go.id</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="small-text">Jl. Soekarno-Hatta, Sangatta</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>Media Sosial</h6>
                    <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                        <i class="bi bi-whatsapp"></i>
                        <span class="small-text">081210007112</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-instagram"></i>
                        <span class="small-text">@kutimsiaga112</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-telegram"></i>
                        <span class="small-text">kutimsiaga112_bot</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-facebook"></i>
                        <span class="small-text">kutimsiaga112</span>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. Inisialisasi Peta
    const dashMap = L.map('dashboardMap').setView([-0.5, 117.5], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(dashMap);

    let chartInstance = null;

    // 2. Element DOM Panel
    const defaultPanel = document.getElementById('defaultPanel');
    const detailPanel = document.getElementById('detailPanel');
    const panelTitle = document.getElementById('panelTitle');
    const infoLaporan = document.getElementById('infoLaporanKecamatan');
    const btnResetMap = document.getElementById('btnResetMap');

    // 3. Fungsi Menampilkan Grafik Kecamatan
    function tampilkanGrafikKecamatan(namaKec, stats) {
        panelTitle.innerText = 'Statistik: ' + namaKec;
        defaultPanel.style.display = 'none';
        detailPanel.style.display = 'block';

        const labels = Object.keys(stats || {});
        const values = Object.values(stats || {});
        const totalLaporan = values.reduce((a, b) => a + b, 0);

        infoLaporan.innerText = 'Total Laporan: ' + totalLaporan + ' Kejadian';

        // Hapus chart lama jika ada
        if (chartInstance) {
            chartInstance.destroy();
        }

        // Buat Chart Baru
        const ctx = document.getElementById('chartKecamatan').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels.length ? labels : ['Belum Ada Laporan'],
                datasets: [{
                    data: values.length ? values : [1],
                    backgroundColor: values.length 
                        ? ['#2f6fed', '#e53935', '#f59e0b', '#10b981', '#8b5cf6'] 
                        : ['#e5e7eb']
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
    }

    // 4. Tombol Reset / Kembali
    btnResetMap.addEventListener('click', function () {
        panelTitle.innerText = 'Informasi Wilayah';
        detailPanel.style.display = 'none';
        defaultPanel.style.display = 'block';
        dashMap.setView([-0.5, 117.5], 8);
    });

    
    fetch("{{ route('peta.data') }}")
    .then(res => res.json())
    .then(geojson => {

        const layer = L.geoJSON(geojson, {
            // TIDAK PERLU fungsi filter lagi di sini!
            // Karena pemfilteran 'Kutai Timur' sudah dilakukan di PHP (DashboardController)
            style: {
                fillColor: '#2f6fed',
                fillOpacity: 0.35,
                color: '#1e3a8a',
                weight: 1.5,
            },
            onEachFeature: (feature, lyr) => {
                const namaKecamatan = feature.properties.kecamatan || 'Kecamatan';

                lyr.bindPopup(`<b>${namaKecamatan}</b>`);
                
                lyr.on('mouseover', () => lyr.setStyle({ fillOpacity: 0.65, weight: 2.5 }));
                lyr.on('mouseout',  () => lyr.setStyle({ fillOpacity: 0.35, weight: 1.5 }));

                // Event Klik Wilayah
                lyr.on('click', () => {
                    // Focus kamera ke kecamatan yang diklik
                    dashMap.fitBounds(lyr.getBounds());
                    
                    // 2. AMBIL DATA STATISTIK YANG SUDAH DISIAPKAN OLEH CONTROLLER
                    const statsWilayah = feature.properties.statistik || {};
                    tampilkanGrafikKecamatan(namaKecamatan, statsWilayah);
                });
            }
        }).addTo(dashMap);

        // Fit bounds awal ke area Kutai Timur
        if (layer.getBounds().isValid()) {
            dashMap.fitBounds(layer.getBounds());
        }
    })
    .catch(err => console.error("Gagal memuat peta GeoJSON:", err));
});
</script>
    </body>
    </html>
