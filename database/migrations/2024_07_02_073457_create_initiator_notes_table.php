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
    Schema::create('initiator_notes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('initiator_file_id');
        $table->unsignedBigInteger('initiator_id');
        $table->text('note');
        $table->date('date');
        $table->tinyInteger('is_closing_note');
        $table->string('status')->default(0);
        $table->text('vc_note')->nullable();
        $table->timestamps();


        $table->foreign('initiator_file_id')->references('id')->on('initiator_files');
        $table->foreign('initiator_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiator_notes');
    }
};
