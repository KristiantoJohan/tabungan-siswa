<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;

class BalanceSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Balance::create([
            'total' => 0,
        ]);
    }
}
