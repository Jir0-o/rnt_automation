<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiatorNoteAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('initiator_note_attachments')->insert([
            [
                'initiator_note_id' => 1,
                'files' => 'attachment1.pdf',
            ],
            [
                'initiator_note_id' => 1,
                'files' => 'attachment2.pdf',
            ],
            [
                'initiator_note_id' => 1,
                'files' => 'attachment3.pdf',
            ],
            [
                'initiator_note_id' => 4,
                'files' => 'attachment4.pdf',
            ],
            [
                'initiator_note_id' => 5,
                'files' => 'attachment5.pdf',
            ],
        ]);
    }
}