<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiatorNoteReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('initiator_note_reviews')->insert([
            [
                'initiator_note_id' => 1,
                'reviewer_id' => 3,
                'comment' => 'Review comment 1',
                'signature' => 'Reviewer 1',
            ],
            [
                'initiator_note_id' => 1,
                'reviewer_id' => 4,
                'comment' => 'Review comment 2',
                'signature' => 'Reviewer 2',
            ],
            [
                'initiator_note_id' => 1,
                'reviewer_id' => 5,
                'comment' => 'Review comment 3',
                'signature' => 'Reviewer 3',
            ],
            [
                'initiator_note_id' => 1,
                'reviewer_id' => 6,
                'comment' => 'Review comment 4',
                'signature' => 'Reviewer 4',
            ],
            [
                'initiator_note_id' => 5,
                'reviewer_id' => 5,
                'comment' => 'Review comment 5',
                'signature' => 'Reviewer 5',
            ],
        ]);
    }
}