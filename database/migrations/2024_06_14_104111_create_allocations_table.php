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
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->date('allocation_date')->nullable();
            $table->text('allocation_no')->nullable();
            $table->text('subject')->nullable();
            $table->date('validity_date')->nullable();
            $table->integer('validity_days')->nullable();
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->text('auth_level')->nullable();
            $table->integer('is_issue')->nullable();
            $table->text('remarks')->nullable();
            $table->text('cc')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('reverted')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('requisition_id')->references('id')->on('requisitions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
