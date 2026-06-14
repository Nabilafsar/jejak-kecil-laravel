@extends('layouts.app')

@section('content')
    @include('layouts.headerPengguna')

    <div class="px-12 py-10 max-w-7xl mx-auto">

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-3">
                <span class="text-2xl">🎉</span>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-2xl flex items-center gap-3">
                <span class="text-2xl">❌</span>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        {{-- HEADER HALAMAN --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-[#033E8A]">Gamification</h1>
            <p class="text-gray-500 mt-2 text-lg">Kelola poin, beli avatar, dan lihat pencapaianmu!</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: My Avatar + Statistik Poin --}}
            <div class="lg:col-span-1 flex flex-col gap-6">

                {{-- KARTU MY AVATAR --}}
                <div class="bg-[#C8F5C8] rounded-3xl p-8 flex flex-col items-center shadow-md">
                    <h2 class="text-xl font-bold text-[#033E8A] mb-4 self-start">My Avatar</h2>
                    <div class="w-44 h-44 flex items-center justify-center">
                        @if($anak->avatar)
                            <img src="{{ asset('assets/img/avatars/' . $anak->avatar) }}"
                                 alt="Avatar {{ $anak->nama_panggilan }}"
                                 class="w-full h-full object-contain drop-shadow-lg">
                        @else
                            <div class="w-full h-full bg-white/50 rounded-2xl flex items-center justify-center">
                                <span class="text-6xl">🧒</span>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold text-[#033E8A] mt-4">
                        {{ $anak->avatar ? pathinfo($anak->avatar, PATHINFO_FILENAME) : 'Belum Ada' }}
                    </h3>
                </div>

                {{-- KARTU POIN --}}
                <div class="bg-[#033E8A] rounded-3xl p-6 text-white shadow-md">
                    <h2 class="text-lg font-semibold opacity-80">Total Poin</h2>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-4xl">🪙</span>
                        <span class="text-5xl font-bold">{{ number_format($anak->total_poin) }}</span>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="bg-white/10 rounded-2xl p-3 text-center">
                            <p class="text-xs opacity-70">Level</p>
                            <p class="text-2xl font-bold">{{ $anak->level_anak }}</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-3 text-center">
                            <p class="text-xs opacity-70">Avatar Dimiliki</p>
                            <p class="text-2xl font-bold">{{ count($avatarDibeli) }}</p>
                        </div>
                    </div>
                </div>

                {{-- RIWAYAT TRANSAKSI SINGKAT --}}
                <div class="bg-white rounded-3xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-[#033E8A]">Riwayat Transaksi</h2>
                        <a href="{{ route('pengguna.gamifikasi.riwayat') }}"
                           class="text-sm text-[#FFD54A] font-semibold hover:underline">
                            Lihat Semua
                        </a>
                    </div>

                    @forelse($riwayatTransaksi as $trx)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center
                                    {{ $trx->tipe === 'kredit' ? 'bg-green-100' : 'bg-red-100' }}">
                                    <span class="text-base">
                                        {{ $trx->tipe === 'kredit' ? '⬆️' : '⬇️' }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700 leading-tight">
                                        {{ $trx->keterangan }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $trx->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <span class="font-bold text-sm
                                {{ $trx->tipe === 'kredit' ? 'text-green-600' : 'text-red-500' }}">
                                {{ $trx->tipe === 'kredit' ? '+' : '-' }}{{ $trx->jumlah_poin }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm text-center py-4">Belum ada transaksi</p>
                    @endforelse
                </div>

            </div>

            {{-- KOLOM KANAN: SHOP --}}
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-[#033E8A]">Shop</h2>
                    <div class="flex items-center gap-2 bg-[#FFD54A] px-4 py-2 rounded-full shadow">
                        <span class="text-lg">🪙</span>
                        <span class="font-bold text-[#033E8A] text-lg">{{ number_format($anak->total_poin) }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach($avatarShop as $avatar)
                        @php
                            $sudahDibeli = in_array($avatar->id, $avatarDibeli) || $avatar->harga_poin === 0;
                            $isPakai    = $anak->avatar === $avatar->gambar;
                            $bisaBeli   = !$sudahDibeli && $anak->total_poin >= $avatar->harga_poin;
                        @endphp
                        <div class="rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300"
                             style="background-color: {{ $avatar->warna_background }}">

                            {{-- Gambar Avatar --}}
                            <div class="h-40 flex items-center justify-center p-4">
                                <img src="{{ asset('assets/img/avatars/' . $avatar->gambar) }}"
                                     alt="{{ $avatar->nama_avatar }}"
                                     class="h-full object-contain drop-shadow-lg">
                            </div>

                            {{-- Info + Tombol --}}
                            <div class="bg-white px-4 py-3">
                                <h3 class="font-bold text-[#033E8A] text-base">{{ $avatar->nama_avatar }}</h3>

                                {{-- BADGE STATUS --}}
                                @if($isPakai)
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">
                                        ✓ Dipakai
                                    </span>
                                @elseif($sudahDibeli)
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">
                                        ✓ Dimiliki
                                    </span>
                                @else
                                    <div class="flex items-center gap-1 mt-1">
                                        <span class="text-yellow-500 text-sm">🪙</span>
                                        <span class="font-bold text-[#033E8A] text-sm">
                                            {{ $avatar->harga_poin === 0 ? 'Gratis' : $avatar->harga_poin }}
                                        </span>
                                    </div>
                                @endif

                                {{-- TOMBOL AKSI --}}
                                <div class="mt-3">
                                    @if($isPakai)
                                        <button disabled
                                                class="w-full py-2 rounded-xl bg-gray-100 text-gray-400 text-sm font-semibold cursor-not-allowed">
                                            Sedang Dipakai
                                        </button>

                                    @elseif($sudahDibeli)
                                        {{-- Tombol Pakai --}}
                                        <form action="{{ route('pengguna.gamifikasi.pakai') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_avatar_shop" value="{{ $avatar->id }}">
                                            <button type="submit"
                                                    class="w-full py-2 rounded-xl bg-[#033E8A] hover:bg-[#02306e]
                                                           text-white text-sm font-semibold transition-colors">
                                                Pakai Avatar
                                            </button>
                                        </form>

                                    @elseif($bisaBeli)
                                        {{-- Tombol Beli --}}
                                        <form action="{{ route('pengguna.gamifikasi.beli') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_avatar_shop" value="{{ $avatar->id }}">
                                            <button type="submit"
                                                    onclick="return confirm('Beli avatar {{ $avatar->nama_avatar }} seharga {{ $avatar->harga_poin }} poin?')"
                                                    class="w-full py-2 rounded-xl bg-[#FFD54A] hover:bg-[#F4C542]
                                                           text-[#033E8A] text-sm font-semibold transition-colors">
                                                Beli Sekarang
                                            </button>
                                        </form>

                                    @else
                                        {{-- Poin Tidak Cukup --}}
                                        <button disabled
                                                class="w-full py-2 rounded-xl bg-gray-100 text-gray-400 text-sm font-semibold cursor-not-allowed">
                                            Poin Tidak Cukup
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection