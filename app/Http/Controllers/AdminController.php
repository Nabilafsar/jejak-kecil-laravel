<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LogHelper;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::orderBy('created_at', 'asc')->get();
        return view('admin.users.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:pengguna,email',
            'password' => 'required|string|min:6',
        ]);

        $pengguna = Pengguna::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        LogHelper::catat('tambah', 'pengguna', $pengguna->id, 'Menambahkan pengguna baru: ' . $pengguna->nama);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna berhasil ditambahkan.');
    }
}