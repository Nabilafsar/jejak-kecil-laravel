<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_modul')->constrained('modul')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->string('gambar_pertanyaan')->nullable(); // opsional gambar soal
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c')->nullable();
            $table->string('pilihan_d')->nullable();
            $table->enum('jawaban_benar', ['a', 'b', 'c', 'd']);
            $table->integer('poin')->default(100);
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};