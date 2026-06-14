<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keahlian_spesialis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_spesialis')->constrained('spesialis')->onDelete('cascade');
            $table->string('keahlian'); // "Dukungan ASD", "Terapi Bermain", dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keahlian_spesialis');
    }
};
