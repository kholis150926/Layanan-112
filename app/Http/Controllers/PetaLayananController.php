<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

class PetaLayananController extends Controller
{
    public function index()
    {
        return view('peta.kutai-timur');
    }

    public function dataJson()
    {
        // 1. Path file GeoJSON Kaltim
        $path = storage_path('geojson-raw/kaltim.geojson');

        if (!file_exists($path)) {
            $path = storage_path('app/public/geojson-raw/kaltim.geojson');
        }

        if (!file_exists($path)) {
            return response()->json(['error' => 'File GeoJSON tidak ditemukan'], 404);
        }

        // 2. Ambil dan parse file GeoJSON
        $content = file_get_contents($path);
        $geojson = json_decode($content, true);

        if (!$geojson || !isset($geojson['features'])) {
            return response()->json(['error' => 'Format GeoJSON tidak valid'], 500);
        }

        // Daftar 18 Kecamatan Kutai Timur
        $listKecKutim = [
            'sangatta utara', 'sangatta selatan', 'bengalon', 'kaliorang', 'kaubun',
            'teluk pandan', 'rantau pulung', 'muara wahau', 'kongbeng', 'kombeng', 'telen',
            'busang', 'muara ancalong', 'muara bengkal', 'long mesangat', 'sandaran',
            'sangkulirang', 'karangan', 'batu ampar'
        ];

        // 3. Filter khusus kecamatan Kutai Timur
        $kutaiTimurFeatures = array_filter($geojson['features'], function ($feature) use ($listKecKutim) {
            $props = $feature['properties'] ?? [];

            $kabupaten = strtolower(
                $props['kabupaten'] ?? $props['KABUPATEN'] ?? $props['WADMKK'] ?? $props['KAB_KOTA'] ?? ''
            );

            if (!empty($kabupaten) && str_contains($kabupaten, 'kutai timur')) {
                return true;
            }

            $kecamatan = strtolower(
                $props['kecamatan'] ?? $props['KECAMATAN'] ?? $props['WADMKC'] ?? $props['NAMOBJ'] ?? ''
            );

            foreach ($listKecKutim as $kec) {
                if (str_contains($kecamatan, $kec)) {
                    return true;
                }
            }

            return false;
        });

        // 4. Ambil data dari Model Laporan (Database Admin)
        $laporanData = [];
        try {
            $rawLaporan = Laporan::query()
                ->select('kecamatan', 'kategori', DB::raw('count(*) as total'))
                ->groupBy('kecamatan', 'kategori')
                ->get();

            // Simpan statistik dengan key kecamatan (huruf kecil)
            foreach ($rawLaporan as $item) {
                $keyKec = strtolower(trim($item->kecamatan));
                $laporanData[$keyKec][$item->kategori] = (int) $item->total;
            }
        } catch (\Exception $e) {
            $laporanData = [];
        }

        // 5. Hubungkan data statistik ke properti GeoJSON
        $filteredFeatures = [];

        foreach ($kutaiTimurFeatures as $feature) {
            $props = $feature['properties'] ?? [];

            $namaKecRaw = $props['kecamatan'] 
                       ?? $props['KECAMATAN'] 
                       ?? $props['WADMKC'] 
                       ?? $props['NAMOBJ'] 
                       ?? 'Unknown';

            $namaKecClean = trim($namaKecRaw);
            $namaKecLower = strtolower($namaKecClean);

            $feature['properties']['kecamatan'] = $namaKecClean;
            $feature['properties']['NAMOBJ']    = $namaKecClean;
            $feature['properties']['kode_kec']  = $props['kode_kec'] ?? $props['KODE_KEC'] ?? $namaKecClean;

            // Pencocokan fleksibel nama kecamatan GeoJSON & Database
            $matchedStats = [];
            foreach ($laporanData as $dbKec => $stats) {
                if (str_contains($namaKecLower, $dbKec) || str_contains($dbKec, $namaKecLower)) {
                    $matchedStats = $stats;
                    break;
                }
            }

            $feature['properties']['statistik'] = !empty($matchedStats) ? $matchedStats : (object)[];

            $filteredFeatures[] = $feature;
        }

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => array_values($filteredFeatures)
        ]);
    }
}