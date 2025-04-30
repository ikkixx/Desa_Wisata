<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Obyek_WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $routeName = $request->route()->getName();

    switch ($routeName) {
        case 'admin':
            return view('be.admin.index');
        case 'reservasi':
            return view('reservasi.index');
        case 'users':
            return view('users.index');
        case 'pelanggan':
            return view('pelanggan.index');
        case 'obyek_wisata':
            return view('obyek_wisata.index');
        case 'paket_wisata':
            return view('paket_wisata.index');
        case 'karyawan':
            return view('karyawan.index');
        case 'kategori_wisata':
            return view('kategori_wisata.index');
        case 'berita':
            return view('berita.index');
        case 'penginapan':
            return view('penginapan.index');
        default:
            return view('pelanggan.index');
    }
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
