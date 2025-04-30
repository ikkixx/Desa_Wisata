<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;

    // Update the table name to match the actual database table
    protected $table = 'paket_wisatas'; // Change this if the table name is different

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'fasilitas',
        'harga_per_pack',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_paket');
    }
}
