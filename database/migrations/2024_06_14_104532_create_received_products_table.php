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
        Schema::create('Received_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Received_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('rni_no')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('total_price')->nullable();
            $table->integer('unit_type')->nullable();
            $table->float('quantity')->nullable();
            $table->integer('recieved_store')->nullable();
            $table->integer('product_condition_id')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('Received_id')->references('id')->on('Received_informations');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_products');
    }
};
