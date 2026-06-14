@extends('layouts.app')

@section('title', 'Semua Jadwal - Jejak Kecil')

@section('content')
@include('layouts.headerPengguna')

<div class="bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('pengguna.konsultasi.index') }}"
               class="text-gray-400 hover:text-[#033E8A] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="font-montserrat font-bold text-[#033E8A] text-2xl">Semua Jadwal Saya</h1>
        </div>

        @if($jadwalSaya->isEmpty())
        <div class="text-center py-20">
            <div class="text-5xl mb-4">📅</div>
            <p class="font-montserrat text-gray-400">Belum ada jadwal konsultasi.</p>
            <a href="{{ route('pengguna.konsultasi.index') }}"
               class="inline-block mt-4 font-montserrat font-semibold text-sm text-white
                      bg-[#033E8A] px-6 py-3 rounded-full hover:bg-[#022F67] transition-colors">
                Cari Spesialis
            </a>
        </div>
        @else
        <div class="flex flex-col gap-4">
            @foreach($jadwalSaya as $jd)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5
                        flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0 bg-gradient-to-br
                                from-[#033E8A] to-[#0AADA8] flex items-center justify-center text-white font-bold">
                        @if($jd->spesialis->foto)
                            <img src="{{ asset('assets/img/' . $jd->spesialis->foto) }}"
                                 class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($jd->spesialis->nama, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <h3 class="font-montserrat font-bold text-[#033E8A] text-sm">
                            {{ $jd->judul_sesi }}
                        </h3>
                        <p class="font-montserrat text-gray-500 text-xs">
                            {{ $jd->spesialis->nama }} • {{ $jd->waktu_mulai->format('d M Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-montserrat text-xs font-semibold px-3 py-1.5 rounded-full
                        {{ $jd->status === 'akan_datang' ? 'bg-[#EEF4FF] text-[#033E8A]' : '' }}
                        {{ $jd->status === 'selesai' ? 'bg-gray-100 text-gray-500' : '' }}
                        {{ $jd->status === 'dibatalkan' ? 'bg-red-50 text-red-400' : '' }}">
                        {{ $jd->label_status }}
                    </span>
                    <a href="{{ route('pengguna.konsultasi.chat', $jd->id) }}"
                       class="font-montserrat text-sm font-semibold text-[#033E8A]
                              hover:underline transition-colors">
                        Buka →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

@include('layouts.footer')
@endsection
