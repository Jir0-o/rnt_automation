<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    public function run()
    {
        DB::table('designations')->insert([
            [
                'designation' => 'Manager',
                'short' => 'Mgr',
                'priority_level' => 1,
                'allocation_auth_level' => 2,
                'iv_auth_level' => 3,
                'rni_auth_level' => 2,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation' => 'Assistant Manager',
                'short' => 'AsstMgr',
                'priority_level' => 2,
                'allocation_auth_level' => 3,
                'iv_auth_level' => 2,
                'rni_auth_level' => 3,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more designations as needed
        ]);
    }
}
