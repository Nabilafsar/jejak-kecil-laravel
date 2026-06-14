<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GayaBelajar extends Model
{
    protected $table = 'gaya_belajar';

    protected $fillable = [
        'nama_gaya',
        'deskripsi',
    ];

    // Relasi ke Anak (dari branch main)
    public function anak()
    {
        return $this->hasMany(Anak::class, 'id_gaya_belajar');
    }

    // Relasi ke Modul (dari branch role-admin)
    public function modul()
    {
        return $this->hasMany(Modul::class, 'id_gaya_belajar');
    }
}