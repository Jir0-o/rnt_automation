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
        Schema::create('store_informations', function (Blueprint $table) {
            $table->id();
            $table->string('store_name', 250)->nullable();
            $table->string('store_location', 250)->nullable();
            $table->string('store_contact', 50)->nullable();
            $table->integer('store_type_id')->nullable();
            $table->integer('circle_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->integer('parent_office')->nullable();
            $table->integer('office_type')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('zone_id')->references('id')->on('zones');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_information');
    }
};
