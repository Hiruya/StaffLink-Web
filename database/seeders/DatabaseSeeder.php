<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role 'admin' sudah ada
        // $adminRole = Role::firstOrCreate([
        //     'name' => 'admin',
        // ]);

        // // Buat user admin
        // User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     [
        //         'name' => 'Admin User',
        //         'password' => Hash::make('password'),
        //         'role_id' => $adminRole->_id,
        //     ]
        // );
    }
}
