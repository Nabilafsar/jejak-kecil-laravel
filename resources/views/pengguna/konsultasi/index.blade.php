@extends('layouts.app')

@section('title', 'Konsultasi Ahli - Jejak Kecil')

@section('content')
    @include('layouts.headerPengguna')

    <div class="min-h-screen bg-white">
        <div class="max-w-6xl mx-auto px-6 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="font-montserrat font-bold text-[#033E8A] text-3xl">
                    Konsultasi Ahli
                </h1>
                <p class="font-montserrat text-gray-500 text-[15px] mt-2">
                    Temukan spesialis yang tepat untuk mendukung perkembangan anak Anda.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- ── Kolom Kiri: Daftar Spesialis ── --}}
                <div class="lg:col-span-2">

                    {{-- Search + Filter --}}
                    <form method="GET" action="{{ route('pengguna.konsultasi.index') }}"
                        class="flex items-center gap-3 mb-6">
                        <div class="relative flex-1">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari spesialis atau bidang keahlian..." class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200
                                          font-montserrat text-sm bg-gray-50 focus:outline-none
                                          focus:ring-2 focus:ring-[#0AADA8] focus:border-transparent">
                        </div>
                        <button type="submit" class="flex items-center gap-2 px-5 py-3 rounded-full border border-gray-200
                                       font-montserrat text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                            </svg>
                            Filter
                        </button>
                    </form>

                    {{-- Daftar Spesialis --}}
                    @if($spesialisList->isEmpty())
                        <div class="text-center py-16">
                            <div class="text-5xl mb-4">🔍</div>
                            <p class="font-montserrat text-gray-400">Spesialis tidak ditemukan.</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-4">
                            @foreach($spesialisList as $sp)
                                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5
                                                        hover:shadow-md transition-all duration-200">
                                                <div class="flex items-start gap-4">

                                                    {{-- Foto --}}
                                                    <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0 bg-gray-100">
                                                        @if($sp->foto)
                                                            <img src="{{ asset('assets/img/' . $sp->foto) }}" alt="{{ $sp->nama }}"
                                                                class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full bg-gradient-to-br from-[#033E8A] to-[#0AADA8]
                                                                            flex items-center justify-center text-white font-bold text-xl">
                                                                {{ strtoupper(substr($sp->nama, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    {{-- Info --}}
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-start justify-between gap-2">
                                                            <div>
                                                                <h3 class="font-montserrat font-bold text-[#033E8A] text-base">
                                                                    {{ $sp->nama }}{{ $sp->gelar ? ', ' . $sp->gelar : '' }}
                                                                </h3>
                                                                <p class="font-montserrat text-gray-500 text-sm">
                                                                    {{ $sp->spesialisasi }}
                                                                </p>
                                                                {{-- Rating --}}
                                                                <div class="flex items-center gap-1 mt-1">
                                                                    <span class="text-yellow-400 text-sm">★</span>
                                                                    <span class="font-montserrat text-sm font-semibold text-gray-700">
                                                                        {{ number_format($sp->rating, 1) }}
                                                                    </span>
                                                                    <span class="font-montserrat text-gray-400 text-xs">
                                                                        ({{ $sp->jumlah_ulasan }} Ulasan)
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Badge Keahlian --}}
                                                        @if($sp->keahlian->isNotEmpty())
                                                            <div class="flex flex-wrap gap-2 mt-3">
                                                                @foreach($sp->keahlian as $k)
                                                                    <span class="font-montserrat text-xs font-medium px-3 py-1 rounded-full
                                                                                 bg-[#E6FBF9] text-[#0AADA8]">
                                                                        {{ $k->keahlian }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        {{-- Biaya + Tombol --}}
                                                        <div class="flex items-center justify-between mt-4">
                                                            <div>
                                                                <p class="font-montserrat text-gray-400 text-xs">Biaya Sesi</p>
                                                                <p class="font-montserrat font-bold text-[#033E8A] text-base">
                                                                    {{ $sp->biaya_format }}
                                                                </p>
                                                            </div>
                                                            <a href="{{ route('pengguna.konsultasi.formJadwal', $sp->id) }}" class="bg-[#033E8A] hover:bg-[#022F67] text-white
                                  font-montserrat font-semibold text-sm
                                  px-5 py-2.5 rounded-xl transition-all duration-300 inline-block">
                                                                Buat Jadwal
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                            @endforeach
                        </div>

                        {{-- Muat Lebih Banyak (placeholder) --}}
                        @if($spesialisList->count() >= 5)
                            <div class="text-center mt-6">
                                <button class="font-montserrat text-sm font-medium px-6 py-3 rounded-full
                                               border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                    Muat Lebih Banyak
                                </button>
                            </div>
                        @endif
                    @endif

                </div>

                {{-- ── Kolom Kanan: Sidebar ── --}}
                <div class="flex flex-col gap-5">

                    {{-- Jadwal Saya --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="font-montserrat font-bold text-[#033E8A] text-base">Jadwal Saya</h3>
                        </div>

                        {{-- Jadwal Akan Datang --}}
                        @if($jadwalAkanDatang)
                            <div class="bg-[#EEF4FF] rounded-xl p-4 mb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-montserrat text-[#033E8A] text-[10px] font-bold uppercase tracking-wide">
                                        Akan Datang
                                    </span>
                                    <svg class="w-4 h-4 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="font-montserrat font-bold text-[#033E8A] text-sm">
                                    {{ $jadwalAkanDatang->judul_sesi }}
                                </p>
                                <p class="font-montserrat text-gray-500 text-xs mt-0.5">
                                    Bersama {{ $jadwalAkanDatang->spesialis->nama }}
                                </p>
                                <div class="flex items-center gap-3 mt-2 text-xs font-montserrat text-gray-500">
                                    <span>📅 {{ $jadwalAkanDatang->waktu_mulai->format('d M') }}</span>
                                    <span>🕐 {{ $jadwalAkanDatang->waktu_mulai->format('H:i') }} WIB</span>
                                </div>
                                <a href="{{ route('pengguna.konsultasi.chat', $jadwalAkanDatang->id) }}" class="mt-3 block text-center bg-[#033E8A] hover:bg-[#022F67] text-white
                                          font-montserrat font-semibold text-xs py-2 rounded-lg transition-colors">
                                    Buka Chat
                                </a>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-4 mb-3 text-center">
                                <p class="font-montserrat text-gray-400 text-sm">
                                    Belum ada jadwal mendatang
                                </p>
                            </div>
                        @endif

                        {{-- Jadwal Selesai --}}
                        @foreach($jadwalSelesai as $jd)
                            <div class="flex items-center justify-between py-2.5 border-t border-gray-50">
                                <div>
                                    <p class="font-montserrat text-gray-700 text-sm font-medium">
                                        {{ $jd->judul_sesi }}
                                    </p>
                                    <p class="font-montserrat text-gray-400 text-xs">
                                        {{ $jd->spesialis->nama }} • {{ $jd->waktu_mulai->format('d M') }}
                                    </p>
                                </div>
                                <span class="font-montserrat text-[10px] text-gray-400 font-medium">Selesai</span>
                            </div>
                        @endforeach

                        {{-- Lihat Semua --}}
                        <a href="{{ route('pengguna.konsultasi.jadwal') }}" class="block text-center font-montserrat text-[#033E8A] text-sm font-semibold
                                  mt-3 pt-3 border-t border-gray-100 hover:underline">
                            Lihat Semua Jadwal
                        </a>
                    </div>

                    {{-- Butuh Bantuan --}}
                    <div class="bg-[#033E8A] rounded-2xl p-5">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h3 class="font-montserrat font-bold text-white text-base mb-2">
                            Butuh Bantuan?
                        </h3>
                        <p class="font-montserrat text-blue-200 text-sm leading-relaxed mb-4">
                            Asisten kami siap membantu Anda memilih spesialis yang tepat.
                        </p>
                        <button class="w-full flex items-center justify-center gap-2 bg-white/20 hover:bg-white/30
                                       text-white font-montserrat font-semibold text-sm py-2.5 rounded-xl
                                       transition-colors border border-white/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Mulai Obrolan
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection