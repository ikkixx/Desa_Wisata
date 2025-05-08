<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_beritas';
    protected $fillable = ['kategori_berita'];

    // Relasi ke ObyekWisata (jika ada)
    public function obyekWisata()
    {
        return $this->hasMany(ObyekWisata::class, 'id_kategori_berita');
    }

    // Tambahkan relasi ke Berita (jika diperlukan)
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori');
    }
}   