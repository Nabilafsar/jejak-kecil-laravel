@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
    @include('layouts.headerPengguna')
    <div class="min-h-screen bg-gray-50 mt-20 pb-10">
        <div class="max-w-2xl mx-auto px-6 py-8">

            {{-- Breadcrumb / Back --}}
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('pengguna.profil.index') }}"
                    class="flex items-center gap-1 text-sm text-gray-500 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Profil
                </a>
                <span class="text-gray-300">/</span>
                <span class="text-sm text-gray-700 font-medium">Ubah Password</span>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h1 class="text-lg font-bold text-gray-800 mb-6">Ubah Password</h1>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3 mb-5">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pengguna.profil.update_password') }}" class="space-y-5">
                    @csrf

                    {{-- Password Lama full width --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                        <input type="password" name="password_lama"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    {{-- Password Baru + Konfirmasi side by side --}}
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password_baru"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_baru_confirmation"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('pengguna.profil.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition">
                            Simpan Password
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection