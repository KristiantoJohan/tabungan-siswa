<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::create([
            'name' => 'Kelas 10',
        ]);

        Classes::create([
            'name' => 'Kelas 11',
        ]);

        Classes::create([
            'name' => 'Kelas 12',
        ]);
    }
}
