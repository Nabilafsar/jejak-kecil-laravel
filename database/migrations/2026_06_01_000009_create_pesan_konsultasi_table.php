<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal')->constrained('jadwal_konsultasi')->onDelete('cascade');
            $table->enum('pengirim', ['pengguna', 'spesialis']);
            $table->text('isi_pesan');
            $table->string('lampiran')->nullable();        // path file PDF/gambar
            $table->string('nama_lampiran')->nullable();   // nama file asli
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_konsultasi');
    }
};
