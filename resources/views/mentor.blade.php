{{-- resources/views/mentor.blade.php --}}

@include('layouts.header')

<body class="bg-white overflow-x-hidden">

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ════════════════════════════════════════ --}}
    <section class="hero-section min-h-[75vh] overflow-hidden relative flex items-center justify-center">

        {{-- Background dekorasi blur --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[500px] rounded-full
                    bg-[#4b9fe1]/20 blur-[120px] pointer-events-none z-0"></div>

        <div class="relative z-10 text-center px-6 pt-32 pb-16 max-w-[600px] mx-auto">
            <p class="font-montserrat font-bold text-[#4b9fe1] text-[12px] tracking-[3px] uppercase mb-3">
                Belajar Langsung Dari
            </p>
            <h1 class="font-montserrat font-extrabold text-[#033E8a] text-[62px] leading-[1.1] mb-5">
                MENTOR<br>
                <span class="text-[#033E8a]">PROFESIONAL</span>
            </h1>
            <p class="font-montserrat text-gray-500 text-[14px] leading-[1.85] mb-8 max-w-[380px] mx-auto">
                Mulai perjalanan belajarmu bersama mentor berpengalaman yang siap membimbing
                setiap langkahmu dengan penuh kesabaran dan keahlian.
            </p>
            <a href="{{ url('/register') }}"
               class="inline-block font-montserrat font-semibold text-white text-[14px]
                      bg-[#033E8a] px-9 py-3.5 rounded-md hover:bg-[#022F67] transition-colors shadow-lg">
                Get Started
            </a>
        </div>

        {{-- Dekorasi lingkaran --}}
        <div class="absolute bottom-0 -left-20 w-56 h-56 rounded-full border-[20px] border-[#033E8a]/10 pointer-events-none"></div>
        <div class="absolute top-20 -right-16 w-40 h-40 rounded-full border-[16px] border-[#4b9fe1]/10 pointer-events-none"></div>

    </section>

    {{-- ═══════════════════════════════════════
         SLIDER MENTOR
    ════════════════════════════════════════ --}}
    <section class="bg-white py-16 px-[5%] overflow-hidden">
        <div class="max-w-[1200px] mx-auto">

            <div class="text-center mb-10">
                <h2 class="font-montserrat font-bold text-[#033E8a] text-[32px]">
                    Yuk, Kenalan dengan
                    <span class="text-[#4b9fe1]">Mentor Kami</span>
                </h2>
            </div>

            {{-- Swiper Slider --}}
            <div class="relative">
                <div class="swiper mentorSwiper overflow-hidden rounded-2xl">
                    <div class="swiper-wrapper items-center py-4">

                        @php
                        $mentors = [
                            ['nama' => 'Dr. Sarah Anindita', 'spesialis' => 'Psikolog Anak', 'inisial' => 'S'],
                            ['nama' => 'Budi Santoso, M.Psi', 'spesialis' => 'Terapi Wicara', 'inisial' => 'B'],
                            ['nama' => 'Dian Pertiwi, S.Psi', 'spesialis' => 'Spesialis Kognitif', 'inisial' => 'D'],
                            ['nama' => 'Reza Firmansyah', 'spesialis' => 'Pendidikan Inklusif', 'inisial' => 'R'],
                            ['nama' => 'Siti Rahayu, M.Pd', 'spesialis' => 'Terapi Perilaku', 'inisial' => 'S'],
                            ['nama' => 'Ahmad Fauzi, S.Psi', 'spesialis' => 'Psikolog Klinis', 'inisial' => 'A'],
                            ['nama' => 'Nadia Kusuma', 'spesialis' => 'Edukasi Khusus', 'inisial' => 'N'],
                        ];
                        @endphp

                        @foreach($mentors as $m)
                        <div class="swiper-slide !w-auto">
                            <div class="flex flex-col items-center gap-3 px-4 cursor-pointer group">
                                {{-- Avatar --}}
                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-transparent
                                            group-hover:border-[#033E8a] transition-all duration-300 shadow-lg
                                            bg-gradient-to-br from-[#033E8a] to-[#4b9fe1]
                                            flex items-center justify-center">
                                    <span class="font-montserrat font-bold text-white text-2xl">
                                        {{ $m['inisial'] }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p class="font-montserrat font-semibold text-[#033E8a] text-[12px]">
                                        {{ $m['nama'] }}
                                    </p>
                                    <p class="font-montserrat text-gray-400 text-[11px]">
                                        {{ $m['spesialis'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                {{-- Navigasi Swiper --}}
                <button class="mentor-prev absolute left-0 top-10 -translate-x-4 z-10
                               w-9 h-9 rounded-full bg-white shadow-lg border border-gray-100
                               flex items-center justify-center hover:bg-[#033E8a] hover:text-white
                               text-[#033E8a] transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="mentor-next absolute right-0 top-10 translate-x-4 z-10
                               w-9 h-9 rounded-full bg-white shadow-lg border border-gray-100
                               flex items-center justify-center hover:bg-[#033E8a] hover:text-white
                               text-[#033E8a] transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════
         DETAIL MENTOR (ZIGZAG)
    ════════════════════════════════════════ --}}
    <section class="bg-[#0D2B6B] py-20 px-[5%] relative overflow-hidden">

        {{-- Dekorasi --}}
        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border-[24px] border-white/10 pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 right-0 w-5 h-44 bg-red-500 rounded-l-full pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 left-0 w-5 h-44 bg-red-500 rounded-r-full pointer-events-none"></div>

        <div class="relative z-10 max-w-[1100px] mx-auto flex flex-col gap-16">

            @php
            $detailMentors = [
                [
                    'nama'       => 'Dr. Sarah Anindita',
                    'role'       => 'Psikolog Anak & Konsultan Pendidikan Inklusif',
                    'inisial'    => 'S',
                    'warna'      => 'from-[#033E8a] to-[#4b9fe1]',
                    'deskripsi'  => 'Dr. Sarah adalah psikolog anak berpengalaman dengan lebih dari 12 tahun mendampingi anak berkebutuhan khusus. Beliau memiliki keahlian dalam identifikasi dini, pengembangan program belajar personal, dan konseling keluarga. Bergabung bersama Jejak Kecil sejak 2021, Dr. Sarah telah membantu ratusan keluarga menemukan pendekatan belajar yang paling sesuai untuk anak mereka.',
                    'keahlian'   => ['Psikologi Perkembangan Anak', 'Terapi Kognitif-Perilaku', 'Pendidikan Inklusif'],
                    'posisi'     => 'kiri',
                ],
                [
                    'nama'       => 'Budi Santoso, M.Psi',
                    'role'       => 'Terapis Wicara & Spesialis Komunikasi',
                    'inisial'    => 'B',
                    'warna'      => 'from-[#4b9fe1] to-[#033E8a]',
                    'deskripsi'  => 'Budi Santoso adalah terapis wicara bersertifikat yang telah menangani lebih dari 500 anak dengan keterlambatan bicara, autisme, dan gangguan komunikasi lainnya. Pendekatan beliau yang lembut dan berbasis permainan membuat anak-anak merasa nyaman dan termotivasi untuk berkomunikasi lebih baik setiap harinya.',
                    'keahlian'   => ['Terapi Wicara', 'Komunikasi Non-verbal', 'Keterlambatan Bicara'],
                    'posisi'     => 'kanan',
                ],
                [
                    'nama'       => 'Dian Pertiwi, S.Psi',
                    'role'       => 'Psikolog Klinis & Spesialis Manajemen Perilaku',
                    'inisial'    => 'D',
                    'warna'      => 'from-[#033E8a] to-[#0D2B6B]',
                    'deskripsi'  => 'Dian Pertiwi memiliki spesialisasi dalam manajemen perilaku dan regulasi emosi anak. Dengan rating 5.0 dari lebih dari 210 ulasan, beliau dikenal sebagai mentor yang penuh empati dan solusi praktis. Dian percaya bahwa setiap anak memiliki potensi luar biasa yang menunggu untuk dikembangkan dengan cara yang tepat.',
                    'keahlian'   => ['Manajemen Perilaku', 'Regulasi Emosi', 'ABA Therapy'],
                    'posisi'     => 'kiri',
                ],
            ];
            @endphp

            @foreach($detailMentors as $mentor)

            @if($mentor['posisi'] === 'kiri')
            {{-- Layout: Foto Kiri, Teks Kanan --}}
            <div class="flex items-center gap-14">

                {{-- Foto --}}
                <div class="flex-shrink-0 relative">
                    <div class="w-52 h-52 rounded-3xl bg-gradient-to-br {{ $mentor['warna'] }}
                                flex items-center justify-center shadow-2xl relative
                                rotate-3 hover:rotate-0 transition-transform duration-500">
                        <span class="font-montserrat font-extrabold text-white text-[72px]">
                            {{ $mentor['inisial'] }}
                        </span>
                        {{-- Kartu dekorasi --}}
                        <div class="absolute -top-3 -right-3 w-10 h-14 bg-white/20 rounded-lg
                                    flex items-center justify-center text-white text-xs font-bold border border-white/30">
                            A♠
                        </div>
                    </div>
                    {{-- Nama di bawah foto --}}
                    <div class="mt-4 text-center">
                        <p class="font-montserrat font-bold text-white text-[14px]">{{ $mentor['nama'] }}</p>
                        <p class="font-montserrat text-[#4b9fe1] text-[12px]">{{ explode(' & ', $mentor['role'])[0] }}</p>
                    </div>
                </div>

                {{-- Teks --}}
                <div class="flex-1">
                    <h3 class="font-montserrat font-bold text-white text-[22px] mb-1">
                        {{ $mentor['nama'] }}
                    </h3>
                    <p class="font-montserrat text-[#4b9fe1] text-[13px] font-semibold mb-4">
                        {{ $mentor['role'] }}
                    </p>
                    <p class="font-montserrat text-white/75 text-[13px] leading-[1.9] mb-5">
                        {{ $mentor['deskripsi'] }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($mentor['keahlian'] as $k)
                        <span class="font-montserrat text-[11px] font-semibold px-3 py-1.5 rounded-full
                                     bg-[#033E8a] text-white border border-[#4b9fe1]/40">
                            {{ $k }}
                        </span>
                        @endforeach
                    </div>
                </div>

            </div>

            @else
            {{-- Layout: Teks Kiri, Foto Kanan --}}
            <div class="flex items-center gap-14">

                {{-- Teks --}}
                <div class="flex-1">
                    <h3 class="font-montserrat font-bold text-white text-[22px] mb-1">
                        {{ $mentor['nama'] }}
                    </h3>
                    <p class="font-montserrat text-[#4b9fe1] text-[13px] font-semibold mb-4">
                        {{ $mentor['role'] }}
                    </p>
                    <p class="font-montserrat text-white/75 text-[13px] leading-[1.9] mb-5">
                        {{ $mentor['deskripsi'] }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($mentor['keahlian'] as $k)
                        <span class="font-montserrat text-[11px] font-semibold px-3 py-1.5 rounded-full
                                     bg-[#033E8a] text-white border border-[#4b9fe1]/40">
                            {{ $k }}
                        </span>
                        @endforeach
                    </div>
                </div>

                {{-- Foto --}}
                <div class="flex-shrink-0 relative">
                    <div class="w-52 h-52 rounded-3xl bg-gradient-to-br {{ $mentor['warna'] }}
                                flex items-center justify-center shadow-2xl relative
                                -rotate-3 hover:rotate-0 transition-transform duration-500">
                        <span class="font-montserrat font-extrabold text-white text-[72px]">
                            {{ $mentor['inisial'] }}
                        </span>
                        <div class="absolute -top-3 -left-3 w-10 h-14 bg-white/20 rounded-lg
                                    flex items-center justify-center text-white text-xs font-bold border border-white/30">
                            A♦
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="font-montserrat font-bold text-white text-[14px]">{{ $mentor['nama'] }}</p>
                        <p class="font-montserrat text-[#4b9fe1] text-[12px]">{{ explode(' & ', $mentor['role'])[0] }}</p>
                    </div>
                </div>

            </div>
            @endif

            @endforeach

        </div>
    </section>

    {{-- ═══════════════════════════════════════
         GALLERY
    ════════════════════════════════════════ --}}
    <section class="bg-white py-16 px-[5%]">
        <div class="max-w-[1200px] mx-auto">

            <div class="text-center mb-10">
                <h2 class="font-montserrat font-bold text-[#033E8a] text-[32px]">
                    Ayo lihat dan coba
                    <span class="text-[#4b9fe1]">langsung!</span>
                </h2>
                <p class="font-montserrat text-gray-500 text-[13px] mt-3 max-w-[420px] mx-auto leading-[1.8]">
                    Lihat bagaimana mentor kami bekerja bersama anak-anak dalam suasana yang
                    hangat, menyenangkan, dan penuh semangat.
                </p>
            </div>

            {{-- Grid Gallery --}}
            <div class="grid grid-cols-4 gap-3">
                @for($i = 1; $i <= 8; $i++)
                <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.08)]
                            {{ $i === 1 || $i === 6 ? 'col-span-2 row-span-1' : '' }} aspect-video">
                    <img src="{{ asset('assets/img/gambar' . $i . '.jpg') }}"
                         alt="Mentor Jejak Kecil"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                @endfor
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════
         CTA AKHIR
    ════════════════════════════════════════ --}}
    <section class="relative bg-[#0D2B6B] overflow-hidden py-20 px-[5%]">

        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border-[24px] border-white/10 pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 right-0 w-5 h-44 bg-red-500 rounded-l-full pointer-events-none"></div>
        <div class="absolute top-1/2 -translate-y-1/2 left-0 w-5 h-44 bg-red-500 rounded-r-full pointer-events-none"></div>

        <div class="relative z-10 max-w-[700px] mx-auto text-center">
            <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-3">
                Bergabung Sekarang
            </p>
            <h2 class="font-montserrat font-extrabold text-white text-[44px] leading-[1.2] mb-5">
                Belajar Bersama Mentor<br>Terbaik Jejak Kecil
            </h2>
            <p class="font-montserrat text-white/70 text-[14px] leading-[1.85] mb-10 max-w-[460px] mx-auto">
                Daftar sekarang dan mulai sesi konsultasi pertama bersama mentor
                pilihan kamu. Setiap anak berhak mendapat bimbingan terbaik.
            </p>
            <div class="flex items-center justify-center gap-4">
                <a href="{{ url('/register') }}"
                   class="inline-block font-montserrat font-semibold text-[#033E8a] text-[15px]
                          bg-white px-8 py-4 rounded-md hover:bg-[#EEF4FF] transition-colors shadow-xl">
                    Mulai Konsultasi
                </a>
                <a href="{{ route('service') }}"
                   class="inline-block font-montserrat font-semibold text-white text-[15px]
                          border-2 border-white/40 px-8 py-4 rounded-md hover:border-white transition-colors">
                    Lihat Layanan
                </a>
            </div>
        </div>
    </section>

</body>

@push('scripts')
<script>
    new Swiper('.mentorSwiper', {
        slidesPerView: 'auto',
        spaceBetween: 0,
        loop: true,
        navigation: {
            nextEl: '.mentor-next',
            prevEl: '.mentor-prev',
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 600,
    });
</script>
@endpush

{{-- FOOTER --}}
@include('layouts.footer')
