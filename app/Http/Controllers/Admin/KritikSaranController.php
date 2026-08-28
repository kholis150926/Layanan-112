<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    /**
     * Tampilkan riwayat seluruh pesan kritik & saran di panel admin.
     */
    public function index()
    {
        $pesanList = KritikSaran::latest()->paginate(15);

        return view('admin.kritik-saran.index', compact('pesanList'));
    }

    /**
     * Update status pesan (menunggu / diproses / ditanggapi).
     */
    public function updateStatus(Request $request, KritikSaran $kritikSaran)
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,diproses,ditanggapi'],
        ]);

        $kritikSaran->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }

    /**
     * Hapus pesan kritik & saran.
     */
    public function destroy(KritikSaran $kritikSaran)
    {
        $kritikSaran->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}