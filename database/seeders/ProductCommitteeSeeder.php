<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_committees')->insert([
            [
                'quantity' => 100,
                'unit_price' => 50.00,
                'total_price' => 5000.00,
                'product_id' => 1,
                'committee_id' => 1,
                'sub_catagory_id' => 1,
                'status' => 1,
                'note' => 'First batch',
            ],
            [
                'quantity' => 200,
                'unit_price' => 30.00,
                'total_price' => 6000.00,
                'product_id' => 2,
                'committee_id' => 1,
                'sub_catagory_id' => 2,
                'status' => 0,
                'note' => 'Second batch',
            ],
            [
                'quantity' => 150,
                'unit_price' => 40.00,
                'total_price' => 6000.00,
                'product_id' => 3,
                'committee_id' => 1,
                'sub_catagory_id' => 1,
                'status' => 2,
                'note' => 'Third batch',
            ],
            [
                'quantity' => 300,
                'unit_price' => 20.00,
                'total_price' => 6000.00,
                'product_id' => 4,
                'committee_id' => 2,
                'sub_catagory_id' => 3,
                'status' => 1,
                'note' => 'Fourth batch',
            ],
            [
                'quantity' => 250,
                'unit_price' => 25.00,
                'total_price' => 6250.00,
                'product_id' => 5,
                'committee_id' => 2,
                'sub_catagory_id' => 4,
                'status' => 0,
                'note' => 'Fifth batch',
            ],
        ]);
    }
}