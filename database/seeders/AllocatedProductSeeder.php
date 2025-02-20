<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllocatedProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('allocated_products')->insert([
            [
                'allocation_id' => 1, // assuming an allocation with ID 1 exists
                'requisition_id' => 1, // assuming a requisition with ID 1 exists
                'contract_id' => 101,
                'rni_no' => 1001,
                'from_where' => 1,
                'to_send' => 50,
                'product_id' => 1, // assuming a product with ID 1 exists
                'quantity' => 100,
                'unit_price' => 15.5,
                'total_price' => 1550,
                'product_condition_id' => 1,
                'product_identification_no' => 'P001-2024',
                'reverted' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'allocation_id' => 2, // assuming an allocation with ID 2 exists
                'requisition_id' => 2, // assuming a requisition with ID 2 exists
                'contract_id' => 102,
                'rni_no' => 1002,
                'from_where' => 2,
                'to_send' => 30,
                'product_id' => 2, // assuming a product with ID 2 exists
                'quantity' => 60,
                'unit_price' => 20.0,
                'total_price' => 1200,
                'product_condition_id' => 1,
                'product_identification_no' => 'P002-2024',
                'reverted' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more allocated products as needed
        ]);
    }
}
