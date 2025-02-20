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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_send')->nullable();
            $table->unsignedBigInteger('requisition_type_id')->nullable();
            $table->date('requisition_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('auth')->nullable();
            $table->integer('allocation')->nullable();
            $table->text('remarks')->nullable();
            $table->text('cc')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('requisition_type_id')->references('id')->on('requisition_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
