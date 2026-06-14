<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    public $timestamps = false;
    
    protected $fillable = [
        'id_pengguna',
        'aktivitas',
        'nama_tabel',
        'data_id',
        'deskripsi',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}