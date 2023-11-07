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
        Schema::table('hoyas', function (Blueprint $table) {
            $table->after("benefit", function (Blueprint $table) {
                $table->text("description")->nullable();
            });
            $table->dropColumn(["reproduction_system"]);
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
