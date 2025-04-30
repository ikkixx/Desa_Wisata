<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Middleware\CheckPelanggan;
use App\Http\Controllers\PaketWisataController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('obyek-wisata', App\Http\Controllers\Obyek_WisataController::class);
Route::resource('paket_wisata', App\Http\Controllers\PaketWisataController::class);
Route::resource('kategori-wisata', App\Http\Controllers\Kategori_WisataController::class); // Ensure this points to the correct controller
Route::resource('berita', App\Http\Controllers\BeritaController::class);
Route::resource('penginapan', App\Http\Controllers\PenginapanController::class);
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
Route::get('/obyek_wisata', [App\Http\Controllers\Obyek_WisataController::class, 'index'])->name('obyek_wisata');
Route::get('/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
Route::get('/kategori_wisata', [App\Http\Controllers\Kategori_WisataController::class, 'index'])->name('kategori_wisata');
Route::get('/kategori_berita', [App\Http\Controllers\Kategori_BeritaController::class, 'index'])->name('kategori_berita');
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/penginapan', [App\Http\Controllers\PenginapanController::class, 'index'])->name('penginapan');


// Registrasi (Hanya untuk Pelanggan)
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginUser'])->name('login-user');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerUser'])->name('register-user');
});

// Logout (Hanya bisa diakses oleh user yang sudah login)
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->level === 'admin') {
        return redirect()->route('admin');
    }
    if ($user->level === 'bendahara') {
        return redirect()->route('bendahara');
    }

    return redirect()->back()->withErrors('Unauthorized access.');
})->middleware('auth')->name('dashboard');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth',  CheckUserLevel::class . ':admin'])
    ->name('admin');

Route::get('/bendahara', [App\Http\Controllers\BendaharaController::class, 'index'])
    ->middleware(['auth', CheckUserLevel::class . ':bendahara'])
    ->name('bendahara');

Route::get('/owner', [App\Http\Controllers\OwnerController::class, 'index'])
    ->middleware(['auth', CheckUserLevel::class . ':owner'])
    ->name('owner');

Route::get('/profilepelanggan', [App\Http\Controllers\PelangganController::class, 'profilePelanggan'])
    ->middleware(['auth', CheckPelanggan::class]);

Route::middleware('auth')->group(function () {
    Route::resource('user-manage', App\Http\Controllers\UsersController::class)->names([
        'index' => 'user.manage',
        'create' => 'user.create',
        'edit' => 'user.edit',
        'destroy' => 'user.destroy',
        'store' => 'user.store',
        'update' => 'user.update',
    ]);
});

Route::resource('reservasi', App\Http\Controllers\ReservasiController::class);
Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
Route::resource('karyawan', App\Http\Controllers\KaryawanController::class); // Define the resource route for Karyawan
