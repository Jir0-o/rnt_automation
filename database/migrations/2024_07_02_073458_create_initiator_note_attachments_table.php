<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('initiator_note_attachments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('initiator_note_id');
        $table->string('files');
        $table->timestamps();


        $table->foreign('initiator_note_id')->references('id')->on('initiator_notes');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiator_note_attachments');
    }
};
