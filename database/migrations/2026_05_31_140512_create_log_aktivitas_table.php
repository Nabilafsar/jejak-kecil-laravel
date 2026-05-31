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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')
                ->constrained('pengguna')
                ->cascadeOnDelete();
            $table->string('aktivitas');
            $table->string('nama_tabel');
            $table->unsignedBigInteger('data_id')
                ->nullable();
            $table->text('deskripsi')
                ->nullable();
            $table->timestamp('dibuat_pada')
                ->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
