<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan; // Ensure the Karyawan model is imported

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all(); // Fetch all karyawan from the database
        return view('be.karyawan.index', compact('karyawan')); // Pass the data to the view
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer',
            'nama_karyawan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50', // Sesuaikan dengan panjang kolom di database
        ]);

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }
}
