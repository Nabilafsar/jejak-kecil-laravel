<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Modul;
use App\Http\Controllers\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with('modul')->orderBy('id', 'asc')->get();
        return view('admin.quizzes.index', compact('kuis'));
    }

    public function create()
    {
        $modul = Modul::orderBy('judul_modul', 'asc')->get();
        return view('admin.quizzes.create', compact('modul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_modul'      => 'required|exists:modul,id',
            'pertanyaan'    => 'required|string',
            'pilihan_a'     => 'required|string|max:255',
            'pilihan_b'     => 'required|string|max:255',
            'pilihan_c'     => 'required|string|max:255',
            'pilihan_d'     => 'required|string|max:255',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'poin'          => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $kuis = Kuis::create($request->all());
            LogHelper::catat('tambah', 'kuis', $kuis->id, 'Menambahkan kuis: ' . $kuis->modul->judul_modul);
        });

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $kuis  = Kuis::findOrFail($id);
        $modul = Modul::orderBy('judul_modul', 'asc')->get();
        return view('admin.quizzes.edit', compact('kuis', 'modul'));
    }

    public function update(Request $request, int $id)
    {
        $kuis = Kuis::findOrFail($id);

        $request->validate([
            'id_modul'      => 'required|exists:modul,id',
            'pertanyaan'    => 'required|string',
            'pilihan_a'     => 'required|string|max:255',
            'pilihan_b'     => 'required|string|max:255',
            'pilihan_c'     => 'required|string|max:255',
            'pilihan_d'     => 'required|string|max:255',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'poin'          => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $kuis) {
            $kuis->update($request->all());
            LogHelper::catat('update', 'kuis', $kuis->id, 'Mengupdate kuis id: ' . $kuis->id);
        });

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Kuis berhasil diupdate.');
    }

    public function destroy(int $id)
    {
        $kuis = Kuis::findOrFail($id);

        DB::transaction(function () use ($kuis, $id) {
            $kuis->delete();
            LogHelper::catat('hapus', 'kuis', $id, 'Menghapus kuis id: ' . $id);
        });

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Kuis berhasil dihapus.');
    }
}