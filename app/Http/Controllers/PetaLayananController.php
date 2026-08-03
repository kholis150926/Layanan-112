<?php

namespace App\Http\Controllers;

use App\Models\Layanan112;

class PetaLayananController extends Controller
{
    public function index()
    {
        return view('peta.kutai-timur');
    }

    public function dataJson()
    {
        $path = storage_path('app/public/geojson/kutai-timur.geojson');
        $geojson = json_decode(file_get_contents($path), true);

        $statusMap = Layanan112::pluck('status', 'kode_kec');

        foreach ($geojson['features'] as &$feature) {
            $kode = $feature['properties']['kode_kec'];
            $feature['properties']['status'] = $statusMap[$kode] ?? 'belum';
        }

        return response()->json($geojson);
    }
}