<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// =============================================
// Landing Page
// =============================================
Route::get('/', function () {
    return view('about');
});

// =============================================
// Auth
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// =============================================
// Pengguna (Orang Tua)
// =============================================
Route::middleware('auth')->prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pengguna.DashboardPengguna');
    })->name('DashboardPengguna');
});

// =============================================
// Admin
// =============================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');

    // Modules
    Route::get('/modules', [ModulController::class, 'index'])->name('modules.index');
    Route::get('/modules/create', [ModulController::class, 'create'])->name('modules.create');
    Route::post('/modules', [ModulController::class, 'store'])->name('modules.store');
    Route::get('/modules/{id}/edit', [ModulController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{id}', [ModulController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{id}', [ModulController::class, 'destroy'])->name('modules.destroy');

    // Quizzes
    Route::get('/quizzes', [KuisController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [KuisController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [KuisController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{id}/edit', [KuisController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{id}', [KuisController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{id}', [KuisController::class, 'destroy'])->name('quizzes.destroy');

    // Reports
    Route::get('/reports', [LaporanController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [LaporanController::class, 'export'])->name('reports.export');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/profil', [SettingController::class, 'updateProfil'])->name('settings.profil');
    Route::post('/settings/password', [SettingController::class, 'updatePassword'])->name('settings.password');

});