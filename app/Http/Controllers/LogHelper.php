<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function catat(string $aktivitas, ?string $namaTabel = null, ?int $dataId = null, ?string $deskripsi = null)
    {
        if (Auth::check()) {
            LogAktivitas::create([
                'id_pengguna' => Auth::user()->id,
                'aktivitas'   => $aktivitas,
                'nama_tabel'  => $namaTabel,
                'data_id'     => $dataId,
                'deskripsi'   => $deskripsi,
            ]);
        }
    }
}