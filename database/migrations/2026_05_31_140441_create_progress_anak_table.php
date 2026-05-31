<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')
                ->constrained('anak')
                ->cascadeOnDelete();
            $table->foreignId('id_modul')
                ->constrained('modul')
                ->cascadeOnDelete();
            $table->integer('persentase_progress')
                ->default(0);
            $table->integer('skor')
                ->default(0);
            $table->enum('status', [
                'belum_mulai',
                'sedang_belajar',
                'selesai'
            ])->default('belum_mulai');
            $table->dateTime('tanggal_selesai')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_anak');
    }
};
