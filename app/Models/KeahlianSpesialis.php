<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeahlianSpesialis extends Model
{
    protected $table = 'keahlian_spesialis';

    protected $fillable = [
        'id_spesialis',
        'keahlian',
    ];

    public function spesialis(): BelongsTo
    {
        return $this->belongsTo(Spesialis::class, 'id_spesialis');
    }
}
