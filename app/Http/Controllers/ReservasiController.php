<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // Untuk admin melihat semua reservasi
        if (Auth::check() && in_array(Auth::user()->level, ['admin', 'bendahara', 'owner'])) {
            $reservasis = Reservasi::with(['pelanggan', 'paket'])->latest()->get();
        }
        // Untuk pelanggan hanya melihat reservasi mereka sendiri
        elseif (Auth::check() && Auth::user()->level === 'pelanggan') {
            $reservasis = Auth::user()->pelanggan->reservasis()->with('paket')->latest()->get();
        }
        // Untuk guest (jika diperlukan)
        else {
            $reservasis = collect();
        }

        $greeting = $this->getGreeting();

        return view('be.reservasi.index', [
            'title' => 'Reservasi Management',
            'reservasis' => $reservasis,
            'greeting' => $greeting
        ]);
    }

    public function create()
    {
        // Untuk pelanggan hanya bisa membuat reservasi untuk diri sendiri
        if (Auth::user()->level === 'pelanggan') {
            $pelanggans = Pelanggan::where('id_user', Auth::id())->get();
        }
        // Untuk admin bisa memilih pelanggan
        else {
            $pelanggans = Pelanggan::all();
        }

        $pakets = PaketWisata::all();
        $greeting = $this->getGreeting();

        return view('be.reservasi.create', [
            'title' => 'Create Reservasi',
            'pelanggans' => $pelanggans,
            'pakets' => $pakets,
            'greeting' => $greeting
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
            'jumlah_peserta' => 'required|integer|min:1',
            'harga' => 'required|numeric',
            'nilai_diskon' => 'nullable|numeric|min:0',
            'total_bayar' => 'required|numeric|min:0',
            'file_bukti_tf' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        // Handle file upload
        if ($request->hasFile('file_bukti_tf')) {
            $validated['file_bukti_tf'] = $request->file('file_bukti_tf')->store('bukti_transfer', 'public');
        }

        // Format tanggal
        $validated['tgl_reservasi'] = Carbon::createFromFormat('Y-m-d\TH:i', $validated['tgl_reservasi']);

        // Authorization check untuk pelanggan
        if (Auth::user()->level === 'pelanggan' && $validated['id_pelanggan'] != Auth::user()->pelanggan->id) {
            abort(403, 'Unauthorized action.');
        }

        // Konversi nilai string ke numeric
        $validated['harga'] = str_replace(['Rp', '.', ' '], '', $validated['harga']);
        $validated['nilai_diskon'] = str_replace(['Rp', '.', ' '], '', $validated['nilai_diskon'] ?? '0');
        $validated['total_bayar'] = str_replace(['Rp', '.', ' '], '', $validated['total_bayar']);

        // Buat reservasi
        Reservasi::create($validated);

        return redirect()->route('reservasi.manage')->with('success', 'Reservasi berhasil dibuat');
    }

    public function show(Reservasi $reservasi)
    {
        // Authorization check
        if (Auth::user()->level === 'pelanggan' && $reservasi->id_pelanggan != Auth::user()->pelanggan->id) {
            abort(403, 'Unauthorized action.');
        }

        $greeting = $this->getGreeting();

        return view('be.reservasi.show', [
            'title' => 'Detail Reservasi',
            'reservasi' => $reservasi->load(['pelanggan.user', 'paket']),
            'greeting' => $greeting
        ]);
    }

    public function edit(Reservasi $reservasi)
    {
        // Authorization check
        if (Auth::user()->level === 'pelanggan' && $reservasi->id_pelanggan != Auth::user()->pelanggan->id) {
            abort(403, 'Unauthorized action.');
        }

        $pelanggans = Pelanggan::all();
        $pakets = PaketWisata::all();
        $greeting = $this->getGreeting();

        return view('be.reservasi.edit', [
            'title' => 'Edit Reservasi',
            'reservasi' => $reservasi,
            'pelanggans' => $pelanggans,
            'pakets' => $pakets,
            'greeting' => $greeting
        ]);
    }

    public function update(Request $request, Reservasi $reservasi)
    {
        // Authorization check
        if (Auth::user()->level === 'pelanggan' && $reservasi->id_pelanggan != Auth::user()->pelanggan->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
            'jumlah_peserta' => 'required|integer|min:1',
            'harga' => 'required|numeric',
            'nilai_diskon' => 'nullable|numeric|min:0',
            'total_bayar' => 'required|numeric|min:0',
            'file_bukti_tf' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        // Dapatkan harga dari paket wisata
        $paket = PaketWisata::findOrFail($validated['id_paket']);
        $validated['harga'] = $paket->harga_per_pack;

        $validated['total_bayar'] = $validated['harga'] * $validated['jumlah_peserta'];
        if ($validated['nilai_diskon']) {
            $validated['total_bayar'] -= $validated['nilai_diskon'];
        }

        $reservasi->update($validated);

        return redirect()->route('reservasi.manage')->with('success', 'Reservasi updated successfully.');
    }

    public function destroy(Reservasi $reservasi)
    {
        // Authorization check
        if (Auth::user()->level === 'pelanggan' && $reservasi->id_pelanggan != Auth::user()->pelanggan->id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Delete the reservation
            $reservasi->delete();

            return redirect()->route('reservasimanage')
                ->with('success', 'Reservasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('reservasimanage')
                ->with('error', 'Gagal menghapus reservasi: ' . $e->getMessage());
        }
    }

    // API untuk mendapatkan data reservasi pending (digunakan di navbar)
    public function getPendingReservations()
    {
        if (!Auth::check() || Auth::user()->level !== 'pelanggan') {
            return response()->json([]);
        }

        $reservasis = Auth::user()->pelanggan->reservasis()
            ->where('status_reservasi', 'pesan')
            ->with('paket')
            ->get();

        return response()->json($reservasis);
    }

    private function getGreeting()
    {
        $hour = Carbon::now()->hour;

        if ($hour < 12) {
            return 'Good Morning';
        } elseif ($hour < 18) {
            return 'Good Afternoon';
        } else {
            return 'Good Evening';
        }
    }
}
