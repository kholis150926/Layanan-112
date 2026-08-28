<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function index()
    {
        // PERBAIKAN DI SINI:
        $pesanMasuk = KritikSaran::where('status', 'belum_dibaca')->latest()->get();
        $totalAktif = $pesanMasuk->count();

        return view('Admin.kritik_saran.index', compact('pesanMasuk', 'totalAktif'));
    }

    public function riwayat()
    {
        $riwayatPesan = KritikSaran::latest()->paginate(15);
        return view('Admin.kritik_saran.riwayat', compact('riwayatPesan'));
    }

    public function markAsRead($id)
    {
        $pesan = KritikSaran::findOrFail($id);
        $pesan->update(['status' => 'sudah_dibaca']);

        return redirect()->back()->with('success', 'pesan telah selasai dan dipindahkan keriwayat');
    }

    public function destroy($id)
    {
        $pesan = KritikSaran::findOrFail($id);
        $pesan->delete();

        return redirect()->back()->with('success', 'pesan telah terhapus');
    }
}