<?php

namespace App\Http\Controllers;

class ProfilController extends Controller
{
    public function index()
    {
        $layananKami = [
            [
                'icon'  => 'bi-fire',
                'class' => 'kebakaran',
                'judul' => 'Kebakaran',
                'desk'  => 'Penanganan kebakaran kebangunan, lahan, dan hutan di wilayah Kutai Timur.',
            ],
            [
                'icon'  => 'bi-heart-pulse-fill',
                'class' => 'medis',
                'judul' => 'Darurat Medis',
                'desk'  => 'Bantuan medis darurat untuk kecelakaan, sakit mendadak, dan kondisi kritis lainnya.',
            ],
            [
                'icon'  => 'bi-shield-lock-fill',
                'class' => 'keamanan',
                'judul' => 'Keamanan',
                'desk'  => 'Penanganan gangguan keamanan, kriminalitas, dan ketertiban masyarakat.',
            ],
            [
                'icon'  => 'bi-exclamation-triangle-fill',
                'class' => 'bencana',
                'judul' => 'Bencana Alam',
                'desk'  => 'Penanganan bencana alam seperti banjir, longsor, angin puting beliung, dan lainnya.',
            ],
        ];
        return view('profil', compact('layananKami'));
    }
}