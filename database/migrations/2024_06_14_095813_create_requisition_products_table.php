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
        Schema::create('requisition_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('quantity')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_products');
    }
};
