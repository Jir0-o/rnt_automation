<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitionSeeder extends Seeder
{
    public function run()
    {
        DB::table('requisitions')->insert([
            [
                'requisition_send' => 100,
                'requisition_type_id' => 1, // assuming 'Purchase' has ID 1
                'requisition_date' => '2024-06-01',
                'user_id' => 2, // assuming a user with ID 1 exists
                'status' => 1,
                'auth' => 1,
                'allocation' => 50,
                'remarks' => 'Urgent purchase required',
                'cc' => 'cc@example.com',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'requisition_send' => 50,
                'requisition_type_id' => 2, // assuming 'Maintenance' has ID 2
                'requisition_date' => '2024-06-10',
                'user_id' => 2, // assuming a user with ID 2 exists
                'status' => 0,
                'auth' => 0,
                'allocation' => 20,
                'remarks' => 'Regular maintenance',
                'cc' => 'cc@example.com',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more requisitions as needed
        ]);
    }
}
