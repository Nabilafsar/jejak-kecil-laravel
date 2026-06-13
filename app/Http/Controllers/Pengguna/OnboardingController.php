<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\GayaBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function index()
    {
        $gayaBelajar = GayaBelajar::all();
        return view('pengguna.onboarding', compact('gayaBelajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_panggilan'  => 'required|max:100',
            'tanggal_lahir'   => 'required|date',
            'level_anak'      => 'required|integer',
            'id_gaya_belajar' => 'required|exists:gaya_belajar,id'
        ]);

        Anak::create([
            'id_pengguna'     => Auth::id(),
            'id_gaya_belajar' => $request->id_gaya_belajar,
            'nama_panggilan'  => $request->nama_panggilan,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'level_anak'      => $request->level_anak,
            'total_poin'      => 0,
        ]);

        

        return redirect()
            ->route('pengguna.DashboardPengguna')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}