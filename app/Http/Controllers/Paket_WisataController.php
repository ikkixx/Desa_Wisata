<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Paket_WisataController extends Controller  // Menggunakan PascalCase untuk nama class
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketWisata = PaketWisata::latest()->get();  // Menambahkan latest() untuk urutan terbaru
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
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255|unique:paket_wisatas,nama_paket',  // Menambahkan unique
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga_per_pack' => 'required|numeric|min:0',  // Menambahkan min:0
            'foto1' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',  // Menambahkan webp
        ]);

        try {
            if ($request->hasFile('foto1')) {
                $file = $request->file('foto1');
                Log::info('File info:', [
                    'OriginalName' => $file->getClientOriginalName(),
                    'Extension' => $file->getClientOriginalExtension(),
                    'Size' => $file->getSize(),
                    'MimeType' => $file->getMimeType()
                ]);
            }


            PaketWisata::create($validated);

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error creating paket wisata: ' . $e->getMessage());  // Menambahkan logging
            return redirect()->back()
                ->with('error', 'Gagal menambahkan paket wisata: ' . $e->getMessage())
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
        $paket = PaketWisata::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255|unique:paket_wisatas,nama_paket,' . $id,  // Unique dengan pengecualian
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga_per_pack' => 'required|numeric|min:0',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            // Handle file upload if new image is provided
            if ($request->hasFile('foto1')) {
                // Delete old image
                if ($paket->foto1) {
                    Storage::delete('public/' . $paket->foto1);
                }

                $image = $request->file('foto1');
                $imageName = time() . '_' . str()->slug($validated['nama_paket']) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/paket_wisata', $imageName);
                $validated['foto1'] = 'paket_wisata/' . $imageName;
            } else {
                $validated['foto1'] = $paket->foto1;  // Pertahankan foto lama jika tidak diupdate
            }

            $paket->update($validated);

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating paket wisata ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui paket wisata: ' . $e->getMessage())
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
                Storage::delete('public/' . $paket->foto1);
            }

            $paket->delete();

            return redirect()->route('paket_wisata.manage')
                ->with('success', 'Paket wisata berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting paket wisata ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus paket wisata: ' . $e->getMessage());
        }
    }
}
