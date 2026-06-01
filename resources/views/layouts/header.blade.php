<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
      

    <title>{{ $title ?? 'Jejak Kecil' }}</title>
</head>

<body class="bg-white overflow-x-hidden">

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-section min-h-screen overflow-hidden relative">

        <!-- NAVBAR -->
        <nav class="flex items-center justify-between px-8 py-6 relative z-10">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="w-10 h-10">

                <span class="font-montserrat font-bold text-[#033E8a] text-[17px] italic">
                    Jejak Kecil
                </span>
            </div>

            <!-- Menu -->
            <ul class="flex items-center gap-8 list-none m-0 p-0">

                <li>
                    <a href="#"
                        class="font-montserrat font-medium text-gray-700 text-[16px] hover:text-primary transition-colors">
                        About
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="font-montserrat font-medium text-gray-700 text-[16px] hover:text-primary transition-colors">
                        Service
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="font-montserrat font-medium text-gray-700 text-[16px] hover:text-primary transition-colors">
                        Our Mentor
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="font-montserrat font-medium text-gray-700 text-[16px] hover:text-primary transition-colors">
                        Contact
                    </a>
                </li>

                <li>
                    <a href="{{ url('/login') }}"
                        class="font-montserrat font-medium text-gray-700 text-[16px] hover:text-primary transition-colors">
                        Login
                    </a>
                </li>

                <li>
                    <a href="/register"
                        class="font-montserrat font-semibold text-white text-[14px] bg-[#033E8a] px-5 py-2 rounded-full hover:bg-primary-dark transition-colors shadow-md">
                        Sign up
                    </a>
                </li>

            </ul>

        </nav>