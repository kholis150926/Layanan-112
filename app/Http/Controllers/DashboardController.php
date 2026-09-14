<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan112;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data statis — ganti dengan query ke database sesuai kebutuhan
        $totalPetugas   = 2;
        $totalKecamatan = 18;

        $kecamatanTeratas = [
            ['nama' => 'Sangatta Utara',   'jumlah' => 58, 'rank' => 1],
            ['nama' => 'Sangatta Selatan', 'jumlah' => 45, 'rank' => 2],
            ['nama' => 'Kaliorang',        'jumlah' => 26, 'rank' => 3],
            ['nama' => 'Bengalon',         'jumlah' => 21, 'rank' => 4],
            ['nama' => 'Kaubun',           'jumlah' => 21, 'rank' => 5],
        ];

        $beritaList = [
            [
                'badge'       => 'Pengumuman',
                'badge_class' => 'pengumuman',
                'gambar'      => 'https://images.unsplash.com/photo-1521302080334-4bebac2763a6?w=500',
                'judul'       => 'Perupsov Kaltim Perluas Layanan Darurat 112 di Kutai Timur',
                'ringkasan'   => 'Pemerintah Provinsi Kalimantan Timur bekerjasama mempercepat layanan darurat 112 untuk masyarakat Kutai Timur...',
                'tanggal'     => '27 Jan 2026',
            ],
            [
                'badge'       => 'Sosialisasi',
                'badge_class' => 'sosialisasi',
                'gambar'      => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?w=500',
                'judul'       => 'Sosialisasi Penggunaan Layanan 112 di Kecamatan Sangatta Utara',
                'ringkasan'   => 'Tim Diskominfo Kutai Timur melakukan sosialisasi tentang cara penggunaan layanan 112 kepada masyarakat...',
                'tanggal'     => '18 Jan 2026',
            ],
            [
                'badge'       => 'Rilis',
                'badge_class' => 'rilis',
                'gambar'      => 'https://images.unsplash.com/photo-1541864890574-2c9fb28b30c7?w=500',
                'judul'       => 'Layanan 112 Berhasil Tangani 50 Kasus Darurat di Bulan Januari 2024',
                'ringkasan'   => 'Sepanjang Januari 2024, layanan 112 Kutai Timur berhasil menangani 50 kasus darurat yang timbul...',
                'tanggal'     => '15 Jan 2026',
            ],
        ];

        return view('dashboard', compact(
            'totalPetugas',
            'totalKecamatan',
            'kecamatanTeratas',
            'beritaList'
        ));
    }

    // --- METHOD UNTUK AMBIL DATA GEOJSON PETA BERANDA ---
    public function petaData()
    {
        $path = storage_path('geojson-raw/kaltim.geojson');

        if (!file_exists($path)) {
            $path = storage_path('app/public/geojson-raw/kaltim.geojson');
        }

        if (!file_exists($path)) {
            return response()->json(['error' => 'File GeoJSON tidak ditemukan'], 404);
        }

        $content = file_get_contents($path);
        $geojson = json_decode($content, true);

        if (!$geojson || !isset($geojson['features'])) {
            return response()->json(['error' => 'Format file GeoJSON tidak valid'], 500);
        }

        // Filter khusus Kutai Timur
        $kutaiTimurFeatures = array_filter($geojson['features'], function ($feature) {
            $props = $feature['properties'] ?? [];
            $kabupaten = $props['kabupaten'] 
                      ?? $props['KABUPATEN'] 
                      ?? $props['WADMKK'] 
                      ?? $props['KAB_KOTA'] 
                      ?? '';

            return stripos($kabupaten, 'Kutai Timur') !== false;
        });

        // Ambil data statistik dari database (jika model Layanan112 ada)
        $laporanData = [];
        if (class_exists('App\Models\Layanan112')) {
            $laporanData = Layanan112::query()
                ->select('kecamatan', 'jenis_laporan', DB::raw('count(*) as total'))
                ->groupBy('kecamatan', 'jenis_laporan')
                ->get()
                ->groupBy('kecamatan');
        }

        $filteredFeatures = [];
        foreach ($kutaiTimurFeatures as $feature) {
            $props = $feature['properties'] ?? [];

            $namaKec = $props['kecamatan'] 
                    ?? $props['KECAMATAN'] 
                    ?? $props['WADMKC'] 
                    ?? $props['NAMOBJ'] 
                    ?? null;

            $feature['properties']['kecamatan'] = $namaKec;
            $feature['properties']['kode_kec'] = $props['kode_kec'] ?? $props['KODE_KEC'] ?? $namaKec;

            if ($namaKec && isset($laporanData[$namaKec])) {
                $stats = [];
                foreach ($laporanData[$namaKec] as $item) {
                    $stats[$item->jenis_laporan] = $item->total;
                }
                $feature['properties']['statistik'] = $stats;
            } else {
                $feature['properties']['statistik'] = (object)[];
            }

            $filteredFeatures[] = $feature;
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => array_values($filteredFeatures)
        ]);
    }
}