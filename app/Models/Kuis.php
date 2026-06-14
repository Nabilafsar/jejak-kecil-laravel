<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'id_modul',
        'pertanyaan',
        'gambar_pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
        'poin',
        'urutan',
    ];

    public function modul(): BelongsTo
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }

    public function getPilihanAttribute(): array
    {
        $pilihan = [
            'a' => $this->pilihan_a,
            'b' => $this->pilihan_b,
        ];

        if ($this->pilihan_c) $pilihan['c'] = $this->pilihan_c;
        if ($this->pilihan_d) $pilihan['d'] = $this->pilihan_d;

        return $pilihan;
    }
}