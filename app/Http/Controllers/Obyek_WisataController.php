<?php

namespace App\Http\Controllers;

use App\Models\ObyekWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Obyek_WisataController extends Controller
{
    public function index()
    {
        $objekWisatas = ObyekWisata::with('kategoriWisata')->paginate(10);
        $greeting = $this->getGreeting();

        return view('be.obyek_wisata.index', [
            'title' => 'Objek Wisata Management',
            'objekWisatas' => $objekWisatas,
            'greeting' => $greeting
        ]);
    }

    public function create()
    {
        $kategoris = KategoriWisata::all();
        $greeting = $this->getGreeting();

        return view('be.obyek_wisata.create', [
            'title' => 'Create Objek Wisata',
            'kategoris' => $kategoris,
            'greeting' => $greeting
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'deskripsi_wisata' => 'required|string',
            'id_kategori_wisata' => 'required|exists:kategori_wisatas,id',
            'fasilitas' => 'required|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan setiap file ke storage
        foreach (range(1, 5) as $i) {
            $field = 'foto' . $i;
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('objekwisata', 'public');
            }
        }

        ObyekWisata::create($validated);

        return redirect()->route('obyek_wisata.manage')->with('success', 'Objek Wisata created successfully.');
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        $obyekWisata = ObyekWisata::findOrFail($id);
        $kategoris = KategoriWisata::all(); // or whatever your category model is
        $greeting = $this->getGreeting();

        return view('be.obyek_wisata.edit', [
            'title' => 'Create Objek Wisata',
            'obyekWisata' => $obyekWisata,
            'kategoris' => $kategoris,
            'greeting' => $greeting
        ]);
    }

   public function update(Request $request, $id) // Ubah parameter
{
    $obyekWisata = ObyekWisata::findOrFail($id); // Tambahkan ini
    
    $validated = $request->validate([
        'nama_wisata' => 'required|string|max:255',
        'deskripsi_wisata' => 'required|string',
        'id_kategori_wisata' => 'required|exists:kategori_wisatas,id',
        'fasilitas' => 'required|string',
        'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle file uploads
    foreach (range(1, 5) as $i) {
        $field = 'foto' . $i;
        if ($request->hasFile($field)) {
            // Hapus foto lama jika ada
            if ($obyekWisata->$field) {
                Storage::delete('public/' . $obyekWisata->$field);
            }
            $validated[$field] = $request->file($field)->store('objekwisata', 'public');
        } else {
            // Pertahankan nilai lama jika tidak ada file baru
            $validated[$field] = $obyekWisata->$field;
        }
    }

    $obyekWisata->update($validated);

    return redirect()->route('obyek_wisata.manage')->with('success', 'Objek Wisata updated successfully.');
}



    public function destroy($id)
    {
        $obyekWisata = ObyekWisata::findOrFail($id);
        $obyekWisata->delete();
        return redirect()->route('obyek_wisata.manage')->with('success', 'Objek Wisata deleted successfully.');
    }

    private function getGreeting()
    {
        $hour = now()->hour;

        if ($hour < 12) {
            return 'Good Morning';
        } elseif ($hour < 15) {
            return 'Good Afternoon';
        } else {
            return 'Good Evening';
        }
    }
}
