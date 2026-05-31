@extends('layouts.app')

@section('content')

    <body class="bg-gray-200 flex justify-center items-center pt-14 overflow-hidden">

        <form action="{{ route('register.store') }}" method="POST"
            class="bg-white w-[800px] h-[600px] rounded-[40px] flex shadow-lg animate-[fadeSlide_1s_ease]">

            @csrf

            <!-- LEFT CONTENT -->
            <div class="pt-12 pl-8">

                <img src="{{ asset('assets/img/Asterisk 3.jpg') }}" class="w-[30px] mb-2">

                <h2 class="text-[36px] text-[#033E8a] font-bold mb-1 font-montserrat">
                    Create an account
                </h2>

                <h4 class="text-[#033E8a] text-[12px] font-light mb-3 font-montserrat">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </h4>

                <!-- USERNAME -->
                <div class="mb-2">
                    <h5 class="text-[#033E8a] text-sm font-montserrat font-bold">
                        Username
                    </h5>

                    <input type="text" name="nama" placeholder="Enter your username" value="{{ old('nama') }}"
                        class="w-[330px] p-2 mt-1 border border-gray-300 rounded font-montserrat text-[12px]">

                    @error('nama')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div class="mb-2">
                    <h5 class="text-[#033E8a] text-sm font-montserrat font-bold">
                        Email
                    </h5>

                    <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                        class="w-[330px] p-2 mt-1 border border-gray-300 rounded font-montserrat text-[12px]">

                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="mb-2">
                    <h5 class="text-[#033E8a] text-sm font-montserrat font-bold">
                        Password
                    </h5>

                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-[330px] p-2 mt-1 border border-gray-300 rounded font-montserrat text-[12px]">

                    @error('password')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-[330px] p-2 mt-1 rounded-[20px] bg-[#033E8a] text-white cursor-pointer font-montserrat hover:bg-[#022e5a] text-[14px]">
                    Register
                </button>

                <!-- SOCIAL LOGIN -->
                <div class="mt-4">

                    <p class="text-center text-[12px] mb-3 text-gray-500 font-montserrat">
                        Or Create with
                    </p>

                    <button type="button"
                        class="w-[330px] p-2 mb-2 rounded-[20px] border flex items-center justify-center gap-2 text-[#033E8a] hover:bg-gray-100 font-montserrat text-[12px]">

                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
                            class="w-5 h-5">

                        Continue with Google
                    </button>

                    <button type="button"
                        class="w-[330px] p-2 rounded-[20px] border flex items-center justify-center gap-2 text-[#033E8a] hover:bg-indigo-50 font-montserrat text-[12px]">

                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg"
                            class="w-5 h-5">

                        Continue with Facebook
                    </button>

                    <div class="flex justify-center gap-1 text-[12px] mt-4 text-gray-600">

                        <span class="font-montserrat">
                            Apakah kamu Sudah Punya Akun?
                        </span>

                        <a href="{{ route('login') }}" class="text-[#033E8a] font-semibold hover:underline font-montserrat">
                            Login
                        </a>

                    </div>

                </div>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="flex items-start pl-7 pt-2">

                <div class="relative w-[380px]">

                    <img src="{{ asset('assets/img/bintang.png') }}" class="w-[48px] absolute top-[40px] left-[36px] z-10">

                    <img src="{{ asset('assets/img/imgloginregister.jpg') }}"
                        class="w-[392px] rounded-[44px] pt-[10px] pl-[10px]">

                    <h4 class="absolute bottom-[120px] left-[36px] text-white/70 text-[16px] font-montserrat">
                        Together We Trust
                    </h4>

                    <h2 class="absolute bottom-[30px] left-[36px] text-white text-[20px] font-montserrat font-bold">
                        Belajar perlahan, tumbuh bersama, dalam setiap jejak kecil.
                    </h2>

                </div>

            </div>

        </form>

        <style>
            @keyframes fadeSlide {
                from {
                    opacity: 0;
                    transform: translateY(80px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>

    </body>

@endsection