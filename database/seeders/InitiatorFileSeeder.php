<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiatorFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('initiator_files')->insert([
            [
                'file_name' => 'File A',
                'file_number' => 'A001',
                'file_catagory' => 'Finance',
                'department' => 'Finance', 
                'opening_date' => '2024-01-01',
                'oce_dpm' => 1,
                'approver' => '2',
                'reviewer' => '3, 4, 5, 6',
                'status' => 0,
                'is_complete' => 0,
                'note' => 'Initial finance file',
            ],
            [
                'file_name' => 'File B',
                'file_number' => 'B002',
                'file_catagory' => 'Audit',
                'department' => 'Audit',
                'opening_date' => '2024-02-01',
                'oce_dpm' => 2,
                'approver' => '2',
                'reviewer' => '3, 4, 5, 6',
                'status' => 0,
                'is_complete' => 1,
                'note' => 'Audit file',
            ],
            [
                'file_name' => 'File C',
                'file_number' => 'C003',
                'file_catagory' => 'HR',
                'department' => 'HR',
                'opening_date' => '2024-03-01',
                'oce_dpm' => 3,
                'approver' => '2',
                'reviewer' => '3, 4, 5, 6',
                'status' => 1,
                'is_complete' => 0,
                'note' => 'HR file',
            ],
            [
                'file_name' => 'File D',
                'file_number' => 'D004',
                'file_catagory' => 'IT',
                'department' => 'IT',
                'opening_date' => '2024-04-01',
                'oce_dpm' => 4,
                'approver' => '2',
                'reviewer' => '3, 4, 5, 6',
                'status' => 0,
                'is_complete' => 1,
                'note' => 'IT file',
            ],
            [
                'file_name' => 'File E',
                'file_number' => 'E005',
                'file_catagory' => 'Marketing',
                'department' => 'Marketing',
                'opening_date' => '2024-05-01',
                'oce_dpm' => 5,
                'approver' => '2',
                'reviewer' => '3, 4, 5, 6',
                'status' => 0,
                'is_complete' => 1,
                'note' => 'Marketing file',
            ],
        ]);
    }
}