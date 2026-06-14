<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Modul;
use App\Models\ProgressAnak;
use Illuminate\Support\Facades\Auth;

class DashboardPenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();
        $anak     = Anak::where('id_pengguna', $pengguna->id)->first();

        $modulSelesai  = 0;
        $totalWaktu    = '0 Menit';
        $rataRataSkor  = 0;
        $totalModul    = Modul::count();

        if ($anak) {
            $progress = ProgressAnak::where('id_anak', $anak->id)->get();

            $modulSelesai = $progress->where('status', 'selesai')->count();

            $totalMenit   = $modulSelesai * 15;
            $jam          = intdiv($totalMenit, 60);
            $menit        = $totalMenit % 60;
            $totalWaktu   = $jam > 0
                ? $jam . ' Jam' . ($menit > 0 ? ' ' . $menit . ' Menit' : '')
                : ($menit > 0 ? $menit . ' Menit' : '0 Menit');

            $skorData    = $progress->whereNotNull('skor');
            $rataRataSkor = $skorData->isNotEmpty()
                ? (int) round($skorData->avg('skor'))
                : 0;
        }

        return view('pengguna.DashboardPengguna', compact(
            'anak',
            'modulSelesai',
            'totalModul',
            'totalWaktu',
            'rataRataSkor'
        ));
    }
}