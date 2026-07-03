<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kursushobi.com',
            'phone' => '081234567890',
            'password' => Hash::make('admin123'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Peserta Demo',
            'email' => 'peserta@kursushobi.com',
            'phone' => '081234567891',
            'password' => Hash::make('peserta123'),
            'role_id' => 2,
        ]);
    }
}
