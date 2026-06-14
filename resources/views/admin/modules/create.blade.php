@extends('admin.layoutSidebar')

@section('content')
    <div class="p-6">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#033E8A]">Tambah Modul</h1>
            <p class="text-sm text-gray-500 mt-1">Tambahkan modul pembelajaran baru.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <form action="{{ route('admin.modules.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul Modul --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Modul</label>
                    <input type="text" name="judul_modul" value="{{ old('judul_modul') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                        placeholder="Masukkan judul modul">
                    @error('judul_modul')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                        placeholder="Deskripsi singkat modul">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tingkat Kesulitan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tingkat Kesulitan</label>
                    <select name="tingkat_kesulitan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                        <option value="">Pilih tingkat kesulitan</option>
                        <option value="mudah" {{ old('tingkat_kesulitan') === 'mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="sedang" {{ old('tingkat_kesulitan') === 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="sulit" {{ old('tingkat_kesulitan') === 'sulit' ? 'selected' : '' }}>Sulit</option>
                    </select>
                    @error('tingkat_kesulitan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gaya Belajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gaya Belajar</label>
                    <select name="id_gaya_belajar"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                        <option value="">Pilih gaya belajar</option>
                        @foreach($gayaBelajar as $gaya)
                            <option value="{{ $gaya->id }}" {{ old('id_gaya_belajar') == $gaya->id ? 'selected' : '' }}>
                                {{ $gaya->nama_gaya }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_gaya_belajar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                        placeholder="Contoh: Matematika, Bahasa, Sains...">
                    <p class="text-xs text-gray-400 mt-1">Kategori digunakan untuk filter modul.</p>
                    @error('kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Thumbnail</label>
                    <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maks 2MB.</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi Konten --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Isi Konten</label>
                    <div id="konten-wrapper" class="space-y-4">
                        <div class="konten-item border border-gray-200 rounded-xl p-4">
                            <div class="mb-3">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tipe Konten</label>
                                <select name="tipe_konten[]" onchange="toggleInput(this)"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30">
                                    <option value="">Pilih tipe</option>
                                    <option value="teks">Teks</option>
                                    <option value="gambar">Gambar</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="input-konten">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Isi Konten</label>
                                <textarea name="isi_konten[]" rows="3"
                                    class="input-teks w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30"
                                    placeholder="Masukkan teks konten"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="tambahKonten()"
                        class="mt-3 flex items-center gap-2 text-sm text-[#033E8A] hover:text-blue-800 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Konten
                    </button>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                        Simpan
                    </button>
                    <a href="{{ route('admin.modules.index') }}"
                        class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        function toggleInput(select) {
            const item = select.closest('.konten-item');
            const inputWrapper = item.querySelector('.input-konten');
            const tipe = select.value;

            inputWrapper.innerHTML = `<label class="block text-xs font-medium text-gray-600 mb-1">Isi Konten</label>`;

            if (tipe === 'teks') {
                inputWrapper.innerHTML += `<textarea name="isi_konten[]" rows="3"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none"
                placeholder="Masukkan teks konten"></textarea>`;
            } else if (tipe === 'gambar') {
                inputWrapper.innerHTML += `<input type="file" name="isi_konten[]" accept=".jpg,.jpeg,.png"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG</p>`;
            } else if (tipe === 'video') {
                inputWrapper.innerHTML += `
                <input type="text" name="isi_konten[]"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30"
                    placeholder="https://youtu.be/xxxxx atau https://www.youtube.com/watch?v=xxxxx">
                <p class="text-xs text-gray-400 mt-1">Masukkan URL YouTube.</p>`;
            }
        }

        function tambahKonten() {
            const wrapper = document.getElementById('konten-wrapper');
            const div = document.createElement('div');
            div.className = 'konten-item border border-gray-200 rounded-xl p-4 relative';
            div.innerHTML = `
            <button type="button" onclick="this.closest('.konten-item').remove()"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
            <div class="mb-3">
                <label class="block text-xs font-medium text-gray-600 mb-1">Tipe Konten</label>
                <select name="tipe_konten[]" onchange="toggleInput(this)"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30">
                    <option value="">Pilih tipe</option>
                    <option value="teks">Teks</option>
                    <option value="gambar">Gambar</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="input-konten">
                <label class="block text-xs font-medium text-gray-600 mb-1">Isi Konten</label>
                <textarea name="isi_konten[]" rows="3"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none"
                    placeholder="Masukkan teks konten"></textarea>
            </div>`;
            wrapper.appendChild(div);
        }
    </script>
@endsection