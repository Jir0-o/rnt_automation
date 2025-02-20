<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'iPhone 13',
                'final_quantity' => 10,
                'temp_quantity' => 10,
                'unit_price' => 1000,
                'total_price' => 10000,
                'unit_type_id' => 1, // assuming a unit type ID
                'product_sub_categorie_id' => 1, // assuming Smartphones has ID 1
                'is_frac' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'MacBook Pro',
                'final_quantity' => 5,
                'temp_quantity' => 5,
                'unit_price' => 2000,
                'total_price' => 10000,
                'unit_type_id' => 1, // assuming a unit type ID
                'product_sub_categorie_id' => 2, // assuming Laptops has ID 2
                'is_frac' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'The Great Gatsby',
                'final_quantity' => 20,
                'temp_quantity' => 20,
                'unit_price' => 10,
                'total_price' => 200,
                'unit_type_id' => 1, // assuming a unit type ID
                'product_sub_categorie_id' => 1, // assuming Fiction has ID 3
                'is_frac' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more products as needed
        ]);
    }
}
