<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:8'
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'orang_tua'
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil');
    }
}