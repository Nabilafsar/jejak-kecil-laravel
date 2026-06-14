<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesanKonsultasi extends Model
{
    protected $table = 'pesan_konsultasi';

    protected $fillable = [
        'id_jadwal',
        'pengirim',
        'isi_pesan',
        'lampiran',
        'nama_lampiran',
        'sudah_dibaca',
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalKonsultasi::class, 'id_jadwal');
    }

    /**
     * Apakah pesan ini dari pengguna (bukan spesialis)
     */
    public function dariPengguna(): bool
    {
        return $this->pengirim === 'pengguna';
    }
}
