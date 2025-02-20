<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('committees')->insert([
            [
                'name' => 'Finance Committee',
                'secretary' => 1,
                'chairman_id' => 2,
                'requisition_id' => 1,
                'committee_type' => 'Demand',
                'is_dpm' => true,
                'status' => 0,
            ],
            [
                'name' => 'Audit Committee',
                'secretary' => 3,
                'chairman_id' => 4,
                'requisition_id' => 1,
                'committee_type' => 'Tech',
                'is_dpm' => false,
                'status' => 0,
            ],
            [
                'name' => 'HR Committee',
                'secretary' => 5,
                'chairman_id' => 6,
                'requisition_id' => 3,
                'committee_type' => 'Demand',
                'is_dpm' => true,
                'status' => 0,
            ],
            [
                'name' => 'IT Committee',
                'secretary' => 7,
                'chairman_id' => 4,
                'requisition_id' => 4,
                'committee_type' => 'Tech',
                'is_dpm' => false,
                'status' => 0,
            ],
            [
                'name' => 'Marketing Committee',
                'secretary' => 2,
                'chairman_id' => 5,
                'requisition_id' => 5,
                'committee_type' => 'Demand',
                'is_dpm' => true,
                'status' => 0,
            ],
        ]);
    }
}