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
        Schema::create('reward_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')
                ->constrained('anak')
                ->cascadeOnDelete();
            $table->foreignId('id_reward')
                ->constrained('reward')
                ->cascadeOnDelete();
            $table->dateTime('tanggal_diklaim')
                ->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_anak');
    }
};
