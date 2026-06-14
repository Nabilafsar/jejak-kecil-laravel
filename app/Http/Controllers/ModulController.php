<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\GayaBelajar;
use App\Models\IsiModul;
use App\Http\Controllers\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'judul_modul'       => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
            'id_gaya_belajar'   => 'nullable|exists:gaya_belajar,id',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori'          => 'nullable|string|max:255',
            'tipe_konten'       => 'required|array',
            'tipe_konten.*'     => 'required|in:teks,gambar,video',
            'isi_konten'        => 'required|array',
        ]);

        // Upload thumbnail SEBELUM transaction
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Siapkan isi konten SEBELUM transaction
        $isiKontenData = [];
        foreach ($request->tipe_konten as $index => $tipe) {
            $isiKonten = null;

            if ($tipe === 'teks') {
                $isiKonten = $request->isi_konten[$index] ?? null;

            } elseif ($tipe === 'gambar') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('images', 'public');
                }

            } elseif ($tipe === 'video') {
                // Cek apakah input berupa URL YouTube atau file upload
                $inputVideo = $request->isi_konten[$index] ?? null;
                if ($inputVideo && $this->isYoutubeUrl($inputVideo)) {
                    // Simpan langsung URL YouTube-nya
                    $isiKonten = $inputVideo;
                } elseif ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('videos', 'public');
                }
            }

            if ($isiKonten) {
                $isiKontenData[] = ['tipe_konten' => $tipe, 'isi_konten' => $isiKonten];
            }
        }

        DB::transaction(function () use ($request, $thumbnailPath, $isiKontenData) {
            $modul = Modul::create([
                'judul_modul'       => $request->judul_modul,
                'deskripsi'         => $request->deskripsi,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'id_gaya_belajar'   => $request->id_gaya_belajar,
                'thumbnail'         => $thumbnailPath,
            ]);

            foreach ($isiKontenData as $data) {
                IsiModul::create([
                    'id_modul'    => $modul->id,
                    'tipe_konten' => $data['tipe_konten'],
                    'isi_konten'  => $data['isi_konten'],
                ]);
            }

            LogHelper::catat('tambah', 'modul', $modul->id, 'Menambahkan modul: ' . $modul->judul_modul);
        });

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'judul_modul'       => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
            'id_gaya_belajar'   => 'nullable|exists:gaya_belajar,id',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori'          => 'nullable|string|max:255',
            'tipe_konten'       => 'required|array',
            'tipe_konten.*'     => 'required|in:teks,gambar,video',
        ]);

        // Upload thumbnail SEBELUM transaction
        $thumbnailPath = $modul->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($modul->thumbnail) {
                Storage::disk('public')->delete($modul->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $isiLama     = $modul->isiModul;
        $contentData = [];

        foreach ($request->tipe_konten as $index => $tipe) {
            $isiKonten = null;

            if ($tipe === 'teks') {
                $isiKonten = $request->isi_konten[$index] ?? null;

            } elseif ($tipe === 'gambar') {
                if ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('images', 'public');
                } else {
                    $isiKonten = $request->isi_konten_lama[$index] ?? null;
                }

            } elseif ($tipe === 'video') {
                $inputVideo = $request->isi_konten[$index] ?? null;
                if ($inputVideo && $this->isYoutubeUrl($inputVideo)) {
                    // Simpan URL YouTube langsung
                    $isiKonten = $inputVideo;
                } elseif ($request->hasFile("isi_konten.$index")) {
                    $isiKonten = $request->file("isi_konten.$index")->store('videos', 'public');
                } else {
                    // Pertahankan nilai lama (bisa URL YouTube atau path file)
                    $isiKonten = $request->isi_konten_lama[$index] ?? null;
                }
            }

            if ($isiKonten) {
                $contentData[] = ['tipe_konten' => $tipe, 'isi_konten' => $isiKonten];
            }
        }

        // Hapus file lokal lama yang tidak dipakai (skip jika URL YouTube)
        $isiKontenBaru = array_column($contentData, 'isi_konten');
        foreach ($isiLama as $isi) {
            if (
                in_array($isi->tipe_konten, ['gambar', 'video'])
                && !in_array($isi->isi_konten, $isiKontenBaru)
                && !$this->isYoutubeUrl($isi->isi_konten)
            ) {
                Storage::disk('public')->delete($isi->isi_konten);
            }
        }

        DB::transaction(function () use ($request, $modul, $thumbnailPath, $contentData) {
            $modul->update([
                'judul_modul'       => $request->judul_modul,
                'deskripsi'         => $request->deskripsi,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'id_gaya_belajar'   => $request->id_gaya_belajar,
                'kategori'          => $request->kategori,
                'thumbnail'         => $thumbnailPath,
            ]);

            IsiModul::where('id_modul', $modul->id)->delete();

            foreach ($contentData as $data) {
                IsiModul::create([
                    'id_modul'    => $modul->id,
                    'tipe_konten' => $data['tipe_konten'],
                    'isi_konten'  => $data['isi_konten'],
                ]);
            }

            LogHelper::catat('update', 'modul', $modul->id, 'Mengupdate modul: ' . $modul->judul_modul);
        });

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus file lokal SEBELUM transaction (skip jika URL YouTube)
        if ($modul->thumbnail) {
            Storage::disk('public')->delete($modul->thumbnail);
        }
        foreach ($modul->isiModul as $isi) {
            if (
                in_array($isi->tipe_konten, ['gambar', 'video'])
                && !$this->isYoutubeUrl($isi->isi_konten)
            ) {
                Storage::disk('public')->delete($isi->isi_konten);
            }
        }

        DB::transaction(function () use ($modul) {
            $modul->delete();
            LogHelper::catat('hapus', 'modul', $modul->id, 'Menghapus modul: ' . $modul->judul_modul);
        });

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Modul berhasil dihapus.');
    }

    /**
     * Cek apakah string adalah URL YouTube
     */
    private function isYoutubeUrl(?string $url): bool
    {
        if (!$url) return false;
        return str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be');
    }
}