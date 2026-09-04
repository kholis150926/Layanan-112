<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritik & Saran - SAAT 112</title>

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
        .admin-link { color: #9ca3af; font-size: .88rem; }

        .page-title { color: #9ca3af; font-weight: 500; margin: 1.5rem 0 1rem; }

        /* ===== Header Kritik & Saran ===== */
        .ks-header { text-align: center; margin-bottom: 2rem; }
        .ks-header h2 { color: var(--brand-blue); font-weight: 700; font-size: 1.6rem; }
        .ks-header p { color: #6b7280; font-size: .9rem; max-width: 520px; margin: .4rem auto 0; }

        /* ===== Form Card ===== */
        .ks-form-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.2rem;
            box-shadow: 0 2px 14px rgba(0,0,0,.05);
            max-width: 720px;
            margin: 0 auto 3rem;
        }
        .ks-form-card label {
            font-weight: 600; font-size: .85rem; color: #111827; margin-bottom: .4rem;
        }
        .ks-form-card .form-control {
            border-radius: 10px; border: 1px solid #e5e7eb;
            padding: .6rem .9rem; font-size: .9rem;
        }
        .ks-form-card .form-control:focus {
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 .2rem rgba(47,111,237,.15);
        }

        .jenis-masukan-group { display: flex; gap: .6rem; }
        .btn-check + .btn-jenis {
            flex: 1;
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #374151;
            font-weight: 500;
            font-size: .88rem;
            border-radius: 10px;
            padding: .6rem;
        }
        .btn-check:checked + .btn-jenis {
            background: var(--brand-blue-dark);
            border-color: var(--brand-blue-dark);
            color: #fff;
        }

        .btn-kirim {
            background: var(--brand-blue);
            color: #fff; font-weight: 600; font-size: .95rem;
            border-radius: 10px; padding: .75rem;
            border: none; width: 100%;
        }
        .btn-kirim:hover { color: #fff; opacity: .92; }
        .btn-kirim:disabled { background: #9aa8c7; opacity: 1; }

        /* ===== Pilihan Anonim ===== */
        .anonymous-option {
            margin-bottom: 18px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #f8faff;
        }

        .anonymous-checkbox {
            display: flex;
            align-items: center;
            gap: 9px;
            cursor: pointer;
            font-weight: 600;
            font-size: .85rem;
            color: #111827;
            margin-bottom: 0;
        }

        .anonymous-checkbox input {
            width: 18px;
            height: 18px;
            accent-color: var(--brand-blue);
            cursor: pointer;
        }

        .anonymous-option small {
            display: block;
            margin-left: 27px;
            margin-top: 4px;
            color: #9ca3af;
            font-size: .75rem;
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
                <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galery') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-title">Kritik dan Saran</div>

    <!-- ===== Header ===== -->
    <div class="ks-header">
        <h2>Kritik & Saran</h2>
        <p>Masukan Anda sangat berarti untuk meningkatkan kualitas layanan darurat 112 Kutai Timur.</p>
    </div>

    <!-- ===== Alert sukses / error ===== -->
    @if(session('success'))
        <div class="alert alert-success" style="max-width:720px;margin:0 auto 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- ===== Form Card ===== -->
    <div class="ks-form-card">
        <form method="POST" action="{{ route('kritik-saran.store') }}">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="nama">Nama (opsional)</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                           placeholder="Nama Anda" value="{{ old('nama') }}">
                </div>
                <div class="col-md-6">
                    <label for="kontak">Kontak (opsional)</label>
                    <input type="kontak" name="kontak" id="kontak" class="form-control"
                           placeholder="08xxx" value="{{ old('kontak') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="d-block">Jenis Masukan</label>
                <div class="jenis-masukan-group">
                    @php
                        $jenisOptions = ['kritik' => 'Kritik', 'saran' => 'Saran', 'apresiasi' => 'Apresiasi'];
                        $jenisTerpilih = old('jenis', 'kritik');
                    @endphp
                    @foreach($jenisOptions as $value => $label)
                        <input type="radio" class="btn-check" name="jenis" id="jenis-{{ $value }}"
                               value="{{ $value }}" autocomplete="off"
                               {{ $jenisTerpilih === $value ? 'checked' : '' }}>
                        <label class="btn-jenis" for="jenis-{{ $value }}">{{ $label }}</label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label for="pesan">Pesan <span class="text-danger">*</span></label>
                <textarea name="pesan" id="pesan" rows="5" class="form-control" required
                          placeholder="Tuliskan kritik, saran, atau apresiasi Anda untuk layanan 112 Kutai Timur...">{{ old('pesan') }}</textarea>
                @error('pesan')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- ===== Pilihan Anonim ===== -->
            <div class="anonymous-option">
                <label class="anonymous-checkbox">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                        {{ old('is_anonymous') ? 'checked' : '' }}>
                    <span>Kirim sebagai anonim</span>
                </label>

                <small>
                    Nama dan kontak Anda tidak akan ditampilkan.
                </small>
            </div>

            <button type="submit" class="btn-kirim">
                <i class="bi bi-send-fill me-1"></i> Kirim Masukan
            </button>
        </form>
    </div>
</div>

    <!-- ===== Footer ===== -->
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
                        <a href="{{ route('kritik-saran') }}">Kritik & Saran</a>
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
</body>
</html>