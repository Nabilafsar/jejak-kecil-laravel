<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gaya_belajar')->constrained('gaya_belajar')->onDelete('cascade');
            $table->string('judul_modul');
            $table->text('deskripsi')->nullable();
            $table->enum('tingkat_kesulitan', ['mudah', 'menengah', 'sulit'])->default('mudah');
            $table->string('thumbnail')->nullable();
            $table->string('kategori')->default('Umum'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul');
    }
};