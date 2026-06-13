<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'modul';

    protected $fillable = [
        'id_gaya_belajar',
        'judul_modul',
        'deskripsi',
        'tingkat_kesulitan',
        'thumbnail',
    ];

    public function gayaBelajar()
    {
        return $this->belongsTo(GayaBelajar::class, 'id_gaya_belajar');
    }

    public function isiModul()
    {
        return $this->hasMany(IsiModul::class, 'id_modul');
    }
}