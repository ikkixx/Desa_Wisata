<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata; // Ensure the Kategori_Wisata model is imported

class Kategori_WisataController extends Controller
{
    public function index()
    {
        $kategoriWisata = KategoriWisata::all();
        return view('be.kategori_wisata.index', compact('kategoriWisata'));
    }

    public function create()
    {
        return view('kategori_wisata.create');
    }

    public function store(Request $request)
    {
        KategoriWisata::create($request->all());
        return redirect()->route('kategori-wisata.index');
    }

    public function edit($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        return view('kategori_wisata.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori-wisata.index');
    }

    public function destroy($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori-wisata.index');
    }
}
