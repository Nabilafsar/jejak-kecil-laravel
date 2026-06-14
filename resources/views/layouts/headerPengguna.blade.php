<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Vite CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>{{ $title ?? 'Jejak Kecil' }}</title>
</head>

<body class="bg-white overflow-x-hidden">

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-section min-h-screen overflow-hidden relative ">

        <!-- NAVBAR -->
        <nav class="flex items-center bg-[#033E8a] justify-between px-8 py-6 relative z-10">

            <!-- Logo -->
            <div class="flex items-center gap-2 ml-4">
                <img src="{{ asset('assets/img/logo_putih.png') }}" alt="logo" class="w-10 h-10">
                <span class="font-montserrat font-bold text-white text-[17px] italic">
                    Jejak Kecil
                </span>
            </div>

            <!-- Menu -->
            <ul class="flex items-center gap-8 list-none m-0 p-0 mr-4">
                <li>
                    <a href="{{ route('pengguna.DashboardPengguna') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.modul.index') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Modules
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.konsultasi.index') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Consultation
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.report.index') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Report
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.gamifikasi.index') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Gamification
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.profil.index') }}"
                        class="font-montserrat font-medium text-white text-[16px] hover:text-primary transition-colors">
                        Profile
                    </a>
                </li>
            </ul>

        </nav>