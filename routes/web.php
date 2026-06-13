<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pengguna\OnboardingController;
use App\Http\Controllers\Pengguna\ModulController;
use App\Http\Controllers\Pengguna\KonsultasiController;
use App\Http\Controllers\Pengguna\ReportController;
use App\Http\Controllers\Pengguna\ProfilController;


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


