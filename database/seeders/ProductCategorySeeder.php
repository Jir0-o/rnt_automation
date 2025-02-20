<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'product_category_name' => 'Electronics',
                'minimum_quantity' => 10,
                'is_defined_individually' => false,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_category_name' => 'Books',
                'minimum_quantity' => 5,
                'is_defined_individually' => false,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more categories as needed
        ]);
    }
}
