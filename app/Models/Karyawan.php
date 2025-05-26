<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;

class Karyawan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'karyawans';

    protected $fillable = [
        'user_id',
        'employee_id',
        'name',
        'department',
        'region',
        'education',
        'gender',
        'recruitment_channel',
        'no_of_trainings',
        'age',
    ];

    // Hapus cast ObjectId karena tidak valid
    protected $casts = [
        'employee_id' => 'integer',
        'no_of_trainings' => 'integer',
        'age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
