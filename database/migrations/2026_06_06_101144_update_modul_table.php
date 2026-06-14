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
        Schema::table('modul', function (Blueprint $table) {
            $table->dropColumn('tingkat_kesulitan');
            $table->enum('tingkat_kesulitan', ['mudah', 'sedang', 'sulit'])->default('mudah')->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modul', function (Blueprint $table) {
            $table->dropColumn('tingkat_kesulitan');
            $table->integer('tingkat_kesulitan')->default(1);
        });
    }
};
