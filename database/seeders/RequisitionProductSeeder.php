<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitionProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('requisition_products')->insert([
            [
                'requisition_id' => 1, // assuming a requisition with ID 1 exists
                'product_id' => 1, // assuming a product with ID 1 exists
                'quantity' => 10,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'requisition_id' => 1, // assuming a requisition with ID 1 exists
                'product_id' => 2, // assuming a product with ID 2 exists
                'quantity' => 5,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'requisition_id' => 2, // assuming a requisition with ID 2 exists
                'product_id' => 3, // assuming a product with ID 3 exists
                'quantity' => 20,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more requisition products as needed
        ]);
    }
}
