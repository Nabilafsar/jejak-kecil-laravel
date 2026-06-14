<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\GayaBelajar;
use App\Models\ProgressAnak;
use App\Models\TransaksiPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        $pengguna = Auth::user();
        $anak = Anak::where('id_pengguna', $pengguna->id)
            ->with('gayaBelajar')
            ->first();

        // Statistik belajar dari progress_anak
        $semuaProgress = $anak
            ? ProgressAnak::where('id_anak', $anak->id)->get()
            : collect();

        $modulSelesai = $semuaProgress->where('status', 'selesai')->count();
        $totalKuis = $semuaProgress->whereNotNull('skor')->count();
        $rataRataNilai = $totalKuis > 0
            ? (int) round($semuaProgress->whereNotNull('skor')->avg('skor'))
            : 0;

        // Poin anak
        $totalPoin = $anak ? $anak->total_poin : 0;

        return view('pengguna.profil.index', compact(
            'pengguna',
            'anak',
            'modulSelesai',
            'totalKuis',
            'rataRataNilai',
            'totalPoin'
        ));
    }

    /**
     * Tampilkan form edit profil orang tua
     */
    public function editProfil()
    {
        $pengguna = Auth::user();
        return view('pengguna.profil.edit_profil', compact('pengguna'));
    }

    /**
     * Simpan perubahan profil orang tua
     */
    public function updateProfil(Request $request)
    {
        /** @var \App\Models\Pengguna $pengguna */
        $pengguna = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pengguna,email,' . $pengguna->id,
            'foto' => 'nullable|image|max:2048',
        ]);

        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $pengguna->foto = $path;
        }

        $pengguna->save();

        return redirect()->route('pengguna.profil.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Tampilkan form edit data anak
     */
    public function editAnak()
    {
        $pengguna = Auth::user();
        $anak = Anak::where('id_pengguna', $pengguna->id)->firstOrFail();
        $gayaBelajar = GayaBelajar::all();

        return view('pengguna.profil.edit_anak', compact('anak', 'gayaBelajar'));
    }

    /**
     * Simpan perubahan data anak
     */
    public function updateAnak(Request $request)
    {
        $pengguna = Auth::user();
        $anak = Anak::where('id_pengguna', $pengguna->id)->firstOrFail();

        $request->validate([
            'nama_panggilan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'id_gaya_belajar' => 'required|exists:gaya_belajar,id',
        ]);

        $anak->update([
            'nama_panggilan' => $request->nama_panggilan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_gaya_belajar' => $request->id_gaya_belajar,
        ]);

        return redirect()->route('pengguna.profil.index')
            ->with('success', 'Data anak berhasil diperbarui!');
    }

    /**
     * Tampilkan form ubah password
     */
    public function ubahPassword()
    {
        return view('pengguna.profil.ubah_password');
    }

    /**
     * Proses ubah password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\Pengguna $pengguna */
        $pengguna = Auth::user();

        if (!Hash::check($request->password_lama, $pengguna->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $pengguna->password = Hash::make($request->password_baru);
        $pengguna->save();

        return redirect()->route('pengguna.profil.index')
            ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}