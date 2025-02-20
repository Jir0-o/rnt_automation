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
        Schema::create('procurement_informations', function (Blueprint $table) {
            $table->id();
            $table->string('tender_number', 300)->nullable();
            $table->date('tender_date')->nullable();
            $table->string('tender_winner', 300)->nullable();
            $table->text('supplier_address')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_information');
    }
};
