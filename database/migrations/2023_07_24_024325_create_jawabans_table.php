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
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('event_id');
            $table->string('pdf_filepath')->nullable();
            $table->string('pdf_original_name')->nullable();
            $table->string('dimensi_kepemimpinan')->nullable();
            $table->json('type1_formatted_value')->nullable();
            $table->json('type2_formatted_value')->nullable();
            $table->string('progress');
            $table->string('inconsistent_dimension')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawabans');
    }
};
