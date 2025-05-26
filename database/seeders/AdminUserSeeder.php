<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectId;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua role yang dibutuhkan
        $roles = Role::whereIn('name', ['admin', 'karyawan', 'hrd', 'manajer'])->get()->keyBy('name');

        // Pastikan semua role ada
        foreach (['admin', 'karyawan', 'hrd', 'manajer'] as $roleName) {
            if (!isset($roles[$roleName])) {
                throw new \Exception("Role '$roleName' belum ada. Jalankan RoleSeeder terlebih dahulu.");
            }
        }

        // Data user yang akan dibuat
        $users = [
            [
                'name' => 'Admin',
                'email' => 'stafflinkadmin@gmail.com',
                'password' => 'stafflink',
                'role' => 'admin',
            ],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => 'password',
                'role' => 'karyawan',
            ],
            [
                'name' => 'HRD',
                'email' => 'hrd@gmail.com',
                'password' => 'password',
                'role' => 'hrd',
            ],
            [
                'name' => 'Manajer',
                'email' => 'manajer@gmail.com',
                'password' => 'password',
                'role' => 'manajer',
            ],
        ];

        // Buat atau update setiap user
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role_id' => new ObjectId($roles[$userData['role']]->_id),
                ]
            );
        }
    }
}
