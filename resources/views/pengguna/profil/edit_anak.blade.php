@extends('layouts.app')

@section('title', 'Edit Data Anak')

@section('content')
    @include('layouts.headerPengguna')
    <div class="min-h-screen bg-gray-50  pb-10">
        <div class="max-w-2xl mx-auto px-6 py-8">

            {{-- Breadcrumb / Back --}}
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('pengguna.profil.index') }}"
                    class="flex items-center gap-1 text-sm text-gray-500 hover:text-purple-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Profil
                </a>
                <span class="text-gray-300">/</span>
                <span class="text-sm text-gray-700 font-medium">Edit Data Anak</span>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h1 class="text-lg font-bold text-gray-800 mb-6">Edit Data Anak</h1>

                <form method="POST" action="{{ route('pengguna.profil.update_anak') }}" class="space-y-5">
                    @csrf

                    {{-- Nama Panggilan + Tanggal Lahir side by side --}}
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan Anak</label>
                            <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $anak->nama_panggilan) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('nama_panggilan') border-red-400 @enderror">
                            @error('nama_panggilan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                            @error('tanggal_lahir') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Gaya Belajar --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gaya Belajar</label>
                        <select name="id_gaya_belajar"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('id_gaya_belajar') border-red-400 @enderror">
                            <option value="">-- Pilih Gaya Belajar --</option>
                            @foreach($gayaBelajar as $gb)
                                <option value="{{ $gb->id }}"
                                    {{ old('id_gaya_belajar', $anak->id_gaya_belajar) == $gb->id ? 'selected' : '' }}>
                                    {{ $gb->nama_gaya }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_gaya_belajar') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('pengguna.profil.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl text-sm transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection