<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan; // Ensure the Karyawan model is imported

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all(); // Fetch all karyawan from the database
        return view('karyawan.index', compact('karyawan')); // Pass the data to the view
    }
}
