<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use App\Models\GayaBelajar;
use App\Models\TransaksiPoin;
use App\Models\AvatarShop;
use Illuminate\Database\Eloquent\Relations\HasMany;      // ← tambahkan ini
class Anak extends Model
{
    protected $table = 'anak';

    protected $fillable = [
        'id_pengguna',
        'id_gaya_belajar',
        'nama_panggilan',
        'tanggal_lahir',
        'level_anak',
        'total_poin',
        'avatar'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function gayaBelajar()
    {
        return $this->belongsTo(
            GayaBelajar::class,
            'id_gaya_belajar'
        );
    }

    public function transaksiPoin(): HasMany
    {
        return $this->hasMany(TransaksiPoin::class, 'id_anak')->latest();
    }

    public function avatarDibeli()
    {
        return $this->belongsToMany(
            AvatarShop::class,
            'transaksi_poin',
            'id_anak',
            'id_avatar_shop'
        )->whereNotNull('transaksi_poin.id_avatar_shop');
    }
}