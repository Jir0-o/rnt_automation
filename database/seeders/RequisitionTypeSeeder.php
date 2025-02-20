<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitionTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('requisition_types')->insert([
            [
                'name' => 'Purchase',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maintenance',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Office Supplies',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more requisition types as needed
        ]);
    }
}
