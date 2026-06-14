@extends('layouts.app')

@section('title', 'Laporan Belajar - Jejak Kecil')

@section('content')
@include('layouts.headerPengguna')

<div class="bg-white min-h-screen">
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- ── Header ── --}}
        <div class="mb-8">
            <h1 class="font-montserrat font-bold text-[#033E8A] text-3xl">
                Laporan Belajar {{ $anak?->nama_panggilan ?? 'Anak' }}
            </h1>
            <p class="font-montserrat text-gray-500 text-[15px] mt-2 max-w-lg">
                Pantau perkembangan {{ $anak?->nama_panggilan ?? 'anak' }} secara berkala. Semua data disajikan
                dengan cara yang tenang dan mendukung untuk kenyamanan Anda.
            </p>
        </div>

        {{-- ── Baris Atas: Ringkasan + Skor Kuis ── --}}
        <div class="grid lg:grid-cols-2 gap-6 mb-6">

            {{-- Kartu Ringkasan --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

                {{-- Donut Chart Total Belajar --}}
                <div class="flex items-center gap-6 mb-6">
                    <div class="relative w-32 h-32 flex-shrink-0">
                        <svg viewBox="0 0 36 36" class="w-32 h-32 -rotate-90">
                            {{-- Track --}}
                            <circle cx="18" cy="18" r="15.9"
                                    fill="none" stroke="#EEF4FF" stroke-width="3"/>
                            {{-- Progress --}}
                            <circle cx="18" cy="18" r="15.9"
                                    fill="none"
                                    stroke="#033E8A"
                                    stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-dasharray="{{ $totalBelajar }}, 100"
                                    class="transition-all duration-1000"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="font-montserrat font-bold text-[#033E8A] text-2xl">
                                {{ $totalBelajar }}%
                            </span>
                            <span class="font-montserrat text-gray-400 text-[10px]">Selesai</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-montserrat text-gray-400 text-sm mb-3">Total Belajar</p>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-montserrat text-gray-600 text-sm">Total Waktu</span>
                            <span class="font-montserrat font-bold text-[#033E8A] text-sm">
                                {{ $totalWaktu ?: '0 Jam' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span class="font-montserrat text-gray-600 text-sm">Poin Saat Ini</span>
                            <span class="font-montserrat font-bold text-[#033E8A] text-sm">
                                {{ number_format($totalPoin) }} Poin
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Progress bar modul selesai --}}
                <div class="bg-gray-50 rounded-2xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-montserrat text-gray-500 text-sm">Modul Diselesaikan</span>
                        <span class="font-montserrat font-bold text-[#033E8A] text-sm">
                            {{ $modulSelesai }} / {{ $totalModul }}
                        </span>
                    </div>
                    <div class="w-full h-2.5 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-[#033E8A] rounded-full transition-all duration-1000"
                             style="width: {{ $totalModul > 0 ? round($modulSelesai/$totalModul*100) : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Skor Kuis Terakhir --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-montserrat font-bold text-[#033E8A] text-lg">
                        Skor Kuis Terakhir
                    </h2>
                    <div class="flex items-center gap-3 text-xs font-montserrat">
                        <span class="flex items-center gap-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#033E8A] inline-block"></span>
                            Skor {{ $anak?->nama_panggilan ?? 'Anak' }}
                        </span>
                        <span class="flex items-center gap-1 text-gray-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-gray-200 inline-block"></span>
                            Rata-rata
                        </span>
                    </div>
                </div>

                @if($skorPerModul->isEmpty())
                <div class="text-center py-8">
                    <p class="font-montserrat text-gray-400 text-sm">
                        Belum ada kuis yang diselesaikan.
                    </p>
                </div>
                @else
                <div class="flex flex-col gap-3">
                    @foreach($skorPerModul as $item)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-montserrat text-gray-600 text-sm truncate max-w-[60%]">
                                {{ $item['judul'] }}
                            </span>
                            <span class="font-montserrat font-bold text-[#033E8A] text-sm">
                                {{ $item['skor'] }}/100
                            </span>
                        </div>
                        <div class="relative w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            {{-- Bar rata-rata (75 sebagai placeholder) --}}
                            <div class="absolute h-full bg-gray-200 rounded-full"
                                 style="width: 75%"></div>
                            {{-- Bar skor anak --}}
                            <div class="absolute h-full bg-[#033E8A] rounded-full transition-all duration-1000"
                                 style="width: {{ $item['skor'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>

        {{-- ── Baris Bawah: Modul Selesai + Rekomendasi ── --}}
        <div class="grid lg:grid-cols-2 gap-6 mb-8">

            {{-- Modul yang Selesai --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-montserrat font-bold text-[#033E8A] text-lg mb-5">
                    Modul yang Selesai
                </h2>

                @if($modulSudahSelesai->isEmpty())
                <div class="text-center py-8">
                    <div class="text-4xl mb-3">📚</div>
                    <p class="font-montserrat text-gray-400 text-sm">
                        Belum ada modul yang diselesaikan.
                    </p>
                    <a href="{{ route('pengguna.modul.index') }}"
                       class="inline-block mt-3 font-montserrat text-sm font-semibold
                              text-[#033E8A] hover:underline">
                        Mulai belajar →
                    </a>
                </div>
                @else
                <div class="grid grid-cols-2 gap-3">
                    @foreach($modulSudahSelesai as $m)
                    @php
                        $ikonKategori = [
                            'Sains'      => ['icon' => '🌿', 'bg' => 'bg-[#E6FBF9]', 'text' => 'text-[#0AADA8]'],
                            'Matematika' => ['icon' => '🔢', 'bg' => 'bg-[#FFF8E7]', 'text' => 'text-yellow-500'],
                            'Bahasa'     => ['icon' => '💬', 'bg' => 'bg-[#F0FDF4]',  'text' => 'text-green-500'],
                            'Seni'       => ['icon' => '🎨', 'bg' => 'bg-[#FFF0F3]',  'text' => 'text-pink-400'],
                            'Sosial'     => ['icon' => '🤝', 'bg' => 'bg-[#F3F0FF]',  'text' => 'text-purple-400'],
                        ];
                        $style = $ikonKategori[$m['kategori']] ?? ['icon' => '📖', 'bg' => 'bg-[#EEF4FF]', 'text' => 'text-[#033E8A]'];
                    @endphp
                    <div class="flex items-center gap-3 bg-gray-50 rounded-2xl p-3">
                        <div class="w-9 h-9 rounded-xl {{ $style['bg'] }} flex items-center justify-center text-lg flex-shrink-0">
                            {{ $style['icon'] }}
                        </div>
                        <div class="min-w-0">
                            <p class="font-montserrat font-semibold text-gray-700 text-sm truncate">
                                {{ $m['judul'] }}
                            </p>
                            <p class="font-montserrat text-green-500 text-xs font-medium">Lulus</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Rekomendasi Belajar --}}
            <div class="bg-[#033E8A] rounded-3xl p-6 flex flex-col justify-between relative overflow-hidden">

                {{-- Dekorasi background --}}
                <div class="absolute -bottom-8 -right-8 w-36 h-36 rounded-full bg-white/5"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 rounded-full bg-white/5"></div>

                <div class="relative z-10">
                    <h2 class="font-montserrat font-bold text-white text-lg mb-2">
                        Rekomendasi Belajar
                    </h2>
                    <p class="font-montserrat text-blue-200 text-sm leading-relaxed mb-5">
                        Berdasarkan perkembangan {{ $anak?->nama_panggilan ?? 'anak' }}, berikut adalah
                        langkah selanjutnya yang kami sarankan:
                    </p>

                    @if($rekomendasiModul)
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 mb-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#0AADA8] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-montserrat font-bold text-white text-sm">
                                    {{ $rekomendasiModul->judul_modul }}
                                </p>
                                <p class="font-montserrat text-blue-200 text-xs mt-1 leading-relaxed line-clamp-2">
                                    {{ $rekomendasiModul->deskripsi ?? 'Lanjutkan perjalanan belajar ke tingkat berikutnya.' }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('pengguna.modul.show', $rekomendasiModul->id) }}"
                           class="mt-4 flex items-center justify-center gap-2 bg-[#0AADA8] hover:bg-[#089490]
                                  text-white font-montserrat font-semibold text-sm py-2.5 rounded-xl
                                  transition-all duration-300">
                            Mulai Sekarang →
                        </a>
                    </div>
                    @else
                    <div class="bg-white/10 rounded-2xl p-4 mb-4 text-center">
                        <p class="font-montserrat text-blue-200 text-sm">
                            🎉 Semua modul sudah diselesaikan!
                        </p>
                    </div>
                    @endif

                    {{-- Tips --}}
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-yellow-300 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <p class="font-montserrat text-blue-200 text-xs leading-relaxed italic">
                            "Istirahat 5 menit setiap 20 menit belajar membantu
                            {{ $anak?->nama_panggilan ?? 'anak' }} tetap fokus."
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Banner Hubungi Terapis ── --}}
        <div class="bg-gray-50 rounded-3xl p-6 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#EEF4FF] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-montserrat font-semibold text-gray-700 text-sm">
                        Butuh bantuan interpretasi data?
                    </p>
                    <p class="font-montserrat text-gray-400 text-sm">
                        Para ahli kami siap membantu Anda memahami profil belajar {{ $anak?->nama_panggilan ?? 'anak' }}.
                    </p>
                </div>
            </div>
            <a href="{{ route('pengguna.konsultasi.index') }}"
               class="flex-shrink-0 font-montserrat font-semibold text-sm text-[#033E8A]
                      border-2 border-[#033E8A] px-6 py-3 rounded-full hover:bg-[#033E8A]
                      hover:text-white transition-all duration-300 whitespace-nowrap">
                Hubungi Terapis
            </a>
        </div>

    </div>
</div>

@include('layouts.footer')

@push('scripts')
<script>
    // Animasi donut chart masuk saat halaman load
    document.addEventListener('DOMContentLoaded', function () {
        const circle = document.querySelector('circle[stroke="#033E8A"]');
        if (circle) {
            const val = circle.getAttribute('stroke-dasharray').split(',')[0];
            circle.setAttribute('stroke-dasharray', '0, 100');
            setTimeout(() => {
                circle.setAttribute('stroke-dasharray', val + ', 100');
            }, 200);
        }
    });
</script>
@endpush

@endsection