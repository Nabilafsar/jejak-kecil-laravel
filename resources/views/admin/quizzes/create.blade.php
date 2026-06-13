@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#033E8A]">Tambah Kuis</h1>
        <p class="text-sm text-gray-500 mt-1">Tambahkan soal kuis baru untuk modul pembelajaran.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="{{ route('admin.quizzes.store') }}" method="POST">
            @csrf

            {{-- Modul --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Modul</label>
                <select name="id_modul"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                    <option value="">Pilih modul</option>
                    @foreach($modul as $m)
                        <option value="{{ $m->id }}" {{ old('id_modul') == $m->id ? 'selected' : '' }}>
                            {{ $m->judul_modul }}
                        </option>
                    @endforeach
                </select>
                @error('id_modul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pertanyaan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                <textarea name="pertanyaan" rows="3"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                    placeholder="Masukkan pertanyaan">{{ old('pertanyaan') }}</textarea>
                @error('pertanyaan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilihan Jawaban --}}
            @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilihan {{ $label }}</label>
                <input type="text" name="pilihan_{{ $key }}" value="{{ old('pilihan_' . $key) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                    placeholder="Masukkan pilihan {{ $label }}">
                @error('pilihan_' . $key)
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endforeach

            {{-- Jawaban Benar --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jawaban Benar</label>
                <select name="jawaban_benar"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                    <option value="">Pilih jawaban benar</option>
                    @foreach(['A', 'B', 'C', 'D'] as $jawaban)
                        <option value="{{ $jawaban }}" {{ old('jawaban_benar') === $jawaban ? 'selected' : '' }}>
                            {{ $jawaban }}
                        </option>
                    @endforeach
                </select>
                @error('jawaban_benar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Poin --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Poin</label>
                <input type="number" name="poin" value="{{ old('poin', 10) }}" min="1"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                @error('poin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                    Simpan
                </button>
                <a href="{{ route('admin.quizzes.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection