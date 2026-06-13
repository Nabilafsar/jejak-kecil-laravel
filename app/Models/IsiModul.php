<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsiModul extends Model
{
    protected $table = 'isi_modul';

    protected $fillable = [
        'id_modul',
        'tipe_konten',
        'isi_konten',
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }
}