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
        Schema::create('isi_modul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_modul')
                ->constrained('modul')
                ->cascadeOnDelete();
            $table->enum('tipe_konten', [
                'teks',
                'gambar',
                'video'
            ]);
            $table->longText('isi_konten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_modul');
    }
};
