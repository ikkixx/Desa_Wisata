<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata;
use Illuminate\Support\Facades\Log;

class Kategori_WisataController extends Controller
{
    public function index()
    {
        $kategoriWisata = KategoriWisata::all();
        return view('be.kategori_wisata.index', compact('kategoriWisata'));
    }

    public function create()
    {
        return view('be.kategori_wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_wisata' => 'required|unique:kategori_wisatas,kategori_wisata|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        try {
            $fotoPath = null;

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('kategori_wisata', 'public');
            }

            KategoriWisata::create([
                'kategori_wisata' => $request->kategori_wisata,
                'deskripsi' => $request->deskripsi,
                'foto' => $fotoPath,
                'aktif' => true, // optional jika Anda pakai kolom ini
            ]);

            return redirect()->route('kategori_wisata.manage')
                ->with('success', 'Kategori Wisata berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan Kategori Wisata: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        return view('be.kategori_wisata.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori_wisata' => 'required|unique:kategori_wisatas,kategori_wisata|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        try {
            $kategori = KategoriWisata::findOrFail($id);
            $kategori->update($validated);

            return redirect()->route('kategori_wisata.manage')
                ->with('success', 'Kategori wisata berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $kategori = KategoriWisata::findOrFail($id);
            $kategori->delete();

            return redirect()->route('kategori_wisata.manage')
                ->with('success', 'Kategori Wisata berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus kategori Wisata: '.$e->getMessage());
        }
    }
}
