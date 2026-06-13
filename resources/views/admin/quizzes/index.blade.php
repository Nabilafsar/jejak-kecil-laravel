@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#033E8A]">Manajemen Quiz</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola soal kuis untuk setiap modul pembelajaran.</p>
        </div>
        <a href="{{ route('admin.quizzes.create') }}"
           class="flex items-center gap-2 bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Kuis
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-[#033E8A]">
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tl-2xl">No</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Modul</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Pertanyaan</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Jawaban Benar</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Poin</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Dibuat</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tr-2xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kuis as $index => $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-[#033E8A]">
                        {{ $item->modul->judul_modul ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ Str::limit($item->pertanyaan, 60) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-[#033E8A] text-white text-xs font-bold px-3 py-1 rounded-full">
                            {{ $item->jawaban_benar }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->poin }} poin</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.quizzes.edit', $item->id) }}"
                               class="text-blue-500 hover:text-blue-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.quizzes.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus kuis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6"/><path d="M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-400">
                        Belum ada kuis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection