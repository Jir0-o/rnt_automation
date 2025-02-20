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
        Schema::create('Received_informations', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_id')->nullable();
            $table->integer('rni_no')->nullable();
            $table->date('recieve_date')->nullable();
            $table->text('recieved_by')->nullable();
            $table->integer('auth')->nullable();
            $table->integer('status')->nullable();
            $table->text('comments')->nullable();
            $table->text('cc')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recieve_information');
    }
};
