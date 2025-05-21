<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class Kategori_BeritaController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBerita::latest()->get();
        return view('be.kategori_berita.index', compact('kategoris'));
    }

    public function create()
    {
        return view('be.kategori_berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_berita' => 'required|string|max:255|unique:kategori_beritas,kategori_berita'
        ]);
        
        try {
            KategoriBerita::create($validated);
            return redirect()->route('kategori_berita.manage')
                ->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Menambahkan Kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        return view('be.kategori_berita.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        $validated = $request->validate([
            'kategori_berita' => 'required|string|max:255|unique:kategori_beritas,kategori_berita,' . $id
        ]);
        
        try {
            $kategori->update($validated);
            return redirect()->route('kategori_berita.manage')
                ->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui Kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $kategori = KategoriBerita::findOrFail($id);
            $kategori->delete();
            
            return back()->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}