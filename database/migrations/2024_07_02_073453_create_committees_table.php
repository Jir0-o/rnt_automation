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
    Schema::create('committees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('secretary');
        $table->unsignedBigInteger('chairman_id');
        $table->unsignedBigInteger('requisition_id');
        $table->string('committee_type');
        $table->tinyInteger('is_dpm');
        $table->string('status');
        $table->tinyInteger('is_active')->default(1);
        $table->timestamps();


        $table->foreign('secretary')->references('id')->on('users');
        $table->foreign('chairman_id')->references('id')->on('users');
        $table->foreign('requisition_id')->references('id')->on('requisitions');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committees');
    }
};
