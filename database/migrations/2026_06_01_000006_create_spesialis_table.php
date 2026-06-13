<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spesialis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gelar')->nullable();           // Dr., M.Psi, S.Psi, dll
            $table->string('spesialisasi');                // Spesialis Kognitif, Psikolog Anak, dll
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->integer('jumlah_ulasan')->default(0);
            $table->decimal('biaya_sesi', 10, 0)->default(0);
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spesialis');
    }
};
