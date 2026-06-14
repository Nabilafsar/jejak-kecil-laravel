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
use App\Http\Controllers\Pengguna\OnboardingController;
use App\Http\Controllers\Pengguna\ModulController;
use App\Http\Controllers\Pengguna\KonsultasiController;
use App\Http\Controllers\Pengguna\ReportController;
use App\Http\Controllers\Pengguna\ProfilController;

// =============================================
// Landing Page
// =============================================
Route::get('/', function () {
    return view('about');
})->name('about');

Route::get('/service', function () {
    return view('service');
})->name('service');
 
Route::get('/mentor', function () {
    return view('mentor');
})->name('mentor');
 
// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');

// =============================================
// Auth
// =============================================

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


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

Route::middleware('auth')->group(function () {

    // Halaman onboarding
    Route::get('/onboarding', [OnboardingController::class, 'index'])
        ->name('onboarding');

    // Simpan data onboarding
    Route::post('/onboarding', [OnboardingController::class, 'store'])
        ->name('onboarding.store');

    // Halaman modul
    Route::get('/pengguna/modul', [ModulController::class, 'index'])
        ->name('pengguna.modul.index');
 
    Route::get('/pengguna/modul/{id}', [ModulController::class, 'show'])
        ->name('pengguna.modul.show');
 
    Route::get('/pengguna/modul/{id}/quiz', [ModulController::class, 'quiz'])
        ->name('pengguna.modul.quiz');
 
    Route::post('/pengguna/modul/{id}/quiz/submit', [ModulController::class, 'submitQuiz'])
        ->name('pengguna.modul.quiz.submit');
 
    Route::get('/pengguna/modul/{id}/result', [ModulController::class, 'result'])
        ->name('pengguna.modul.result');

    // ── Konsultasi ────────────────────────────────────────────────
    Route::get('/pengguna/konsultasi', [KonsultasiController::class, 'index'])
        ->name('pengguna.konsultasi.index');
 
    Route::post('/pengguna/konsultasi/{id}/jadwal', [KonsultasiController::class, 'buatJadwal'])
        ->name('pengguna.konsultasi.buatJadwal');
 
    Route::get('/pengguna/konsultasi/jadwal', [KonsultasiController::class, 'semuaJadwal'])
        ->name('pengguna.konsultasi.jadwal');
 
    Route::get('/pengguna/konsultasi/{idJadwal}/chat', [KonsultasiController::class, 'chat'])
        ->name('pengguna.konsultasi.chat');
 
    Route::post('/pengguna/konsultasi/{idJadwal}/pesan', [KonsultasiController::class, 'kirimPesan'])
        ->name('pengguna.konsultasi.kirimPesan');
    
    Route::get('/pengguna/report', [ReportController::class, 'index'])
        ->name('pengguna.report.index');

        // gamifikasi

        Route::get('/gamifikasi', [App\Http\Controllers\Pengguna\GamifikasiController::class, 'index'])
            ->name('pengguna.gamifikasi.index');
        
        Route::post('/gamifikasi/beli-avatar', [App\Http\Controllers\Pengguna\GamifikasiController::class, 'beliAvatar'])
            ->name('pengguna.gamifikasi.beli');
        
        Route::post('/gamifikasi/pakai-avatar', [App\Http\Controllers\Pengguna\GamifikasiController::class, 'pakaiAvatar'])
            ->name('pengguna.gamifikasi.pakai');
        
        Route::get('/gamifikasi/riwayat', [App\Http\Controllers\Pengguna\GamifikasiController::class, 'riwayat'])
            ->name('pengguna.gamifikasi.riwayat');
});

// ── Profil ──────────────────────────────────────────────
Route::prefix('pengguna/profil')->name('pengguna.profil.')->group(function () {
    Route::get('/',                    [ProfilController::class, 'index'])         ->name('index');
    Route::get('/edit-profil',         [ProfilController::class, 'editProfil'])    ->name('edit_profil');
    Route::post('/update-profil',      [ProfilController::class, 'updateProfil'])  ->name('update_profil');
    Route::get('/edit-anak',           [ProfilController::class, 'editAnak'])      ->name('edit_anak');
    Route::post('/update-anak',        [ProfilController::class, 'updateAnak'])    ->name('update_anak');
    Route::get('/ubah-password',       [ProfilController::class, 'ubahPassword'])  ->name('ubah_password');
    Route::post('/update-password',    [ProfilController::class, 'updatePassword'])->name('update_password');
    Route::post('/logout',             [ProfilController::class, 'logout'])        ->name('logout');
});


Route::get('/konsultasi/{idSpesialis}/form', [KonsultasiController::class, 'formJadwal'])->name('pengguna.konsultasi.formJadwal');
Route::get('/konsultasi/{idSpesialis}/jam-terpesan', [KonsultasiController::class, 'getJamTerpesan'])->name('pengguna.konsultasi.jamTerpesan');