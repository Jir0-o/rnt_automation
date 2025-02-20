<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Md. Kamrul Hasan',
            'email' => 'hasan@email.com',
            'designation_id' => 1,
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'name' => 'Nadim Hossain',
            'email' => 'nadim@gmail.com',
            'designation_id' => 2,
            'password' => bcrypt('123456789')
        ]);
    }
}
