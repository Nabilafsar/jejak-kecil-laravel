@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#033E8A]">Manajemen Modul</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola kurikulum, materi pembelajaran, dan konten modul.</p>
        </div>
        <a href="{{ route('admin.modules.create') }}"
           class="flex items-center gap-2 bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Modul
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
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tl-2xl">Thumbnail</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Judul Modul</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Gaya Belajar</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Tingkat</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Konten</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Dibuat</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tr-2xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($modul as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4">
                        @if($item->thumbnail)
                            <img src="{{ Storage::url($item->thumbnail) }}" class="w-16 h-12 object-cover rounded-lg" alt="">
                        @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <span class="text-xs text-gray-400">No img</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-[#033E8A]">{{ $item->judul_modul }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($item->deskripsi, 40) }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $item->gayaBelajar->nama_gaya ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full
                            {{ $item->tingkat_kesulitan === 'mudah' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $item->tingkat_kesulitan === 'sedang' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $item->tingkat_kesulitan === 'sulit' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($item->tingkat_kesulitan) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $item->isiModul->count() }} konten
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.modules.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.modules.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus modul ini?')">
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
                        Belum ada modul.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection