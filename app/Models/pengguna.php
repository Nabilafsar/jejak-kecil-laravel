<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'foto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function anak()
    {
        return $this->hasOne(Anak::class, 'id_pengguna'); // ← O kapital
    }
}