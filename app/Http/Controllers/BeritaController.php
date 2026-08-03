<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $filterAktif = $request->query('kategori', 'Semua');

        // Contoh data statis — ganti dengan query Eloquent, mis:
        // $beritaList = Berita::when($filterAktif !== 'Semua', fn ($q) =>
        //         $q->where('kategori', $filterAktif))
        //     ->latest()->paginate(9);
        $beritaList = [
            [
                'badge'      => 'Pengumuman',
                'badge_class'=> 'pengumuman',
                'gambar'     => 'https://images.unsplash.com/photo-1521302080334-4bebac2763a6?w=500',
                'judul'      => 'Pemprov Kaltim Perkuat Layanan Darurat 112 di Kutai Timur',
                'ringkasan'  => 'Pemerintah Provinsi Kalimantan Timur berkomitmen memperkuat layanan darurat 112 untuk masyarakat Kutai...',
                'tanggal'    => '22 Jan 2025',
                'slug'       => 'pemprov-kaltim-perkuat-layanan-darurat-112',
            ],
            [
                'badge'      => 'Kegiatan',
                'badge_class'=> 'kegiatan',
                'gambar'     => 'https://images.unsplash.com/photo-1560439514-4e9645039924?w=500',
                'judul'      => 'Sosialisasi Penggunaan Layanan 112 di Kecamatan Sangatta Utara',
                'ringkasan'  => 'Tim Diskominfo Staper Kutim melaksanakan sosialisasi tentang cara penggunaan layanan darurat 112 kepada...',
                'tanggal'    => '20 Jan 2025',
                'slug'       => 'sosialisasi-penggunaan-layanan-112-sangatta-utara',
            ],
            [
                'badge'      => 'Statistik',
                'badge_class'=> 'statistik',
                'gambar'     => 'https://images.unsplash.com/photo-1541864890574-2c9fb28b30c7?w=500',
                'judul'      => 'Layanan 112 Berhasil Tangani 50 Kasus Darurat di Januari 2025',
                'ringkasan'  => 'Sepanjang Januari 2025, layanan 112 Kutai Timur berhasil menangani 50 kasus darurat yang terdiri dari ketertiban...',
                'tanggal'    => '18 Jan 2025',
                'slug'       => 'layanan-112-tangani-50-kasus-darurat-januari-2025',
            ],
            [
                'badge'      => 'Kegiatan',
                'badge_class'=> 'kegiatan',
                'gambar'     => 'https://images.unsplash.com/photo-1587979566642-fa79e3b48a4e?w=500',
                'judul'      => 'Pelatihan Tim Respons Cepat Kabupaten Kutai Timur',
                'ringkasan'  => 'Diskominfo Staper Kutim menggelar pelatihan intensif bagi tim respons cepat yang akan bertugas menanggapi laporan...',
                'tanggal'    => '15 Jan 2025',
                'slug'       => 'pelatihan-tim-respons-cepat-kutai-timur',
            ],
        ];

        if ($filterAktif !== 'Semua') {
            $beritaList = array_values(array_filter(
                $beritaList,
                fn ($b) => $b['badge'] === $filterAktif
            ));
        }

        return view('berita.index', compact('beritaList', 'filterAktif'));
    }

    public function show(string $slug)
    {
        // Contoh: $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('slug'));
    }
}