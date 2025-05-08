<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class Kategori_BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriBerita::latest()->get();
        return view('be.kategori_berita.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.kategori_berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak digunakan di tampilan kita
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        return view('be.kategori_berita.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        $validated = $request->validate([
            'kategori_berita' => 'required|string|max:255|unique:kategori_beritas,kategori_berita,' . $id
        ]);
        try {
            $kategori->update($validated);

            return redirect()->route('kategori_berita.manage')
                ->with('success', 'Paket wisata berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui Kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        // Cek apakah kategori digunakan di berita
        if ($kategori->beritas()->exists()) {
            return redirect()->route('kategori_berita.manage')
                ->with('error', 'Tidak dapat menghapus kategori karena sedang digunakan');
        }

        $kategori->delete();

        return redirect()->route('kategori_berita.manage')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
