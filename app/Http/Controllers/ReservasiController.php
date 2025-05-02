<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with(['pelanggan', 'paket'])->get();
        return view('be.reservasi.index', compact('reservasi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $paket = PaketWisata::all();
        return view('be.reservasi.index', compact('pelanggan', 'paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        Reservasi::create($request->all());
        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $paket = PaketWisata::all();
        return view('reservasi.edit', compact('reservasi', 'pelanggan', 'paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());
        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil dihapus.');
    }
}
