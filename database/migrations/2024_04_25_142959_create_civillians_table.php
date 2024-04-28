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
        Schema::create('civilians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female','nonbinary']);
            $table->boolean('marriage');
            $table->integer('total_children');
            $table->integer('total_familymember');
            $table->unsignedBigInteger('house_id')->nullable();
            $table->unsignedBigInteger('economy_id')->nullable();
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('set null');
            $table->foreign('economy_id')->references('id')->on('economies')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilians');
    }
};
