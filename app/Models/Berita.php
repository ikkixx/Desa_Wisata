<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'berita', // content
        'foto',
        'tgl_post',
        'id_kategori_berita' // Make sure this matches your DB column
    ];

    protected $casts = [
        'tgl_post' => 'datetime',
    ];

    /**
     * Get the kategori that owns the berita
     */
    public function kategoriBerita(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori_berita');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori_berita');
    }
}
