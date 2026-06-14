<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Pengguna;
use App\Models\Modul;
use App\Models\Kuis;
use App\Models\ProgressAnak;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers     = Pengguna::where('role', 'orang_tua')->count();
        $activeUsers    = LogAktivitas::distinct('id_pengguna')->count('id_pengguna');
        $totalModul     = Modul::count();
        $totalKuis      = Kuis::count();

        $totalProgress  = ProgressAnak::count();
        $selesai        = ProgressAnak::where('status', 'selesai')->count();
        $completionRate = $totalProgress > 0 ? round(($selesai / $totalProgress) * 100, 1) : 0;

        $recentActivity = LogAktivitas::with('pengguna')
                            ->orderBy('dibuat_pada', 'desc')
                            ->limit(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'totalModul',
            'totalKuis',
            'completionRate',
            'recentActivity'
        ));
    }
}