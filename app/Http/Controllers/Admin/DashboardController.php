<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\KritikSaran; // Membaca tabel 'kritik_sarans'
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Kartu Ringkasan Statistik
        $stats = [
            'total_kritik' => KritikSaran::count(),

            // DISESUAIKAN DENGAN ISI DB KAMU ('belum_dibaca' & 'sudah_dibaca')
            'belum_dibaca' => KritikSaran::where('status', 'belum_dibaca')->count(),
            'sudah_dibaca' => KritikSaran::where('status', 'sudah_dibaca')->count(),

            // Diubah dari total_galery menjadi total_laporan
            'total_laporan' => Laporan::count(),
        ];

        // 2. TREN LAPORAN BULANAN (6 Bulan Terakhir)
        $months = [];
        $trenData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M'); 
            
            $count = Laporan::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $months[] = $monthName;
            $trenData[] = $count;
        }

        $trenBulanan = [
            'labels' => $months,
            'data'   => $trenData
        ];

        // 3. KATEGORI LAPORAN
        $kategoriDB = Laporan::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->get();

        $palette = ['#ef4444', '#ec4899', '#8b5cf6', '#0ea5e9', '#10b981', '#f59e0b', '#6366f1'];

        $kategori = [
            'labels' => $kategoriDB->pluck('kategori')->toArray(),
            'data'   => $kategoriDB->pluck('total')->toArray(),
            'colors' => array_slice($palette, 0, $kategoriDB->count())
        ];

        // 4. TOP 8 KECAMATAN
        $topKecamatan = Laporan::selectRaw('kecamatan, count(*) as total')
            ->groupBy('kecamatan')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $kecamatan = [
            'labels' => $topKecamatan->pluck('kecamatan')->toArray(),
            'data'   => $topKecamatan->pluck('total')->toArray(),
        ];

        // 5. LAPORAN TERBARU
        $laporanTerbaru = Laporan::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'trenBulanan', 'kategori', 'kecamatan', 'laporanTerbaru'));
    }
}