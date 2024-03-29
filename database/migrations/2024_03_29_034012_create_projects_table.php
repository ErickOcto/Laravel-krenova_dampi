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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('company_id');
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->longText('description')->nullable();
            $table->date('p_start')->nullable();
            $table->date('p_end')->nullable();
            $table->longText('address')->nullable();
            $table->string('cost')->nullable();
            $table->string('imageUrl')->nullable();
            $table->enum('status', ['On Progress', 'Completed', 'Failed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
