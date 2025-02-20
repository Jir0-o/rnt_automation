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
    Schema::create('initiator_note_reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('initiator_note_id');
        $table->unsignedBigInteger('reviewer_id');
        $table->text('comment');
        $table->string('signature');
        $table->timestamps();


        $table->foreign('initiator_note_id')->references('id')->on('initiator_notes');
        $table->foreign('reviewer_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiator_note_reviews');
    }
};
