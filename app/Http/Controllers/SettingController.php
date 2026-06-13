<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogHelper;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    // Update Profil
    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . Auth::user()->id,
        ]);

        $pengguna = Pengguna::findOrFail(Auth::user()->id);
        $pengguna->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        LogHelper::catat('update', 'pengguna', $pengguna->id, 'Update profil admin');

        return redirect()->route('admin.settings')
                         ->with('success_profil', 'Profil berhasil diupdate.');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_baru'    => 'required|string|min:6',
            'konfirmasi_password' => 'required|same:password_baru',
        ]);

        $pengguna = Pengguna::findOrFail(Auth::user()->id);
        $pengguna->update([
            'password' => Hash::make($request->password_baru),
        ]);

        LogHelper::catat('update', 'pengguna', $pengguna->id, 'Update password admin');

        return redirect()->route('admin.settings')
                         ->with('success_password', 'Password berhasil diupdate.');
    }

    // Update Informasi Aplikasi
    public function updateAplikasi(Request $request)
    {
        $request->validate([
            'nama_aplikasi'  => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $settings = [
            'nama_aplikasi' => $request->nama_aplikasi,
            'deskripsi'     => $request->deskripsi,
        ];

        if ($request->hasFile('logo')) {
            // Hapus logo lama
            $logoLama = config('app_settings.logo');
            if ($logoLama) {
                Storage::disk('public')->delete($logoLama);
            }
            $settings['logo'] = $request->file('logo')->store('logo', 'public');
        }

        // Simpan ke file config
        $settingsPath = storage_path('app/settings.json');
        file_put_contents($settingsPath, json_encode($settings));

        LogHelper::catat('update', 'settings', null, 'Update informasi aplikasi');

        return redirect()->route('admin.settings')
                         ->with('success_aplikasi', 'Informasi aplikasi berhasil diupdate.');
    }
}