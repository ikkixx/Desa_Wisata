<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObyekWisata; // Import model ObyekWisata

class Obyek_WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obyek_wisata = \App\Models\ObyekWisata::all(); // Fetch all obyek wisata
        return view('be.obyek_wisata.index', compact('obyek_wisata')); // Pass data to view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_wisata = \App\Models\KategoriWisata::all(); // Fetch kategori wisata
        return view('be.obyek_wisata.create', compact('kategori_wisata')); // Pass data to view
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
