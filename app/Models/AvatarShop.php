<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AvatarShop extends Model
{
    protected $table = 'avatar_shop';

    protected $fillable = [
        'nama_avatar',
        'gambar',
        'harga_poin',
        'warna_background',
        'is_active',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiPoin::class, 'id_avatar_shop');
    }
}