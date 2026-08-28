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

    public function riwayat()
    {
        $kritikSaran = KritikSaran::latest()->get();

        return view('admin.kritik-saran.riwayat', compact('kritikSaran'));
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

        if ($isAnonymous) {
            $pelapor = null;
            $kontak = null;
        } else {
            $pelapor = $request->nama;
            $kontak = $request->kontak;
        }

        KritikSaran::create([
            'pelapor'      => $pelapor,
            'kontak'       => $kontak,
            'jenis'        => $validated['jenis'],
            'pesan'        => $validated['pesan'],
            'is_anonymous' => $isAnonymous,
            'status'       => 'menunggu',
        ]);

        return redirect()
            ->route('kritik-saran')
            ->with('success', 'Terima kasih, masukan Anda berhasil dikirim.');
    }
}