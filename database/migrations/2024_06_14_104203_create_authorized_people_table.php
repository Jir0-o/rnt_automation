<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authorized_persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allocation_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->string('authorized_person', 250)->nullable();
            $table->string('ap_id_no', 50)->nullable();
            $table->string('ap_designation', 100)->nullable();
            $table->date('ap_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('allocation_id')->references('id')->on('allocations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorized_people');
    }
};
