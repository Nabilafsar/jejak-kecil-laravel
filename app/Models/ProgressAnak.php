<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressAnak extends Model
{
    protected $table = 'progress_anak';

    protected $fillable = [
        'id_anak',
        'id_modul',
        'persentase_progress', // ← sesuai database
        'skor',
        'status',
        'tanggal_selesai',     // ← tambah ini
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }

}