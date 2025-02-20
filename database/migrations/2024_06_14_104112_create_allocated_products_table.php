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
        Schema::create('allocated_products', function (Blueprint $table) {
                $table->id();
                $table->integer('allocation_id')->nullable();
                $table->unsignedBigInteger('requisition_id')->nullable();
                $table->integer('contract_id')->nullable();
                $table->integer('rni_no')->nullable();
                $table->integer('from_where')->nullable();
                $table->integer('to_send')->nullable();
                $table->unsignedBigInteger('product_id')->nullable();
                $table->float('quantity')->nullable();
                $table->float('unit_price')->nullable();
                $table->float('total_price')->nullable();
                $table->integer('product_condition_id')->nullable();
                $table->text('product_identification_no')->nullable();
                $table->integer('reverted')->nullable();
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
        Schema::dropIfExists('allocated_products');
    }
};
