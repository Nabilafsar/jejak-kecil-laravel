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
        Schema::create('modul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gaya_belajar')
                ->nullable()
                ->constrained('gaya_belajar')
                ->nullOnDelete();
            $table->string('judul_modul');
            $table->text('deskripsi')->nullable();
            $table->integer('tingkat_kesulitan')
                ->default(1);
            $table->string('thumbnail')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul');
    }
};
