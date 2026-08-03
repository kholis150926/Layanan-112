<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Informasi - SAAT 112</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-blue: #2f6fed;
            --brand-blue-dark: #1e2a5c;
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
            color: #fff; font-weight: 600; background: var(--brand-blue);
            border-radius: 50px;
        }
        .admin-link { color: #9ca3af; font-size: .88rem; }

        .page-title { color: #9ca3af; font-weight: 500; margin: 1.5rem 0 1rem; }

        /* ===== Header Berita ===== */
        .berita-header h4 { font-weight: 700; color: #111827; }

        .filter-pill {
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
            font-size: .85rem;
            font-weight: 500;
            padding: .45rem 1.1rem;
            border-radius: 50px;
        }
        .filter-pill.active {
            background: var(--brand-blue);
            border-color: var(--brand-blue);
            color: #fff;
        }
        .filter-pill:hover { color: inherit; text-decoration: none; }

        /* ===== Berita Cards ===== */
        .news-card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,.05); height: 100%; }
        .news-card img { height: 170px; object-fit: cover; width: 100%; }
        .news-card .card-body { padding: 1.1rem; }
        .news-badge { font-size: .68rem; font-weight: 600; padding: .3rem .7rem; border-radius: 50px; text-transform: uppercase; letter-spacing: .02em; }
        .news-badge.pengumuman { background: #e0edff; color: var(--brand-blue); }
        .news-badge.kegiatan { background: #e5f7ec; color: #16a34a; }
        .news-badge.statistik { background: #fde8e8; color: var(--brand-red); }
        .news-card h6 { font-weight: 700; margin-top: .7rem; font-size: .95rem; line-height: 1.35; }
        .news-card p { font-size: .82rem; color: #6b7280; }
        .news-footer { display: flex; align-items: center; justify-content: space-between; margin-top: .6rem; }
        .news-date { font-size: .75rem; color: #9ca3af; }
        .news-read { font-size: .8rem; font-weight: 600; color: var(--brand-blue); }

        /* ===== Footer ===== */
        .footer-saat { background: var(--brand-blue-dark); color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 3rem; }
        .footer-saat h6 { color: #fff; font-weight: 700; }
        .footer-saat a { color: #9aa5b8; font-size: .88rem; }
        .footer-saat a:hover { color: #fff; }
        .footer-saat .footer-brand { display: flex; align-items: center; gap: .6rem; margin-bottom: .8rem; }
        .footer-saat .footer-brand-title { font-weight: 700; color: #fff; font-size: 1rem; line-height: 1.1; }
        .footer-saat .footer-brand-sub { font-size: .72rem; color: #9aa5b8; }
        .footer-saat p.small-text { font-size: .85rem; color: #9aa5b8; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 2rem; padding-top: 1.2rem; font-size: .78rem; color: #6b7280; text-align: center; }
        .footer-emergency-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #fff; }
    </style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg navbar-saat sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('beranda') }}">
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
                <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                {{-- Link Admin dinonaktifkan sementara, aktifkan lagi setelah route login siap --}}
                {{-- <a href="{{ route('login') }}" class="admin-link">Admin</a> --}}
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-title">Berita</div>

    <!-- ===== Header + Filter ===== -->
    <div class="berita-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <h4 class="mb-0">Berita & Informasi</h4>
        <div class="d-flex gap-2 flex-wrap">
            @php
                $filterAktif = $filterAktif ?? 'Semua';
                $filters = ['Semua', 'Pengumuman', 'Kegiatan', 'Statistik'];
            @endphp
            @foreach($filters as $filter)
                <a href="{{ route('berita.index', $filter === 'Semua' ? [] : ['kategori' => $filter]) }}"
                   class="filter-pill {{ $filterAktif === $filter ? 'active' : '' }}">
                    {{ $filter }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- ===== Grid Berita ===== -->
    <div class="row g-4 mb-5">
        @php
            $beritaList = $beritaList ?? [
                [
                    'badge' => 'Pengumuman', 'badge_class' => 'pengumuman',
                    'gambar' => 'https://images.unsplash.com/photo-1521302080334-4bebac2763a6?w=500',
                    'judul' => 'Pemprov Kaltim Perkuat Layanan Darurat 112 di Kutai Timur',
                    'ringkasan' => 'Pemerintah Provinsi Kalimantan Timur berkomitmen memperkuat layanan darurat 112 untuk masyarakat Kutai...',
                    'tanggal' => '22 Jan 2025',
                    'slug' => 'pemprov-kaltim-perkuat-layanan-darurat-112',
                ],
                [
                    'badge' => 'Kegiatan', 'badge_class' => 'kegiatan',
                    'gambar' => 'https://images.unsplash.com/photo-1560439514-4e9645039924?w=500',
                    'judul' => 'Sosialisasi Penggunaan Layanan 112 di Kecamatan Sangatta Utara',
                    'ringkasan' => 'Tim Diskominfo Staper Kutim melaksanakan sosialisasi tentang cara penggunaan layanan darurat 112 kepada...',
                    'tanggal' => '20 Jan 2025',
                    'slug' => 'sosialisasi-penggunaan-layanan-112-sangatta-utara',
                ],
                [
                    'badge' => 'Statistik', 'badge_class' => 'statistik',
                    'gambar' => 'https://images.unsplash.com/photo-1541864890574-2c9fb28b30c7?w=500',
                    'judul' => 'Layanan 112 Berhasil Tangani 50 Kasus Darurat di Januari 2025',
                    'ringkasan' => 'Sepanjang Januari 2025, layanan 112 Kutai Timur berhasil menangani 50 kasus darurat yang terdiri dari ketertiban...',
                    'tanggal' => '18 Jan 2025',
                    'slug' => 'layanan-112-tangani-50-kasus-darurat-januari-2025',
                ],
                [
                    'badge' => 'Kegiatan', 'badge_class' => 'kegiatan',
                    'gambar' => 'https://images.unsplash.com/photo-1587979566642-fa79e3b48a4e?w=500',
                    'judul' => 'Pelatihan Tim Respons Cepat Kabupaten Kutai Timur',
                    'ringkasan' => 'Diskominfo Staper Kutim menggelar pelatihan intensif bagi tim respons cepat yang akan bertugas menanggapi laporan...',
                    'tanggal' => '15 Jan 2025',
                    'slug' => 'pelatihan-tim-respons-cepat-kutai-timur',
                ],
            ];
        @endphp

        @foreach($beritaList as $berita)
            <div class="col-md-6 col-lg-4">
                <div class="card news-card">
                    <img src="{{ $berita['gambar'] }}" alt="{{ $berita['judul'] }}">
                    <div class="card-body">
                        <span class="news-badge {{ $berita['badge_class'] }}">{{ $berita['badge'] }}</span>
                        <h6>{{ $berita['judul'] }}</h6>
                        <p class="mb-0">{{ $berita['ringkasan'] }}</p>
                        <div class="news-footer">
                            <span class="news-date">{{ $berita['tanggal'] }}</span>
                            <a href="{{ route('berita.show', $berita['slug']) }}" class="news-read">Baca &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Contoh pagination, aktifkan kalau $beritaList berasal dari Eloquent paginate() --}}
    {{-- <div class="d-flex justify-content-center mb-5">{{ $beritaList->links() }}</div> --}}
</div>

<!-- ===== Footer ===== -->
<footer class="footer-saat">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand">
                    <span class="footer-emergency-icon"><i class="bi bi-shield-fill-check"></i></span>
                    <span>
                        <span class="d-block footer-brand-title">SAAT 112</span>
                        <span class="d-block footer-brand-sub">Sistem Aplikasi Alerting Terpadu</span>
                    </span>
                </div>
                <p class="small-text">
                    Layanan darurat terpadu untuk masyarakat Kabupaten Kutai Timur, Kalimantan Timur.
                </p>
                <p class="small-text mb-0">Diskominfo Staper Kutim &copy; 2025</p>
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
                    <span class="footer-emergency-icon" style="width:32px;height:32px;font-size:.85rem;">
                        <i class="bi bi-telephone-fill"></i>
                    </span>
                    <div>
                        <div class="fw-semibold text-white">112</div>
                        <div class="small-text">Bebas Pulsa 24 Jam</div>
                    </div>
                </div>
                <div class="small-text mb-1">saat112@kutimkab.go.id</div>
                <div class="small-text">Jl. Soekarno-Hatta, Sangatta</div>
            </div>
        </div>
        <div class="footer-bottom">
            Dikelola oleh Dinas Komunikasi dan Informatika Statistik dan Persandian Kabupaten Kutai Timur
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>