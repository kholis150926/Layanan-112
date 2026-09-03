<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Tambahkan method ini khusus untuk Halaman Beranda
    public function beranda()
    {
        // Ambil 3 berita paling baru dari database
        $beritaTerbaru = Berita::latest()->take(3)->get();

        return view('dashboard', compact('beritaTerbaru'));
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