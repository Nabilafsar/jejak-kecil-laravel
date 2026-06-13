<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('avatar_shop', function (Blueprint $table) {
            $table->id();
            $table->string('nama_avatar');
            $table->string('gambar'); // path/nama file gambar
            $table->integer('harga_poin')->default(250);
            $table->string('warna_background')->default('#FF8C00'); // warna card
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avatar_shop');
    }
};