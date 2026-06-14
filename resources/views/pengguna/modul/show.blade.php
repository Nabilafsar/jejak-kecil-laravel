@extends('layouts.app')

@section('title', $modul->judul_modul . ' - Jejak Kecil')

@section('content')
    <div class="min-h-screen bg-white flex flex-col">

        {{-- Navbar --}}
        @include('layouts.headerPengguna')

        {{-- Konten Utama --}}
        <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm font-montserrat text-gray-400 mb-3">
                <a href="{{ route('pengguna.modul.index') }}" class="hover:text-[#033E8A] transition-colors">Modul</a>
                <span>›</span>
                <a href="{{ route('pengguna.modul.index', ['kategori' => $modul->kategori]) }}"
                    class="hover:text-[#033E8A] transition-colors">{{ $modul->kategori }}</a>
                <span>›</span>
                <span class="text-[#033E8A] font-medium">{{ $modul->judul_modul }}</span>
            </nav>

            {{-- Kembali --}}
            <a href="{{ route('pengguna.modul.index') }}"
                class="inline-flex items-center gap-1 font-montserrat text-sm text-[#033E8A] hover:underline mb-5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Modul
            </a>

            {{-- Judul --}}
            <h1 class="font-montserrat font-bold text-[#033E8A] text-3xl mb-1">
                {{ $modul->judul_modul }}
            </h1>
            <p class="font-montserrat text-gray-500 text-sm mb-8">
                {{ $modul->deskripsi ?? 'Mari jelajahi materi ini dengan tenang dan menyenangkan.' }}
            </p>

            {{-- Layout Dua Kolom --}}
            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Konten Utama --}}
                <div class="lg:col-span-2 flex flex-col gap-6">

                    {{-- Video Player / Konten Utama --}}
                    @php $firstContent = $modul->isiModul->first(); @endphp

                    @if($firstContent && $firstContent->tipe_konten === 'video')
                        @php
                            $videoUrl = $firstContent->isi_konten;
                            $isYoutube = str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be');

                            if ($isYoutube) {
                                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches);
                                $videoId = $matches[1] ?? null;
                                $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
                            }
                        @endphp
                        <div class="relative rounded-3xl overflow-hidden bg-gray-900 shadow-xl aspect-video">
                            @if($isYoutube && !empty($embedUrl))
                                <iframe class="w-full h-full" src="{{ $embedUrl }}"
                                    title="{{ $firstContent->judul_konten ?? $modul->judul_modul }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <video id="mainVideo" class="w-full h-full object-cover" controls controlslist="nodownload"
                                    poster="{{ $modul->thumbnail ? asset('storage/' . $modul->thumbnail) : '' }}">
                                    <source src="{{ asset('storage/' . $videoUrl) }}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            @endif
                        </div>
                        

                    @elseif($firstContent && $firstContent->tipe_konten === 'gambar')
                        <div class="rounded-3xl overflow-hidden shadow-xl">
                            <img src="{{ asset('storage/' . $firstContent->isi_konten) }}" alt="{{ $modul->judul_modul }}"
                                class="w-full max-h-96 object-contain bg-gray-50">
                        </div>

                    @else
                        {{-- Placeholder jika belum ada konten --}}
                        <div class="rounded-3xl bg-gradient-to-br from-teal-50 to-cyan-100 aspect-video
                                            flex items-center justify-center shadow-xl">
                            <div class="text-center">
                                <span class="text-6xl">📚</span>
                                <p class="font-montserrat text-[#033E8A] font-semibold mt-3">Konten segera hadir</p>
                            </div>
                        </div>
                    @endif

                    {{-- Tombol Aksi Bawah Video --}}
                    <div class="grid grid-cols-2 gap-4">
                        <button
                            class="flex items-center justify-center gap-2 border border-gray-200 rounded-2xl py-3.5
                                           font-montserrat text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Catatan Materi
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 border border-gray-200 rounded-2xl py-3.5
                                           font-montserrat text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-[#0AADA8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh Handout
                        </button>
                    </div>

                    {{-- Tentang Pelajaran --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                        <h2 class="font-montserrat font-bold text-[#033E8A] text-xl mb-4">
                            Tentang Pelajaran Ini
                        </h2>
                        @if($firstContent)
                            <p class="font-montserrat text-gray-600 text-sm leading-relaxed mb-3">
                                {{ $firstContent->deskripsi_konten ?? $modul->deskripsi }}
                            </p>
                        @endif
                        <p class="font-montserrat text-gray-500 text-sm leading-relaxed">
                            Materi ini dirancang dengan warna yang lembut dan cara yang menenangkan, cocok untuk
                            belajar sambil bersantai. Tidak ada kuis dadakan di bagian ini, cukup nikmati ceritanya.
                        </p>
                    </div>

                </div>

                {{-- Kolom Kanan: Sidebar --}}
                <div class="flex flex-col gap-5">

                    {{-- Progress Belajar --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-xl bg-[#EEF4FF] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-montserrat font-bold text-[#033E8A] text-base">Progress Belajar</h3>
                                <p class="font-montserrat text-gray-400 text-xs">Modul {{ $modul->kategori }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm font-montserrat mb-2">
                            <span class="text-[#033E8A] font-semibold">{{ $progress?->persentase_progress ?? 0 }}%
                                Selesai</span>
                            <span class="text-gray-400">{{ $pelajaranSelesai }}/{{ $totalPelajaran }} Pelajaran</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-[#033E8A] rounded-full transition-all"
                                style="width: {{ $progress?->persentase_progress ?? 0 }}%">
                            </div>
                        </div>
                    </div>

                    {{-- Cek Pengetahuan (Kuis) --}}
                    @if($modul->kuis->count() > 0)
                        <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 p-5">
                            <div class="text-center">
                                <div class="w-12 h-12 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-[#0AADA8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="font-montserrat font-bold text-[#033E8A] text-base mb-2">Cek Pengetahuan</h3>
                                <p class="font-montserrat text-gray-500 text-xs mb-4 leading-relaxed">
                                    Jawab {{ $modul->kuis->count() }} pertanyaan seru tentang
                                    {{ $modul->judul_modul }} untuk mendapatkan Lencana Bintang!
                                </p>
                                <a href="{{ route('pengguna.modul.quiz', $modul->id) }}"
                                    class="block w-full bg-[#033E8A] hover:bg-[#022F67] text-white font-montserrat
                                                  font-semibold text-sm py-3 rounded-xl transition-all duration-300 text-center">
                                    Mulai Kuis Sekarang →
                                </a>
                                <div class="flex items-center justify-center gap-4 mt-3 text-xs text-gray-400 font-montserrat">
                                    <span>⏱ 3 Menit</span>
                                    <span>⭐ +{{ $modul->kuis->sum('poin') }} Poin</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Pengaturan Sensori --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-[#0AADA8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h3 class="font-montserrat font-bold text-[#033E8A] text-base">Pengaturan Sensori</h3>
                        </div>

                        {{-- Toggle Pengingat Istirahat --}}
                        <div class="flex items-start justify-between py-3 border-b border-gray-50">
                            <div class="flex-1 mr-3">
                                <p class="font-montserrat font-medium text-gray-700 text-sm">Pengingat Istirahat</p>
                                <p class="font-montserrat text-gray-400 text-xs mt-0.5">Tampilkan notifikasi lembut untuk
                                    jeda setiap 15 menit.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer mt-1">
                                <input type="checkbox" id="pengingatIstirahat" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-200 rounded-full peer
                                                peer-checked:bg-[#0AADA8]
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all
                                                peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>

                        {{-- Toggle Antarmuka Sederhana --}}
                        <div class="flex items-start justify-between py-3">
                            <div class="flex-1 mr-3">
                                <p class="font-montserrat font-medium text-gray-700 text-sm">Antarmuka Sederhana</p>
                                <p class="font-montserrat text-gray-400 text-xs mt-0.5">Sembunyikan elemen visual yang tidak
                                    penting.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer mt-1">
                                <input type="checkbox" id="antarmukaSederhana" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-200 rounded-full peer
                                                peer-checked:bg-[#0AADA8]
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all
                                                peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </main>

        @include('layouts.footer')

    </div>

    @push('scripts')
        <script>
            const video = document.getElementById('mainVideo');
            const overlay = document.getElementById('videoOverlay');
            const progress = document.getElementById('videoProgress');
            const timeLabel = document.getElementById('videoTime');

            function formatTime(s) {
                const m = Math.floor(s / 60);
                const sec = Math.floor(s % 60).toString().padStart(2, '0');
                return `${m}:${sec}`;
            }

            function playVideo() {
                if (video) {
                    video.play();
                    if (overlay) overlay.style.display = 'none';
                }
            }

            function togglePlay() {
                if (!video) return;
                video.paused ? video.play() : video.pause();
            }

            function toggleMute() {
                if (video) video.muted = !video.muted;
            }

            function toggleFullscreen() {
                if (!video) return;
                if (!document.fullscreenElement) {
                    video.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            }

            function seekVideo(e) {
                if (!video) return;
                const bar = document.getElementById('progressBar');
                const rect = bar.getBoundingClientRect();
                const ratio = (e.clientX - rect.left) / rect.width;
                video.currentTime = ratio * video.duration;
            }

            if (video) {
                video.addEventListener('timeupdate', function () {
                    if (video.duration) {
                        const pct = (video.currentTime / video.duration) * 100;
                        if (progress) progress.style.width = pct + '%';
                        if (timeLabel) timeLabel.textContent = formatTime(video.currentTime) + ' / ' + formatTime(video.duration);
                    }
                });
                video.addEventListener('ended', function () {
                    if (overlay) overlay.style.display = 'flex';
                });
            }

            // Pengaturan Sensori
            const pengingatToggle = document.getElementById('pengingatIstirahat');
            const antarmukaSederhana = document.getElementById('antarmukaSederhana');
            let pengingatInterval;

            if (pengingatToggle) {
                pengingatToggle.addEventListener('change', function () {
                    if (this.checked) {
                        pengingatInterval = setInterval(() => {
                            alert('⏰ Waktunya istirahat sejenak! Tarik napas dan rileks.');
                        }, 15 * 60 * 1000);
                    } else {
                        clearInterval(pengingatInterval);
                    }
                });
            }

            if (antarmukaSederhana) {
                antarmukaSederhana.addEventListener('change', function () {
                    document.body.classList.toggle('mode-sederhana', this.checked);
                });
            }
        </script>
    @endpush

@endsection