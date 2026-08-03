<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Layanan - SAAT 112</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            color: #fff; font-weight: 600; background: var(--brand-blue);
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

        .page-title { color: #9ca3af; font-weight: 500; margin: 1.5rem 0 1rem; }

        /* ===== Intro Card ===== */
        .intro-card {
            background: linear-gradient(135deg, #eaf0ff 0%, #f2f6ff 100%);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
        }
        .intro-icon {
            width: 56px; height: 56px;
            background: var(--brand-blue);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.4rem;
            margin: 0 auto 1rem;
        }
        .intro-card h2 { color: var(--brand-blue); font-weight: 700; font-size: 1.5rem; }
        .intro-card p { color: #6b7280; max-width: 560px; margin: .6rem auto 0; font-size: .92rem; }

        /* ===== Visi Misi ===== */
        .vm-card {
            background: #fff; border-radius: 16px; padding: 1.6rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            height: 100%;
        }
        .vm-icon {
            width: 38px; height: 38px;
            background: #eef2ff; color: var(--brand-blue);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: .8rem; font-size: 1rem;
        }
        .vm-card h6 { font-weight: 700; margin-bottom: .5rem; }
        .vm-card p { font-size: .85rem; color: #6b7280; margin-bottom: 0; }

        /* ===== Section title ===== */
        .section-title { font-weight: 700; font-size: 1.15rem; color: #111827; }

        /* ===== Layanan Kami ===== */
        .layanan-card {
            background: #fff; border-radius: 16px; padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            text-align: center; height: 100%;
        }
        .layanan-icon {
            width: 46px; height: 46px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto .8rem; font-size: 1.2rem;
        }
        .layanan-icon.kebakaran { background: #fde8e8; color: var(--brand-red); }
        .layanan-icon.medis { background: #ffe4ec; color: #e0498a; }
        .layanan-icon.keamanan { background: #e0edff; color: var(--brand-blue); }
        .layanan-icon.bencana { background: #fff3e0; color: #f59e0b; }
        .layanan-card h6 { font-weight: 700; font-size: .92rem; margin-bottom: .4rem; }
        .layanan-card p { font-size: .8rem; color: #6b7280; margin-bottom: 0; }

        /* ===== Capaian Layanan ===== */
        .capaian-card {
            background: linear-gradient(135deg, #3b6df0 0%, #2440c9 100%);
            border-radius: 20px;
            padding: 2rem;
            color: #fff;
        }
        .capaian-card h6 { font-weight: 700; font-size: 1.05rem; margin-bottom: 1.5rem; }
        .capaian-stat {
            background: rgba(255,255,255,.12);
            border-radius: 14px;
            text-align: center;
            padding: 1.2rem .6rem;
            height: 100%;
        }
        .capaian-stat .num { font-size: 1.7rem; font-weight: 800; }
        .capaian-stat .label { font-size: .75rem; color: rgba(255,255,255,.8); margin-top: .2rem; }

        /* ===== Kontak & Lokasi ===== */
        .kontak-card {
            background: #fff; border-radius: 16px; padding: 1.3rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            display: flex; align-items: center; gap: 1rem;
            height: 100%;
        }
        .kontak-icon {
            width: 40px; height: 40px; border-radius: 50%;
            background: #eef2ff; color: var(--brand-blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .kontak-card .label { font-size: .75rem; color: #9ca3af; }
        .kontak-card .value { font-weight: 600; font-size: .92rem; color: #111827; }

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
                <li class="nav-item"><a class="nav-link active" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-title">Profil</div>

    <!-- ===== Intro ===== -->
    <div class="intro-card mb-5">
        <div class="intro-icon"><i class="bi bi-shield-fill-check"></i></div>
        <h2>Profil Layanan 112</h2>
        <p>
            Layanan 112 adalah nomor darurat nasional Indonesia yang dikoordinasikan oleh Dinas
            Komunikasi, Informatika dan Persandian Kabupaten Kutai Timur sebagai pusat koordinasi
            penanganan kejadian darurat.
        </p>
    </div>

    <!-- ===== Visi Misi ===== -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="vm-card">
                <div class="vm-icon"><i class="bi bi-star-fill"></i></div>
                <h6>Visi</h6>
                <p>
                    Terwujudnya sistem layanan darurat cepat, tepat, dan terintegrasi
                    keselamatan masyarakat Kabupaten Kutai Timur yang lebih aman dan nyaman.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="vm-card">
                <div class="vm-icon"><i class="bi bi-star-fill"></i></div>
                <h6>Misi</h6>
                <p>
                    Memberikan sistem layanan darurat yang cepat, responsif, dan terintegrasi
                    dengan seluruh perangkat kerja terkait demi keselamatan masyarakat Kutai Timur.
                </p>
            </div>
        </div>
    </div>

    <!-- ===== Layanan Kami ===== -->
    <h5 class="section-title mb-3">Layanan Kami</h5>
    <div class="row g-4 mb-5">
        @php
            $layananKami = $layananKami ?? [
                [
                    'icon' => 'bi-fire', 'class' => 'kebakaran',
                    'judul' => 'Kebakaran',
                    'desk' => 'Penanganan kebakaran kebangunan, lahan, dan hutan di wilayah Kutai Timur.',
                ],
                [
                    'icon' => 'bi-heart-pulse-fill', 'class' => 'medis',
                    'judul' => 'Darurat Medis',
                    'desk' => 'Bantuan medis darurat untuk kecelakaan, sakit mendadak, dan kondisi kritis lainnya.',
                ],
                [
                    'icon' => 'bi-shield-lock-fill', 'class' => 'keamanan',
                    'judul' => 'Keamanan',
                    'desk' => 'Penanganan gangguan keamanan, kriminalitas, dan ketertiban masyarakat.',
                ],
                [
                    'icon' => 'bi-exclamation-triangle-fill', 'class' => 'bencana',
                    'judul' => 'Bencana Alam',
                    'desk' => 'Penanganan bencana alam seperti banjir, longsor, angin puting beliung, dan lainnya.',
                ],
            ];
        @endphp

        @foreach($layananKami as $layanan)
            <div class="col-6 col-md-3">
                <div class="layanan-card">
                    <div class="layanan-icon {{ $layanan['class'] }}">
                        <i class="bi {{ $layanan['icon'] }}"></i>
                    </div>
                    <h6>{{ $layanan['judul'] }}</h6>
                    <p>{{ $layanan['desk'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ===== Capaian Layanan ===== -->
    <div class="capaian-card mb-5">
        <h6>Capaian Layanan 2024</h6>
        <div class="row g-3">
            @php
                $capaian = $capaian ?? [
                    ['num' => '1.240+', 'label' => 'Laporan Ditangani'],
                    ['num' => '< 8 mnt', 'label' => 'Rata-rata Respon'],
                    ['num' => '18', 'label' => 'Kecamatan Terjangkau'],
                    ['num' => '98%', 'label' => 'Tingkat Kepuasan'],
                ];
            @endphp
            @foreach($capaian as $item)
                <div class="col-6 col-md-3">
                    <div class="capaian-stat">
                        <div class="num">{{ $item['num'] }}</div>
                        <div class="label">{{ $item['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ===== Kontak & Lokasi ===== -->
    <h5 class="section-title mb-3">Kontak & Lokasi</h5>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="kontak-card">
                <div class="kontak-icon"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <div class="label">Telepon Darurat</div>
                    <div class="value">112</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kontak-card">
                <div class="kontak-icon"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <div class="label">Email</div>
                    <div class="value">saat112@kutaitimurkab.go.id</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kontak-card">
                <div class="kontak-icon"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <div class="label">Alamat</div>
                    <div class="value">Jl. Soekarno-Hatta, Sangatta</div>
                </div>
            </div>
        </div>
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
</body>
</html>