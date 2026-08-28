<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Query Dasar
        $query = Laporan::query();

        // 1. Filter berdasarkan Kecamatan (jika dipilih)
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // 2. Filter berdasarkan Tanggal Mulai & Tanggal Selesai
        if ($request->filled('tgl_mulai')) {
            $query->whereDate('created_at', '>=', $request->tgl_mulai);
        }

        if ($request->filled('tgl_selesai')) {
            $query->whereDate('created_at', '<=', $request->tgl_selesai);
        }

        // Ambil data laporan terbaru dengan pagination
        $laporans = $query->latest()->paginate(10)->withQueryString();

        // Daftar 18 Kecamatan Kutai Timur untuk Opsi Filter Dropdown
        $daftarKecamatan = [
            'Busang', 'Telen', 'Bengalon', 'Muara Wahau', 'Kongbeng', 'Sangkulirang',
            'Long Mesangat', 'Muara Ancalong', 'Sandaran', 'Muara Bengkal', 'Rantau Pulung',
            'Karangan', 'Sangatta Utara', 'Sangatta Selatan', 'Batu Ampar', 'Teluk Pandan',
            'Kaubun', 'Kaliorang'
        ];

        return view('admin.riwayat.index', compact('laporans', 'daftarKecamatan'));
    }
}