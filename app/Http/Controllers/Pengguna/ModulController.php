<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Kuis;
use App\Models\ProgressAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiPoin;

class ModulController extends Controller
{
    /**
     * Halaman daftar modul (Modules Index)
     */
    public function index(Request $request)
    {
        $anak = Auth::user()->anak;

        $query = Modul::with(['progressAnak' => function ($q) use ($anak) {
            if ($anak) {
                $q->where('id_anak', $anak->id);
            }
        }]);

        // Filter berdasarkan kategori
        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where('judul_modul', 'like', '%' . $request->search . '%');
        }

        $moduls   = $query->get();
        $kategori = Modul::select('kategori')->distinct()->pluck('kategori');

        return view('pengguna.modul.index', compact('moduls', 'kategori', 'anak'));
    }

    /**
     * Halaman detail / belajar modul (Modules Show)
     */
    public function show($id)
    {
        $modul = Modul::with(['isiModul', 'kuis'])->findOrFail($id);
        $anak  = Auth::user()->anak;

        // Ambil atau buat progress untuk anak ini
        $progress = null;
        if ($anak) {
            $progress = ProgressAnak::firstOrCreate(
                ['id_anak' => $anak->id, 'id_modul' => $modul->id],
                ['status' => 'sedang_dipelajari', 'persentase_progress' => 0]
            );

            // Update status jadi sedang dipelajari jika sebelumnya belum dimulai
            if ($progress->status === 'belum_dimulai') {
                $progress->update(['status' => 'sedang_dipelajari']);
            }
        }

        $totalPelajaran = $modul->isiModul->count() + ($modul->kuis->count() > 0 ? 1 : 0);
        $pelajaranSelesai = $progress
            ? (int) round($progress->persentase_progress / 100 * $totalPelajaran)
            : 0;

        return view('pengguna.modul.show', compact('modul', 'progress', 'totalPelajaran', 'pelajaranSelesai'));
    }

    /**
     * Halaman kuis modul
     */
    public function quiz($id)
    {
        $modul = Modul::with('kuis')->findOrFail($id);

        // Pastikan ada kuis
        if ($modul->kuis->isEmpty()) {
            return redirect()->route('pengguna.modul.show', $id)
                ->with('info', 'Modul ini belum memiliki kuis.');
        }

        $soalList = $modul->kuis;
        $total    = $soalList->count();

        return view('pengguna.modul.quiz', compact('modul', 'soalList', 'total'));
    }

    /**
     * Submit jawaban kuis & redirect ke halaman result
     */
    public function submitQuiz(Request $request, $id)
{
    $modul    = Modul::with('kuis')->findOrFail($id);
    $soalList = $modul->kuis;
    $anak     = Auth::user()->anak;

    $benar     = 0;
    $totalPoin = 0;

    foreach ($soalList as $soal) {
        $jawaban = $request->input('jawaban_' . $soal->id);
        if ($jawaban === $soal->jawaban_benar) {
            $benar++;
            $totalPoin += $soal->poin;
        }
    }

    $total   = $soalList->count();
    $akurasi = $total > 0 ? round(($benar / $total) * 100) : 0;

    if ($anak) {
        $progress = ProgressAnak::where('id_anak', $anak->id)
            ->where('id_modul', $modul->id)
            ->first();

        if ($progress) {
            $progress->update([
                'skor'                => $akurasi,
                'status'              => 'selesai',
                'persentase_progress' => 100,
                'tanggal_selesai'     => now(),
            ]);
        }

        // Tambah poin + catat transaksi
        $anak->total_poin += $totalPoin;
        $anak->save();

        TransaksiPoin::create([
            'id_anak'        => $anak->id,
            'id_avatar_shop' => null,
            'tipe'           => 'kredit',
            'jumlah_poin'    => $totalPoin,
            'keterangan'     => 'Selesai Kuis: ' . $modul->judul_modul,
            'saldo_setelah'  => $anak->total_poin,
        ]);
    }

    session([
        'hasil_kuis' => [
            'modul_id'   => $modul->id,
            'judul'      => $modul->judul_modul,
            'benar'      => $benar,
            'total'      => $total,
            'akurasi'    => $akurasi,
            'total_poin' => $totalPoin,
        ]
    ]);

    return redirect()->route('pengguna.modul.result', $id);
}

    /**
     * Halaman hasil kuis
     */
    public function result($id)
    {
        $modul      = Modul::findOrFail($id);
        $hasilKuis  = session('hasil_kuis');

        // Jika tidak ada hasil kuis di session, redirect ke kuis
        if (!$hasilKuis || $hasilKuis['modul_id'] != $id) {
            return redirect()->route('pengguna.modul.quiz', $id);
        }

        return view('pengguna.modul.result', compact('modul', 'hasilKuis'));
    }
    
}