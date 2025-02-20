<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiatorNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('initiator_notes')->insert([
            [
                'initiator_file_id' => 1,
                'initiator_id' => 1,
                'note' => 'First finance note',
                'date' => '2024-01-15',
                'is_closing_note' => 0,
                'status' => 0,
                'vc_note' => 'Reviewed',
            ],
            [
                'initiator_file_id' => 1,
                'initiator_id' => 1,
                'note' => 'First audit note',
                'date' => '2024-02-15',
                'is_closing_note' => 0,
                'status' => 1,
                'vc_note' => 'Reviewed',
            ],
            [
                'initiator_file_id' => 1,
                'initiator_id' => 1,
                'note' => 'First HR note',
                'date' => '2024-03-15',
                'is_closing_note' => 1,
                'status' => 0,
                'vc_note' => 'Reviewed',
            ],
            [
                'initiator_file_id' => 4,
                'initiator_id' => 4,
                'note' => 'First IT note',
                'date' => '2024-04-15',
                'is_closing_note' => 0,
                'status' => 1,
                'vc_note' => 'Reviewed',
            ],
            [
                'initiator_file_id' => 5,
                'initiator_id' => 5,
                'note' => 'First marketing note',
                'date' => '2024-05-15',
                'is_closing_note' => 0,
                'status' => 0,
                'vc_note' => 'Reviewed',
            ],
        ]);
    }
}