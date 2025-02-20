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
        Schema::create('supply_order_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proc_id')->nullable();
            $table->text('so_no')->charset('latin1')->collation('latin1_swedish_ci')->nullable();
            $table->date('so_date')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();

            $table->foreign('proc_id')->references('id')->on('procurement_informations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_order_information');
    }
};
