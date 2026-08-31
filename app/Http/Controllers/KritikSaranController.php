<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KritikSaran;

class KritikSaranController extends Controller
{
    public function index()
    {
        return view('kritik-saran.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'nullable|string|max:100',
            'kontak'       => 'nullable|string|max:100',
            'jenis'        => 'required|in:kritik,saran,apresiasi',
            'pesan'        => 'required|string|max:2000',
            'is_anonymous' => 'nullable|boolean',
        ]);

        $isAnonymous = $request->boolean('is_anonymous');

        KritikSaran::create([
            'pelapor'      => $isAnonymous ? null : $request->nama,
            'kontak'       => $isAnonymous ? null : $request->kontak,
            'jenis'        => $validated['jenis'],
            'pesan'        => $validated['pesan'],
            'is_anonymous' => $isAnonymous,
            'status'       => 'belum_dibaca', // Disesuaikan dengan status pencarian di AdminController
        ]);

        return redirect()
            ->route('kritik-saran')
            ->with('success', 'Terima kasih, masukan Anda berhasil dikirim.');
    }
}