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
        return view('be.reservasi.create', compact('pelanggan', 'paket')); // Diperbaiki view-nya
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi' => 'required|date',
            'harga' => 'required|numeric',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung total bayar otomatis
        $paket = PaketWisata::find($request->id_paket);
        $subtotal = $paket->harga_paket * $request->jumlah_peserta;
        $diskon = $subtotal * ($request->diskon / 100);
        $total_bayar = $subtotal - $diskon;

        Reservasi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_paket' => $request->id_paket,
            'tgl_reservasi' => $request->tgl_reservasi,
            'harga' => $paket->harga_paket,
            'jumlah_peserta' => $request->jumlah_peserta,
            'diskon' => $request->diskon,
            'total_bayar' => $total_bayar // Diisi otomatis
        ]);

        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $paket = PaketWisata::all();
        return view('be.reservasi.edit', compact('reservasi', 'pelanggan', 'paket')); // Diperbaiki path view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung ulang total bayar
        $paket = PaketWisata::find($request->id_paket);
        $subtotal = $paket->harga_paket * $request->jumlah_peserta;
        $total_bayar = $subtotal - ($subtotal * ($request->diskon / 100));

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_paket' => $request->id_paket,
            'tgl_reservasi' => $request->tgl_reservasi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'diskon' => $request->diskon,
            'total_bayar' => $total_bayar
        ]);

        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil dihapus.');
    }
}
