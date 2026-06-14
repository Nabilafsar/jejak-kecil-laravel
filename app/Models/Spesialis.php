<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spesialis extends Model
{
    protected $table = 'spesialis';

    protected $fillable = [
        'nama',
        'gelar',
        'spesialisasi',
        'deskripsi',
        'foto',
        'rating',
        'jumlah_ulasan',
        'biaya_sesi',
        'tersedia',
    ];

    protected $casts = [
        'tersedia' => 'boolean',
        'rating'   => 'float',
    ];

    public function keahlian(): HasMany
    {
        return $this->hasMany(KeahlianSpesialis::class, 'id_spesialis');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(JadwalKonsultasi::class, 'id_spesialis');
    }

    /**
     * Nama lengkap dengan gelar
     */
    public function getNamaLengkapAttribute(): string
    {
        return trim($this->nama . ($this->gelar ? ', ' . $this->gelar : ''));
    }

    /**
     * Format biaya sesi ke Rupiah
     */
    public function getBiayaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->biaya_sesi, 0, ',', '.');
    }
}
