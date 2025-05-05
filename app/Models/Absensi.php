<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = [
        'user_id', 'tanggal', 'waktu_masuk', 'waktu_keluar', 'lokasi_masuk', 'lokasi_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

