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

        // Logika Gambar (Simpan path relatif jika upload file)
        $gambarPath = null;

        if ($request->hasFile('gambar_file')) {
            // Hanya simpan path 'berita/namafile.jpg' ke DB
            $gambarPath = $request->file('gambar_file')->store('berita', 'public');
        } elseif ($request->filled('gambar_url')) {
            // Simpan link URL langsung jika diisi
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

        // Tetapkan gambar lama sebagai default jika tidak ada gambar baru
        $gambarPath = $berita->gambar_url;

        if ($request->hasFile('gambar_file')) {
            // Hapus file fisik lama jika sebelumnya merupakan file upload (bukan link URL)
            if ($berita->gambar_url && !filter_var($berita->gambar_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($berita->gambar_url);
            }
            $gambarPath = $request->file('gambar_file')->store('berita', 'public');
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
        
        // Hapus file fisik jika berupa file upload
        if ($berita->gambar_url && !filter_var($berita->gambar_url, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($berita->gambar_url);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}