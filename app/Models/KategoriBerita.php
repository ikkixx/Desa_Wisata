<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_beritas';
    
    protected $fillable = [
        'nama_kategori', // Changed from 'kategori_berita' for better naming
        'slug' // Optional but recommended
    ];

    /**
     * Get all beritas for this kategori
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class, 'id_kategori_berita');
    }
}