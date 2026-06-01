{{-- resources/views/about.blade.php --}}



@include('layouts.header')

<body class="bg-white overflow-x-hidden">

    <!-- ===== HERO SECTION ===== -->
    <div class="flex items-center pb-0 relative">

            <!-- Left: Text Content -->
            <div class="flex-1 max-w-[1200px] pl-[100px] relative">
                <div class="relative -top-4 z-20">
                    <h1 class="font-montserrat font-extrabold text-[#033E8a] text-[50px] leading-[1.2] mb-4">
                        Belajar Perlahan, Tumbuh Bersama, Dalam Setiap Jejak Kecil.
                    </h1>
                    <p class="font-montserrat text-gray-500 text-[14px] leading-[1.8] mb-6 max-w-[380px]">
                        Jejak Kecil adalah platform pembelajaran akademik yang dirancang khusus untuk membantu anak
                        berkebutuhan khusus belajar dengan metode yang lebih ramah dan terstruktur.
                    </p>
                    <a href="/public/register.html"
                        class="inline-block font-montserrat font-semibold text-white text-[14px] bg-[#033E8a] px-7 py-3 rounded-md hover:bg-primary-dark transition-colors shadow-lg">
                        Get Started
                    </a>
                </div>

                <img src="{{ asset('assets/img/buletan biru.png') }}" alt="logo"
                    class="absolute -bottom-80 left-4 w-[650px] h-[650px] z-0 -translate-x-1/4 translate-y-1/4">
            </div>

            <!-- Right: Image -->
            <div class="flex-1 relative flex justify-end pt-20">
                <img src="{{ asset('assets/img/buletan biru.png') }}" alt="Blue Circle"
                    class="absolute -top-5 -right-[50px] w-[600px] z-0">
                <img src="{{ asset('assets/img/gambaranak.png') }}" alt="Character Image" class="w-[550px] relative z-10 -top-6">
            </div>

        </div>
        
        <div class="max-w-[1200px] mx-auto px-[60px] py-20 flex items-center gap-16">
    
            <!-- LEFT: stacked photos -->
            <div class="flex-1 relative min-h-[420px] shrink-0">
                <div
                    class="absolute top-0 left-0 w-[55%] rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(3,62,138,.15)] z-10">
                    <img src="{{ asset('assets/img/gambar1.jpg') }}"
                        alt="children learning" class="w-full h-[320px] object-cover">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-[58%] rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(3,62,138,.15)] z-20">
                    <img src="{{ asset('assets/img/gambar2.jpg') }}"
                        alt="kids in classroom" class="w-full h-[340px] object-cover">
                </div>
                <div class="absolute -bottom-4 -left-4 w-24 h-24 z-0"
                    style="background-image:radial-gradient(#033E8a22 1.5px, transparent 1.5px);background-size:10px 10px;">
                </div>
            </div>
    
            <!-- RIGHT: text content -->
            <div class="flex-1">
                <p class="font-montserrat font-semibold text-[#4b9fe1] text-[12px] tracking-[2px] uppercase mb-2">
                    Get to Know About Us
                </p>
                <h2 class="font-montserrat font-extrabold text-[#033E8a] text-[38px] leading-[1.2] mb-4">
                    Apa Itu Jejak Kecil?
                </h2>
                <p class="font-montserrat text-gray-500 text-[14px] leading-[1.85] mb-8 max-w-[400px]">
                    Jejak Kecil Dapat Membantu Memecahkan Masalah yang dialami anak dan orang tua dengan Solusi yang
                    kami berikan.
                </p>
                <ul class="list-none space-y-4 p-0 m-0">
                    <li class="flex items-start gap-3">
                        <span class="mt-[2px] text-[#033E8a] text-[18px] leading-none">✦</span>
                        <p class="font-montserrat font-semibold text-gray-800 text-[15px] m-0">Materi akademik yang
                            disesuaikan</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-[2px] text-[#033E8a] text-[18px] leading-none">✦</span>
                        <p class="font-montserrat font-semibold text-gray-800 text-[15px] m-0">Mentor berpengalaman</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-[2px] text-[#033E8a] text-[18px] leading-none">✦</span>
                        <p class="font-montserrat font-semibold text-gray-800 text-[15px] m-0">Metode belajar ramah dan
                            mengikuti gaya anak</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-[2px] text-[#033E8a] text-[18px] leading-none">✦</span>
                        <p class="font-montserrat font-semibold text-gray-800 text-[15px] m-0">Platform mudah digunakan
                        </p>
                    </li>
                </ul>
            </div>
    
        </div>
    </section><!-- ✅ TUTUP hero-section di sini -->


    <!-- ===== ABOUT SECTION ===== --> <!-- ✅ About sekarang DILUAR hero -->
    



    <section class="relative bg-[#0D2B6B] overflow-hidden pt-28 pb-20 px-[5%]">


        <!-- Dekorasi lingkaran -->
        <div
            class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border-[24px] border-white/10 pointer-events-none">
        </div>
        <div
            class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none">
        </div>
        <!-- Aksen strip merah -->
        <div class="absolute top-1/2 -translate-y-1/2 right-0 w-5 h-44 bg-red-500 rounded-l-full pointer-events-none">
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 left-0 w-5 h-44 bg-red-500 rounded-r-full pointer-events-none">
        </div>

        <div class="relative z-10 max-w-[1400px] mx-auto flex flex-col items-center text-center gap-2 mt-8 ">
            <!-- Heading -->
            <h2 class="relative z-10 text-center font-extrabold text-white
           text-[60px] leading-[1.3] mb-0 mx-auto mt-12">
                Jejak Kecil Sudah Tersedia di<br />Mobile Apps dan Dekstop
            </h2>

            <!-- Device mockups -->
            <div class="z-10 flex items-end justify-center mx-auto">
                <img src="{{ asset('assets/img/dekstopmobile.png') }}" alt="App Mockup"
                    class="w-[1300px] h-auto pl-[100px] -top-[40px] relative">
            </div>
            </divclas>


    </section>


    <!-- ═══════════════════════════════════════
         GALLERY SECTION
    ════════════════════════════════════════ -->
    <section id="gallery" class="bg-[#0D2B6B] px-[5%] pt-6 pb-20">

        <div class="max-w-[1000px] mx-auto grid grid-cols-3 gap-3 ]">

            <!-- Row 1 -->
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar1.jpg') }}" alt="kids learning"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar2.jpg') }}" alt="classroom"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar3.jpg') }}" alt="study"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Row 2 -->
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar4.jpg') }}" alt="children"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar5.jpg') }}" alt="reading"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar6.jpg') }}" alt="learning"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Row 3 -->
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar7.jpg') }}" alt="art class"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar8.jpg') }}" alt="group study"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.3)] aspect-4/3">
                <img src="{{ asset('assets/img/gambar9.jpg') }}" alt="kids reading"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>

        </div>
    </section>

    <section class="relative bg-[#0D2B6B] overflow-hidden pt-20 pb-24 px-[5%]">

        <!-- Dekorasi lingkaran kiri -->
        <div
            class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full border-[28px] border-white/10 pointer-events-none">
        </div>
        <div class="absolute top-10 -left-16 w-48 h-48 rounded-full border-20 border-white/10 pointer-events-none">
        </div>

        <!-- Dekorasi lingkaran kanan -->
        <div
            class="absolute -top-24 -right-24 w-80 h-80 rounded-full border-[30px] border-white/10 pointer-events-none">
        </div>
        <div
            class="absolute bottom-10 -right-16 w-56 h-56 rounded-full border-[22px] border-white/10 pointer-events-none">
        </div>

        <!-- Aksen strip merah -->
        <div class="absolute top-1/2 -translate-y-1/2 right-0 w-5 h-44 bg-red-500 rounded-l-full pointer-events-none">
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 left-0 w-5 h-44 bg-red-500 rounded-r-full pointer-events-none">
        </div>

        <div class="relative z-10 max-w-[1200px] mx-auto">

            <!-- Heading -->
            <h2 class="font-montserrat font-extrabold text-white text-[48px] text-center leading-[1.2] mb-14">
                Ulasan Pengguna
            </h2>

            <!-- ── Animated 3-Column Testimonials ── -->
            <div class="testimonials-columns">

                <!-- ── Kolom 1 — Scroll Down ── -->
                <div class="testimonial-column column-down">

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Aplikasi Jejak Kecil sangat
                            membantu anak belajar dengan cara yang lebih sederhana dan menyenangkan"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Materi pembelajaran disusun
                            dengan jelas sehingga anak lebih mudah memahami setiap pelajaran"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Belajar menjadi lebih
                            menarik karena materi disajikan dengan cara yang interaktif"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Platform ini sangat mudah
                            digunakan, bahkan anak-anak bisa langsung memahami cara kerjanya"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Sebagai orang tua, saya
                            sangat terbantu dengan fitur pemantauan progres belajar anak"</p>
                    </div>

                    <!-- Duplikat untuk loop seamless -->
                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Aplikasi Jejak Kecil sangat
                            membantu anak belajar dengan cara yang lebih sederhana dan menyenangkan"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Materi pembelajaran disusun
                            dengan jelas sehingga anak lebih mudah memahami setiap pelajaran"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Belajar menjadi lebih
                            menarik karena materi disajikan dengan cara yang interaktif"</p>
                    </div>

                </div>

                <!-- ── Kolom 2 — Scroll Up ── -->
                <div class="testimonial-column column-up">

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Tampilan aplikasinya ramah
                            anak dan membuat proses belajar terasa lebih nyaman"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Jejak Kecil memberikan
                            pengalaman belajar yang lebih inklusif bagi setiap anak"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Jejak Kecil menjadi solusi
                            pembelajaran yang baik untuk anak berkebutuhan khusus"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Metode belajarnya sangat
                            ramah dan mengikuti gaya belajar anak, luar biasa!"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Materi yang tersedia sangat
                            membantu meningkatkan pemahaman anak dalam belajar"</p>
                    </div>

                    <!-- Duplikat untuk loop seamless -->
                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Tampilan aplikasinya ramah
                            anak dan membuat proses belajar terasa lebih nyaman"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Jejak Kecil memberikan
                            pengalaman belajar yang lebih inklusif bagi setiap anak"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Jejak Kecil menjadi solusi
                            pembelajaran yang baik untuk anak berkebutuhan khusus"</p>
                    </div>

                </div>

                <!-- ── Kolom 3 — Scroll Down ── -->
                <div class="testimonial-column column-down">

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Fitur-fitur dalam aplikasi
                            ini membantu anak belajar secara bertahap dan terarah"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Dengan Jejak Kecil, proses
                            belajar anak menjadi lebih terstruktur dan menyenangkan"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Aplikasi ini membantu orang
                            tua mendampingi anak belajar di rumah dengan lebih mudah"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Mentor di Jejak Kecil sangat
                            berpengalaman dan sabar dalam membimbing anak-anak"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Anak saya semakin percaya
                            diri dalam belajar sejak menggunakan Jejak Kecil"</p>
                    </div>

                    <!-- Duplikat untuk loop seamless -->
                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Fitur-fitur dalam aplikasi
                            ini membantu anak belajar secara bertahap dan terarah"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-[#033E8a] text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-gray-600 text-[12px] leading-[1.7]">"Dengan Jejak Kecil, proses
                            belajar anak menjadi lebih terstruktur dan menyenangkan"</p>
                    </div>

                    <div class="bg-[#033E8a] rounded-2xl p-5 shadow-lg flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4b9fe1] flex items-center justify-center shrink-0">
                                <span class="text-white font-bold text-[11px]">N</span></div>
                            <span class="font-montserrat font-semibold text-white text-[12px]">Nabil_afsar</span>
                        </div>
                        <p class="font-montserrat text-white/90 text-[12px] leading-[1.7]">"Aplikasi ini membantu orang
                            tua mendampingi anak belajar di rumah dengan lebih mudah"</p>
                    </div>

                </div>

            </div>
            <!-- ── /Animated Testimonials ── -->

        </div>
    </section>

</body>

<style>
    /* ── Animated Testimonial Columns ── */
    .testimonials-columns {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        max-height: 580px;
        overflow: hidden;
        /* fade top & bottom */
        -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 12%, black 88%, transparent 100%);
        mask-image: linear-gradient(to bottom, transparent 0%, black 12%, black 88%, transparent 100%);
    }

    .testimonial-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }

    .column-down {
        animation: scrollDown 28s linear infinite;
    }

    .column-up {
        animation: scrollUp 28s linear infinite;
    }

    .column-down:hover,
    .column-up:hover {
        animation-play-state: paused;
    }

    @keyframes scrollDown {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-50%);
        }
    }

    @keyframes scrollUp {
        0% {
            transform: translateY(-50%);
        }

        100% {
            transform: translateY(0);
        }
    }

    @media (max-width: 968px) {
        .testimonials-columns {
            grid-template-columns: repeat(2, 1fr);
        }

        .testimonial-column:last-child {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .testimonials-columns {
            grid-template-columns: 1fr;
            max-height: 420px;
        }

        .testimonial-column:nth-child(2) {
            display: none;
        }
    }
</style>

    {{-- FOOTER --}}
    @include('layouts.footer')