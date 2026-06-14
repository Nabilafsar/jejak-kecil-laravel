@extends('layouts.app')

@section('title', 'Chat - ' . $jadwal->spesialis->nama . ' - Jejak Kecil')

@section('content')
@include('layouts.headerPengguna')

<div class="bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-6 py-8">

        {{-- Card Chat --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col"
             style="min-height: 600px;">

            {{-- ── Header Chat ── --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('pengguna.konsultasi.index') }}"
                       class="text-gray-400 hover:text-[#033E8A] transition-colors mr-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    {{-- Avatar Spesialis --}}
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-br from-[#033E8A] to-[#0AADA8]
                                    flex items-center justify-center text-white font-bold">
                            @if($jadwal->spesialis->foto)
                                <img src="{{ asset('assets/img/' . $jadwal->spesialis->foto) }}"
                                     alt="{{ $jadwal->spesialis->nama }}"
                                     class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($jadwal->spesialis->nama, 0, 1)) }}
                            @endif
                        </div>
                        {{-- Online dot --}}
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white"></span>
                    </div>

                    {{-- Nama + Status --}}
                    <div>
                        <h3 class="font-montserrat font-bold text-[#033E8A] text-sm">
                            {{ $jadwal->spesialis->nama }}{{ $jadwal->spesialis->gelar ? ', ' . $jadwal->spesialis->gelar : '' }}
                        </h3>
                        <p class="font-montserrat text-green-500 text-xs flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full inline-block"></span>
                            {{ $jadwal->spesialis->spesialisasi }}
                        </p>
                    </div>
                </div>

                {{-- Aksi Kanan --}}
                <div class="flex items-center gap-3 text-gray-400">
                    <button class="hover:text-[#033E8A] transition-colors" title="Panggilan Suara">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </button>
                    <button class="hover:text-[#033E8A] transition-colors" title="Video Call">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                    <button class="hover:text-[#033E8A] transition-colors" title="Opsi">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ── Area Pesan ── --}}
            <div class="flex-1 overflow-y-auto px-6 py-6 flex flex-col gap-4" id="chatArea"
                 style="max-height: 450px;">

                {{-- Tanggal --}}
                <div class="text-center">
                    <span class="font-montserrat text-gray-400 text-xs bg-gray-50 px-3 py-1 rounded-full">
                        Hari Ini
                    </span>
                </div>

                @if($jadwal->pesan->isEmpty())
                {{-- Kosong: pesan selamat datang --}}
                <div class="text-center py-8">
                    <div class="w-14 h-14 rounded-full bg-[#EEF4FF] flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p class="font-montserrat text-gray-400 text-sm">
                        Mulai percakapan dengan {{ $jadwal->spesialis->nama }}
                    </p>
                    <p class="font-montserrat text-gray-300 text-xs mt-1">
                        Jadwal: {{ $jadwal->waktu_mulai->format('d M Y, H:i') }} WIB
                    </p>
                </div>
                @else

                @foreach($jadwal->pesan as $pesan)

                {{-- Pesan dari Spesialis --}}
                @if($pesan->pengirim === 'spesialis')
                <div class="flex items-end gap-3 max-w-[80%]">
                    <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0 bg-gradient-to-br from-[#033E8A] to-[#0AADA8]
                                flex items-center justify-center text-white text-xs font-bold">
                        @if($jadwal->spesialis->foto)
                            <img src="{{ asset('assets/img/' . $jadwal->spesialis->foto) }}"
                                 class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($jadwal->spesialis->nama, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="bg-gray-50 rounded-2xl rounded-bl-sm px-4 py-3 shadow-sm">
                            {{-- Lampiran --}}
                            @if($pesan->lampiran)
                            <div class="flex items-center gap-3 bg-white rounded-xl p-3 mb-2 border border-gray-100">
                                <div class="w-9 h-9 rounded-lg bg-[#EEF4FF] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#033E8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-montserrat text-xs font-semibold text-gray-700 truncate">
                                        {{ $pesan->nama_lampiran }}
                                    </p>
                                    <p class="font-montserrat text-gray-400 text-[10px]">PDF Document</p>
                                </div>
                                <a href="{{ asset('assets/img/' . $pesan->lampiran) }}"
                                   download="{{ $pesan->nama_lampiran }}"
                                   class="text-gray-400 hover:text-[#033E8A] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            </div>
                            @endif
                            <p class="font-montserrat text-gray-700 text-sm leading-relaxed">
                                {{ $pesan->isi_pesan }}
                            </p>
                        </div>
                        <p class="font-montserrat text-gray-400 text-[10px] mt-1 ml-1">
                            {{ $pesan->created_at->format('H:i') }}
                        </p>
                    </div>
                </div>

                {{-- Pesan dari Pengguna --}}
                @else
                <div class="flex items-end gap-3 max-w-[80%] ml-auto flex-row-reverse">
                    <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0 bg-[#033E8A]
                                flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                    <div>
                        <div class="bg-[#033E8A] rounded-2xl rounded-br-sm px-4 py-3 shadow-sm">
                            <p class="font-montserrat text-white text-sm leading-relaxed">
                                {{ $pesan->isi_pesan }}
                            </p>
                        </div>
                        <p class="font-montserrat text-gray-400 text-[10px] mt-1 mr-1 text-right">
                            {{ $pesan->created_at->format('H:i') }}
                            <span class="text-[#0AADA8]">✓✓</span>
                        </p>
                    </div>
                </div>
                @endif

                @endforeach
                @endif

            </div>

            {{-- ── Quick Reply ── --}}
            <div class="px-6 pb-2 flex items-center gap-2">
                <button onclick="setQuickReply('Terima kasih')"
                        class="font-montserrat text-xs font-medium px-3 py-1.5 rounded-full
                               bg-[#EEF4FF] text-[#033E8A] hover:bg-[#dde8ff] transition-colors flex items-center gap-1">
                    👍 Terima kasih
                </button>
                <button onclick="setQuickReply('Tanya lagi')"
                        class="font-montserrat text-xs font-medium px-3 py-1.5 rounded-full
                               bg-[#EEF4FF] text-[#033E8A] hover:bg-[#dde8ff] transition-colors flex items-center gap-1">
                    ❓ Tanya lagi
                </button>
                <button onclick="setQuickReply('Jadwal Lanjut')"
                        class="font-montserrat text-xs font-medium px-3 py-1.5 rounded-full
                               bg-[#EEF4FF] text-[#033E8A] hover:bg-[#dde8ff] transition-colors flex items-center gap-1">
                    📅 Jadwal Lanjut
                </button>
            </div>

            {{-- ── Form Input Pesan ── --}}
            <div class="px-6 pb-5">
                <form action="{{ route('pengguna.konsultasi.kirimPesan', $jadwal->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="flex items-center gap-3 bg-gray-50 rounded-2xl px-4 py-3 border border-gray-100">
                    @csrf

                    {{-- Attach File --}}
                    <label for="lampiran" class="cursor-pointer text-gray-400 hover:text-[#033E8A] transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        <input type="file" id="lampiran" name="lampiran"
                               accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                               onchange="showFileName(this)">
                    </label>

                    {{-- Input Teks --}}
                    <input type="text"
                           id="pesanInput"
                           name="isi_pesan"
                           placeholder="Ketik pesan..."
                           required
                           class="flex-1 bg-transparent font-montserrat text-sm text-gray-700
                                  placeholder-gray-400 focus:outline-none">

                    {{-- Emoji (placeholder) --}}
                    <button type="button" class="text-gray-400 hover:text-yellow-500 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>

                    {{-- Kirim --}}
                    <button type="submit"
                            class="w-9 h-9 rounded-full bg-[#033E8A] hover:bg-[#022F67] flex items-center justify-center
                                   text-white transition-all duration-300 flex-shrink-0 shadow-md">
                        <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </form>

                {{-- Nama file terpilih --}}
                <p id="fileName" class="font-montserrat text-xs text-[#0AADA8] mt-1 ml-1 hidden"></p>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

@push('scripts')
<script>
    // Auto scroll ke bawah
    const chatArea = document.getElementById('chatArea');
    if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;

    // Quick reply
    function setQuickReply(text) {
        document.getElementById('pesanInput').value = text;
        document.getElementById('pesanInput').focus();
    }

    // Tampilkan nama file lampiran
    function showFileName(input) {
        const label = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            label.textContent = '📎 ' + input.files[0].name;
            label.classList.remove('hidden');
        }
    }
</script>
@endpush

@endsection
