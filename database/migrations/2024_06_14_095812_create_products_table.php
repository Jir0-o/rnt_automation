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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 250)->nullable();
            $table->float('final_quantity')->nullable();
            $table->float('temp_quantity')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('total_price')->nullable();
            $table->double('final_quantity')->nullable();
            $table->double('temp_quantity')->nullable();
            $table->double('request_quantity')->nullable();
            $table->double('allocation_quantity')->nullable();
            $table->string('bar_code')->nullable();
            $table->unsignedBigInteger('unit_type_id')->nullable();
            $table->unsignedBigInteger('product_sub_categorie_id')->nullable();
            $table->integer('is_frac')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('product_sub_categorie_id')->references('id')->on('product_sub_categories');
            $table->foreign('unit_type_id')->references('id')->on('unit_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
