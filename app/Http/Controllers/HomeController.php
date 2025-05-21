<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\ObyekWisata;
use App\Models\Penginapan;
use App\Models\Berita;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketWisatas = PaketWisata::latest()->take(3)->get();
        $obyekWisatas = ObyekWisata::with('kategoriWisata')->latest()->take(3)->get();
        $penginapans = Penginapan::latest()->take(3)->get();
        $beritas = Berita::with('kategori')->latest()->take(3)->get();

        return view('home.index', compact('paketWisatas', 'obyekWisatas', 'penginapans', 'beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
