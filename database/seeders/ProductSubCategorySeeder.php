<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSubCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('product_sub_categories')->insert([
            [
                'product_sub_category_name' => 'Smartphones',
                'product_category_id' => 1, // assuming Electronics has ID 1
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_sub_category_name' => 'Laptops',
                'product_category_id' => 1, // assuming Electronics has ID 1
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_sub_category_name' => 'Fiction',
                'product_category_id' => 2, // assuming Books has ID 2
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more subcategories as needed
        ]);
    }
}
