<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan; // Import model Penginapan

class PenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penginapan = Penginapan::all(); // Fetch all penginapan from the database
        return view('penginapan.index', compact('penginapan')); // Pass data to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penginapan.create'); // Show the form to create a new penginapan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string', // Pastikan deskripsi divalidasi
        ]);

        // Simpan data ke database
        Penginapan::create([
            'nama_penginapan' => $validated['nama_penginapan'],
            'address' => $validated['address'],
            'price' => $validated['price'],
            'deskripsi' => $validated['description'], // Pastikan deskripsi disimpan
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
