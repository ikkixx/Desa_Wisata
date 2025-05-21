<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Paket_WisataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Middleware\CheckPelanggan;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route untuk index (semua data)
Route::get('/paket-wisata', [App\Http\Controllers\Paket_wisataController::class, 'feindex'])->name('paket_wisata.index');
Route::get('/wisata', [App\Http\Controllers\Obyek_wisataController::class, 'feindex'])->name('obyek_wisata.index');
Route::get('/stay-cation', [App\Http\Controllers\PenginapanController::class, 'feindex'])->name('nginap_wisata.index');
Route::get('/berita-wisata', [App\Http\Controllers\BeritaController::class, 'feindex'])->name('berita_wisata.index');

// Route untuk detail
Route::get('/paket-wisata/{id}', [App\Http\Controllers\Paket_wisataController::class, 'feshow'])->name('paket_wisata.detail');
Route::get('/wisata/{id}', [App\Http\Controllers\Obyek_wisataController::class, 'feshow'])->name('obyek_wisata.detail');
Route::get('/stay-cation/{id}', [App\Http\Controllers\PenginapanController::class, 'feshow'])->name('nginap_wisata.detail');
Route::get('/berita-wisata/{id}', [App\Http\Controllers\BeritaController::class, 'feshow'])->name('berita_wisata.detail');

// Route::resource('reservasi', App\Http\Controllers\ReservasiController::class)->names([
//     'create' => 'reservasi.create',
//     'store' => 'reservasi.store',
//     // ...
// ]);

Route::prefix('reservasi')->group(function () {
    Route::get('/', [App\Http\Controllers\ReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/create', [App\Http\Controllers\ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/', [App\Http\Controllers\ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/{reservasi}/show', [App\Http\Controllers\ReservasiController::class, 'show'])->name('reservasi.show');
    Route::get('/{reservasi}/edit', [App\Http\Controllers\ReservasiController::class, 'edit'])->name('reservasi.edit');
    Route::put('/{reservasi}', [App\Http\Controllers\ReservasiController::class, 'update'])->name('reservasi.update');
    Route::delete('/{reservasi}', [App\Http\Controllers\ReservasiController::class, 'destroy'])->name('reservasi.destroy');
    Route::get('/api/pending', [App\Http\Controllers\ReservasiController::class, 'getPendingReservations'])->name('reservasi_pending');
    Route::put('/reservasi/{reservasi}/confirm', [App\Http\Controllers\OwnerController::class, 'confirm'])->name('reservasi.confirm');
    Route::put('/reservasi/{reservasi}/reject', [App\Http\Controllers\OwnerController::class, 'reject'])->name('reservasi.reject');
    Route::get('/reservasi/{reservasi}/detail', [App\Http\Controllers\OwnerController::class, 'showReservasi'])->name('be-reservasi.detail');
});

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
    if ($user->level === 'owner') {
        return redirect()->route('owner');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware('auth')->group(function () {
    // Users Routes
    Route::resource('user-manage', App\Http\Controllers\UsersController::class)->middleware(['auth', CheckUserLevel::class . ':admin'])->names([
        'index' => 'user.manage',
        'create' => 'user.create',
        'edit' => 'user.edit',
        'destroy' => 'user.destroy',
        'store' => 'user.store',
        'update' => 'user.update',
    ]);

    // Reservasi Routes
    Route::resource('reservasi', App\Http\Controllers\ReservasiController::class)->names([
        'index' => 'reservasi.manage',
        'create' => 'reservasi.create',
        'store' => 'reservasi.store',
        'show' => 'reservasi.show',
        'edit' => 'reservasi.edit',
        'update' => 'reservasi.update',
        'destroy' => 'reservasi.destroy',
    ]);

    // routes/web.php
    Route::resource('penginapan', \App\Http\Controllers\PenginapanController::class)
        ->names([
            'index' => 'penginapan.manage',
            'create' => 'penginapan.create',
            'store' => 'penginapan.store',
            'edit' => 'penginapan.edit',
            'update' => 'penginapan.update',
            'destroy' => 'penginapan.destroy',
        ]);

    // Objek Wisata Routes
    Route::resource('obyek-wisata', App\Http\Controllers\Obyek_WisataController::class)->names([
        'index' => 'obyek_wisata.manage',
        'create' => 'obyek_wisata.create',
        'store' => 'obyek_wisata.store',
        'show' => 'obyek_wisata.show',
        'edit' => 'obyek_wisata.edit',
        'update' => 'obyek_wisata.update',
        'destroy' => 'obyek_wisata.destroy',
    ]);

    // Kategori Wisata Routes
    Route::resource('kategori_wisata', App\Http\Controllers\Kategori_WisataController::class)->except(['show'])->names([
        'index' => 'kategori_wisata.manage',
        'create' => 'kategori_wisata.create',
        'store' => 'kategori_wisata.store',
        'edit' => 'kategori_wisata.edit',
        'update' => 'kategori_wisata.update',
        'destroy' => 'kategori_wisata.destroy',
    ]);

    // Berita Routes
    Route::resource('berita', App\Http\Controllers\BeritaController::class)->names([
        'index' => 'berita.manage',
        'create' => 'berita.create',
        'store' => 'berita.store',
        'show' => 'berita.show',
        'edit' => 'berita.edit',
        'update' => 'berita.update',
        'destroy' => 'berita.destroy',
    ]);

    // Kategori Berita Routes
    Route::resource('kategori_berita', App\Http\Controllers\Kategori_BeritaController::class)->except(['show'])->names([
        'index' => 'kategori_berita.manage',
        'create' => 'kategori_berita.create',
        'store' => 'kategori_berita.store',
        'edit' => 'kategori_berita.edit',
        'update' => 'kategori_berita.update',
        'destroy' => 'kategori_berita.destroy',
    ]);
});

// Paket Wisata Routes
Route::resource('paket_wisata', Paket_WisataController::class)->names([
    'index'   => 'paket_wisata.manage',  // Ganti 'index' menjadi 'manage'
    'create'  => 'paket_wisata.create',
    'store'   => 'paket_wisata.store',
    'show'    => 'paket_wisata.show',
    'edit'    => 'paket_wisata.edit',
    'update'  => 'paket_wisata.update',
    'destroy' => 'paket_wisata.destroy',
]);
// Karyawan Routes
Route::resource('karyawan', App\Http\Controllers\KaryawanController::class)->names([
    'index' => 'karyawan.manage',
    'create' => 'karyawan.create',
    'store' => 'karyawan.store',
    'edit' => 'karyawan.edit',
    'update' => 'karyawan.update',
    'destroy' => 'karyawan.destroy',
]);

Route::put('user-manage/{user}', [App\Http\Controllers\UsersController::class, 'update'])->name('user.update');

// Route::prefix('admin')->middleware(['auth', CheckUserLevel::class . ':admin'])->group(function () {

// });

Route::prefix('owner')->group(function () {
    // Export PDF
    Route::get('/export-pdf', [OwnerController::class, 'exportPdf'])->name('owner.exportPdf');
    Route::get('/statistik/export-pdf', [OwnerController::class, 'exportStatistikPdf'])->name('owner.statistik.exportPdf');
    Route::get('/export-excel', [OwnerController::class, 'exportExcel'])->name('owner.exportExcel');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Reservasi Routes
    Route::get('/paket-wisata/{paket}/reservasi', [App\Http\Controllers\ReservasiController::class, 'create'])
        ->name('reservasi.create');
    Route::post('/reservasi', [App\Http\Controllers\ReservasiController::class, 'store'])
        ->name('reservasi.store');
    Route::get('/reservasi', [App\Http\Controllers\ReservasiController::class, 'index'])
        ->name('reservasi.index');
    Route::delete('/reservasi/{reservasi}', [App\Http\Controllers\ReservasiController::class, 'destroy'])
        ->name('reservasi.destroy');
});