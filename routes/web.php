<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('about');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get(
    '/login',
    [LoginController::class, 'index']
)
    ->name('login');

Route::post(
    '/login',
    [LoginController::class, 'authenticate']
)
    ->name('login.authenticate');

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)
    ->name('logout');

Route::get(
    '/register',
    [RegisterController::class, 'index']
)
    ->name('register');

Route::post(
    '/register',
    [RegisterController::class, 'store']
)
    ->name('register.store');

Route::get('/dashboard', function () {
    return "Dashboard Jejak Kecil";
})->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/pengguna/dashboard', function () {
        return view('pengguna.DashboardPengguna');
    })->name('pengguna.DashboardPengguna');

    Route::get('/admin/dashboard', function () {
        return view('admin.DashboardAdmin');
    })->name('admin.DashboardAdmin');

});