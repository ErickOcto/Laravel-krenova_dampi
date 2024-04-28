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
        Schema::create('economies', function (Blueprint $table) {
            $table->id();
            $table->string('job_status');
            $table->integer('monthly_income');
            $table->string('job_category');
            $table->integer('monthly_spending');
            $table->string('poverty_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('economies');
    }
};
