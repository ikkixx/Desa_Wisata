<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PenginapanController extends Controller
{
    public function index()
    {
        $penginapan = Penginapan::all();
        $greeting = $this->getGreeting();

        return view('be.penginapan.index', [
            'title' => 'Manajemen Penginapan',
            'penginapan' => $penginapan,
            'greeting' => $greeting,
        ]);
    }

    public function create()
    {
        $greeting = $this->getGreeting();
        return view('be.penginapan.create', [
            'title' => 'Tambah Penginapan',
            'greeting' => $greeting,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string|max:255',
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto5' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_penginapan', 'deskripsi', 'fasilitas']);

        // Upload foto
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("foto{$i}")) {
                $data["foto{$i}"] = $request->file("foto{$i}")->store('penginapan');
            } elseif ($i === 1) {
                // Foto1 wajib diisi
                return back()->withErrors(['foto1' => 'Foto utama wajib diupload']);
            }
        }

        Penginapan::create($data);

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil ditambahkan');
    }

    public function edit(Penginapan $penginapan)
    {
        $greeting = $this->getGreeting();
        return view('be.penginapan.edit', [
            'title' => 'Edit Penginapan',
            'penginapan' => $penginapan,
            'greeting' => $greeting,
        ]);
    }

    public function update(Request $request, Penginapan $penginapan)
    {
        $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string|max:255',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto5' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_penginapan', 'deskripsi', 'fasilitas']);

        // Update foto
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("foto{$i}")) {
                // Hapus foto lama
                if ($penginapan["foto{$i}"]) {
                    Storage::delete($penginapan["foto{$i}"]);
                }
                $data["foto{$i}"] = $request->file("foto{$i}")->store('penginapan');
            } else {
                // Pertahankan foto lama jika tidak diupdate
                $data["foto{$i}"] = $penginapan["foto{$i}"];
            }
        }

        $penginapan->update($data);

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil diperbarui');
    }

    public function destroy(Penginapan $penginapan)
    {
        // Hapus file foto
        for ($i = 1; $i <= 5; $i++) {
            if ($penginapan["foto{$i}"]) {
                Storage::delete($penginapan["foto{$i}"]);
            }
        }

        $penginapan->delete();

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil dihapus');
    }

    private function getGreeting()
    {
        $now = Carbon::now();
        return match (true) {
            $now->hour >= 5 && $now->hour < 12 => 'Selamat Pagi',
            $now->hour >= 12 && $now->hour < 18 => 'Selamat Siang',
            default => 'Selamat Malam',
        };
    }
}
