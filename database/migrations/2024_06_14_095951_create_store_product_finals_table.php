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
        Schema::create('store_product_finals', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_id')->nullable();
            $table->integer('rni_no')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('final_quantity')->nullable();
            $table->float('temp_quantity')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('total_price')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('store_id')->references('id')->on('store_informations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_product_finals');
    }
};
