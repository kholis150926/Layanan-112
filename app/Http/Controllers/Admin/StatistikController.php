<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // 1. Daftar seluruh kecamatan di Kutai Timur
        $allKecamatan = [
            'Busang', 'Telen', 'Bengalon', 'Muara Wahau', 'Kongbeng', 
            'Sangkulirang', 'Long Mesangat', 'Muara Ancalong', 'Sandaran', 
            'Muara Bengkal', 'Rantau Pulung', 'Karangan', 'Sangatta Utara', 
            'Sangatta Selatan', 'Batu Ampar', 'Teluk Pandan', 'Kaubun', 'Kaliorang'
        ];

        // 2. Kecamatan yang dipilih dari URL parameter (default: Sangatta Utara)
        $selectedKecamatan = $request->query('kecamatan', 'Sangatta Utara');

        // 3. Ambil jumlah laporan dari database MySQL per kecamatan
        $dbCounts = Laporan::selectRaw('kecamatan, count(*) as total')
            ->groupBy('kecamatan')
            ->pluck('total', 'kecamatan')
            ->toArray();

        // 4. Format array kecamatan untuk Blade
        $kecamatanList = collect($allKecamatan)->map(function ($nama) use ($dbCounts) {
            return [
                'nama' => $nama,
                'total' => $dbCounts[$nama] ?? 0
            ];
        });

        // 5. Hitung kategori laporan khusus untuk kecamatan yang dipilih ($selectedKecamatan)
        $kategoriDetail = Laporan::where('kecamatan', $selectedKecamatan)
            ->selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        $kategoriLabels = ['Darurat Medis', 'Kebakaran', 'Kriminal', 'Laka Lantas', 'Bencana Alam', 'Lainnya'];
        $kategoriData = array_map(function($kat) use ($kategoriDetail) {
            return $kategoriDetail[$kat] ?? 0;
        }, $kategoriLabels);

        // 6. Data Bar Chart perbandingan (urut terbanyak ke tersedikit)
        $sortedKecamatan = $kecamatanList->sortByDesc('total')->values();

        return view('admin.statistik', [
            'kecamatan'         => $kecamatanList,
            'selectedKecamatan' => $selectedKecamatan,
            'totalSelected'     => $dbCounts[$selectedKecamatan] ?? 0,
            'kategoriLabels'    => $kategoriLabels,
            'kategoriData'      => $kategoriData,
            'chartLabels'       => $sortedKecamatan->pluck('nama'),
            'chartData'         => $sortedKecamatan->pluck('total'),
        ]);
    }

    // Fungsi menyimpan laporan baru dari modal
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan' => 'required',
            'kategori'  => 'required',
            'lokasi'    => 'required',
        ]);

        Laporan::create([
            'kode_laporan' => 'RPT-' . rand(100, 999),
            'kecamatan'    => $request->kecamatan,
            'kategori'     => $request->kategori,
            'lokasi'       => $request->lokasi,
            'status'       => 'Menunggu'
        ]);

        return redirect()->route('admin.statistik', ['kecamatan' => $request->kecamatan])
                         ->with('success', 'Laporan berhasil ditambahkan!');
    }
}