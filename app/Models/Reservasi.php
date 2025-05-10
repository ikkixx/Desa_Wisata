<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    // Update the table name to match the actual database table
    protected $table = 'reservasis';

    protected $fillable = [
        'id_pelanggan',
        'id_paket',
        'tgl_reservasi',
        'harga',
        'jumlah_peserta',
        'diskon',
        'nilai_diskon',
        'total_bayar',
        'file_bukti_tf',
        'status_reservasi'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }
}
