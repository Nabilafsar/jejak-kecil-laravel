<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('isi_modul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_modul')->constrained('modul')->onDelete('cascade');
            $table->enum('tipe_konten', ['video', 'teks', 'gambar', 'audio']);
            $table->text('isi_konten'); // URL video/gambar atau teks konten
            $table->integer('urutan')->default(1);
            $table->string('judul_konten')->nullable();
            $table->text('deskripsi_konten')->nullable();
            $table->integer('durasi_menit')->nullable(); // untuk video/audio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isi_modul');
    }
};