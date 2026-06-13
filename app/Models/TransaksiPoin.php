<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPoin extends Model
{
    protected $table = 'transaksi_poin';

    protected $fillable = [
        'id_anak',
        'id_avatar_shop',
        'tipe',
        'jumlah_poin',
        'keterangan',
        'saldo_setelah',
    ];

    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }

    public function avatarShop(): BelongsTo
    {
        return $this->belongsTo(AvatarShop::class, 'id_avatar_shop');
    }

    public function getLabelTipeAttribute(): string
    {
        return $this->tipe === 'kredit' ? '+ Poin Masuk' : '- Poin Keluar';
    }

    public function getWarnaTipeAttribute(): string
    {
        return $this->tipe === 'kredit' ? 'text-green-600' : 'text-red-500';
    }
}