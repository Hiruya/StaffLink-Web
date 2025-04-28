<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jam_masuk',
        'jam_keluar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
