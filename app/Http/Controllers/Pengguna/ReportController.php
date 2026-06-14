<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\ProgressAnak;
use App\Models\Modul;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();

        // Cari anak secara langsung dari tabel anak, jangan andalkan relasi
        $anak = Anak::where('id_pengguna', $pengguna->id)->first();

        // Jika belum ada data anak, tetap tampilkan halaman report dengan data kosong
        if (!$anak) {
            return view('pengguna.report.index', [
                'anak'              => null,
                'totalBelajar'      => 0,
                'totalWaktu'        => '0 Jam',
                'totalPoin'         => 0,
                'modulSelesai'      => 0,
                'totalModul'        => 0,
                'skorPerModul'      => collect(),
                'modulSudahSelesai' => collect(),
                'rekomendasiModul'  => Modul::inRandomOrder()->first(),
                'rataRataSkor'      => 0,
            ]);
        }

        // Semua progress milik anak ini
        $semuaProgress = ProgressAnak::with('modul')
            ->where('id_anak', $anak->id)
            ->get();

        // ── Statistik Utama ──────────────────────────────────────
        $totalModul   = $semuaProgress->count();
        $modulSelesai = $semuaProgress->where('status', 'selesai')->count();
        $totalPoin    = $anak->total_poin ?? 0;

        $totalBelajar = $totalModul > 0
            ? (int) round($semuaProgress->avg('persentase_progress'))
            : 0;

        $totalMenitBelajar = $modulSelesai * 15;
        $jamBelajar        = intdiv($totalMenitBelajar, 60);
        $menitBelajar      = $totalMenitBelajar % 60;
        $totalWaktu        = $jamBelajar > 0
            ? $jamBelajar . ' Jam' . ($menitBelajar > 0 ? ' ' . $menitBelajar . 'm' : '')
            : ($menitBelajar > 0 ? $menitBelajar . ' Menit' : '0 Jam');

        // ── Skor Kuis per Modul ──────────────────────────────────
        $skorPerModul = $semuaProgress
            ->whereNotNull('skor')
            ->map(fn($p) => [
                'judul' => $p->modul?->judul_modul ?? '-',
                'skor'  => $p->skor,
            ])
            ->values();

        // ── Modul yang Selesai ───────────────────────────────────
        $modulSudahSelesai = $semuaProgress
            ->where('status', 'selesai')
            ->map(fn($p) => [
                'judul'    => $p->modul?->judul_modul ?? '-',
                'kategori' => $p->modul?->kategori ?? 'Umum',
                'skor'     => $p->skor,
            ])
            ->values();

        // ── Rekomendasi Modul Berikutnya ─────────────────────────
        $idModulSelesai   = $semuaProgress->where('status', 'selesai')->pluck('id_modul');
        $rekomendasiModul = Modul::whereNotIn('id', $idModulSelesai)->inRandomOrder()->first();

        // ── Rata-rata Skor ───────────────────────────────────────
        $rataRataSkor = $skorPerModul->isNotEmpty()
            ? (int) round($skorPerModul->avg('skor'))
            : 0;

        return view('pengguna.report.index', compact(
            'anak',
            'totalBelajar',
            'totalWaktu',
            'totalPoin',
            'modulSelesai',
            'totalModul',
            'skorPerModul',
            'modulSudahSelesai',
            'rekomendasiModul',
            'rataRataSkor'
        ));
    }
}