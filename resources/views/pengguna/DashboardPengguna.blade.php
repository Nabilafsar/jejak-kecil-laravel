@extends('layouts.app')

@section('content')

    @include('layouts.header')

    <div class="relative overflow-hidden">


        <!-- HERO -->
        <section class="relative px-12 pt-18 pb-5">

            <h1 class="font-bold text-[#033E8A] text-5xl">
                Welcome Back, {{ Auth::user()->nama }}
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

                <a href="/news" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">

                    View All
                </a>

            </div>

            <div class="swiper beritaSwiper rounded-[30px] overflow-hidden shadow-lg">

                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news1.jpg') }}" class="w-full h-[315px] object-cover">
                    </div>
                    
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news2.jpg') }}" class="w-full h-[315px] object-cover">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/news3.jpg') }}" class="w-full h-[315px] object-cover">
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

                    <a href="/news" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
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

                    <a href="/news" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
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
            <a href="/news" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">
                Consult Now
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="bg-white h-[280px] rounded-3xl"></div>
            <div class="bg-white h-[280px] rounded-3xl"></div>

        </div>

        <!-- MATERI -->

        <div class="mt-16">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-white text-4xl font-bold mb-8">
                    Materi Terbaru
                </h2>

                <a href="/news" class="bg-[#FFD54A] hover:bg-[#F4C542] text-[#033E8A]
                            font-semibold px-5 py-2 rounded-full
                            shadow-md transition-all duration-300">
                   Views All
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white h-[300px] rounded-3xl"></div>
                <div class="bg-white h-[300px] rounded-3xl"></div>
                <div class="bg-white h-[300px] rounded-3xl"></div>
                <div class="bg-white h-[300px] rounded-3xl"></div>
                <div class="bg-white h-[300px] rounded-3xl"></div>
                <div class="bg-white h-[300px] rounded-3xl"></div>

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