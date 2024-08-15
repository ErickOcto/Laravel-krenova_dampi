<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->unsignedBigInteger('civilian_id')->nullable(); // Pastikan nilai null diizinkan untuk sementara
        });
        
        Schema::table('houses', function (Blueprint $table) {
            $table->foreign('civilian_id')->references('id')->on('civilians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropForeign(['civillian_id']);
            $table->dropColumn('civillian_id');
        });
    }
};
