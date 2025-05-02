<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Penilaian extends Model
{
    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'penilaians';  // Nama tabel di database

    // Tentukan kolom yang dapat diisi massal
    protected $fillable = [
        'kompetensi',
        'metode',
        'target',
        'aktual',
        'komentar',
        'gap',
        'hasil_bobot'
    ];
}
