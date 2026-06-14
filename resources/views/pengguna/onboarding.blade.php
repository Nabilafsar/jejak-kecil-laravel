@extends('layouts.app')

@section('title', 'Profil Anak')

@section('content')


    <div class="min-h-screen bg-[#e9f0fa] pt-20 pb-10">

        <div class="max-w-4xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-10">

                <h1 class="text-4xl font-bold text-[#033E8A]">
                    Yuk Lengkapi Profil Anak
                </h1>

                <p class="text-gray-500 mt-3">
                    Kami akan menyesuaikan materi belajar sesuai kebutuhan anak
                </p>

            </div>

           
            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-lg p-8">

                <form action="{{ route('onboarding.store') }}" method="POST">

                    @csrf
                    <!-- Nama Anak -->
                    <div class="mb-6">

                        <label class="block font-semibold text-gray-700 mb-2">
                            Nama Anak
                        </label>

                        <input type="text" name="nama_panggilan" placeholder="Masukkan nama anak"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                            required>

                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-8">

                        <label class="block font-semibold text-gray-700 mb-2">
                            Tanggal Lahir
                        </label>

                        <input type="date" name="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                            required>

                    </div>

                    <!-- Level Anak -->
                    <div class="mb-10">

                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            Pilih Level Anak
                        </h2>

                        <div class="grid md:grid-cols-3 gap-5">

                            <label class="cursor-pointer">

                                <input type="radio" name="level_anak" value="1" class="hidden peer" required>

                                <div class="border-2 border-gray-200 rounded-2xl p-5 text-center
                                    peer-checked:border-yellow-500
                                    peer-checked:bg-yellow-50">

                                    <div class="text-4xl mb-2">🌱</div>

                                    <h3 class="font-bold">
                                        Level 1
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Pemula
                                    </p>

                                </div>

                            </label>

                            <label class="cursor-pointer">

                                <input type="radio" name="level_anak" value="2" class="hidden peer">

                                <div class="border-2 border-gray-200 rounded-2xl p-5 text-center
                                    peer-checked:border-yellow-500
                                    peer-checked:bg-yellow-50">

                                    <div class="text-4xl mb-2">🚀</div>

                                    <h3 class="font-bold">
                                        Level 2
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Menengah
                                    </p>

                                </div>

                            </label>

                            <label class="cursor-pointer">

                                <input type="radio" name="level_anak" value="3" class="hidden peer">

                                <div class="border-2 border-gray-200 rounded-2xl p-5 text-center
                                    peer-checked:border-yellow-500
                                    peer-checked:bg-yellow-50">

                                    <div class="text-4xl mb-2">🏆</div>

                                    <h3 class="font-bold">
                                        Level 3
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Mahir
                                    </p>

                                </div>

                            </label>

                        </div>

                    </div>

                    <!-- Gaya Belajar -->
                    <div class="mb-10">

                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            Pilih Gaya Belajar Anak
                        </h2>

                        <div class="grid md:grid-cols-3 gap-5">

                            @foreach($gayaBelajar as $gaya)

                                <label class="cursor-pointer">

                                    <input type="radio" name="id_gaya_belajar" value="{{ $gaya->id }}" class="hidden peer"
                                        required>

                                    <div class="border-2 border-gray-200 rounded-2xl p-5
                                        peer-checked:border-blue-500
                                        peer-checked:bg-blue-50">

                                        @if($gaya->nama_gaya == 'Visual')
                                            <div class="text-4xl mb-3">👀</div>
                                        @elseif($gaya->nama_gaya == 'Auditori')
                                            <div class="text-4xl mb-3">🎧</div>
                                        @else
                                            <div class="text-4xl mb-3">🏃</div>
                                        @endif

                                        <h3 class="font-bold text-lg">
                                            {{ $gaya->nama_gaya }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ $gaya->deskripsi }}
                                        </p>

                                    </div>

                                </label>

                            @endforeach

                        </div>

                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-xl transition">

                        Mulai Belajar 🚀

                    </button>

                </form>

            </div>
            
        </div>
        
    </div>
    

@endsection