@extends('layouts.app')

@section('content')

    @include('layouts.headerPengguna')

    <div class="relative overflow-hidden">


        <!-- HERO -->
        <section class="relative px-12 pt-18 pb-5">

            <h1 class="font-bold text-[#033E8A] text-5xl">
                Welcome Back, {{ Auth::user()->anak?->nama_panggilan ?? 'Anak' }}
            </h1>

            <p class="mt-4 text-gray-500 text-xl max-w-lg">
                Monitor Leo's learning journey and connect with specialized experts
                to tailor his educational experience.
            </p>

        </section>

        <!-- BREAKING NEWS -->
        <section class="px-12 mt-5">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-3xl font-bold text-[#033E8A]">
                    Breaking News
                </h2>

            </div>

            <div class="swiper beritaSwiper rounded-[30px] overflow-hidden shadow-lg">

                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news1.jpg') }}" class="w-full h-78 object-cover">
                    </div>
                    
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news2.jpg') }}" class="w-full h-78 object-cover">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news3.jpg') }}" class="w-full h-78 object-cover">
                    </div>

                </div>

            </div>

        </section>

        <!-- REPORT + GAMIFIKASI -->
        <section class="px-12 grid lg:grid-cols-3 gap-8 mb-20 mt-10">

            <!-- REPORT -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-3xl font-bold text-[#033E8A] ">
                        Laporan Mingguan
                    </h2>

                    <a href="{{ route('pengguna.report.index') }}" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">

                        View All
                    </a>
                </div>
                <div class="bg-white rounded-3xl shadow-xl p-8">

                    <h3 class="text-3xl font-bold text-[#033E8A]">
                        Learning Velocity
                    </h3>

                    <p class="text-gray-500">
                        Weekly Activity Overview
                    </p>

                    <div class="mt-6">
                        <canvas id="weeklyChart"></canvas>
                    </div>

                    <div class="grid grid-cols-3 mt-8 text-center">

                        <div>
                            <p class="text-gray-500">Focus Time</p>
                            <h4 class="font-bold text-3xl text-[#033E8A]">
                                42.5 hrs
                            </h4>
                        </div>

                        <div>
                            <p class="text-gray-500">Modules Done</p>
                            <h4 class="font-bold text-3xl text-[#033E8A]">
                                12
                            </h4>
                        </div>

                        <div>
                            <p class="text-gray-500">Avg Score</p>
                            <h4 class="font-bold text-3xl text-[#033E8A]">
                                94%
                            </h4>
                        </div>

                    </div>

                </div>

            </div>

            <!-- GAMIFIKASI -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-3xl font-bold text-[#033E8A] flex items-center">
                        Gamifikasi
                    </h2>

                    <a href="{{ route('pengguna.gamifikasi.index') }}" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">
                        Buy Now
                    </a>
                </div>
                <div class="bg-[#033E8A] rounded-3xl p-4 shadow-xl">

                    <img src="{{ asset('assets/img/avatar1.png') }}" class="w-60 ml-24">

                </div>

            </div>

        </section>

    </div>

    <!-- EXPERT -->
    <section class="bg-[#033E8A] py-16 px-12 ">



        <div class="flex items-center justify-between mb-5">
            <h2 class="text-white text-4xl font-bold">
                Expert Consultation
            </h2>
            <a href="{{ route('pengguna.konsultasi.index') }}" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">
                Consult Now
            </a>
        </div>

            <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white h-100 rounded-3xl overflow-hidden">
                <div class="p-8 text-center">
                    <img src="{{ asset('assets/img/expert1.jpg') }}" alt="Dr. Jane Smith" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">

                    <h3 class="text-2xl font-bold text-[#033E8A]">
                        Dr. Jane Smith
                    </h3>

                    <p class="text-gray-500 mt-2 text-2sm">
                        Child Psychologist
                    </p>

                    <p class="mt-4 text-gray-700 text-left text-sm">
                        With over 15 years of experience, Dr. Smith specializes in child development and learning strategies. She has helped hundreds of children reach their full potential through personalized consultations and evidence-based approaches.
                    </p>
                    <a href="{{ route('pengguna.konsultasi.index') }}" class="mt-6 inline-block bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A] font-semibold px-6 py-2 rounded-full transition-all duration-300">
                        Consult
                    </a>
                </div>
            </div>
            <div class="bg-white h-100 rounded-3xl overflow-hidden">
                <div class="p-8 text-center">
                    <img src="{{ asset('assets/img/expert2.jpg') }}" alt="Dr. John Doe" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">

                    <h3 class="text-2xl font-bold text-[#033E8A]">
                        Dr. John Doe
                    </h3>

                    <p class="text-gray-500 mt-2 text-2sm">
                        Educational Consultant
                    </p>

                    <p class="mt-4 text-gray-700 text-left text-sm">
                        Dr. Doe is an expert in educational psychology with a focus on learning disabilities and special education. He has a proven track record of helping children with unique learning needs succeed academically and socially.
                    </p>
                    <a href="{{ route('pengguna.konsultasi.index') }}" class="mt-6 inline-block bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A] font-semibold px-6 py-2 rounded-full transition-all duration-300">
                        Consult
                    </a>
                </div>
            </div>

            <div class="bg-white h-100 rounded-3xl overflow-hidden">
                <div class="p-8 text-center">
                    <img src="{{ asset('assets/img/expert3.jpg') }}" alt="Dr. Emily Davis" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">

                    <h3 class="text-2xl font-bold text-[#033E8A]">
                        Dr. Emily Davis
                    </h3>

                    <p class="text-gray-500 mt-2 text-2sm">
                        Learning Specialist
                    </p>

                    <p class="mt-4 text-gray-700 text-left text-sm">
                        Dr. Davis is a learning specialist with expertise in early childhood education and curriculum development. She has worked with schools and families to create engaging learning environments that foster creativity and critical thinking.
                    </p>
                    <a href="{{ route('pengguna.konsultasi.index') }}" class="mt-6 inline-block bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A] font-semibold px-6 py-2 rounded-full transition-all duration-300">
                        Consult
                    </a>
                </div>
            </div>

        </div>

        <!-- MATERI -->

        <div class="mt-16">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-white text-4xl font-bold mb-8">
                    Materi Terbaru
                </h2>

                <a href="{{ route('pengguna.modul.index') }}" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">
                   Views All
                </a>
            </div>
            <div class="grid md:grid-cols-4 gap-8">

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi1.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Mengenal Gaya Belajar</h4>
                        <p class="text-gray-500 text-sm mt-2">Ringkasan singkat materi untuk orang tua.</p>
                    <a href="{{ route('pengguna.modul.index') }}" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 ">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi2.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Strategi Pembelajaran</h4>
                        <p class="text-gray-500 text-sm mt-2">Teknik praktis agar anak lebih fokus.</p>
                    <a href="{{ route('pengguna.modul.index') }}" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi3.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Kegiatan Kreatif</h4>
                        <p class="text-gray-500 text-sm mt-2">Ide permainan edukatif untuk rumah.</p>
                    <a href="{{ route('pengguna.modul.index') }}" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi4.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Membaca Dini</h4>
                        <p class="text-gray-500 text-sm mt-2">Langkah-langkah sederhana mengajari membaca.</p>
                    <a href="{{ route('pengguna.modul.index') }}" class="mt-4 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi5.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Aktivitas Sensorik</h4>
                        <p class="text-gray-500 text-sm mt-2">Stimulasi sensorik untuk perkembangan motorik.</p>
                    <a href="{{ route('pengguna.modul.index') }}" class="mt-4 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi6.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Matematika Dasar</h4>
                        <p class="text-gray-500 text-sm mt-2">Permainan angka yang menyenangkan.</p>
                    <a href="" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi7.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Keterampilan Sosial</h4>
                        <p class="text-gray-500 text-sm mt-2">Membangun empati dan kerjasama.</p>
                    <a href="" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

                <div class="bg-white h-80 rounded-3xl overflow-hidden">
                    <img src="{{ asset('assets/img/materi8.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold text-[#033E8A]">Eksperimen Sains</h4>
                        <p class="text-gray-500 text-sm mt-2">Percobaan sederhana untuk anak-anak.</p>
                    <a href="" class="mt-8 inline-block bg-[#033E8A] hover:bg-[#022F67] text-white font-semibold px-5 py-2 rounded-full transition-all duration-300">
                        Lihat
                    </a>
                    </div>
                </div>

            </div>

        </div>

    </section>

    @push('scripts')
        <script>

            new Swiper('.beritaSwiper', {

                loop: true,

                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },

                speed: 1000,

            });

        </script>
    @endpush

    @include('layouts.footer')

@endsection