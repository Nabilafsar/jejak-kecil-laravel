{{-- resources/views/service.blade.php --}}

@include('layouts.header')

<body class="bg-white overflow-x-hidden">

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ════════════════════════════════════════ --}}
    <section class="hero-section min-h-[60vh] overflow-hidden relative flex items-center">
        <div class="max-w-[1200px] mx-auto px-[60px] w-full flex items-center gap-16 pt-20 pb-16">

            {{-- Kiri: Teks --}}
            <div class="flex-1">
                <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-3">
                    Layanan Kami
                </p>
                <h1 class="font-montserrat font-extrabold text-[#033E8a] text-[50px] leading-[1.2] mb-5">
                    Dirancang untuk <br>
                    <span class="text-[#4b9fe1]">Tumbuh Bersama</span> Anak
                </h1>
                <p class="font-montserrat text-gray-500 text-[14px] leading-[1.85] mb-8 max-w-[420px]">
                    Setiap layanan Jejak Kecil dibuat berdasarkan riset mendalam bersama orang tua
                    dan terapis, memastikan setiap anak mendapatkan pengalaman belajar yang
                    sesuai dengan kebutuhannya.
                </p>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/register') }}"
                       class="inline-block font-montserrat font-semibold text-white text-[14px]
                              bg-[#033E8a] px-7 py-3 rounded-md hover:bg-[#022F67] transition-colors shadow-lg">
                        Mulai Sekarang
                    </a>
                    <a href="{{ url('/login') }}"
                       class="inline-block font-montserrat font-semibold text-[#033E8a] text-[14px]
                              border-2 border-[#033E8a] px-7 py-3 rounded-md hover:bg-[#EEF4FF]
                              transition-colors">
                        Masuk
                    </a>
                </div>
            </div>

            {{-- Kanan: Stats Cards --}}
            <div class="flex-1 flex flex-col gap-4 items-end">
                <div class="grid grid-cols-2 gap-4 w-full max-w-[420px]">
                    <div class="bg-[#033E8a] rounded-2xl p-6 text-white shadow-xl">
                        <p class="font-montserrat font-extrabold text-[36px] leading-none">5+</p>
                        <p class="font-montserrat text-white/80 text-[13px] mt-2">Layanan Unggulan</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl">
                        <p class="font-montserrat font-extrabold text-[#033E8a] text-[36px] leading-none">1Jt+</p>
                        <p class="font-montserrat text-gray-500 text-[13px] mt-2">Pengguna Aktif</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl">
                        <p class="font-montserrat font-extrabold text-[#033E8a] text-[36px] leading-none">98%</p>
                        <p class="font-montserrat text-gray-500 text-[13px] mt-2">Kepuasan Orang Tua</p>
                    </div>
                    <div class="bg-[#4b9fe1] rounded-2xl p-6 text-white shadow-xl">
                        <p class="font-montserrat font-extrabold text-[36px] leading-none">24/7</p>
                        <p class="font-montserrat text-white/80 text-[13px] mt-2">Akses Belajar</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Dekorasi lingkaran hero --}}
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full border-[28px] border-[#033E8a]/10 pointer-events-none"></div>
        <div class="absolute top-10 -right-16 w-48 h-48 rounded-full border-[20px] border-[#4b9fe1]/10 pointer-events-none"></div>
    </section>

    {{-- ═══════════════════════════════════════
         LAYANAN UTAMA
    ════════════════════════════════════════ --}}
    <section class="bg-[#F8FAFF] py-24 px-[5%]">
        <div class="max-w-[1200px] mx-auto">

            {{-- Heading --}}
            <div class="text-center mb-16">
                <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-3">
                    Yang Kami Tawarkan
                </p>
                <h2 class="font-montserrat font-extrabold text-[#033E8a] text-[42px] leading-[1.2]">
                    Layanan Lengkap untuk Setiap Anak
                </h2>
                <p class="font-montserrat text-gray-500 text-[14px] mt-4 max-w-[500px] mx-auto leading-[1.85]">
                    Kami menghadirkan ekosistem belajar yang menyeluruh — dari modul pembelajaran
                    hingga konsultasi ahli, semua dalam satu platform.
                </p>
            </div>

            {{-- Grid Layanan --}}
            <div class="grid grid-cols-3 gap-6">

                {{-- Kartu 1: Modul Pembelajaran --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(3,62,138,.08)]
                            hover:shadow-[0_8px_40px_rgba(3,62,138,.15)] hover:-translate-y-1
                            transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mb-6
                                group-hover:bg-[#033E8a] transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#033E8a] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="font-montserrat font-bold text-[#033E8a] text-[20px] mb-3">
                        Modul Pembelajaran Adaptif
                    </h3>
                    <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85] mb-6">
                        Materi akademik yang disesuaikan dengan gaya belajar dan tingkat kemampuan
                        setiap anak — visual, auditori, maupun kinestetik. Dilengkapi video, kuis interaktif,
                        dan sistem poin untuk memotivasi anak belajar.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Sains, Matematika, Bahasa, Seni
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Kuis interaktif berhadiah poin
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Mode Sederhana untuk fokus lebih
                        </li>
                    </ul>
                </div>

                {{-- Kartu 2: Konsultasi Ahli (highlight) --}}
                <div class="bg-[#033E8a] rounded-3xl p-8 shadow-[0_8px_40px_rgba(3,62,138,.3)]
                            hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    {{-- Dekorasi --}}
                    <div class="absolute -bottom-10 -right-10 w-36 h-36 rounded-full bg-white/5 pointer-events-none"></div>
                    <div class="absolute top-6 right-6 w-20 h-20 rounded-full bg-white/5 pointer-events-none"></div>

                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center mb-6 relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <span class="font-montserrat text-[11px] font-bold bg-[#4b9fe1] text-white
                                     px-3 py-1 rounded-full uppercase tracking-wide mb-4 inline-block">
                            Unggulan
                        </span>
                        <h3 class="font-montserrat font-bold text-white text-[20px] mb-3">
                            Konsultasi Ahli
                        </h3>
                        <p class="font-montserrat text-white/80 text-[13px] leading-[1.85] mb-6">
                            Terhubung langsung dengan psikolog anak, terapis wicara, dan spesialis
                            pendidikan inklusif berpengalaman. Jadwalkan sesi dan diskusikan perkembangan
                            anak kapan saja melalui fitur chat terintegrasi.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 font-montserrat text-[13px] text-white/90">
                                <span class="text-[#FFD54A]">✦</span> Psikolog & terapis bersertifikat
                            </li>
                            <li class="flex items-center gap-2 font-montserrat text-[13px] text-white/90">
                                <span class="text-[#FFD54A]">✦</span> Chat & jadwal sesi fleksibel
                            </li>
                            <li class="flex items-center gap-2 font-montserrat text-[13px] text-white/90">
                                <span class="text-[#FFD54A]">✦</span> Berbagi dokumen & panduan
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Kartu 3: Laporan Perkembangan --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(3,62,138,.08)]
                            hover:shadow-[0_8px_40px_rgba(3,62,138,.15)] hover:-translate-y-1
                            transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mb-6
                                group-hover:bg-[#033E8a] transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#033E8a] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-montserrat font-bold text-[#033E8a] text-[20px] mb-3">
                        Laporan Perkembangan
                    </h3>
                    <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85] mb-6">
                        Pantau perjalanan belajar anak secara real-time. Laporan lengkap mencakup
                        progres modul, skor kuis, total waktu belajar, dan rekomendasi
                        langkah belajar berikutnya.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Grafik progres visual
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Skor & akurasi per modul
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Rekomendasi belajar otomatis
                        </li>
                    </ul>
                </div>

                {{-- Kartu 4: Gamifikasi --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(3,62,138,.08)]
                            hover:shadow-[0_8px_40px_rgba(3,62,138,.15)] hover:-translate-y-1
                            transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mb-6
                                group-hover:bg-[#033E8a] transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#033E8a] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="font-montserrat font-bold text-[#033E8a] text-[20px] mb-3">
                        Gamifikasi & Reward
                    </h3>
                    <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85] mb-6">
                        Sistem poin, level, dan karakter avatar membuat anak lebih semangat dan
                        termotivasi belajar. Setiap pencapaian dihargai dengan lencana dan
                        reward yang bisa ditukar di toko karakter.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Sistem poin & level naik
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Koleksi avatar & lencana
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Toko reward interaktif
                        </li>
                    </ul>
                </div>

                {{-- Kartu 5: Panduan Orang Tua --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(3,62,138,.08)]
                            hover:shadow-[0_8px_40px_rgba(3,62,138,.15)] hover:-translate-y-1
                            transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mb-6
                                group-hover:bg-[#033E8a] transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#033E8a] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-montserrat font-bold text-[#033E8a] text-[20px] mb-3">
                        Panduan Orang Tua
                    </h3>
                    <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85] mb-6">
                        Artikel, tips, dan panduan praktis yang dikurasi oleh para ahli untuk
                        membantu orang tua mendampingi anak belajar di rumah dengan cara yang
                        tepat dan menyenangkan.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Artikel parenting ABK
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Tips pendampingan belajar
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Komunitas orang tua inklusif
                        </li>
                    </ul>
                </div>

                {{-- Kartu 6: Aksesibilitas --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_24px_rgba(3,62,138,.08)]
                            hover:shadow-[0_8px_40px_rgba(3,62,138,.15)] hover:-translate-y-1
                            transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-[#EEF4FF] flex items-center justify-center mb-6
                                group-hover:bg-[#033E8a] transition-colors duration-300">
                        <svg class="w-7 h-7 text-[#033E8a] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-montserrat font-bold text-[#033E8a] text-[20px] mb-3">
                        Desain Aksesibel
                    </h3>
                    <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85] mb-6">
                        Tampilan yang ramah sensorik dengan Mode Sederhana untuk mengurangi
                        distraksi visual, pengingat istirahat otomatis, dan antarmuka yang
                        mudah dipahami oleh anak berkebutuhan khusus.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Mode Sederhana & fokus
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Pengingat istirahat lembut
                        </li>
                        <li class="flex items-center gap-2 font-montserrat text-[13px] text-gray-600">
                            <span class="text-[#033E8a]">✦</span> Warna & font ramah mata
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         CARA KERJA
    ════════════════════════════════════════ --}}
    <section class="relative bg-[#0D2B6B] overflow-hidden py-24 px-[5%]">

        {{-- Dekorasi --}}
        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border-[24px] border-white/10 pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 right-0 w-5 h-44 bg-red-500 rounded-l-full pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 left-0 w-5 h-44 bg-red-500 rounded-r-full pointer-events-none"></div>

        <div class="relative z-10 max-w-[1200px] mx-auto">

            <div class="text-center mb-16">
                <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-3">
                    Mudah & Cepat
                </p>
                <h2 class="font-montserrat font-extrabold text-white text-[42px] leading-[1.2]">
                    Bagaimana Cara Kerjanya?
                </h2>
                <p class="font-montserrat text-white/70 text-[14px] mt-4 max-w-[460px] mx-auto leading-[1.85]">
                    Hanya 3 langkah sederhana untuk memulai perjalanan belajar anak yang
                    menyenangkan dan terstruktur.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-8 relative">

                {{-- Garis penghubung --}}
                <div class="absolute top-10 left-[20%] right-[20%] h-[2px] bg-white/20 hidden lg:block"></div>

                {{-- Step 1 --}}
                <div class="text-center relative">
                    <div class="w-20 h-20 rounded-full bg-[#033E8a] border-4 border-[#4b9fe1]
                                flex items-center justify-center mx-auto mb-6 relative z-10">
                        <span class="font-montserrat font-extrabold text-white text-[28px]">1</span>
                    </div>
                    <h3 class="font-montserrat font-bold text-white text-[18px] mb-3">
                        Daftar & Isi Profil Anak
                    </h3>
                    <p class="font-montserrat text-white/70 text-[13px] leading-[1.85]">
                        Buat akun dan lengkapi profil anak — nama, usia, gaya belajar, dan
                        level kemampuan. Proses onboarding yang cepat dan ramah.
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="text-center relative">
                    <div class="w-20 h-20 rounded-full bg-[#4b9fe1] border-4 border-white
                                flex items-center justify-center mx-auto mb-6 relative z-10">
                        <span class="font-montserrat font-extrabold text-white text-[28px]">2</span>
                    </div>
                    <h3 class="font-montserrat font-bold text-white text-[18px] mb-3">
                        Pilih Modul & Mulai Belajar
                    </h3>
                    <p class="font-montserrat text-white/70 text-[13px] leading-[1.85]">
                        Jelajahi modul yang sesuai, tonton video pembelajaran, dan selesaikan
                        kuis interaktif untuk mengumpulkan poin dan lencana.
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="text-center relative">
                    <div class="w-20 h-20 rounded-full bg-[#033E8a] border-4 border-[#4b9fe1]
                                flex items-center justify-center mx-auto mb-6 relative z-10">
                        <span class="font-montserrat font-extrabold text-white text-[28px]">3</span>
                    </div>
                    <h3 class="font-montserrat font-bold text-white text-[18px] mb-3">
                        Pantau & Konsultasi
                    </h3>
                    <p class="font-montserrat text-white/70 text-[13px] leading-[1.85]">
                        Lihat laporan perkembangan anak dan hubungi spesialis untuk mendapatkan
                        panduan yang lebih personal sesuai kebutuhan anak.
                    </p>
                </div>

            </div>

            {{-- CTA --}}
            <div class="text-center mt-14">
                <a href="{{ url('/register') }}"
                   class="inline-block font-montserrat font-semibold text-[#033E8a] text-[15px]
                          bg-white px-10 py-4 rounded-md hover:bg-[#EEF4FF] transition-colors shadow-xl">
                    Mulai Perjalanan Anak Sekarang →
                </a>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════
         FAQ
    ════════════════════════════════════════ --}}
    <section class="bg-white py-24 px-[5%]">
        <div class="max-w-[800px] mx-auto">

            <div class="text-center mb-14">
                <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-3">
                    Pertanyaan Umum
                </p>
                <h2 class="font-montserrat font-extrabold text-[#033E8a] text-[42px] leading-[1.2]">
                    Ada yang Ingin Ditanyakan?
                </h2>
            </div>

            <div class="flex flex-col gap-4" id="faqContainer">

                @php
                $faqs = [
                    ['q' => 'Apakah Jejak Kecil cocok untuk semua jenis ABK?',
                     'a' => 'Ya! Jejak Kecil dirancang untuk berbagai kebutuhan — termasuk anak dengan autism spektrum, ADHD, disleksia, tunarungu ringan, dan kesulitan belajar lainnya. Sistem kami menyesuaikan konten berdasarkan gaya belajar dan level kemampuan anak.'],
                    ['q' => 'Berapa biaya yang diperlukan untuk menggunakan layanan ini?',
                     'a' => 'Jejak Kecil menyediakan akses gratis untuk modul dasar dan laporan belajar sederhana. Untuk fitur lengkap seperti konsultasi ahli dan modul premium, tersedia paket berlangganan yang terjangkau.'],
                    ['q' => 'Bagaimana cara menghubungi spesialis atau terapis?',
                     'a' => 'Setelah mendaftar, masuk ke menu Konsultasi di dashboard. Pilih spesialis yang sesuai dengan kebutuhan anak, buat jadwal sesi, dan mulai chat langsung melalui platform kami.'],
                    ['q' => 'Apakah orang tua bisa memantau aktivitas belajar anak?',
                     'a' => 'Tentu! Menu Report di dashboard menampilkan laporan lengkap — progres modul, skor kuis, total waktu belajar, dan rekomendasi modul berikutnya secara real-time.'],
                    ['q' => 'Apakah tersedia di perangkat mobile?',
                     'a' => 'Jejak Kecil dapat diakses melalui browser di smartphone, tablet, maupun desktop. Kami juga sedang mengembangkan aplikasi mobile untuk pengalaman yang lebih optimal.'],
                ];
                @endphp

                @foreach($faqs as $i => $faq)
                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(3,62,138,.06)]">
                    <button onclick="toggleFaq({{ $i }})"
                            class="w-full flex items-center justify-between px-6 py-5 text-left
                                   hover:bg-[#F8FAFF] transition-colors">
                        <span class="font-montserrat font-semibold text-[#033E8a] text-[15px]">
                            {{ $faq['q'] }}
                        </span>
                        <svg id="faqIcon{{ $i }}"
                             class="w-5 h-5 text-[#033E8a] flex-shrink-0 ml-4 transition-transform duration-300"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faqAnswer{{ $i }}" class="hidden px-6 pb-5">
                        <p class="font-montserrat text-gray-500 text-[13px] leading-[1.85]">
                            {{ $faq['a'] }}
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         CTA AKHIR
    ════════════════════════════════════════ --}}
    <section class="relative bg-[#0D2B6B] overflow-hidden py-20 px-[5%]">

        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border-[24px] border-white/10 pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none"></div>

        <div class="relative z-10 max-w-[700px] mx-auto text-center">
            <h2 class="font-montserrat font-extrabold text-white text-[44px] leading-[1.2] mb-5">
                Mulai Perjalanan Belajar <br>Anak Anda Sekarang
            </h2>
            <p class="font-montserrat text-white/70 text-[14px] leading-[1.85] mb-10 max-w-[480px] mx-auto">
                Bergabunglah dengan ribuan orang tua yang telah mempercayakan
                pendidikan anak berkebutuhan khusus mereka kepada Jejak Kecil.
            </p>
            <div class="flex items-center justify-center gap-4">
                <a href="{{ url('/register') }}"
                   class="inline-block font-montserrat font-semibold text-[#033E8a] text-[15px]
                          bg-white px-8 py-4 rounded-md hover:bg-[#EEF4FF] transition-colors shadow-xl">
                    Daftar Sekarang — Gratis
                </a>
                <a href="{{ url('/') }}"
                   class="inline-block font-montserrat font-semibold text-white text-[15px]
                          border-2 border-white/40 px-8 py-4 rounded-md hover:border-white
                          transition-colors">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

</body>

<script>
    function toggleFaq(index) {
        const answer = document.getElementById('faqAnswer' + index);
        const icon   = document.getElementById('faqIcon' + index);
        const isOpen = !answer.classList.contains('hidden');

        // Tutup semua
        document.querySelectorAll('[id^="faqAnswer"]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[id^="faqIcon"]').forEach(el => el.style.transform = '');

        // Buka yang diklik (jika sebelumnya tertutup)
        if (!isOpen) {
            answer.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>

{{-- FOOTER --}}
@include('layouts.footer')
