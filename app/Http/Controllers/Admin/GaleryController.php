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
        return view('admin.galery.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tanggal' => 'required|date',
        ]);

        $gambarPath = $request->file('gambar')->store('galery', 'public');

        Galery::create([
            'judul'   => $request->judul,
            'gambar'  => $gambarPath,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $galeri = Galery::findOrFail($id);
        $galeri->judul   = $request->judul;
        $galeri->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $galeri->gambar = $request->file('gambar')->store('galery', 'public');
        }

        $galeri->save();

        return redirect()->back()->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galery::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}