<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Layanan 112 - Kutai Timur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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

        .navbar-saat { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: .75rem 0; }
        .navbar-saat .brand-icon {
            width: 38px; height: 38px; background: var(--brand-blue); border-radius: 10px;
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.1rem;
        }
        .navbar-saat .brand-title { font-weight: 700; font-size: 1.05rem; line-height: 1.1; color: #111827; }
        .navbar-saat .brand-sub { font-size: .72rem; color: #9ca3af; }
        .navbar-saat .nav-link { color: #374151; font-weight: 500; font-size: .92rem; padding: .4rem .9rem; }
        .navbar-saat .nav-link.active { color: var(--brand-blue); font-weight: 600; }

        #map { height: 620px; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .page-title { font-weight: 700; font-size: 1.3rem; color: #111827; }
    </style>
</head>
<body>

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
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('peta.kutai-timur') }}">Peta Layanan</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div class="page-title">Peta Wilayah Kabupaten Kutai Timur</div>
        <select id="cariKecamatan" class="form-select w-auto">
            <option value="">Cari Kecamatan</option>
        </select>
    </div>

    <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const map = L.map('map').setView([1.35, 117.4], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    fetch("{{ route('peta.kutai-timur.data') }}")
        .then(res => res.json())
        .then(geojson => {
            const layer = L.geoJSON(geojson, {
                style: {
                    fillColor: '#2f6fed',
                    fillOpacity: 0.35,
                    color: '#1e3a8a',
                    weight: 1.5,
                },
                onEachFeature: (feature, lyr) => {
                    lyr.bindPopup(`<b>${feature.properties.kecamatan}</b>`);
                    
                    lyr.on('mouseover', () => lyr.setStyle({ fillOpacity: 0.65, weight: 2.5 }));
                    lyr.on('mouseout',  () => lyr.setStyle({ fillOpacity: 0.35, weight: 1.5 }));

                    const opt = document.createElement('option');
                    opt.value = feature.properties.kode_kec;
                    opt.textContent = feature.properties.kecamatan;
                    document.getElementById('cariKecamatan').appendChild(opt);
                }
            }).addTo(map);

            map.fitBounds(layer.getBounds());

            document.getElementById('cariKecamatan').addEventListener('change', function (e) {
                layer.eachLayer(l => {
                    if (l.feature.properties.kode_kec === e.target.value) {
                        map.fitBounds(l.getBounds());
                        l.openPopup();
                    }
                });
            });
        })
        .catch(err => console.error("Gagal memuat peta GeoJSON:", err));
});
</script>
</body>
</html>