<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_poin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')
                ->constrained('anak')
                ->cascadeOnDelete();
            $table->foreignId('id_avatar_shop')
                ->nullable()
                ->constrained('avatar_shop')
                ->nullOnDelete();
            $table->enum('tipe', ['kredit', 'debit']); // kredit = dapat poin, debit = pakai poin
            $table->integer('jumlah_poin');
            $table->string('keterangan'); // contoh: "Beli Avatar Nana", "Selesai Modul X"
            $table->integer('saldo_setelah'); // total_poin setelah transaksi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_poin');
    }
};