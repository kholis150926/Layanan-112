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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        .footer-emergency-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #fff; }

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
        /* ===== SweetAlert custom - Mitra 112 ===== */
        .mitra-alert-popup {
            border-radius: 24px !important;
            padding: 2rem 1.5rem 1.8rem !important;
        }

        .mitra-alert-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #3b6df0, #274edc);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(47, 111, 237, 0.35);
        }

        .mitra-alert-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: #111827;
            margin-bottom: 2px;
        }

        .mitra-alert-sub {
            font-size: .85rem;
            color: #9ca3af;
            margin-bottom: 1.2rem;
        }

        .mitra-alert-detail {
            background: #f4f6fb;
            border-radius: 14px;
            padding: .9rem 1rem;
            text-align: left;
        }

        .mitra-alert-row {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .88rem;
            color: #374151;
            padding: .35rem 0;
        }

        .mitra-alert-row i {
            color: #2f6fed;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .mitra-alert-btn {
            background: var(--brand-blue);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: .55rem 1.8rem;
            font-size: .9rem;
            margin-top: 1.2rem;
        }

        .mitra-alert-btn:hover {
            opacity: .9;
        }
    </style>
</head>
<body>

    {{-- ===== Navbar ===== disalin persis dari dashboard.blade.php / berita/index.blade.php --}}
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
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galery') ? 'active' : '' }}" href="{{ route('galery') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kritik-saran') ? 'active' : '' }}" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>

            <!-- Tombol Login Admin di Kanan Atas -->
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <a href="{{ url('/admin/login') }}" class="btn btn-outline-primary rounded-pill px-3 py-1-5 d-flex align-items-center gap-2 fw-semibold btn-sm">
                    <i class="bi bi-person-lock fs-6"></i>
                    <span>Login Admin</span>
                </a>
            </div>
        </div>
    </div>
</nav>

    <div class="container py-5">

        {{-- ===== Hero ===== --}}
        <div class="hero-card mb-5">
            <span class="badge-soft mb-3 d-inline-block">Tentang Layanan</span>
            <h1>Saat 112</h1>
            <p>
                Saat 112 merupakan layanan gawat darurat Kabupaten Kutai Timur.
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
                            ['nama' => 'Yudha Brama Jaya', 'logo' => 'damkar.png', 'telepon' => '(0549) 23113', 'alamat' => 'Dinas Pemadam Kebakaran dan Penyelamatan Kabupaten Kutai Timur, Jl. Pendidikan, Teluk Lingga, Kec. Sangatta Utara, Kutai Timur, Kalimantan Timur 75683.'],
                            ['nama' => 'SAR Nasional', 'logo' => 'sar.png', 'telepon' => '115', 'alamat' => 'Pos SAR Sangatta, Jl. Aw. Syahrani / Jl. Pendidikan No. Km. 05, RT 22/RW 38, Sangatta Utara, Kec. Sangatta Utara, Kutai Timur, Kalimantan Timur.'],
                            ['nama' => 'BPBD', 'logo' => 'bpbd.png', 'telepon' => '0813-4125-7909', 'alamat' => 'Jl. Soekarno Hatta No. 4G, Sangatta Utara, Kutai Timur, Kalimantan Timur 75683. Ini alamat yang tercantum dalam profil resmi BPBD Kutai Timur 2025'],
                            ['nama' => 'Palang Merah Indonesia', 'logo' => 'pmi.png', 'telepon' => '0811-525-354', 'alamat' => 'Singa Gembara, Kec. Sangatta Utara, Kabupaten Kutai Timur, Kalimantan Timur 75683.'],
                            ['nama' => 'PLN', 'logo' => 'pln.png', 'telepon' => '123', 'alamat' => 'Jl. Yos Sudarso IV, Swarga Bara, Kec. Sangatta Utara, Kabupaten Kutai Timur, Kalimantan Timur 75683.'],
                            ['nama' => 'Polres Kutai Timur', 'logo' => 'polres.png', 'telepon' => '110', 'alamat' => 'Jl. Bhayangkara, Teluk Lingga, Kec. Sangatta Utara, Kabupaten Kutai Timur, Kalimantan Timur 75683.'],
                        ];
                    @endphp
                    @foreach($mitra112 as $mitra)
                        <div class="col-md-4 col-6">
                            <div class="mitra-chip d-flex flex-column align-items-center justify-content-center text-center p-3"
                                style="cursor: pointer;"
                                onclick="showMitraDetail(this)"
                                data-nama="{{ $mitra['nama'] }}"
                                data-telepon="{{ $mitra['telepon'] }}"
                                data-alamat="{{ $mitra['alamat'] }}">
                                <img src="{{ asset('image/mitra/' . $mitra['logo']) }}" alt="{{ $mitra['nama'] }}" class="mitra-img">
                                <span>{{ $mitra['nama'] }}</span>
                            </div>
                        </div>
                    @endforeach
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
                        <li><a href="{{ route('laporan.index') }}">Tentang</a></li>
                        <li><a href="{{ route('galery') }}">Galeri</a></li>
                        <a href="{{ route('kritik-saran') }}">Kritik & Saran</a>
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
    <script>
        function showMitraDetail(el) {
            const nama = el.dataset.nama;
            const telepon = el.dataset.telepon;
            const alamat = el.dataset.alamat;

            Swal.fire({
                html: `
                    <div class="mitra-alert-icon">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <h5 class="mitra-alert-title">${nama}</h5>
                    <p class="mitra-alert-sub">Informasi kontak dan alamat mitra 112</p>

                    <div class="mitra-alert-detail">
                        <div class="mitra-alert-row">
                            <i class="bi bi-telephone-fill"></i>
                            <span>${telepon}</span>
                        </div>
                        <div class="mitra-alert-row">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>${alamat}</span>
                        </div>
                    </div>
                `,
                showConfirmButton: true,
                confirmButtonText: 'Tutup',
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    popup: 'mitra-alert-popup',
                    confirmButton: 'mitra-alert-btn'
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>