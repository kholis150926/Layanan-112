<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galery;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    public function index()
    {
        $galeris = Galery::latest()->get();
        return view('Admin.galery.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

        $fotoPath = $request->file('foto')->store('galeri', 'public');

        Galery::create([
            'judul' => $request->judul,
            'foto' => $fotoPath,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $galeri = Galery::findOrFail($id);
        
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}