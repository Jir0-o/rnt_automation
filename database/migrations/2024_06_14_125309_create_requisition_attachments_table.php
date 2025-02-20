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
        Schema::create('requisition_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->text('filename')->nullable();
            $table->text('extension')->nullable();
            $table->binary('file')->nullable(); // Use 'binary' for binary data
            $table->date('upload_date')->nullable();
            $table->tinyInteger('is_active')->default(1); // Default value is 1
            $table->timestamps();        
        
            $table->foreign('requisition_id')->references('id')->on('requisitions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_attachments');
    }
};
