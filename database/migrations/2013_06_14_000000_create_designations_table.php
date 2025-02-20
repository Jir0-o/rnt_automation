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
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->text('designation')->nullable();
            $table->string('short', 50)->nullable();
            $table->integer('priority_level')->nullable();
            $table->integer('allocation_auth_level')->nullable();
            $table->integer('iv_auth_level')->nullable();
            $table->integer('rni_auth_level')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
