<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Middleware\CheckPelanggan;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\Obyek_WisataController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('paket_wisata', App\Http\Controllers\PaketWisataController::class);
Route::resource('kategori-wisata', App\Http\Controllers\Kategori_WisataController::class); // Ensure this points to the correct controller
Route::resource('berita', App\Http\Controllers\BeritaController::class)->names([
    'index' => 'berita.index',
    'create' => 'berita.create',
    'store' => 'berita.store',
    'show' => 'berita.show',
    'edit' => 'berita.edit',
    'update' => 'berita.update',
    'destroy' => 'berita.destroy',
]);
Route::resource('penginapan', App\Http\Controllers\PenginapanController::class);
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
Route::get('/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
Route::get('/kategori_wisata', [App\Http\Controllers\Kategori_WisataController::class, 'index'])->name('kategori_wisata');
Route::get('/kategori_berita', [App\Http\Controllers\Kategori_BeritaController::class, 'index'])->name('kategori_berita');




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

Route::resource('obyek-wisata', App\Http\Controllers\Obyek_WisataController::class)->names([
    'index' => 'obyek_wisata.index',
    'create' => 'obyek_wisata.create',
    'store' => 'obyek_wisata.store',
    'show' => 'obyek_wisata.show',
    'edit' => 'obyek_wisata.edit',
    'update' => 'obyek_wisata.update',
    'destroy' => 'obyek_wisata.destroy',
]);

Route::resource('kategori-berita', App\Http\Controllers\Kategori_BeritaController::class)->names([
    'index' => 'kategori_berita.index',
    'create' => 'kategori_berita.create',
    'store' => 'kategori_berita.store',
    'show' => 'kategori_berita.show',
    'edit' => 'kategori_berita.edit',
    'update' => 'kategori_berita.update',
    'destroy' => 'kategori_berita.destroy',
]);

Route::resource('penginapan', App\Http\Controllers\PenginapanController::class)->names([
    'index' => 'penginapan.index',
    'create' => 'penginapan.create',
    'store' => 'penginapan.store',
    'show' => 'penginapan.show',
    'edit' => 'penginapan.edit',
    'update' => 'penginapan.update',
    'destroy' => 'penginapan.destroy',
]);

Route::resource('reservasi', App\Http\Controllers\ReservasiController::class);
Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
Route::resource('karyawan', App\Http\Controllers\KaryawanController::class); // Define the resource route for Karyawan
