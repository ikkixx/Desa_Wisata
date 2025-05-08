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
            'kategori_wisata' => 'required|string|max:255|unique:kategori_wisatas'
        ]);

        try {
            KategoriWisata::create([
                'kategori_wisata' => $request->kategori_wisata
            ]);

            return redirect()->route('kategori_wisata.manage')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Kategori berhasil ditambahkan!'
                ]);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Gagal menambahkan kategori: ' . $e->getMessage()
                ]);
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
            'kategori_wisata' => 'required|string|max:255|unique:kategori_wisatas,kategori_wisata,' . $id
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
                ->with('success', 'Kategori wisata berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
