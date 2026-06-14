<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\AvatarShop;
use App\Models\TransaksiPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GamifikasiController extends Controller
{
    /**
     * Tampilkan halaman gamifikasi utama
     */
    public function index()
    {
        $pengguna = Auth::user();
        $anak = $pengguna->anak;

        if (!$anak) {
            return redirect()->route('pengguna.onboarding');
        }

        // Avatar di shop
        $avatarShop = AvatarShop::where('is_active', true)->get();

        // ID avatar yang sudah dibeli anak ini
        $avatarDibeli = TransaksiPoin::where('id_anak', $anak->id)
            ->whereNotNull('id_avatar_shop')
            ->pluck('id_avatar_shop')
            ->unique()
            ->toArray();

        // Riwayat transaksi (10 terakhir)
        $riwayatTransaksi = TransaksiPoin::where('id_anak', $anak->id)
            ->with('avatarShop')
            ->latest()
            ->take(10)
            ->get();

        return view('pengguna.gamifikasi.index', compact(
            'anak',
            'avatarShop',
            'avatarDibeli',
            'riwayatTransaksi'
        ));
    }

    /**
     * Proses pembelian avatar
     */
    public function beliAvatar(Request $request)
    {
        $pengguna = Auth::user();
        $anak = $pengguna->anak;

        $request->validate([
            'id_avatar_shop' => 'required|exists:avatar_shop,id',
        ]);

        $avatar = AvatarShop::findOrFail($request->id_avatar_shop);

        // Cek apakah sudah dibeli
        $sudahDibeli = TransaksiPoin::where('id_anak', $anak->id)
            ->where('id_avatar_shop', $avatar->id)
            ->exists();

        if ($sudahDibeli) {
            return back()->with('error', 'Avatar ini sudah kamu miliki!');
        }

        // Cek poin cukup
        if ($anak->total_poin < $avatar->harga_poin) {
            return back()->with('error', 'Poin kamu tidak cukup untuk membeli avatar ini!');
        }

        // Proses pembelian dengan DB transaction
        DB::transaction(function () use ($anak, $avatar) {
            // Kurangi poin
            $anak->total_poin -= $avatar->harga_poin;
            $anak->save();

            // Catat transaksi
            TransaksiPoin::create([
                'id_anak'        => $anak->id,
                'id_avatar_shop' => $avatar->id,
                'tipe'           => 'debit',
                'jumlah_poin'    => $avatar->harga_poin,
                'keterangan'     => 'Beli Avatar ' . $avatar->nama_avatar,
                'saldo_setelah'  => $anak->total_poin,
            ]);
        });

        return back()->with('success', 'Avatar ' . $avatar->nama_avatar . ' berhasil dibeli! 🎉');
    }

    /**
     * Pasang avatar yang sudah dibeli
     */
    public function pakaiAvatar(Request $request)
    {
        $pengguna = Auth::user();
        $anak = $pengguna->anak;

        $request->validate([
            'id_avatar_shop' => 'required|exists:avatar_shop,id',
        ]);

        $avatar = AvatarShop::findOrFail($request->id_avatar_shop);

        // Pastikan sudah dibeli (atau gratis)
        $sudahDibeli = $avatar->harga_poin === 0 || TransaksiPoin::where('id_anak', $anak->id)
            ->where('id_avatar_shop', $avatar->id)
            ->exists();

        if (!$sudahDibeli) {
            return back()->with('error', 'Kamu belum memiliki avatar ini!');
        }

        $anak->avatar = $avatar->gambar;
        $anak->save();

        return back()->with('success', 'Avatar berhasil dipasang! ✨');
    }

    /**
     * Lihat semua riwayat transaksi
     */
    public function riwayat()
    {
        $anak = Auth::user()->anak;

        $riwayatTransaksi = TransaksiPoin::where('id_anak', $anak->id)
            ->with('avatarShop')
            ->latest()
            ->paginate(15);

        return view('pengguna.gamifikasi.riwayat', compact('anak', 'riwayatTransaksi'));
    }
}