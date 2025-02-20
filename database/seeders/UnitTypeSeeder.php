<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('unit_types')->insert([
            [
                'name' => 'Piece',
                'symbol' => 'pc',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kilogram',
                'symbol' => 'kg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liter',
                'symbol' => 'L',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more unit types as needed
        ]);
    }
}
