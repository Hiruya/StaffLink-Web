<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
class LaporanHarian extends Model
{
    protected $fillable = [
        'email', 'tanggal', 'nama', 'departemen', 'shift',
        'jam_kerja', 'pelayanan', 'dokumentasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        
    ];
}
