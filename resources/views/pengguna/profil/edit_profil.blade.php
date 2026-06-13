@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    @include('layouts.headerPengguna')
    <div class="min-h-screen bg-gray-50 pb-10">
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
                <span class="text-sm text-gray-700 font-medium">Edit Profil</span>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">

                <h1 class="text-lg font-bold text-gray-800 mb-6">Edit Profil Orang Tua</h1>

                <form method="POST" action="{{ route('pengguna.profil.update_profil') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- Foto Profil --}}
                    <div class="flex items-center gap-6 pb-5 border-b border-gray-100">
                        @if($pengguna->foto)
                            <img src="{{ asset('storage/' . $pengguna->foto) }}"
                                 id="preview"
                                 class="w-20 h-20 rounded-full object-cover border-2 border-blue-200">
                        @else
                            <div id="preview-placeholder"
                                 class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-3xl font-bold flex-shrink-0">
                                {{ strtoupper(substr($pengguna->nama, 0, 1)) }}
                            </div>
                            <img id="preview" class="w-20 h-20 rounded-full object-cover border-2 border-blue-200 hidden flex-shrink-0">
                        @endif
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Foto Profil</p>
                            <label class="inline-block text-sm text-blue-600 font-medium cursor-pointer border border-blue-300 rounded-lg px-3 py-1.5 hover:bg-blue-50 transition">
                                Ganti Foto
                                <input type="file" name="foto" accept="image/*" class="hidden"
                                       onchange="previewImage(event)">
                            </label>
                            <p class="text-xs text-gray-400 mt-1">Maks. 2MB. Format: JPG, PNG</p>
                        </div>
                    </div>

                    {{-- Nama + Email side by side --}}
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $pengguna->nama) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('nama') border-red-400 @enderror">
                            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $pengguna->email) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('email') border-red-400 @enderror">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('pengguna.profil.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('preview-placeholder');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
    </script>
@endsection