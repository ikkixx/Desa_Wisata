<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    public function create($id_paket)
    {
        $paket = PaketWisata::findOrFail($id_paket);
        $pelanggan = Pelanggan::where('id_user', Auth::id())->first();
        
        if (!$pelanggan) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu');
        }

        return view('fe.reservasi.create', [
            'paket' => $paket,
            'pelanggan' => $pelanggan,
            'harga_formatted' => number_format($paket->harga_per_pack, 0, ',', '.')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paket' => 'required|exists:paket_wisatas,id',
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'tgl_reservasi' => 'required|date|after_or_equal:today',
            'jumlah_peserta' => 'required|integer|min:1',
            'file_bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $paket = PaketWisata::findOrFail($request->id_paket);
            
            // Calculate total
            $totalBayar = $paket->harga_per_pack * $request->jumlah_peserta;
            $diskon = 0;
            $nilaiDiskon = 0;

            // Check for discount
            if ($paket->diskonAktif) {
                $diskon = $paket->diskonAktif->persen;
                $nilaiDiskon = $totalBayar * $diskon / 100;
            }

            // Store payment proof
            $filePath = $request->file('file_bukti_tf')->store('bukti_transfer', 'public');

            // Create reservation
            Reservasi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_paket' => $request->id_paket,
                'tgl_reservasi' => $request->tgl_reservasi,
                'harga' => $paket->harga_per_pack,
                'jumlah_peserta' => $request->jumlah_peserta,
                'diskon' => $diskon,
                'nilai_diskon' => $nilaiDiskon,
                'total_bayar' => $totalBayar - $nilaiDiskon,
                'file_bukti_tf' => $filePath,
                'status_reservasi' => 'pesan'
            ]);

            DB::commit();
            return redirect()->route('reservasi.index')
                ->with('success', 'Reservasi berhasil dibuat! Silakan tunggu konfirmasi.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal membuat reservasi: '.$e->getMessage());
        }
    }

    public function index()
    {
        $pelanggan = Pelanggan::where('id_user', Auth::id())->first();
        
        if (!$pelanggan) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu');
        }

        $reservasis = Reservasi::with(['paket'])
            ->where('id_pelanggan', $pelanggan->id)
            ->orderBy('tgl_reservasi', 'desc')
            ->get();

        return view('fe.reservasi.index', [
            'reservasis' => $reservasis,
            'statusColors' => [
                'pesan' => 'warning',
                'dibayar' => 'success',
                'selesai' => 'secondary'
            ]
        ]);
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        // Check if reservation can be canceled
        if ($reservasi->status_reservasi !== 'pesan') {
            return back()->with('error', 'Hanya reservasi dengan status "Pesan" yang bisa dibatalkan');
        }

        try {
            // Delete payment proof if exists
            if ($reservasi->file_bukti_tf) {
                Storage::disk('public')->delete($reservasi->file_bukti_tf);
            }
            
            $reservasi->delete();
            
            return redirect()->route('reservasi.index')
                ->with('success', 'Reservasi berhasil dibatalkan');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membatalkan reservasi: '.$e->getMessage());
        }
    }
}