@extends('layouts.app')

@section('title', 'Kuis - ' . $modul->judul_modul . ' - Jejak Kecil')

@section('content')
    <div class="min-h-screen bg-[#F7F9FC] flex flex-col">

        {{-- Header Kuis (tanpa navbar utama, lebih fokus) --}}
        <header class="bg-white border-b border-gray-100">
            <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">

                {{-- Kiri: Kembali --}}
                <a href="{{ route('pengguna.modul.show', $modul->id) }}"
                    class="inline-flex items-center gap-1.5 font-montserrat text-sm text-gray-500 hover:text-[#033E8A] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Modul
                </a>

                {{-- Tengah: Logo --}}
                <a href="{{ route('pengguna.DashboardPengguna') }}"
                    class="font-montserrat font-bold text-[#033E8A] text-[16px]">
                    Jejak Kecil
                </a>

                {{-- Kanan: Progress Kuis --}}
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="font-montserrat text-gray-400 text-[10px]">Kemajuan Kuis</p>
                        <p class="font-montserrat font-bold text-[#033E8A] text-sm" id="progressLabel">
                            Pertanyaan 1/{{ $total }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-[#EEF4FF] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#0AADA8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>

            </div>

            {{-- Progress Bar Tipis --}}
            <div class="h-1.5 bg-gray-100">
                <div id="headerProgress"
                    class="h-full bg-gradient-to-r from-[#033E8A] to-[#0AADA8] rounded-full transition-all duration-500"
                    style="width: {{ round(1 / $total * 100) }}%">
                </div>
            </div>
        </header>

        {{-- Konten Kuis --}}
        <main class="flex-1 max-w-4xl mx-auto w-full px-6 py-10 mt-12">

            <form action="{{ route('pengguna.modul.quiz.submit', $modul->id) }}" method="POST" id="quizForm">
                @csrf

                @foreach($soalList as $index => $soal)
                    <div class="soal-item {{ $index === 0 ? 'block' : 'hidden' }}" data-index="{{ $index }}"
                        data-total="{{ $total }}">

                        {{-- Card Soal --}}
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                            {{-- Gambar Soal (jika ada) --}}
                            @if($soal->gambar_pertanyaan)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $soal->gambar_pertanyaan) }}" alt="Gambar Soal"
                                        class="w-full max-h-64 object-cover">
                                </div>
                            @endif

                            <div class="p-8">
                                {{-- Label + Nomor --}}
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="inline-flex items-center gap-1.5 bg-[#EEF4FF] text-[#033E8A]
                                                 font-montserrat text-xs font-semibold px-3 py-1.5 rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                                        </svg>
                                        Pertanyaan {{ $index + 1 }}
                                    </span>
                                </div>

                                {{-- Pertanyaan --}}
                                <h2 class="font-montserrat font-bold text-gray-800 text-xl leading-snug mb-2">
                                    {{ $soal->pertanyaan }}
                                </h2>
                                @if(!$soal->gambar_pertanyaan)
                                    <p class="font-montserrat text-gray-400 text-sm mb-8">
                                        Ketuk pada jawaban yang benar di bawah ini.
                                    </p>
                                @else
                                    <div class="mb-6"></div>
                                @endif

                                {{-- Pilihan Jawaban --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($soal->pilihan as $key => $pilihan)
                                        @if($pilihan)
                                                            <label class="cursor-pointer group">
                                                                <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ $key }}"
                                                                    class="sr-only peer">
                                                                <div class="flex items-center gap-4 border-2 border-gray-100 rounded-2xl p-4
                                                                            peer-checked:border-[#033E8A] peer-checked:bg-[#EEF4FF]
                                                                            group-hover:border-gray-300 transition-all duration-200">
                                                                    {{-- Label Huruf --}}
                                                                    <div class="w-9 h-9 rounded-xl bg-gray-100 peer-checked:bg-[#033E8A]
                                            flex items-center justify-center flex-shrink-0
                                            font-montserrat font-bold text-gray-500 peer-checked:text-white text-sm
                                            transition-colors">
                                                                        {{ strtoupper($key) }}
                                                                    </div>
                                                                    <span class="font-montserrat text-gray-700 text-base font-medium">
                                                                        {{ $pilihan }}
                                                                    </span>
                                                                    {{-- Checkmark --}}
                                                                    <div class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                                                        <svg class="w-5 h-5 text-[#033E8A]" fill="currentColor" viewBox="0 0 24 24">
                                                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </label>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        {{-- Navigasi Bawah --}}
                        <div class="flex items-center justify-between mt-6">
                            <button type="button" onclick="prevSoal({{ $index }})" class="inline-flex items-center gap-2 font-montserrat text-sm text-gray-500
                                           hover:text-[#033E8A] transition-colors {{ $index === 0 ? 'invisible' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>

                            <div class="flex items-center gap-3 mb-29">
                                <button type="button" onclick="saveLater()" class="font-montserrat text-sm font-medium px-5 py-2.5 rounded-full border border-gray-200
                                               text-gray-500 hover:bg-gray-50 transition-colors">
                                    Simpan & Nanti
                                </button>

                                @if($index < $total - 1)
                                    <button type="button" onclick="nextSoal({{ $index }}, {{ $soal->id }})" class="inline-flex items-center gap-2 bg-[#033E8A] hover:bg-[#022F67] text-white
                                                   font-montserrat font-semibold text-sm px-6 py-2.5 rounded-full transition-all">
                                        Lanjut
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                @else
                                    <button type="submit" class="inline-flex items-center gap-2 bg-[#0AADA8] hover:bg-[#089490] text-white
                                                   font-montserrat font-semibold text-sm px-6 py-2.5 rounded-full transition-all">
                                        Selesaikan Kuis
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach

            </form>

        </main>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

    @push('scripts')
<script>
    const total = {{ $total }};

    function showSoal(index) {
        document.querySelectorAll('.soal-item').forEach((el, i) => {
            el.classList.toggle('hidden', i !== index);
            el.classList.toggle('block', i === index);
        });

        const pct = ((index + 1) / total) * 100;
        document.getElementById('headerProgress').style.width = pct + '%';
        document.getElementById('progressLabel').textContent = `Pertanyaan ${index + 1}/${total}`;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function nextSoal(currentIndex, soalId) {
        const dipilih = document.querySelector(`input[name="jawaban_${soalId}"]:checked`);
        if (!dipilih) {
            const card = document.querySelector(`.soal-item[data-index="${currentIndex}"]`);
            card.classList.add('ring-2', 'ring-red-400', 'rounded-3xl');
            setTimeout(() => card.classList.remove('ring-2', 'ring-red-400', 'rounded-3xl'), 1000);

            // Tampilkan pesan error
            const existing = document.getElementById('error-msg-' + currentIndex);
            if (!existing) {
                const msg = document.createElement('p');
                msg.id = 'error-msg-' + currentIndex;
                msg.className = 'text-red-500 text-sm font-montserrat text-center mt-2';
                msg.textContent = 'Pilih jawaban terlebih dahulu sebelum melanjutkan.';
                card.appendChild(msg);
                setTimeout(() => msg.remove(), 2000);
            }
            return;
        }
        showSoal(currentIndex + 1);
    }

    function prevSoal(currentIndex) {
        if (currentIndex > 0) showSoal(currentIndex - 1);
    }

    function saveLater() {
        window.location.href = '{{ route("pengguna.modul.show", $modul->id) }}';
    }
</script>
@endpush

@endsection