<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index()
    {
        $paketWisata = PaketWisata::all();
        return view('paket_wisata.index', compact('paketWisata'));
    }

    public function create()
    {
        return view('paket_wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'harga_per_pack' => 'required|numeric',
            'foto1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paket = new PaketWisata;
        $paket->nama_paket = $request->nama_paket;
        $paket->deskripsi = $request->deskripsi;
        $paket->fasilitas = $request->fasilitas;
        $paket->harga_per_pack = $request->harga_per_pack;

        if ($request->hasFile('foto1')) {
            $foto1 = $request->file('foto1');
            $foto1Path = $foto1->store('paket_wisata', 'public');
            $paket->foto1 = $foto1Path;
        }

        $paket->save();

        return redirect()->route('paket-wisata.index')->with('success', 'Paket Wisata berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = PaketWisata::findOrFail($id);
        return view('paket_wisata.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'harga_per_pack' => 'required|numeric',
            'foto1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paket = PaketWisata::findOrFail($id);
        $paket->nama_paket = $request->nama_paket;
        $paket->deskripsi = $request->deskripsi;
        $paket->fasilitas = $request->fasilitas;
        $paket->harga_per_pack = $request->harga_per_pack;

        if ($request->hasFile('foto1')) {
            $foto1 = $request->file('foto1');
            $foto1Path = $foto1->store('paket_wisata', 'public');
            $paket->foto1 = $foto1Path;
        }

        $paket->save();

        return redirect()->route('paket-wisata.index')->with('success', 'Paket Wisata berhasil diupdate.');
    }

    public function destroy($id)
    {
        $paket = PaketWisata::findOrFail($id);
        $paket->delete();

        return redirect()->route('paket-wisata.index')->with('success', 'Paket Wisata berhasil dihapus.');
    }
}
