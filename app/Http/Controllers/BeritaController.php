<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Laporan; // Kita tambahkan Model Laporan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    // Method untuk Halaman Beranda
    public function beranda()
    {
        // 1. Ambil 3 berita paling baru
        $beritaTerbaru = Berita::latest()->take(3)->get();

        // 2. Ambil 5 kecamatan dengan laporan terbanyak dari database
        $kecamatanTeratas = Laporan::select('kecamatan', DB::raw('count(*) as jumlah'))
            ->groupBy('kecamatan')
            ->orderByDesc('jumlah')
            ->take(5)
            ->get();

        // Kirim data berita & kecamatan ke view dashboard
        return view('dashboard', compact('beritaTerbaru', 'kecamatanTeratas'));
    }

    public function index(Request $request)
    {
        $filterAktif = $request->query('kategori', 'Semua');

        $query = Berita::latest();

        if ($filterAktif !== 'Semua') {
            $query->where('kategori', $filterAktif);
        }

        $beritaList = $query->get();

        return view('berita.index', compact('beritaList', 'filterAktif'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        return view('berita.show', compact('berita'));
    }
}