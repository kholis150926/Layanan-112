<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => 6,
            'menunggu' => 3,
            'disetujui' => 2,
            'ditolak' => 1,
        ];

        $trenBulanan = [
            'labels' => ['Sep', 'Okt', 'Nov', 'Des', 'Jan'],
            'data' => [90, 100, 110, 130, 310]
        ];

        $kategori = [
            'labels' => ['Kebakaran', 'Darurat Medis', 'Kriminal', 'Bencana Alam'],
            'data' => [1, 2, 1, 1],
            'colors' => ['#ef4444', '#ec4899', '#8b5cf6', '#0ea5e9']
        ];

        // Format $kecamatan dipisah 'labels' dan 'data' sesuai kebutuhan Bar Chart
        $kecamatan = [
            'labels' => [
                'Sangatta Utara', 
                'Sangatta Selatan', 
                'Kaliorang', 
                'Sangkulirang', 
                'Kaubun', 
                'Bengalon', 
                'Muara Ancalong', 
                'Batu Ampar'
            ],
            'data' => [60, 45, 32, 30, 28, 24, 22, 21]
        ];

        $laporanTerbaru = [
            [
                'jenis' => 'Kebakaran', 
                'kode' => 'RPT-001', 
                'lokasi' => 'Jl. Yos Sudarso No. 12, Sangatta Utara', 
                'status' => 'Menunggu', 
                'tanggal' => '2026-01-22',
                'color' => 'danger',
                'icon' => 'bi-fire'
            ],
            [
                'jenis' => 'Darurat Medis', 
                'kode' => 'RPT-002', 
                'lokasi' => 'Pasar Induk Sangatta, Sangatta Utara', 
                'status' => 'Disetujui', 
                'tanggal' => '2026-01-22',
                'color' => 'primary',
                'icon' => 'bi-heart-pulse'
            ],
            [
                'jenis' => 'Kriminal', 
                'kode' => 'RPT-003', 
                'lokasi' => 'Perum. Bukit Indah Blok C, Bengalon', 
                'status' => 'Ditolak', 
                'tanggal' => '2026-01-21',
                'color' => 'warning',
                'icon' => 'bi-shield-exclamation'
            ],
            [
                'jenis' => 'Bencana Alam', 
                'kode' => 'RPT-004', 
                'lokasi' => 'Desa Muara Bengkal Ulu', 
                'status' => 'Menunggu', 
                'tanggal' => '2026-01-21',
                'color' => 'info',
                'icon' => 'bi-tsunami'
            ],
            [
                'jenis' => 'Laka Lantas', 
                'kode' => 'RPT-005', 
                'lokasi' => 'Jl. Trans Kalimantan KM 45, Kongbeng', 
                'status' => 'Disetujui', 
                'tanggal' => '2026-01-20',
                'color' => 'danger',
                'icon' => 'bi-car-front'
            ],
        ];

        return view('admin.dashboard', compact('stats', 'trenBulanan', 'kategori', 'kecamatan', 'laporanTerbaru'));
    }
}