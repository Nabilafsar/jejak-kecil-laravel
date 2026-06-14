<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Spesialis;
use App\Models\JadwalKonsultasi;
use App\Models\PesanKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    /**
     * Halaman index: daftar spesialis + jadwal saya
     */
    public function index(Request $request)
    {
        $pengguna = Auth::user();

        // Query spesialis dengan keahlian
        $query = Spesialis::with('keahlian')->where('tersedia', true);

        // Pencarian
        if ($request->filled('search')) {
            $cari = $request->search;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%$cari%")
                    ->orWhere('spesialisasi', 'like', "%$cari%");
            });
        }

        $spesialisList = $query->orderBy('rating', 'desc')->get();

        // Jadwal milik pengguna ini
        $jadwalSaya = JadwalKonsultasi::with('spesialis')
            ->where('id_pengguna', $pengguna->id)
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        $jadwalAkanDatang = $jadwalSaya->where('status', 'akan_datang')->first();
        $jadwalSelesai = $jadwalSaya->where('status', 'selesai')->take(3);

        return view('pengguna.konsultasi.index', compact(
            'spesialisList',
            'jadwalAkanDatang',
            'jadwalSelesai',
            'jadwalSaya'
        ));
    }

    /**
     * Tampilkan form pemesanan jadwal
     */
    public function formJadwal($idSpesialis)
{
    $spesialis = Spesialis::with('keahlian')->findOrFail($idSpesialis);
    $pengguna  = Auth::user();

    // Ambil semua jam yang sudah terpesan oleh siapapun (status akan_datang)
    $jamTerpesan = JadwalKonsultasi::where('id_spesialis', $idSpesialis)
        ->where('status', 'akan_datang')
        ->where('waktu_mulai', '>=', now())
        ->pluck('waktu_mulai')
        ->map(fn($dt) => $dt->format('Y-m-d H:i'))
        ->toArray();

    return view('pengguna.konsultasi.form-jadwal', compact('spesialis', 'pengguna', 'jamTerpesan'));
}

    /**
     * Buat jadwal konsultasi baru dengan spesialis
     */
    public function buatJadwal(Request $request, $idSpesialis)
{
    $request->validate([
        'judul_sesi'  => 'required|string|max:255',
        'waktu_mulai' => 'required|date|after:now',
    ]);

    $spesialis = Spesialis::findOrFail($idSpesialis);
    $pengguna  = Auth::user();

    // Cek apakah jam sudah terpesan
    $sudahTerpesan = JadwalKonsultasi::where('id_spesialis', $idSpesialis)
        ->where('status', 'akan_datang')
        ->where('waktu_mulai', $request->waktu_mulai)
        ->exists();

    if ($sudahTerpesan) {
        return back()->withErrors(['waktu_mulai' => 'Jadwal jam ini sudah dipesan oleh orang lain. Silakan pilih jam lain.'])->withInput();
    }

    $jadwal = JadwalKonsultasi::create([
        'id_pengguna'  => $pengguna->id,
        'id_spesialis' => $spesialis->id,
        'judul_sesi'   => $request->judul_sesi,
        'waktu_mulai'  => $request->waktu_mulai,
        'status'       => 'akan_datang',
    ]);

    return redirect()->route('pengguna.konsultasi.chat', $jadwal->id)
        ->with('success', 'Jadwal konsultasi berhasil dibuat!');
}

    /**
     * Halaman chat konsultasi
     */
    public function chat($idJadwal)
    {
        $pengguna = Auth::user();

        $jadwal = JadwalKonsultasi::with(['spesialis', 'pesan'])
            ->where('id_pengguna', $pengguna->id)
            ->findOrFail($idJadwal);

        // Tandai pesan spesialis sebagai sudah dibaca
        $jadwal->pesan()
            ->where('pengirim', 'spesialis')
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return view('pengguna.konsultasi.chat', compact('jadwal'));
    }

    /**
     * Kirim pesan baru
     */
    public function kirimPesan(Request $request, $idJadwal)
    {
        $request->validate([
            'isi_pesan' => 'required|string|max:2000',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $pengguna = Auth::user();

        $jadwal = JadwalKonsultasi::where('id_pengguna', $pengguna->id)
            ->findOrFail($idJadwal);

        $lampiranPath = null;
        $namaLampiran = null;

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $namaLampiran = $file->getClientOriginalName();
            $lampiranPath = $file->store('lampiran-konsultasi', 'public');
        }

        PesanKonsultasi::create([
            'id_jadwal' => $jadwal->id,
            'pengirim' => 'pengguna',
            'isi_pesan' => $request->isi_pesan,
            'lampiran' => $lampiranPath,
            'nama_lampiran' => $namaLampiran,
            'sudah_dibaca' => false,
        ]);

        return redirect()->route('pengguna.konsultasi.chat', $idJadwal);
    }

    /**
     * Lihat semua jadwal
     */
    public function semuaJadwal()
    {
        $pengguna = Auth::user();

        $jadwalSaya = JadwalKonsultasi::with('spesialis')
            ->where('id_pengguna', $pengguna->id)
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        return view('pengguna.konsultasi.jadwal', compact('jadwalSaya'));
    }

    /**
 * API: return jam terpesan untuk tanggal tertentu (JSON)
 */
public function getJamTerpesan(Request $request, $idSpesialis)
{
    $tanggal = $request->query('tanggal'); // format: Y-m-d

    $jamTerpesan = JadwalKonsultasi::where('id_spesialis', $idSpesialis)
        ->where('status', 'akan_datang')
        ->whereDate('waktu_mulai', $tanggal)
        ->pluck('waktu_mulai')
        ->map(fn($dt) => $dt->format('H:i'))
        ->toArray();

    return response()->json($jamTerpesan);
}
}
