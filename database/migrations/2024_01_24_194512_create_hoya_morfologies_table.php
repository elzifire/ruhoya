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
        Schema::create('hoya_morfologies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hoya_id');
            $table->unsignedBigInteger('morfology_id');
            $table->string("value");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hoya_id')->references('id')->on('hoyas')->onDelete('cascade');
            $table->foreign('morfology_id')->references('id')->on('morfologies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoya_morfologies');
    }
};
