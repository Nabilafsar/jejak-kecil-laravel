<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')->constrained('anak')->onDelete('cascade');
            $table->foreignId('id_modul')->constrained('modul')->onDelete('cascade');
            $table->integer('persentase_progress')->default(0); // 0-100
            $table->integer('skor')->nullable();                 // skor kuis terakhir
            $table->enum('status', ['belum_dimulai', 'sedang_dipelajari', 'selesai'])->default('belum_dimulai');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();

            $table->unique(['id_anak', 'id_modul']); // satu progress per anak per modul
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_anak');
    }
};