<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('product_committees', function (Blueprint $table) {
        $table->id();
        $table->integer('quantity')->nullable();
        $table->double('unit_price')->nullable();
        $table->double('total_price')->nullable();
        $table->unsignedBigInteger('product_id')->nullable();
        $table->unsignedBigInteger('committee_id')->nullable();
        $table->unsignedBigInteger('sub_catagory_id')->nullable();
        $table->string('status');
        $table->text('note')->nullable();
        $table->tinyInteger('is_active')->default(1);
        $table->timestamps();


        $table->foreign('product_id')->references('id')->on('products');
        $table->foreign('committee_id')->references('id')->on('committees');
        $table->foreign('sub_catagory_id')->references('id')->on('product_sub_categories');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_committees');
    }
};
