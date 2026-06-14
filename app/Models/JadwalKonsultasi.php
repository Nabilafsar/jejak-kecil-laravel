<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalKonsultasi extends Model
{
    protected $table = 'jadwal_konsultasi';

    protected $fillable = [
        'id_pengguna',
        'id_spesialis',
        'judul_sesi',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    protected $casts = [
        'waktu_mulai'   => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function spesialis(): BelongsTo
    {
        return $this->belongsTo(Spesialis::class, 'id_spesialis');
    }

    public function pesan(): HasMany
    {
        return $this->hasMany(PesanKonsultasi::class, 'id_jadwal')->orderBy('created_at');
    }

    /**
     * Label status ramah tampilan
     */
    public function getLabelStatusAttribute(): string
    {
        return match ($this->status) {
            'akan_datang' => 'Akan Datang',
            'selesai'     => 'Selesai',
            'dibatalkan'  => 'Dibatalkan',
            default       => '-',
        };
    }
}
