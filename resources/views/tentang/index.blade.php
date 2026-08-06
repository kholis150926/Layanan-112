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

        /* ===== Hero (dipakai ulang untuk header halaman Tentang) ===== */
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
        .hero-card h1 { font-weight: 800; font-size: 2.1rem; }
        .hero-card p { color: rgba(255,255,255,.85); max-width: 560px; }

        /* ===== Section titles ===== */
        .section-title { font-weight: 700; font-size: 1.15rem; color: #111827; }

        /* ===== Content cards (halaman Tentang) ===== */
        .info-card {
            background: #fff; border-radius: 18px; padding: 1.4rem;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
            height: 100%;
        }
        .info-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; flex-shrink: 0;
        }
        .info-icon.blue { background: #e0edff; color: var(--brand-blue); }
        .info-icon.red { background: #fde8e8; color: var(--brand-red); }
        .info-card h6 { font-weight: 700; margin-bottom: .3rem; }
        .info-card p { font-size: .85rem; color: #6b7280; margin-bottom: 0; }
        .mitra-chip {
            border: 1px solid #eef0f4; border-radius: 12px;
            text-align: center; padding: .9rem .6rem;
            font-size: .85rem; font-weight: 500; color: #374151;
            background: #fafbfd;
        }

        /* ===== Footer ===== */
        .footer-saat { background: #10182b; color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 3rem; }
        .footer-saat h6 { color: #fff; font-weight: 700; }
        .footer-saat a { color: #9aa5b8; font-size: .88rem; }
        .footer-saat a:hover { color: #fff; }
        .footer-saat .footer-brand { display: flex; align-items: center; gap: .6rem; margin-bottom: .8rem; }
        .footer-saat p.small-text { font-size: .85rem; color: #9aa5b8; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 2rem; padding-top: 1.2rem; font-size: .78rem; color: #6b7280; text-align: center; }

        /* Ukuran logo dibuat lebih besar & proporsional */
        .mitra-img {
            width: 55px;          /* Bisa disesuaikan, contoh: 50px - 65px */
            height: 55px;         
            object-fit: contain;  /* Biar gambar ga terdistorsi/gepeng */
        }

        /* Styling card mitra agar ada jarak dan sudut tumpul yang bagus */
        .mitra-chip {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
        }

        /* Efek hover halus (opsional, bikin makin keren) */
        .mitra-chip:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .mitra-chip span {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
        }
    </style>
</head>
<body>

    {{-- ===== Navbar ===== disalin persis dari dashboard.blade.php / berita/index.blade.php --}}
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('kritik-saran') ? 'active' : '' }}" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
                </ul>
                {{-- <a href="#" class="admin-link me-3">Admin</a> --}}
            </div>
        </div>
    </nav>

    <div class="container py-5">

        {{-- ===== Hero ===== --}}
        <div class="hero-card mb-5">
            <span class="badge-soft mb-3 d-inline-block">Tentang Layanan</span>
            <h1>Kutim Siaga 112</h1>
            <p>
                Kutim Siaga merupakan layanan gawat darurat Kabupaten Kutai Timur.
                Segala bentuk penyalahgunaan layanan ini akan ditindak sesuai peraturan yang berlaku.
            </p>
        </div>

        {{-- ===== Tugas Call Center ===== --}}
        <div class="mb-5">
            <h2 class="section-title mb-4">
                <i class="bi bi-clipboard-check text-primary me-2"></i>Tugas Call Center
            </h2>
            <div class="info-card">
                <ul class="list-unstyled mb-0">
                    @php
                        $tugasCallCenter = [
                            'Menerima panggilan darurat.',
                            'Menganalisa informasi yang diterima.',
                            'Menentukan dan mengirimkan keadaan darurat kepada perangkat daerah dan instansi terkait.',
                            'Mencatat informasi pada aplikasi.',
                            'Memantau tindak lanjut laporan.',
                            'Melaporkan hasil tindak lanjut panggilan darurat setiap bulan.',
                        ];
                    @endphp
                    @foreach($tugasCallCenter as $tugas)
                        <li class="d-flex mb-2">
                            <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                            <span>{{ $tugas }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- ===== Alur Kerja ===== --}}
        <div class="mb-5">
            <h2 class="section-title mb-4">
                <i class="bi bi-telephone-fill text-primary me-2"></i>Alur Kerja Call Center 112
            </h2>
            <div class="row g-3">
                @php
                    $alurKerja = [
                        ['title' => 'Pelapor', 'icon' => 'bi-person-fill', 'desc' => 'Melapor kejadian ke Call Center 112.'],
                        ['title' => 'Call Taker', 'icon' => 'bi-headset', 'desc' => 'Mencatat identitas dan alamat pelapor serta informasi kejadian, lalu meneruskan ke Admin OPD (Dispatcher) terkait.'],
                        ['title' => 'Responder', 'icon' => 'bi-shield-fill-exclamation', 'desc' => 'Tim lapangan yang ditugaskan Admin OPD untuk menindaklanjuti laporan.'],
                        ['title' => 'OPD / Komunitas', 'icon' => 'bi-chat-square-text-fill', 'desc' => 'Admin OPD mengonfirmasi ulang ke Call Center 112 bahwa informasi sudah ditindaklanjuti, lalu Call Center menutup laporan.'],
                    ];
                @endphp
                @foreach($alurKerja as $i => $step)
                    <div class="col-md-3 col-sm-6">
                        <div class="info-card">
                            <div class="info-icon blue mb-3">
                                <i class="bi {{ $step['icon'] }}"></i>
                            </div>
                            <h6>{{ $i + 1 }}. {{ $step['title'] }}</h6>
                            <p>{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5">
            <h2 class="section-title mb-4">Kejadian yang Bisa Dilayani 112</h2>
            <div class="row g-3">
                @php
                    $kejadianDilayani = [
                        ['title' => 'Kesehatan', 'icon' => 'bi-heart-pulse-fill', 'desc' => 'Ambulance transportasi, ambulance gawat darurat, dan home care.'],
                        ['title' => 'Bencana alam', 'icon' => 'bi-cloud-lightning-rain-fill', 'desc' => 'Tanah longsor, pohon tumbang, banjir, gempa bumi, dan rumah roboh.'],
                        ['title' => 'Penyelamatan', 'icon' => 'bi-fire', 'desc' => 'Kebakaran, evakuasi hewan buas maupun non-buas, penanganan bencana, penyelamatan dan pertolongan.'],
                        ['title' => 'Kamtibmas', 'icon' => 'bi-shield-lock-fill', 'desc' => 'Kerusuhan, balap liar, tindak kriminal, gangguan kamtibmas, ODGJ, PGOT, kekerasan pada perempuan dan anak, gangguan lalu lintas, dan pelanggaran perda.'],
                        ['title' => 'Darurat lainnya', 'icon' => 'bi-exclamation-triangle-fill', 'desc' => 'Pipa bocor, jalan rusak, tiang roboh, konsleting listrik, kabel menjuntai, dan permohonan air bersih.'],
                    ];
                @endphp
                @foreach($kejadianDilayani as $k)
                    <div class="col-md-6">
                        <div class="info-card d-flex gap-3">
                            <div class="info-icon red">
                                <i class="bi {{ $k['icon'] }}"></i>
                            </div>
                            <div>
                                <h6>{{ $k['title'] }}</h6>
                                <p>{{ $k['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="section-title mb-4">
                <i class="bi bi-shield-check text-primary me-2"></i>Mitra 112
            </h2>
            <div class="info-card">
                <div class="row g-3">
                    @php
                        $mitra112 = [
                            ['nama' => 'Yudha Brama Jaya', 'logo' => 'damkar.png'],
                            ['nama' => 'SAR Nasional', 'logo' => 'sar.png'],
                            ['nama' => 'BPBD', 'logo' => 'bpbd.png'],
                            ['nama' => 'Palang Merah Indonesia', 'logo' => 'pmi.png'],
                            ['nama' => 'PLN', 'logo' => 'pln.png'],
                            ['nama' => 'Polres Kutai Timur', 'logo' => 'polres.png'],
                        ];
                    @endphp
                    @foreach($mitra112 as $mitra)
                        <div class="col-md-4 col-6">
                            <div class="mitra-chip d-flex flex-column align-items-center justify-content-center text-center p-3">
                                <img src="{{ asset('image/mitra/' . $mitra['logo']) }}" alt="{{ $mitra['nama'] }}" class="mitra-img">
                                <span>{{ $mitra['nama'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Footer ===== ganti dengan @include('layouts.footer') kalau footer aslinya ada di partial terpisah --}}
    <footer class="footer-saat">
        <div class="container">
            <div class="footer-bottom">
                &copy; {{ date('Y') }} SAAT 112 - Pemerintah Kabupaten Kutai Timur
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>