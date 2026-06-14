@extends('layouts.app')

@section('title', 'Modules - Jejak Kecil')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    {{-- Navbar --}}
    @include('layouts.headerPengguna')

    {{-- Konten Utama --}}
    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-montserrat font-bold text-[#033E8A] text-3xl">
                Ayo Mulai Belajar!
            </h1>
            <p class="font-montserrat text-gray-500 text-[15px] mt-2 max-w-md">
                Halo, mari jelajahi dunia baru hari ini dengan cara yang menyenangkan dan tenang.
                Pilih modul yang kamu sukai.
            </p>
        </div>

        {{-- Search + Filter Kategori --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-8">

            {{-- Search Box --}}
            <form method="GET" action="{{ route('pengguna.modul.index') }}" class="flex-1 max-w-sm">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari modul belajar..."
                        class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200 font-montserrat text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#0AADA8] focus:border-transparent
                               bg-gray-50 text-gray-700"
                    >
                </div>
            </form>

            {{-- Filter Kategori --}}
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('pengguna.modul.index') }}"
                   class="font-montserrat text-sm font-medium px-5 py-2.5 rounded-full transition-all
                          {{ !request('kategori') || request('kategori') === 'Semua'
                             ? 'bg-[#033E8A] text-white shadow-md'
                             : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($kategori as $kat)
                <a href="{{ route('pengguna.modul.index', ['kategori' => $kat]) }}"
                   class="font-montserrat text-sm font-medium px-5 py-2.5 rounded-full transition-all
                          {{ request('kategori') === $kat
                             ? 'bg-[#033E8A] text-white shadow-md'
                             : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $kat }}
                </a>
                @endforeach
            </div>

        </div>

        {{-- Grid Modul --}}
        @if($moduls->isEmpty())
            <div class="text-center py-20">
                <div class="text-5xl mb-4">📚</div>
                <h3 class="font-montserrat font-bold text-gray-400 text-xl">
                    Belum ada modul tersedia
                </h3>
                <p class="font-montserrat text-gray-400 text-sm mt-2">
                    Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.
                </p>
            </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($moduls as $modul)
            @php
                // Ambil progress anak untuk modul ini
                $progress = $anak
                    ? $modul->progressAnak->firstWhere('id_anak', $anak->id)
                    : null;
                $persen   = $progress?->persentase_progress ?? 0;
                $status   = $progress?->status ?? 'belum_dimulai';
            @endphp

            <a href="{{ route('pengguna.modul.show', $modul->id) }}"
               class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100
                      transition-all duration-300 hover:-translate-y-1 flex flex-col">

                {{-- Thumbnail --}}
                <div class="relative h-44 bg-gradient-to-br from-teal-100 to-cyan-200 overflow-hidden">
                    @if($modul->thumbnail)
                        <img src="{{ asset('storage/' . $modul->thumbnail) }}"
                             alt="{{ $modul->judul_modul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        {{-- Placeholder gradient berdasarkan kategori --}}
                        @php
                            $gradients = [
                                'Sains'      => 'from-cyan-100 to-teal-200',
                                'Matematika' => 'from-amber-100 to-yellow-200',
                                'Bahasa'     => 'from-green-100 to-emerald-200',
                                'Seni'       => 'from-pink-100 to-rose-200',
                                'Sosial'     => 'from-purple-100 to-violet-200',
                            ];
                            $icons = [
                                'Sains'      => '🔭',
                                'Matematika' => '🔢',
                                'Bahasa'     => '💬',
                                'Seni'       => '🎨',
                                'Sosial'     => '🤝',
                            ];
                            $gradient = $gradients[$modul->kategori] ?? 'from-blue-100 to-indigo-200';
                            $icon     = $icons[$modul->kategori] ?? '📖';
                        @endphp
                        <div class="w-full h-full bg-gradient-to-br {{ $gradient }} flex items-center justify-center">
                            <span class="text-6xl opacity-60">{{ $icon }}</span>
                        </div>
                    @endif

                    {{-- Badge Kategori --}}
                    <span class="absolute top-3 right-3 font-montserrat text-xs font-semibold px-3 py-1 rounded-full
                                 bg-white/90 backdrop-blur-sm text-[#033E8A] shadow-sm">
                        {{ $modul->kategori }}
                    </span>
                </div>

                {{-- Konten Card --}}
                <div class="p-5 flex flex-col flex-1">

                    {{-- Ikon + Judul --}}
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-[#EEF4FF] flex items-center justify-center text-lg flex-shrink-0">
                            {{ $icons[$modul->kategori] ?? '📖' }}
                        </div>
                        <h3 class="font-montserrat font-bold text-[#033E8A] text-base leading-tight">
                            {{ $modul->judul_modul }}
                        </h3>
                    </div>

                    {{-- Deskripsi --}}
                    <p class="font-montserrat text-gray-500 text-sm leading-relaxed mb-4 flex-1 line-clamp-3">
                        {{ $modul->deskripsi ?? 'Pelajari materi ini dengan cara yang menyenangkan.' }}
                    </p>

                    {{-- Progress Bar --}}
                    <div class="mt-auto">
                        @if($status === 'belum_dimulai')
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-montserrat text-gray-400 text-xs">Belum Dimulai</span>
                                <span class="font-montserrat text-gray-400 text-xs">0%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gray-200 rounded-full" style="width: 0%"></div>
                            </div>
                            <button class="mt-4 w-full bg-[#033E8A] hover:bg-[#022F67] text-white font-montserrat
                                          font-semibold text-sm py-2.5 rounded-xl transition-all duration-300">
                                Mulai Belajar
                            </button>
                        @elseif($status === 'selesai')
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-montserrat text-[#0AADA8] text-xs font-semibold">Hampir Selesai</span>
                                <span class="font-montserrat text-[#033E8A] text-xs font-bold">{{ $persen }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#0AADA8] rounded-full transition-all" style="width: {{ $persen }}%"></div>
                            </div>
                        @else
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-montserrat text-[#033E8A] text-xs font-semibold">Sedang Dipelajari</span>
                                <span class="font-montserrat text-[#033E8A] text-xs font-bold">{{ $persen }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#033E8A] rounded-full transition-all" style="width: {{ $persen }}%"></div>
                            </div>
                        @endif
                    </div>

                </div>
            </a>
            @endforeach

            {{-- Card: Butuh Fokus Lebih? (Mode Sederhana) --}}
            <div class="bg-[#033E8A] rounded-3xl p-6 flex flex-col justify-between shadow-sm">
                <div>
                    <h3 class="font-montserrat font-bold text-white text-xl mb-3">
                        Butuh Fokus Lebih?
                    </h3>
                    <p class="font-montserrat text-blue-200 text-sm leading-relaxed">
                        Nyalakan 'Mode Sederhana' untuk mengurangi distraksi visual saat belajar.
                    </p>
                </div>
                <div class="mt-8">
                    <div class="flex items-center justify-between bg-white/10 backdrop-blur rounded-2xl px-4 py-3">
                        <span class="font-montserrat text-white text-sm font-medium">Mode Sederhana</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="modeSederhana" class="sr-only peer">
                            <div class="w-11 h-6 bg-white/30 rounded-full peer
                                        peer-checked:bg-[#0AADA8]
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all
                                        peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

        </div>
        @endif

    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</div>

@push('scripts')
<script>
    // Mode Sederhana: sembunyikan elemen dekoratif
    const toggle = document.getElementById('modeSederhana');
    if (toggle) {
        // Restore dari localStorage
        const saved = localStorage.getItem('modeSederhana');
        if (saved === '1') {
            toggle.checked = true;
            document.body.classList.add('mode-sederhana');
        }

        toggle.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('mode-sederhana');
                localStorage.setItem('modeSederhana', '1');
            } else {
                document.body.classList.remove('mode-sederhana');
                localStorage.setItem('modeSederhana', '0');
            }
        });
    }
</script>
@endpush

@endsection