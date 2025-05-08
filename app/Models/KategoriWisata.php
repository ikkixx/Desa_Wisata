<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    use HasFactory;

    protected $table = 'kategori_wisatas';

    // Sesuaikan dengan nama kolom di database
    protected $fillable = ['kategori_wisata'];
    
    // Opsional: Jika ingin menggunakan nama berbeda di aplikasi
    public function getNamaKategoriAttribute()
    {
        return $this->attributes['kategori_wisata'];
    }
    
    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['kategori_wisata'] = $value;
    }
}