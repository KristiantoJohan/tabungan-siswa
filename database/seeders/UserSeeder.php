<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Administrator',
            'password' => Hash::make('admin123'), // ganti kalau mau lebih aman
            'role' => 'ADMIN',
        ]);

        User::create([
            'username' => 'SiswaTest',
            'password' => Hash::make('siswa123'),
            'role' => 'STUDENT',
        ]);
    }
}
