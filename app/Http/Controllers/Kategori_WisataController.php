<?php

namespace App\Http\Controllers;

use App\Models\KategoriWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Kategori_WisataController extends Controller
{
    public function index()
    {
        $greeting = $this->getGreeting();
        $kategori = KategoriWisata::orderBy('created_at', 'desc')->get();

        return view('be.kategori_wisata.index', [
            'greeting' => $greeting,
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        $greeting = $this->getGreeting();
        return view('be.kategori_wisata.create', [
            'greeting' => $greeting,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_wisata' => 'required|string|max:255|unique:kategori_wisatas',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('kategori_wisata', 'public');
        }

        KategoriWisata::create($validatedData);

        return redirect()->route('kategori_wisata.manage')
            ->with('success', 'Kategori wisata berhasil dibuat.');
    }

    public function edit($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        $greeting = $this->getGreeting();
        return view('be.kategori_wisata.edit', [
            'greeting' => $greeting,
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriWisata::findOrFail($id);

        $validatedData = $request->validate([
            'kategori_wisata' => 'required|string|max:255|unique:kategori_wisatas,kategori_wisata,' . $id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($kategori->foto) {
                Storage::disk('public')->delete($kategori->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('kategori_wisata', 'public');
        }

        $kategori->update($validatedData);

        return redirect()->route('kategori_wisata.manage')
            ->with('success', 'Kategori wisata berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriWisata::findOrFail($id);

        // Delete photo if exists
        if ($kategori->foto) {
            Storage::disk('public')->delete($kategori->foto);
        }

        $kategori->delete();

        return redirect()->route('kategori_wisata.manage')
            ->with('success', 'Kategori wisata berhasil dihapus.');
    }

    private function getGreeting()
    {
        $hour = now()->hour;

        if ($hour < 12) {
            return 'Good Morning';
        } elseif ($hour < 18) {
            return 'Good Afternoon';
        } else {
            return 'Good Evening';
        }
    }
}