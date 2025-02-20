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
    Schema::create('file_committees', function (Blueprint $table) {
        $table->id();
        $table->string('committee_name');
        $table->unsignedBigInteger('secretary');
        $table->unsignedBigInteger('chairman');
        $table->unsignedBigInteger('initiator_file_id');
        $table->unsignedBigInteger('initiator_id');
        $table->tinyInteger('is_active')->default(1);
        $table->timestamps();


        $table->foreign('secretary')->references('id')->on('users');
        $table->foreign('chairman')->references('id')->on('users');
        $table->foreign('initiator_file_id')->references('id')->on('initiator_files');
        $table->foreign('initiator_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_committees');
    }
};
