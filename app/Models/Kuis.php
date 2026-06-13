<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'id_modul',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
        'poin',
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }
}