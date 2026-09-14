<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Laporan; 
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPetugas   = 2;
        $totalKecamatan = 18;

        // Ambil Top 5 Kecamatan langsung dari tabel statistik admin
        $kecamatanTeratas = Laporan::select('kecamatan', DB::raw('count(*) as jumlah'))
            ->groupBy('kecamatan')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $beritaTerbaru = Berita::latest() 
            ->take(3)                    
            ->get();

        return view('dashboard', compact(
            'totalPetugas',
            'totalKecamatan',
            'kecamatanTeratas',
            'beritaTerbaru'
        ));
    }

    public function petaData()
    {
        $path = storage_path('geojson-raw/kaltim.geojson');
        if (!file_exists($path)) {
            $path = storage_path('app/public/geojson-raw/kaltim.geojson');
        }
        if (!file_exists($path)) {
            $path = public_path('geojson/kaltim.geojson');
        }

        if (!file_exists($path)) {
            return response()->json(['error' => 'File GeoJSON tidak ditemukan'], 404);
        }

        $content = file_get_contents($path);
        $geojson = json_decode($content, true);

        // Filter khusus Kutai Timur
        $kutaiTimurFeatures = array_filter($geojson['features'] ?? [], function ($feature) {
            $props = $feature['properties'] ?? [];
            $kabupaten = $props['kabupaten'] ?? $props['KABUPATEN'] ?? $props['WADMKK'] ?? $props['KAB_KOTA'] ?? $props['kab_kota'] ?? '';
            return stripos($kabupaten, 'Kutai Timur') !== false;
        });

        // 2. Ambil data laporan dari Model Admin
        $laporanData = Laporan::select('kecamatan', 'kategori', DB::raw('count(*) as total'))
            ->groupBy('kecamatan', 'kategori')
            ->get()
            ->groupBy('kecamatan');

        $filteredFeatures = [];
        foreach ($kutaiTimurFeatures as $feature) {
            $props = $feature['properties'] ?? [];
            $namaKec = $props['kecamatan'] ?? $props['KECAMATAN'] ?? $props['WADMKC'] ?? $props['NAMOBJ'] ?? null;

            $feature['properties']['kecamatan'] = $namaKec;

            // Masukkan data statistik ke properti GeoJSON
            if ($namaKec && isset($laporanData[$namaKec])) {
                $stats = [];
                foreach ($laporanData[$namaKec] as $item) {
                    $kategoriNama = $item->kategori ?? $item->jenis_laporan;
                    $stats[$kategoriNama] = $item->total;
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

    // METHOD TAMBAHAN (Jika ingin fetch data per kecamatan secara spesifik)
    public function getStatistikKecamatan(Request $request)
    {
        $namaKecamatan = $request->query('kecamatan');

        $stats = Laporan::where('kecamatan', $namaKecamatan)
            ->selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return response()->json($stats);
    }
}