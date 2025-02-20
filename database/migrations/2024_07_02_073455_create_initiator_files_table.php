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
    Schema::create('initiator_files', function (Blueprint $table) {
        $table->id();
        $table->string('file_name');
        $table->string('file_number');
        $table->string('file_catagory');
        $table->string('department')->nullable();
        $table->date('opening_date');
        $table->unsignedBigInteger('oce_dpm')->nullable();
        $table->string('approver');
        $table->string('reviewer');
        $table->string('status');
        $table->tinyInteger('is_complete')->default(0);
        $table->text('note')->nullable();
        $table->timestamps();


        $table->foreign('oce_dpm')->references('id')->on('committees');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiator_files');
    }
};
