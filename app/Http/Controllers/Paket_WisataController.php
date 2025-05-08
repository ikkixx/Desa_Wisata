<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use Illuminate\Support\Facades\Storage;

class Paket_WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketWisata = PaketWisata::all();
        return view('be.paket_wisata.index', compact('paketWisata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.paket_wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga_per_pack' => 'required|numeric',
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $data = $request->all();
            
            // Handle file upload
            if ($request->hasFile('foto1')) {
                $image = $request->file('foto1');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('public/paket_wisata', $imageName);
                $data['foto1'] = 'paket_wisata/'.$imageName;
            }

            PaketWisata::create($data);

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan paket wisata: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paket = PaketWisata::findOrFail($id);
        return view('be.paket_wisata.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = PaketWisata::findOrFail($id);
        return view('be.paket_wisata.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga_per_pack' => 'required|numeric',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $paket = PaketWisata::findOrFail($id);
            $data = $request->all();
            
            // Handle file upload if new image is provided
            if ($request->hasFile('foto1')) {
                // Delete old image
                if ($paket->foto1) {
                    Storage::delete('public/'.$paket->foto1);
                }
                
                $image = $request->file('foto1');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('public/paket_wisata', $imageName);
                $data['foto1'] = 'paket_wisata/'.$imageName;
            } else {
                unset($data['foto1']);
            }

            $paket->update($data);

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui paket wisata: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $paket = PaketWisata::findOrFail($id);
            
            // Delete associated image
            if ($paket->foto1) {
                Storage::delete('public/'.$paket->foto1);
            }
            
            $paket->delete();

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus paket wisata: '.$e->getMessage());
        }
    }
}