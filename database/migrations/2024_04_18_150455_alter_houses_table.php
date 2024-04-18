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
        Schema::table('houses', function (Blueprint $table) {
            $table->foreignId('civillian_id')->constrained('civillians')->onDelete('cascade');
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
