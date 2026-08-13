<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritaList = Berita::latest()->get();
        return view('admin.berita.index', compact('beritaList'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:255',
            'kategori'   => 'required',
            'ringkasan'  => 'required',
            'konten'     => 'required',
            'gambar_url' => 'nullable|url',
        ]);

        Berita::create([
            'judul'      => $request->judul,
            'slug'       => Str::slug($request->judul) . '-' . time(),
            'kategori'   => $request->kategori,
            'gambar_url' => $request->gambar_url ?? 'https://via.placeholder.com/150',
            'ringkasan'  => $request->ringkasan,
            'konten'     => $request->konten,
            'status'     => 'Dipublikasikan',
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'      => 'required|max:255',
            'kategori'   => 'required',
            'ringkasan'  => 'required',
            'konten'     => 'required',
            'gambar_url' => 'nullable|url',
        ]);

        $berita->update([
            'judul'      => $request->judul,
            'slug'       => Str::slug($request->judul) . '-' . time(),
            'kategori'   => $request->kategori,
            'gambar_url' => $request->gambar_url ?? $berita->gambar_url,
            'ringkasan'  => $request->ringkasan,
            'konten'     => $request->konten,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}