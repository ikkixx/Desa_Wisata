<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::all(); // Fetch all berita
        return view('berita.index', compact('berita')); // Pass data to view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_berita = \App\Models\KategoriBerita::all(); // Fetch kategori berita
        return view('berita.create', compact('kategori_berita')); // Pass data to view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
