<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role 'admin' ada
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        // Buat user admin
        User::firstOrCreate(
            ['email' => 'putri222@gmail.com'],
            [
                'name' => 'Putri Maya',
                'password' => Hash::make('12345678'), // Ganti sesuai kebutuhan
                'role_id' => $adminRole->_id, // MongoDB pakai _id, bukan id
            ]
        );
    }
}

