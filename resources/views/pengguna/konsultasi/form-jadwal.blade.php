@extends('layouts.app')

@section('title', 'Buat Jadwal Konsultasi - Jejak Kecil')

@section('content')
    @include('layouts.headerPengguna')

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-2xl mx-auto px-6">

            {{-- Kembali --}}
            <a href="{{ route('pengguna.konsultasi.index') }}"
                class="inline-flex items-center gap-1 font-montserrat text-sm text-[#033E8A] hover:underline mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>

            {{-- Card Spesialis --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6 flex items-center gap-4">
                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0 bg-gray-100">
                    @if($spesialis->foto)
                        <img src="{{ asset('assets/img/' . $spesialis->foto) }}" alt="{{ $spesialis->nama }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#033E8A] to-[#0AADA8]
                                        flex items-center justify-center text-white font-bold text-xl">
                            {{ strtoupper(substr($spesialis->nama, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h2 class="font-montserrat font-bold text-[#033E8A] text-lg">
                        {{ $spesialis->nama }}{{ $spesialis->gelar ? ', ' . $spesialis->gelar : '' }}
                    </h2>
                    <p class="font-montserrat text-gray-500 text-sm">{{ $spesialis->spesialisasi }}</p>
                    <div class="flex items-center gap-1 mt-1">
                        <span class="text-yellow-400 text-sm">★</span>
                        <span class="font-montserrat text-sm font-semibold text-gray-700">
                            {{ number_format($spesialis->rating, 1) }}
                        </span>
                        <span class="font-montserrat text-gray-400 text-xs">
                            ({{ $spesialis->jumlah_ulasan }} Ulasan)
                        </span>
                        <span class="font-montserrat text-gray-300 text-xs mx-1">•</span>
                        <span class="font-montserrat text-[#033E8A] text-sm font-semibold">
                            {{ $spesialis->biaya_format }}/sesi
                        </span>
                    </div>
                </div>
            </div>

            {{-- Form Pemesanan --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h1 class="font-montserrat font-bold text-[#033E8A] text-xl mb-6">
                    Isi Detail Jadwal
                </h1>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5">
                        <ul class="list-disc list-inside font-montserrat text-red-600 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pengguna.konsultasi.buatJadwal', $spesialis->id) }}" method="POST"
                    class="flex flex-col gap-5">
                    @csrf

                    {{-- Judul Sesi --}}
                    <div>
                        <label class="block font-montserrat font-semibold text-gray-700 text-sm mb-2">
                            Judul Sesi <span class="text-red-500">*</span>
                        </label>
                        <select name="judul_sesi" class="w-full px-4 py-3 rounded-xl border border-gray-200 font-montserrat text-sm
                                       bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0AADA8]
                                       focus:border-transparent text-gray-700">
                            <option value="">-- Pilih Jenis Sesi --</option>
                            <option value="Konsultasi Awal" {{ old('judul_sesi') === 'Konsultasi Awal' ? 'selected' : '' }}>
                                Konsultasi Awal
                            </option>
                            <option value="Sesi Terapi Wicara" {{ old('judul_sesi') === 'Sesi Terapi Wicara' ? 'selected' : '' }}>
                                Sesi Terapi Wicara
                            </option>
                            <option value="Evaluasi Perkembangan" {{ old('judul_sesi') === 'Evaluasi Perkembangan' ? 'selected' : '' }}>
                                Evaluasi Perkembangan
                            </option>
                            <option value="Konsultasi Lanjutan" {{ old('judul_sesi') === 'Konsultasi Lanjutan' ? 'selected' : '' }}>
                                Konsultasi Lanjutan
                            </option>
                            <option value="Sesi Tanya Jawab" {{ old('judul_sesi') === 'Sesi Tanya Jawab' ? 'selected' : '' }}>
                                Sesi Tanya Jawab
                            </option>
                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block font-montserrat font-semibold text-gray-700 text-sm mb-2">
                            Tanggal Konsultasi <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 font-montserrat text-sm
                                      bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0AADA8]
                                      focus:border-transparent text-gray-700">
                    </div>

                    {{-- Jam --}}
                    {{-- Jam --}}
                    <div>
                        <label class="block font-montserrat font-semibold text-gray-700 text-sm mb-2">
                            Jam Konsultasi <span class="text-red-500">*</span>
                        </label>

                        <div class="grid grid-cols-4 gap-2" id="jamGrid">
                            @foreach(['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'] as $jam)
                                    <button type="button" onclick="pilihJam('{{ $jam }}')" data-jam="{{ $jam }}" class="jam-btn py-2.5 rounded-xl border border-gray-200 font-montserrat
                                   text-sm text-gray-600 hover:border-[#033E8A] hover:text-[#033E8A]
                                   hover:bg-[#EEF4FF] transition-all">
                                        {{ $jam }}
                                    </button>
                            @endforeach
                        </div>

                        <input type="hidden" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}">

                        <p id="jamDipilih" class="font-montserrat text-[#033E8A] text-sm mt-2 hidden">
                            ✓ Jam dipilih: <span id="labelJam"></span>
                        </p>
                        <p id="peringatanJam" class="font-montserrat text-red-500 text-sm mt-2 hidden">
                            ✗ Jam ini sudah dipesan, pilih jam lain.
                        </p>

                        {{-- Legend --}}
                        <div class="flex items-center gap-4 mt-3">
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-[#033E8A]"></div>
                                <span class="font-montserrat text-xs text-gray-500">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                                <span class="font-montserrat text-xs text-gray-500">Sudah Dipesan</span>
                            </div>
                        </div>
                    </div>

                    {{-- Info Biaya --}}
                    <div class="bg-[#EEF4FF] rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <p class="font-montserrat text-gray-500 text-xs">Estimasi Biaya Sesi</p>
                            <p class="font-montserrat font-bold text-[#033E8A] text-lg">
                                {{ $spesialis->biaya_format }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-montserrat text-gray-400 text-xs">Durasi</p>
                            <p class="font-montserrat font-semibold text-gray-700 text-sm">60 Menit</p>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="w-full bg-[#033E8A] hover:bg-[#022F67] text-white font-montserrat
                                   font-bold text-base py-4 rounded-xl transition-all duration-300
                                   shadow-lg shadow-[#033E8A]/20">
                        Konfirmasi Jadwal →
                    </button>

                </form>
            </div>

        </div>
    </div>

    @include('layouts.footer')
@endsection

@push('scripts')
<script>
    const urlJamTerpesan = "{{ route('pengguna.konsultasi.jamTerpesan', $spesialis->id) }}";
    let tanggalDipilih = '';
    let jamDipilih = '';
    let daftarJamTerpesan = @json($jamTerpesan); // dari controller (load awal)

    // Saat tanggal berubah → fetch jam terpesan dari server
    document.getElementById('tanggal').addEventListener('change', async function() {
        tanggalDipilih = this.value;
        jamDipilih = '';
        document.getElementById('waktu_mulai').value = '';
        document.getElementById('jamDipilih').classList.add('hidden');

        // Fetch jam terpesan untuk tanggal ini
        const res = await fetch(urlJamTerpesan + '?tanggal=' + tanggalDipilih);
        daftarJamTerpesan = await res.json();

        renderTombolJam();
    });

    function renderTombolJam() {
        document.querySelectorAll('.jam-btn').forEach(btn => {
            const jam = btn.dataset.jam;
            const terpesan = daftarJamTerpesan.includes(jam);

            // Reset semua class
            btn.classList.remove(
                'bg-[#033E8A]', 'text-white', 'border-[#033E8A]',
                'bg-gray-100', 'text-gray-400', 'border-gray-200',
                'cursor-not-allowed', 'opacity-60',
                'hover:border-[#033E8A]', 'hover:text-[#033E8A]', 'hover:bg-[#EEF4FF]'
            );

            if (terpesan) {
                // Abu-abu → tidak bisa dipilih
                btn.classList.add('bg-gray-100', 'text-gray-400', 'border-gray-200', 'cursor-not-allowed', 'opacity-60');
                btn.disabled = true;
                btn.title = 'Sudah dipesan';
            } else {
                // Normal → bisa dipilih
                btn.classList.add('border-gray-200', 'text-gray-600', 'hover:border-[#033E8A]', 'hover:text-[#033E8A]', 'hover:bg-[#EEF4FF]');
                btn.disabled = false;
                btn.title = '';
            }
        });
    }

    function pilihJam(jam) {
        // Cek lagi di sisi client sebelum pilih
        if (daftarJamTerpesan.includes(jam)) {
            document.getElementById('peringatanJam').classList.remove('hidden');
            document.getElementById('jamDipilih').classList.add('hidden');
            return;
        }

        document.getElementById('peringatanJam').classList.add('hidden');
        jamDipilih = jam;

        // Reset highlight semua
        document.querySelectorAll('.jam-btn:not([disabled])').forEach(btn => {
            btn.classList.remove('bg-[#033E8A]', 'text-white', 'border-[#033E8A]');
            btn.classList.add('border-gray-200', 'text-gray-600');
        });

        // Highlight yang dipilih
        const btn = document.querySelector(`[data-jam="${jam}"]`);
        btn.classList.add('bg-[#033E8A]', 'text-white', 'border-[#033E8A]');
        btn.classList.remove('border-gray-200', 'text-gray-600');

        document.getElementById('jamDipilih').classList.remove('hidden');
        document.getElementById('labelJam').textContent = jam + ' WIB';

        updateWaktuMulai();
    }

    function updateWaktuMulai() {
        if (tanggalDipilih && jamDipilih) {
            document.getElementById('waktu_mulai').value = tanggalDipilih + ' ' + jamDipilih + ':00';
        }
    }

    // Render awal jika ada old value
    renderTombolJam();
</script>
@endpush