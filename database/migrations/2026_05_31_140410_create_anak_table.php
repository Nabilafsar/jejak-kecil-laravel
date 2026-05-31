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
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')
                ->constrained('pengguna')
                ->cascadeOnDelete();
            $table->foreignId('id_gaya_belajar')
                ->nullable()
                ->constrained('gaya_belajar')
                ->nullOnDelete();
            $table->string('nama_panggilan');
            $table->date('tanggal_lahir');
            $table->integer('level_anak')
                ->default(1);
            $table->integer('total_poin')
                ->default(0);
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
