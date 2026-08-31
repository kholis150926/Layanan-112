<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function index()
    {
        $pesanMasuk = KritikSaran::where('status', 'belum_dibaca')->latest()->get();
        $totalAktif = $pesanMasuk->count();

        return view('Admin.Kritik_Saran.index', compact('pesanMasuk', 'totalAktif'));
    }

    public function riwayat()
    {
        // Variabel diubah menjadi $kritikSaran agar sesuai dengan @forelse($kritikSaran as $item) di Blade
        $kritikSaran = KritikSaran::latest()->paginate(15);

        return view('Admin.Kritik_Saran.riwayat', compact('kritikSaran'));
    }

    public function markAsRead($id)
    {
        $pesan = KritikSaran::findOrFail($id);
        $pesan->update(['status' => 'sudah_dibaca']);

        return redirect()->back()->with('success', 'Pesan telah selesai dan dipindahkan ke riwayat.');
    }

    public function destroy($id)
    {
        $pesan = KritikSaran::findOrFail($id);
        $pesan->delete();

        return redirect()->back()->with('success', 'Pesan telah terhapus.');
    }
}