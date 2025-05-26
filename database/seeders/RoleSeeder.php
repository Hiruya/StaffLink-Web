<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
public function run(): void
{
    $roles = [
        ['name' => 'admin', 'slug' => 'admin'],
        ['name' => 'hrd', 'slug' => 'hrd'],
        ['name' => 'manajer', 'slug' => 'manajer'],
        ['name' => 'karyawan', 'slug' => 'karyawan']
    ];

    foreach ($roles as $role) {
        Role::updateOrCreate(
            ['name' => $role['name']],
            $role
        );
    }
}
}
