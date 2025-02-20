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
        Schema::create('issue_vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('auth_id')->nullable();
            $table->text('issue_no')->nullable();
            $table->date('issue_date')->nullable();
            $table->integer('issue_by_where')->nullable();
            $table->text('vehicle')->nullable();
            $table->unsignedBigInteger('allocation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('auth')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('issue_vouchers');
    }
};
