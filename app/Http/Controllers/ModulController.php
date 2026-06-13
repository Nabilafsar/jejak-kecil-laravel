<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\GayaBelajar;
use App\Models\IsiModul;
use App\Http\Controllers\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index()
    {
        $modul = Modul::with('gayaBelajar', 'isiModul')
                      ->orderBy('created_at', 'desc')
                      ->get();
        return view('admin.modules.index', compact('modul'));
    }

    public function create()
    {
        $gayaBelajar = GayaBelajar::all();
        return view('admin.modules.create', compact('gayaBelajar'));
    }
    
    public function edit(int $id)
    {
        $modul = Modul::with('isiModul')->findOrFail($id);
        $gayaBelajar = GayaBelajar::all();
        return view('admin.modules.edit', compact('modul', 'gayaBelajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_modul'      => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'tingkat_kesulitan'=> 'required|in:mudah,sedang,sulit',
            'id_gaya_belajar'  => 'nullable|exists:gaya_belajar,id',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tipe_konten'      => 'required|array',
            'tipe_konten.*'    => 'required|in:teks,gambar,video',
            'isi_konten'       => 'required|array',
        ]);

        // Upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Simpan modul
        $modul = Modul::create([
            'judul_modul'       => $request->judul_modul,
            'deskripsi'         => $request->deskripsi,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'id_gaya_belajar'   => $request->id_gaya_belajar,
            'thumbnail'         => $thumbnailPath,
        ]);

        // Simpan isi modul
        foreach ($request->tipe_konten as $index => $tipe) {
            $isiKonten = null;

            if ($tipe === 'teks') {
                $isiKonten = $request->isi_konten[$index] ?? null;
            } elseif ($tipe === 'gambar') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('images', 'public');
                }
            } elseif ($tipe === 'video') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('videos', 'public');
                }
            }

            if ($isiKonten) {
                IsiModul::create([
                    'id_modul'    => $modul->id,
                    'tipe_konten' => $tipe,
                    'isi_konten'  => $isiKonten,
                ]);
            }
        }

        LogHelper::catat('tambah', 'modul', $modul->id, 'Menambahkan modul: ' . $modul->judul_modul);

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'judul_modul'      => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'tingkat_kesulitan'=> 'required|in:mudah,sedang,sulit',
            'id_gaya_belajar'  => 'nullable|exists:gaya_belajar,id',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tipe_konten'      => 'required|array',
            'tipe_konten.*'    => 'required|in:teks,gambar,video',
        ]);

        // Update thumbnail jika ada file baru
        $thumbnailPath = $modul->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($modul->thumbnail) {
                Storage::disk('public')->delete($modul->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Update data modul
        $modul->update([
            'judul_modul'       => $request->judul_modul,
            'deskripsi'         => $request->deskripsi,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'id_gaya_belajar'   => $request->id_gaya_belajar,
            'thumbnail'         => $thumbnailPath,
        ]);

        // Ambil isi modul lama untuk dipertahankan jika tidak ada file baru
        $isiLama = $modul->isiModul; // collection IsiModul lama

        // Susun data isi konten baru
        $contentData = [];

        foreach ($request->tipe_konten as $index => $tipe) {
            $isiKonten = null;

            if ($tipe === 'teks') {
                $isiKonten = $request->isi_konten[$index] ?? null;

            } elseif ($tipe === 'gambar') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('images', 'public');
                } else {
                    // pertahankan path lama jika dikirim lewat isi_konten_lama[]
                    $isiKonten = $request->isi_konten_lama[$index] ?? null;
                }

            } elseif ($tipe === 'video') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('videos', 'public');
                } else {
                    $isiKonten = $request->isi_konten_lama[$index] ?? null;
                }
            }

            if ($isiKonten) {
                $contentData[] = [
                    'tipe_konten' => $tipe,
                    'isi_konten'  => $isiKonten,
                ];
            }
        }

        // Hapus file gambar/video lama yang TIDAK dipakai lagi di data baru
        $isiKontenBaru = array_column($contentData, 'isi_konten');

        foreach ($isiLama as $isi) {
            if (in_array($isi->tipe_konten, ['gambar', 'video']) && !in_array($isi->isi_konten, $isiKontenBaru)) {
                Storage::disk('public')->delete($isi->isi_konten);
            }
        }

        // Hapus semua isi modul lama dari database
        IsiModul::where('id_modul', $modul->id)->delete();

        // Simpan isi modul baru
        foreach ($contentData as $data) {
            IsiModul::create([
                'id_modul'    => $modul->id,
                'tipe_konten' => $data['tipe_konten'],
                'isi_konten'  => $data['isi_konten'],
            ]);
        }

        LogHelper::catat('update', 'modul', $modul->id, 'Mengupdate modul: ' . $modul->judul_modul);

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus thumbnail
        if ($modul->thumbnail) {
            Storage::disk('public')->delete($modul->thumbnail);
        }

        // Hapus isi modul beserta filenya
        foreach ($modul->isiModul as $isi) {
            if (in_array($isi->tipe_konten, ['gambar', 'video'])) {
                Storage::disk('public')->delete($isi->isi_konten);
            }
        }

        $modul->delete();

        LogHelper::catat('hapus', 'modul', $modul->id, 'Menghapus modul: ' . $modul->judul_modul);
        
        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil dihapus.');
    }
}