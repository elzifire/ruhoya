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
        Schema::rename("teams", "collaborators");
        Schema::table("collaborators", function (Blueprint $table) {
            $table->renameColumn("title", "institute");
            $table->after("title", function (Blueprint $table) {
                $table->string("contribution")->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
