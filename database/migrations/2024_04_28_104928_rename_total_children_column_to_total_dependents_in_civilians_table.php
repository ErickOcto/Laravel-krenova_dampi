<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('civilians', function (Blueprint $table) {
        // Menambahkan kolom baru
        $table->integer('total_dependents')->nullable();

        // Menghapus kolom lama
        $table->dropColumn('total_children');
    });
}

public function down(): void
{
    Schema::table('civilians', function (Blueprint $table) {
        // Menambahkan kembali kolom lama
        $table->integer('total_children')->nullable();

        // Menghapus kolom baru
        $table->dropColumn('total_dependents');
    });
}

};
