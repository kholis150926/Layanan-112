<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\KritikSaran; // Model Kritik & Saran
use App\Models\Galeri;      // Model Galeri
use App\Models\Galery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Kartu Ringkasan Statistik (Kritik & Saran + Galeri)
        $stats = [
            // Kartu 1: Total Kritik & Saran yang masuk
            'total_kritik' => KritikSaran::count(),

            // Kartu 2: Pesan yang belum dibaca (sesuaikan 'Belum Dibaca' jika nama status di DB beda, misal: 'unread' / 'Menunggu')
            'belum_dibaca' => KritikSaran::whereIn('status', ['Belum Dibaca', 'unread', 'Menunggu'])->count(),

            // Kartu 3: Pesan yang sudah dibaca / direspon (sesuaikan 'Sudah Dibaca' jika nama status di DB beda, misal: 'read' / 'Direspon')
            'sudah_dibaca' => KritikSaran::whereIn('status', ['Sudah Dibaca', 'read', 'Direspon'])->count(),

            // Kartu 4: Total Foto Galeri / Artikel
            'total_galeri' => Galery::count(),
        ];

        // 2. TREN LAPORAN BULANAN (6 Bulan Terakhir dari Seluruh 18 Kecamatan)
        $months = [];
        $trenData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M'); // Contoh: Jan, Feb, Mar
            
            // Hitung total laporan di bulan tersebut
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

        // 3. KATEGORI LAPORAN (Diagram Bulat berdasarkan Kategori Laporan di Database)
        $kategoriDB = Laporan::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->get();

        // Warna menarik untuk chart donut
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