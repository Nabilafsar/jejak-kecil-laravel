@extends('layouts.app')

@section('content')
    @include('layouts.headerPengguna')
    <div class="min-h-screen bg-gray-50 pb-10 ">

        <div class="w-70% h-full px-10 py-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 rounded-xl px-4 py-3 text-sm mb-6">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ── ROW 1: Profil Orang Tua + Data Anak ── --}}
            <div class="grid grid-cols-2 gap-6 mb-6 mt-5">

                {{-- Kartu Profil Orang Tua --}}
                <div class="bg-white rounded-2xl  shadow-sm p-6 ">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Profil Orang Tua</h2>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex-shrink-0">
                            @if($pengguna->foto)
                                <img src="{{ asset('storage/' . $pengguna->foto) }}" alt="Foto Profil"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-blue-200">
                            @else
                                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 text-2xl font-bold">
                                        {{ strtoupper(substr($pengguna->nama, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 truncate">{{ $pengguna->nama }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ $pengguna->email }}</p>
                            <span class="inline-block mt-1 text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full">
                                Orang Tua
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('pengguna.profil.edit_profil') }}"
                        class="flex items-center justify-center gap-2 w-full border border-blue-500 text-blue-600 rounded-xl py-2 text-sm font-medium hover:bg-blue-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.415.587H8v-2.414A2 2 0 018.586 12z"/>
                        </svg>
                        Edit Profil
                    </a>
                </div>

                {{-- Kartu Data Anak --}}
                @if($anak)
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Data Anak</h2>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex-shrink-0">
                                @if($anak->avatar)
                                    <img src="{{ asset('assets/img/avatars/' . $anak->avatar) }}" alt="Avatar Anak"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-purple-200">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-purple-600 text-2xl font-bold">
                                            {{ strtoupper(substr($anak->nama_panggilan, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800">{{ $anak->nama_panggilan }}</p>
                                <p class="text-sm text-gray-500">
                                    Gaya Belajar:
                                    <span class="text-purple-600 font-medium">
                                        {{ $anak->gayaBelajar->nama_gaya ?? '-' }}
                                    </span>
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">Level {{ $anak->level_anak }}</p>
                            </div>
                        </div>
                        <a href="{{ route('pengguna.profil.edit_anak') }}"
                            class="flex items-center justify-center gap-2 w-full border border-purple-500 text-purple-600 rounded-xl py-2 text-sm font-medium hover:bg-purple-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.415.587H8v-2.414A2 2 0 018.586 12z"/>
                            </svg>
                            Edit Data Anak
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col items-center justify-center">
                        <p class="text-sm text-gray-500 mb-3">Belum ada data anak.</p>
                        <a href="{{ route('pengguna.onboarding') }}"
                            class="inline-block bg-purple-600 text-white rounded-xl px-4 py-2 text-sm font-medium">
                            Tambah Data Anak
                        </a>
                    </div>
                @endif

            </div>

            {{-- ── ROW 2: Statistik + Poin + Pengaturan ── --}}
            <div class="grid grid-cols-3 gap-6">

                {{-- Statistik Belajar --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Statistik Belajar</h2>
                    <div class="space-y-4">

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                Modul Selesai
                            </div>
                            <span class="font-bold text-blue-600">{{ $modulSelesai }}</span>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                Kuis Selesai
                            </div>
                            <span class="font-bold text-orange-500">{{ $totalKuis }}</span>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                </div>
                                Rata-rata Nilai
                            </div>
                            <span class="font-bold text-green-600">{{ $rataRataNilai }}</span>
                        </div>

                    </div>
                </div>

                {{-- Poin & Reward --}}
                <div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl shadow-sm p-6 flex flex-col justify-between">
                    <h2 class="text-xs font-semibold text-white/80 uppercase tracking-wide mb-4">Poin & Reward</h2>
                    <div class="flex flex-col items-center justify-center flex-1 gap-3">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <p class="text-white text-4xl font-bold">{{ number_format($totalPoin) }}</p>
                        <p class="text-white/70 text-xs">Poin Saat Ini</p>
                    </div>
                    <a href="{{ route('pengguna.gamifikasi.riwayat') }}"
                        class="mt-4 block text-center bg-white/20 hover:bg-white/30 text-white text-sm font-medium px-4 py-2 rounded-xl transition">
                        Lihat Riwayat
                    </a>
                </div>

                {{-- Pengaturan --}}
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 pt-5 ">Pengaturan</h2>

                    <a href="{{ route('pengguna.profil.ubah_password') }}"
                        class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3 text-gray-700 text-sm">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            Ubah Password
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <div class="border-t border-gray-50 mx-6"></div>

                    <a href="#" class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3 text-gray-700 text-sm">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Bantuan
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <div class="border-t border-gray-50 mx-6"></div>

                    <a href="#" class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3 text-gray-700 text-sm">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Tentang Aplikasi
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <div class="border-t border-gray-50 mx-6"></div>

                    <form method="POST" action="{{ route('pengguna.profil.logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-3 w-full px-6 py-3 hover:bg-red-50 transition text-left">
                            <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                            <span class="text-red-500 text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection