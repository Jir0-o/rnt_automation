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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('auth_by')->nullable(); // User ID (who created this user)
            $table->integer('store_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('signature', 2048)->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();


            $table->foreign('designation_id')->references('id')->on('designations');

            $table->foreign('auth_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
