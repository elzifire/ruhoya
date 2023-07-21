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
        Schema::create('hoyas', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("local_name");
            $table->string("author");
            $table->string("origin");
            $table->string("type_information");
            $table->string("publication");
            $table->string("publication_link");
            $table->string("etymology");
            $table->string("benefit");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoyas');
    }
};
