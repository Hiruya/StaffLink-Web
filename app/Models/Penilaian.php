<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Penilaian extends Model
{
    // Nama tabel
    protected $table = 'penilaians';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kategori',
        'kompetensi',
        'metode',
        'target',
        'aktual',
        'hasil_bobot',
        'gap',
        'komentar',
    ];
}
