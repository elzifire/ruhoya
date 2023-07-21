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
        Schema::create('hoya_spreads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoya_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string("latitude");
            $table->string("longitude");
            $table->string("description");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoya_spreads');
    }
};
