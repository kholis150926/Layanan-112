<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'judul'       => 'required|max:255',
            'kategori'    => 'required',
            'ringkasan'   => 'required',
            'konten'      => 'required',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url'  => 'nullable|url',
            'created_at'  => 'nullable|date',
        ]);

        // Proses Logika Gambar (File Upload vs URL Link)
        $gambarPath = 'https://via.placeholder.com/150';

        if ($request->hasFile('gambar_file')) {
            $path = $request->file('gambar_file')->store('berita', 'public');
            $gambarPath = asset('storage/' . $path);
        } elseif ($request->filled('gambar_url')) {
            $gambarPath = $request->gambar_url;
        }

        Berita::create([
            'judul'      => $request->judul,
            'slug'       => Str::slug($request->judul) . '-' . time(),
            'kategori'   => $request->kategori,
            'gambar_url' => $gambarPath,
            'ringkasan'  => $request->ringkasan,
            'konten'     => $request->konten,
            'status'     => 'Dipublikasikan',
            'created_at' => $request->created_at ?? now(),
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
            'judul'       => 'required|max:255',
            'kategori'    => 'required',
            'ringkasan'   => 'required',
            'konten'      => 'required',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url'  => 'nullable|url',
            'created_at'  => 'nullable|date',
        ]);

        // Update Gambar jika ada yang baru
        $gambarPath = $berita->gambar_url;

        if ($request->hasFile('gambar_file')) {
            $path = $request->file('gambar_file')->store('berita', 'public');
            $gambarPath = asset('storage/' . $path);
        } elseif ($request->filled('gambar_url')) {
            $gambarPath = $request->gambar_url;
        }

        $berita->update([
            'judul'      => $request->judul,
            'slug'       => Str::slug($request->judul) . '-' . time(),
            'kategori'   => $request->kategori,
            'gambar_url' => $gambarPath,
            'ringkasan'  => $request->ringkasan,
            'konten'     => $request->konten,
            'created_at' => $request->created_at ?? $berita->created_at,
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