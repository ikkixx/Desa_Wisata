<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel di database
    protected $table = 'penginapans'; // Nama tabel: penginapan (bukan penginapans)

    // Sesuaikan dengan kolom yang ada di database
    protected $fillable = [
        'nama_penginapan',
        'deskripsi',
        'fasilitas',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'created_at', // Jika ingin diisi manual
        'updated_at'  // Jika ingin diisi manual
    ];

    // Jika menggunakan timestamp otomatis (sesuai database)
    public $timestamps = true;

    // Jika database menggunakan schema tertentu (contoh: desa_wisata_p3)
    // protected $connection = 'desa_wisata'; // Hapus jika tidak perlu
}
