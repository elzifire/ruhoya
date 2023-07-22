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
            $table->unsignedBigInteger('hoya_id');
            $table->string("latitude");
            $table->string("longitude");
            $table->string("description");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hoya_id')->references('id')->on('hoyas')->onDelete('cascade');
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
