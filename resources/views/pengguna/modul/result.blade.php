@extends('layouts.app')

@section('title', 'Hasil Kuis - Jejak Kecil')

@section('content')
<div class="min-h-screen bg-[#F7F9FC] flex flex-col">

    {{-- Navbar --}}
    @include('layouts.headerPengguna')

    {{-- Konten --}}
    <main class="flex-1 flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-lg">

            {{-- Card Hasil --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden relative">

                {{-- Background dekorasi --}}
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-[#EEF4FF] opacity-60"></div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 rounded-full bg-[#E6FBF9] opacity-60"></div>
                </div>

                <div class="relative z-10 p-8 text-center">

                    {{-- Ikon Trofi --}}
                    <div class="relative inline-block mb-6">
                        <div class="w-28 h-28 rounded-full bg-[#0AADA8] flex items-center justify-center mx-auto
                                    shadow-xl animate-bounce-slow">
                            <svg class="w-14 h-14 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        {{-- Bintang dekorasi --}}
                        <span class="absolute -top-2 -right-2 text-yellow-400 text-xl animate-spin-slow">✦</span>
                        <span class="absolute -bottom-1 -left-3 text-yellow-300 text-lg">✦</span>
                    </div>

                    {{-- Judul --}}
                    <h1 class="font-montserrat font-bold text-gray-800 text-2xl mb-2">
                        Selamat! Kamu Hebat! 🎉
                    </h1>
                    <p class="font-montserrat text-gray-500 text-sm mb-8">
                        Kamu telah menyelesaikan kuis ini dengan sangat baik.
                        Ayo lihat pencapaianmu hari ini!
                    </p>

                    {{-- Statistik --}}
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        {{-- Total Poin --}}
                        <div class="bg-[#F0FDF4] rounded-2xl p-5">
                            <p class="font-montserrat text-gray-500 text-xs mb-1 uppercase tracking-wide">
                                Total Poin
                            </p>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-yellow-500 text-lg">🪙</span>
                                <span class="font-montserrat font-bold text-[#033E8A] text-3xl">
                                    {{ number_format($hasilKuis['total_poin']) }}
                                </span>
                            </div>
                        </div>

                        {{-- Akurasi --}}
                        <div class="bg-[#EEF4FF] rounded-2xl p-5">
                            <p class="font-montserrat text-gray-500 text-xs mb-1 uppercase tracking-wide">
                                Akurasi
                            </p>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-green-500 text-lg">✅</span>
                                <span class="font-montserrat font-bold text-[#033E8A] text-3xl">
                                    {{ $hasilKuis['akurasi'] }}%
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Pesan Motivasi --}}
                    <div class="bg-gray-50 rounded-2xl p-4 mb-8 text-left">
                        <div class="flex items-start gap-3">
                            <span class="text-xl">📈</span>
                            <div>
                                <p class="font-montserrat font-semibold text-gray-700 text-sm">
                                    Langkah Kecil yang Berarti
                                </p>
                                <p class="font-montserrat text-gray-500 text-xs mt-1 leading-relaxed">
                                    @if($hasilKuis['akurasi'] >= 80)
                                        Kamu menjawab {{ $hasilKuis['benar'] }} dari {{ $hasilKuis['total'] }} soal dengan benar.
                                        Teruslah belajar untuk membuka lencana baru!
                                    @elseif($hasilKuis['akurasi'] >= 50)
                                        Kamu sudah hebat! Coba lagi untuk meningkatkan skormu.
                                        Kamu pasti bisa lebih baik!
                                    @else
                                        Jangan menyerah! Setiap percobaan membuatmu lebih pintar.
                                        Yuk coba lagi! 💪
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-center gap-3">
                        <a href="{{ route('pengguna.modul.index') }}"
                           class="inline-flex items-center gap-2 bg-[#033E8A] hover:bg-[#022F67] text-white
                                  font-montserrat font-semibold text-sm px-6 py-3 rounded-full transition-all">
                            Belajar Modul Lain →
                        </a>
                        <a href="{{ route('pengguna.modul.quiz', $modul->id) }}"
                           class="inline-flex items-center gap-2 bg-[#EEF4FF] hover:bg-[#dde8ff] text-[#033E8A]
                                  font-montserrat font-semibold text-sm px-6 py-3 rounded-full transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Ulangi Kuis
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </main>

    @include('layouts.footer')

</div>

@push('scripts')
<script>
    // Confetti sederhana menggunakan animasi CSS
    (function createConfetti() {
        const colors = ['#033E8A', '#0AADA8', '#FFD54A', '#FF7F7F', '#B2F5EA'];
        const container = document.body;

        for (let i = 0; i < 40; i++) {
            const confetti = document.createElement('div');
            confetti.style.cssText = `
                position: fixed;
                width: ${Math.random() * 8 + 5}px;
                height: ${Math.random() * 8 + 5}px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                border-radius: ${Math.random() > 0.5 ? '50%' : '2px'};
                top: -10px;
                left: ${Math.random() * 100}vw;
                animation: fall ${Math.random() * 2 + 2}s ease-in forwards;
                animation-delay: ${Math.random() * 1.5}s;
                opacity: 0.8;
                pointer-events: none;
                z-index: 9999;
            `;
            container.appendChild(confetti);
            setTimeout(() => confetti.remove(), 4000);
        }
    })();
</script>
<style>
    @keyframes fall {
        0%   { transform: translateY(-10px) rotate(0deg); opacity: 0.8; }
        100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }
    .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
    .animate-spin-slow { animation: spin-slow 4s linear infinite; }
</style>
@endpush

@endsection