<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}