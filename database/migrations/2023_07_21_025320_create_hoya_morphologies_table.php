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
        Schema::create('hoya_morphologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoya_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string("stem");             // Batang
            $table->string("leaves");           // Daun
            $table->string("flowers");          // Bentuk bunga
            $table->string("flower_buds");      // Kuncup bunga
            $table->string("flower_size");      // Ukuran bunga
            $table->string("flower_colors");    // Warna bunga
            $table->string("roots");            // Akar
            $table->string("shoots");           // Tunas
            $table->string("reproduction_system");  // Sistem reproduksi
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoya_morphologies');
    }
};
