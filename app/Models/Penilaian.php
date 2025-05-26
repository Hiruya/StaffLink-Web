<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

// class Penilaian extends Model
// {
//     // Nama tabel
//     protected $collection = 'penilaians';
//     protected $connection = 'mongodb';

//     // Kolom yang dapat diisi
//     protected $fillable = [
//         'nama',
//         'departemen',
//         'kompetensi',
//     ];

//     protected $attributes = [
//         'kompetensi' => []
//     ];
// }


class Penilaian extends Model
{
    protected $collection = 'penilaians';
    protected $connection = 'mongodb';

    protected $fillable = [
        'nama',
        'departemen',
        'tanggal_penilaian',
        'kompetensi_items',
        'total_score',
        'total_persentase',
        'indeks'
    ];

    protected $casts = [
        'tanggal_penilaian' => 'date'
    ];
}
