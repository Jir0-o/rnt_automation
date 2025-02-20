<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('allocations')->insert([
            [
                'allocation_date' => '2024-06-15',
                'allocation_no' => 'A001',
                'subject' => 'Purchase of office supplies',
                'validity_date' => '2024-07-15',
                'validity_days' => 30,
                'requisition_id' => 1, // assuming a requisition with ID 1 exists
                'auth_level' => 'Level 1',
                'is_issue' => 0,
                'remarks' => 'Need approval',
                'cc' => 'cc@example.com',
                'user_id' => 1, // assuming a user with ID 1 exists
                'reverted' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'allocation_date' => '2024-06-20',
                'allocation_no' => 'A002',
                'subject' => 'Maintenance tools',
                'validity_date' => '2024-07-20',
                'validity_days' => 30,
                'requisition_id' => 2, // assuming a requisition with ID 2 exists
                'auth_level' => 'Level 2',
                'is_issue' => 0,
                'remarks' => 'Pending inspection',
                'cc' => 'cc@example.com',
                'user_id' => 2, // assuming a user with ID 2 exists
                'reverted' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more allocations as needed
        ]);
    }
}
