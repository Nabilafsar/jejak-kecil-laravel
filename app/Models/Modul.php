<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modul extends Model
{
    protected $table = 'modul';

    protected $fillable = [
        'id_gaya_belajar',
        'judul_modul',
        'deskripsi',
        'tingkat_kesulitan',
        'thumbnail',
        'kategori',
    ];

    public function gayaBelajar(): BelongsTo
    {
        return $this->belongsTo(GayaBelajar::class, 'id_gaya_belajar');
    }

    public function isiModul(): HasMany
    {
        return $this->hasMany(IsiModul::class, 'id_modul')->orderBy('urutan');
    }

    public function kuis(): HasMany
    {
        return $this->hasMany(Kuis::class, 'id_modul')->orderBy('urutan');
    }

    public function progressAnak(): HasMany
    {
        return $this->hasMany(ProgressAnak::class, 'id_modul');
    }

    public function progressSaatIni()
    {
        $anak = auth()->user()?->anak;
        if (!$anak) return null;

        return $this->progressAnak()->where('id_anak', $anak->id)->first();
    }
}