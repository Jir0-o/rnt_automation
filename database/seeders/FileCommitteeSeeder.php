<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('file_committees')->insert([
            [
                'committee_name' => 'Opening Committee',
                'secretary' => 1,
                'chairman' => 2,
                'initiator_file_id' => 1,
                'initiator_id' => 1,
            ],
            [
                'committee_name' => 'Evaluation Committee',
                'secretary' => 3,
                'chairman' => 4,
                'initiator_file_id' => 1,
                'initiator_id' => 1,
            ],
            [
                'committee_name' => 'Budge Committee',
                'secretary' => 5,
                'chairman' => 6,
                'initiator_file_id' => 1,
                'initiator_id' => 1,
            ],
            [
                'committee_name' => 'Evaluation Committee',
                'secretary' => 7,
                'chairman' => 2,
                'initiator_file_id' => 4,
                'initiator_id' => 4,
            ],
            [
                'committee_name' => 'Budge Committee',
                'secretary' => 1,
                'chairman' => 7,
                'initiator_file_id' => 5,
                'initiator_id' => 5,
            ],
        ]);
    }
}