<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\LogHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            LogHelper::catat('login', 'pengguna', Auth::user()->id, 'Login ke sistem');

            // Redirect berdasarkan role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role == 'orang_tua') {
                return redirect()->route('pengguna.DashboardPengguna');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        LogHelper::catat('logout', 'pengguna', Auth::user()->id, 'Logout dari sistem');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}