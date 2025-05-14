<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pelanggan;
use App\Models\Karyawan;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profileData = null;

        if ($user->level === 'pelanggan') {
            $profileData = Pelanggan::where('id_user', $user->id)->first();
        } elseif (in_array($user->level, ['admin', 'bendahara', 'owner'])) {
            $profileData = Karyawan::where('id_user', $user->id)->first();
        }

        return view('fe.profile.index', [
            'title' => 'Profile',
            'user' => $user,
            'profileData' => $profileData,
        ]);
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
    public function update(Request $request)
    {
        $user = Auth::user();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'no_hp' => 'required|string|max:15',
                'alamat' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update user basic info
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            // Handle photo upload and update specific table
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('profile-photos');

                if ($user->level === 'pelanggan') {
                    $profile = Pelanggan::where('id_user', $user->id)->firstOrFail();
                    // Delete old photo if exists
                    if ($profile->foto && Storage::exists($profile->foto)) {
                        Storage::delete($profile->foto);
                    }
                    $profile->update([
                        'nama_lengkap' => $request->name,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'foto' => $path
                    ]);
                } elseif (in_array($user->level, ['admin', 'bendahara', 'owner'])) {
                    $profile = Karyawan::where('id_user', $user->id)->firstOrFail();
                    // Delete old photo if exists
                    if ($profile->foto && Storage::exists($profile->foto)) {
                        Storage::delete($profile->foto);
                    }
                    $profile->update([
                        'nama_karyawan' => $request->name,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'foto' => $path
                    ]);
                }
            } else {
                // Update without photo
                if ($user->level === 'pelanggan') {
                    Pelanggan::where('id_user', $user->id)->update([
                        'nama_lengkap' => $request->name,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat
                    ]);
                } elseif (in_array($user->level, ['admin', 'bendahara', 'owner'])) {
                    Karyawan::where('id_user', $user->id)->update([
                        'nama_karyawan' => $request->name,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat
                    ]);
                }
            }

            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
